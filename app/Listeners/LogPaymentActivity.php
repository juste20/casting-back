<?php

namespace App\Listeners;

use App\Events\PaymentCompleted;

class LogPaymentActivity
{
    public function handle(PaymentCompleted $event)
    {
        // log activité
    }
}
