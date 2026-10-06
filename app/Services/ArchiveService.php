<?php

namespace App\Services;

use App\Models\Archive;
use App\Models\Casting;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class ArchiveService
{
    public const PROCESSED_SUBSCRIPTION_STATUSES = ['sent', 'received', 'rejected'];

    public function runAll(): array
    {
        return [
            'castings' => $this->archiveExpiredCastings(),
            'subscriptions' => $this->archiveProcessedSubscriptions(),
            'payments' => $this->archiveProcessedPayments(),
        ];
    }

    public function archiveExpiredCastings(): int
    {
        $expired = Casting::whereIn('status', ['pending', 'validated'])
            ->whereNotNull('end_date')
            ->whereDate('end_date', '<', now()->toDateString())
            ->get();

        foreach ($expired as $casting) {
            DB::transaction(function () use ($casting) {
                $previous = $casting->status;
                $casting->update(['status' => 'archived']);

                Archive::create([
                    'type' => 'casting',
                    'data' => array_merge($casting->toArray(), ['previous_status' => $previous]),
                    'reason' => 'Date de fin depassee',
                    'archived_at' => now(),
                ]);
            });
        }

        return $expired->count();
    }

    public function archiveProcessedSubscriptions(): int
    {
        $subscriptions = Subscription::whereIn('status', self::PROCESSED_SUBSCRIPTION_STATUSES)->get();

        foreach ($subscriptions as $subscription) {
            DB::transaction(function () use ($subscription) {
                $previous = $subscription->status;
                $subscription->update(['status' => 'archived']);

                Archive::create([
                    'type' => 'subscription',
                    'data' => array_merge($subscription->toArray(), ['previous_status' => $previous]),
                    'reason' => 'Inscription traitee (' . $previous . ')',
                    'archived_at' => now(),
                ]);
            });
        }

        return $subscriptions->count();
    }

    public function archiveProcessedPayments(): int
    {
        $payments = Payment::whereNull('archived_at')
            ->where(function ($q) {
                $q->whereNotNull('consumed_at')
                  ->orWhere('status', 'failed');
            })
            ->get();

        foreach ($payments as $payment) {
            DB::transaction(function () use ($payment) {
                $reason = $payment->consumed_at ? 'Paiement utilise (mail envoye)' : 'Paiement echoue';
                $payment->update(['archived_at' => now()]);

                Archive::create([
                    'type' => 'payment',
                    'data' => $payment->toArray(),
                    'reason' => $reason,
                    'archived_at' => now(),
                ]);
            });
        }

        return $payments->count();
    }
}