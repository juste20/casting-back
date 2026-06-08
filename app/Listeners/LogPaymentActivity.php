<?php

namespace App\Listeners;

use App\Events\PaymentCompleted;
use Illuminate\Support\Facades\Log;

class LogPaymentActivity
{
    public function handle(PaymentCompleted $event): void
    {
        Log::info('Paiement complété', [
            'reference' => $event->payment->reference,
            'email' => $event->payment->email,
            'amount' => $event->payment->amount,
            'method' => $event->payment->method,
        ]);
    }
}
