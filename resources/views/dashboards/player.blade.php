@extends('layouts.club')

@section('title', 'Player Portal - KV Gjinoci')

@section('content')

    <style>
        .pp-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px 0 40px;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .pp-page * {
            box-sizing: border-box;
        }

        /* HERO */

        .pp-hero {
            background: linear-gradient(120deg, #172b4d, #315b89);
            border-radius: 20px;
            padding: 35px;
            color: white;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .pp-avatar {
            width: 90px;
            height: 90px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 23px;
            font-size: 32px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .pp-hero small {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        .pp-hero h1 {
            color: white !important;
            margin: 12px 0;
            font-size: 30px;
        }

        .pp-hero p {
            color: #dbeafe;
            line-height: 1.7;
            margin: 0;
            font-size: 14px;
        }

        .pp-hero-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 16px;
        }

        .pp-hero-tags span {
            background: rgba(255,255,255,.12);
            border-radius: 7px;
            padding: 7px 11px;
            color: white;
            font-size: 12px;
        }

        /* TABS */

        .pp-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            background: white;
            border: 1px solid #e2e8f0;
            padding: 12px;
            border-radius: 14px;
            margin-bottom: 25px;
        }

        .pp-tab {
            background: transparent;
            border: none;
            padding: 13px 20px;
            border-radius: 9px;
            color: #64748b;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .pp-tab:hover {
            background: #edf4ff;
            color: #315b89;
        }

        .pp-tab.active {
            background: #253858;
            color: white;
        }

        .pp-section {
            display: none;
        }

        .pp-section.active {
            display: block;
        }

        /* STATISTICS */

        .pp-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 17px;
            margin-bottom: 25px;
        }

        .pp-stat {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .pp-stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .pp-stat small {
            font-size: 13px;
            color: #64748b;
        }

        .pp-stat h2 {
            margin: 15px 0 0;
            font-size: 30px;
            color: #172b4d;
        }

        .pp-stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        /* CARDS */

        .pp-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 26px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .pp-card h2 {
            font-size: 22px;
            margin: 0 0 10px;
        }

        .pp-subtitle {
            font-size: 13px;
            color: #64748b;
            line-height: 1.7;
            margin: 0 0 23px;
        }

        .pp-two-columns {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .pp-details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        .pp-detail {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 17px;
            border-radius: 11px;
        }

        .pp-detail small {
            display: block;
            color: #64748b;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .pp-detail strong {
            color: #172b4d;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        /* TABLES */

        .pp-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
        }

        .pp-page table {
            width: 100%;
            border-collapse: collapse;
            min-width: 680px;
        }

        .pp-page th {
            background: #253858;
            color: white;
            padding: 14px 13px;
            font-size: 12px;
            text-align: left;
            white-space: nowrap;
        }

        .pp-page td {
            padding: 17px 13px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .pp-page tbody tr:hover {
            background: #f8fafc;
        }

        .pp-points {
            display: inline-block;
            background: #e8efff;
            color: #2563eb;
            font-size: 13px;
            font-weight: bold;
            padding: 7px 11px;
            border-radius: 7px;
        }

        /* ATTENDANCE */

        .pp-attendance {
            background: linear-gradient(120deg, #172b4d, #315b89);
            color: white;
            padding: 28px;
            border-radius: 16px;
            margin-bottom: 25px;
        }

        .pp-attendance h2 {
            color: white;
            font-size: 22px;
            margin: 0 0 12px;
        }

        .pp-attendance p {
            font-size: 13px;
            color: #dbeafe;
            line-height: 1.7;
        }

        .pp-percent {
            font-size: 43px;
            font-weight: bold;
            margin: 18px 0;
        }

        .pp-progress {
            height: 12px;
            background: rgba(255,255,255,.15);
            border-radius: 20px;
            overflow: hidden;
        }

        .pp-progress-bar {
            height: 100%;
            background: #60a5fa;
            border-radius: 20px;
        }

        .pp-badge {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 7px;
            background: #e8efff;
            color: #315b89;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .pp-green {
            color: #15803d;
            background: #dcfce7;
        }

        .pp-red {
            color: #b91c1c;
            background: #fee2e2;
        }

        .pp-orange {
            color: #d97706;
            background: #fff7ed;
        }

        /* SCHEDULE */

        .pp-event {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 18px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .pp-event:last-child {
            border-bottom: none;
        }

        .pp-date {
            width: 59px;
            min-height: 66px;
            background: #e8efff;
            border-radius: 11px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
        }

        .pp-date strong {
            font-size: 22px;
            color: #253858;
        }

        .pp-date small {
            color: #64748b;
            font-size: 11px;
            margin-top: 5px;
        }

        .pp-event-info {
            flex: 1;
            min-width: 0;
        }

        .pp-event-info h3 {
            font-size: 15px;
            margin: 0 0 8px;
        }

        .pp-event-info p {
            color: #64748b;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        .pp-result {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 13px;
            text-align: center;
            padding: 18px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .pp-result:last-child {
            border-bottom: none;
        }

        .pp-result strong {
            font-size: 13px;
        }

        .pp-result-score {
            background: #253858;
            color: white;
            border-radius: 9px;
            padding: 12px 15px;
            font-size: 19px;
            font-weight: bold;
            white-space: nowrap;
        }

        /* MESSAGES */

        .pp-empty {
            text-align: center;
            color: #64748b;
            padding: 30px !important;
            font-size: 13px;
            line-height: 1.8;
        }

        .pp-warning {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            border-radius: 13px;
            padding: 22px;
            margin-bottom: 25px;
            font-size: 14px;
            line-height: 1.8;
        }

        .pp-note {
            background: #edf4ff;
            color: #315b89;
            padding: 16px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 12px;
            line-height: 1.7;
        }

        .pp-footer {
            text-align: center;
            color: #64748b;
            font-size: 12px;
            padding: 15px;
        }

        @media(max-width: 900px) {
            .pp-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .pp-two-columns {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media(max-width: 550px) {
            .pp-hero {
                padding: 23px;
                gap: 15px;
            }

            .pp-avatar {
                width: 55px;
                height: 55px;
                font-size: 21px;
                border-radius: 14px;
            }

            .pp-hero h1 {
                font-size: 23px;
            }

            .pp-card {
                padding: 18px;
            }

            .pp-grid {
                gap: 10px;
            }

            .pp-stat {
                padding: 15px;
            }

            .pp-stat h2 {
                font-size: 25px;
            }

            .pp-stat-icon {
                width: 30px;
                height: 30px;
                font-size: 15px;
            }

            .pp-tab {
                padding: 10px 12px;
                font-size: 12px;
            }

            .pp-details {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="pp-page">

        {{-- HERO --}}

        <div class="pp-hero">

            <div class="pp-avatar">

                {{ mb_strtoupper(
                    mb_substr(auth()->user()->name, 0, 1)
                ) }}

            </div>

            <div>

                <small>KV GJINOCI | PLAYER PORTAL</small>

                <h1>

                    Miresevjen,
                    {{ $lojtar?->emri ?? auth()->user()->name }}!

                </h1>

                <p>
                    Percjell performancen tende, prezencen
                    dhe aktivitetet sportive te ekipit.
                </p>

                @if($lojtar)

                    <div class="pp-hero-tags">

                    <span>
                        🏐 {{ $ekipi?->emri ?? 'Pa ekip' }}
                    </span>

                        <span>
                        {{ $lojtar->pozicioni ?? 'Pa pozicion' }}
                    </span>

                        @if($ekipi?->kategoria)

                            <span>{{ $ekipi->kategoria }}</span>

                        @endif

                    </div>

                @endif

            </div>

        </div>

        @if(!$lojtar)

            <div class="pp-warning">

                <strong>Profili ende nuk eshte lidhur.</strong>

                <div>
                    Llogaria jote eshte aktive, por ende
                    nuk eshte lidhur me profilin e volejbollistes.
                    Kontakto administratorin.
                </div>

            </div>

        @else

            {{-- NAVIGATION --}}

            <div class="pp-tabs">

                <button type="button"
                        class="pp-tab active"
                        data-tab="profili">

                    👤 Profili Im

                </button>

                <button type="button"
                        class="pp-tab"
                        data-tab="statistikat">

                    📊 Statistikat e Mia

                </button>

                <button type="button"
                        class="pp-tab"
                        data-tab="prezenca">

                    ✓ Prezenca Ime

                </button>

                <button type="button"
                        class="pp-tab"
                        data-tab="orari">

                    📅 Orari dhe Ndeshjet

                </button>

            </div>

            {{-- PROFILI --}}

            <section id="profili" class="pp-section active">

                <div class="pp-grid">

                    @foreach([
                        ['Pike Totale', $totalPike, '🏆'],
                        ['Ndeshje me Statistika', $totalNdeshje, '🏐'],
                        ['Pike/Ndeshje', $mesatarja, '📈'],
                        ['Prezenca', $perqindjaPrezences !== null
                            ? $perqindjaPrezences . '%'
                            : '-', '✓']
                    ] as [$label, $value, $icon])

                        <div class="pp-stat">

                            <div class="pp-stat-top">

                                <small>{{ $label }}</small>

                                <div class="pp-stat-icon">
                                    {{ $icon }}
                                </div>

                            </div>

                            <h2>{{ $value }}</h2>

                        </div>

                    @endforeach

                </div>

                <div class="pp-card">

                    <h2>Informacionet e Mia</h2>

                    <p class="pp-subtitle">
                        Te dhenat e profilit tend ne klub.
                    </p>

                    <div class="pp-details">

                        <div class="pp-detail">

                            <small>Emri dhe Mbiemri</small>

                            <strong>

                                {{ $lojtar->emri }}
                                {{ $lojtar->mbiemri }}

                            </strong>

                        </div>

                        <div class="pp-detail">

                            <small>Ekipi</small>

                            <strong>
                                {{ $ekipi?->emri ?? '-' }}
                            </strong>

                        </div>

                        <div class="pp-detail">

                            <small>Pozicioni</small>

                            <strong>
                                {{ $lojtar->pozicioni ?? '-' }}
                            </strong>

                        </div>

                        <div class="pp-detail">

                            <small>Gjatesia</small>

                            <strong>

                                {{ $lojtar->gjatesia
                                    ? $lojtar->gjatesia . ' cm'
                                    : '-' }}

                            </strong>

                        </div>

                        <div class="pp-detail">

                            <small>Trajneri</small>

                            <strong>

                                {{ $trajner
                                    ? $trajner->emri . ' ' . $trajner->mbiemri
                                    : '-' }}

                            </strong>

                        </div>

                        <div class="pp-detail">

                            <small>Kategoria</small>

                            <strong>
                                {{ $ekipi?->kategoria ?? '-' }}
                            </strong>

                        </div>

                        <div class="pp-detail">

                            <small>Emaili i Llogarise</small>

                            <strong>
                                {{ auth()->user()->email }}
                            </strong>

                        </div>

                        <div class="pp-detail">

                            <small>Roli</small>

                            <strong>Volejbolliste</strong>

                        </div>

                    </div>

                </div>

                <div class="pp-card">

                    <h2>Performanca Ime</h2>

                    <p class="pp-subtitle">
                        Pasqyra e statistikave personale.
                    </p>

                    <div class="pp-grid" style="margin-bottom:0;">

                        @foreach([
                            ['Kills', $totalKills, '⚡'],
                            ['Aces', $totalAces, '🎯'],
                            ['Blocks', $totalBlocks, '🛡️'],
                            ['Digs', $totalDigs, '🤾']
                        ] as [$label, $value, $icon])

                            <div class="pp-stat">

                                <div class="pp-stat-top">

                                    <small>{{ $label }}</small>

                                    <span class="pp-stat-icon">
                                    {{ $icon }}
                                </span>

                                </div>

                                <h2>{{ $value }}</h2>

                            </div>

                        @endforeach

                    </div>

                </div>

            </section>

            {{-- STATISTIKAT PERSONALE --}}

            <section id="statistikat" class="pp-section">

                <div class="pp-grid">

                    @foreach([
                        ['Kills', $totalKills, '⚡'],
                        ['Aces', $totalAces, '🎯'],
                        ['Blocks', $totalBlocks, '🛡️'],
                        ['Digs', $totalDigs, '🤾'],
                        ['Pike Totale', $totalPike, '🏆'],
                        ['Ndeshje', $totalNdeshje, '🏐'],
                        ['Pike/Ndeshje', $mesatarja, '📈']
                    ] as [$label, $value, $icon])

                        <div class="pp-stat">

                            <div class="pp-stat-top">

                                <small>{{ $label }}</small>

                                <span class="pp-stat-icon">
                                {{ $icon }}
                            </span>

                            </div>

                            <h2>{{ $value }}</h2>

                        </div>

                    @endforeach

                </div>

                <div class="pp-card">

                    <h2>Statistikat e Mia sipas Ndeshjeve</h2>

                    <p class="pp-subtitle">

                        Performanca jote individuale ne secilen ndeshje,
                        e regjistruar nga trajneri.

                    </p>

                    <div class="pp-table-wrap">

                        <table>

                            <thead>

                            <tr>
                                <th>Data</th>
                                <th>Kundershtari</th>
                                <th>Kills</th>
                                <th>Aces</th>
                                <th>Blocks</th>
                                <th>Digs</th>
                                <th>Pike</th>
                            </tr>

                            </thead>

                            <tbody>

                            @forelse($statistikat as $statistika)

                                @php
                                    $ndeshja = $ndeshjetMap->get(
                                        $statistika->ndeshja_id
                                    );

                                    $piket =
                                        $statistika->kills +
                                        $statistika->aces +
                                        $statistika->blocks;
                                @endphp

                                <tr>

                                    <td>

                                        {{ \Carbon\Carbon::parse(
                                            $ndeshja->data_ndeshjes
                                        )->format('d.m.Y') }}

                                    </td>

                                    <td>

                                        <strong>
                                            {{ $ndeshja->kundershtari }}
                                        </strong>

                                    </td>

                                    <td>{{ $statistika->kills }}</td>

                                    <td>{{ $statistika->aces }}</td>

                                    <td>{{ $statistika->blocks }}</td>

                                    <td>{{ $statistika->digs }}</td>

                                    <td>

                                        <span class="pp-points">
                                            {{ $piket }}
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="pp-empty">

                                        Ende nuk ke statistika
                                        te regjistruara.

                                    </td>

                                </tr>

                            @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="pp-note">

                        <strong>Informacion:</strong>

                        Piket individuale llogariten si
                        Kills + Aces + Blocks.
                        Statistikat perditesohen nga trajneri.

                    </div>

                </div>

            </section>

            {{-- PREZENCA PERSONALE --}}

            <section id="prezenca" class="pp-section">

                <div class="pp-attendance">

                    <h2>Prezenca Ime ne Stervitje</h2>

                    <p>
                        Perqindja e pjesemarrjes ne stervitjet
                        ku eshte regjistruar prezenca jote.
                    </p>

                    <div class="pp-percent">

                        {{ $perqindjaPrezences !== null
                            ? $perqindjaPrezences . '%'
                            : 'Pa te dhena' }}

                    </div>

                    <div class="pp-progress">

                        <div class="pp-progress-bar"
                             style="width: {{ $perqindjaPrezences ?? 0 }}%;">

                        </div>

                    </div>

                    <p>

                        {{ $totalPrezenca + $totalVonesa }}

                        nga

                        {{ $totalRegjistrime }}

                        stervitje me prezence te regjistruar.

                    </p>

                </div>

                <div class="pp-grid">

                    @foreach([
                        ['Prezente', $totalPrezenca, '#15803d'],
                        ['Mungesa', $totalMungesa, '#b91c1c'],
                        ['Me Vonese', $totalVonesa, '#d97706'],
                        ['Te Arsyetuara', $totalArsyetuara, '#2563eb']
                    ] as [$label, $value, $color])

                        <div class="pp-stat">

                            <small>{{ $label }}</small>

                            <h2 style="color:{{ $color }};">
                                {{ $value }}
                            </h2>

                        </div>

                    @endforeach

                </div>

                <div class="pp-card">

                    <h2>Historiku i Prezences</h2>

                    <p class="pp-subtitle">

                        Shiko pjesemarrjen ne stervitjet
                        e regjistruara nga trajneri.

                    </p>

                    <div class="pp-table-wrap">

                        <table>

                            <thead>

                            <tr>
                                <th>Data</th>
                                <th>Lloji i Stervitjes</th>
                                <th>Statusi</th>
                                <th>Shenime</th>
                            </tr>

                            </thead>

                            <tbody>

                            @forelse($prezencat as $prezenca)

                                @php

                                    $stervitja = $stervitjetMap->get(
                                        $prezenca->stervitja_id
                                    );

                                    $statusClass = match(
                                        $prezenca->statusi
                                    ) {
                                        'Prezente' => 'pp-green',
                                        'Mungon' => 'pp-red',
                                        'Me vonese' => 'pp-orange',
                                        default => ''
                                    };

                                @endphp

                                <tr>

                                    <td>

                                        {{ \Carbon\Carbon::parse(
                                            $stervitja->data
                                        )->format('d.m.Y') }}

                                    </td>

                                    <td>

                                        {{ $stervitja->lloji ?? '-' }}

                                    </td>

                                    <td>

                                        <span class="pp-badge {{ $statusClass }}">

                                            {{ $prezenca->statusi }}

                                        </span>

                                    </td>

                                    <td>

                                        {{ $prezenca->shenime ?? '-' }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="pp-empty">

                                        Nuk ka ende prezence
                                        te regjistruar.

                                    </td>

                                </tr>

                            @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="pp-note">

                        Prezenca llogaritet duke perfshire edhe
                        stervitjet ku ke ardhur me vonese.

                    </div>

                </div>

            </section>

            {{-- ORARI --}}

            <section id="orari" class="pp-section">

                <div class="pp-two-columns">

                    {{-- NDESHJET E ARDHSHME --}}

                    <div class="pp-card">

                        <h2>Ndeshjet e Ardhshme</h2>

                        <p class="pp-subtitle">

                            Orari i ndeshjeve te ekipit tend.

                        </p>

                        @forelse($ndeshjetArdhshme as $ndeshja)

                            @php

                                $data = \Carbon\Carbon::parse(
                                    $ndeshja->data_ndeshjes
                                );

                            @endphp

                            <div class="pp-event">

                                <div class="pp-date">

                                    <strong>
                                        {{ $data->format('d') }}
                                    </strong>

                                    <small>
                                        {{ $data->format('m/Y') }}
                                    </small>

                                </div>

                                <div class="pp-event-info">

                                    <h3>

                                        {{ $ekipi?->emri }}
                                        vs
                                        {{ $ndeshja->kundershtari }}

                                    </h3>

                                    <p>

                                        Ora: {{ $data->format('H:i') }}

                                        <br>

                                        {{ $ndeshja->palestra ?? '-' }}

                                        |

                                        {{ $ndeshja->lokacioni ?? '-' }}

                                    </p>

                                </div>

                            </div>

                        @empty

                            <div class="pp-empty">

                                Nuk ka ndeshje te ardhshme
                                te planifikuara.

                            </div>

                        @endforelse

                    </div>

                    {{-- STERVITJET E ARDHSHME --}}

                    <div class="pp-card">

                        <h2>Stervitjet e Ardhshme</h2>

                        <p class="pp-subtitle">

                            Orari i stervitjeve te ekipit tend.

                        </p>

                        @forelse($stervitjetArdhshme as $stervitja)

                            @php

                                $data = \Carbon\Carbon::parse(
                                    $stervitja->data
                                );

                            @endphp

                            <div class="pp-event">

                                <div class="pp-date">

                                    <strong>
                                        {{ $data->format('d') }}
                                    </strong>

                                    <small>
                                        {{ $data->format('m/Y') }}
                                    </small>

                                </div>

                                <div class="pp-event-info">

                                    <h3>

                                        Stervitje -
                                        {{ $stervitja->lloji ?? 'Ekipore' }}

                                    </h3>

                                    <p>

                                        {{ substr($stervitja->ora_fillimit ?? '', 0, 5) }}

                                        -

                                        {{ substr($stervitja->ora_mbarimit ?? '', 0, 5) }}

                                        <br>

                                        {{ $stervitja->palestra ?? '-' }}

                                    </p>

                                </div>

                            </div>

                        @empty

                            <div class="pp-empty">

                                Nuk ka stervitje te ardhshme
                                te planifikuara.

                            </div>

                        @endforelse

                    </div>

                </div>

                {{-- REZULTATET --}}

                <div class="pp-card">

                    <h2>Rezultatet e Fundit te Ekipit</h2>

                    <p class="pp-subtitle">

                        Pesembedhjete? Jo, 5 ndeshjet e fundit
                        te perfunduara te ekipit tend.

                    </p>

                    @forelse($rezultatetEkipit as $ndeshja)

                        <div class="pp-result">

                            <div>

                                <strong>

                                    {{ $ekipi?->emri ?? '-' }}

                                </strong>

                                <div style="margin-top:7px;">

                                <span class="pp-badge
                                    {{ $ndeshja->setet_tona >
                                       $ndeshja->setet_kundershtarit
                                        ? 'pp-green'
                                        : 'pp-red' }}">

                                    {{ $ndeshja->setet_tona >
                                       $ndeshja->setet_kundershtarit
                                        ? 'Fitore'
                                        : 'Humbje' }}

                                </span>

                                </div>

                            </div>

                            <div class="pp-result-score">

                                {{ $ndeshja->setet_tona }}

                                -

                                {{ $ndeshja->setet_kundershtarit }}

                            </div>

                            <div>

                                <strong>

                                    {{ $ndeshja->kundershtari }}

                                </strong>

                                <div style="font-size:11px; color:#64748b; margin-top:7px;">

                                    {{ \Carbon\Carbon::parse(
                                        $ndeshja->data_ndeshjes
                                    )->format('d.m.Y') }}

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="pp-empty">

                            Nuk ka rezultate te regjistruara.

                        </div>

                    @endforelse

                </div>

            </section>

        @endif

        <div class="pp-footer">

            KV Gjinoci | Player Portal |
            {{ auth()->user()->email }}

        </div>

    </div>

    <script>
        const playerTabs = document.querySelectorAll('.pp-tab');

        const playerSections = document.querySelectorAll('.pp-section');

        function hapPlayerTab(tabName) {

            playerTabs.forEach(tab => {

                tab.classList.toggle(
                    'active',
                    tab.dataset.tab === tabName
                );

            });

            playerSections.forEach(section => {

                section.classList.toggle(
                    'active',
                    section.id === tabName
                );

            });

        }

        playerTabs.forEach(tab => {

            tab.addEventListener('click', function () {

                hapPlayerTab(this.dataset.tab);

            });

        });
    </script>

@endsection
