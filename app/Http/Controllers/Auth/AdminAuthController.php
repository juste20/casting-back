<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin;
use Carbon\Carbon;

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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Identifiants invalides.',
        ])->withInput();
    }

    /**
     * Demande de reinitialisation du mot de passe
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin) {
            $token = Str::random(64);
            \DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $admin->email],
                [
                    'token' => Hash::make($token),
                    'created_at' => Carbon::now(),
                ]
            );

            \Illuminate\Support\Facades\Mail::raw(
                "Voici votre lien de reinitialisation : " . route('admin.password.reset', $token),
                function ($m) use ($admin) {
                    $m->to($admin->email)
                      ->subject('Reinitialisation du mot de passe - Casting.net');
                }
            );
        }

        return back()->with('status', 'Si cet email existe, un lien de reinitialisation a ete envoye.');
    }

    /**
     * Affiche le formulaire de reinitialisation
     */
    public function showResetForm(Request $request, string $token)
    {
        return view('admin.auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Traite la reinitialisation du mot de passe
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $resetToken = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetToken || !Hash::check($request->token, $resetToken->token)) {
            return back()->withErrors(['email' => 'Token invalide ou expire.']);
        }

        if (Carbon::parse($resetToken->created_at)->addMinutes(60)->isPast()) {
            return back()->withErrors(['email' => 'Le token a expire. Veuillez en demander un nouveau.']);
        }

        $admin = Admin::where('email', $request->email)->first();
        $admin->password = $request->password;
        $admin->save();

        \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect()->route('admin.login')->with('status', 'Mot de passe reinitialise avec succes.');
    }

    /**
     * API: Demande de reinitialisation (JSON)
     */
    public function forgotPasswordApi(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin) {
            $token = Str::random(64);
            \DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $admin->email],
                [
                    'token' => Hash::make($token),
                    'created_at' => Carbon::now(),
                ]
            );
        }

        return response()->json([
            'message' => 'Si cet email existe, un lien de reinitialisation a ete envoye.'
        ]);
    }

    /**
     * API: Reinitialisation (JSON)
     */
    public function resetPasswordApi(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $resetToken = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetToken || !Hash::check($request->token, $resetToken->token)) {
            return response()->json(['message' => 'Token invalide ou expire.'], 400);
        }

        if (Carbon::parse($resetToken->created_at)->addMinutes(60)->isPast()) {
            return response()->json(['message' => 'Le token a expire.'], 400);
        }

        $admin = Admin::where('email', $request->email)->first();
        $admin->password = $request->password;
        $admin->save();

        \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return response()->json(['message' => 'Mot de passe reinitialise avec succes.']);
    }

    /**
     * Déconnecte l'utilisateur admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
