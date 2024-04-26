<?php

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/desa-list', [MainController::class,"villageList"]);
Route::get('/desa/{id}', [MainController::class,"village"]);
Route::post('/desa', [MainController::class,"addVillage"]);
Route::put('/desa/{id}', [MainController::class,"updateVillage"]);
Route::delete('/desa/{id}', [MainController::class,"deleteDesa"]);
