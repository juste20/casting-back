<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Détermine où rediriger les utilisateurs non authentifiés.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo(Request $request)
    {
        // Si la requête ne s'attend pas à du JSON,
        // redirige vers une route nommée "login".
        if (! $request->expectsJson()) {
            return route('admin.login');
        }

        // Sinon retourne null (résultat JSON 401 par défaut)
        return null;
    }
}
