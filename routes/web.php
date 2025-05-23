<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\PlayerController;
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
use App\Http\Controllers\Auth\RegisteredPlayerController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PlayerSearchController;
use App\Http\Controllers\AddPlayersController;

use App\Mail\MailableLogin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

// Rutas principales accesibles para todos
Route::get('/', [MainController::class, 'index']);
Route::get('player-acces', function (){
    return view('auth.player-acces');
 })->name('player.acces');

// Rutas de prueba


Route::get('/test', function () {
    return view('main.index');
});

//general
Route::get('/general', function () {
    // Tu lógica actual para procesar los datos
    $filePath = public_path('sample_data2.json');

    if (!File::exists($filePath)) {
        abort(500, 'El archivo JSON no se encuentra');
    }

    $jsonData = File::get($filePath);
    $tournamentData = json_decode($jsonData, true);

    if (json_last_error() !== JSON_ERROR_NONE || !isset($tournamentData['matches'])) {
        abort(500, 'Error en el formato del JSON');
    }

    // Procesar todos los jugadores (tu lógica actual)
    $allPlayers = collect($tournamentData['matches'])
        ->pluck('players')
        ->flatten(1)
        ->map(function($player) {
            $totalAcumulado = collect($player['rounds'])->sum('total');

            $acumulado = 0;
            $rounds = collect($player['rounds'])->map(function($round) use (&$acumulado) {
                $acumulado += $round['total'];
                $round['acumulado'] = $acumulado;
                return $round;
            });

            return [
                'id' => $player['id'],
                'name' => $player['name'],
                'status' => $player['status'],
                'rounds' => $rounds->toArray(),
                'total_acumulado' => $totalAcumulado
            ];
        })
        ->sortByDesc('total_acumulado')
        ->values()
        ->all();

    $maxRounds = collect($allPlayers)->max(function($player) {
        return count($player['rounds']);
    });

    // Si se solicita PDF
    if (request()->has('export') && request('export') == 'pdf') {
        $pdf = Pdf::loadView('tables.exportPDF', [
            'allPlayers' => $allPlayers,
            'maxRounds' => $maxRounds
        ]);

        return $pdf->download('resultados_torneo.pdf');
    }

    return view('tables.generalTable', [
        'allPlayers' => $allPlayers,
        'maxRounds' => $maxRounds
    ]);
});

// ADMIN
Route::get('/admin', function () {
    return view('admin.admin-panel');
})->middleware(['auth']); // Proteger con autenticación
// REFEREE
Route::get('/referee', function () {
    return view('referee.referee-panel');
})->middleware(['auth']); // Proteger con autenticación

// CREATE REFEREE
Route::post('/admin/create-referee',[RegisteredUserController::class, 'store'])->middleware(['auth'])->name("registro.store"); //RegisteredUserController [RegisteredUserController::class, 'index'] view('admin.create-referee') ;
Route::get('/admin/create-referee',[RegisteredUserController::class, 'index'])->middleware(['auth'])->name("registro.store"); //RegisteredUserController [RegisteredUserController::class, 'index'] view('admin.create-referee') ;

// ADD PLAYERS
Route::get('/admin/add-players', function () {
    return view('admin.add-players');
})->middleware(['auth']);

Route::get('/admin/players-fields', function () {
    return view('admin.players-fields');
})->middleware(['auth'])->name('admin.players-fields');

// TOURNAMENT MANAGER
Route::get('/admin/tournament-manager', function () {
    return view('admin.tournament-manager');
});

Route::middleware(['auth', 'role:2'])->prefix('admin')->group(function () {
    Route::get('/add-players', [App\Http\Controllers\AddPlayersController::class, 'index'])->name('admin.add-players');
    Route::post('/players/assign', [App\Http\Controllers\AddPlayersController::class, 'assignPlayer'])->name('admin.players.assign');
    Route::delete('/players/remove/{id}', [App\Http\Controllers\AddPlayersController::class, 'removePlayer'])->name('admin.players.remove');
    Route::post('/referees/assign', [App\Http\Controllers\AddPlayersController::class, 'assignReferee'])->name('admin.referees.assign');


});


// Rutas para el gestor de torneos
Route::middleware(['auth', 'role:2'])->prefix('admin')->group(function () {
    // Vista principal de gestión de torneos

    Route::get('/admin/tournament-manager', [App\Http\Controllers\TournamentManagerController::class, 'index'])
    ->name('admin.tournament-manager');



    // Obtener jugadores del torneo
    Route::get('/tournaments/{id}/players', [App\Http\Controllers\TournamentManagerController::class, 'getTournamentPlayers']);

    // Iniciar torneo
    Route::post('/tournaments/{id}/start', [App\Http\Controllers\TournamentManagerController::class, 'startTournament']);

    // Avanzar a la siguiente ronda
    Route::post('/tournaments/{id}/next-round', [App\Http\Controllers\TournamentManagerController::class, 'nextRound']);

    // Resolver empates
    Route::post('/tournaments/{id}/resolve-tie', [App\Http\Controllers\TournamentManagerController::class, 'resolveTie']);

    // Editar torneo
    Route::get('/tournaments/{id}/edit', [App\Http\Controllers\TournamentManagerController::class, 'edit'])
        ->name('admin.tournaments.edit');
});



    Route::get('/tournaments/{id}/info', [App\Http\Controllers\TournamentManagerController::class, 'showTournament']);
// CREATE TOURNAMENT
Route::get('/admin/create-tournament', [TournamentController::class, 'create']) -> name('createTournament');

