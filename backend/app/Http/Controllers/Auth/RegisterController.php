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

        // Authentification de l'utilisateur
        Auth::login($user);

        return response()->json([
            'message' => 'Inscription réussie.',
            'user' => $user
        ], Response::HTTP_CREATED);
    }

}
