@extends('admin.index')

@section('content')

<?php header('Access-Control-Allow-Origin: *');?>
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">@lang('admin.tournament_management')</h2>
    </div>

    <div class="bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
        <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">@lang('admin.select_tournament')</h3>

        <select id="tournament-selector" class="w-full p-2 border border-gray-300 rounded">
            @if($tournaments->isEmpty())
                <option disabled>No hay torneos disponibles</option>
            @else

                @foreach($tournaments as $tournament)
                    <option value="{{ $tournament->id }}" {{ $tournament->id == $selectedTournament->id ? 'selected' : '' }}>
                        {{ $tournament->name .($tournament->start_date!=null?$tournament."  Activado":$tournament."  Desactivado")}}
                    </option>
                @endforeach
            @endif

        </select>
    </div>

    @if($tournamentInfo)
    <div id="tournament-info" class="mt-6 bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
        <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">@lang('admin.tournament_info')</h3>
        <p class="text-sm text-gray-600"><strong>@lang('admin.available_courts'):</strong> <span id="available-courts">{{ $tournamentInfo['availableCourts'] }}</span></p>
        <p class="text-sm text-gray-600"><strong>@lang('admin.registered_players'):</strong> <span id="registered-players">{{ $tournamentInfo['registeredPlayers'] }}</span></p>
        <p class="text-sm text-gray-600"><strong>@lang('admin.current_round'):</strong> <span id="current-round">{{ $tournamentInfo['currentRound'] }}</span></p>
        <p class="text-sm text-gray-600"><strong>@lang('admin.status'):</strong>
            <span id="tournament-status">
                @if($tournamentInfo['isFinished'])
                    <span class="text-green-600 font-semibold">Finalizado</span>
                @elseif($tournamentInfo['isStarted'])
                    <span class="text-blue-600 font-semibold">En progreso</span>
                @else
                    <span class="text-yellow-600 font-semibold">No iniciado</span>
                @endif
            </span>
        </p>
    </div>

    <div class="mt-8 mb-4">
        <div>
        </div>
        <h3 class="text-lg font-semibold text-[var(--azul)] mb-2">@lang('admin.registered_players_list')</h3>
        <div class="bg-[var(--crema)] p-4 rounded-lg border-[var(--azul)] border">
            <table class="w-full">
                <thead class="bg-[var(--azul)] text-[var(--blanco)]">
                    <tr>
                        <th class="p-2 text-left">@lang('admin.name')</th>
                        <th class="p-2 text-center">@lang('admin.stats')</th>
                    </tr>
                </thead>
                <tbody id="players-list">
                    @if($tournamentInfo['registeredPlayers'] > 0)
                        @foreach(App\Models\Stats_Player_Tournament::where('id_tournament', $selectedTournament->id)->get() as $playerStats)
                            <tr>
                                <td class="p-2 border-b">{{ $playerStats->player->name }} {{ $playerStats->player->lastname }}</td>
                                <td class="p-2 border-b text-center">
                                    <span class="text-sm">@lang('admin.points'): {{ $playerStats->total_points }}</span> |
                                    <span class="text-sm">@lang('admin.accuracy'): {{ $playerStats->accuracy }}%</span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2" class="p-4 text-center text-gray-500">No hay jugadores registrados en este torneo</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-2 text-right">
            <a href="{{ route('admin.add-players') }}" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold">
                @lang('admin.add_players')
            </a>
        </div>
    </div>



    <div class="mt-6 bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
        <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">listado de jugadores</h3>
        <p class="text-sm text-gray-600"><strong>@lang('admin.available_courts'):</strong> 5</p>
        <p class="text-sm text-gray-600"><strong>@lang('admin.registered_players'):</strong> 32</p>
        <p class="text-sm text-gray-600"><strong>@lang('admin.current_round'):</strong> 2</p>
    </div>




    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">

        <button id="start-tournament" class="bg-[var(--rojo)] text-[var(--blanco)] p-3 rounded-lg transition duration-300 hover:bg-[var(--azul)] font-bold flex items-center justify-center space-x-2"
                {{ $tournamentInfo['isStarted'] ? 'disabled' : '' }}>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
            </svg>
            <span>@lang('admin.start')</span>
        </button>
        <button id="resolve-tie" class="bg-[var(--rojo)] text-[var(--blanco)] p-3 rounded-lg transition duration-300 hover:bg-[var(--azul)] font-bold flex items-center justify-center space-x-2"
                {{ !$tournamentInfo['isStarted'] ? 'disabled' : '' }}>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 1 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712l.003-2.024a.668.668 0 0 1 .198-.471 1.575 1.575 0 1 0-2.228-2.228 3.818 3.818 0 0 0-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0 1 16.35 15m.002 0h-.002" />
            </svg>
            <span>@lang('admin.resolve_tie')</span>
        </button>
        <button id="modify-tournament" class="bg-[var(--rojo)] text-[var(--blanco)] p-3 rounded-lg transition duration-300 hover:bg-[var(--azul)] font-bold flex items-center justify-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
            </svg>
            <span>@lang('admin.modify')</span>
        </button>
           
        <button id="next-round" class="bg-[var(--rojo)] text-[var(--blanco)] p-3 rounded-lg transition duration-300 hover:bg-[var(--azul)] font-bold flex items-center justify-center space-x-2"
                {{ !$tournamentInfo['isStarted'] ? 'disabled' : '' }}>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3" />
            </svg>
            <span>@lang('admin.next_round')</span>
        </button>
    </div>

    


    @else
    <div class="mt-6 bg-yellow-100 p-6 shadow-xl rounded-lg border border-yellow-400">
        <h3 class="text-lg font-semibold text-yellow-700 mb-4">No hay torneos disponibles</h3>
        <p class="text-sm text-yellow-600">Por favor, crea un torneo primero antes de usar esta función.</p>
        <div class="mt-4">
            <a href="" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded-lg transition duration-300 hover:bg-[var(--azul)] font-bold">
                @lang('admin.create_tournament')
            </a>
        </div>
    </div>
    @endif
