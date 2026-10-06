<?php

namespace App\Services;

use App\Mail\CastingNotification;
use App\Models\Casting;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CastingService
{
    public function __construct(
        private readonly CastingMatchingService $matching,
        private readonly ArchiveService $archive,
    ) {}

    public function validate(Casting $casting): bool
    {
        if ($casting->status !== 'pending') {
            return false;
        }

        $casting->update(['status' => 'validated', 'rejection_reason' => null]);

        Notification::create([
            'type' => 'casting',
            'message' => "Casting approuve : {$casting->title}",
        ]);

        $this->mailPromoter($casting, 'approved');
        $this->matching->notifyMatchingCandidates($casting);

        return true;
    }

    public function reject(Casting $casting, string $reason): bool
    {
        if ($casting->status !== 'pending') {
            return false;
        }

        $casting->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
        ]);

        Notification::create([
            'type' => 'casting',
            'message' => "Casting rejete : {$casting->title} - {$reason}",
        ]);

        $this->mailPromoter($casting, 'rejected', $reason);

        return true;
    }

    public function archiveExpired(): int
    {
        return $this->archive->archiveExpiredCastings();
    }

    private function mailPromoter(Casting $casting, string $action, ?string $reason = null): void
    {
        if (!$casting->promoter_email) {
            return;
        }

        dispatch(function () use ($casting, $action, $reason) {
            try {
                Mail::to($casting->promoter_email)
                    ->send(new CastingNotification($casting, $action, $reason));
            } catch (\Throwable $e) {
                Log::error('Echec envoi email au promoteur', [
                    'casting_id' => $casting->id,
                    'action' => $action,
                    'error' => $e->getMessage(),
                ]);
            }
        })->afterResponse();
    }
}