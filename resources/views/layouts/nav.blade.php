<nav class="navbar">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-24">
      
      <div class="flex-shrink-0 flex items-center">
        <a href="#">
          <img src="{{ asset('main-img/logo.png') }}" alt="logo" class="h-[7rem]">
        </a>
      </div>

      <div class="hidden md:flex md:items-center md:space-x-6">
        <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text">Novedades</a>
        <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text">Tanques</a>
        <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text">Piezas</a>
        <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text">Outlet</a>
        <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text">Paises</a>
      </div>

      <div>
        <!--añadir lista de lenguajes disponibles-->
      </div>

      <div class="hidden md:flex md:items-center md:space-x-6">
        <a class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text" href="#">{{__('main.login')}}</a>
      </div>

      <div id="mobile-menu-button" class="flex items-center md:hidden navbar-text">
        <button class="header-link p-3 rounded-lg transition-all duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>          
        </button>
      </div>
<nav class="navbar" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">

            <div class="flex-shrink-0 flex items-center">
                <a href="/">
                    <img src="{{ asset('main-img/logo.png') }}" alt="logo" class="h-[7rem]">
                </a>
            </div>

            <div class="hidden md:flex md:items-center md:space-x-6">
                <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text">Novedades</a>
                <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text">Tanques</a>
                <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text">Piezas</a>
                <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text">Outlet</a>
                <a href="#" class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text">Paises</a>
            </div>

            <div>
                @foreach (config('app.available_locales') as $locale)
                <a href="{{ route('locale.change', $locale) }}">{{ strtoupper($locale) }}</a>
                @endforeach
            </div>

            <div class="hidden md:flex md:items-center md:space-x-6">
                @guest
                <a class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text" href="{{ route('login') }}">LOGIN</a>
                @else
                <!-- Menú de usuario autenticado con foto de perfil -->
                <div class="relative" x-data="{ profileOpen: false }">
                    <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" class="flex items-center focus:outline-none" type="button">
                        <!-- Imagen de perfil genérica -->
                        <svg class="h-10 w-10 text-gray-500 bg-gray-200 rounded-full p-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-gray-700">{{ Auth::user()->username }}</span>
                        <svg class="ml-1 h-5 w-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Menú desplegable (controlado por Alpine.js) -->
                    <div x-show="profileOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Mi Perfil
                        </a>

                        @if(Auth::user()->role == 2)
                        <a href="{{ url('/admin') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Panel Admin
                        </a>
                        @endif

                        @if(Auth::user()->role == 1)
                        <a href="{{ url('/arbitro') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Panel Árbitro
                        </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
                @endguest
            </div>

            <div class="flex items-center md:hidden navbar-text">
                <button @click="mobileOpen = !mobileOpen" class="header-link p-3 rounded-lg transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-center">
      <a class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text" href="#">{{__('main.login')}}</a>
    <!-- Menú móvil controlado por Alpine.js -->
    <div x-show="mobileOpen" class="md:hidden navbar-mini">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-center">
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text">Novedades</a>
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text">Tanques</a>
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text">Piezas</a>
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text">Outlet</a>
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text">Paises</a>
        </div>

        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-center">
            @guest
            <a class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text" href="{{ route('login') }}">LOGIN</a>
            @else
            <div class="flex flex-col items-center">
                <!-- Foto de perfil genérica en móvil -->
                <svg class="h-16 w-16 text-gray-500 bg-gray-200 rounded-full p-2 mb-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700 font-medium mb-2">{{ Auth::user()->username }}</span>

                <a href="{{ route('profile.edit') }}" class="block w-full header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text mb-1">
                    Mi Perfil
                </a>

                @if(Auth::user()->role == 2)
                <a href="{{ url('/admin') }}" class="block w-full header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text mb-1">
                    Panel Admin
                </a>
                @endif

                @if(Auth::user()->role == 1)
                <a href="{{ url('/arbitro') }}" class="block w-full header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text mb-1">
                    Panel Árbitro
                </a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="block w-full header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
            @endguest
        </div>
    </div>
</nav>

<!-- Asegúrate de incluir Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
