<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ClubNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $titulli,
        public string $mesazhi,
        public string $lloji,
        public string $url = '/dashboard'
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'titulli' => $this->titulli,
            'mesazhi' => $this->mesazhi,
            'lloji' => $this->lloji,
            'url' => $this->url,
        ];
    }
}
