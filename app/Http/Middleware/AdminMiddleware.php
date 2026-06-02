<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Vérifie que l'utilisateur est connecté via le guard admin
     *
     * Ce middleware protège toutes les routes admin pour s'assurer
     * qu'un utilisateur non connecté ou non admin ne puisse pas accéder.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'admin est connecté via le guard 'admin'
        if (!Auth::guard('admin')->check()) {
            // Redirige vers la page de login admin si non connecté
            return redirect()->route('admin.login');
        }

        // Si connecté, continue la requête
        return $next($request);
    }
}