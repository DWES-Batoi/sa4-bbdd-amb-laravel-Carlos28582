<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JugadoraController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PartitController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Autenticación
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// API con nombre
Route::name('api.')->group(function () {
    // Endpoints públicos (lectura)
    Route::apiResource('jugadores', JugadoraController::class)
        ->only(['index', 'show'])
        ->parameters(['jugadores' => 'jugadora']);
    
    // Endpoints protegidos (escritura)
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('jugadores', JugadoraController::class)
            ->except(['index', 'show'])
            ->parameters(['jugadores' => 'jugadora']);
    });
    Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('partits', PartitController::class)
        ->parameters(['partits' => 'partit'])
        ->except(['index', 'show']);
});
Route::apiResource('partits', PartitController::class)
    ->parameters(['partits' => 'partit'])
    ->only(['index', 'show']);
});