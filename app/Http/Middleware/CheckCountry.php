<?php

namespace App\Http\Middleware;

use Closure;

class CheckCountry
{
    public function handle($request, Closure $next)
    {
        if (!in_array($request->country, ['BJ','BF','CI','GW','ML','NE','SN','TG'])) {
            return response()->json(['error' => 'Pays non autorisé'], 403);
        }

        return $next($request);
    }
}
