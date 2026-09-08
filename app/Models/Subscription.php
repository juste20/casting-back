<?php

namespace App\Models;

use App\Mail\SubscriptionConfirmationMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    protected $fillable = [
        'fullname','email','country',
        'actor_id','categories','status',
        'payment_reference','casting_id',
    ];

    protected $casts = [
        'categories' => 'array'
    ];

    protected static function booted(): void
    {
        static::created(function (Subscription $subscription) {
            if (!$subscription->email) {
                return;
            }

            try {
                Mail::to($subscription->email)->send(new SubscriptionConfirmationMail($subscription));
            } catch (\Throwable $e) {
                Log::error('Echec envoi email de confirmation d\'inscription', [
                    'subscription_id' => $subscription->id,
                    'error' => $e->getMessage(),
                ]);
            }
        });
    }

    public function actor()
    {
        return $this->belongsTo(Actor::class);
    }

    public function casting()
    {
        return $this->belongsTo(Casting::class);
    }
}