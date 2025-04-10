@extends('admin.index')

@section('content')
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{__('admin.add_participants')}}</h2>
    </div>

    <form action="{{ route('admin.add-players.store') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
        @csrf

        <div class="mb-4">
            <label for="tournament" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.select_an_tournament')}}</label>
            <select id="tournament" name="tournament" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required onchange="fetchFields()">
                <option value="" disabled selected>{{__('admin.select_tournament')}}</option>
                @foreach($tournaments as $tournament)
                    <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="player" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.select_player')}}</label>
            <select id="player" name="player_id" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                <option value="" disabled selected>{{__('admin.select_player')}}</option>
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }} {{ $player->lastname }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="field" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.select_field')}}</label>
            <select id="field" name="field_id" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                <option value="" disabled selected>{{__('admin.select_field')}}</option>
            </select>
        </div>

        <div class="text-center mt-10">
            <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                {{__('admin.add_participant')}}
            </button>
        </div>
    </form>

    <div class="mt-10">
        <h3 class="text-xl font-bold mb-4">{{ __('admin.assigned_players') }}</h3>
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2">{{ __('admin.player') }}</th>
                    <th class="px-4 py-2">{{ __('admin.field') }}</th>
                    <th class="px-4 py-2">{{ __('admin.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignedPlayers as $assigned)
                    <tr>
                        <td class="px-4 py-2">{{ $assigned->player->name }} {{ $assigned->player->lastname }}</td>
                        <td class="px-4 py-2">{{ $assigned->field->field_name }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('admin.remove-player', $assigned->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    {{ __('admin.remove') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

<script>
    function fetchFields() {
        const tournamentId = document.getElementById('tournament').value;
        if (tournamentId) {
            fetch(`/admin/get-fields/${tournamentId}`)
                .then(response => response.json())
                .then(fields => {
                    const fieldSelect = document.getElementById('field');
                    fieldSelect.innerHTML = '<option value="" disabled selected>{{__('admin.select_field')}}</option>';
                    fields.forEach(field => {
                        const option = document.createElement('option');
                        option.value = field.id;
                        option.textContent = field.field_name;
                        fieldSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    }
</script>
@endsection
