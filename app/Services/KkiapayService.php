<?php

namespace App\Services;

use Illuminate\Support\Str;

class KkiapayService
{
    public function initiate($request)
    {
        return [
            'reference' => Str::uuid(),
            'amount' => $request->amount,
            'status' => 'PENDING'
        ];
    }
}
