@extends('admin.index')

@section('content')

    <main class="flex-1 mx-5 md:mx-10">
        <div class="text-center mt-8 md:mt-10 mb-8 md:mb-10">
            <h2 class="text-xl md:text-2xl font-bold text-[var(--azul)] mb-4">{{__("referee.tournament_manager")}}</h2>
        </div>


        <div class="bg-[var(--crema)] p-4 md:p-6 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-base md:text-lg font-semibold text-[var(--azul)] mb-3 md:mb-4">{{__("referee.tournament_data")}}
            </h3>
            <p class="text-xs md:text-sm text-gray-600"><strong>{{__("referee.tournament_name")}}
                </strong>
                <select id="chanelTournament" class="w-full p-2 border border-gray-300 rounded">

                    <option disabled>No hay torneos disponibles</option>


                </select>
            </p>
            <p class="text-xs md:text-sm text-gray-600"><strong>{{__("referee.current_round")}}</strong>  <span data-current-round>2</span></p>

        </div>

        <div class="mt-4 md:mt-6 bg-[var(--crema)] p-4 md:p-6 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-base md:text-lg font-semibold text-[var(--azul)] mb-3 md:mb-4">
                {{__("referee.points_management")}}
            </h3>
            <form action="" >
                @csrf
                <div class="mb-3 md:mb-4">
                    
    <label class="block text-base md:text-lg font-medium text-[var(--azul)]">
        {{__("referee.select_court")}}
    </label>
    <select name="field_id" class="w-full p-2 border border-gray-300 rounded text-sm md:text-base">
        <!-- Las opciones de las pistas se llenarán dinámicamente aquí -->
    </select>
</div>

                <div class="mb-3 md:mb-4">
                    <p class="text-base md:text-lg font-semibold text-[var(--azul)]">{{__("referee.current_round")}} 2</p>
                </div>

                <hr class="border-[var(--azul)] border-2 rounded-xl">
                <div class="mb-3 md:mb-4 space-y-2">
                    <div>
                        <label class="text-base md:text-lg font-semibold text-[var(--azul)] block mb-1">
                            {{__("referee.current_player_throwing")}}
                        </label>
        <select data-player-select
            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--azul)]">
            <option value="" disabled selected>Selecciona un jugador</option>
            <!-- Las opciones de los jugadores se llenarán dinámicamente aquí -->
        </select>
                    </div>

                    <div>
                        <label class="text-base md:text-lg font-semibold text-[var(--azul)] block mb-1">
                            {{__("referee.current_player_receiving")}}
                        </label>
                        <select data-show-all-players
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--azul)]">
                            <option value="" disabled selected>Selecciona un jugador</option>
                            <option value="pablo">Pablo Escobar</option>
                            <option value="ana">Ana Sánchez</option>
                            <option value="luis">Luis Martínez</option>
                            <option value="pepe">Pepe Pepito</option>
                            <option value="juan">Juan Pérez</option>
                            <option value="maria">María García</option>
                            <option value="pepe">Pepe Pepito</option>
                            <option value="juan">Juan Pérez</option>
                            <option value="maria">María García</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-base md:text-lg font-semibold text-[var(--azul)] block mb-1">
                            {{__("referee.current_player_preparing")}}
                        </label>
                        <select
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--azul)]">
                            <option value="" disabled selected>Selecciona un jugador</option>
                            <option value="pablo">Pablo Escobar</option>
                            <option value="ana">Ana Sánchez</option>
                            <option value="luis">Luis Martínez</option>
                            <option value="pepe">Pepe Pepito</option>
                            <option value="juan">Juan Pérez</option>
                            <option value="maria">María García</option>
                            <option value="pepe">Pepe Pepito</option>
                            <option value="juan">Juan Pérez</option>
                            <option value="maria">María García</option>
                        </select>
                    </div>
                </div>

                <hr class="border-[var(--azul)] border-2 rounded-xl">
                <div class="mb-4">
                    <label
                        class="text-base md:text-lg font-medium text-[var(--azul)] mb-2">{{__("referee.throw_1")}}</label>
                    <div class="grid grid-cols-3 gap-4 font-bold">
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw1">0</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw1">1</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw1">2</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw1">3</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw1">4</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw1">6</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw1">10</button>
                    </div>
                    <div class="mt-4 flex justify-center font-bold">
                        <button type="button"
                            class="score-btn bg-gray-500 text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 w-80"
                            data-target="throw1" data-action="clear">X</button>
                    </div>
                    <input type="hidden" id="throw1" name="throw1" required>
                </div>

                <hr class="border-[var(--azul)] border-2 rounded-xl">
                <div class="mb-4">
                    <label
                        class="block text-base md:text-lg font-medium text-[var(--azul)] mb-2">{{__("referee.throw_2")}}</label>
                    <div class="grid grid-cols-3 gap-4 font-bold">
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw2">0</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw2">1</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw2">2</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw2">3</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw2">4</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw2">6</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw2">10</button>
                    </div>
                    <div class="mt-4 flex justify-center font-bold">
                        <button type="button"
                            class="score-btn bg-gray-500 text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 w-80"
                            data-target="throw2" data-action="clear">X</button>
                    </div>
                    <input type="hidden" id="throw2" name="throw2" required>
                </div>

                <hr class="border-[var(--azul)] border-2 rounded-xl">
                <div class="mb-4">
                    <label
                        class="block text-base md:text-lg font-medium text-[var(--azul)] mb-2">{{__("referee.throw_3")}}</label>
                    <div class="grid grid-cols-3 gap-4 font-bold">
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw3">0</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw3">1</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw3">2</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw3">3</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw3">4</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw3">6</button>
                        <button type="button"
                            class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]"
                            data-target="throw3">10</button>
                    </div>
                    <div class="mt-4 flex justify-center font-bold">
                        <button type="button"
                            class="score-btn bg-gray-500 text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 w-80"
                            data-target="throw3" data-action="clear">X</button>
                    </div>
                    <input type="hidden" id="throw3" name="throw3" required>
                </div>

                <hr class="border-[var(--azul)] border-2 rounded-xl">
                <div class="text-center mt-4 md:mt-6">
                    <button type="button"
                     data-action="submitScores"
                        class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 text-sm md:text-base">
                        {{__("referee.save_scores")}}
                        
                    </button>
                </div>
         






            <div class="text-center mt-3 md:mt-4">
                <button data-show-all-players
                    class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 text-sm md:text-base">
                    {{__("referee.show_all_players")}}
                </button>
            </div>
        </div>
        </form>
    </main>

  <script type="module">
