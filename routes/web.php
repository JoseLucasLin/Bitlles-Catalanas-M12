<?php
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\MainController;

// Rutas principales accesibles para todos
Route::get('/', [MainController::class, 'index']);


// Rutas de prueba
Route::get('/perro', function () {
    return view('createTournament.create');
});

Route::get('/test', function () {
    return view('main.index');
});


// ADMIN
Route::get('/admin', function () {
    return view('admin.admin-panel'); 
})->middleware(['auth']); // Proteger con autenticación

// CREATE REFEREE
Route::post('/admin/create-referee',[RegisteredUserController::class, 'store'])->middleware(['auth'])->name("registro"); //RegisteredUserController [RegisteredUserController::class, 'index'] view('admin.create-referee') ;
Route::get('/admin/create-referee',[RegisteredUserController::class, 'index'])->middleware(['auth'])->name("registro.store"); //RegisteredUserController [RegisteredUserController::class, 'index'] view('admin.create-referee') ;

// ADD PLAYERS
Route::get('/admin/add-players', function () {
    return view('admin.add-players');
})->middleware(['auth']);

// CREATE PLAYER
Route::get('/admin/create-player', function () {
    return view('admin.create-player');
});
// ADD PLAYERS
Route::get('/admin/add-players', function () {
    return view('admin.add-players');
});
// TOURNAMENT MANAGER
Route::get('/admin/tournament-manager', function () {
    return view('admin.tournament-manager');
});
// POINTS MANAGER
Route::get('/admin/points-manager', function () {
    return view('admin.points-manager');
});

// LOGIN
Route::get('/login', function () {
    return view('layouts.login');
});

// CAMBIAR IDIOMA

// Rutas para cambio de idioma

Route::get('language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, config('app.available_locales'))) {
        session()->put('locale', $locale);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('locale.change');

// Rutas públicas de prueba
Route::get('/test', function () {
    return view('main.index');
});

// Rutas para administradores (role:2)
Route::middleware(['auth', 'role:2'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.admin-panel');
    });
    Route::get('/create-referee', function () {
        return view('admin.create-referee');
    });
    Route::get('/add-players', function () {
        return view('admin.add-players');
    });
    Route::get('/create-player', function () {
        return view('admin.create-player');
    });
    Route::get('/tournament-manager', function () {
        return view('admin.tournament-manager');
    });
});

// Rutas para árbitros (role:1)
Route::middleware(['auth', 'role:1'])->prefix('admin')->group(function () {
    Route::get('/points-manager', function () {
        return view('admin.points-manager');
    });
    // Otras rutas específicas para árbitros
});

// Rutas accesibles para cualquier usuario autenticado
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas de perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Otras rutas que requieren autenticación pero no roles específicos
    Route::get('/general', function () {
        return view('tables.generalTable');
    });

    Route::get('/global', function () {
        return view('tables.globalTable');
    });
});

// Rutas de autenticación para invitados (no autenticados)
Route::middleware('guest')->group(function () {
    // Registro
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Recuperación de contraseña
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

// Rutas para verificación de email y otras operaciones de autenticación
Route::middleware('auth')->group(function () {
    // Verificación de email
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    // Confirmación y cambio de contraseña
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

// Rutas misceláneas
Route::get('/create', function () {
    return view('createTournament.create');
});

Route::get('/p', [ServerController::class, 'index']);
