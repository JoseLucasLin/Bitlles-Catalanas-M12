@extends('admin.index')

@section('content')

<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{__("referee.tournament_manager")}}</h2>
    </div>

    <div class="bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
        <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">{{__("referee.tournament_data")}}</h3>
        <p class="text-sm text-gray-600"><strong>{{__("referee.tournament_name")}}</strong>    
            <select class="w-full p-2 border border-gray-300 rounded" id="chanelTournament">
            <option>NOT CONNECTED</option>
        </select></p>
        <p class="text-sm text-gray-600"><strong>{{__("referee.current_round")}}</strong> 2</p>
    </div>

    <div class="mt-6 bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
        <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">{{__("referee.points_management")}}</h3>
        <form action="#" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-lg font-medium text-[var(--azul)]">{{__("referee.select_court")}}</label>
                <select class="w-full p-2 border border-gray-300 rounded">
                    <option>Pista 1</option>
                    <option>Pista 2</option>
                    <option>Pista 3</option>
                    <option>Pista 4</option>
                    <option>Pista 5</option>
                </select>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-[var(--azul)]">{{__("referee.current_round")}} 2</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-[var(--azul)]">{{__("referee.current_player_throwing")}} <span class="text-gray-600 underline">Pepe Pepito</span></p>
                <p class="text-lg font-semibold text-[var(--azul)]">{{__("referee.current_player_receiving")}} <span class="text-gray-600 underline">Pablo Escobar</span></p>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-lg font-medium text-[var(--azul)]">{{__("referee.throw_1")}}</label>
                    <input type="number" min="1" max="10" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div>
                    <label class="block text-lg font-medium text-[var(--azul)]">{{__("referee.throw_2")}}</label>
                    <input type="number" min="1" max="10" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div>
                    <label class="block text-lg font-medium text-[var(--azul)]">{{__("referee.throw_3")}}</label>
                    <input type="number" min="1" max="10" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
            </div>

            <div class="text-center mt-6">
                <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                    {{__("referee.save_scores")}}
                </button>
            </div>

        </form>
        
            <div class="text-center mt-4">
                <button class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                    {{__("referee.show_all_players")}}
                </button>
            </div>
        
    </div>asdasd
</main>

<script type="module">
    import { io } from 'https://cdn.socket.io/4.3.2/socket.io.esm.min.js'
    const socket = io('http://localhost:8100');
    
    document.addEventListener("DOMContentLoaded", async () => {
        getList();
        setupStartButton();
    });
    
    function getList() {
        console.log("Enviando getTournaments");
        socket.emit('getTournaments', { 
            user: "token", 
            mensaje: "listar" 
        });
    }
    
    function setupStartButton() {
        const startBtn = document.getElementById('start');
        
        startBtn.addEventListener('click', () => {
            const selectedChannel = document.getElementById('chanelTournament').value;
            
            // Validación mejorada
            if (selectedChannel === 'NOT CONNECTED') {
                alert('Por favor selecciona un canal primero');
                return;
            }
            
            // Verificar si coincide con el canal almacenado
            const storedChannel = localStorage.getItem('canal');
            if (selectedChannel !== storedChannel) {
                alert('El canal seleccionado no coincide con el almacenado');
                return;
            }
            
            // Desactivar el botón
            startBtn.disabled = true;
            startBtn.classList.add('opacity-50', 'cursor-not-allowed');
            startBtn.textContent = 'Iniciando...';
            
            // Emitir evento con estructura correcta
            socket.emit('activateTournament', {  // Nombre corregido
                channelId: selectedChannel,
                userId: "ID_REAL_USUARIO"  // Cambiar por ID real
            });
        });
    }
    
    // Escuchar evento de respuesta (nombre corregido)
    socket.on('tournamentStarted', (response) => {
        const startBtn = document.getElementById('start'); // ID corregido
        
        if (response.success) {
            startBtn.textContent = 'Torneo Iniciado';
            // Mostrar notificación de éxito
            showNotification('success', 'Torneo iniciado correctamente');
        } else {
            resetStartButton();
            showNotification('error', response.message || 'Error al iniciar torneo');
        }
    });
    
    // Función para resetear el botón
    function resetStartButton() {
        const startBtn = document.getElementById('start');
        startBtn.disabled = false;
        startBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        startBtn.textContent = 'Iniciar Torneo';
    }
    
    // Función para mostrar notificaciones
    function showNotification(type, message) {
        // Implementar tu sistema de notificaciones
        alert(`${type.toUpperCase()}: ${message}`);
    }
    
    socket.on('connection', (e) => {
        console.log('Estado de conexión:', e);
    });
    
    let data;
    
    socket.on('getChanels', (e) => {
        console.log('Canales recibidos:', e.result);
        populateSelect(e.result);
    
        const selectorCanal = document.getElementById("chanelTournament");
        let canal = localStorage.getItem('canal') || e.result[0]?.id;
        
        if (canal) {
            selectorCanal.value = canal;
            connecToChanel(canal);
            localStorage.setItem('canal', canal);
        }
        
        selectorCanal.addEventListener("change", (e) => {
            const newChannel = e.target.value;
            console.log('Canal cambiado a:', newChannel);
            localStorage.setItem("canal", newChannel);
            connecToChanel(newChannel);
        });
    });
    
    function connecToChanel(canal) {
        if (!canal) return;
        console.log('Uniéndose al canal:', canal);
        socket.emit('joinChannel', canal);
    }
    
    function populateSelect(result) {
        const select = document.getElementById('chanelTournament');
        select.innerHTML = '<option>NOT CONNECTED</option>';
    
        if (!result || !result.length) return;
    
        result.forEach((item) => {
            let option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;
            select.appendChild(option);
        });
    }
    </script>
@endsection