// CREATE PLAYER
Route::get('/admin/create-player', [PlayerController::class, 'create']);

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
    //Route::get('/add-players', [AddPlayersController::class, 'index'])->name('admin.add-players');
    //Route::post('/assign-player', [AddPlayersController::class, 'assignPlayer'])->name('admin.assign-player');
    //Route::delete('/remove-player/{id}', [AddPlayersController::class, 'removePlayer'])->name('admin.remove-player');
    Route::get('/create-player', [RegisteredPlayerController::class, 'index'])->name('create-player');
    Route::post('/create-player', [RegisteredPlayerController::class, 'store'])->name('create-player.store');


    // Rutas de búsqueda de jugadores
    Route::get('/player-search', [PlayerSearchController::class, 'index'])->name('admin.player-search');

    // Rutas para gestionar jugadores
    Route::get('/edit-player/{id}', [PlayerController::class, 'edit'])->name('admin.edit-player');
    Route::put('/update-player/{id}', [PlayerController::class, 'update'])->name('admin.update-player');

    // Ruta para enviar código por correo
    Route::post('/send-player-code/{id}', [PlayerController::class, 'sendCode'])->name('admin.send-player-code');

    Route::get('/players-fields', [App\Http\Controllers\FieldPlayerDistributionController::class, 'index'])->name('admin.players-fields');
    Route::get('/tournaments/{tournamentId}/courts', [App\Http\Controllers\FieldPlayerDistributionController::class, 'getCourts'])->name('admin.tournaments.courts');
    Route::get('/tournaments/{tournamentId}/available-players', [App\Http\Controllers\FieldPlayerDistributionController::class, 'getPlayers'])->name('admin.tournaments.players');
    Route::post('/tournaments/distribute-players', [App\Http\Controllers\FieldPlayerDistributionController::class, 'distribute'])->name('admin.tournaments.distribute');
    Route::get('/tournaments/{tournamentId}/current-distributions', [App\Http\Controllers\FieldPlayerDistributionController::class, 'getCurrentDistributions'])->name('admin.tournaments.current-distributions');



});
Route::get('/tournaments/{tournamentId}/current-round', [App\Http\Controllers\FieldPlayerDistributionController::class, 'getCurrentRound'])->name('admin.tournaments.current-round');
    Route::get('/tournaments/{tournamentId}/fields/{fieldId}/players', [App\Http\Controllers\FieldPlayerDistributionController::class, 'getPlayersForField'])->name('admin.tournaments.fields.players');
    Route::get('/tournaments/{tournamentId}/players-with-fields', [App\Http\Controllers\FieldPlayerDistributionController::class, 'getTournamentPlayersWithFields'])->name('admin.tournaments.players-with-fields');
    Route::get('/tournaments/{tournamentId}/players-scores', [App\Http\Controllers\FieldPlayerDistributionController::class, 'getPlayerScores'])->name('admin.tournaments.players-scores');
    Route::post('/tournaments/{tournamentId}/fields/{fieldId}/players/{playerId}/status', [App\Http\Controllers\FieldPlayerDistributionController::class, 'updatePlayerStatus'])->name('admin.tournaments.player-status');
// Rutas para árbitros (role:1)
Route::middleware(['auth', 'role:1'])->prefix('referee')->group(function () {
    Route::get('/', function () {
        return view('referee.referee-panel');
    });
    Route::get('/points-manager', function () {
        return view('referee.points-manager');
    });
    // Otras rutas específicas para árbitros
});


Route::get('/emailpro', function() {
    $name = "client";

    // The email sending is done using the to method on the Mail facade
    Mail::to('agonzalez9@inscamidemar.cat')->send(new MailableLogin($name));
});
// Rutas accesibles para cualquier usuario autenticado
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view ('main.index');
    })->name('dashboard');

    // Rutas de perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Otras rutas que requieren autenticación pero no roles específicos



});
 Route::get('/global', function () {
        // Ruta al archivo en public
        $filePath = public_path('sample_data.json');

        // Verificar que el archivo existe
        if (!File::exists($filePath)) {
            abort(500, 'El archivo JSON no se encuentra');
        }

        // Leer el archivo
        $jsonData = File::get($filePath);
        $matchData = json_decode($jsonData, true);

        // Verificar que el JSON es válido
        if (json_last_error() !== JSON_ERROR_NONE || !isset($matchData['matches'])) {
            abort(500, 'Error en el formato del JSON');
        }

        // Combinar todos los jugadores de todos los campos
        $allPlayers = collect($matchData['matches'])
            ->pluck('players')
            ->flatten(1)
            ->all();

        return view('tables.globalTable', [
            'allPlayers' => $allPlayers
        ]);
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
    Route::get('/forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

    Route::post('/forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

    Route::post('/reset-password', [App\Http\Controllers\Auth\NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');
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
//ENVIO DE DATOS
//CREADOR DE TORNEOS
Route::post('/admin/create-tournament', [TournamentController::class, 'store']) -> name('submitTournament');

//API
Route::get('/api/players/{id}', [PlayerSearchController::class, 'getPlayerDetails'])->name('api.player.details');

// Agregar en routes/web.php
Route::post('/player/verify', [App\Http\Controllers\PlayerDashBoardController::class, 'verify'])->name('player.verify');
Route::get('/player/dashboard/{id}', [App\Http\Controllers\PlayerDashBoardController::class, 'show'])->name('player.dashboard');

Route::get('/admin/tournament-manager', [App\Http\Controllers\TournamentManagerController::class, 'index'])
    ->name('admin.tournament-manager');


