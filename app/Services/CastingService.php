<?php

namespace App\Services;

use App\Models\Casting;

class CastingService
{
    public function archiveExpired()
    {
        Casting::whereDate('date','<',now())->update(['status'=>'archived']);
    }
}
