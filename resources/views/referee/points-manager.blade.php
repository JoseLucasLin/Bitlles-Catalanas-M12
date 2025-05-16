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







        </div>
        </form>
    </main>

  <script type="module">
import { io } from 'https://cdn.socket.io/4.3.2/socket.io.esm.min.js'
const socket = io('http://localhost:8100');

// Variables globales
let currentTournamentId = null;
let currentFieldId = null;

// Función principal que se ejecuta cuando el DOM está listo
document.addEventListener('DOMContentLoaded', function () {
    // Configurar botones de puntuación
    setupScoreButtons();

    // Obtener lista de torneos y configurar selector
    getList();

    // Cargar torneo guardado si existe
    const storedChannel = localStorage.getItem('canal');
    if (storedChannel) {
        currentTournamentId = storedChannel;
        fetchTournamentInfo(storedChannel);
        connecToChanel(storedChannel);
        fetchCurrentRound(storedChannel);
    }

    // Configurar eventos para los selectores de estado de jugadores
    setupPlayerStatusEvents();

    // Configurar evento para envío de puntuaciones
    setupScoreSubmission();

    // Configurar evento para cambio de campo
    setupFieldChangeEvent();
});

// Configurar botones de puntuación
function setupScoreButtons() {
    // Botones de puntuación normales
    document.querySelectorAll('.score-btn').forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const action = this.getAttribute('data-action');
            const targetInput = document.getElementById(targetId);

            if (action === 'clear') {
                targetInput.value = '';
                this.textContent = 'X';
            } else {
                targetInput.value = this.textContent;

                // Actualizar el botón de X con el valor seleccionado
                const clearButton = document.querySelector(`button[data-target="${targetId}"][data-action="clear"]`);
                if (clearButton) clearButton.textContent = this.textContent;

                // Destacar el botón seleccionado
                document.querySelectorAll(`button[data-target="${targetId}"]`).forEach(btn => {
                    if (btn.textContent === this.textContent && !btn.hasAttribute('data-action')) {
                        btn.classList.add('bg-[var(--rojo)]');
                    } else if (!btn.hasAttribute('data-action')) {
                        btn.classList.remove('bg-[var(--rojo)]');
                    }
                });
            }
        });
    });
}

// Configurar eventos para los selectores de estado de jugadores
function setupPlayerStatusEvents() {
    // Conservamos el selector pero eliminamos la actualización de estado
    const throwingSelect = document.querySelector('select[data-player-select]');
    if (throwingSelect) {
        throwingSelect.addEventListener('change', function() {
            // La actualización visual se mantiene pero no enviamos nada al servidor
            if (this.value) {
                const option = this.options[this.selectedIndex];
                option.style.backgroundColor = '#86efac'; // bg-green-300
            }
        });
    }
}

// Configurar evento para cambio de campo
function setupFieldChangeEvent() {
    const fieldSelect = document.querySelector('select[name="field_id"]');
    if (fieldSelect) {
        fieldSelect.addEventListener('change', function(e) {
            const fieldId = this.value;
            currentFieldId = fieldId;
            const tournamentId = localStorage.getItem('canal');
            if (tournamentId && fieldId) {
                fetchPlayersForField(tournamentId, fieldId);
            }
        });
    }
}

// Configurar envío de puntuaciones
function setupScoreSubmission() {
    const submitButton = document.querySelector('[data-action="submitScores"]');
    if (submitButton) {
        submitButton.addEventListener('click', function(e) {
            e.preventDefault();
            submitScores();
        });
    }
}

