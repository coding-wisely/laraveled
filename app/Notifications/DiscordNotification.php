<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class DiscordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct( protected string $message, protected string $url)
    {
        //
    }

    public function send(): void
    {
        $response = Http::post($this->url, [
            'content' => $this->message,
        ]);

        if ($response->failed()) {
            logger()->error('Failed to send Discord notification', [
                'message' => $this->message,
                'status' => $response->status(),
            ]);
        }
    }
}
