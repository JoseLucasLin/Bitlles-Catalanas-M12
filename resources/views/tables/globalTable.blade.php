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

                    <tr>
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
                            <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['total'] ?? '' }}</td>
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

        document.addEventListener("DOMContentLoaded", async () => {
            getList();

            // Load tournament info immediately if channel exists in localStorage
            const storedChannel = localStorage.getItem('canal');
            if (storedChannel) {
                fetchTournamentInfo(storedChannel);
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
                        console.table(data.tournament?.start_date || data); // asegúrate de que el objeto existe
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
            }

            selectorCanal.addEventListener("change", (e) => {
                const newChannel = e.target.value;
                console.log('Canal cambiado a:', newChannel);
                localStorage.setItem("canal", newChannel);
                connecToChanel(newChannel);
                fetchTournamentInfo(newChannel);
                fetchCurrentRound(newChannel);
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

        document.addEventListener('DOMContentLoaded', function () {

            function tableToArray() {
                let table = document.getElementById('scoreTable'); // Obtener la tabla por su ID
                if (!table) {
                    console.error('La tabla no se encuentra');
                    return [];
                }

                // Seleccionar todas las filas dentro del tbody
                let rows = table.querySelectorAll('tbody tr');

                if (!rows.length) {
                    console.error('No hay filas en el tbody de la tabla');
                    return [];
                }

                let tableData = []; // Array que almacenará los datos

                rows.forEach(row => {
                    let cells = row.querySelectorAll('td'); // Obtener todas las celdas de la fila

                    let rowData = {
                        number: cells[0].textContent.trim(), // Número
                        player: cells[1].textContent.trim(), // Jugador
                        field: cells[2].textContent.trim(), // Campo
                        throws1: [cells[3].textContent.trim(), cells[4].textContent.trim(), cells[5].textContent.trim()], // Los 3 primeros throws
                        t1Total: parseInt(cells[6].textContent.trim()), // Total T1
                        throws2: [cells[7].textContent.trim(), cells[8].textContent.trim(), cells[9].textContent.trim()], // Los 3 siguientes throws
                        t2Total: parseInt(cells[10].textContent.trim()), // Total T2
                        total: parseInt(cells[11].textContent.trim()) // Total
                    };

                    tableData.push(rowData); // Agregar la fila de datos al array
                });

                return tableData; // Devolver el array con los datos de la tabla
            }

            let arrayFromTable = tableToArray();

            socket.on('submitScore', (data) => {
                let playerData = null;
                console.log(arrayFromTable);

                // Buscar el partido correspondiente al tournamentId y fieldId
                arrayFromTable.forEach(match => {
                    console.log(data)
                    // Comprobamos si el número del partido coincide con el jugador
                    if (match.number === data.player) {
                        // Aquí no existe players, sino que directamente tenemos al jugador
                        playerData = match;  // Esto obtiene el objeto 'match' completo
                    }
                });

                if (playerData) {
                    console.log('Jugador encontrado:', playerData);

                    // Ahora, podemos continuar con la lógica de la puntuación
                    // Si el jugador ya tiene rondas, agregar la nueva ronda con los throws
                    let roundNumber = playerData.rounds ? playerData.rounds.length + 1 : 1; // Número de ronda
                    let newRound = {
                        round_number: roundNumber,
                        t1: data.throws.slice(0, 3), // Los primeros 3 throws corresponden a T1
                        t2: data.throws.slice(3, 6) ?? [], // Los siguientes 3 throws corresponden a T2 (si es ronda 2)
                        total_t1: data.throws.slice(0, 3).reduce((a, b) => parseInt(a) + parseInt(b), 0),  // Total de los primeros 3 lanzamientos
                        total_t2: data.throws.length > 3 ? data.throws.slice(3, 6).reduce((a, b) => parseInt(a) + parseInt(b), 0) : 0,  // Total de los siguientes 3 lanzamientos (0 si no hay suficientes)
                        total: data.throws.slice(0, 3).reduce((a, b) => parseInt(a) + parseInt(b), 0) +
                            (data.throws.length > 3 ? data.throws.slice(3, 6).reduce((a, b) => parseInt(a) + parseInt(b), 0) : 0)  // Total combinado
                    };

                    // Si es ronda 1, solo asignamos t1
                    if (roundNumber === 1) {
                        newRound.t2 = [];
                        newRound.total_t2 = 0;
                    }

                    // Agregar la nueva ronda al jugador
                    if (!playerData.rounds) {
                        playerData.rounds = []; // Aseguramos que existan las rondas
                    }
                    playerData.rounds.push(newRound);

                    // Ahora, si necesitas volver a renderizar la tabla
                    renderTable(arrayFromTable); // Aquí actualizamos la tabla con la nueva información
                } else {
                    console.log('Jugador no encontrado');
                }

            });

            // Función para renderizar la tabla después de actualizar los datos
function renderTable(matchesData) {
    let tbody = document.querySelector('tbody');

    matchesData.forEach((match, matchIndex) => {
        console.log(match); // Ver el contenido de cada "match"

        let player = match; // Esto es porque "match" ya representa al jugador, no necesitas un forEach

        // Buscar la fila correspondiente usando el ID del jugador, asumiendo que cada jugador tiene un ID único
        let row = document.getElementById(`player-${match.number}`);

        // Si la fila no existe (es un nuevo jugador), crear una nueva fila
        if (!row) {
            row = document.createElement('tr');
            row.id = `player-${match.number}`; // Asignar un ID único a la fila del jugador
        }

        // Inicializar las variables de las columnas de la tabla
        let throws1 = '';
        let throws2 = '';
        let t1Total = '';
        let t2Total = '';
        let total = '';

        // Verificar si el jugador tiene rondas y obtener los valores de throws
        if (player.throws1 && player.throws1.length > 0) {
            throws1 = player.throws1.join(' '); // Los 3 primeros throws
            t1Total = player.t1Total; // Suma de los 3 primeros throws

            // Si tiene una segunda ronda (throws2), tomar los valores de t2
            if (player.throws2 && player.throws2.length > 0) {
                throws2 = player.throws2.join(' '); // Los 3 valores de la segunda ronda
                t2Total = player.t2Total; // Suma de los 3 valores de la segunda ronda
            }

            // Si existe la segunda ronda, calculamos el total
            if (t2Total) {
                total = t1Total + t2Total;
            } else {
                total = t1Total; // Solo si hay una ronda
            }
        }

        // Actualizar la fila con los nuevos datos (o crearla si no existe)
        row.innerHTML = `
            <td class="border border-[var(--azul)] p-2 text-center">${matchIndex + 1}</td>
            <td class="border border-[var(--azul)] p-2">${player.player}</td>
            <td class="border border-[var(--azul)] p-2 text-center">${match.field}</td>
            <td class="border border-[var(--azul)] p-2 text-center">${throws1}</td>
            <td class="border border-[var(--azul)] p-2 text-center">${throws2}</td>
            <td class="border border-[var(--azul)] p-2 text-center">${t1Total}</td>
            <td class="border border-[var(--azul)] p-2 text-center">${throws2}</td>
            <td class="border border-[var(--azul)] p-2 text-center">${t2Total}</td>
            <td class="border border-[var(--azul)] p-2 text-center">${total}</td>
        `;

        // Si la fila era nueva, agregarla al tbody
        if (!row.parentNode) {
            tbody.appendChild(row);
        }
            });
            }

        });
    </script>

@endsection