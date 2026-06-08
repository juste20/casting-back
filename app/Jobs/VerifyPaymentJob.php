<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyPaymentJob implements ShouldQueue
{
    use Queueable;

    public Payment $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function handle(): void
    {
        if ($this->payment->status === 'success') {
            Subscription::where('payment_reference', $this->payment->reference)
                ->where('status', 'pending')
                ->update(['status' => 'approved']);
        }
    }
}
