<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('main.login') }} - Bitlles Catalanes</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex flex-col min-h-screen">

    @include('layouts.nav')

    <main class="flex-1 py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-[var(--azul)]">{{__('main.login')}}</h2>
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

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="mail" class="block text-lg font-medium text-[var(--azul)]">{{__('main.email')}}</label>
                        <input
                            type="email"
                            id="mail"
                            name="mail"
                            value="{{ old('mail') }}"
                            class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="{{__('main.email_example')}}">
                        @error('mail')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-lg font-medium text-[var(--azul)]">{{__('main.password')}}</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]"
                            required
                            autocomplete="current-password"
                            placeholder="********">
                        @error('password')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="block mb-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-[var(--azul)] text-[var(--azul)]">
                            <span class="ml-2 text-sm text-[var(--azul)]">Remember me</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M4.25 2A2.25 2.25 0 0 0 2 4.25v11.5A2.25 2.25 0 0 0 4.25 18h11.5A2.25 2.25 0 0 0 18 15.75V4.25A2.25 2.25 0 0 0 15.75 2H4.25ZM6 13.25V3.5h8v9.75a.75.75 0 0 1-1.064.681L10 12.576l-2.936 1.355A.75.75 0 0 1 6 13.25Z" clip-rule="evenodd" />
                              </svg>
                        </label>
                    </div>

                    <div class="text-center mt-10">
                        <button type="submit" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105">
                            {{__('main.login')}}
                        </button>

                        @if (Route::has('password.request'))
                        <div class="mt-2">
                            <a href="{{ route('password.request') }}" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold flex items-center justify-center transition duration-300 underline">
                                {{__('main.forgot_password')}}
                            </a>
                        </div>
                        @endif

                        @if (Route::has('register'))
                        <div class="mt-2">
                            <a href="{{ route('register') }}" class="text-[var(--azul)] hover:text-[var(--rojo)] font-semibold flex items-center justify-center transition duration-300 underline">
                                {{__('main.no_account')}}
                            </a>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </main>

    @include('layouts.footer')

</body>
</html>
