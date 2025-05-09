@extends('admin.index')
@section('content')
<main class="flex-1 ms-10 me-10">
  <h1 class="text-2xl font-bold text-[var(--azul)] mb-4">Todos los Jugadores</h1>
  
  <table class="w-full border-collapse border border-gray-300 mb-8">
    <thead>
        <tr class="bg-gray-200">
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Nº</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Jugador</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">Campo</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">1</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">2</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">3</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">T1</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">1</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">2</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">3</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-[var(--azul)]">T2</th>
            <th class="border border-[var(--azul)] p-2 text-lg font-bold text-white bg-[#BE1622]">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allPlayers as $index => $player)
            @php
                // Obtener el campo del jugador
                $playerField = '';
                foreach (json_decode(File::get(public_path('sample_data.json')), true)['matches'] as $match) {
                    foreach ($match['players'] as $p) {
                        if ($p['id'] == $player['id']) {
                            $playerField = $match['field'];
                            break 2;
                        }
                    }
                }
                
                $latestRound = count($player['rounds']) > 0 ? $player['rounds'][count($player['rounds']) - 1] : null;
            @endphp
            
            <tr class="@switch($player['status'])
                    @case('playing_next') bg-green-300 @break
                    @case('preparing') bg-yellow-200 @break
                    @case('collecting') bg-red-400 @break
                    @default bg-gray-200 @endswitch">
                <td class="border border-[var(--azul)] p-2 text-center">{{ $index + 1 }}</td>
                <td class="border border-[var(--azul)] p-2">{{ $player['name'] }}</td>
                <td class="border border-[var(--azul)] p-2 text-center">{{ $playerField }}</td>
                
                @if($latestRound)
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t1'][0] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t1'][1] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t1'][2] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['total_t1'] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t2'][0] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t2'][1] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['t2'][2] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['total_t2'] ?? '' }}</td>
                    <td class="border border-[var(--azul)] p-2 text-center">{{ $latestRound['total'] ?? '' }}</td>
                @else
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                    <td class="border border-[var(--azul)] p-2 text-center"></td>
                @endif
            </tr>
        @endforeach
    </tbody>
  </table>

  <div class="flex flex-row justify-center mt-4">
    <p class="bg-green-300 p-1 m-2 border rounded-md">Próximo a jugar</p>
    <p class="bg-yellow-200 p-1 m-2 border rounded-md">Se prepara</p>
    <p class="bg-red-400 p-1 m-2 border rounded-md">Recoge</p>
    <p class="bg-gray-200 p-1 m-2 border rounded-md">En espera</p>
  </div>
</main>
@endsection