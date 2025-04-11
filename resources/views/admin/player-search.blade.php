@extends('admin.index')

@section('content')
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">@lang('admin.player_search')</h2>
        <p class="text-gray-600">@lang('admin.search_description')</p>
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
                    placeholder="@lang('admin.search_placeholder')"
                    value="{{ request('search') }}"
                >
            </div>
            <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-6 py-3 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                @lang('admin.search_button')
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
                            <th class="py-3 px-4 text-left">@lang('admin.photo')</th>
                            <th class="py-3 px-4 text-left">@lang('admin.name')</th>
                            <th class="py-3 px-4 text-left">@lang('admin.lastname')</th>
                            <th class="py-3 px-4 text-left">@lang('admin.email')</th>
                            <th class="py-3 px-4 text-center">@lang('admin.partner')</th>
                            <th class="py-3 px-4 text-center">@lang('admin.last_access')</th>
                            <th class="py-3 px-4 text-center">@lang('admin.actions')</th>
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
                                <td class="py-3 px-4">{{ $player->mail ?? __('admin.not_available') }}</td>
                                <td class="py-3 px-4 text-center">
                                    @if($player->partner)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            @lang('admin.yes')
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            @lang('admin.no')
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">{{ $player->last_login ? date('d/m/Y H:i', strtotime($player->last_login)) : __('admin.never') }}</td>
                                <td class="py-3 px-4 text-center">
                                    <button onclick="showPlayerDetails({{ $player->id }})" class="inline-flex items-center justify-center bg-[var(--azul)] text-[var(--blanco)] px-3 py-1 rounded text-sm transition duration-300 hover:bg-[var(--rojo)] mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        @lang('admin.view')
                                    </button>
                                    <button onclick="editPlayer({{ $player->id }})" class="inline-flex items-center justify-center bg-yellow-500 text-white px-3 py-1 rounded text-sm transition duration-300 hover:bg-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        @lang('admin.edit')
                                    </button>
                                    <button onclick="sendPlayerCode({{ $player->id }})" class="inline-flex items-center justify-center bg-green-500 text-white px-3 py-1 rounded text-sm transition duration-300 hover:bg-green-600 ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        @lang('admin.send_code')
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
                    <h3 class="mt-2 text-lg font-medium text-gray-900">@lang('admin.no_players_found')</h3>
                    <p class="mt-1 text-gray-500">@lang('admin.try_other_terms') <a href="{{ route('admin.player-search') }}" class="text-[var(--azul)] hover:text-[var(--rojo)] font-bold">@lang('admin.view_all_players')</a>.</p>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">@lang('admin.no_players_registered')</h3>
                    <p class="mt-1 text-gray-500">@lang('admin.register_player_link') <a href="{{ route('create-player') }}" class="text-[var(--azul)] hover:text-[var(--rojo)] font-bold">@lang('admin.register_player_link')</a>.</p>
                @endif
            </div>
        @endif
    </div>

    <div class="mt-2">
        <a href="/admin" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold flex items-center justify-center transition duration-300 underline">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
            <span class="ms-1">@lang('admin.back_to_dashboard')</span>
        </a>
    </div>
</main>

<!-- Modal para ver detalles del jugador -->
<div id="playerDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-[var(--azul)]">@lang('admin.player_details')</h3>
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
                                <p class="text-sm text-gray-500">@lang('admin.full_name')</p>
                                <p id="playerDetailName" class="font-medium"></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">@lang('admin.email')</p>
                                <p id="playerDetailEmail" class="font-medium"></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">@lang('admin.partner')</p>
                                <p id="playerDetailPartner" class="font-medium"></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">@lang('admin.code')</p>
                                <p id="playerDetailCode" class="font-medium"></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">@lang('admin.last_access')</p>
                                <p id="playerDetailLastLogin" class="font-medium"></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">@lang('admin.login_attempts')</p>
                                <p id="playerDetailAttempts" class="font-medium"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mt-2">
                    <h4 class="font-bold text-[var(--azul)] mb-3">@lang('admin.tournament_history')</h4>
                    <div id="playerTournamentsHistory" class="max-h-60 overflow-y-auto">
                        <p class="text-gray-500 text-center py-4">@lang('admin.loading_history')</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 flex justify-end gap-3">
                <button onclick="closePlayerDetails()" class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded hover:bg-gray-200 transition-all">
                    @lang('admin.close')
                </button>
                <button id="editPlayerBtn" class="px-4 py-2 bg-[var(--azul)] text-[var(--blanco)] font-medium rounded hover:bg-[var(--rojo)] transition-all">
                    @lang('admin.edit_player')
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
                document.getElementById('playerDetailEmail').textContent = player.mail || '@lang('admin.not_available')';
                document.getElementById('playerDetailPartner').textContent = player.partner ? '@lang('admin.yes')' : '@lang('admin.no')';
                document.getElementById('playerDetailCode').textContent = player.code;
                document.getElementById('playerDetailLastLogin').textContent = player.last_login ? new Date(player.last_login).toLocaleString() : '@lang('admin.never')';
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
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">@lang('admin.position'): 3</span>
                                </div>
                                <div class="py-3 flex justify-between">
                                    <div>
                                        <p class="font-medium">Campeonato Local</p>
                                        <p class="text-sm text-gray-500">25/01/2024</p>
                                    </div>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">@lang('admin.position'): 7</span>
                                </div>
                            </div>
                        `;
                    } else {
                        tournamentsContainer.innerHTML = '<p class="text-gray-500 text-center py-4">@lang('admin.no_tournaments')</p>';
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

    // Agregar esta función al script existente en player-search.blade.php
    function sendPlayerCode(playerId) {
        if (confirm("@lang('admin.send_code_confirmation')")) {
            // Obtener el token CSRF
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Mostrar indicador de carga
            const loadingOverlay = document.createElement('div');
            loadingOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            loadingOverlay.innerHTML = `
                <div class="bg-white p-5 rounded-lg shadow-xl">
                    <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-[var(--azul)] mx-auto"></div>
                    <p class="mt-3 text-center">@lang('admin.sending_email')</p>
                </div>
            `;
            document.body.appendChild(loadingOverlay);

            fetch(`/admin/send-player-code/${playerId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Eliminar indicador de carga
                document.body.removeChild(loadingOverlay);

                if (data.success) {
                    // Mostrar mensaje de éxito
                    const successAlert = document.createElement('div');
                    successAlert.className = 'fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded max-w-md shadow-lg z-50';
                    successAlert.innerHTML = `
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>${data.message}</span>
                        </div>
                    `;
                    document.body.appendChild(successAlert);

                    // Eliminar el mensaje después de 5 segundos
                    setTimeout(() => {
                        document.body.removeChild(successAlert);
                    }, 5000);
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                // Eliminar indicador de carga
                document.body.removeChild(loadingOverlay);

                console.error('Error:', error);
                alert('Ha ocurrido un error al enviar el código. Por favor, inténtalo de nuevo.');
            });
        }
    }
</script>
@endsection