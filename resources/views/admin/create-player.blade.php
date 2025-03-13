@extends('admin.index')

@section('content')
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">Registro de Jugador</h2>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
        @csrf

        <div class="mb-4">
            <label for="first_name" class="block text-lg font-medium text-[var(--azul)]">Nombre</label>
            <input type="text" id="first_name" name="first_name" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required placeholder="Escribe el nombre">
        </div>

        <div class="mb-4">
            <label for="last_name" class="block text-lg font-medium text-[var(--azul)]">Apellido/s</label>
            <input type="text" id="last_name" name="last_name" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required placeholder="Escribe los apellidos">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-lg font-medium text-[var(--azul)]">Correo electrónico (opcional)</label>
            <input type="email" id="email" name="email" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" placeholder="ejemplo@correo.com">
        </div>

        <div class="mb-4">
            <label for="partner" class="block text-lg font-medium text-[var(--azul)]">Es partner?</label>
            <select id="partner" name="partner" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-lg font-medium text-[var(--azul)]">Imagen de perfil (opcional)</label>
            <input type="file" id="image" name="image" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" accept="image/*">
        </div>

        <div class="text-center mt-10">
            <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                Registrar Jugador
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
