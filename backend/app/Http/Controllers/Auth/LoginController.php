<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
     /**
     * Connexion de l’utilisateur (cookie-based).
     */
    public function login(LoginRequest $request)
    {
        // 1. On charge l'utilisateur via son e-mail
        $user = User::where('email', $request->input('email'))->first();

        // 2. Si trouvé et pas encore vérifié → 403
        if ($user && is_null($user->email_verified_at)) {
            return response()->json([
                'error' => 'Vous devez d’abord vérifier votre adresse e-mail.'
            ], Response::HTTP_FORBIDDEN);
        }

        // 3. Tente d'authentifier et de créer un cookie de session
        if (! Auth::attempt($request->only('email', 'password'), true)) {
            return response()->json(
                ['error' => 'Identifiants incorrects.'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        // 4. Régénère la session pour éviter la fixation de session
        $request->session()->regenerate();

        return response()->json([
            'message' => 'Connexion réussie',
            'user'    => Auth::user(),
        ], Response::HTTP_OK);
    }

    /**
     * Déconnexion de l’utilisateur.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Déconnexion réussie',
        ], Response::HTTP_OK);
    }

    /**
     * Retourne l’utilisateur authentifié.
     * Utile pour le frontend après rechargement de page.
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ], Response::HTTP_OK);
    }
}