import { io } from 'https://cdn.socket.io/4.3.2/socket.io.esm.min.js'
const socket = io('http://localhost:8100');

document.addEventListener('DOMContentLoaded', function () {

    // ==== Botones de puntuación ====
    document.querySelectorAll('.score-btn').forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const action = this.getAttribute('data-action');
            const targetInput = document.getElementById(targetId);

            if (action === 'clear') {
                targetInput.value = '';
            } else {
                targetInput.value = this.textContent;
            }
        });
    });

    // ==== Obtener lista de torneos ====
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

    // ==== Obtener información del torneo ====
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
                    console.table(data.tournament?.start_date || data); // asegúrate que el objeto existe
                } else {
                    throw new Error(data.message || "Error desconocido al cargar datos del torneo");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', error.message);
            });
    }

    // ==== Unirse a canal específico ====
    function connecToChanel(canal) {
        if (!canal) return;
        console.log('Uniéndose al canal:', canal);
        socket.emit('joinChannel', canal);
    }

    // ==== Escuchar canales ====
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

    // ==== Estado de conexión ====
    socket.on('connection', (e) => {
        console.log('Estado de conexión:', e);
    });

    // ==== Evento torneo iniciado ====
    socket.on('tournamentStarted', (response) => {
        showNotification('success', 'Torneo iniciado correctamente');
    });

    // ==== Inicialización ====
    getList();
    const storedChannel = localStorage.getItem('canal');
    if (storedChannel) {
        fetchTournamentInfo(storedChannel);
        connecToChanel(storedChannel);
    }
});

function fetchCurrentRound(tournamentId) {
    fetch(`/tournaments/${tournamentId}/current-round`)
        .then(res => res.json())
        .then(data => {

            if (data && data.current_round !== undefined) {
                document.querySelectorAll('[data-current-round]').forEach(el => {
                    
                    el.textContent = data.current_round;
                    //console.warn(data)
                });
            }
        })
        .catch(err => console.error("Error obteniendo la ronda actual:", err));
}


function fetchPlayersForField(tournamentId, fieldId) {
    fetch(`/tournaments/${tournamentId}/fields/${fieldId}/players`)
        .then(res => res.json())
        .then(players => {
            
            updatePlayerSelects(players);
        })
        .catch(err => console.error("Error obteniendo jugadores para pista:", err));
}

function updatePlayerSelects(players) {
    const selects = document.querySelectorAll('select[data-player-select]');
    selects.forEach(select => {
        select.innerHTML = '<option value="" disabled selected>Selecciona un jugador</option>';
        players.forEach(player => {
            const opt = document.createElement('option');
            opt.value = player.id;
            opt.textContent = player.name;
            select.appendChild(opt);
        });
    });
}
socket.on('nextRound2', (data) => {
    // Obtenemos todos los elementos con el atributo 'data-current-round'
    const roundElements = document.querySelectorAll('[data-current-round]');
    
    // Iteramos sobre cada uno de esos elementos
    roundElements.forEach((element) => {
        // Actualizamos su contenido con el valor de la nueva ronda
        element.textContent = data.nextRound;
    });

    console.log(`Ronda actualizada a ${data.nextRound}`);
});

document.querySelector('select[name="field_id"]').addEventListener('change', (e) => {
    const fieldId = e.target.value;
    const tournamentId = localStorage.getItem('canal');
    fetchPlayersForField(tournamentId, fieldId);
});

