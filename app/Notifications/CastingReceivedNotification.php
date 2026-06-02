<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CastingReceivedNotification extends Notification
{
    public function via($notifiable) { return ['mail']; }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Casting reçu')
            ->line('Votre casting a bien été reçu.')
            ->line('Il est en cours de validation.');
    }
}
