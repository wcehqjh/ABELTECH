<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            if (!Auth::user()->is_admin) {
                Auth::logout();
                return back()->withErrors(['email' => 'Accès admin refusé.']);
            }
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    /**
     * Afficher le formulaire de mot de passe oublié
     */
    public function showForgotForm()
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Envoyer le lien de réinitialisation par email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Aucun compte trouvé avec cette adresse email.'
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Générer un token unique
        $token = Str::random(64);
        
        // Stocker le token dans la base de données
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );
        
        // Envoyer l'email
        try {
            Mail::send('emails.reset-password', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Réinitialisation de votre mot de passe - Abeltech');
                $message->from('no-reply@abeltech.ma', 'Abeltech Admin');
            });
            
            return back()->with('success', 'Un lien de réinitialisation a été envoyé à votre adresse email.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'envoi de l\'email. Veuillez réessayer.');
        }
    }

    /**
     * Afficher le formulaire de réinitialisation du mot de passe
     */
    public function showResetForm($token)
    {
        return view('admin.auth.reset-password', compact('token'));
    }

    /**
     * Réinitialiser le mot de passe
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);
        
        // Vérifier le token
        $resetRecord = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();
        
        if (!$resetRecord) {
            return back()->with('error', 'Token invalide ou expiré.');
        }
        
        // Vérifier si le token n'a pas expiré (24 heures)
        $tokenCreatedAt = \Carbon\Carbon::parse($resetRecord->created_at);
        if ($tokenCreatedAt->diffInHours(now()) > 24) {
            return back()->with('error', 'Le lien de réinitialisation a expiré.');
        }
        
        // Mettre à jour le mot de passe
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        
        // Supprimer le token
        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        
        return redirect()->route('admin.login')->with('success', 'Votre mot de passe a été réinitialisé avec succès.');
    }
}
