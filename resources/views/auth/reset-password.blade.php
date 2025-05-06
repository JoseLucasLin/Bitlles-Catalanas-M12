<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restablecer contraseña - Bitlles Catalanes</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex flex-col min-h-screen">

    <main class="flex-1 py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-[var(--azul)]">Restablecer contraseña</h2>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Token oculto -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Campo de email -->
                    <div class="mb-4">
                        <label for="mail" class="block text-lg font-medium text-[var(--azul)]">{{ __('main.email') }}</label>
                        <input
                            type="email"
                            id="mail"
                            name="mail"
                            value="{{ old('mail', $request->mail) }}"
                            class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]"
                            required
                            autofocus
                            autocomplete="username">
                        @error('mail')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo de contraseña -->
                    <div class="mb-4">
                        <label for="password" class="block text-lg font-medium text-[var(--azul)]">{{ __('main.password') }}</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]"
                            required
                            autocomplete="new-password">
                        @error('password')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirmación de contraseña -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-lg font-medium text-[var(--azul)]">Confirmar contraseña</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]"
                            required
                            autocomplete="new-password">
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-center mt-10">
                        <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                            Restablecer contraseña
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>
