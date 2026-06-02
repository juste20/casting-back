<?php

namespace App\Events;

use App\Models\Payment;

class PaymentCompleted
{
    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
}
