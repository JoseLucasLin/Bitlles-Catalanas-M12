<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-[var(--azul)]">{{__('main.login')}}</h2>
                </div>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Mostrar errores -->
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

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-lg font-medium text-[var(--azul)]">{{__('main.email')}}</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]"
                            required
                            autofocus
                            placeholder="{{__('main.email_example')}}">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-lg font-medium text-[var(--azul)]">{{__('main.password')}}</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="mt-2 p-2 w-full border border-[var(--azul)] rounded bg-[var(--crema)]"
                            required
                            placeholder="********">
                    </div>

                    <!-- Remember Me -->
                    <div class="block mb-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-[var(--azul)] text-[var(--azul)]">
                            <span class="ml-2 text-sm text-[var(--azul)]">{{ __('main.remember_me') }}</span>
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
    </div>
</x-app-layout>
