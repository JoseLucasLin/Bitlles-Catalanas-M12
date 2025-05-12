@extends('admin.index')
@section('content')
<main class="flex-1 ms-10 me-10">
  <h1 class="text-2xl font-bold text-[var(--azul)] mb-4">Resultados Generales del Torneo</h1>
  
  <table class="w-full border-collapse border border-gray-300 mb-8">
    <thead>
        <tr class="bg-gray-200">
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Posición</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Jugador</th>
            @for($i = 1; $i <= $maxRounds; $i++)
                <th colspan="3" class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)] text-center">
                    Ronda {{ $i }}
                </th>
            @endfor
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-white bg-[#BE1622]">Total</th>
        </tr>
        <tr class="bg-gray-100">
            <th class="border border-[var(--azul)] p-2"></th>
            <th class="border border-[var(--azul)] p-2"></th>
            @for($i = 1; $i <= $maxRounds; $i++)
                <th class="border border-[var(--azul)] p-2 text-sm font-bold text-[var(--azul)]">T1</th>
                <th class="border border-[var(--azul)] p-2 text-sm font-bold text-[var(--azul)]">T2</th>
                <th class="border border-[var(--azul)] p-2 text-sm font-bold text-[var(--azul)]">Acumulado</th>
            @endfor
            <th class="border border-[var(--azul)] p-2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($allPlayers as $index => $player)
            <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                <td class="border border-[var(--azul)] p-2 text-center font-bold">{{ $index + 1 }}</td>
                <td class="border border-[var(--azul)] p-2 font-bold">{{ $player['name'] }}</td>
                
                @foreach(range(1, $maxRounds) as $roundNumber)
                    @php
                        $round = collect($player['rounds'])->firstWhere('round_number', $roundNumber);
                    @endphp
                    
                    @if($round)
                        <td class="border border-[var(--azul)] p-2 text-center">
                            {{ implode(' ', $round['t1']) }}
                        </td>
                        <td class="border border-[var(--azul)] p-2 text-center">
                            {{ implode(' ', $round['t2']) }}
                        </td>
                        <td class="border border-[var(--azul)] p-2 text-center">
                            {{ $round['acumulado'] }}
                        </td>
                    @else
                        <td class="border border-[var(--azul)] p-2 text-center">-</td>
                        <td class="border border-[var(--azul)] p-2 text-center">-</td>
                        <td class="border border-[var(--azul)] p-2 text-center">-</td>
                    @endif
                @endforeach
                
                <td class="border border-[var(--azul)] p-2 text-center font-bold text-white bg-[#BE1622]">
                    {{ $player['total_acumulado'] }}
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>

  <div class="flex">
    <div class="bg-[var(--crema)]  shadow-xl rounded-lg">
        <div class="flex justify-start space-x-2">
            <a href="{{ url('/general?export=pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded transition duration-300 hover:bg-red-700 font-bold hover:scale-105 inline-flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>PDF</span>
            </a>
        </div>
    </div>
</div>
</main>
@endsection