@extends('admin.index')

@section('content')
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">Búsqueda de Jugadores</h2>
        <p class="text-gray-600">Encuentra y gestiona la información de los jugadores registrados</p>
    </div>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 max-w-3xl mx-auto">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de búsqueda -->
    <div class="max-w-3xl mx-auto mb-8">
        <form action="{{ route('admin.player-search') }}" method="GET" class="flex items-center gap-2">
            <div class="flex-1">
                <input
                    type="text"
                    name="search"
                    class="w-full p-3 border border-[var(--azul)] rounded bg-[var(--crema)] focus:outline-none focus:ring-2 focus:ring-[var(--azul)]"
                    placeholder="Buscar por nombre, apellido o correo electrónico..."
                    value="{{ request('search') }}"
                >
            </div>
            <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-6 py-3 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                Buscar
            </button>
        </form>
    </div>

    <!-- Resultados de la búsqueda -->
    <div class="max-w-6xl mx-auto">
        @if(isset($players) && count($players) > 0)
            <div class="bg-[var(--crema)] rounded-lg shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-[var(--azul)] text-[var(--blanco)]">
                        <tr>
                            <th class="py-3 px-4 text-left">Foto</th>
                            <th class="py-3 px-4 text-left">Nombre</th>
                            <th class="py-3 px-4 text-left">Apellido</th>
                            <th class="py-3 px-4 text-left">Correo</th>
                            <th class="py-3 px-4 text-center">Partner</th>
                            <th class="py-3 px-4 text-center">Último acceso</th>
                            <th class="py-3 px-4 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($players as $player)
                            <tr class="hover:bg-gray-100">
                                <td class="py-3 px-4">
                                    <img src="{{ asset('player-img/' . $player->image) }}" alt="{{ $player->name }}" class="w-12 h-12 object-cover rounded-full">
                                </td>
                                <td class="py-3 px-4">{{ $player->name }}</td>
                                <td class="py-3 px-4">{{ $player->lastname }}</td>
                                <td class="py-3 px-4">{{ $player->mail ?? 'No disponible' }}</td>
                                <td class="py-3 px-4 text-center">
                                    @if($player->partner)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Sí
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            No
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">{{ $player->last_login ? date('d/m/Y H:i', strtotime($player->last_login)) : 'Nunca' }}</td>
                                <td class="py-3 px-4 text-center">
                                    <button onclick="showPlayerDetails({{ $player->id }})" class="inline-flex items-center justify-center bg-[var(--azul)] text-[var(--blanco)] px-3 py-1 rounded text-sm transition duration-300 hover:bg-[var(--rojo)] mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Ver
                                    </button>
                                    <button onclick="editPlayer({{ $player->id }})" class="inline-flex items-center justify-center bg-yellow-500 text-white px-3 py-1 rounded text-sm transition duration-300 hover:bg-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($players->hasPages())
                <div class="mt-6">
                    {{ $players->links() }}
                </div>
            @endif
        @else
            <!-- Mostrar mensaje cuando no hay resultados -->
            <div class="text-center p-8 bg-[var(--crema)] rounded-lg shadow">
                @if(request('search'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No se encontraron jugadores con ese criterio</h3>
                    <p class="mt-1 text-gray-500">Prueba con otros términos de búsqueda o <a href="{{ route('admin.player-search') }}" class="text-[var(--azul)] hover:text-[var(--rojo)] font-bold">ver todos los jugadores</a>.</p>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No hay jugadores registrados</h3>
                    <p class="mt-1 text-gray-500">Para añadir jugadores, ve a <a href="{{ route('create-player') }}" class="text-[var(--azul)] hover:text-[var(--rojo)] font-bold">Registrar Jugador</a>.</p>
                @endif
            </div>
        @endif
    </div>
</main>

<!-- Modal para ver detalles del jugador -->
<div id="playerDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-[var(--azul)]">Detalles del Jugador</h3>
                <button onclick="closePlayerDetails()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="playerDetailsContent" class="pt-2">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-6">
                    <div class="w-32 h-32 bg-gray-200 rounded-full overflow-hidden flex-shrink-0">
                        <img id="playerDetailImage" class="w-full h-full object-cover" src="" alt="Foto del jugador">
                    </div>
                    <div class="flex-1">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Nombre completo</p>
                                <p id="playerDetailName" class="font-medium"></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Correo electrónico</p>
                                <p id="playerDetailEmail" class="font-medium"></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Es partner</p>
                                <p id="playerDetailPartner" class="font-medium"></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Código</p>
                                <p id="playerDetailCode" class="font-medium"></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Último acceso</p>
                                <p id="playerDetailLastLogin" class="font-medium"></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Intentos de acceso</p>
                                <p id="playerDetailAttempts" class="font-medium"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mt-2">
                    <h4 class="font-bold text-[var(--azul)] mb-3">Historial de torneos</h4>
                    <div id="playerTournamentsHistory" class="max-h-60 overflow-y-auto">
                        <p class="text-gray-500 text-center py-4">Cargando historial de torneos...</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 flex justify-end gap-3">
                <button onclick="closePlayerDetails()" class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded hover:bg-gray-200 transition-all">
                    Cerrar
                </button>
                <button id="editPlayerBtn" class="px-4 py-2 bg-[var(--azul)] text-[var(--blanco)] font-medium rounded hover:bg-[var(--rojo)] transition-all">
                    Editar jugador
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Variables para almacenar los datos de los jugadores
    let players = [];

    // Función para mostrar detalles del jugador
    function showPlayerDetails(playerId) {
        fetch(`/api/players/${playerId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudo cargar los detalles del jugador');
                }
                return response.json();
            })
            .then(player => {
                document.getElementById('playerDetailImage').src = `{{ asset('player-img/') }}/${player.image}`;
                document.getElementById('playerDetailName').textContent = `${player.name} ${player.lastname}`;
                document.getElementById('playerDetailEmail').textContent = player.mail || 'No disponible';
                document.getElementById('playerDetailPartner').textContent = player.partner ? 'Sí' : 'No';
                document.getElementById('playerDetailCode').textContent = player.code;
                document.getElementById('playerDetailLastLogin').textContent = player.last_login ? new Date(player.last_login).toLocaleString() : 'Nunca';
                document.getElementById('playerDetailAttempts').textContent = player.attemp_logins || '0';

                // Configurar el botón de edición
                document.getElementById('editPlayerBtn').onclick = () => editPlayer(playerId);

                // Mostrar el modal
                document.getElementById('playerDetailsModal').classList.remove('hidden');
                document.getElementById('playerDetailsModal').classList.add('flex');

                // Cargar historial de torneos (simulado)
                setTimeout(() => {
                    const tournamentsContainer = document.getElementById('playerTournamentsHistory');
                    // Aquí normalmente mostrarías datos reales
                    if (Math.random() > 0.5) {
                        tournamentsContainer.innerHTML = `
                            <div class="divide-y divide-gray-200">
                                <div class="py-3 flex justify-between">
                                    <div>
                                        <p class="font-medium">Torneo Nacional 2024</p>
                                        <p class="text-sm text-gray-500">10/03/2024</p>
                                    </div>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Posición: 3</span>
                                </div>
                                <div class="py-3 flex justify-between">
                                    <div>
                                        <p class="font-medium">Campeonato Local</p>
                                        <p class="text-sm text-gray-500">25/01/2024</p>
                                    </div>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Posición: 7</span>
                                </div>
                            </div>
                        `;
                    } else {
                        tournamentsContainer.innerHTML = '<p class="text-gray-500 text-center py-4">Este jugador no ha participado en ningún torneo.</p>';
                    }
                }, 500);
            })
            .catch(error => {
                console.error('Error:', error);
                // Manejo del error...
            });
    }

    // Función para cerrar el modal de detalles
    function closePlayerDetails() {
        document.getElementById('playerDetailsModal').classList.add('hidden');
        document.getElementById('playerDetailsModal').classList.remove('flex');
    }

    // Función para editar jugador
    function editPlayer(playerId) {
        // Redirigir a la página de edición (esta ruta deberás crearla)
        window.location.href = `/admin/edit-player/${playerId}`;
    }

    // Cerrar el modal si se hace clic fuera de él
    document.getElementById('playerDetailsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePlayerDetails();
        }
    });
</script>
@endsection
