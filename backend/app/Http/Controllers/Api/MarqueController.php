<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMarqueRequest;
use App\Http\Requests\UpdateMarqueRequest;
use App\Models\Marque;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MarqueController extends Controller
{

    public function __construct()
    {
        // Seules les méthodes index() et show() restent publiques
        $this->middleware('auth:sanctum')
             ->except(['index', 'show']);
    }


    // 1. Lister toutes les marques
    public function index(): JsonResponse
    {
        $marques = Marque::all();
        return response()->json($marques);
    }


    // 2. Créer une nouvelle marque
    public function store(StoreMarqueRequest $request): JsonResponse
    {
        $marque = Marque::create($request->validated());
        return response()->json($marque, 201);
    }


    // 3. Afficher une marque
    public function show(Marque $marque): JsonResponse
    {
        return response()->json($marque);
    }


    // 4. Mettre à jour une marque
    public function update(UpdateMarqueRequest $request, Marque $marque): JsonResponse
    {
        $marque->update($request->validated());
        return response()->json($marque);
    }


    // 5. Supprimer une marque
    public function destroy(Marque $marque): JsonResponse
    {
        $marque->delete();
        return response()->json(null, 204);
    }

}
