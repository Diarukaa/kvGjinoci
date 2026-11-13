@extends('layouts.club')

@section('title', 'Historiku i Prezences - KV Gjinoci')

@section('content')

    <style>
        .attendance-page {
            max-width: 1100px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .attendance-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .at-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .at-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .at-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .at-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 18px;
            background: #253858;
            color: white !important;
            border: none;
            border-radius: 9px;
            text-decoration: none !important;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .at-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .at-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .at-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* PLAYER HERO */

        .at-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            border-radius: 20px;
            padding: 30px;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .at-hero::after {
            content: "🏐";
            position: absolute;
            font-size: 260px;
            right: -20px;
            bottom: -90px;
            opacity: .08;
            pointer-events: none;
        }

        .at-hero-content {
            display: flex;
            align-items: center;
            gap: 24px;
            position: relative;
            z-index: 1;
        }

        .at-avatar {
            width: 95px;
            height: 95px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 20px;
            color: white;
            font-size: 33px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .at-hero-label {
            display: block;
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .at-hero h2 {
            color: white !important;
            font-size: 29px;
            margin: 0 0 10px;
        }

        .at-hero p {
            color: #dbeafe !important;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .at-hero-tags {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        .at-tag {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.20);
            border-radius: 8px;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        /* STATISTICS */

        .at-stats {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 18px;
            margin-bottom: 25px;
        }

        .at-stat-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 16px;
            padding: 22px;
            min-width: 0;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .at-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .at-stat-label {
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .at-stat-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            border-radius: 11px;
            font-size: 21px;
            flex-shrink: 0;
        }

        .at-icon-green {
            background: #dcfce7;
        }

        .at-icon-red {
            background: #fee2e2;
        }

        .at-icon-orange {
            background: #fff1df;
        }

        .at-icon-purple {
            background: #f1eaff;
        }

        .at-stat-card h3 {
            color: #172b4d;
            font-size: 32px;
            margin: 16px 0 8px;
            line-height: 1.2;
        }

        .at-stat-card small {
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .at-number-green {
            color: #059669 !important;
        }

        .at-number-red {
            color: #dc2626 !important;
        }

        .at-number-orange {
            color: #d97706 !important;
        }

        .at-number-purple {
            color: #7c3aed !important;
        }

        .at-number-blue {
            color: #2563eb !important;
        }

        /* PROGRESS BAR */

        .at-progress {
            width: 100%;
            height: 9px;
            background: #e5ebf3;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 13px;
        }

        .at-progress-fill {
            height: 100%;
            border-radius: 20px;
            background: linear-gradient(
                90deg,
                #2563eb,
                #60a5fa
            );
            transition: width .4s ease;
        }

        /* MAIN CARD */

        .at-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 26px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .at-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .at-card-header h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 8px;
        }

        .at-card-header p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        /* TABLE */

        .at-table-scroll {
            overflow-x: auto;
        }

        .at-table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
        }

        .at-table th {
            background: #253858;
            color: white;
            font-size: 13px;
            padding: 15px 16px;
            text-align: left;
            white-space: nowrap;
        }

        .at-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .at-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .at-table td {
            padding: 17px 16px;
            font-size: 13px;
            color: #172b4d;
            border-bottom: 1px solid #e5ebf3;
            vertical-align: middle;
        }

        .at-table tbody tr:hover {
            background: #f8fafc;
        }

        .at-date {
            font-weight: 600;
            white-space: nowrap;
        }

        /* ATTENDANCE STATUS */

        .at-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .at-status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .at-present {
            background: #dcfce7;
            color: #047857;
        }

        .at-absent {
            background: #fee2e2;
            color: #dc2626;
        }

        .at-late {
            background: #fff1df;
            color: #b45309;
        }

        .at-excused {
            background: #f1eaff;
            color: #7c3aed;
        }

        .at-neutral {
            background: #edf2f7;
            color: #475569;
        }

        .at-view-btn {
            display: inline-block;
            background: #edf2f7;
            color: #253858 !important;
            border-radius: 7px;
            padding: 9px 12px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none !important;
            white-space: nowrap;
        }

        .at-view-btn:hover {
            background: #dbeafe;
        }

        /* EMPTY STATE */

        .at-empty {
            text-align: center;
            padding: 35px 20px;
        }

        .at-empty-icon {
            width: 76px;
            height: 76px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            border-radius: 18px;
            font-size: 34px;
            margin: 0 auto 18px;
        }

        .at-empty h3 {
            color: #172b4d;
            font-size: 20px;
            margin: 0 0 10px;
        }

        .at-empty p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            max-width: 450px;
            margin: 0 auto 20px;
        }

        /* INFORMATION */

        .at-info {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 25px;
        }

        .at-info strong {
            display: block;
            color: #1e40af;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .at-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* ACTIONS */

        .at-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {

            .at-stats {
                grid-template-columns: repeat(
                2, minmax(0, 1fr)
            );
            }

        }

        @media (max-width: 600px) {

            .at-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .at-header h1 {
                font-size: 25px;
            }

            .at-hero {
                padding: 23px;
            }

            .at-hero-content {
                gap: 15px;
            }

            .at-avatar {
                width: 65px;
                height: 65px;
                font-size: 25px;
                border-radius: 15px;
            }

            .at-hero h2 {
                font-size: 23px;
            }

            .at-stats {
                gap: 12px;
            }

            .at-stat-card {
                padding: 16px;
            }

            .at-stat-card h3 {
                font-size: 26px;
            }

            .at-stat-icon {
                width: 33px;
                height: 33px;
                font-size: 16px;
            }

            .at-card {
                padding: 18px;
            }

            .at-actions .at-btn {
                flex: 1;
            }

        }
    </style>

    @php

        $inicialet = mb_strtoupper(
            mb_substr($lojtar->emri, 0, 1)
            .
            mb_substr($lojtar->mbiemri, 0, 1)
        );

        $ekipi = $lojtar->ekipi;

        $progress = max(
            0,
            min(100, (float) $perqindja)
        );

    @endphp

    <div class="attendance-page">

        {{-- PAGE HEADER --}}

        <div class="at-header">

            <div>

                <h1>Historiku i Prezences</h1>

                <p>

                    Monitoro pjesemarrjen,
                    prezencat dhe mungesat
                    ne stervitje.

                </p>

            </div>

            <a href="{{ route(
            'lojtar.show',
            $lojtar
        ) }}"
               class="at-btn at-btn-light">

                ← Kthehu te Profili

            </a>

        </div>

        {{-- PLAYER HERO --}}

        <div class="at-hero">

            <div class="at-hero-content">

                <div class="at-avatar">

                    {{ $inicialet }}

                </div>

                <div>

                <span class="at-hero-label">

                    KV GJINOCI | ATTENDANCE TRACKER

                </span>

                    <h2>

                        {{ $lojtar->emri }}

                        {{ $lojtar->mbiemri }}

                    </h2>

                    <p>

                        Historiku i pjesemarrjes
                        ne stervitjet e klubit.

                    </p>

                    <div class="at-hero-tags">

                    <span class="at-tag">

                        #{{ $lojtar->numriFanelles }}

                    </span>

                        <span class="at-tag">

                        🏐 {{ $lojtar->pozicioni }}

                    </span>

                        <span class="at-tag">

                        {{ $ekipi?->emri ?? 'Pa ekip' }}

                    </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- STATISTICS --}}

        <div class="at-stats">

            {{-- TOTAL TRAININGS --}}

            <div class="at-stat-card">

                <div class="at-stat-top">

                <span class="at-stat-label">

                    Stervitje te Evidentuara

                </span>

                    <div class="at-stat-icon">

                        📋

                    </div>

                </div>

                <h3>{{ $total }}</h3>

                <small>

                    Total stervitje me prezence
                    te regjistruar

                </small>

            </div>

            {{-- PRESENT --}}

            <div class="at-stat-card">

                <div class="at-stat-top">

                <span class="at-stat-label">

                    Prezente

                </span>

                    <div class="at-stat-icon
                            at-icon-green">

                        ✓

                    </div>

                </div>

                <h3 class="at-number-green">

                    {{ $prezente }}

                </h3>

                <small>

                    Stervitje me status Prezente

                </small>

            </div>

            {{-- ABSENT --}}

            <div class="at-stat-card">

                <div class="at-stat-top">

                <span class="at-stat-label">

                    Mungesa

                </span>

                    <div class="at-stat-icon
                            at-icon-red">

                        ✕

                    </div>

                </div>

                <h3 class="at-number-red">

                    {{ $mungesa }}

                </h3>

                <small>

                    Mungesa te paarsyetuara

                </small>

            </div>

            {{-- LATE --}}

            <div class="at-stat-card">

                <div class="at-stat-top">

                <span class="at-stat-label">

                    Me Vonese

                </span>

                    <div class="at-stat-icon
                            at-icon-orange">

                        🕒

                    </div>

                </div>

                <h3 class="at-number-orange">

                    {{ $vonese }}

                </h3>

                <small>

                    Stervitje me ardhje te vonuar

                </small>

            </div>

            {{-- EXCUSED --}}

            <div class="at-stat-card">

                <div class="at-stat-top">

                <span class="at-stat-label">

                    Mungesa te Arsyetuara

                </span>

                    <div class="at-stat-icon
                            at-icon-purple">

                        📝

                    </div>

                </div>

                <h3 class="at-number-purple">

                    {{ $arsyetuara }}

                </h3>

                <small>

                    Mungesa me arsye

                </small>

            </div>

            {{-- ATTENDANCE PERCENTAGE --}}

            <div class="at-stat-card">

                <div class="at-stat-top">

                <span class="at-stat-label">

                    Perqindja e Prezences

                </span>

                    <div class="at-stat-icon">

                        📊

                    </div>

                </div>

                <h3 class="at-number-blue">

                    {{ $perqindja }}%

                </h3>

                <small>

                    Pjesemarrja ne stervitje

                </small>

                <div class="at-progress"
                     role="progressbar"
                     aria-label="Perqindja e prezences"
                     aria-valuemin="0"
                     aria-valuemax="100"
                     aria-valuenow="{{ $progress }}">

                    <div class="at-progress-fill"
                         style="width: {{ $progress }}%">

                    </div>

                </div>

            </div>

        </div>

        {{-- ATTENDANCE HISTORY --}}

        <div class="at-card">

            <div class="at-card-header">

                <div>

                    <h2>Historiku i Stervitjeve</h2>

                    <p>

                        Lista e stervitjeve te
                        perfunduara dhe statusi
                        i pjesemarrjes se volejbollistes.

                    </p>

                </div>

                <a href="{{ route('stervitjet.index') }}"
                   class="at-btn at-btn-light">

                    Shiko Stervitjet

                </a>

            </div>

            @if($prezencat->isEmpty())

                <div class="at-empty">

                    <div class="at-empty-icon">

                        📋

                    </div>

                    <h3>

                        Nuk ka prezenca te regjistruara

                    </h3>

                    <p>

                        Historiku do te shfaqet
                        pasi te regjistrohet prezenca
                        e volejbollistes ne stervitje
                        te perfunduara.

                    </p>

                    <a href="{{ route(
                    'stervitjet.index'
                ) }}"
                       class="at-btn">

                        Menaxho Stervitjet

                    </a>

                </div>

            @else

                <div class="at-table-scroll">

                    <table class="at-table">

                        <thead>

                        <tr>

                            <th>Data</th>

                            <th>Ekipi</th>

                            <th>Lloji</th>

                            <th>Statusi</th>

                            <th>Shenime</th>

                            <th>Detajet</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($prezencat as $prezenca)

                            @php

                                $stervitja =
                                    $prezenca->stervitja;

                                $statusClass = match(
                                    $prezenca->statusi
                                ) {

                                    'Prezente' =>
                                        'at-present',

                                    'Mungon' =>
                                        'at-absent',

                                    'Me vonese' =>
                                        'at-late',

                                    'E arsyetuar' =>
                                        'at-excused',

                                    default =>
                                        'at-neutral'

                                };

                            @endphp

                            <tr>

                                {{-- DATE --}}

                                <td>

                                    <span class="at-date">

                                        {{ $stervitja?->data
                                            ? \Carbon\Carbon::parse(
                                                $stervitja->data
                                              )->format('d.m.Y')
                                            : '-' }}

                                    </span>

                                </td>

                                {{-- TEAM --}}

                                <td>

                                    {{ $stervitja?->ekipi?->emri
                                        ?? 'Pa ekip' }}

                                </td>

                                {{-- TRAINING TYPE --}}

                                <td>

                                    {{ $stervitja?->lloji
                                        ?? '-' }}

                                </td>

                                {{-- STATUS --}}

                                <td>

                                    <span class="at-status
                                                 {{ $statusClass }}">

                                        <span class="at-status-dot">
                                        </span>

                                        {{ $prezenca->statusi }}

                                    </span>

                                </td>

                                {{-- NOTES --}}

                                <td>

                                    {{ $prezenca->shenime
                                        ?? '-' }}

                                </td>

                                {{-- TRAINING DETAILS --}}

                                <td>

                                    @if($stervitja)

                                        <a href="{{ route(
                                            'stervitjet.show',
                                            $stervitja
                                        ) }}"
                                           class="at-view-btn">

                                            Shiko Stervitjen →

                                        </a>

                                    @else

                                        -

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

        {{-- INFORMATION PANEL --}}

        <div class="at-info">

        <span style="font-size:22px">

            ℹ️

        </span>

            <div>

                <strong>

                    Si llogaritet prezenca?

                </strong>

                <p>

                    Perqindja llogaritet duke mbledhur
                    prezencat dhe ardhjet me vonese,
                    duke i pjesetuar me numrin total
                    te stervitjeve te evidenduara
                    dhe duke shumezuar rezultatin me 100.

                    Vetem stervitjet e perfunduara
                    perfshihen ne historik.

                </p>

            </div>

        </div>

        {{-- PAGE ACTIONS --}}

        <div class="at-actions">

            <a href="{{ route(
            'lojtar.show',
            $lojtar
        ) }}"
               class="at-btn">

                ← Kthehu te Profili

            </a>

            <a href="{{ route(
            'lojtar.index'
        ) }}"
               class="at-btn at-btn-gray">

                Volejbollistet

            </a>

            <a href="{{ route(
            'stervitjet.index'
        ) }}"
               class="at-btn at-btn-light">

                Menaxho Stervitjet

            </a>

        </div>

    </div>

@endsection
