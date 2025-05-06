@extends('admin.index')

@section('content')

<?php header('Access-Control-Allow-Origin: *');?>
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">@lang('admin.tournament_management')</h2>
    </div>

    <div class="bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
        <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">@lang('admin.select_tournament')</h3>
        <select class="w-full p-2 border border-gray-300 rounded" id="chanelTournament">
            <option>NOT CONNECTED</option>
        </select>
    </div>

    <div class="mt-6 bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
        <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">@lang('admin.tournament_info')</h3>
        <p class="text-sm text-gray-600"><strong>@lang('admin.available_courts'):</strong> 5</p>
        <p class="text-sm text-gray-600"><strong>@lang('admin.registered_players'):</strong> 32</p>
        <p class="text-sm text-gray-600"><strong>@lang('admin.current_round'):</strong> 2</p>
    </div>



    <div class="mt-6 bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
        <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">listado de jugadores</h3>
        <p class="text-sm text-gray-600"><strong>@lang('admin.available_courts'):</strong> 5</p>
        <p class="text-sm text-gray-600"><strong>@lang('admin.registered_players'):</strong> 32</p>
        <p class="text-sm text-gray-600"><strong>@lang('admin.current_round'):</strong> 2</p>
    </div>




    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
        <button class="bg-[var(--rojo)] text-[var(--blanco)] p-3 rounded-lg transition duration-300 hover:bg-[var(--azul)] font-bold flex items-center justify-center space-x-2" id="start">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
              </svg>              
            <span>@lang('admin.start')</span>
        </button>
        <button class="bg-[var(--rojo)] text-[var(--blanco)] p-3 rounded-lg transition duration-300 hover:bg-[var(--azul)] font-bold flex items-center justify-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 1 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712l.003-2.024a.668.668 0 0 1 .198-.471 1.575 1.575 0 1 0-2.228-2.228 3.818 3.818 0 0 0-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0 1 16.35 15m.002 0h-.002" />
              </svg>                            
            <span>@lang('admin.resolve_tie')</span>
        </button>
        <button class="bg-[var(--rojo)] text-[var(--blanco)] p-3 rounded-lg transition duration-300 hover:bg-[var(--azul)] font-bold flex items-center justify-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
              </svg>                            
            <span>@lang('admin.modify')</span>
        </button>
        <button id="nextRound" class="bg-[var(--rojo)] text-[var(--blanco)] p-3 rounded-lg transition duration-300 hover:bg-[var(--azul)] font-bold flex items-center justify-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3" />
              </svg>                          
            <span>@lang('admin.next_round')</span>
        </button>
    </div>

    
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