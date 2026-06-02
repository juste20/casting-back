<?php

namespace App\Services;

use App\Models\Payment;

class PaymentService
{
    public function store($data)
    {
        return Payment::create($data);
    }
}
