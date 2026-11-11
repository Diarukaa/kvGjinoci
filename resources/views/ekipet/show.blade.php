<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>{{ $ekipi->emri }} - KV Gjinoci</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6fa;
            padding: 35px;
        }
        main { max-width: 1000px; margin: auto; }
        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 14px;
            border-bottom: 1px solid #ddd;
        }
        th { background: #253858; color: white; }
    </style>
</head>
<body>
<main>
    <div class="card">
        <h1>{{ $ekipi->emri }}</h1>
        <p>Kategoria: {{ $ekipi->kategoria }}</p>

        <p>
            Trajneri:
            @if($ekipi->trajner)
                {{ $ekipi->trajner->emri }}
                {{ $ekipi->trajner->mbiemri }}
            @else
                Pa trajner
            @endif
        </p>

        <h3>Volejbolliste: {{ $ekipi->lojtaret->count() }}</h3>
    </div>

    <div class="card">
        <h2>Lista e Volejbollisteve</h2>

        <table>
            <thead>
            <tr>
                <th>Nr.</th>
                <th>Emri dhe Mbiemri</th>
                <th>Pozicioni</th>
                <th>Gjatesia</th>
                <th>Profili</th>
            </tr>
            </thead>
            <tbody>
            @forelse($ekipi->lojtaret as $lojtar)
                <tr>
                    <td>{{ $lojtar->numriFanelles }}</td>
                    <td>
                        {{ $lojtar->emri }}
                        {{ $lojtar->mbiemri }}
                    </td>
                    <td>{{ $lojtar->pozicioni }}</td>
                    <td>
                        {{ $lojtar->gjatesia !== null
                            ? $lojtar->gjatesia . ' cm'
                            : '-' }}
                    </td>
                    <td>
                        <a href="{{ route('lojtar.show', $lojtar) }}">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        Nuk ka volejbolliste ne kete ekip.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('ekipet.index') }}">Kthehu te Ekipet</a>
</main>
</body>
</html>
