<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('characters', [CharacterController::class, 'addCharacter']);
    Route::get('characters', [CharacterController::class, 'listCharacters']);
    Route::get('charactersApi', [CharacterController::class, 'listApiCharacters']);
    Route::delete('characters/{id}', [CharacterController::class, 'deleteCharacter']);
});