</main>
<script>
    const userId = "{{ auth()->user()->id }}";
</script>
<script type="module">
    import { io } from 'https://cdn.socket.io/4.3.2/socket.io.esm.min.js'
    const socket = io('http://localhost:8100');
    
    document.addEventListener("DOMContentLoaded", async () => {
        getList();
        setupStartButton();
        
        // Load tournament info immediately if channel exists in localStorage
        const storedChannel = localStorage.getItem('canal');
        if (storedChannel) {
            fetchTournamentInfo(storedChannel);
        }
    });

    
    function getList() {
        console.log("Enviando getTournaments");
        socket.emit('getTournaments', { 
            user: "token", 
            mensaje: "listar" 
        });
    }
    
    function setupStartButton() {
        const startBtn = document.getElementById('start-tournament');
        
        startBtn.addEventListener('click', () => {
            const selectedChannel = document.getElementById('tournament-selector').value;
            
            if (selectedChannel === 'NOT CONNECTED') {
                alert('Por favor selecciona un canal primero');
                return;
            }
            
            const storedChannel = localStorage.getItem('canal');
            if (selectedChannel !== storedChannel) {
                alert('El canal seleccionado no coincide con el almacenado');
                return;
            }
            
            startBtn.disabled = true;
            startBtn.classList.add('opacity-50', 'cursor-not-allowed');
            startBtn.textContent = 'Iniciando...';
            
            socket.emit('activateTournament', {
                channelId: selectedChannel,
                userId: "ID_REAL_USUARIO"
            });
        });
    }
    
    // New function to handle tournament info fetching
    function fetchTournamentInfo(channelId) {
        fetch(`/tournaments/${channelId}/info`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log("Datos del torneo recibidos:", data);
                if (data.success) {
                    const btn = document.getElementById("start-tournament");
                    const tournament = data.data.tournament;
    
                    // Reset to base classes
                    btn.className = "bg-[var(--rojo)] text-[var(--blanco)] p-3 rounded-lg transition duration-300 hover:bg-[var(--azul)] font-bold flex items-center justify-center space-x-2";
    
                    if (tournament.start_date === null) {
                        // Enable button
                        btn.classList.remove("opacity-50", "cursor-not-allowed");
                        btn.disabled = false;
                    } else {
                        // Disable button
                        btn.classList.add("opacity-50", "cursor-not-allowed");
                        btn.disabled = true;
                    }
                    console.table(tournament.start_date);
                } else {
                    throw new Error(data.message || "Error desconocido al cargar datos del torneo");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', error.message);
            });
    }
    
    socket.on('tournamentStarted', (response) => {
        const startBtn = document.getElementById('start-tournament');
        
        if (response.success) {
            startBtn.textContent = 'Torneo Iniciado';
            showNotification('success', 'Torneo iniciado correctamente');
            // Reload page after successful start
            setTimeout(() => window.location.reload(), 1500);
        } else {
            resetStartButton();
            showNotification('error', response.message || 'Error al iniciar torneo');
        }
    });
    
    function resetStartButton() {
        const startBtn = document.getElementById('start-tournament');
        startBtn.disabled = false;
        startBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        startBtn.textContent = 'Iniciar Torneo';
    }
    
    function showNotification(type, message) {
        alert(`${type.toUpperCase()}: ${message}`);
    }
    
    socket.on('connection', (e) => {
        console.log('Estado de conexión:', e);
    });
    
    socket.on('getChanels', (e) => {
        console.log('Canales recibidos:', e.result);
        populateSelect(e.result);
    
        const selectorCanal = document.getElementById("tournament-selector");
        let canal = localStorage.getItem('canal') || e.result[0]?.id;
        
        if (canal) {
            selectorCanal.value = canal;
            connecToChanel(canal);
            localStorage.setItem('canal', canal);
            // Fetch tournament info when channels are received
            fetchTournamentInfo(canal);
        }
        
        selectorCanal.addEventListener("change", (e) => {
            const newChannel = e.target.value;
            console.log('Canal cambiado a:', newChannel);
            localStorage.setItem("canal", newChannel);
            connecToChanel(newChannel);
            fetchTournamentInfo(newChannel);
        });
    });
    
    function connecToChanel(canal) {
        if (!canal) return;
        console.log('Uniéndose al canal:', canal);
        socket.emit('joinChannel', canal);
    }
    
    function populateSelect(result) {
        const select = document.getElementById('tournament-selector');
        select.innerHTML = '<option>NOT CONNECTED</option>';
    
        if (!result || !result.length) return;
        
        result.forEach((item) => {
            let option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name + (item.start_date ? " Activado" : " Desactivado");
            select.appendChild(option);
        });
    }

