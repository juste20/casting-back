<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\CastingValidated;
use App\Events\PaymentCompleted;
use App\Listeners\SendCastingNotification;
use App\Listeners\ArchiveCastingListener;
use App\Listeners\LogPaymentActivity;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CastingValidated::class => [
            SendCastingNotification::class,
            ArchiveCastingListener::class,
        ],
        PaymentCompleted::class => [
            LogPaymentActivity::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
