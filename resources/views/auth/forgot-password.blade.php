<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('main.forgot_password') }} - Bitlles Catalanes</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex flex-col min-h-screen">

    @include('layouts.nav')

    <main class="flex-1 py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-[var(--azul)]">{{ __('main.forgot_password') }}</h2>
                </div>

                <div class="mb-6 text-sm text-[var(--azul)] text-center">
                    No hay problema. Indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 text-center">
                        {{ session('status') }}
                    </div>
                @endif

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

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="mail" class="block text-lg font-medium text-[var(--azul)]">{{ __('main.email') }}</label>
                        <input
                            type="email"
                            id="mail"
                            name="mail"
                            value="{{ old('mail') }}"
                            class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]"
                            required
                            autofocus
                            placeholder="{{ __('main.email_example') }}">
                        @error('mail')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-center mt-10">
                        <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                            Enviar mail
                        </button>

                        <div class="mt-2">
                            <a href="{{ route('login') }}" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold flex items-center justify-center transition duration-300 underline">
                                Volver a inicio
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @include('layouts.footer')

</body>
</html>
