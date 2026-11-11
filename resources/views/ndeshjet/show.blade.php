<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Detajet e Ndeshjes</title>
    <style>
        body { font-family: Arial; background: #f3f5f9; }
        .card {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }
        .score {
            font-size: 54px;
            font-weight: bold;
            color: #253858;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th { background: #253858; color: white; }
    </style>
</head>
<body>
<div class="card">
    <h1>Detajet e Ndeshjes</h1>

    <h2>
        {{ $ndeshja->ekipi->emri }}
        vs
        {{ $ndeshja->kundershtari }}
    </h2>

    <p>
        Data:
        {{ $ndeshja->data_ndeshjes->format('d.m.Y H:i') }}
    </p>

    <p>Palestra: {{ $ndeshja->palestra }}</p>
    <p>Lokacioni: {{ $ndeshja->lokacioni }}</p>
    <p>Statusi: {{ $ndeshja->statusi }}</p>

    @if($ndeshja->statusi === 'Perfunduar')
        <div class="score">
            {{ $ndeshja->setet_tona }}
            :
            {{ $ndeshja->setet_kundershtarit }}
        </div>

        <h3>Rezultatet e Seteve</h3>

        <table>
            <thead>
            <tr>
                <th>Seti</th>
                <th>KV Gjinoci</th>
                <th>Kundershtari</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ndeshja->setet as $seti)
                <tr>
                    <td>{{ $seti->numri_setit }}</td>
                    <td>{{ $seti->piket_tona }}</td>
                    <td>{{ $seti->piket_kundershtarit }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h3>
            @if($ndeshja->setet_tona > $ndeshja->setet_kundershtarit)
                Fitore e KV Gjinocit!
            @else
                Humbje e KV Gjinocit
            @endif
        </h3>
    @else
        <p>Ndeshja ende nuk eshte zhvilluar.</p>
    @endif

    <a href="{{ route('ndeshjet.edit', $ndeshja) }}">
        Edito
    </a>

    <p>
        <a href="{{ route('ndeshjet.index') }}">
            Kthehu te Ndeshjet
        </a>
    </p>
</div>
</body>
</html>
