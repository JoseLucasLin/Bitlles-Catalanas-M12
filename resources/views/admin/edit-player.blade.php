@extends('admin.index')

@section('content')
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">Editar Jugador</h2>
        <p class="text-gray-600">Actualiza la información del jugador</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 max-w-xl mx-auto">
            <strong>¡Éxito!</strong> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.update-player', $player->id) }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-8 text-center">
            <div class="mb-3 flex justify-center">
                <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-[var(--crema)]">
                    <img id="profilePreview" src="{{ asset('player-img/' . $player->image) }}" alt="{{ $player->name }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-200">
                        <label for="image" class="cursor-pointer p-2 bg-[var(--rojo)] text-white rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </label>
                    </div>
                </div>
            </div>
            <input type="file" id="image" name="image" class="hidden" accept="image/*" onchange="previewImage()">
            <label for="image" class="text-sm text-[var(--azul)] cursor-pointer hover:text-[var(--rojo)]">
                Cambiar foto de perfil
            </label>
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="first_name" class="block text-lg font-medium text-[var(--azul)]">Nombre</label>
            <input type="text" id="first_name" name="first_name" class="mt-2 p-2 w-full border @error('first_name') border-red-500 @else border-[var(--azul)] @enderror rounded bg-[var(--crema)]" required placeholder="Escribe el nombre" value="{{ old('first_name', $player->name) }}">
            @error('first_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="last_name" class="block text-lg font-medium text-[var(--azul)]">Apellido/s</label>
            <input type="text" id="last_name" name="last_name" class="mt-2 p-2 w-full border @error('last_name') border-red-500 @else border-[var(--azul)] @enderror rounded bg-[var(--crema)]" required placeholder="Escribe los apellidos" value="{{ old('last_name', $player->lastname) }}">
            @error('last_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-lg font-medium text-[var(--azul)]">Correo electrónico</label>
            <input type="email" id="email" name="email" class="mt-2 p-2 w-full border @error('email') border-red-500 @else border-[var(--azul)] @enderror rounded bg-[var(--crema)]" placeholder="ejemplo@correo.com" value="{{ old('email', $player->mail) }}">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="partner" class="block text-lg font-medium text-[var(--azul)]">Es partner?</label>
            <select id="partner" name="partner" class="mt-2 p-2 w-full border @error('partner') border-red-500 @else border-[var(--azul)] @enderror rounded bg-[var(--crema)]" required>
                <option value="1" {{ old('partner', $player->partner) == 1 ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ old('partner', $player->partner) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('partner')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-center mt-10">
            <div class="flex justify-center space-x-4">
                <a href="{{ route('admin.player-search') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition-all">
                    Cancelar
                </a>
                <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-6 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                    Guardar Cambios
                </button>
            </div>
        </div>
    </form>
</main>

<script>
    function previewImage() {
        const file = document.getElementById('image').files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
