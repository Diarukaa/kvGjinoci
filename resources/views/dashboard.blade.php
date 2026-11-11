<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KV Gjinoci - Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            color: #172b4d;
        }

        header {
            background: #172b4d;
            color: white;
            padding: 25px 40px;
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
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px #0001;
        }

        .card h2 {
            font-size: 34px;
            margin: 10px 0;
        }

        .card a {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .card p {
            color: #64748b;
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
    <h1>KV Gjinoci</h1>
    <p>Women's Volleyball Club Management System</p>
</header>

<main>
    <h1>Dashboard</h1>
    <p>Miresevini ne sistemin e menaxhimit te klubit.</p>

    <div class="cards">

        <div class="card">
            <h3>Volejbollistet</h3>
            <h2>{{ $totalLojtare }}</h2>
            <a href="{{ route('lojtar.index') }}">
                Menaxho Volejbollistet
            </a>
        </div>

        <div class="card">
            <h3>Trajneret</h3>
            <h2>{{ $totalTrajnere }}</h2>
            <a href="{{ route('trajner.index') }}">
                Menaxho Trajneret
            </a>
        </div>

        <div class="card">
            <h3>Ekipet</h3>
            <h2>{{ $totalEkipe }}</h2>
            <a href="{{ route('ekipet.index') }}">
                Menaxho Ekipet
            </a>
        </div>

        <div class="card">
            <h3>Ndeshjet</h3>
            <h2>{{ $totalNdeshje }}</h2>
            <a href="{{ route('ndeshjet.index') }}">
                Menaxho Ndeshjet
            </a>
        </div>

        <div class="card">
            <h3>Statistikat</h3>
            <p>Fitoret, humbjet dhe renditja e ekipeve.</p>
            <a href="{{ route('statistics.index') }}">
                Shiko Statistikat
            </a>
        </div>

        <div class="card">
            <h3>Menaxheret</h3>
            <h2>{{ $totalManagers }}</h2>
            <a href="{{ route('managers.index') }}">
                Menaxho Menaxheret
            </a>
        </div>

        <div class="card">
            <h3>Player Performance</h3>

            <p>
                Renditja, piket dhe performanca
                individuale e volejbollisteve.
            </p>

            <a href="{{ route('performance.index') }}">
                Shiko Performancen
            </a>
        </div>

    </div>
</main>

</body>
</html>
