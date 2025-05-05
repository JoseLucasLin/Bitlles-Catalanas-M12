@extends('admin.index')

@section('content')

<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{__('admin.add_participants')}}</h2>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 max-w-xl mx-auto" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 max-w-xl mx-auto" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form id="assignForm" class="max-w-xl mx-auto">
        @csrf

        <div class="mb-4">
            <label for="tournament_id" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.select_an_tournament')}}</label>
            <select id="tournament_id" name="tournament_id" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                <option value="" disabled selected>{{__('admin.select_tournament')}}</option>
                @foreach($tournaments as $tournament)
                    <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="player_id" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.select_player')}}</label>
            <select id="player_id" name="player_id" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                <option value="" disabled selected>Selecciona un jugador</option>
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }} {{ $player->lastname }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-center mt-10">
            <button type="button" id="addParticipantBtn" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                {{__('admin.select_player')}}
            </button>
            <div class="mt-2">
                <a href="/admin" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold flex items-center justify-center transition duration-300 underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                    </svg>
                    <span class="ms-1">@lang('admin.back_to_dashboard')</span>
                </a>
            </div>
        </div>
    </form>

    <div class="mt-10 max-w-xl mx-auto">
        <div class="text-center">
            <h3 class="text-xl font-bold text-[var(--azul)] mb-4">{{__('admin.added_participants')}}</h3>
        </div>
        <table class="w-full border border-[var(--azul)] bg-[var(--crema)]">
            <thead>
                <tr class="bg-[var(--azul)] text-[var(--blanco)]">
                    <th class="p-2">{{__('admin.tournament')}}</th>
                    <th class="p-2">{{__('admin.name')}}</th>
                    <th class="p-2">{{__('admin.actions')}}</th>
                </tr>
            </thead>
            <tbody id="participants-list">
                @foreach($assignedPlayers as $assignment)
                    <tr data-id="{{ $assignment->id }}">
                        <td class="p-2">{{ $assignment->tournament->name }}</td>
                        <td class="p-2">{{ $assignment->player->name }} {{ $assignment->player->lastname }}</td>
                        <td class="p-2">
                            <button onclick="removeParticipant({{ $assignment->id }})" class="text-red-500">{{__('admin.delete')}}</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

<script>
    // Prevenir envío por defecto del formulario
    document.getElementById('assignForm').addEventListener('submit', function(e) {
        e.preventDefault();
    });

    // Agregar participante mediante AJAX
    document.getElementById('addParticipantBtn').addEventListener('click', function() {
        const tournamentId = document.getElementById("tournament_id").value;
        const playerId = document.getElementById("player_id").value;

        if (!tournamentId) {
            alert("Selecciona un torneo.");
            return;
        }

        if (!playerId) {
            alert("Selecciona un jugador.");
            return;
        }

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('tournament_id', tournamentId);
        formData.append('player_id', playerId);

        fetch('{{ route("admin.players.assign") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Añadir nueva fila a la tabla
                const table = document.getElementById("participants-list");
                const row = table.insertRow();

                row.dataset.id = data.data.id;
                row.innerHTML = `
                    <td class="p-2">${data.data.tournament_name}</td>
                    <td class="p-2">${data.data.player_name}</td>
                    <td class="p-2"><button onclick="removeParticipant(${data.data.id})" class="text-red-500">{{__('admin.delete')}}</button></td>
                `;

                // Resetear campos del formulario
                document.getElementById("player_id").selectedIndex = 0;

                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ha ocurrido un error al procesar la solicitud.');
        });
    });

    // Eliminar participante
    function removeParticipant(id) {
        if (!confirm("¿Estás seguro de que quieres eliminar este participante?")) {
            return;
        }

        fetch(`{{ url('admin/players/remove') }}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Eliminar fila de la tabla
                document.querySelector(`tr[data-id="${id}"]`).remove();
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ha ocurrido un error al procesar la solicitud.');
        });
    }
</script>
@endsection
