<?php
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('main.index');
});

// ADMIN
// por defecto cargaremos el panel del admin
Route::get('/admin', function () {
    return view('admin.admin-panel');
});
// CREATE REFEREE
Route::get('/admin/create-referee', function () {
    return view('admin.create-referee');
});
// ADD PLAYERS
Route::get('/admin/add-players', function () {
    return view('admin.add-players');
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

Route::get('/general', function () {
    return view('tables.generalTable');
});

Route::get('/global', function () {
    return view('tables.globalTable');
});