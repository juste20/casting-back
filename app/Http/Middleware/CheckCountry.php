<?php

namespace App\Http\Middleware;

use Closure;

class CheckCountry
{
    private const ALLOWED_COUNTRIES = ['BJ','BF','CI','GW','ML','NE','SN','TG'];

    public function handle($request, Closure $next)
    {
        $ip = $request->ip();

        $countryFromIp = $this->getCountryFromIp($ip);

        if ($countryFromIp && !in_array($countryFromIp, self::ALLOWED_COUNTRIES)) {
            return response()->json(['error' => 'Pays non autorise'], 403);
        }

        return $next($request);
    }

    private function getCountryFromIp(?string $ip): ?string
    {
        if (!$ip || $ip === '127.0.0.1' || $ip === '::1') {
            return null;
        }

        $country = cache()->remember("geo_{$ip}", 86400, function () use ($ip) {
            try {
                $response = @file_get_contents("http://ip-api.com/json/{$ip}?fields=countryCode");
                if ($response) {
                    $data = json_decode($response, true);
                    return $data['countryCode'] ?? null;
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::warning('GeoIP lookup failed for IP: ' . $ip);
            }
            return null;
        });

        return $country;
    }
}
