<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class ApiAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Non authentifie.'], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json(['message' => 'Token invalide.'], 401);
        }

        if ($accessToken->expires_at && now()->gt($accessToken->expires_at)) {
            return response()->json(['message' => 'Token expire.'], 401);
        }

        $tokenable = $accessToken->tokenable;

        if (!$tokenable || !$tokenable instanceof \App\Models\Admin) {
            return response()->json(['message' => 'Acces non autorise.'], 403);
        }

        if (!$accessToken->can('admin')) {
            return response()->json(['message' => 'Permission insuffisante.'], 403);
        }

        Auth::guard('admin')->login($tokenable);

        return $next($request);
    }
}
