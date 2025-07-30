<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScoreController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/scores', [ScoreController::class, 'index']);
Route::post('/scores', [ScoreController::class, 'store']);

Route::get('/scores/{game_name}', [ScoreController::class, 'showByGame']);
// Route::get('/scores/{game_name}', [App\Http\Controllers\Api\ScoreController::class, 'showByGame']);