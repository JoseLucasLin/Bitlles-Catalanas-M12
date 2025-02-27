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
Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/p', [ServerController::class, 'index']);

//ruta cambio idioma
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, config('app.available_locales'))) {
        session()->put('locale', $locale);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('locale.change');