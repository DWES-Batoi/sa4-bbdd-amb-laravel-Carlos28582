<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassificacioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| RUTES PÚBLIQUES (index)
|--------------------------------------------------------------------------
*/
Route::resource('equips', EquipController::class)->only(['index']);
Route::resource('estadis', EstadiController::class)->only(['index']);
Route::resource('jugadores', JugadoraController::class)
    ->only(['index'])
    ->parameters(['jugadores' => 'jugadora']);
Route::resource('partits', PartitController::class)->only(['index']);

Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
/*
|--------------------------------------------------------------------------
| RUTES PROTEGIDES (CRUD)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('equips', EquipController::class)->except(['index', 'show']);
    Route::resource('estadis', EstadiController::class)->except(['index', 'show']);

    Route::resource('jugadores', JugadoraController::class)
        ->parameters(['jugadores' => 'jugadora'])
        ->except(['index', 'show']);

    Route::resource('partits', PartitController::class)->except(['index', 'show']);
});


/*
|--------------------------------------------------------------------------
| RUTES PÚBLIQUES (show)
|--------------------------------------------------------------------------
*/
Route::resource('equips', EquipController::class)->only(['show']);
Route::resource('estadis', EstadiController::class)->only(['show']);
Route::resource('jugadores', JugadoraController::class)
    ->parameters(['jugadores' => 'jugadora'])
    ->only(['index', 'show']);
Route::resource('partits', PartitController::class)->only(['show']);

Route::get('/locale/{locale}', function (string $locale) {
    $available = ['ca', 'es', 'en'];

    if (!in_array($locale, $available, true)) {
        $locale = config('app.fallback_locale', 'en');
    }

    Session::put('locale', $locale);

    return redirect()->back();
})->name('setLocale');
Route::middleware(['auth', 'not.convidat'])->group(function () {
    Route::resource('equips', EquipController::class)->except(['index', 'show']);
    Route::resource('jugadores', JugadoraController::class)->except(['index', 'show']);
    // ...altres recursos d’escriptura
});

Route::get('/classificacio', [ClassificacioController::class, 'index'])
    ->name('classificacio.index');
    
require __DIR__.'/auth.php';
