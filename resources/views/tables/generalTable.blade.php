@extends('admin.index')
@section('content')
<main class="flex-1 ms-10 me-10">
  <div>
    <select class="w-full p-2 border border-gray-300 rounded" id="chanelTournament">
      <option>NOT CONNECTED</option>
  </select>
  </div>
  <div>

  <table class="w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-200" >
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Nº</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Jugador</th>
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
    
        <tr>
            <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
            <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">Jugador 1</td>
            <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
            <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
            <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
            <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">8</td>
            <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
            <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
            <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
            <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">6</td>
            <td class="border border-[var(--azul)] p-2 text-lg text-white text-center bg-[#BE1622]">14</td>
        </tr>
        <tr>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">Jugador 1</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">8</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">6</td>
          <td class="border border-[var(--azul)] p-2 text-lg text-white text-center bg-[#BE1622]">14</td>
      </tr>
      <tr>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">Jugador 1</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">8</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">6</td>
        <td class="border border-[var(--azul)] p-2 text-lg text-white text-center bg-[#BE1622]">14</td>
    </tr>
    <tr>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">Jugador 1</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">8</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">1</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">2</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">3</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-gray-600 text-center">6</td>
      <td class="border border-[var(--azul)] p-2 text-lg text-white text-center bg-[#BE1622]">14</td>
    </tr>
    </tbody>
  </table>
</div>
</main>



  




  <div class="flex items-start gap-2.5">
    <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="Jese image">
    <div class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
       <div class="flex items-center space-x-2 rtl:space-x-reverse">
          <span class="text-sm font-semibold text-gray-900 dark:text-white">Bonnie Green</span>
          <span class="text-sm font-normal text-gray-500 dark:text-gray-400">11:46</span>
       </div>
       <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">That's awesome. I think our users will really appreciate the improvements.</p>
       <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span>
    </div>
    <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600" type="button">
       <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
          <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
       </svg>
    </button>
    <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-40 dark:bg-gray-700 dark:divide-gray-600">
       <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
          <li>
             <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reply</a>
          </li>
          <li>
             <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Forward</a>
          </li>
          <li>
             <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Copy</a>
          </li>
          <li>
             <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
          </li>
          <li>
             <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
          </li>
       </ul>
    </div>
 </div>
 
 


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