@extends('admin.index')

@section('content')

<main class="flex-1 ms-10 me-10">

    <div class="text-center mt-10 mb-10">
        <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">{{ __('admin.admin_panel') }}</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-[var(--crema)] p-4 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-semibold text-[var(--azul)]">{{ __('admin.create_tournament') }}</h3>
            <p class="text-sm text-gray-600">{{ __('admin.create_tournament_description') }}</p>
            <div class="mt-2 flex justify-start">
                <a href="#" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 inline-flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>                  
                    <span>{{ __('admin.create') }}</span>
                </a>
            </div>
        </div>              

        <div class="bg-[var(--crema)] p-4 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-semibold text-[var(--azul)]">{{ __('admin.register_referee') }}</h3>
            <p class="text-sm text-gray-600">{{ __('admin.register_referee_description') }}</p>
            <div class="mt-2 flex justify-start">
                <a href="/admin/create-referee" class="bg-[var(--rojo)] text-[var(--blanco)] px-4 py-2 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 inline-flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>                                    
                    <span>{{ __('admin.register') }}</span>
                </a>
            </div>
        </div>

        <div class="bg-[var(--crema)] p-4 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-semibold text-[var(--azul)]">{{ __('admin.add_participants') }}</h3>
            <p class="text-sm text-gray-600">{{ __('admin.add_participants_description') }}</p>
            <div class="mt-2 flex justify-start">
                <a href="/admin/add-players" class="mt-2 bg-[var(--rojo)] text-[var(--blanco)] p-2 pe-4 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>                  
                    <span>{{ __('admin.add') }}</span>
                </a>
            </div>
        </div>

        <div class="bg-[var(--crema)] p-4 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-semibold text-[var(--azul)]">{{ __('admin.tournament_manager') }}</h3>
            <p class="text-sm text-gray-600">{{ __('admin.tournament_manager_description') }}</p>
            <div class="mt-2 flex justify-start">
                <a href="/admin/tournament-manager" class="mt-2 bg-[var(--rojo)] text-[var(--blanco)] p-2 pe-4 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>                                    
                    <span>{{ __('admin.manage') }}</span>
                </a>
            </div>
        </div>

        <div class="bg-[var(--crema)] p-4 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-semibold text-[var(--azul)]">{{ __('admin.generate_report') }}</h3>
            <p class="text-sm text-gray-600">{{ __('admin.generate_report_description') }}</p>
            <div class="mt-2 flex justify-start">
                <a href="#" class="mt-2 bg-[var(--rojo)] text-[var(--blanco)] p-2 pe-4 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>                                    
                    <span>{{ __('admin.generate') }}</span>
                </a>
            </div>
        </div>

        <div class="bg-[var(--crema)] p-4 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-semibold text-[var(--azul)]">{{ __('admin.export_results') }}</h3>
            <p class="text-sm text-gray-600">{{ __('admin.export_results_description') }}</p>
            <div class="mt-2 flex justify-start">
                <a href="#" class="mt-2 bg-[var(--rojo)] text-[var(--blanco)] p-2 pe-4 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>                                                      
                    <span>{{ __('admin.export') }}</span>
                </a>
            </div>
        </div>

        <div class="bg-[var(--crema)] p-4 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-semibold text-[var(--azul)]">{{ __('admin.register_player') }}</h3>
            <p class="text-sm text-gray-600">{{ __('admin.register_player_description') }}</p>
            <div class="mt-2 flex justify-start">
                <a href="/admin/create-player" class="mt-2 bg-[var(--rojo)] text-[var(--blanco)] p-2 pe-4 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>                 
                    <span>{{ __('admin.register') }}</span>
                </a>
            </div>
        </div>

        <div class="bg-[var(--crema)] p-4 shadow-xl rounded-lg border-[var(--azul)] border">
            <h3 class="text-lg font-semibold text-[var(--azul)]">{{ __('admin.search_player') }}</h3>
            <p class="text-sm text-gray-600">{{ __('admin.search_player_description') }}</p>
            <div class="mt-2 flex justify-start">
                <a href="#" class="mt-2 bg-[var(--rojo)] text-[var(--blanco)] p-2 pe-4 rounded transition duration-300 hover:bg-[var(--azul)] font-bold hover:scale-105 flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>                                  
                    <span>{{ __('admin.search') }}</span>
                </a>
            </div>
        </div>

    </div>
</main>

@endsection