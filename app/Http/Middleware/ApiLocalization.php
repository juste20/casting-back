<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class ApiLocalization
{
    private const SUPPORTED_LOCALES = ['fr', 'en'];

    public function handle($request, Closure $next)
    {
        $header = $request->header('Accept-Language', 'fr');

        $locales = explode(',', $header);
        $lang = strtolower(trim(explode(';', $locales[0])[0]));

        $locale = in_array($lang, self::SUPPORTED_LOCALES, true) ? $lang : 'fr';
        App::setLocale($locale);

        return $next($request);
    }
}
