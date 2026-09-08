<?php

namespace App\Services;

use App\Mail\CastingMatchMail;
use App\Models\Casting;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CastingMatchingService
{
    /**
     * Trouve tous les candidats (Subscription) dont les categories
     * choisies correspondent a une des categories du casting, et leur
     * envoie un email pour les informer qu'un casting leur correspond.
     *
     * @return int Nombre d'emails envoyes avec succes
     */
    public function notifyMatchingCandidates(Casting $casting): int
    {
        $categoryNames = $casting->categories()->pluck('name')->filter()->unique()->values();

        if ($categoryNames->isEmpty()) {
            return 0;
        }

        $candidates = Subscription::where(function ($query) use ($categoryNames) {
            foreach ($categoryNames as $name) {
                $query->orWhereJsonContains('categories', $name);
            }
        })->get();

        $sent = 0;

        foreach ($candidates as $subscription) {
            if (!filter_var($subscription->email, FILTER_VALIDATE_EMAIL)) {
                continue;
            }

            try {
                Mail::to($subscription->email)->send(new CastingMatchMail($casting, $subscription));
                $sent++;
            } catch (\Throwable $e) {
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