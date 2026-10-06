<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Casting;

class CastingNotification extends Mailable
{
    use Queueable, SerializesModels;

    /* public Casting $casting;
    public string $action;

    public function __construct(Casting $casting, string $action)
    {
        $this->casting = $casting;
        $this->action = $action;
    } */

            public Casting $casting;
    public string $action;
    public ?string $reason;

    public function __construct(Casting $casting, string $action, ?string $reason = null)
    {
        $this->casting = $casting;
        $this->action = $action;
        $this->reason = $reason ?? $casting->rejection_reason;
    }
    

    public function envelope(): Envelope
    {
        $subject = $this->action === 'approved'
            ? 'Votre casting a ete approuve'
            : 'Votre casting a ete rejeté';

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.casting-notification');
    }
}
