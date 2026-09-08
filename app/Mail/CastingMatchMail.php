<?php

namespace App\Mail;

use App\Models\Casting;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CastingMatchMail extends Mailable
{
    use Queueable, SerializesModels;

    public Casting $casting;
    public Subscription $subscription;

    public function __construct(Casting $casting, Subscription $subscription)
    {
        $this->casting = $casting;
        $this->subscription = $subscription;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Un casting correspondant à votre profil est disponible - Casting.net',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.casting_match',
            with: [
                'casting' => $this->casting,
                'subscription' => $this->subscription,
            ],
        );
    }
}