<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnergieRequest;
use App\Http\Requests\UpdateEnergieRequest;
use App\Models\Energie;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EnergieController extends Controller
{

    // 1. Lister toutes les énergies
    public function index(): JsonResponse
    {
        $energies = Energie::all();
        return response()->json($energies);
    }


    // 2. Créer une nouvelle énergie
    public function store(StoreEnergieRequest $request): JsonResponse
    {
        $energie = Energie::create($request->validated());
        return response()->json($energie, 201);
    }


    // 3. Afficher une énergie spécifique
    public function show(Energie $energie): JsonResponse
    {
        return response()->json($energie);
    }


    // 4. Mettre à jour une énergie
    public function update(UpdateEnergieRequest $request, Energie $energie): JsonResponse
    {
        $energie->update($request->validated());
        return response()->json($energie);
    }


    // Supprimer une énergie
    public function destroy(Energie $energie): JsonResponse
    {
        $energie->delete();
        return response()->json(null, 204);
    }
}
