<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModeleRequest;
use App\Http\Requests\UpdateModeleRequest;
use App\Models\Modele;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ModeleController extends Controller
{

    public function __construct()
    {
        // Seules les méthodes index() et show() restent publiques
        $this->middleware('auth:sanctum')
             ->except(['index', 'show']);
    }


    // 1. Lister tous les modèles
    public function index(): JsonResponse
    {
        $modeles = Modele::with('marque')->get();
        return response()->json($modeles);
    }


    // 2. Créer un nouveau modèle
    public function store(StoreModeleRequest $request): JsonResponse
    {
        $modele = Modele::create($request->validated());
        return response()->json($modele->load('marque'), 201);
    }


    // 3. Afficher un modèle spécifique
    public function show(Modele $modele): JsonResponse
    {
        return response()->json($modele->load('marque'));
    }


    // 4. Mettre à jour un modèle
    public function update(UpdateModeleRequest $request, Modele $modele): JsonResponse
    {
        $modele->update($request->validated());
        return response()->json($modele->load('marque'));
    }


    // 5. Supprimer un modèle
    public function destroy(Modele $modele): JsonResponse
    {
        $modele->delete();
        return response()->json(null, 204);
    }

}
