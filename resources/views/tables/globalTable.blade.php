@extends('admin.index')
@section('content')
    <main class="flex-1 ms-10 me-10">
        <h1 class="text-2xl font-bold text-[var(--azul)] mb-4">Todos los Jugadores</h1>
        <select id="chanelTournament" class="w-full p-2 border border-gray-300 rounded">

            <option disabled>No hay torneos disponibles</option>


        </select>
<table id="scoreTable" class="w-full border-collapse border border-gray-300 mb-8">
    <thead>
        <tr class="bg-gray-200">
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Nº</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Jugador</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Campo</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">1</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">2</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">3</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">T1</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">1</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">2</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">3</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">T2</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-white bg-[#BE1622]">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allPlayers as $index => $player)
            @php
                // Obtener el campo del jugador
                $playerField = '';
                foreach (json_decode(File::get(public_path('sample_data.json')), true)['matches'] as $match) {
                    foreach ($match['players'] as $p) {
                        if ($p['id'] == $player['id']) {
                            $playerField = $match['field'];
                            break 2;
                        }
                    }
                }

                $latestRound = count($player['rounds']) > 0 ? $player['rounds'][count($player['rounds']) - 1] : null;

                // Determinar la clase de color según el estado
                $nameColorClass = '';
                switch ($player['status']) {
                    case 'playing_next':
                        $nameColorClass = 'bg-green-300';
                        break;
                    case 'preparing':
                        $nameColorClass = 'bg-yellow-200';
                        break;
                    case 'collecting':
                        $nameColorClass = 'bg-red-400';
                        break;
                    default:
                        $nameColorClass = 'bg-gray-200';
                }
            @endphp

            <tr data-player-id="{{ $player['id'] }}">
                <td class="border border-[var(--azul)] p-2 text-center">{{ $index + 1 }}</td>
                <td class="border border-[var(--azul)] p-2 {{ $nameColorClass }}">{{ $player['name'] }}</td>
                <td class="border border-[var(--azul)] p-2 text-center">{{ $playerField }}</td>

                @if($latestRound)
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t1'][0] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t1'][1] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t1'][2] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['total_t1'] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t2'][0] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t2'][1] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t2'][2] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['total_t2'] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['total'] ?? ' ' }}</td>
                @else
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                     <td class="border border-[var(--azul)] p-2 text-center"></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

        <div class="flex flex-row justify-center mt-4">
            <p class="bg-green-300 p-1 m-2 border rounded-md">Próximo a jugar</p>
            <p class="bg-yellow-200 p-1 m-2 border rounded-md">Se prepara</p>
            <p class="bg-red-400 p-1 m-2 border rounded-md">Recoge</p>
            <p class="bg-gray-200 p-1 m-2 border rounded-md">En espera</p>
        </div>
    </main>
    <script type="module">
        import { io } from 'https://cdn.socket.io/4.3.2/socket.io.esm.min.js';
        const socket = io('http://localhost:8100');

        // Variables globales
        let players = [];

        // Función para convertir tabla a array (movida fuera del DOMContentLoaded)
        function tableToArray() {
            let table = document.getElementById('scoreTable');
            if (!table) {
                console.error('La tabla no se encuentra');
                return [];
            }

            let rows = table.querySelectorAll('tbody tr');
            if (!rows.length) {
                console.error('No hay filas en el tbody de la tabla');
                return [];
            }

            let tableData = [];

            rows.forEach(row => {
                const playerId = row.getAttribute('data-player-id');
                let cells = row.querySelectorAll('td');

                if (!cells.length || cells.length < 12) return; // Asegurarse de que hay suficientes celdas

                let rowData = {
                    id: playerId, // Añadir el ID del jugador para búsqueda más fácil
                    number: cells[0].textContent.trim(), // Número
                    player: cells[1].textContent.trim(), // Jugador
                    field: cells[2].textContent.trim(), // Campo
                    throws1: [
                        cells[3].textContent.trim() || "0",
                        cells[4].textContent.trim() || "0",
                        cells[5].textContent.trim() || "0"
                    ],
                    t1Total: parseInt(cells[6].textContent.trim()) || 0,
                    throws2: [
                        cells[7].textContent.trim() || "0",
                        cells[8].textContent.trim() || "0",
                        cells[9].textContent.trim() || "0"
                    ],
                    t2Total: parseInt(cells[10].textContent.trim()) || 0,
                    total: parseInt(cells[11].textContent.trim()) || 0
                };

                tableData.push(rowData);
            });

            return tableData;
        }

        // Función para actualizar la tabla con los nuevos datos del jugador (movida fuera del DOMContentLoaded)
        function updatePlayerTable(playerId, newData) {
            // Encuentra la fila correspondiente al jugador con el ID
            const row = document.querySelector(`#scoreTable tbody tr[data-player-id="${playerId}"]`);
            if (!row) {
                console.warn(`Jugador con ID ${playerId} no encontrado en la tabla`);
                return;
            }

            // Encuentra todas las celdas de la fila
            const cells = row.querySelectorAll('td');
            if (cells.length < 12) {
                console.error("La fila del jugador no tiene suficientes celdas");
                return;
            }

            // Obtener la ronda actual para saber qué celdas actualizar
            let currentRound = parseInt(document.querySelector('[data-current-round]')?.textContent) || 1;

            // Actualizar los valores según la ronda
            if (currentRound === 1) {
                // Actualiza la sección de la ronda 1 (t1)
                cells[3].textContent = newData.t1[0] || '0';  // Primer lanzamiento T1
                cells[4].textContent = newData.t1[1] || '0';  // Segundo lanzamiento T1
                cells[5].textContent = newData.t1[2] || '0';  // Tercer lanzamiento T1
                cells[6].textContent = newData.total_t1 || '0'; // Total T1
            } else if (currentRound === 2) {
                // Actualiza la sección de la ronda 2 (t2)
                cells[7].textContent = newData.t2[0] || '0';  // Primer lanzamiento T2
                cells[8].textContent = newData.t2[1] || '0';  // Segundo lanzamiento T2
                cells[9].textContent = newData.t2[2] || '0';  // Tercer lanzamiento T2
                cells[10].textContent = newData.total_t2 || '0'; // Total T2
            }

            // Siempre actualiza el total general
            cells[11].textContent = newData.total || '0';

            // Añadir una clase para resaltar temporalmente la actualización
            row.classList.add('bg-yellow-100');

            // Remover la clase después de un momento
            setTimeout(() => {
                row.classList.remove('bg-yellow-100');
            }, 1500);
        }

        document.addEventListener("DOMContentLoaded", async () => {
            getList();

            // Load tournament info immediately if channel exists in localStorage
            const storedChannel = localStorage.getItem('canal');
            if (storedChannel) {
                fetchTournamentInfo(storedChannel);
                fetchCurrentRound(storedChannel);

                // Cargar jugadores iniciales
                loadAllPlayersFromAPI(storedChannel);
            }
        });

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
                        console.table(data.tournament?.start_date || data);
                    } else {
                        throw new Error(data.message || "Error desconocido al cargar datos del torneo");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('error', error.message);
                });
        }

        function getList() {
            console.log("Enviando getTournaments");
            socket.emit('getTournaments', {
                user: "token",
                mensaje: "listar"
            });
        }

        // ==== Popular el selector ====
        function populateSelect(result) {
            const select = document.getElementById('chanelTournament');
            select.innerHTML = '';

            if (!result || !result.length) {
                select.innerHTML = '<option disabled>No hay torneos disponibles</option>';
                return;
            }

            result.forEach((item) => {
                let option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.name;
                select.appendChild(option);
            });
        }

        socket.on('getChanels', (e) => {
            console.log('Canales recibidos:', e.result);
            populateSelect(e.result);

            const selectorCanal = document.getElementById("chanelTournament");
            let canal = localStorage.getItem('canal') || e.result[0]?.id;

            if (canal) {
                selectorCanal.value = canal;
                connecToChanel(canal);
                localStorage.setItem('canal', canal);
                fetchTournamentInfo(canal);
                fetchCurrentRound(canal);
                // Cargar jugadores cuando se carga la página
                loadAllPlayersFromAPI(canal);
            }

            selectorCanal.addEventListener("change", (e) => {
                const newChannel = e.target.value;
                console.log('Canal cambiado a:', newChannel);
                localStorage.setItem("canal", newChannel);
                connecToChanel(newChannel);
                fetchTournamentInfo(newChannel);
                fetchCurrentRound(newChannel);

                // Cargar jugadores cuando cambia el canal
                loadAllPlayersFromAPI(newChannel);
            });
        });

        function connecToChanel(canal) {
            if (!canal) return;
            console.log('Uniéndose al canal:', canal);
            socket.emit('joinChannel', canal);
        }

        function fetchCurrentRound(tournamentId) {
            fetch(`/tournaments/${tournamentId}/current-round`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.current_round !== undefined) {
                        document.querySelectorAll('[data-current-round]').forEach(el => {
                            el.textContent = data.current_round;
                        });
                    }
                })
                .catch(err => console.error("Error obteniendo la ronda actual:", err));
        }

        socket.on('submitScore', (data) => {
            console.log("Score recibido:", data);

            // Buscar al jugador en el array de players usando el ID
            let playerToUpdate = players.find(player => player.id === data.player);

            if (playerToUpdate) {
                // Parsear los valores de los lanzamientos
                const throwValues = data.throws.map(value => parseInt(value) || 0);
                const throwsTotal = throwValues.reduce((sum, num) => sum + num, 0);

                // Determinar qué set de lanzamientos actualizar basado en la ronda
                if (data.round === 1) {
                    // Actualizar los lanzamientos para T1
                    playerToUpdate.throws1 = throwValues;
                    playerToUpdate.t1Total = throwsTotal;
                } else if (data.round === 2) {
                    // Actualizar los lanzamientos para T2
                    playerToUpdate.throws2 = throwValues;
                    playerToUpdate.t2Total = throwsTotal;
                }

                // Recalcular el total general (suma de t1Total y t2Total)
                playerToUpdate.total = (playerToUpdate.t1Total || 0) + (playerToUpdate.t2Total || 0);

                // Crear el objeto con los valores que quieres actualizar en la tabla
                const newData = {
                    t1: playerToUpdate.throws1 || [0, 0, 0],
                    total_t1: playerToUpdate.t1Total || 0,
                    t2: playerToUpdate.throws2 || [0, 0, 0],
                    total_t2: playerToUpdate.t2Total || 0,
                    total: playerToUpdate.total || 0
                };

                // Actualizar solo la fila de ese jugador en la tabla
                updatePlayerTable(data.player, newData);
            } else {
                console.warn(`Jugador con ID ${data.player} no encontrado en el array de jugadores`);
            }
        });

        // Nueva función para obtener jugadores de todas las pistas para un torneo
        function loadAllPlayersFromAPI(tournamentId) {
            // Mostrar indicador de carga (opcional)
            const tbody = document.querySelector('#scoreTable tbody');
            tbody.innerHTML = '<tr><td colspan="12" class="text-center p-4">Cargando jugadores...</td></tr>';

            // Primero obtenemos todas las pistas del torneo
            fetch(`/tournaments/${tournamentId}/players-with-fields`)
                .then(response => {
                    if (!response.ok) throw new Error('Error al obtener datos de jugadores');
                    return response.json();
                })
                .then(data => {
                    if (!data.success) throw new Error(data.message || 'Error desconocido');

                    // Procesamos los datos y preparamos los jugadores para la tabla
                    renderPlayersTable(data.fields);
                })
                .catch(error => {
                    console.error('Error:', error);
                    tbody.innerHTML = `<tr><td colspan="12" class="text-center p-4 text-red-500">Error al cargar jugadores: ${error.message}</td></tr>`;
                });
        }

        // Función para renderizar la tabla con los datos de la API
        function renderPlayersTable(fields) {
            const tbody = document.querySelector('#scoreTable tbody');
            tbody.innerHTML = ''; // Limpiar tabla actual

            // Crear un mapa para agrupar jugadores por ID y encontrar la última ronda
            const playersMap = new Map();

            // Procesar todos los campos y sus jugadores
            fields.forEach(field => {
                field.players.forEach(player => {
                    const playerId = player.id;

                    // Si el jugador no está en el mapa o encontramos una ronda más reciente, actualizamos
                    if (!playersMap.has(playerId) ||
                        playersMap.get(playerId).round_number < player.round_number) {

                        // Añadir campo al jugador
                        player.field_name = field.field_name;
                        playersMap.set(playerId, player);
                    }
                });
            });

            // Convertir el mapa a un array para renderizar
            const allPlayers = Array.from(playersMap.values());

            // Cargar datos completos de cada jugador desde la API
            const tournamentId = localStorage.getItem('canal');

            // Hacer una solicitud para obtener los datos completos de puntuación
            fetch(`/tournaments/${tournamentId}/players-scores`)
                .then(response => response.json())
                .then(scoresData => {
                    if (!scoresData.success) {
                        throw new Error(scoresData.message || 'Error al cargar puntuaciones');
                    }

                    // Combinar información de jugadores con sus puntuaciones
                    const playerScores = scoresData.playerScores || {};

                    // Renderizar cada jugador en la tabla con datos completos
                    allPlayers.forEach((player, index) => {
                        // Obtener datos de puntuación para este jugador
                        const playerScore = playerScores[player.id] || {
                            round1: { t1: [0, 0, 0], total_t1: 0 },
                            round2: { t2: [0, 0, 0], total_t2: 0 },
                            total: 0
                        };

                        // Determinar el color basado en el estado
                        let nameColorClass = 'bg-gray-200'; // Por defecto
                        switch (player.status) {
                            case 2: nameColorClass = 'bg-green-300'; break; // playing_next
                            case 3: nameColorClass = 'bg-yellow-200'; break; // preparing
                            case 4: nameColorClass = 'bg-red-400'; break; // collecting
                        }

                        // Crear la fila en la tabla con datos completos
                        const row = document.createElement('tr');
                        row.setAttribute('data-player-id', player.id);

                        row.innerHTML = `
                            <td class="border border-[var(--azul)] p-2 text-center">${index + 1}</td>
                            <td class="border border-[var(--azul)] p-2 ${nameColorClass}">${player.name} ${player.lastname}</td>
                            <td class="border border-[var(--azul)] p-2 text-center">${player.field_name}</td>
                            <td class="border border-[var(--azul)] p-2 text-center">${playerScore.round1.t1[0] || 0}</td>
                            <td class="border border-[var(--azul)] p-2 text-center">${playerScore.round1.t1[1] || 0}</td>
                            <td class="border border-[var(--azul)] p-2 text-center">${playerScore.round1.t1[2] || 0}</td>
                            <td class="border border-[var(--azul)] p-2 text-center">${playerScore.round1.total_t1 || 0}</td>
                            <td class="border border-[var(--azul)] p-2 text-center">${playerScore.round2.t2[0] || 0}</td>
                            <td class="border border-[var(--azul)] p-2 text-center">${playerScore.round2.t2[1] || 0}</td>
                            <td class="border border-[var(--azul)] p-2 text-center">${playerScore.round2.t2[2] || 0}</td>
                            <td class="border border-[var(--azul)] p-2 text-center">${playerScore.round2.total_t2 || 0}</td>
                            <td class="border border-[var(--azul)] p-2 text-center">${playerScore.total || 0}</td>
                        `;

                        tbody.appendChild(row);
                    });

                    // Actualizar la variable global para WebSocket
                    players = tableToArray();
                })
                .catch(error => {
                    console.error('Error al cargar puntuaciones:', error);

                    // Renderizar tabla simple con datos básicos en caso de error
                    renderBasicTable(allPlayers);
                });
        }

        // Función auxiliar para renderizar tabla básica en caso de error
        function renderBasicTable(allPlayers) {
            const tbody = document.querySelector('#scoreTable tbody');

            allPlayers.forEach((player, index) => {
                // Determinar el color basado en el estado
                let nameColorClass = 'bg-gray-200'; // Por defecto
                switch (player.status) {
                    case 2: nameColorClass = 'bg-green-300'; break; // playing_next
                    case 3: nameColorClass = 'bg-yellow-200'; break; // preparing
                    case 4: nameColorClass = 'bg-red-400'; break; // collecting
                }

                // Crear la fila en la tabla
                const row = document.createElement('tr');
                row.setAttribute('data-player-id', player.id);

                const t1 = parseInt(player.t1) || 0;
                const t2 = parseInt(player.t2) || 0;
                const t3 = parseInt(player.t3) || 0;
                const total_t1 = t1 + t2 + t3;

                row.innerHTML = `
                    <td class="border border-[var(--azul)] p-2 text-center">${index + 1}</td>
                    <td class="border border-[var(--azul)] p-2 ${nameColorClass}">${player.name} ${player.lastname}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">${player.field_name}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">${t1}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">${t2}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">${t3}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">${total_t1}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">0</td>
                    <td class="border border-[var(--azul)] p-2 text-center">0</td>
                    <td class="border border-[var(--azul)] p-2 text-center">0</td>
                    <td class="border border-[var(--azul)] p-2 text-center">0</td>
                    <td class="border border-[var(--azul)] p-2 text-center">${total_t1}</td>
                `;

                tbody.appendChild(row);
            });

            // Actualizar la variable global para WebSocket
            players = tableToArray();
        }
    </script>

@endsection
