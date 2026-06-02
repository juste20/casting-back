<?php

namespace App\Jobs;

use App\Services\CastingService;

class ArchiveExpiredCastingJob
{
    public function handle(CastingService $service)
    {
        $service->archiveExpired();
    }
}
