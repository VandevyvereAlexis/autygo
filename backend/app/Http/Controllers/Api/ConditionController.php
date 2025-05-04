<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConditionRequest;
use App\Http\Requests\UpdateConditionRequest;
use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ConditionController extends Controller
{

    // 1. Lister toutes les conditions
    public function index(): JsonResponse
    {
        $conditions = Condition::all();
        return response()->json($conditions);
    }


    // 2. Créer une nouvelle condition
    public function store(StoreConditionRequest $request): JsonResponse
    {
        $condition = Condition::create($request->validated());
        return response()->json($condition, 201);
    }


    // 3. Afficher une condition spécifique
    public function show(Condition $condition): JsonResponse
    {
        return response()->json($condition);
    }


    // 4. Mettre à jour une condition
    public function update(UpdateConditionRequest $request, Condition $condition): JsonResponse
    {
        $condition->update($request->validated());
        return response()->json($condition);
    }


    // 5. Supprimer une condition
    public function destroy(Condition $condition): JsonResponse
    {
        $condition->delete();
        return response()->json(null, 204);
    }

}
