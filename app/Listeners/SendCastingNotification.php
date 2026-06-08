<?php

namespace App\Listeners;

use App\Events\CastingValidated;
use App\Models\Notification;

class SendCastingNotification
{
    public function handle(CastingValidated $event): void
    {
        Notification::create([
            'type' => 'casting',
            'message' => "Le casting « {$event->casting->title} » a été validé.",
        ]);
    }
}
