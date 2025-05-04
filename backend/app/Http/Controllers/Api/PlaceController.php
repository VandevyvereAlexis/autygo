<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PlaceController extends Controller
{

    // 1. Lister tous les nombres de places
    public function index(): JsonResponse
    {
        $places = Place::all();
        return response()->json($places);
    }


    // 2. Créer un nouveau nombre de places
    public function store(StorePlaceRequest $request): JsonResponse
    {
        $place = Place::create($request->validated());
        return response()->json($place, 201);
    }


    // 3. Afficher un nombre de places spécifique
    public function show(Place $place): JsonResponse
    {
        return response()->json($place);
    }


    // 4. Mettre à jour un nombre de places
    public function update(UpdatePlaceRequest $request, Place $place): JsonResponse
    {
        $place->update($request->validated());
        return response()->json($place);
    }


    // 5. Supprimer un nombre de places
    public function destroy(Place $place): JsonResponse
    {
        $place->delete();
        return response()->json(null, 204);
    }

}
