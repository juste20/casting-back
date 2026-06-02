<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCastingEmailJob implements ShouldQueue
{
    use Queueable;

    public function handle()
    {
        // envoyer casting
    }
}
