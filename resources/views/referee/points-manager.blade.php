@extends('admin.index')

@section('content')

<main class="flex-1 mx-5 md:mx-10">
    <div class="text-center mt-8 md:mt-10 mb-8 md:mb-10">
        <h2 class="text-xl md:text-2xl font-bold text-[var(--azul)] mb-4">{{__("referee.tournament_manager")}}</h2>
    </div>

    <div class="bg-[var(--crema)] p-4 md:p-6 shadow-xl rounded-lg border-[var(--azul)] border">
        <h3 class="text-base md:text-lg font-semibold text-[var(--azul)] mb-3 md:mb-4">{{__("referee.tournament_data")}}</h3>
        <p class="text-xs md:text-sm text-gray-600"><strong>{{__("referee.tournament_name")}}</strong> Torneo muy top 1</p>
        <p class="text-xs md:text-sm text-gray-600"><strong>{{__("referee.current_round")}}</strong> 2</p>
    </div>

    <div class="mt-4 md:mt-6 bg-[var(--crema)] p-4 md:p-6 shadow-xl rounded-lg border-[var(--azul)] border">
        <h3 class="text-base md:text-lg font-semibold text-[var(--azul)] mb-3 md:mb-4">{{__("referee.points_management")}}</h3>
        <form action="#" method="POST">
            @csrf
            <div class="mb-3 md:mb-4">
                <label class="block text-base md:text-lg font-medium text-[var(--azul)]">{{__("referee.select_court")}}</label>
                <select class="w-full p-2 border border-gray-300 rounded text-sm md:text-base">
                    <option>Pista 1</option>
                    <option>Pista 2</option>
                    <option>Pista 3</option>
                    <option>Pista 4</option>
                    <option>Pista 5</option>
                </select>
            </div>

            <div class="mb-3 md:mb-4">
                <p class="text-base md:text-lg font-semibold text-[var(--azul)]">{{__("referee.current_round")}} 2</p>
            </div>

            <div class="mb-3 md:mb-4">
                <p class="text-base md:text-lg font-semibold text-[var(--azul)]">{{__("referee.current_player_throwing")}} <span class="text-gray-600 underline">Pepe Pepito</span></p>
                <p class="text-base md:text-lg font-semibold text-[var(--azul)]">{{__("referee.current_player_receiving")}} <span class="text-gray-600 underline">Pablo Escobar</span></p>
            </div>

            <hr class="border-[var(--azul)] border-2 rounded-xl">
            <div class="mb-4">
                <label class="text-base md:text-lg font-medium text-[var(--azul)] mb-2">{{__("referee.throw_1")}}</label>
                <div class="grid grid-cols-3 gap-4 font-bold">
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw1">0</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw1">1</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw1">2</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw1">3</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw1">4</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw1">6</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw1">10</button>
                </div>
                <div class="mt-4 flex justify-center font-bold">
                    <button type="button" class="score-btn bg-gray-500 text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 w-80" data-target="throw1" data-action="clear">X</button>
                </div>
                <input type="hidden" id="throw1" name="throw1" required>
            </div>

            <hr class="border-[var(--azul)] border-2 rounded-xl">
            <div class="mb-4">
                <label class="block text-base md:text-lg font-medium text-[var(--azul)] mb-2">{{__("referee.throw_2")}}</label>
                <div class="grid grid-cols-3 gap-4 font-bold">
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw2">0</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw2">1</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw2">2</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw2">3</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw2">4</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw2">6</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw2">10</button>
                </div>
                <div class="mt-4 flex justify-center font-bold">
                    <button type="button" class="score-btn bg-gray-500 text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 w-80" data-target="throw2" data-action="clear">X</button>
                </div>
                <input type="hidden" id="throw2" name="throw2" required>
            </div>

            <hr class="border-[var(--azul)] border-2 rounded-xl">
            <div class="mb-4">
                <label class="block text-base md:text-lg font-medium text-[var(--azul)] mb-2">{{__("referee.throw_3")}}</label>
                <div class="grid grid-cols-3 gap-4 font-bold">
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw3">0</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw3">1</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw3">2</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw3">3</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw3">4</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw3">6</button>
                    <button type="button" class="score-btn bg-[var(--azul)] text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 hover:bg-[var(--rojo)]" data-target="throw3">10</button>
                </div>
                <div class="mt-4 flex justify-center font-bold">
                    <button type="button" class="score-btn bg-gray-500 text-[var(--blanco)] p-2 rounded h-12 md:h-14 text-sm md:text-base transform transition hover:scale-105 w-80" data-target="throw3" data-action="clear">X</button>
                </div>
                <input type="hidden" id="throw3" name="throw3" required>
            </div>

            <hr class="border-[var(--azul)] border-2 rounded-xl">
            <div class="text-center mt-4 md:mt-6">
                <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 text-sm md:text-base">
                    {{__("referee.save_scores")}}
                </button>
            </div>
        </form>
        
        <div class="text-center mt-3 md:mt-4">
            <button class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 text-sm md:text-base">
                {{__("referee.show_all_players")}}
            </button>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.score-btn').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const action = this.getAttribute('data-action');
            const targetInput = document.getElementById(targetId);
            
            if (action === 'clear') {
                targetInput.value = '';
            } else {
                targetInput.value = this.textContent;
            }
        });
    });
});
</script>

@endsection