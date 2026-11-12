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
    <p>
        <strong>Sezoni:</strong>
        {{ $ndeshja->sezoni?->emri ?? 'Pa sezon' }}
    </p>

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


        @if($ndeshja->statusi === 'Perfunduar')

            <h2>Statistikat Individuale</h2>

            <p>
                <a href="{{ route('statistikat-lojtareve.create', $ndeshja) }}">
                    + Shto / Edito Statistikat
                </a>
            </p>

            <div style="overflow-x:auto">
                <table>
                    <thead>
                    <tr>
                        <th>Volejbollistja</th>
                        <th>Kills</th>
                        <th>Aces</th>
                        <th>Blocks</th>
                        <th>Digs</th>
                        <th>Pike</th>
                        <th>Veprimet</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($ndeshja->statistikat as $stat)
                        <tr>
                            <td>
                                {{ $stat->lojtar->emri }}
                                {{ $stat->lojtar->mbiemri }}
                            </td>
                            <td>{{ $stat->kills }}</td>
                            <td>{{ $stat->aces }}</td>
                            <td>{{ $stat->blocks }}</td>
                            <td>{{ $stat->digs }}</td>
                            <td>
                                <strong>{{ $stat->piket }}</strong>
                            </td>
                            <td>
                                <form method="POST"
                                      action="{{ route('statistikat-lojtareve.destroy', [$ndeshja, $stat]) }}"
                                      onsubmit="return confirm('A je i sigurt?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Fshi</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                Nuk ka statistika individuale.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        @endif


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


    @if(session('success'))
        <p style="color:green">
            {{ session('success') }}
        </p>
    @endif

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if($ndeshja->statusi === 'Perfunduar')
        <div style="margin:25px 0;
                padding:20px;
                background:#f3f5f9;
                border-radius:10px;">

            <h3>Integrimi me Kampionatin</h3>

            @if($ndeshja->rezultatiLiges)

                <p style="color:green">
                    Ndeshja eshte e lidhur me kampionatin.
                </p>

                <a href="{{ route('liga.index',
                $ndeshja->rezultatiLiges->kampionati_id) }}">
                    Shiko Klasifikimin
                </a>

            @else

                <p>
                    Kjo ndeshje ende nuk eshte
                    e lidhur me kampionatin.
                </p>

                <a href="{{ route('ndeshjet.lidh-ligen', $ndeshja) }}">
                    + Lidh me Kampionatin
                </a>

            @endif

        </div>
    @endif

    <p>
        <a href="{{ route('ndeshjet.index') }}">
            Kthehu te Ndeshjet
        </a>
    </p>
</div>
</body>
</html>
