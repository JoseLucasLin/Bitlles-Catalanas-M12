@extends('admin.index')

@section('content')

<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{__('admin.assign_players_to_courts')}}</h2>
    </div>

    <form action="#" method="POST" class="max-w-xl mx-auto">
        @csrf

        <div class="mb-4">
            <label for="tournament" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.select_tournament')}}</label>
            <select id="tournament" name="tournament" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required onchange="loadTournamentCourts()">
                <option value="" disabled selected>{{__('admin.select_tournament')}}</option>
                <option value="1">Torneo 1</option>
                <option value="2">Torneo 2</option>
                <option value="3">Torneo 3</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="players" class="block text-lg font-medium text-[var(--azul)]">{{__('admin.select_players')}}</label>
            <select id="players" name="players[]" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" multiple required>
                <option value="1">Jugador 1</option>
                <option value="2">Jugador 2</option>
                <option value="3">Jugador 3</option>
                <option value="4">Jugador 4</option>
                <option value="5">Jugador 5</option>
                <option value="6">Jugador 6</option>
                <option value="7">Jugador 7</option>
                <option value="8">Jugador 8</option>
            </select>
            <p class="text-sm text-gray-500 mt-1">{{__('admin.hold_ctrl_to_select_multiple')}}</p>
        </div>

        <div class="text-center mt-10">
            <button type="button" onclick="distributePlayers()" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                {{__('admin.distribute_players')}}
            </button>
        </div>
    </form>

    <div class="mt-10">
        <div class="text-center mb-6">
            <h3 class="text-xl font-bold text-[var(--azul)]">{{__('admin.tournament_courts')}}</h3>
            <p id="tournament-name" class="text-lg text-[var(--azul)] mt-2"></p>
        </div>

        <div id="courts-container" class="space-y-8">
            <div class="text-center text-gray-500">
                {{__('admin.select_tournament_to_view_courts')}}
            </div>
        </div>
    </div>
</main>

<script>
    //datos estaticos para probar
    //casi todo el js se borrara ya que es para probar como se ve la pagina con datos
    const staticCourts = {
        1: [
            { id: 1, name: "Pista Central" },
            { id: 2, name: "Pista Norte" },
            { id: 3, name: "Pista Sur" }
        ],
        2: [
            { id: 4, name: "Cancha Principal" },
            { id: 5, name: "Cancha Secundaria" }
        ],
        3: [
            { id: 6, name: "Court 1" },
            { id: 7, name: "Court 2" },
            { id: 8, name: "Court 3" },
            { id: 9, name: "Court 4" }
        ]
    };

    function loadTournamentCourts() {
        const tournamentId = document.getElementById("tournament").value;
        const tournamentName = document.querySelector(`#tournament option[value='${tournamentId}']`).textContent;
        
        document.getElementById("tournament-name").textContent = tournamentName;
        
        const courts = staticCourts[tournamentId] || [];
        
        renderCourts(courts);
    }
    
    function renderCourts(courts) {
        const container = document.getElementById("courts-container");
        container.innerHTML = '';
        
        if (courts.length === 0) {
            container.innerHTML = `
                <div class="text-center text-gray-500">
                    {{__('admin.no_courts_available')}}
                </div>
            `;
            return;
        }
        
        courts.forEach(court => {
            const courtDiv = document.createElement("div");
            courtDiv.className = "bg-[var(--crema)] p-4 rounded-lg border border-[var(--azul)]";
            
            courtDiv.innerHTML = `
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-bold text-[var(--azul)]">${court.name}</h4>
                    <span class="text-sm text-gray-500">ID: ${court.id}</span>
                </div>
                <table class="w-full border border-[var(--azul)]">
                    <thead>
                        <tr class="bg-[var(--azul)] text-[var(--blanco)]">
                            <th class="p-2">{{__('admin.player')}}</th>
                            <th class="p-2">{{__('admin.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody id="court-${court.id}-players">
                        <!-- Jugadores asignados a esta pista -->
                        <tr>
                            <td colspan="2" class="p-2 text-center text-gray-500">{{__('admin.no_players_assigned')}}</td>
                        </tr>
                    </tbody>
                </table>
            `;
            
            container.appendChild(courtDiv);
        });
    }
    
    function distributePlayers() {
        const tournamentId = document.getElementById("tournament").value;
        if (!tournamentId) {
            alert("{{__('admin.select_tournament_first')}}");
            return;
        }
        
        const playersSelect = document.getElementById("players");
        const selectedOptions = Array.from(playersSelect.selectedOptions);
        
        if (selectedOptions.length === 0) {
            alert("{{__('admin.select_at_least_one_player')}}");
            return;
        }
        
        const courts = staticCourts[tournamentId] || [];
        if (courts.length === 0) {
            alert("{{__('admin.no_courts_available_for_tournament')}}");
            return;
        }
        
        courts.forEach(court => {
            const playersList = document.getElementById(`court-${court.id}-players`);
            playersList.innerHTML = `
                <tr>
                    <td colspan="2" class="p-2 text-center text-gray-500">{{__('admin.no_players_assigned')}}</td>
                </tr>
            `;
        });
        
        const playersPerCourt = Math.floor(selectedOptions.length / courts.length);
        let extraPlayers = selectedOptions.length % courts.length;
        
        let playerIndex = 0;
        
        courts.forEach((court, courtIndex) => {
            const playersList = document.getElementById(`court-${court.id}-players`);
            
            if (playersList.firstElementChild && playersList.firstElementChild.getAttribute("colspan")) {
                playersList.innerHTML = '';
            }
            
            let playersForThisCourt = playersPerCourt;
            if (extraPlayers > 0) {
                playersForThisCourt++;
                extraPlayers--;
            }
            
            for (let i = 0; i < playersForThisCourt && playerIndex < selectedOptions.length; i++) {
                const playerOption = selectedOptions[playerIndex];
                const playerId = playerOption.value;
                const playerName = playerOption.text;
                
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td class="p-2 border-b border-[var(--azul)]">${playerName}</td>
                    <td class="p-2 border-b border-[var(--azul)]">
                        <button onclick="removePlayerFromCourt(this, ${court.id})" class="text-red-500">{{__('admin.remove')}}</button>
                    </td>
                `;
                
                playersList.appendChild(row);
                playerIndex++;
            }
        });
        
        Array.from(playersSelect.options).forEach(option => {
            option.selected = false;
        });
    }
    
    function removePlayerFromCourt(button, courtId) {
        const row = button.parentElement.parentElement;
        row.remove();
        
        const playersList = document.getElementById(`court-${courtId}-players`);
        if (playersList.children.length === 0) {
            playersList.innerHTML = `
                <tr>
                    <td colspan="2" class="p-2 text-center text-gray-500">{{__('admin.no_players_assigned')}}</td>
                </tr>
            `;
        }
    }
</script>
@endsection