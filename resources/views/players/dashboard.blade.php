@extends('admin.index')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <!-- Información del jugador -->
        <div class="flex items-center mb-6">
            <div class="mr-6">
                @if($player->image)
                    <img src="{{ asset('player-img/' . $player->image) }}" alt="{{ $player->name }}" class="rounded-full h-32 w-32 object-cover border-4 border-[var(--azul)]">
                @else
                    <div class="rounded-full h-32 w-32 bg-[var(--azul)] flex items-center justify-center text-white text-3xl font-bold">
                        {{ substr($player->name, 0, 1) }}{{ substr($player->lastname, 0, 1) }}
                    </div>
                @endif
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[var(--azul)]">{{ $player->name }} {{ $player->lastname }}</h1>
                @if(isset($player->partner))
                    <p class="text-gray-600">Partner: {{ $player->partner == 1 ? 'Sí' : 'No' }}</p>
                @endif
                <p class="text-gray-600">{{ $player->mail ?? 'Sin correo' }}</p>
                <p class="text-gray-600">Código: {{ $player->code }}</p>
            </div>
        </div>

        <!-- Mensaje de información -->
        <div class="bg-blue-100 p-4 rounded-lg mb-6">
            <p class="text-center text-blue-700">
                La información de estadísticas y torneos estará disponible cuando participes en competiciones.
            </p>
        </div>

        <!-- Información de perfil adicional -->
        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            <h2 class="text-2xl font-bold text-[var(--azul)] mb-4">Datos de Perfil</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="font-semibold">Nombre completo:</p>
                    <p>{{ $player->name }} {{ $player->lastname }}</p>
                </div>

                @if(isset($player->partner) && $player->partner)
                <div>
                    <p class="font-semibold">Partner</p>
                    <p>{{ $player->partner == 1 ? 'Sí' : 'No' }}</p>
                </div>
                @endif

                @if(isset($player->position) && $player->position)
                <div>
                    <p class="font-semibold">Posición:</p>
                    <p>{{ $player->position }}</p>
                </div>
                @endif

                @if(isset($player->mail) && $player->mail)
                <div>
                    <p class="font-semibold">Correo electrónico:</p>
                    <p>{{ $player->mail }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
