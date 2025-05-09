@extends('admin.index')

@section('content')

<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{__('admin.assign_players_to_courts')}}</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 max-w-xl mx-auto" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 max-w-xl mx-auto" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form id="distributionForm" class="max-w-xl mx-auto">
        @csrf

        <div class="mb-4">
            <label for="tournament" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.select_tournament')}}</label>
            <select id="tournament" name="tournament_id" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                <option value="" disabled selected>{{__('admin.select_tournament')}}</option>
                @foreach($tournaments as $tournament)
                    <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-center mt-10">
            <button type="button" id="distributeBtn" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                {{__('admin.distribute_players')}}
            </button>
        </div>
    </form>

    <!-- Lista de jugadores inscritos -->
    <div class="mt-10 max-w-xl mx-auto">
        <div class="text-center mb-6">
            <h3 class="text-xl font-bold text-[var(--azul)]">{{__('admin.registered_players_list')}}</h3>
        </div>
        <div id="players-list" class="bg-[var(--crema)] p-4 rounded-lg border border-[var(--azul)]">
            <div class="text-center text-gray-500">
                {{__('admin.select_tournament_to_view_players')}}
            </div>
        </div>
    </div>

    <div class="mt-10">
        <div class="text-center mb-6">
            <h3 class="text-xl font-bold text-[var(--azul)]">{{__('admin.tournament_courts')}}</h3>
            <p id="tournament-name" class="text-lg text-[var(--azul)] mt-2"></p>
        </div>

        <div id="courts-container" class="space-y-8">
            <div class="text-center text-gray-500">
                {{__('admin.select_tournament_to_view_courts')}}
            </div>
        </div>
    </div>

    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50" id="loadingOverlay">
        <div class="bg-white p-5 rounded-lg shadow-xl">
            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-[var(--azul)] mx-auto"></div>
            <p class="mt-3 text-center">{{__('admin.processing')}}</p>
        </div>
    </div>

    <div class="mt-10 text-center">
        <button type="button" id="saveDistributionBtn" class="hidden bg-[var(--azul)] text-[var(--blanco)] px-6 py-3 rounded transition duration-300 hover:bg-[var(--rojo)] font-bold hover:scale-105">
            {{__('admin.save_distribution')}}
        </button>
    </div>
</main>

