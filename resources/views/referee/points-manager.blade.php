@extends('admin.index')

@section('content')

<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{__("referee.tournament_manager")}}</h2>
    </div>

    <div class="bg-[var(--crema)] p-6 shadow-xl rounded-lg border-[var(--azul)] border">
        <h3 class="text-lg font-semibold text-[var(--azul)] mb-4">{{__("referee.tournament_data")}}</h3>
        <p class="text-sm text-gray-600"><strong>{{__("referee.tournament_name")}}</strong> Torneo muy top 1</p>
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
        
    </div>
</main>

@endsection
