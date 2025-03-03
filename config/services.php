<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'discord' => [
        'notifications' => [
            'webhook_url' => env('DISCORD_WEBHOOK_URL'),
        ],
    ],
    'twitter' => [
        'consumer_key' => env('TWITTER_CONSUMER_KEY'),
        'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
        'access_token' => env('TWITTER_ACCESS_TOKEN'),
        'access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
    ],

    'linkedin' => [
        'access_token' => env('LINKEDIN_ACCESS_TOKEN', 'AQXpWKIyuh2NYwr_Gpi-8xrCIcEgXnDHX6nDPI73bf9YoGYixkWs6XsWLv-4Gs-w_pSgFQXKkcYsckIIFR74pWVHkZxzJemayHNWagCelExcEhIi4egoucT95dOMfem9m64j8nMZ890fRdf1DEaD0sdKkUJdrryEsWtlMKXurgeLlWxD1vSJL0vmRM8IaMVNscj0MqvoJY0Eh_2hQPuwbD_cYHLQjGc0Xn6knM89qesndiadR133Gz4c0SVvmqoEH_DhAnqwvdfk7FXGg6lh5lj4hZN7A34wNNVIZPkdYBeYKP7bTCVNZf-1HeFaCnOA5nzxJjmBrs6AwPA22XMnYUZ9x9NWmQ'),
        'person_urn' => env('LINKEDIN_PERSON_URN'),
    ],

];
