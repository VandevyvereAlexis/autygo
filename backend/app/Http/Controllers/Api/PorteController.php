<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePorteRequest;
use App\Http\Requests\UpdatePorteRequest;
use App\Models\Porte;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PorteController extends Controller
{

    public function __construct()
    {
        // Pas d'auth ni policy sur index/show (publics)
        $this->middleware('auth:sanctum')
            ->except(['index', 'show']);

        // Policy sur store/update/destroy
        $this->authorizeResource(
            Porte::class,
            'porte',
            ['except' => ['index', 'show']]
        );
    }


    // 1. Lister toutes les portes
    public function index(): JsonResponse
    {
        $portes = Porte::all();
        return response()->json($portes);
    }


    // 2. Créer une nouvelle porte
    public function store(StorePorteRequest $request): JsonResponse
    {
        $porte = Porte::create($request->validated());
        return response()->json($porte, 201);
    }


    // 3. Afficher une porte spécifique
    public function show(Porte $porte): JsonResponse
    {
        return response()->json($porte);
    }


    // 4. Mettre à jour une porte
    public function update(UpdatePorteRequest $request, Porte $porte): JsonResponse
    {
        $porte->update($request->validated());
        return response()->json($porte);
    }


    // 5. Supprimer une porte
    public function destroy(Porte $porte): JsonResponse
    {
        $porte->delete();
        return response()->json(null, 204);
    }

}
