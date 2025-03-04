<?php
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/p', [ServerController::class, 'index']);

Route::get('/create', function () {
    return view('createTournament.create');
});