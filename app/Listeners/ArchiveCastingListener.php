<?php

namespace App\Listeners;

use App\Events\CastingValidated;
use App\Models\Archive;

class ArchiveCastingListener
{
    public function handle(CastingValidated $event)
    {
        Archive::create([
            'type'=>'casting',
            'data'=>$event->casting->toArray(),
            'archived_at'=>now()
        ]);
    }
}
