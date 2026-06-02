<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CastingRejectedNotification extends Notification
{
    protected $reason;

    public function __construct($reason)
    {
        $this->reason = $reason;
    }

    public function via($notifiable) { return ['mail']; }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Casting rejeté')
            ->line('Motif : '.$this->reason);
    }
}
