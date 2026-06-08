<?php

namespace App\Http\Middleware;

use App\Services\AntiFraudService;
use Closure;
use Illuminate\Http\Request;

class PreventFraud
{
    public function __construct(
        private readonly AntiFraudService $antiFraud
    ) {}

    public function handle(Request $request, Closure $next)
    {
        if ($this->antiFraud->isFraudulent($request)) {
            return response()->json(['error' => 'Requête rejetée pour activité suspecte.'], 429);
        }

        return $next($request);
    }
}
