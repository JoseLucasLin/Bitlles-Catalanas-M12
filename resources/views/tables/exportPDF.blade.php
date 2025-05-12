<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultados del Torneo</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .total-cell { background-color: #BE1622; color: white; font-weight: bold; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { color: #1a365d; font-size: 24px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Resultados Generales del Torneo</h1>
        <p>Generado el: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Posición</th>
                <th>Jugador</th>
                @for($i = 1; $i <= $maxRounds; $i++)
                    <th colspan="3">Ronda {{ $i }}</th>
                @endfor
                <th>Total</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                @for($i = 1; $i <= $maxRounds; $i++)
                    <th>T1</th>
                    <th>T2</th>
                    <th>Acumulado</th>
                @endfor
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($allPlayers as $index => $player)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $player['name'] }}</td>
                    
                    @foreach(range(1, $maxRounds) as $roundNumber)
                        @php
                            $round = collect($player['rounds'])->firstWhere('round_number', $roundNumber);
                        @endphp
                        
                        @if($round)
                            <td>{{ implode(' ', $round['t1']) }}</td>
                            <td>{{ implode(' ', $round['t2']) }}</td>
                            <td>{{ $round['acumulado'] }}</td>
                        @else
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        @endif
                    @endforeach
                    
                    <td class="total-cell">{{ $player['total_acumulado'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>