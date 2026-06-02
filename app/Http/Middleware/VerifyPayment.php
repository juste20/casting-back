<?php

namespace App\Http\Middleware;

use Closure;

class VerifyPayment
{
    public function handle($request, Closure $next)
    {
        if (!$request->has('transaction_id')) {
            return response()->json(['error' => 'Paiement invalide'], 403);
        }

        return $next($request);
    }
}
