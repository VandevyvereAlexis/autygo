<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateProfilePasswordRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    // 1. Récupère l’utilisateur connecté
    public function show(Request $request): JsonResponse
    {
        $user = $request->user()->load('role');
        return response()->json($user);
    }


    // 2. Met à jour son profil (nom, email, image…)
    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = $request->user();
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $data['image'] = $request->file('image')->store('users', 'public');
        }

        $user->update($data);
        return response()->json($user->fresh()->load('role'));
    }


    // 3. Change son propre mot de passe
    public function updatePassword(UpdateProfilePasswordRequest $request): JsonResponse
    {
        $user = $request->user();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json([
            'message' => 'Mot de passe mis à jour avec succès.'
        ], 200);
    }

}
