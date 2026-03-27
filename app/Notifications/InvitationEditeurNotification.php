<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitationEditeurNotification extends Notification
{
    use Queueable;

    public function __construct(public string $plainToken) {}

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/invitation/'.$this->plainToken);

        return (new MailMessage)
            ->subject('Invitation éditeur — Bracongo')
            ->line('Vous avez été invité à rejoindre le back-office Bracongo en tant qu’éditeur.')
            ->action('Accepter l’invitation', $url)
            ->line('Si vous n’êtes pas à l’origine de cette demande, ignorez ce message.');
    }
}
