<?php

namespace App\Services;

use App\Models\Casting;
use App\Models\Archive;

class CastingService
{
    public function archiveExpired()
    {
        $expired = Casting::whereDate('end_date', '<', now())
            ->where('status', 'validated')
            ->get();

        foreach ($expired as $casting) {
            $casting->update(['status' => 'archived']);

            Archive::create([
                'type' => 'casting',
                'data' => $casting->toArray(),
                'reason' => 'Date de fin depassee',
                'archived_at' => now(),
            ]);
        }
    }
}
