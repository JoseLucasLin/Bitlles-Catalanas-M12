<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\MainController;
Route::get('/', function () {
    return view('main.index');
});



Route::get('/test', function () {
    return view('main.index');
});
//MAIN
Route::get('/', [MainController::class, 'index']);


// ADMIN
// por defecto cargaremos el panel del admin
Route::get('/admin', [AdminController::class, 'index']);

// CREATE REFEREE
Route::get('/admin/create-referee', [RefereeController::class, 'create']);

// CREATE PLAYER
Route::get('/admin/create-player', [PlayerController::class, 'create']);

// ADD PLAYERS
Route::get('/admin/add-players', function () {
    return view('admin.add-players');
});
// TOURNAMENT MANAGER
Route::get('/admin/tournament-manager', function () {
    return view('admin.tournament-manager');
});
// CREATE TOURNAMENT
Route::get('/admin/create-tournament', [TournamentController::class, 'create']) -> name('createTournament');

// POINTS MANAGER
Route::get('/admin/points-manager', function () {
    return view('admin.points-manager');
});

// LOGIN
Route::get('/login', function () {
    return view('layouts.login');
});






Route::get('/p', [ServerController::class, 'index']);


Route::get('/create', function () {
    return view('createTournament.create');
});


//ruta cambio idioma
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, config('app.available_locales'))) {
        session()->put('locale', $locale);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('locale.change');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/general', function () {
    return view('tables.generalTable');
});

Route::get('/global', function () {
    return view('tables.globalTable');
});

//ENVIO DE DATOS
//CREADOR DE TORNEOS
Route::post('/admin/create-tournament', [TournamentController::class, 'store']) -> name('submitTournament');

