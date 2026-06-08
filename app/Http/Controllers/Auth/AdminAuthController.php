<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

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
     * API login (Vue JS)
     */
    public function loginApi(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();

        if (!$admin || !Auth::guard('admin')->attempt($credentials)) {
            return response()->json(['message' => 'Identifiants invalides.'], 401);
        }

        $token = $admin->createToken('admin-token', ['admin'])->plainTextToken;

        return response()->json([
            'token' => $token,
            'admin' => ['name' => $admin->name, 'email' => $admin->email]
        ]);
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
