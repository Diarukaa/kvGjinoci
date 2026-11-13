@extends('layouts.club')

@section('title', 'Statistikat - KV Gjinoci')

@section('content')

    <style>
        .stats-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .stats-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .stats-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .stats-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .stats-header p {
            margin: 0;
            font-size: 14px;
            color: #64748b;
        }

        .stats-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            border-radius: 9px;
            background: #253858;
            color: white !important;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none !important;
            transition: .2s;
            white-space: nowrap;
        }

        .stats-btn:hover {
            background: #172b4d;
            transform: translateY(-2px);
        }

        .stats-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .stats-btn-gray {
            background: #e2e8f0;
            color: #253858 !important;
        }

        /* STATISTICS CARDS */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-box {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .stat-box-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .stat-box-label {
            color: #64748b;
            font-size: 13px;
        }

        .stat-box-icon {
            width: 43px;
            height: 43px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            font-size: 21px;
            flex-shrink: 0;
        }

        .icon-green {
            background: #dcfce7;
        }

        .icon-purple {
            background: #f1eaff;
        }

        .icon-orange {
            background: #fff1df;
        }

        .stat-box h2 {
            font-size: 36px;
            color: #172b4d;
            margin: 15px 0 7px;
        }

        .stat-box small {
            font-size: 12px;
            color: #94a3b8;
        }

        /* CONTENT CARDS */

        .stats-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            border: 1px solid #e5ebf3;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
            margin-bottom: 25px;
        }

        .stats-card h2 {
            font-size: 22px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .stats-description {
            font-size: 13px;
            color: #64748b;
            margin: 0 0 20px;
        }

        /* CHART SECTION */

        .stats-overview {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            margin-bottom: 25px;
        }

        .stats-overview .stats-card {
            margin-bottom: 0;
        }

        .stats-chart {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            padding: 20px 0;
        }

        .donut-chart {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .donut-center {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .donut-center strong {
            font-size: 32px;
            color: #172b4d;
        }

        .donut-center small {
            color: #64748b;
            font-size: 12px;
            margin-top: 5px;
        }

        .chart-legend {
            flex: 1;
            min-width: 130px;
        }

        .legend-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #edf0f5;
            font-size: 14px;
            gap: 10px;
        }

        .legend-row:last-child {
            border-bottom: none;
        }

        .legend-label {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #64748b;
        }

        .legend-dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .dot-green {
            background: #15966b;
        }

        .dot-red {
            background: #e87979;
        }

        .dot-blue {
            background: #315b89;
        }

        /* SET STATISTICS */

        .set-row {
            margin-top: 24px;
        }

        .set-row-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 11px;
            font-size: 14px;
        }

        .set-row-top span {
            color: #64748b;
        }

        .set-row-top strong {
            font-size: 20px;
            color: #172b4d;
        }

        .set-bar {
            background: #edf2f7;
            height: 13px;
            border-radius: 20px;
            overflow: hidden;
        }

        .set-progress {
            height: 100%;
            border-radius: 20px;
        }

        .set-green {
            background: #15966b;
        }

        .set-red {
            background: #e87979;
        }

        .set-total {
            margin-top: 25px;
            background: #f8fafc;
            border: 1px solid #edf0f5;
            border-radius: 10px;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .set-total span {
            color: #64748b;
            font-size: 13px;
        }

        .set-total strong {
            font-size: 22px;
            color: #172b4d;
        }

        /* TABLE */

        .stats-table-scroll {
            overflow-x: auto;
        }

        .stats-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        .stats-table th {
            background: #253858;
            color: white;
            text-align: left;
            padding: 16px 13px;
            font-size: 13px;
            white-space: nowrap;
        }

        .stats-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .stats-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .stats-table td {
            padding: 17px 13px;
            border-bottom: 1px solid #edf0f5;
            font-size: 14px;
            vertical-align: middle;
            color: #172b4d;
        }

        .stats-table tbody tr:hover {
            background: #f8fafc;
        }

        .stats-rank {
            width: 32px;
            height: 32px;
            background: #edf2f7;
            color: #64748b;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .stats-rank-first {
            background: #fff1df;
            color: #b7791f;
        }

        .stats-team {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .stats-team-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            flex-shrink: 0;
        }

        .stats-team a {
            color: #172b4d;
            text-decoration: none;
            font-weight: bold;
        }

        .stats-team a:hover {
            color: #2563eb;
        }

        .stats-win {
            color: #047857 !important;
            font-weight: bold;
        }

        .stats-loss {
            color: #dc2626 !important;
            font-weight: bold;
        }

        .stats-points {
            background: #e8efff;
            color: #2563eb;
            padding: 8px 12px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
        }

        .percentage-bar {
            height: 7px;
            background: #edf2f7;
            overflow: hidden;
            border-radius: 10px;
            margin-top: 7px;
            min-width: 85px;
        }

        .percentage-fill {
            height: 100%;
            background: #315b89;
            border-radius: 10px;
        }

        .stats-footer {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .stats-empty {
            padding: 35px !important;
            text-align: center;
            color: #64748b !important;
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .stats-overview {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .stats-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats-header h1 {
                font-size: 25px;
            }

            .stats-grid {
                gap: 12px;
            }

            .stat-box {
                padding: 16px;
            }

            .stat-box h2 {
                font-size: 28px;
            }

            .stat-box-icon {
                width: 34px;
                height: 34px;
                font-size: 17px;
            }

            .stats-card {
                padding: 17px;
            }
        }

        @media (max-width: 380px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="stats-page">

        @php
            $totalHumbje = $statistikat->sum('humbje');

            $perqindjaFitore = $totalNdeshje > 0
                ? round($totalFitore / $totalNdeshje * 100, 1)
                : 0;

            $totalPike = $statistikat->sum('piket');

            $totalSeteFituara = $statistikat
                ->sum('setet_fituara');

            $totalSeteHumbura = $statistikat
                ->sum('setet_humbura');

            $totalSete = $totalSeteFituara
                + $totalSeteHumbura;

            $perqindjaSeteFituara = $totalSete > 0
                ? $totalSeteFituara / $totalSete * 100
                : 0;

            $perqindjaSeteHumbura = $totalSete > 0
                ? $totalSeteHumbura / $totalSete * 100
                : 0;
        @endphp

        {{-- PAGE HEADER --}}

        <div class="stats-header">

            <div>

                <h1>Statistikat e Ekipeve</h1>

                <p>

                    Analizo rezultatet, fitoret
                    dhe performancen e ekipeve.

                </p>

            </div>

            <a class="stats-btn"
               href="{{ route('ndeshjet.index') }}">

                Shiko Ndeshjet

            </a>

        </div>

        {{-- STATISTICS CARDS --}}

        <div class="stats-grid">

            <div class="stat-box">

                <div class="stat-box-top">

                <span class="stat-box-label">
                    Ndeshje te Perfunduar
                </span>

                    <span class="stat-box-icon">
                    🏐
                </span>

                </div>

                <h2>{{ $totalNdeshje }}</h2>

                <small>
                    Total ndeshje te luajtura
                </small>

            </div>

            <div class="stat-box">

                <div class="stat-box-top">

                <span class="stat-box-label">
                    Fitore Totale
                </span>

                    <span class="stat-box-icon icon-green">
                    🏆
                </span>

                </div>

                <h2>{{ $totalFitore }}</h2>

                <small>
                    Ndeshje te fituara
                </small>

            </div>

            <div class="stat-box">

                <div class="stat-box-top">

                <span class="stat-box-label">
                    Perqindja e Fitoreve
                </span>

                    <span class="stat-box-icon icon-purple">
                    📈
                </span>

                </div>

                <h2>{{ $perqindjaFitore }}%</h2>

                <small>
                    Performanca e ekipeve
                </small>

            </div>

            <div class="stat-box">

                <div class="stat-box-top">

                <span class="stat-box-label">
                    Pike Totale
                </span>

                    <span class="stat-box-icon icon-orange">
                    ⭐
                </span>

                </div>

                <h2>{{ $totalPike }}</h2>

                <small>
                    Piket e grumbulluara
                </small>

            </div>

        </div>

        {{-- CHARTS --}}

        <div class="stats-overview">

            {{-- FITORE / HUMBJE --}}

            <div class="stats-card">

                <h2>Performanca e Ekipeve</h2>

                <p class="stats-description">

                    Raporti i fitoreve dhe humbjeve.

                </p>

                <div class="stats-chart">

                    <div class="donut-chart"
                         style="background:{{ $totalNdeshje > 0
                        ? 'conic-gradient(
                            #15966b 0% '
                            .$perqindjaFitore
                            .'%, #e87979 '
                            .$perqindjaFitore
                            .'% 100%)'
                        : '#e2e8f0' }}">

                        <div class="donut-center">

                            <strong>

                                {{ $perqindjaFitore }}%

                            </strong>

                            <small>Fitore</small>

                        </div>

                    </div>

                    <div class="chart-legend">

                        <div class="legend-row">

                            <div class="legend-label">

                            <span class="legend-dot dot-green">
                            </span>

                                Fitore

                            </div>

                            <strong class="stats-win">

                                {{ $totalFitore }}

                            </strong>

                        </div>

                        <div class="legend-row">

                            <div class="legend-label">

                            <span class="legend-dot dot-red">
                            </span>

                                Humbje

                            </div>

                            <strong class="stats-loss">

                                {{ $totalHumbje }}

                            </strong>

                        </div>

                        <div class="legend-row">

                            <div class="legend-label">

                            <span class="legend-dot dot-blue">
                            </span>

                                Total

                            </div>

                            <strong>

                                {{ $totalNdeshje }}

                            </strong>

                        </div>

                    </div>

                </div>

            </div>

            {{-- SETET --}}

            <div class="stats-card">

                <h2>Statistikat e Seteve</h2>

                <p class="stats-description">

                    Setet e fituara dhe te humbura
                    nga ekipet.

                </p>

                <div class="set-row">

                    <div class="set-row-top">

                        <span>Sete te Fituara</span>

                        <strong class="stats-win">

                            {{ $totalSeteFituara }}

                        </strong>

                    </div>

                    <div class="set-bar">

                        <div class="set-progress set-green"
                             style="width:{{ $perqindjaSeteFituara }}%">

                        </div>

                    </div>

                </div>

                <div class="set-row">

                    <div class="set-row-top">

                        <span>Sete te Humbura</span>

                        <strong class="stats-loss">

                            {{ $totalSeteHumbura }}

                        </strong>

                    </div>

                    <div class="set-bar">

                        <div class="set-progress set-red"
                             style="width:{{ $perqindjaSeteHumbura }}%">

                        </div>

                    </div>

                </div>

                <div class="set-total">

                    <span>Total Sete te Luajtura</span>

                    <strong>{{ $totalSete }}</strong>

                </div>

            </div>

        </div>

        {{-- TEAM RANKING --}}

        <div class="stats-card">

            <h2>Renditja sipas Pikeve</h2>

            <p class="stats-description">

                Klasifikimi i ekipeve sipas
                rezultateve te regjistruara.

            </p>

            <div class="stats-table-scroll">

                <table class="stats-table">

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

                            {{-- RENDITJA --}}

                            <td>

                                <div class="stats-rank
                                    {{ $loop->first
                                        ? 'stats-rank-first'
                                        : '' }}">

                                    {{ $loop->iteration }}

                                </div>

                            </td>

                            {{-- EKIPI --}}

                            <td>

                                <div class="stats-team">

                                    <div class="stats-team-icon">

                                        🛡️

                                    </div>

                                    <a href="{{ route(
                                        'ekipet.show',
                                        $stat['ekipi']
                                    ) }}">

                                        {{ $stat['ekipi']->emri }}

                                    </a>

                                </div>

                            </td>

                            {{-- NDESHJET --}}

                            <td>

                                {{ $stat['ndeshje'] }}

                            </td>

                            {{-- FITORE --}}

                            <td class="stats-win">

                                {{ $stat['fitore'] }}

                            </td>

                            {{-- HUMBJE --}}

                            <td class="stats-loss">

                                {{ $stat['humbje'] }}

                            </td>

                            {{-- SETE + --}}

                            <td>

                                {{ $stat['setet_fituara'] }}

                            </td>

                            {{-- SETE - --}}

                            <td>

                                {{ $stat['setet_humbura'] }}

                            </td>

                            {{-- FITORE % --}}

                            <td>

                                <strong>

                                    {{ $stat['perqindja'] }}%

                                </strong>

                                <div class="percentage-bar">

                                    <div class="percentage-fill"
                                         style="width:{{ $stat['perqindja'] }}%">

                                    </div>

                                </div>

                            </td>

                            {{-- PIKET --}}

                            <td>

                                <span class="stats-points">

                                    {{ $stat['piket'] }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9"
                                class="stats-empty">

                                Nuk ka ekipe te regjistruara.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- FOOTER BUTTONS --}}

        <div class="stats-footer">

            <a class="stats-btn stats-btn-light"
               href="{{ route('performance.index') }}">

                Player Performance

            </a>

            <a class="stats-btn stats-btn-gray"
               href="{{ route('dashboard') }}">

                Kthehu ne Dashboard

            </a>

        </div>

    </div>

@endsection
