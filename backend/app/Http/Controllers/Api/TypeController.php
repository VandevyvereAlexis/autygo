<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TypeController extends Controller
{

    public function __construct()
    {
        // Seules les méthodes index() et show() restent publiques
        $this->middleware('auth:sanctum')
             ->except(['index', 'show']);
    }


    // 1. Lister tous les types
    public function index(): JsonResponse
    {
        $types = Type::all();
        return response()->json($types);
    }


    // 2. Créer un nouveau type
    public function store(StoreTypeRequest $request): JsonResponse
    {
        // On prend uniquement les données validées
        $type = Type::create($request->validated());
        return response()->json($type, 201);
    }


    // 3. Afficher un type spécifique
    public function show(Type $type): JsonResponse
    {
        return response()->json($type);
    }


    // 4. Mettre à jour un type
    public function update(UpdateTypeRequest $request, Type $type): JsonResponse
    {
        $type->update($request->validated());
        return response()->json($type);
    }


    // 5. Supprimer un type
    public function destroy(Type $type): JsonResponse
    {
        $type->delete();
        return response()->json(null, 204);
    }

}
