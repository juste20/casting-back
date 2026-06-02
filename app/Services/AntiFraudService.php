<?php

namespace App\Services;

class AntiFraudService
{
    public function check($request)
    {
        return $request->ip() !== '0.0.0.0';
    }
}
