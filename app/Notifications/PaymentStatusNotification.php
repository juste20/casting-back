<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentStatusNotification extends Notification
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function via($notifiable) { return ['mail']; }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Statut du paiement')
            ->line('Statut : '.$this->status);
    }
}