document.addEventListener('DOMContentLoaded', () => {
    const tournamentId = localStorage.getItem('canal');
    
    // Obtener la información de las pistas y jugadores al cargar la página
    fetch(`/tournaments/${tournamentId}/players-with-fields`)
        .then(res => res.json())
 .then(data => {
            const fieldSelect = document.querySelector('select[name="field_id"]');
            const playerSelect = document.querySelector('select[data-player-select]');

            // Limpiar los selects
            fieldSelect.innerHTML = '';
            playerSelect.innerHTML = '<option value="" disabled selected>Selecciona un jugador</option>'; // Limpiar jugadores

            // Rellenar el select de pistas
            if (data.fields.length === 1) {
                const field = data.fields[0]; // Solo hay una pista
                const option = document.createElement('option');
                option.value = field.field_id; // Asignar el id de la pista
                option.textContent = `${field.field_name} (${field.players.length} jugadores)`; // Mostrar nombre y cantidad de jugadores
                fieldSelect.appendChild(option);

                // Rellenar el select de jugadores para esa pista (sin esperar selección)
                field.players.forEach(player => {
                    const option = document.createElement('option');
                    option.value = player.id; // Usamos el id del jugador
                    option.textContent = `${player.name} ${player.lastname}`; // Mostrar el nombre y apellido del jugador
                    playerSelect.appendChild(option);
                });
            } else {
                // Si hay más de una pista, rellenamos el select de pistas como antes
                data.fields.forEach(field => {
                    const option = document.createElement('option');
                    option.value = field.field_id; // Asignar el id de la pista
                    option.textContent = `${field.field_name} (${field.players.length} jugadores)`; // Mostrar nombre y cantidad de jugadores
                    fieldSelect.appendChild(option);
                });

                // Añadir el evento de cambio para actualizar los jugadores cuando se selecciona una pista
                fieldSelect.addEventListener('change', () => {
                    const selectedFieldId = fieldSelect.value;
                    const selectedField = data.fields.find(field => field.field_id == selectedFieldId);
                    
                    // Limpiar el select de jugadores
                    playerSelect.innerHTML = '<option value="" disabled selected>Selecciona un jugador</option>';
                    
                    // Rellenar el select de jugadores para la pista seleccionada
                    if (selectedField) {
                        selectedField.players.forEach(player => {
                            const option = document.createElement('option');
                            option.value = player.id; // Usamos el id del jugador
                            option.textContent = `${player.name} ${player.lastname}`; // Mostrar el nombre y apellido del jugador
                            playerSelect.appendChild(option);
                        });
                    }
                });
            }
        })
        .catch(err => console.error("Error al obtener jugadores:", err));









         const updateThrowValue = (target, value) => {
        const inputField = document.getElementById(target);
        const clearButton = document.querySelector(`button[data-target="${target}"][data-action="clear"]`);

        // Establecer el valor en el campo oculto
        inputField.value = value;

        // Actualizar el botón X con el valor seleccionado
        clearButton.textContent = `${value}`; // Muestra el valor seleccionado

        // Establecer el valor de los botones
        const buttons = document.querySelectorAll(`button[data-target="${target}"]`);
        buttons.forEach(button => {
            // Hacer que los botones seleccionados se muestren con un estilo diferente si están activos
            if (button.textContent == value) {
                button.classList.add('bg-[var(--rojo)]');
            } else {
                button.classList.remove('bg-[var(--rojo)]');
            }
        });
    };

    // Agregar evento a todos los botones de puntuación (0, 1, 2, 3, 4, 6, 10)
    const scoreButtons = document.querySelectorAll('.score-btn');
    scoreButtons.forEach(button => {
        button.addEventListener('click', () => {
            const target = button.getAttribute('data-target');
            const value = button.textContent;
            updateThrowValue(target, value); // Actualizar el valor del input y botón X
        });
    });

    // Evento para el botón de "X" (para restablecer el valor)
    const clearButtons = document.querySelectorAll('button[data-action="clear"]');
    clearButtons.forEach(button => {
        button.addEventListener('click', () => {
            const target = button.getAttribute('data-target');
            updateThrowValue(target, ''); // Restablecer el valor a vacío
        });
    });
});
document.querySelector('[data-action="submitScores"]').addEventListener('click', (e) => {
    // Prevenir el comportamiento por defecto, si lo necesitas
    e.preventDefault();

    // Obtener los valores de los lanzamientos (ajusta según cómo estén en tu formulario)
    const throws = [
        document.getElementById('throw1').value,
        document.getElementById('throw2').value,
        document.getElementById('throw3').value,
    ];

    // Obtener el jugador seleccionado
    const selectedPlayer = document.querySelector('select[data-player-select]').value;

    // Obtener el campo y torneo seleccionado
    const fieldId = document.querySelector('select[name="field_id"]').value;
    const tournamentId = document.getElementById('chanelTournament').value;

    // Crear un objeto con los datos a enviar
    const payload = {
        tournamentId: tournamentId,
        fieldId: fieldId,
        throws: throws,
        player: selectedPlayer,
    };

    // Mostrar los datos en consola (opcional)
    console.log('Enviando puntuaciones:', payload);

    // Enviar los datos al servidor usando WebSockets (ajusta según tu implementación)
    socket.emit('submitScore', payload);
});


</script>


@endsection