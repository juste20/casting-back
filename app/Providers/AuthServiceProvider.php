<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Casting;
use App\Models\Subscription;
use App\Models\Payment;
use App\Policies\CastingPolicy;
use App\Policies\SubscriptionPolicy;
use App\Policies\PaymentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Casting::class      => CastingPolicy::class,
        Subscription::class => SubscriptionPolicy::class,
        Payment::class      => PaymentPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
