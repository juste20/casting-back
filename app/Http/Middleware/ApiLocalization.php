<?php

namespace App\Http\Middleware;

use Closure;
use App;

class ApiLocalization
{
    public function handle($request, Closure $next)
    {
        $lang = $request->header('Accept-Language', 'fr');
        App::setLocale($lang);
        return $next($request);
    }
}
