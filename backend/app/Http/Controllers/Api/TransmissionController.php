<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransmissionRequest;
use App\Http\Requests\UpdateTransmissionRequest;
use App\Models\Transmission;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TransmissionController extends Controller
{

    public function __construct()
    {
        // Pas d'auth ni de policy sur index/show (publics)
        $this->middleware('auth:sanctum')
             ->except(['index', 'show']);

        // Lier create/update/delete à TransmissionPolicy
        $this->authorizeResource(
            Transmission::class,
            'transmission',
            ['except' => ['index', 'show']]
        );
    }


    // 1. Lister toutes les transmissions
    public function index(): JsonResponse
    {
        $transmissions = Transmission::all();
        return response()->json($transmissions);
    }


    // 2. Créer une nouvelle transmission
    public function store(StoreTransmissionRequest $request): JsonResponse
    {
        $transmission = Transmission::create($request->validated());
        return response()->json($transmission, 201);
    }


    // 3. Afficher une transmission spécifique
    public function show(Transmission $transmission): JsonResponse
    {
        return response()->json($transmission);
    }


    // 4. Mettre à jour une transmission
    public function update(UpdateTransmissionRequest $request, Transmission $transmission): JsonResponse
    {
        $transmission->update($request->validated());
        return response()->json($transmission);
    }


    // 5. Supprimer une transmission
    public function destroy(Transmission $transmission): JsonResponse
    {
        $transmission->delete();
        return response()->json(null, 204);
    }

}
