<?php

namespace App\Http\Middleware;

use Closure;

class PreventFraud
{
    public function handle($request, Closure $next)
    {
        if ($request->ip() === '0.0.0.0') {
            return response()->json(['error' => 'Activité suspecte'], 403);
        }

        return $next($request);
    }
}
