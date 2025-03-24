@extends('admin.index')

@section('content')

<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{__('admin.add_participants')}}</h2>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
        @csrf

        <div class="mb-4">
            <label for="tournament" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.select_an_tournament')}}</label>
            <select id="tournament" name="tournament" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                <option value="" disabled selected>{{__('admin.select_tournament')}}</option>
                <option value="1">Torneo 1</option>
                <option value="2">Torneo 2</option>
                <option value="3">Torneo 3</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="participant_type" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.participant_type')}}</label>
            <select id="participant_type" name="participant_type" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required onchange="toggleCourtField()">
                <option value="" disabled selected>{{__('admin.select_type')}}</option>
                <option value="player">{{__('admin.player')}}</option>
                <option value="referee">{{__('admin.referee')}}</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="username" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.username')}}</label>
            <input type="text" id="username" name="username" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required placeholder="Escribe el nombre de usuario">
        </div>

        <div class="mb-4 hidden" id="court-field">
            <label for="court" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.asigned_track')}}</label>
            <input type="text" id="court" name="court" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" placeholder="Indica la pista">
        </div>

        <div class="text-center mt-10">
            <button type="button" onclick="addParticipant()" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                {{__('admin.add_participant')}}
            </button>
            <div class="mt-2">
                <a href="#" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold flex items-center justify-center transition duration-300 underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                    </svg>
                    <span class="ms-1">{{__('admin.go_back')}}</span>
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
                    <th class="p-2">{{__('admin.type')}}</th>
                    <th class="p-2">{{__('admin.name')}}</th>
                    <th class="p-2">{{__('admin.track')}}</th>
                    <th class="p-2">{{__('admin.actions')}}</th>
                </tr>
            </thead>
            <tbody id="participants-list">
                
            </tbody>
        </table>
    </div>
</main>

<script>
    function toggleCourtField() {
        const type = document.getElementById("participant_type").value;
        const courtField = document.getElementById("court-field");
        if (type === "referee") {
            courtField.classList.remove("hidden");
        } else {
            courtField.classList.add("hidden");
        }
    }

    function addParticipant() {
        const tournament = document.getElementById("tournament").value;
        const type = document.getElementById("participant_type").value;
        const username = document.getElementById("username").value;
        const court = document.getElementById("court").value;

        if (!tournament || !type || !username || (type === "referee" && !court)) {
            alert("Error.");
            return;
        }

        const table = document.getElementById("participants-list");
        const row = table.insertRow();
        row.innerHTML = `
            <td class="p-2">${document.querySelector(`#tournament option[value='${tournament}']`).textContent}</td>
            <td class="p-2">${type === "player" ? "{{__('admin.player')}}" : "{{__('admin_referee')}}"}</td>
            <td class="p-2">${username}</td>
            <td class="p-2">${type === "referee" ? court : "N/A"}</td>
            <td class="p-2"><button onclick="deleteRow(this)" class="text-red-500">{{__('admin.delete')}}</button></td>
        `;

        document.getElementById("username").value = "";
        document.getElementById("court").value = "";
        toggleCourtField();
    }

    function deleteRow(button) {
        button.parentElement.parentElement.remove();
    }
</script>
@endsection
