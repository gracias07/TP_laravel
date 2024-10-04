<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailToAdminAfterRegistrationNotification extends Notification
{
    use Queueable;

    public $code;
    public $email;

    public function __construct($codeToSend, $SendToemail)
    {
        $this->code = $codeToSend;
        $this->email = $SendToemail;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Création de compte administrateur')
            ->greeting('Bonjour,')
            ->line('Votre compte a été créé avec succès sur notre plateforme.')
            ->line('Voici votre code de confirmation : ' . $this->code)
            ->action('Valider votre compte', url('/validate-account/' . $this->email))
            ->line('Merci d\'utiliser nos services !');
    }
}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
