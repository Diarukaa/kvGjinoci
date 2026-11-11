<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Player Performance - KV Gjinoci</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f5f9;
            color: #172b4d;
        }

        header {
            background: #172b4d;
            color: white;
            padding: 25px 40px;
        }

        main {
            max-width: 1250px;
            padding: 30px 20px;
            margin: auto;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #0001;
        }

        .card h2 {
            font-size: 32px;
            margin: 10px 0;
        }

        .card p {
            color: #64748b;
            margin: 0;
        }

        .filter {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        select, button {
            padding: 10px;
            border-radius: 6px;
        }

        button {
            background: #253858;
            color: white;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #253858;
            color: white;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 12px;
        }

        .top-player {
            background: #eef5ff;
            font-weight: bold;
        }

        a {
            color: #2563eb;
        }

        @media (max-width: 800px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>

<header>
    <h1>KV Gjinoci</h1>
    <p>Player Performance Dashboard</p>
</header>

<main>

    <h1>Statistikat e Volejbollisteve</h1>

    <div class="filter">
        <form method="GET"
              action="{{ route('performance.index') }}">

            <label>Zgjedh Ekipin:</label>

            <select name="ekipi_id">
                <option value="">Te gjitha ekipet</option>

                @foreach($ekipet as $ekipi)
                    <option value="{{ $ekipi->id }}"
                        @selected((string)$ekipiId === (string)$ekipi->id)>
                        {{ $ekipi->emri }}
                    </option>
                @endforeach
            </select>

            <label>Sezoni:</label>

            <select name="sezoni_id">
                <option value="">Te gjitha sezonet</option>

                @foreach($sezonet as $sezoni)
                    <option value="{{ $sezoni->id }}"
                        @selected((string)$sezoniId === (string)$sezoni->id)>
                        {{ $sezoni->emri }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Filtro</button>

            <a href="{{ route('performance.index') }}">
                Pastro
            </a>
        </form>
    </div>


    <div class="cards">
        <div class="card">
            <p>Volejbolliste</p>
            <h2>{{ $totalLojtare }}</h2>
        </div>

        <div class="card">
            <p>Ndeshje te perfunduara</p>
            <h2>{{ $totalNdeshje }}</h2>
        </div>

        <div class="card">
            <p>Pike individuale totale</p>
            <h2>{{ $totalPike }}</h2>
        </div>

        <div class="card">
            <p>Mesatarja me e larte</p>
            <h2>{{ number_format($mesatarjaMeELarte, 2) }}</h2>
        </div>
    </div>

    <h2>Top 5 Volejbollistet</h2>

    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th>Renditja</th>
                <th>Volejbollistja</th>
                <th>Ekipi</th>
                <th>Piket</th>
            </tr>
            </thead>
            <tbody>
            @forelse($top5 as $lojtar)
                <tr class="{{ $loop->first ? 'top-player' : '' }}">
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <a href="{{ route('lojtar.show', $lojtar) }}">
                            {{ $lojtar->emri }}
                            {{ $lojtar->mbiemri }}
                        </a>
                    </td>

                    <td>{{ $lojtar->ekipi?->emri ?? 'Pa ekip' }}</td>

                    <td>{{ $lojtar->total_pike }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        Nuk ka statistika te regjistruara.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <h2 style="margin-top:35px;">
        Renditja e Plote
    </h2>

    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Volejbollistja</th>
                <th>Ekipi</th>
                <th>Ndeshje</th>
                <th>Kills</th>
                <th>Aces</th>
                <th>Blocks</th>
                <th>Digs</th>
                <th>Pike</th>
                <th>Mesatarja</th>
            </tr>
            </thead>

            <tbody>
            @forelse($lojtaret as $lojtar)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <a href="{{ route('lojtar.show', $lojtar) }}">
                            {{ $lojtar->emri }}
                            {{ $lojtar->mbiemri }}
                        </a>
                    </td>

                    <td>
                        {{ $lojtar->ekipi?->emri ?? 'Pa ekip' }}
                    </td>

                    <td>{{ $lojtar->ndeshje_luajtura }}</td>
                    <td>{{ $lojtar->total_kills ?? 0 }}</td>
                    <td>{{ $lojtar->total_aces ?? 0 }}</td>
                    <td>{{ $lojtar->total_blocks ?? 0 }}</td>
                    <td>{{ $lojtar->total_digs ?? 0 }}</td>

                    <td>
                        <strong>{{ $lojtar->total_pike }}</strong>
                    </td>

                    <td>
                        {{ number_format($lojtar->mesatarja, 2) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">
                        Nuk ka volejbolliste.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <p style="margin-top:30px;">
        <a href="{{ route('dashboard') }}">
            Kthehu ne Dashboard
        </a>
    </p>

</main>

</body>
</html>
