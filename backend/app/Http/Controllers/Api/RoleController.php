<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Role::class, 'role');
    }

    
    // 1. Lister tous les rôles
    public function index(): JsonResponse
    {
        $roles = Role::all();
        return response()->json($roles);
    }


    // 2. Créer un nouveau rôle
    public function store(StoreRoleRequest $request): JsonResponse
    {
        $role = Role::create($request->validated());
        return response()->json($role, 201);
    }


    // 3. Afficher un rôle
    public function show(Role $role): JsonResponse
    {
        return response()->json($role);
    }


    // 4. Mettre à jour un rôle existant
    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $role->update($request->validated());
        return response()->json($role);
    }


    // 5. Supprimer un rôle
    public function destroy(Role $role): JsonResponse
    {
        $role->delete();
        return response()->json(null, 204);
    }

}
