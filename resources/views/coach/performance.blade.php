@extends('layouts.club')

@section('title', 'Player Performance - KV Gjinoci')

@section('content')

    <style>
        .pf-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px 0 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .pf-page * {
            box-sizing: border-box;
        }

        .pf-hero {
            background: linear-gradient(120deg, #172b4d, #315b89);
            border-radius: 20px;
            padding: 34px;
            color: white;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .pf-hero::after {
            content: "🏐";
            position: absolute;
            font-size: 240px;
            bottom: -85px;
            right: -30px;
            opacity: .07;
            pointer-events: none;
        }

        .pf-hero-content {
            position: relative;
            z-index: 1;
        }

        .pf-hero small {
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .pf-hero h1 {
            color: white !important;
            font-size: 32px;
            margin: 14px 0;
        }

        .pf-hero p {
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
            max-width: 670px;
        }

        .pf-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .pf-card h2 {
            color: #172b4d;
            margin: 0 0 10px;
            font-size: 22px;
        }

        .pf-subtitle {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 23px;
            line-height: 1.7;
        }

        /* FILTERS */

        .pf-filters {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            align-items: end;
            gap: 18px;
        }

        .pf-field label {
            display: block;
            color: #334155;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .pf-field select {
            width: 100%;
            min-height: 45px;
            padding: 12px 14px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            color: #172b4d;
            background: #f8fafc;
            font-size: 13px;
            outline: none;
        }

        .pf-field select:focus {
            border-color: #2563eb;
            background: white;
        }

        .pf-filter-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pf-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #253858;
            color: white !important;
            padding: 13px 18px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
        }

        .pf-btn:hover {
            filter: brightness(.94);
        }

        .pf-btn-light {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* STATISTICS */

        .pf-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 25px;
        }

        .pf-stat {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 21px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .pf-stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .pf-stat-top small {
            color: #64748b;
            font-size: 13px;
        }

        .pf-icon {
            width: 39px;
            height: 39px;
            background: #e8efff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .pf-stat h3 {
            font-size: 31px;
            margin: 15px 0 0;
            color: #172b4d;
        }

        .pf-stat-points {
            background: #edf4ff;
            border-color: #dbeafe;
        }

        .pf-stat-points h3 {
            color: #2563eb;
        }

        /* TOP PLAYER */

        .pf-top {
            background: linear-gradient(125deg, #172b4d, #315b89);
            color: white;
            border-radius: 17px;
            padding: 28px;
            margin-bottom: 25px;
        }

        .pf-top-label {
            color: #fcd34d;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        .pf-top-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin: 20px 0 25px;
        }

        .pf-top-player {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .pf-top-avatar {
            width: 72px;
            height: 72px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .pf-top h2 {
            color: white !important;
            margin: 0 0 9px;
            font-size: 25px;
        }

        .pf-top p {
            color: #bfdbfe;
            margin: 0;
            font-size: 13px;
            line-height: 1.6;
        }

        .pf-top-score {
            text-align: right;
        }

        .pf-top-score strong {
            display: block;
            font-size: 45px;
            color: white;
        }

        .pf-top-score small {
            color: #bfdbfe;
            font-size: 12px;
        }

        .pf-top-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .pf-top-stat {
            background: rgba(255,255,255,.11);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 11px;
            padding: 17px;
        }

        .pf-top-stat small {
            color: #bfdbfe;
            display: block;
            margin-bottom: 10px;
            font-size: 12px;
        }

        .pf-top-stat strong {
            font-size: 23px;
            color: white;
        }

        /* RANKING TABLE */

        .pf-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
        }

        .pf-page table {
            width: 100%;
            min-width: 930px;
            border-collapse: collapse;
        }

        .pf-page th {
            background: #253858;
            color: white;
            padding: 15px 13px;
            font-size: 12px;
            text-align: left;
            white-space: nowrap;
        }

        .pf-page td {
            padding: 17px 13px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
            vertical-align: middle;
        }

        .pf-page tbody tr:hover {
            background: #f8fafc;
        }

        .pf-rank {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #edf2f7;
            color: #475569;
            font-size: 13px;
            font-weight: bold;
        }

        .pf-rank-first {
            background: #fef3c7;
            color: #b45309;
        }

        .pf-player {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .pf-avatar {
            width: 39px;
            height: 39px;
            border-radius: 11px;
            background: #e8efff;
            color: #253858;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 13px;
            flex-shrink: 0;
        }

        .pf-player strong {
            display: block;
            margin-bottom: 5px;
            white-space: nowrap;
        }

        .pf-player small {
            font-size: 11px;
            color: #64748b;
        }

        .pf-points {
            display: inline-flex;
            background: #e8efff;
            color: #2563eb;
            border-radius: 8px;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 14px;
        }

        .pf-note {
            background: #edf4ff;
            color: #315b89;
            padding: 16px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 12px;
            line-height: 1.7;
        }

        /* BAR CHART */

        .pf-chart-row {
            display: grid;
            grid-template-columns: 180px 1fr 50px;
            align-items: center;
            gap: 16px;
            padding: 13px 0;
        }

        .pf-chart-name {
            font-size: 13px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .pf-chart-track {
            height: 15px;
            background: #edf2f7;
            border-radius: 10px;
            overflow: hidden;
        }

        .pf-chart-bar {
            background: linear-gradient(90deg, #315b89, #60a5fa);
            height: 100%;
            border-radius: 10px;
        }

        .pf-chart-value {
            text-align: right;
            font-size: 13px;
            font-weight: bold;
            color: #2563eb;
        }

        .pf-empty {
            text-align: center;
            color: #64748b;
            padding: 35px !important;
            font-size: 13px;
            line-height: 1.7;
        }

        .pf-empty-icon {
            font-size: 35px;
            margin-bottom: 15px;
        }

        .pf-error {
            color: #be123c;
            background: #fff1f2;
            border: 1px solid #fecdd3;
            padding: 15px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        @media (max-width: 850px) {

            .pf-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .pf-filters {
                grid-template-columns: repeat(2, 1fr);
            }

            .pf-filter-actions {
                grid-column: 1 / -1;
            }

        }

        @media (max-width: 550px) {

            .pf-hero,
            .pf-card,
            .pf-top {
                padding: 20px;
            }

            .pf-hero h1 {
                font-size: 25px;
            }

            .pf-filters {
                grid-template-columns: 1fr;
            }

            .pf-stats {
                gap: 10px;
            }

            .pf-stat {
                padding: 15px;
            }

            .pf-icon {
                width: 30px;
                height: 30px;
                font-size: 15px;
            }

            .pf-stat h3 {
                font-size: 25px;
            }

            .pf-top-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .pf-top-avatar {
                width: 47px;
                height: 47px;
                font-size: 17px;
            }

            .pf-top h2 {
                font-size: 17px;
            }

            .pf-top-score strong {
                font-size: 30px;
            }

            .pf-chart-row {
                grid-template-columns: 100px 1fr 35px;
                gap: 10px;
            }
        }
    </style>

    <div class="pf-page">

        {{-- HERO --}}

        <div class="pf-hero">

            <div class="pf-hero-content">

                <small>KV GJINOCI | PERFORMANCE CENTER</small>

                <h1>Player Performance</h1>

                <p>
                    Analizo performancen individuale te volejbollisteve,
                    percjell progresin dhe krahaso statistikat
                    e ekipeve qe i udheheq.
                </p>

            </div>

        </div>

        {{-- FILTERS --}}

        <div class="pf-card">

            <h2>Filtro Performancen</h2>

            <p class="pf-subtitle">
                Zgjedh ekipin dhe sezonin per te analizuar statistikat.
            </p>

            @if($errors->any())

                <div class="pf-error">

                    @foreach($errors->all() as $error)

                        <div>{{ $error }}</div>

                    @endforeach

                </div>

            @endif

            <form method="GET"
                  action="{{ route('coach.performance') }}"
                  class="pf-filters">

                <div class="pf-field">

                    <label for="ekipi_id">Ekipi</label>

                    <select name="ekipi_id" id="ekipi_id">

                        <option value="">Te gjitha ekipet e mia</option>

                        @foreach($ekipet as $ekipi)

                            <option value="{{ $ekipi->id }}"
                                @selected($ekipiId == $ekipi->id)>

                                {{ $ekipi->emri }}

                                @if($ekipi->kategoria)

                                    ({{ $ekipi->kategoria }})

                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="pf-field">

                    <label for="sezoni_id">Sezoni</label>

                    <select name="sezoni_id" id="sezoni_id">

                        <option value="">Te gjitha sezonet</option>

                        @foreach($sezonet as $sezoni)

                            <option value="{{ $sezoni->id }}"
                                @selected($sezoniId == $sezoni->id)>

                                {{ $sezoni->emri }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="pf-filter-actions">

                    <button type="submit" class="pf-btn">
                        Filtro
                    </button>

                    <a href="{{ route('coach.performance') }}"
                       class="pf-btn pf-btn-light">
                        Pastro
                    </a>

                </div>

            </form>

        </div>

        {{-- TOTAL STATISTICS --}}

        <div class="pf-stats">

            @foreach([
                ['Volejbolliste', $totalLojtare, '👥'],
                ['Ndeshje te Perfunduar', $totalNdeshje, '🏐'],
                ['Pike Totale', $totalPike, '🏆'],
                ['Kills Totale', $totalKills, '⚡'],
                ['Aces Totale', $totalAces, '🎯'],
                ['Blocks Totale', $totalBlocks, '🛡️'],
                ['Digs Totale', $totalDigs, '🤾'],
                ['Me Statistika', $performance->where('ndeshje', '>', 0)->count(), '📊']
            ] as [$label, $value, $icon])

                <div class="pf-stat {{ $label === 'Pike Totale' ? 'pf-stat-points' : '' }}">

                    <div class="pf-stat-top">

                        <small>{{ $label }}</small>

                        <div class="pf-icon">
                            {{ $icon }}
                        </div>

                    </div>

                    <h3>{{ $value }}</h3>

                </div>

            @endforeach

        </div>

        {{-- TOP PLAYER --}}

        @if($topPlayer)

            <div class="pf-top">

            <span class="pf-top-label">

                🏆 VOLEJBOLLISTJA ME ME SE SHUMTI PIKE

            </span>

                <div class="pf-top-content">

                    <div class="pf-top-player">

                        <div class="pf-top-avatar">

                            {{ mb_strtoupper(
                                mb_substr($topPlayer['emri'], 0, 1)
                                .
                                mb_substr($topPlayer['mbiemri'], 0, 1)
                            ) }}

                        </div>

                        <div>

                            <h2>

                                {{ $topPlayer['emri'] }}
                                {{ $topPlayer['mbiemri'] }}

                            </h2>

                            <p>

                                {{ $topPlayer['pozicioni'] ?? '-' }}

                                |

                                {{ $topPlayer['ekipi'] }}

                            </p>

                            <p>

                                {{ $topPlayer['ndeshje'] }} ndeshje me statistika

                                |

                                {{ $topPlayer['mesatarja'] }} pike/ndeshje

                            </p>

                        </div>

                    </div>

                    <div class="pf-top-score">

                        <strong>{{ $topPlayer['piket'] }}</strong>

                        <small>PIKE TOTALE</small>

                    </div>

                </div>

                <div class="pf-top-grid">

                    @foreach([
                        'Kills' => 'kills',
                        'Aces' => 'aces',
                        'Blocks' => 'blocks',
                        'Digs' => 'digs'
                    ] as $label => $key)

                        <div class="pf-top-stat">

                            <small>{{ $label }}</small>

                            <strong>{{ $topPlayer[$key] }}</strong>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

        {{-- PERFORMANCE TABLE --}}

        <div class="pf-card">

            <h2>Renditja e Volejbollisteve</h2>

            <p class="pf-subtitle">

                Volejbollistet renditen sipas totalit te pikeve individuale.

            </p>

            <div class="pf-table-wrap">

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

                        <th>Pike/Ndeshje</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($performance as $player)

                        <tr>

                            <td>

                                @if($player['ndeshje'] > 0)

                                    <span class="pf-rank {{ $loop->first ? 'pf-rank-first' : '' }}">

                                        {{ $loop->iteration }}

                                    </span>

                                @else

                                    <span class="pf-rank">-</span>

                                @endif

                            </td>

                            <td>

                                <div class="pf-player">

                                    <div class="pf-avatar">

                                        {{ mb_strtoupper(
                                            mb_substr($player['emri'], 0, 1)
                                            .
                                            mb_substr($player['mbiemri'], 0, 1)
                                        ) }}

                                    </div>

                                    <div>

                                        <strong>

                                            {{ $player['emri'] }}
                                            {{ $player['mbiemri'] }}

                                        </strong>

                                        <small>

                                            {{ $player['pozicioni'] ?? '-' }}

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>{{ $player['ekipi'] }}</td>

                            <td>{{ $player['ndeshje'] }}</td>

                            <td>{{ $player['kills'] }}</td>

                            <td>{{ $player['aces'] }}</td>

                            <td>{{ $player['blocks'] }}</td>

                            <td>{{ $player['digs'] }}</td>

                            <td>

                                <span class="pf-points">

                                    {{ $player['piket'] }}

                                </span>

                            </td>

                            <td>

                                {{ $player['ndeshje'] > 0
                                    ? number_format($player['mesatarja'], 1)
                                    : '-' }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10" class="pf-empty">

                                Nuk ka volejbolliste per filtrat e zgjedhur.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="pf-note">

                <strong>Informacion:</strong>

                Piket = Kills + Aces + Blocks.

                Digs nuk shtohen ne piket individuale.

                Mesatarja llogaritet vetem per ndeshjet ku
                volejbollistja ka statistika te regjistruara.

            </div>

        </div>

        {{-- PERFORMANCE CHART --}}

        <div class="pf-card">

            <h2>Krahasimi i Performances</h2>

            <p class="pf-subtitle">

                Top 5 volejbollistet sipas totalit te pikeve.

            </p>

            @php
                $maxPoints = max(
                    1,
                    $performance->max('piket') ?? 0
                );
            @endphp

            @forelse(
                $performance
                    ->where('ndeshje', '>', 0)
                    ->take(5)
                as $player
            )

                <div class="pf-chart-row">

                    <div class="pf-chart-name">

                        {{ $player['emri'] }}
                        {{ $player['mbiemri'] }}

                    </div>

                    <div class="pf-chart-track">

                        <div class="pf-chart-bar"
                             style="width: {{ ($player['piket'] / $maxPoints) * 100 }}%;">

                        </div>

                    </div>

                    <div class="pf-chart-value">

                        {{ $player['piket'] }}

                    </div>

                </div>

            @empty

                <div class="pf-empty">

                    <div class="pf-empty-icon">📊</div>

                    Ende nuk ka statistika per krahasim.

                    Regjistro statistikat nga moduli Ndeshjet e Mia.

                </div>

            @endforelse

        </div>

        {{-- ACTIONS --}}

        <div style="display:flex; gap:10px; flex-wrap:wrap;">

            <a href="{{ route('coach.ndeshjet') }}"
               class="pf-btn">

                Menaxho Statistikat

            </a>

            <a href="{{ route('coach.dashboard') }}"
               class="pf-btn pf-btn-light">

                ← Kthehu ne Dashboard

            </a>

        </div>

    </div>

@endsection
