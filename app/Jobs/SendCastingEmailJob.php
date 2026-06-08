<?php

namespace App\Jobs;

use App\Mail\CastingNotification;
use App\Models\Casting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendCastingEmailJob implements ShouldQueue
{
    use Queueable;

    public Casting $casting;
    public string $action;

    public function __construct(Casting $casting, string $action)
    {
        $this->casting = $casting;
        $this->action = $action;
    }

    public function handle(): void
    {
        Mail::to($this->casting->promoter_email)
            ->send(new CastingNotification($this->casting, $this->action));
    }
}
