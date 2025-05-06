<nav class="navbar border-b border-[var(--azul)]" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">

            <div class="flex-shrink-0 flex items-center">
                <a href="/">
                    <img src="{{ asset('main-img/logo.png') }}" alt="logo" class="h-[7rem]">
                </a>
            </div>

            <div class="flex items-center space-x-2">

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

                @guest

                    <div class="md:hidden">
                        <a class="text-white p-2 transition-all duration-300 rounded-lg font-semibold text-sm bg-[var(--azul)] hover:bg-[var(--rojo)] flex items-center" href="{{ route('login') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    </div>

                @else

                    <div class="relative md:hidden" x-data="{ mobileProfileOpen: false }">
                        <button @click="mobileProfileOpen = !mobileProfileOpen" class="flex items-center focus:outline-none hover:bg-[var(--crema-oscuro)] p-2 rounded-xl transition-all duration-300" type="button">
                            <img src="{{ asset('user-img/'.Auth::user()->image) }}" alt="user-img" class="w-10 h-10 rounded-full object-cover border-2 border-[var(--azul)]">
                        </button>

                        <div x-show="mobileProfileOpen" @click.away="mobileProfileOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-[var(--azul)]">
                            <div class="px-4 py-2 text-sm text-[var(--azul)] font-bold border-b border-[var(--azul)]">
                                {{ Auth::user()->username }}
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                {{__("navbar.my_profile")}}
                            </a>
                            @if(Auth::user()->role == 2)
                            <a href="{{ url('/admin') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                {{__("navbar.admin_panel")}}
                            </a>
                            @endif
                            @if(Auth::user()->role == 1)
                            <a href="{{ url('/referee') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                {{__("navbar.referee_panel")}}
                            </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                    {{__("navbar.logout")}}
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest

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
                            <img src="{{ asset('user-img/'.Auth::user()->image) }}" alt="user-img" class="w-10 h-10 rounded-full object-cover border-2 border-[var(--azul)]">
                            <span class="ml-2 text-[var(--azul)]">{{ Auth::user()->username }}</span>
                            <svg class="ml-1 h-5 w-5 text-[var(--azul)]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="profileOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-[var(--azul)]">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                {{__("navbar.my_profile")}}
                            </a>
                            @if(Auth::user()->role == 2)
                            <a href="{{ url('/admin') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                {{__("navbar.admin_panel")}}
                            </a>
                            @endif
                            @if(Auth::user()->role == 1)
                            <a href="{{ url('/referee') }}" class="block px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                {{__("navbar.referee_panel")}}
                            </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-[var(--azul)] hover:bg-[var(--crema-oscuro)] transition-all duration-300">
                                    {{__("navbar.logout")}}
                                </button>
                            </form>
                        </div>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>

</nav>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>