// Función para enviar puntuaciones
function submitScores() {
    // Obtener la ronda actual
    const currentRound = parseInt(document.querySelector('[data-current-round]')?.textContent) || 1;

    // Obtener los valores de los lanzamientos
    const throws = [
        document.getElementById('throw1').value,
        document.getElementById('throw2').value,
        document.getElementById('throw3').value,
    ];

    // Validar que todos los lanzamientos tengan valores
    if (throws.some(t => !t)) {
        // Usando console.error en lugar de alert para evitar alertas molestas
        console.error('Por favor, completa todos los lanzamientos');
        return;
    }

    // Obtener el jugador seleccionado
    const selectedPlayer = document.querySelector('select[data-player-select]').value;

    if (!selectedPlayer) {
        // Usando console.error en lugar de alert
        console.error('Por favor, selecciona un jugador');
        return;
    }

    // Obtener el campo y torneo seleccionado
    const fieldId = document.querySelector('select[name="field_id"]').value;
    const tournamentId = document.getElementById('chanelTournament').value;

    // Deshabilitar el botón para evitar envíos duplicados
    const submitButton = document.querySelector('[data-action="submitScores"]');
    submitButton.disabled = true;
    submitButton.classList.add('opacity-50');

    // Crear un objeto con los datos a enviar
    const payload = {
        tournamentId: tournamentId,
        fieldId: fieldId,
        throws: throws,
        player: selectedPlayer,
        round: currentRound
        // Se elimina cualquier referencia al estado
    };

    // Enviar los datos al servidor
    socket.emit('submitScore', payload);

    // Escuchar la confirmación
    socket.once('scoreSubmitted', handleScoreSubmitted);

    // Escuchar errores
    socket.once('scoreError', handleScoreError);
}

// Manejar respuesta exitosa de envío de puntuación
function handleScoreSubmitted(response) {
    console.log('Puntuación guardada:', response);

    // Restablecer los campos del formulario
    document.getElementById('throw1').value = '';
    document.getElementById('throw2').value = '';
    document.getElementById('throw3').value = '';

    // Resetear los estilos de los botones
    document.querySelectorAll('.score-btn').forEach(btn => {
        btn.classList.remove('bg-[var(--rojo)]');
    });

    // Resetear los botones X
    document.querySelectorAll('button[data-action="clear"]').forEach(btn => {
        btn.textContent = 'X';
    });

    // Mostrar notificación visual en lugar de alert
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-green-500 text-white p-4 rounded shadow-lg z-50';
    notification.textContent = response.message || 'Puntuación enviada correctamente';
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);

    // Re-habilitar el botón
    const submitButton = document.querySelector('[data-action="submitScores"]');
    submitButton.disabled = false;
    submitButton.classList.remove('opacity-50');
}

// Manejar errores de envío de puntuación
function handleScoreError(error) {
    console.error('Error al guardar puntuación:', error);

    // Mostrar notificación visual en lugar de alert
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-red-500 text-white p-4 rounded shadow-lg z-50';
    notification.textContent = error.message || 'Error al guardar la puntuación. Inténtalo de nuevo.';
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);

    // Re-habilitar el botón
    const submitButton = document.querySelector('[data-action="submitScores"]');
    submitButton.disabled = false;
    submitButton.classList.remove('opacity-50');
}

// ==== Obtener lista de torneos ====
function getList() {
    console.log("Enviando getTournaments");
    socket.emit('getTournaments', {
        user: "token",
        mensaje: "listar"
    });
}

// ==== Popular el selector de torneos ====
function populateSelect(result) {
    const select = document.getElementById('chanelTournament');
    if (!select) return;

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

    // Configurar evento de cambio de torneo
    select.addEventListener("change", function(e) {
        const newChannel = this.value;
        console.log('Canal cambiado a:', newChannel);
        localStorage.setItem("canal", newChannel);
        currentTournamentId = newChannel;
        connecToChanel(newChannel);
        fetchTournamentInfo(newChannel);
        fetchCurrentRound(newChannel);

        // Limpiar selectores de campos y jugadores
        const fieldSelect = document.querySelector('select[name="field_id"]');
        if (fieldSelect) {
            fieldSelect.innerHTML = '<option value="" disabled selected>Selecciona un campo</option>';
        }

        // Cargar campos para el nuevo torneo
        loadFieldsAndPlayers(newChannel);
    });
}

// ==== Unirse a canal específico ====
function connecToChanel(canal) {
    if (!canal) return;
    console.log('Uniéndose al canal:', canal);
    socket.emit('joinChannel', canal);
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
            if (!data.success) {
                throw new Error(data.message || "Error desconocido al cargar datos del torneo");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cargar información del torneo: ' + error.message);
        });
}

// ==== Obtener ronda actual ====
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

