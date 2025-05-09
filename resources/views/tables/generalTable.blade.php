@extends('admin.index')
@section('content')
<main class="flex-1 ms-10 me-10">
  <h1 class="text-2xl font-bold text-[var(--azul)] mb-4">Resultados Generales del Torneo</h1>
  
  <table class="w-full border-collapse border border-gray-300 mb-8">
    <thead>
        <tr class="bg-gray-200">
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Posición</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Jugador</th>
            @foreach($allPlayers[0]['rounds'] ?? [] as $round)
                <th colspan="3" class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)] text-center">
                    Ronda {{ $round['round_number'] }}
                </th>
            @endforeach
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-white bg-[#BE1622]">Total</th>
        </tr>
        <tr class="bg-gray-100">
            <th class="border border-[var(--azul)] p-2"></th>
            <th class="border border-[var(--azul)] p-2"></th>
            @foreach($allPlayers[0]['rounds'] ?? [] as $round)
                <th class="border border-[var(--azul)] p-2 text-sm font-bold text-[var(--azul)]">T1</th>
                <th class="border border-[var(--azul)] p-2 text-sm font-bold text-[var(--azul)]">T2</th>
                <th class="border border-[var(--azul)] p-2 text-sm font-bold text-[var(--azul)]">Acumulado</th>
            @endforeach
            <th class="border border-[var(--azul)] p-2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($allPlayers as $index => $player)
            @php
                $acumulado = 0;
            $max_rounds = count($allPlayers[0]['rounds'] ?? []);
            $player_rounds = count($player['rounds']);
            $rounds_difference = $max_rounds - $player_rounds;
            @endphp
            
            <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                <td class="border border-[var(--azul)] p-2 text-center font-bold">{{ $index + 1 }}</td>
                <td class="border border-[var(--azul)] p-2 font-bold">{{ $player['name'] }}</td>
                
                @foreach($player['rounds'] as $round)
                    @php
                        $acumulado += $round['total'];
                    @endphp
                    <td class="border border-[var(--azul)] p-2 text-center">
                        {{ implode(' ', $round['t1']) }}
                    </td>
                    <td class="border border-[var(--azul)] p-2 text-center">
                        {{ implode(' ', $round['t2']) }}
                    </td>
                    <td class="border border-[var(--azul)] p-2 text-center">
                        {{ $acumulado }}
                    </td>
                @endforeach
                
                @for($i = 0; $i < $rounds_difference; $i++)
                    <td class="border border-[var(--azul)] p-2 text-center">-</td>
                    <td class="border border-[var(--azul)] p-2 text-center">-</td>
                    <td class="border border-[var(--azul)] p-2 text-center">-</td>
                @endfor
                
                <td class="border border-[var(--azul)] p-2 text-center font-bold text-white bg-[#BE1622]">
                    {{ $player['total_acumulado'] }}
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</main>
@endsection