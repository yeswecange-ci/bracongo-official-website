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
            ->theme('bracongo')
            ->subject('Invitation à rejoindre l’espace d’administration — Bracongo')
            ->greeting('Bonjour,')
            ->line('Vous avez été invité à rejoindre l’espace d’administration du site Bracongo en tant qu’éditeur. Utilisez le bouton ci-dessous pour accepter l’invitation et activer votre accès.')
            ->action('Accepter l’invitation', $url)
            ->line('Si vous n’êtes pas à l’origine de cette demande ou si vous ne souhaitez pas créer de compte, vous pouvez ignorer cet e-mail en toute sécurité.')
            ->salutation('Cordialement, — L’équipe Bracongo');
    }
}
