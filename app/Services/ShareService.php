<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Http;

class ShareService
{
    /**
     * Share the project on Twitter and LinkedIn.
     *
     * @return array
     */
    public function shareProject(Project $project)
    {
        $projectUrl = route('projects.show', $project->uuid);
        $message = "You've been Laraveled! {$project->title} is now live on Laraveled. Check it out here: {$projectUrl}";

        $twitterResponse = $this->postToTwitter($message);
        $linkedinResponse = $this->postToLinkedIn($message);

        return [
            'twitter' => $twitterResponse,
            'linkedin' => $linkedinResponse,
        ];
    }

    /**
     * Post a tweet using Laravel's HTTP client.
     *
     * Twitter requires OAuth 1.0a signing. This example builds the signature manually.
     *
     * @return mixed
     */
    protected function postToTwitter(string $message)
    {
        $url = 'https://api.twitter.com/1.1/statuses/update.json';

        $oauth = [
            'oauth_consumer_key' => config('services.twitter.consumer_key'),
            'oauth_nonce' => time().mt_rand(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_token' => config('services.twitter.access_token'),
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0',
            'status' => $message,
        ];

        $baseString = $this->buildBaseString($url, 'POST', $oauth);
        $compositeKey = rawurlencode(config('services.twitter.consumer_secret')).'&'.rawurlencode(config('services.twitter.access_token_secret'));
        $oauthSignature = base64_encode(hash_hmac('sha1', $baseString, $compositeKey, true));
        $oauth['oauth_signature'] = $oauthSignature;

        $authHeader = 'OAuth '.$this->buildAuthorizationHeader($oauth);

        $response = Http::withHeaders([
            'Authorization' => $authHeader,
            'Expect' => '', // Some servers require this header
        ])->asForm()->post($url, ['status' => $message]);

        return $response->body();
    }

    protected function buildBaseString($baseURI, $method, $params)
    {
        ksort($params);
        $r = [];
        foreach ($params as $key => $value) {
            $r[] = "$key=".rawurlencode($value);
        }

        return $method.'&'.rawurlencode($baseURI).'&'.rawurlencode(implode('&', $r));
    }

    protected function buildAuthorizationHeader($oauth)
    {
        $r = [];
        foreach ($oauth as $key => $value) {
            if (strpos($key, 'oauth') !== false) {
                $r[] = "$key=\"".rawurlencode($value).'"';
            }
        }

        return implode(', ', $r);
    }

    /**
     * Post a share on LinkedIn using Laravel's HTTP client.
     *
     * @return mixed
     */
    protected function postToLinkedIn(string $message)
    {
        $url = 'https://api.linkedin.com/v2/ugcPosts';

        $payload = [
            'author' => 'urn:li:person:'.config('services.linkedin.person_urn'),
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => $message,
                    ],
                    'shareMediaCategory' => 'NONE',
                ],
            ],
            'visibility' => [
                'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
            ],
        ];

        $response = Http::withToken(config('services.linkedin.access_token'))
            ->post($url, $payload);

        return $response->body();
    }
}