<script>
    // Variables globales
    let courtsData = [];
    let playersData = [];
    let currentDistribution = {};

    // Cuando el documento está listo
    document.addEventListener('DOMContentLoaded', function() {
        // Eventos para el formulario
        document.getElementById('tournament').addEventListener('change', loadTournamentData);
        document.getElementById('distributeBtn').addEventListener('click', distributePlayers);
        document.getElementById('saveDistributionBtn').addEventListener('click', saveDistribution);
    });

    // Función para cargar datos del torneo (pistas y jugadores)
    function loadTournamentData() {
        const tournamentId = document.getElementById('tournament').value;
        if (!tournamentId) return;

        // Mostrar indicador de carga
        document.getElementById('loadingOverlay').classList.replace('hidden', 'flex');

        // Obtener el nombre del torneo y mostrarlo
        const tournamentName = document.querySelector(`#tournament option[value='${tournamentId}']`).textContent;
        document.getElementById('tournament-name').textContent = tournamentName;

        // Cargar las pistas
        fetch(`/admin/tournaments/${tournamentId}/courts`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    courtsData = data.courts;
                    renderCourts(courtsData);

                    // Verificar si ya hay distribuciones existentes
                    checkExistingDistributions(tournamentId);
                } else {
                    alert(data.message || '{{__("admin.error_loading_courts")}}');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('{{__("admin.error_loading_courts")}}');
            });

        // Cargar jugadores disponibles
        fetch(`/admin/tournaments/${tournamentId}/available-players`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    playersData = data.players;
                    renderPlayersList(playersData);
                } else {
                    alert(data.message || '{{__("admin.error_loading_players")}}');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('{{__("admin.error_loading_players")}}');
            })
            .finally(() => {
                // Ocultar indicador de carga
                document.getElementById('loadingOverlay').classList.replace('flex', 'hidden');
            });
    }

    // Función para verificar distribuciones existentes
    function checkExistingDistributions(tournamentId) {
        fetch(`/admin/tournaments/${tournamentId}/current-distributions`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log("Distribuciones recibidas:", data); // Para depuración

                if (data.success && data.hasDistributions) {
                    // Inicializar la distribución actual
                    currentDistribution = {
                        tournament_id: tournamentId,
                        distributions: []
                    };

                    // Recorrer cada pista con sus jugadores asignados
                    data.distributions.forEach(dist => {
                        const courtId = dist.court_id;
                        const players = dist.players;
                        const playersList = document.getElementById(`court-${courtId}-players`);

                        // Crear la distribución en el objeto currentDistribution
                        const courtDistribution = {
                            court_id: courtId,
                            player_ids: []
                        };
                        currentDistribution.distributions.push(courtDistribution);

                        // Si existe el elemento de la lista de jugadores para esta pista
                        if (playersList) {
                            // Limpiar la lista actual
                            playersList.innerHTML = '';

                            // Si hay jugadores asignados, mostrarlos
                            if (players && players.length > 0) {
                                players.forEach(player => {
                                    // Crear fila para cada jugador
                                    const row = document.createElement('tr');
                                    row.innerHTML = `
                                        <td class="p-2 border-b border-[var(--azul)]">${player.name} ${player.lastname}</td>
                                        <td class="p-2 border-b border-[var(--azul)]">
                                            <button type="button" onclick="removePlayerFromCourt(this, ${courtId}, ${player.id})" class="text-red-500">{{__('admin.remove')}}</button>
                                        </td>
                                    `;
                                    playersList.appendChild(row);

                                    // Agregar el ID del jugador a la distribución actual
                                    courtDistribution.player_ids.push(parseInt(player.id));
                                });
                            } else {
                                // Si no hay jugadores, mostrar mensaje
                                playersList.innerHTML = `
                                    <tr>
                                        <td colspan="2" class="p-2 text-center text-gray-500">{{__('admin.no_players_assigned')}}</td>
                                    </tr>
                                `;
                            }
                        }
                    });

                    // Mostrar el botón de guardar ya que hay distribuciones existentes
                    document.getElementById('saveDistributionBtn').classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Función para renderizar la lista de jugadores
    function renderPlayersList(players) {
        const container = document.getElementById('players-list');
        container.innerHTML = '';

        if (players.length === 0) {
            container.innerHTML = `
                <div class="text-center text-gray-500">
                    {{__('admin.no_players_registered')}}
                </div>
            `;
            return;
        }

        const table = document.createElement('table');
        table.className = 'w-full border border-[var(--azul)]';

        // Crear encabezados de tabla
        const thead = document.createElement('thead');
        thead.innerHTML = `
            <tr class="bg-[var(--azul)] text-[var(--blanco)]">
                <th class="p-2 text-left">{{__('admin.player')}}</th>
            </tr>
        `;
        table.appendChild(thead);

        // Crear cuerpo de tabla
        const tbody = document.createElement('tbody');
        players.forEach(player => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="p-2 border-b border-[var(--azul)]">${player.name} ${player.lastname}</td>
            `;
            tbody.appendChild(row);
        });

        table.appendChild(tbody);
        container.appendChild(table);
    }

    // Función para renderizar las pistas
    function renderCourts(courts) {
        const container = document.getElementById('courts-container');
        container.innerHTML = '';

        if (courts.length === 0) {
            container.innerHTML = `
                <div class="text-center text-gray-500">
                    {{__('admin.no_courts_available')}}
                </div>
            `;
            return;
        }

        courts.forEach(court => {
            const courtDiv = document.createElement('div');
            courtDiv.className = 'bg-[var(--crema)] p-4 rounded-lg border border-[var(--azul)]';

            courtDiv.innerHTML = `
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-bold text-[var(--azul)]">${court.name}</h4>
                </div>
                <table class="w-full border border-[var(--azul)]">
                    <thead>
                        <tr class="bg-[var(--azul)] text-[var(--blanco)]">
                            <th class="p-2">{{__('admin.player')}}</th>
                            <th class="p-2">{{__('admin.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody id="court-${court.id}-players">
                        <tr>
                            <td colspan="2" class="p-2 text-center text-gray-500">{{__('admin.no_players_assigned')}}</td>
                        </tr>
                    </tbody>
                </table>
            `;

            container.appendChild(courtDiv);
        });
    }

    // Función para distribuir jugadores
    function distributePlayers() {
        const tournamentId = document.getElementById('tournament').value;
        if (!tournamentId) {
            alert("{{__('admin.select_tournament_first')}}");
            return;
        }

        if (playersData.length === 0) {
            alert("{{__('admin.no_players_registered')}}");
            return;
        }

        if (courtsData.length === 0) {
            alert("{{__('admin.no_courts_available_for_tournament')}}");
            return;
        }

        // Limpiar distribuciones anteriores
        currentDistribution = {
            tournament_id: tournamentId,
            distributions: []
        };

        // Inicializar distribuciones para cada pista
        courtsData.forEach(court => {
            currentDistribution.distributions.push({
                court_id: court.id,
                player_ids: []
            });

            const playersList = document.getElementById(`court-${court.id}-players`);
            playersList.innerHTML = `
                <tr>
                    <td colspan="2" class="p-2 text-center text-gray-500">{{__('admin.no_players_assigned')}}</td>
                </tr>
            `;
        });

        const playersPerCourt = Math.floor(playersData.length / courtsData.length);
        let extraPlayers = playersData.length % courtsData.length;

        let playerIndex = 0;

        courtsData.forEach((court, courtIndex) => {
            const playersList = document.getElementById(`court-${court.id}-players`);
            const courtDistribution = currentDistribution.distributions.find(d => d.court_id === court.id);

            if (playersList.firstElementChild && playersList.firstElementChild.getAttribute('colspan')) {
                playersList.innerHTML = '';
            }

            let playersForThisCourt = playersPerCourt;
            if (extraPlayers > 0) {
                playersForThisCourt++;
                extraPlayers--;
            }

            for (let i = 0; i < playersForThisCourt && playerIndex < playersData.length; i++) {
                const player = playersData[playerIndex];
                const playerId = player.id;
                const playerName = `${player.name} ${player.lastname}`;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="p-2 border-b border-[var(--azul)]">${playerName}</td>
                    <td class="p-2 border-b border-[var(--azul)]">
                        <button type="button" onclick="removePlayerFromCourt(this, ${court.id}, ${playerId})" class="text-red-500">{{__('admin.remove')}}</button>
                    </td>
                `;

                playersList.appendChild(row);
                courtDistribution.player_ids.push(parseInt(playerId));
                playerIndex++;
            }
        });

        // Mostrar botón de guardar
        document.getElementById('saveDistributionBtn').classList.remove('hidden');
    }

    // Función para quitar un jugador de una pista
    function removePlayerFromCourt(button, courtId, playerId) {
        // Eliminar la fila
        const row = button.parentElement.parentElement;
        row.remove();

        // Actualizar la distribución actual
        const courtDistIndex = currentDistribution.distributions.findIndex(d => d.court_id === courtId);
        if (courtDistIndex !== -1) {
            const playerIdIndex = currentDistribution.distributions[courtDistIndex].player_ids.indexOf(playerId);
            if (playerIdIndex !== -1) {
                currentDistribution.distributions[courtDistIndex].player_ids.splice(playerIdIndex, 1);
            }
        }

        // Si no quedan jugadores, mostrar mensaje
        const playersList = document.getElementById(`court-${courtId}-players`);
        if (playersList.children.length === 0) {
            playersList.innerHTML = `
                <tr>
                    <td colspan="2" class="p-2 text-center text-gray-500">{{__('admin.no_players_assigned')}}</td>
                </tr>
            `;
        }
    }

    // Función para guardar la distribución
    function saveDistribution() {
        // Verificar que haya algo para guardar
        if (!currentDistribution.tournament_id || !currentDistribution.distributions.length) {
            alert('{{__("admin.no_distribution_to_save")}}');
            return;
        }

        // Mostrar indicador de carga
        document.getElementById('loadingOverlay').classList.replace('hidden', 'flex');

        // Enviar la distribución al servidor
        fetch('{{ route("admin.tournaments.distribute") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(currentDistribution)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message || '{{__("admin.distribution_saved")}}');
            } else {
                alert(data.message || '{{__("admin.error_saving_distribution")}}');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('{{__("admin.error_saving_distribution")}}');
        })
        .finally(() => {
            // Ocultar indicador de carga
            document.getElementById('loadingOverlay').classList.replace('flex', 'hidden');
        });
    }
</script>
@endsection
