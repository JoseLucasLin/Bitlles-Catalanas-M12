<nav class="navbar" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/">
                    <img src="{{ asset('main-img/logo.png') }}" alt="logo" class="h-[7rem]">
                </a>
            </div>

            <!-- Menú principal (escritorio) -->
            <div class="hidden md:flex md:items-center md:space-x-6">
                <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text hover:bg-[var(--crema-oscuro)]">Novedades</a>
                <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text hover:bg-[var(--crema-oscuro)]">Tanques</a>
                <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text hover:bg-[var(--crema-oscuro)]">Piezas</a>
                <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text hover:bg-[var(--crema-oscuro)]">Outlet</a>
                <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text hover:bg-[var(--crema-oscuro)]">Paises</a>
            </div>

            <!-- Elementos de la derecha -->
            <div class="flex items-center space-x-2">
                <!-- Selector de idioma -->
                <div class="relative" x-data="{ languageOpen: false }">
                    <button @click="languageOpen = !languageOpen" @click.away="languageOpen = false" class="text-[var(--azul)] hover:text-[var(--rojo)] flex items-center focus:outline-none p-3 rounded-xl hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                        <img src="{{ asset('flags/' . app()->getLocale() . '.png') }}" alt="{{ app()->getLocale() }}" class="h-5 w-7 me-1">
                        <span class="font-semibold">
                            {{ strtoupper(app()->getLocale()) }}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 ms-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
            
                    <div x-show="languageOpen" class="absolute right-0 mt-2 w-24 bg-white rounded-md shadow-lg py-1 z-50 border border-[var(--azul)]">
                        <a href="{{ url('language/es') }}" class="text-[var(--azul)] hover:text-[var(--rojo)] flex items-center px-4 py-2 text-sm hover:bg-[var(--crema-oscuro)] transition-colors duration-300">
                            <img src="{{ asset('flags/es.png') }}" alt="ES" class="h-5 w-7 mr-2">
                            <span class="font-semibold">ES</span>
                        </a>
                        <a href="{{ url('language/cat') }}" class="text-[var(--azul)] hover:text-[var(--rojo)] flex items-center px-4 py-2 text-sm hover:bg-[var(--crema-oscuro)] transition-colors duration-300">
                            <img src="{{ asset('flags/cat.png') }}" alt="CAT" class="h-5 w-7 mr-2">
                            <span class="font-semibold">CAT</span>
                        </a>
                        <a href="{{ url('language/en') }}" class="text-[var(--azul)] hover:text-[var(--rojo)] flex items-center px-4 py-2 text-sm hover:bg-[var(--crema-oscuro)] transition-colors duration-300">
                            <img src="{{ asset('flags/en.png') }}" alt="EN" class="h-5 w-7 mr-2">
                            <span class="font-semibold">EN</span>
                        </a>
                    </div>
                </div>

                <!-- Menú de usuario (visible en móvil y escritorio) -->
                @guest
                    <!-- Botón de login en móvil -->
                    <div class="md:hidden">
                        <a class="text-white p-2 transition-all duration-300 rounded-lg font-semibold text-sm bg-[var(--azul)] hover:bg-[var(--rojo)] flex items-center" href="{{ route('login') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    </div>
                @else
                    <!-- Menú de usuario autenticado en móvil (versión compacta) -->
                    <div class="relative md:hidden" x-data="{ mobileProfileOpen: false }">
                        <button @click="mobileProfileOpen = !mobileProfileOpen" class="flex items-center focus:outline-none hover:bg-[var(--crema-oscuro)] p-2 rounded-xl transition-all duration-300" type="button">
                            <svg class="h-8 w-8 rounded-full p-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Menú desplegable móvil -->
                        <div x-show="mobileProfileOpen" @click.away="mobileProfileOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-[var(--azul)]">
                            <div class="px-4 py-2 text-sm text-[var(--azul)] font-bold border-b border-[var(--azul)]">
                                {{ Auth::user()->username }}
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                Mi Perfil
                            </a>
                            @if(Auth::user()->role == 2)
                            <a href="{{ url('/admin') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                Panel Admin
                            </a>
                            @endif
                            @if(Auth::user()->role == 1)
                            <a href="{{ url('/arbitro') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                Panel Árbitro
                            </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest

                <!-- Menú de usuario (escritorio) - se mantiene igual -->
                <div class="hidden md:flex md:items-center">
                    @guest
                    <a class="text-white p-3 transition-all duration-300 rounded-lg font-semibold text-lg bg-[var(--azul)] hover:bg-[var(--rojo)] flex items-center" href="{{ route('login') }}">
                        {{__('navbar.login')}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </a>
                    @else
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" class="flex items-center focus:outline-none hover:bg-[var(--crema-oscuro)] p-2 rounded-xl transition-all duration-300" type="button">
                            <svg class="h-10 w-10 rounded-full p-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 text-[var(--azul)]">{{ Auth::user()->username }}</span>
                            <svg class="ml-1 h-5 w-5 text-[var(--azul)]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="profileOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-[var(--azul)]">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                Mi Perfil
                            </a>
                            @if(Auth::user()->role == 2)
                            <a href="{{ url('/admin') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                Panel Admin
                            </a>
                            @endif
                            @if(Auth::user()->role == 1)
                            <a href="{{ url('/arbitro') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                Panel Árbitro
                            </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                    @endguest
                </div>

                <!-- Botón de menú móvil -->
                <div class="flex items-center md:hidden navbar-text">
                    <button @click="mobileOpen = !mobileOpen" class="header-link p-3 rounded-lg transition-all duration-300 hover:bg-[var(--crema-oscuro)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Menú móvil (se mantiene igual) -->
    <div x-show="mobileOpen" class="md:hidden navbar-mini">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-center">
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text hover:bg-[var(--crema)]">Novedades</a>
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text hover:bg-[var(--crema)]">Tanques</a>
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text hover:bg-[var(--crema)]">Piezas</a>
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text hover:bg-[var(--crema)]">Outlet</a>
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text hover:bg-[var(--crema)]">Paises</a>
        </div>
    </div>
</nav>

<!-- Asegúrate de incluir Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>