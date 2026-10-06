<?php

namespace App\Services;

use App\Mail\CastingMatchMail;
use App\Models\Casting;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CastingMatchingService
{
    private const ELIGIBLE_STATUSES = ['pending', 'approved'];

    public function notifyMatchingCandidates(Casting $casting): void
    {
        dispatch(function () use ($casting) {
            $this->processMatchingCandidates($casting);
        })->afterResponse();
    }

    public function processMatchingCandidates(Casting $casting): int
    {
        $categoryNames = $casting->categories()->pluck('name')->filter()->unique()->values();

        if ($categoryNames->isEmpty()) {
            return 0;
        }

        $candidates = Subscription::with('payment')
            ->whereIn('status', self::ELIGIBLE_STATUSES)
            ->whereHas('payment', fn ($q) => $q->valid())
            ->where(function ($query) use ($categoryNames) {
                foreach ($categoryNames as $name) {
                    $query->orWhereJsonContains('categories', $name);
                }
            })
            ->get();

        $sent = 0;

        foreach ($candidates as $subscription) {
            if (!filter_var($subscription->email, FILTER_VALIDATE_EMAIL)) {
                continue;
            }

            $payment = $subscription->payment;

            // Réservation atomique : un paiement = un seul mail
            $claimed = Payment::whereKey($payment->id)
                ->whereNull('consumed_at')
                ->update(['consumed_at' => now()]);

            if (!$claimed) {
                continue;
            }

            try {
                Mail::to($subscription->email)->send(new CastingMatchMail($casting, $subscription));

                $subscription->update([
                    'status' => 'sent',
                    'casting_id' => $casting->id,
                ]);

                $sent++;
            } catch (\Throwable $e) {
                // Échec : le paiement redevient valide
                Payment::whereKey($payment->id)->update(['consumed_at' => null]);

                Log::error('Echec envoi email casting correspondant', [
                    'subscription_id' => $subscription->id,
                    'casting_id' => $casting->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return $sent;
    }
}