document.addEventListener('DOMContentLoaded', function() {
    // Manejar cambio de torneo seleccionado
    const tournamentSelector = document.getElementById('tournament-selector');
    if (tournamentSelector) {
        tournamentSelector.addEventListener('change', function() {
            const tournamentId = this.value;
            if (tournamentId) {
                // Mostrar indicador de carga sin eliminar la estructura
                const availableCourtsElement = document.getElementById('available-courts');
                const registeredPlayersElement = document.getElementById('registered-players');
                const currentRoundElement = document.getElementById('current-round');
                const statusElement = document.getElementById('tournament-status');

                if (availableCourtsElement) availableCourtsElement.textContent = 'Cargando...';
                if (registeredPlayersElement) registeredPlayersElement.textContent = 'Cargando...';
                if (currentRoundElement) currentRoundElement.textContent = 'Cargando...';
                if (statusElement) statusElement.innerHTML = '<span class="text-gray-500 font-semibold">Cargando...</span>';

                const playersListDiv = document.getElementById('players-list');
                if (playersListDiv) {
                    playersListDiv.innerHTML = '<tr><td colspan="2" class="text-center p-4"><span class="font-semibold text-[var(--azul)]">Cargando jugadores...</span></td></tr>';
                }

                // Cargar datos del torneo
                loadTournamentInfo(tournamentId);
            }
        });
    }

    // Iniciar torneo
    const startTournamentBtn = document.getElementById('start-tournament');
    if (startTournamentBtn) {
        startTournamentBtn.addEventListener('click', function() {
            const tournamentId = tournamentSelector.value;
            startTournament(tournamentId);
        });
    }

    // Resolver empates
    const resolveTieBtn = document.getElementById('resolve-tie');
    if (resolveTieBtn) {
        resolveTieBtn.addEventListener('click', function() {
            const tournamentId = tournamentSelector.value;
            resolveTie(tournamentId);
        });
    }

    // Modificar torneo
    const modifyTournamentBtn = document.getElementById('modify-tournament');
    if (modifyTournamentBtn) {
        modifyTournamentBtn.addEventListener('click', function() {
            const tournamentId = tournamentSelector.value;
            window.location.href = `/admin/tournaments/${tournamentId}/edit`;
        });
    }

    // Siguiente ronda
    const nextRoundBtn = document.getElementById('next-round');
    if (nextRoundBtn) {
        nextRoundBtn.addEventListener('click', function() {
            const tournamentId = tournamentSelector.value;
            nextRound(tournamentId);
        });
    }

    // Inicializar la carga si hay un torneo seleccionado al cargar la página
    if (tournamentSelector && tournamentSelector.value) {
        loadTournamentInfo(tournamentSelector.value);
    }

    // Cargar información del torneo
    function loadTournamentInfo(tournamentId) {
        console.log("Cargando información del torneo: " + tournamentId);

        // Cargar información del torneo (datos básicos)
        fetch(`/tournaments/${tournamentId}/info`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log("Datos del torneo recibidos:", data);
                if (data.success) {
                    updateTournamentInfo(data.data);
                    updateButtonStates(data.data);

                    // Ahora cargar la lista de jugadores
                    return fetch(`/admin/tournaments/${tournamentId}/players`);
                } else {
                    throw new Error(data.message || "Error desconocido al cargar datos del torneo");
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor (jugadores): ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log("Datos de jugadores recibidos:", data);
                if (data.success) {
                    updatePlayersListFromData(data.players);
                } else {
                    throw new Error(data.message || "Error desconocido al cargar jugadores");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('tournament-info').innerHTML = `
                    <div class="p-4 bg-red-100 text-red-700 rounded">
                        <p class="font-semibold">Error al cargar la información</p>
                        <p class="text-sm">${error.message}</p>
                    </div>
                `;
                document.getElementById('players-list').innerHTML = `
                    <tr>
                        <td colspan="2" class="p-4 text-center text-red-500">Error al cargar los jugadores: ${error.message}</td>
                    </tr>
                `;
            });
    }

    // Actualizar información del torneo en la UI
    function updateTournamentInfo(info) {
        // Verificar que cada elemento existe antes de actualizar su contenido
        const availableCourtsElement = document.getElementById('available-courts');
        const registeredPlayersElement = document.getElementById('registered-players');
        const currentRoundElement = document.getElementById('current-round');
        const statusElement = document.getElementById('tournament-status');

        if (availableCourtsElement) {
            availableCourtsElement.textContent = info.availableCourts;
        }

        if (registeredPlayersElement) {
            registeredPlayersElement.textContent = info.registeredPlayers;
        }

        if (currentRoundElement) {
            currentRoundElement.textContent = info.currentRound;
        }

        if (statusElement) {
            if (info.isFinished) {
                statusElement.innerHTML = '<span class="text-green-600 font-semibold">Finalizado</span>';
            } else if (info.isStarted) {
                statusElement.innerHTML = '<span class="text-blue-600 font-semibold">En progreso</span>';
            } else {
                statusElement.innerHTML = '<span class="text-yellow-600 font-semibold">No iniciado</span>';
            }
        }
    }

    // Añade esta función después de updateTournamentInfo
    function updatePlayersListFromData(players) {
        const playersList = document.getElementById('players-list');
        playersList.innerHTML = '';

        if (players && players.length > 0) {
            players.forEach(player => {
                playersList.innerHTML += `
                    <tr>
                        <td class="p-2 border-b">${player.name} ${player.lastname}</td>
                        <td class="p-2 border-b text-center">
                            <span class="text-sm">Puntos: ${player.stats.total_points}</span> |
                            <span class="text-sm">Precisión: ${player.stats.accuracy}%</span>
                        </td>
                    </tr>
                `;
            });
        } else {
            playersList.innerHTML = `
                <tr>
                    <td colspan="2" class="p-4 text-center text-gray-500">No hay jugadores registrados en este torneo</td>
                </tr>
            `;
        }
    }

    // Actualizar la lista de jugadores
    function updatePlayersList(tournamentId) {
        console.log("Actualizando lista de jugadores para torneo: " + tournamentId);
        fetch(`/admin/tournaments/${tournamentId}/players`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log("Jugadores recibidos:", data);
            if (data.success) {
                const playersList = document.getElementById('players-list');
                playersList.innerHTML = '';

                if (data.players && data.players.length > 0) {
                    data.players.forEach(player => {
                        playersList.innerHTML += `
                            <tr>
                                <td class="p-2 border-b">${player.name} ${player.lastname}</td>
                                <td class="p-2 border-b text-center">
                                    <span class="text-sm">@lang('admin.points'): ${player.stats.total_points}</span> |
                                    <span class="text-sm">@lang('admin.accuracy'): ${player.stats.accuracy}%</span>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    playersList.innerHTML = `
                        <tr>
                            <td colspan="2" class="p-4 text-center text-gray-500">No hay jugadores registrados en este torneo</td>
                        </tr>
                    `;
                }
            } else {
                console.error("Error en la respuesta de jugadores:", data);
            }
        })
        .catch(error => {
            console.error('Error al cargar jugadores:', error);
            const playersList = document.getElementById('players-list');
            playersList.innerHTML = `
                <tr>
                    <td colspan="2" class="p-4 text-center text-red-500">Error al cargar los jugadores</td>
                </tr>
            `;
        });
    }

    // Actualizar estado de los botones según el estado del torneo
    function updateButtonStates(info) {
        document.getElementById('start-tournament').disabled = info.isStarted;
        document.getElementById('resolve-tie').disabled = !info.isStarted;
        document.getElementById('next-round').disabled = !info.isStarted;
    }

    
    

    // Pasar a la siguiente ronda
    function nextRound(tournamentId) {
        if (!confirm('¿Estás seguro de que quieres avanzar a la siguiente ronda?')) {
            return;
        }
const nextRoundNumber = document.getElementById("current-round");
const currentNumber = parseInt(nextRoundNumber.textContent);

if (!isNaN(currentNumber)) {
    const nextNumber = currentNumber + 1;
    
    // Actualiza el DOM
    nextRoundNumber.textContent = nextNumber;
    
    // Emitir el nuevo número de ronda
    socket.emit('nextRound2', {
        channelId: tournamentId,
        nextRound: nextNumber
    });
} else {
    console.warn("El número actual de ronda no es válido");
}
    }

    // Resolver empates
    function resolveTie(tournamentId) {
        fetch(`/tournaments/${tournamentId}/resolve-tie`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                updateTournamentInfo(data.data);
                updatePlayersList(tournamentId);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ha ocurrido un error al resolver los empates.');
        });
    }
});
</script>

@endsection