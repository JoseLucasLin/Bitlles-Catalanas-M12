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

    </div>
  </div>

  <div id="mobile-menu" class="hidden md:hidden navbar-mini">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-center">
      <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text">Novedades</a>
      <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text">Tanques</a>
      <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text">Piezas</a>
      <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text">Outlet</a>
      <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg navbar-text">Paises</a>
    </div>

    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-center">
      <a class="header-link p-3 transition-all duration-300 rounded-lg font-semibold text-lg navbar-text" href="#">{{__('main.login')}}</a>
    </div>

  </div>
</nav>