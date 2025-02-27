@extends('admin.index')

@section('content')
<main class="flex-1 ms-10 me-10">
    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">Registro de Árbitro</h2>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
        @csrf

        <div class="mb-4">
            <label for="username" class="block text-lg font-medium text-[var(--azul)]">Nombre de usuario</label>
            <input type="text" id="username" name="username" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required placeholder="Escribe el nombre de usuario">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-lg font-medium text-[var(--azul)]">Correo electrónico</label>
            <input type="email" id="email" name="email" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" required placeholder="ejemplo@correo.com">
        </div>

        <div class="mb-4 relative">
            <label for="password" class="block text-lg font-medium text-[var(--azul)]">Contraseña</label>
            <input type="password" id="password" name="password" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)] pr-10" required placeholder="Crea una contraseña">
            <span class="absolute inset-y-0 right-0 pr-3 flex items-center mt-8 cursor-pointer" onclick="togglePasswordVisibility('password', 'password-toggle')">
                <svg id="password-toggle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                </svg>
            </span>
        </div>

        <div class="mb-4 relative">
            <label for="confirm_password" class="block text-lg font-medium text-[var(--azul)]">Confirmar contraseña</label>
            <input type="password" id="confirm_password" name="confirm_password" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)] pr-10" required placeholder="Repite la contraseña">
            <span class="absolute inset-y-0 right-0 pr-3 flex items-center mt-8 cursor-pointer" onclick="togglePasswordVisibility('confirm_password', 'confirm-password-toggle')">
                <svg id="confirm-password-toggle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                </svg>
            </span>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-lg font-medium text-[var(--azul)]">Imagen de perfil</label>
            <input type="file" id="image" name="image" class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]" accept="image/*">
        </div>

        <div class="text-center mt-10">
            <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                Registrar Árbitro
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

<script>
    function togglePasswordVisibility(fieldId, toggleId) {
        const passwordField = document.getElementById(fieldId);
        const toggleIcon = document.getElementById(toggleId);

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>`;
        } else {
            passwordField.type = "password";
            toggleIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>`;
        }
    }
</script>
@endsection