// Cargar campos y jugadores del torneo seleccionado
function loadFieldsAndPlayers(tournamentId) {
    // Obtener la información de las pistas y jugadores
    fetch(`/tournaments/${tournamentId}/players-with-fields`)
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || "Error al cargar campos y jugadores");
            }

            const fieldSelect = document.querySelector('select[name="field_id"]');
            const playerSelect = document.querySelector('select[data-player-select]');

            // Limpiar los selectores
            fieldSelect.innerHTML = '<option value="" disabled selected>Selecciona un campo</option>';
            playerSelect.innerHTML = '<option value="" disabled selected>Selecciona un jugador</option>';

            // Rellenar el selector de campos
            data.fields.forEach(field => {
                const option = document.createElement('option');
                option.value = field.field_id;
                option.textContent = `${field.field_name} (${field.players.length} jugadores)`;
                fieldSelect.appendChild(option);
            });

            // Si solo hay un campo, seleccionarlo automáticamente
            if (data.fields.length === 1) {
                fieldSelect.value = data.fields[0].field_id;
                currentFieldId = data.fields[0].field_id;
                fetchPlayersForField(tournamentId, data.fields[0].field_id);
            }
        })
        .catch(err => {
            console.error("Error al obtener campos y jugadores:", err);
            alert("Error al cargar campos y jugadores: " + err.message);
        });
}

// ==== Obtener jugadores para un campo específico ====
function fetchPlayersForField(tournamentId, fieldId) {
    console.log(`Obteniendo jugadores para torneo ${tournamentId}, campo ${fieldId}`);

    fetch(`/tournaments/${tournamentId}/fields/${fieldId}/players`)
        .then(res => {
            if (!res.ok) {
                throw new Error(`Error HTTP: ${res.status}`);
            }
            return res.json();
        })
        .then(data => {
            console.log("Respuesta recibida:", data);

            // Verificar que la respuesta sea exitosa y contiene el array de jugadores
            if (data.success && Array.isArray(data.players)) {
                updatePlayerSelects(data.players);
            } else {
                console.error("La respuesta no contiene un array de jugadores válido:", data);
                alert("Error: No se pudieron cargar los jugadores correctamente");
            }
        })
        .catch(err => {
            console.error("Error obteniendo jugadores para pista:", err);
            alert(`Error al cargar jugadores: ${err.message}`);
        });
}

// Actualizar selectores de jugadores según su estado
function updatePlayerSelects(players) {
    console.log('Actualizando selectores con jugadores:', players);

    // Actualizar selector de jugador lanzando
    const throwingSelect = document.querySelector('select[data-player-select]');
    if (!throwingSelect) {
        console.error('No se encontró el selector para jugadores lanzando');
        return;
    }

    throwingSelect.innerHTML = '<option value="" disabled selected>Selecciona un jugador</option>';

    // Añadir todos los jugadores al selector sin filtrar por estado
    players.forEach(player => {
        const opt = document.createElement('option');
        opt.value = player.id;
        opt.textContent = `${player.name} ${player.lastname}`;
        // Mantener el resaltado visual para jugadores en estado 2 (lanzando)
        if (Number(player.status) === 2) {
            opt.style.backgroundColor = '#86efac'; // bg-green-300
        }
        throwingSelect.appendChild(opt);
    });
}

// Escuchar eventos de WebSocket
socket.on('connection', (e) => {
    console.log('Estado de conexión:', e);
});

socket.on('getChanels', (e) => {
    console.log('Canales recibidos:', e.result);
    populateSelect(e.result);

    // Recuperar canal guardado
    const storedChannel = localStorage.getItem('canal') || (e.result.length > 0 ? e.result[0].id : null);

    if (storedChannel) {
        const selectorCanal = document.getElementById("chanelTournament");
        if (selectorCanal) {
            selectorCanal.value = storedChannel;
            currentTournamentId = storedChannel;
            connecToChanel(storedChannel);
            fetchTournamentInfo(storedChannel);
            fetchCurrentRound(storedChannel);
            loadFieldsAndPlayers(storedChannel);
        }
    }
});

socket.on('tournamentStarted', (response) => {
    if (response.success) {
        alert('Torneo iniciado correctamente');
    }
});

socket.on('nextRound2', (data) => {
    // Actualizar los elementos que muestran la ronda actual
    document.querySelectorAll('[data-current-round]').forEach(element => {
        element.textContent = data.nextRound;
    });

    // Mostrar notificación visible
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-green-500 text-white p-4 rounded shadow-lg z-50';
    notification.textContent = `¡Avanzando a la ronda ${data.nextRound}!`;
    document.body.appendChild(notification);

    // Remover la notificación después de 5 segundos
    setTimeout(() => {
        notification.remove();
    }, 5000);

    console.log(`Ronda actualizada a ${data.nextRound}`);
});
</script>


@endsection
