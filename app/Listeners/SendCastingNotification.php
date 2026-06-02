<?php

namespace App\Listeners;

use App\Events\CastingValidated;

class SendCastingNotification
{
    public function handle(CastingValidated $event)
    {
        // notifier abonnés
    }
}
