@extends('layouts.club')

@section('title', 'Performance - KV Gjinoci')

@section('content')

    <style>
        .performance-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .performance-page * {
            box-sizing: border-box;
        }

        /* HEADER */

        .performance-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .performance-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .performance-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        /* BUTTONS */

        .perf-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #253858;
            color: white !important;
            text-decoration: none !important;
            padding: 12px 18px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .perf-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .perf-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .perf-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* CARDS */

        .perf-card {
            background: white;
            padding: 24px;
            border: 1px solid #e5ebf3;
            border-radius: 16px;
            margin-bottom: 24px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .perf-card h2 {
            font-size: 21px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .perf-description {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 20px;
        }

        /* FILTERS */

        .perf-filter {
            display: flex;
            align-items: flex-end;
            gap: 14px;
            flex-wrap: wrap;
        }

        .perf-filter-group {
            flex: 1;
            min-width: 160px;
        }

        .perf-filter label {
            display: block;
            font-size: 13px;
            color: #475569;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .perf-filter select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #172b4d;
            font-size: 14px;
            outline: none;
        }

        .perf-filter select:focus {
            border-color: #2563eb;
            background: white;
        }

        /* STATISTICS */

        .perf-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .perf-stat {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .perf-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .perf-stat-label {
            color: #64748b;
            font-size: 13px;
        }

        .perf-stat-icon {
            width: 42px;
            height: 42px;
            background: #e8efff;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            flex-shrink: 0;
        }

        .perf-icon-green {
            background: #dcfce7;
        }

        .perf-icon-purple {
            background: #f1eaff;
        }

        .perf-icon-orange {
            background: #fff1df;
        }

        .perf-stat h2 {
            color: #172b4d;
            font-size: 35px;
            margin: 15px 0 6px;
        }

        .perf-stat small {
            color: #64748b;
            font-size: 12px;
        }

        /* TOP 5 */

        .perf-top-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e5ebf3;
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .perf-top-header {
            background: linear-gradient(
                130deg,
                #172b4d,
                #315b89
            );

            color: white;
            padding: 22px 25px;
        }

        .perf-top-header h2 {
            color: white;
            font-size: 22px;
            margin: 0 0 7px;
        }

        .perf-top-header p {
            color: #cbd5e1;
            font-size: 13px;
            margin: 0;
        }

        .perf-top-body {
            padding: 12px 25px 20px;
        }

        .perf-ranking-row {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px 0;
            border-bottom: 1px solid #edf0f5;
        }

        .perf-ranking-row:last-child {
            border-bottom: none;
        }

        .perf-rank {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #edf2f7;
            color: #64748b;
            font-size: 14px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .perf-rank-first {
            background: #fff1df;
            color: #b7791f;
        }

        .perf-avatar {
            width: 48px;
            height: 48px;
            background: #e8efff;
            color: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 15px;
            flex-shrink: 0;
        }

        .perf-player-info {
            flex: 1;
            min-width: 0;
        }

        .perf-player-info a {
            color: #172b4d;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
        }

        .perf-player-info a:hover {
            color: #2563eb;
        }

        .perf-player-info small {
            display: block;
            color: #64748b;
            font-size: 12px;
            margin-top: 6px;
        }

        .perf-progress-bar {
            height: 9px;
            border-radius: 20px;
            background: #edf2f7;
            overflow: hidden;
            margin-top: 12px;
        }

        .perf-progress-fill {
            height: 100%;
            border-radius: 20px;
            background: linear-gradient(
                90deg,
                #253858,
                #60a5fa
            );
        }

        .perf-progress-first {
            background: linear-gradient(
                90deg,
                #c69227,
                #f0c76b
            );
        }

        .perf-player-points {
            min-width: 70px;
            text-align: right;
        }

        .perf-player-points strong {
            color: #172b4d;
            font-size: 27px;
        }

        .perf-player-points small {
            display: block;
            color: #64748b;
            font-size: 12px;
            margin-top: 4px;
        }

        /* TABLE */

        .perf-table-scroll {
            overflow-x: auto;
        }

        .perf-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 980px;
        }

        .perf-table th {
            background: #253858;
            color: white;
            padding: 16px 13px;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        .perf-table th:first-child {
            border-radius: 9px 0 0 0;
        }

        .perf-table th:last-child {
            border-radius: 0 9px 0 0;
        }

        .perf-table td {
            padding: 16px 13px;
            font-size: 14px;
            color: #172b4d;
            border-bottom: 1px solid #edf0f5;
            vertical-align: middle;
        }

        .perf-table tbody tr:hover {
            background: #f8fafc;
        }

        .perf-table-player {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .perf-table-player .perf-avatar {
            width: 40px;
            height: 40px;
            font-size: 13px;
        }

        .perf-table-player a {
            color: #172b4d;
            text-decoration: none;
            font-weight: bold;
            white-space: nowrap;
        }

        .perf-table-player a:hover {
            color: #2563eb;
        }

        .perf-table-player small {
            display: block;
            margin-top: 5px;
            color: #64748b;
            font-size: 11px;
        }

        .perf-points-badge {
            display: inline-block;
            background: #e8efff;
            color: #2563eb;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        .perf-average {
            font-weight: bold;
            color: #047857;
        }

        .perf-team-name {
            color: #475569;
            font-size: 13px;
        }

        /* EXPLANATION */

        .perf-explanation {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
        }

        .perf-explanation-item {
            padding: 15px;
            border-radius: 10px;
            background: #f8fafc;
            border: 1px solid #edf0f5;
        }

        .perf-label {
            display: inline-block;
            padding: 7px 11px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 7px;
            background: #e8efff;
            color: #2563eb;
        }

        .perf-label-green {
            background: #dcfce7;
            color: #047857;
        }

        .perf-label-purple {
            background: #f1eaff;
            color: #7c3aed;
        }

        .perf-label-orange {
            background: #fff1df;
            color: #b7791f;
        }

        .perf-explanation-item p {
            font-size: 13px;
            color: #64748b;
            margin: 12px 0 0;
            line-height: 1.5;
        }

        .perf-formula {
            margin: 20px 0 0;
            padding: 14px 17px;
            background: #edf4ff;
            color: #315b89;
            border-radius: 9px;
            font-size: 13px;
            line-height: 1.6;
        }

        .perf-empty {
            padding: 35px !important;
            text-align: center;
            color: #64748b !important;
        }

        .perf-footer {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        /* RESPONSIVE */

        @media (max-width: 1050px) {

            .perf-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .perf-explanation {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

        }

        @media (max-width: 600px) {

            .performance-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .performance-header h1 {
                font-size: 25px;
            }

            .perf-filter-group {
                flex-basis: 100%;
            }

            .perf-stat {
                padding: 15px;
            }

            .perf-stat h2 {
                font-size: 28px;
            }

            .perf-stat-icon {
                width: 34px;
                height: 34px;
                font-size: 17px;
            }

            .perf-card {
                padding: 17px;
            }

            .perf-top-body {
                padding: 10px 15px;
            }

            .perf-ranking-row {
                gap: 9px;
            }

            .perf-avatar {
                width: 36px;
                height: 36px;
                font-size: 12px;
            }

            .perf-rank {
                width: 27px;
                height: 27px;
            }

            .perf-player-points {
                min-width: 45px;
            }

            .perf-player-points strong {
                font-size: 22px;
            }

        }

        @media (max-width: 380px) {

            .perf-stats,
            .perf-explanation {
                grid-template-columns: 1fr;
            }

        }
    </style>

    <div class="performance-page">

        {{-- PAGE HEADER --}}

        <div class="performance-header">

            <div>

                <h1>Player Performance</h1>

                <p>
                    Analizo statistikat individuale,
                    performancen dhe renditjen e
                    volejbollisteve te KV Gjinocit.
                </p>

            </div>

            <a class="perf-btn perf-btn-light"
               href="{{ route('statistics.index') }}">

                Statistikat e Ekipeve

            </a>

        </div>

        {{-- FILTERS --}}

        <div class="perf-card">

            <h2>Filtro Performancen</h2>

            <p class="perf-description">
                Zgjedh ekipin dhe sezonin per
                statistika me specifike.
            </p>

            <form method="GET"
                  action="{{ route('performance.index') }}"
                  class="perf-filter">

                {{-- EKIPI --}}

                <div class="perf-filter-group">

                    <label for="ekipi_id">

                        Ekipi

                    </label>

                    <select name="ekipi_id" id="ekipi_id">

                        <option value="">
                            Te gjitha ekipet
                        </option>

                        @foreach($ekipet as $ekipi)

                            <option value="{{ $ekipi->id }}"
                                @selected(
                                    (string)$ekipiId ===
                                    (string)$ekipi->id
                                )>

                                {{ $ekipi->emri }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- SEZONI --}}

                <div class="perf-filter-group">

                    <label for="sezoni_id">

                        Sezoni

                    </label>

                    <select name="sezoni_id" id="sezoni_id">

                        <option value="">
                            Te gjitha sezonet
                        </option>

                        @foreach($sezonet as $sezoni)

                            <option value="{{ $sezoni->id }}"
                                @selected(
                                    (string)$sezoniId ===
                                    (string)$sezoni->id
                                )>

                                {{ $sezoni->emri }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <button type="submit" class="perf-btn">

                    Filtro

                </button>

                <a class="perf-btn perf-btn-gray"
                   href="{{ route('performance.index') }}">

                    Pastro

                </a>

            </form>

        </div>

        {{-- STATISTICS CARDS --}}

        <div class="perf-stats">

            <div class="perf-stat">

                <div class="perf-stat-top">

                <span class="perf-stat-label">
                    Volejbolliste
                </span>

                    <span class="perf-stat-icon">
                    👥
                </span>

                </div>

                <h2>{{ $totalLojtare }}</h2>

                <small>
                    Volejbolliste ne renditje
                </small>

            </div>

            <div class="perf-stat">

                <div class="perf-stat-top">

                <span class="perf-stat-label">
                    Ndeshje te Perfunduar
                </span>

                    <span class="perf-stat-icon perf-icon-purple">
                    🏐
                </span>

                </div>

                <h2>{{ $totalNdeshje }}</h2>

                <small>
                    Ndeshje te luajtura
                </small>

            </div>

            <div class="perf-stat">

                <div class="perf-stat-top">

                <span class="perf-stat-label">
                    Pike Individuale
                </span>

                    <span class="perf-stat-icon perf-icon-orange">
                    🏆
                </span>

                </div>

                <h2>{{ $totalPike }}</h2>

                <small>
                    Total pike te shenuara
                </small>

            </div>

            <div class="perf-stat">

                <div class="perf-stat-top">

                <span class="perf-stat-label">
                    Mesatarja me e Larte
                </span>

                    <span class="perf-stat-icon perf-icon-green">
                    📈
                </span>

                </div>

                <h2>

                    {{ number_format($mesatarjaMeELarte, 2) }}

                </h2>

                <small>
                    Pike per ndeshje
                </small>

            </div>

        </div>

        {{-- TOP 5 PLAYERS --}}

        <div class="perf-top-card">

            <div class="perf-top-header">

                <h2>🏆 Top 5 Volejbollistet</h2>

                <p>
                    Volejbollistet me me se shumti
                    pike te shenuara.
                </p>

            </div>

            <div class="perf-top-body">

                @php
                    $maxPike = max(
                        1,
                        collect($top5)->max('total_pike') ?? 0
                    );
                @endphp

                @forelse($top5 as $lojtar)

                    <div class="perf-ranking-row">

                        {{-- RANK --}}

                        <div class="perf-rank
                        {{ $loop->first
                            ? 'perf-rank-first'
                            : '' }}">

                            @if($loop->iteration === 1)

                                🥇

                            @elseif($loop->iteration === 2)

                                🥈

                            @elseif($loop->iteration === 3)

                                🥉

                            @else

                                {{ $loop->iteration }}

                            @endif

                        </div>

                        {{-- AVATAR --}}

                        <div class="perf-avatar">

                            {{ mb_strtoupper(
                                mb_substr($lojtar->emri, 0, 1)
                                .
                                mb_substr($lojtar->mbiemri, 0, 1)
                            ) }}

                        </div>

                        {{-- PLAYER INFORMATION --}}

                        <div class="perf-player-info">

                            <a href="{{ route(
                            'lojtar.show',
                            $lojtar
                        ) }}">

                                {{ $lojtar->emri }}

                                {{ $lojtar->mbiemri }}

                            </a>

                            <small>

                                {{ $lojtar->ekipi?->emri
                                    ?? 'Pa ekip' }}

                                ·

                                {{ $lojtar->pozicioni
                                    ?? 'Pa pozicion' }}

                            </small>

                            <div class="perf-progress-bar">

                                <div class="perf-progress-fill
                                {{ $loop->first
                                    ? 'perf-progress-first'
                                    : '' }}"

                                     style="width:{{ min(
                                    100,
                                    ($lojtar->total_pike ?? 0)
                                    / $maxPike * 100
                                ) }}%">

                                </div>

                            </div>

                        </div>

                        {{-- POINTS --}}

                        <div class="perf-player-points">

                            <strong>

                                {{ $lojtar->total_pike ?? 0 }}

                            </strong>

                            <small>Pike</small>

                        </div>

                    </div>

                @empty

                    <div class="perf-empty">

                        Nuk ka statistika per
                        filtrat e zgjedhur.

                    </div>

                @endforelse

            </div>

        </div>

        {{-- FULL RANKING TABLE --}}

        <div class="perf-card">

            <h2>Renditja e Plote</h2>

            <p class="perf-description">

                Statistikat dhe performanca
                e te gjitha volejbollisteve.

            </p>

            <div class="perf-table-scroll">

                <table class="perf-table">

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

                            {{-- RANK --}}

                            <td>

                                <div class="perf-rank
                                    {{ $loop->first
                                        ? 'perf-rank-first'
                                        : '' }}">

                                    {{ $loop->iteration }}

                                </div>

                            </td>

                            {{-- PLAYER --}}

                            <td>

                                <div class="perf-table-player">

                                    <div class="perf-avatar">

                                        {{ mb_strtoupper(
                                            mb_substr(
                                                $lojtar->emri,
                                                0, 1
                                            )
                                            .
                                            mb_substr(
                                                $lojtar->mbiemri,
                                                0, 1
                                            )
                                        ) }}

                                    </div>

                                    <div>

                                        <a href="{{ route(
                                            'lojtar.show',
                                            $lojtar
                                        ) }}">

                                            {{ $lojtar->emri }}

                                            {{ $lojtar->mbiemri }}

                                        </a>

                                        <small>

                                            {{ $lojtar->pozicioni
                                                ?? 'Pa pozicion' }}

                                        </small>

                                    </div>

                                </div>

                            </td>

                            {{-- TEAM --}}

                            <td>

                                <span class="perf-team-name">

                                    {{ $lojtar->ekipi?->emri
                                        ?? 'Pa ekip' }}

                                </span>

                            </td>

                            {{-- MATCHES --}}

                            <td>

                                {{ $lojtar->ndeshje_luajtura ?? 0 }}

                            </td>

                            {{-- KILLS --}}

                            <td>

                                {{ $lojtar->total_kills ?? 0 }}

                            </td>

                            {{-- ACES --}}

                            <td>

                                {{ $lojtar->total_aces ?? 0 }}

                            </td>

                            {{-- BLOCKS --}}

                            <td>

                                {{ $lojtar->total_blocks ?? 0 }}

                            </td>

                            {{-- DIGS --}}

                            <td>

                                {{ $lojtar->total_digs ?? 0 }}

                            </td>

                            {{-- TOTAL POINTS --}}

                            <td>

                                <span class="perf-points-badge">

                                    {{ $lojtar->total_pike ?? 0 }}

                                </span>

                            </td>

                            {{-- AVERAGE --}}

                            <td>

                                <span class="perf-average">

                                    {{ number_format(
                                        $lojtar->mesatarja ?? 0,
                                        2
                                    ) }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10"
                                class="perf-empty">

                                Nuk ka volejbolliste
                                per kete kerkim.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- STATISTICS EXPLANATION --}}

        <div class="perf-card">

            <h2>Shpjegimi i Statistikave</h2>

            <p class="perf-description">

                Kuptimi i statistikave individuale
                te volejbollit.

            </p>

            <div class="perf-explanation">

                <div class="perf-explanation-item">

                <span class="perf-label">

                    Kills

                </span>

                    <p>

                        Sulme qe perfundojne
                        direkt me pike.

                    </p>

                </div>

                <div class="perf-explanation-item">

                <span class="perf-label perf-label-green">

                    Aces

                </span>

                    <p>

                        Pike direkte te fituara
                        nga sherbimi.

                    </p>

                </div>

                <div class="perf-explanation-item">

                <span class="perf-label perf-label-purple">

                    Blocks

                </span>

                    <p>

                        Blloqe qe sjellin
                        pike direkte.

                    </p>

                </div>

                <div class="perf-explanation-item">

                <span class="perf-label perf-label-orange">

                    Digs

                </span>

                    <p>

                        Mbrojtje te suksesshme
                        nga sulmet e kundershtarit.

                    </p>

                </div>

            </div>

            <div class="perf-formula">

                <strong>Formula e pikeve:</strong>

                Piket individuale = Kills + Aces + Blocks.

                Digs regjistrohen si statistike mbrojtese
                dhe nuk shtohen ne piket individuale.

            </div>

        </div>

        {{-- FOOTER --}}

        <div class="perf-footer">

            <a class="perf-btn perf-btn-gray"
               href="{{ route('dashboard') }}">

                Kthehu ne Dashboard

            </a>

            <a class="perf-btn perf-btn-light"
               href="{{ route('statistics.index') }}">

                Statistikat e Ekipeve

            </a>

        </div>

    </div>

@endsection
