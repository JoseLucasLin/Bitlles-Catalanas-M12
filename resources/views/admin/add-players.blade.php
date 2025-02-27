@extends('admin.index')

@section('content')

<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">Añadir participantes al torneo</h2>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
        @csrf

        <div class="mb-4">
            <label for="tournament" class="block text-lg font-medium text-[var(--azul)]">Seleccionar torneo</label>
            <select id="tournament" name="tournament" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                <option value="" disabled selected>Selecciona un torneo</option>
                <option value="1">Torneo 1</option>
                <option value="2">Torneo 2</option>
                <option value="3">Torneo 3</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="participant_type" class="block text-lg font-medium text-[var(--azul)]">Tipo de participante</label>
            <select id="participant_type" name="participant_type" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                <option value="" disabled selected>Selecciona un tipo</option>
                <option value="player">Jugador</option>
                <option value="referee">Árbitro</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="username" class="block text-lg font-medium text-[var(--azul)]">Nombre de usuario</label>
            <input type="text" id="username" name="username" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required placeholder="Escribe el nombre de usuario">
        </div>

        <div class="text-center mt-10">
            <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                Añadir participante
            </button>
            <div class="mt-2">
                <a href="#" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold flex items-center justify-center transition duration-300 underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                    </svg>
                    <span class="ms-1">Volver al Panel Principal</span>
                </a>
            </div>                       
        </div>
    </form>
</main>

@endsection