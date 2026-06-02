<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion admin
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Traite la tentative de connexion
     */
    public function login(Request $request)
    {
        // Validation
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentative de connexion avec le guard admin (si configuré)
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate(); // sécurité
            return redirect()->route('admin.dashboard');
        }

        // Si échec, retourne à la page de login avec erreur
        return back()->withErrors([
            'email' => 'Identifiants invalides.',
        ])->withInput();
    }

    /**
     * Déconnecte l’utilisateur admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
