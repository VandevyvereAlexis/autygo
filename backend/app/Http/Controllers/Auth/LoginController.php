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
    * Connexion de l'utilisateur (cookie-based).
    */
    public function login(LoginRequest $request)
    {
        // 1. Tente d'authentifier et de créer un cookie de session
        if (! Auth::attempt($request->only('email', 'password'), true)) {
            return response()->json(
                ['error' => 'Identifiants incorrects.'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        // 2. Régénère la session pour éviter la fixation de session
        $request->session()->regenerate();

        // 3. Récupère l'utilisateur connecté avec sa relation role
        $user = User::with('role')->find(Auth::id());

        // 4. Prépare la réponse avec un indicateur de vérification
        $response = [
            'message' => 'Connexion réussie',
            'user'    => $user,
        ];

        // 5. Ajoute un message si l'email n'est pas vérifié
        if (is_null($user->email_verified_at)) {
            $response['warning'] = 'Votre adresse e-mail n\'est pas encore vérifiée. Certaines fonctionnalités peuvent être limitées.';
            $response['email_verified'] = false;
        } else {
            $response['email_verified'] = true;
        }

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Déconnexion de l'utilisateur.
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
     * Retourne l'utilisateur authentifié.
     * Utile pour le frontend après rechargement de page.
     */
    public function me(Request $request)
    {
        if (Auth::check()) {
            // Charger la relation role
            $user = User::with('role')->find(Auth::id());
            
            return response()->json([
                'user' => $user,
            ], Response::HTTP_OK);
        }
        
        return response()->json([
            'user' => null,
        ], Response::HTTP_UNAUTHORIZED);
    }
}