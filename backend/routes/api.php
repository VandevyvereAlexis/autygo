<?php

use App\Http\Controllers\Api\EnergieController;
use App\Http\Controllers\Api\MarqueController;
use App\Http\Controllers\Api\ModeleController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TransmissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('roles', RoleController::class);
Route::apiResource('marques', MarqueController::class);
Route::apiResource('modeles', ModeleController::class);
Route::apiResource('energies', EnergieController::class)->parameters(['energies' => 'energie']);
Route::apiResource('transmissions', TransmissionController::class);