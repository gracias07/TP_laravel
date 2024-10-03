<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailToAdminAfterRegistrationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $code;
    public $email;
    public function __construct($codeToSend, $SendToemail)
    {
        //
        $this->code = $codeToSend;
        $this->email = $SendToemail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Création de compte administrateur')
                    ->line('Bonjour.')
                    ->line('Votre compte à été crée avec succès sur la plateforme de gestion de salaire et des employés.')
                    ->line('Saisissez le code ' .$this->code. 'et renseigner dans le champ du formulaire qui apparaitra')
                    ->line('Cliquez ci-dessous pour valider votre compte')
                    ->action('Cliquez ici', url('/validate-account/' . '/' . $this->email))
                    ->line('Merci d\'utiliser nos services');
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
