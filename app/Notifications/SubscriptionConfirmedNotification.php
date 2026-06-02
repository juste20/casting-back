<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SubscriptionConfirmedNotification extends Notification
{
    public function via($notifiable) { return ['mail']; }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Inscription confirmée')
            ->line('Merci pour votre inscription sur Casting.net');
    }
}
