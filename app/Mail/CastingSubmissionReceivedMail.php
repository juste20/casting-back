<?php

namespace App\Mail;

use App\Models\Casting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CastingSubmissionReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Casting $casting;

    public function __construct(Casting $casting)
    {
        $this->casting = $casting;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Casting reçu - en cours de vérification - Casting.net',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.casting_received',
            with: [
                'casting' => $this->casting,
            ],
        );
    }
}