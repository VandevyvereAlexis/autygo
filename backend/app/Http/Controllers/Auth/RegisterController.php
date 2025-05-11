<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;

class RegisterController extends Controller
{

    // Inscription d'un utilisateur
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Enregistrement de l'image
        $data['image'] = $request->hasFile('image')
            ? $request->file('image')->store('users', 'public')
            : 'users/default.jpg';

        // Hashage du mot de passe
        $data['password'] = Hash::make($data['password']);

        // Création de l'utilisateur
        $user = User::create($data);

        // Génère le token et l’enregistre
        $user->email_verification_token = Str::random(64);
        $user->save();

        // Envoi du mail
        Mail::to($user->email)->send(new VerifyEmail($user));

        // Authentification de l'utilisateur
        Auth::login($user);

        return response()->json([
            'message' => 'Inscription OK, un mail de vérification a été envoyé.',
            'user'    => $user->only('id','nom','prenom','pseudo','email','email_verification_token')
        ], Response::HTTP_CREATED);
    }

}
