<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Statistikat - KV Gjinoci</title>
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
            padding: 24px 40px;
        }

        main {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #0001;
        }

        .card h2 {
            font-size: 36px;
            margin: 10px 0;
        }

        .card p {
            color: #64748b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #253858;
            color: white;
            text-align: left;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f8fafc;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 12px;
        }

        .btn {
            display: inline-block;
            background: #253858;
            color: white;
            padding: 12px 18px;
            border-radius: 6px;
            text-decoration: none;
        }

        @media (max-width: 700px) {
            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>KV Gjinoci - Statistikat</h1>
</header>

<main>
    <h1>Statistikat e Ekipeve</h1>

    <div class="cards">
        <div class="card">
            <p>Ndeshje te perfunduara</p>
            <h2>{{ $totalNdeshje }}</h2>
        </div>

        <div class="card">
            <p>Fitore totale</p>
            <h2>{{ $totalFitore }}</h2>
        </div>

        <div class="card">
            <p>Perqindja e fitoreve</p>
            <h2>
                {{ $totalNdeshje > 0
                    ? round($totalFitore / $totalNdeshje * 100, 1)
                    : 0 }}%
            </h2>
        </div>
    </div>

    <h2>Renditja sipas pikeve</h2>

    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Ekipi</th>
                <th>Ndeshje</th>
                <th>Fitore</th>
                <th>Humbje</th>
                <th>Sete +</th>
                <th>Sete -</th>
                <th>Fitore %</th>
                <th>Pike</th>
            </tr>
            </thead>

            <tbody>
            @forelse($statistikat as $stat)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <a href="{{ route('ekipet.show', $stat['ekipi']) }}">
                            {{ $stat['ekipi']->emri }}
                        </a>
                    </td>

                    <td>{{ $stat['ndeshje'] }}</td>
                    <td>{{ $stat['fitore'] }}</td>
                    <td>{{ $stat['humbje'] }}</td>
                    <td>{{ $stat['setet_fituara'] }}</td>
                    <td>{{ $stat['setet_humbura'] }}</td>
                    <td>{{ $stat['perqindja'] }}%</td>
                    <td><strong>{{ $stat['piket'] }}</strong></td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">
                        Nuk ka ekipe te regjistruara.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <p style="margin-top:30px;">
        <a class="btn" href="{{ route('ndeshjet.index') }}">
            Shiko Ndeshjet
        </a>

        <a class="btn" href="{{ route('dashboard') }}">
            Dashboard
        </a>
    </p>
</main>

</body>
</html>
