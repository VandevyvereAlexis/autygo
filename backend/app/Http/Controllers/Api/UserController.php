<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdatePasswordRequest;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(User::class, 'user');
    }

    

    // Lister tous les utilisateurs
    public function index(): JsonResponse
    {
        $users = User::with('role')->paginate(10);
        return response()->json($users);
    }



    // Créer un utilisateur
    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('users', 'public');
        }

        $user = User::create($data);
        return response()->json($user->load('role'), 201);
    }



    // Afficher un utilisateur
    public function show(User $user): JsonResponse
    {
        return response()->json($user->load('role'));
    }



    // Mettre à jour un ou plusieurs champs 
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $data['image'] = $request->file('image')->store('users', 'public');
        }

        $user->update($data);
        return response()->json($user->load('role'));
    }



    // Supprimer un utilisateur
    public function destroy(User $user): JsonResponse
    {
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
        return response()->json(null, 204);
    }



    // Changer le mot de passe
    public function changePassword(UpdatePasswordRequest $request, User $user): JsonResponse
    {
        $user->password = $request->validated()['password'];
        $user->save();

        return response()->json([
            'message' => 'Mot de passe mis à jour avec succès.'
        ]);
    }

}
