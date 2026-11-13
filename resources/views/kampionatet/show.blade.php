@extends('layouts.club')

@section('title', 'Detajet e Kampionatit - KV Gjinoci')

@section('content')

    <style>
        .championship-page {
            max-width: 1100px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .championship-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .cp-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .cp-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .cp-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .cp-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 19px;
            background: #253858;
            color: white !important;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .cp-btn:hover {
            transform: translateY(-1px);
            filter: brightness(.95);
        }

        .cp-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .cp-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* CHAMPIONSHIP HERO */

        .cp-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            color: white;
            border-radius: 20px;
            padding: 30px;
            position: relative;
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .cp-hero::after {
            content: "🏆";
            position: absolute;
            font-size: 270px;
            right: -10px;
            bottom: -75px;
            opacity: .09;
            pointer-events: none;
        }

        .cp-hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .cp-hero-icon {
            width: 95px;
            height: 95px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 22px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.22);
            font-size: 46px;
            flex-shrink: 0;
        }

        .cp-hero-label {
            display: block;
            font-size: 11px;
            color: #bfdbfe;
            letter-spacing: 1.5px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .cp-hero h2 {
            color: white !important;
            font-size: 32px;
            margin: 0 0 10px;
            overflow-wrap: anywhere;
        }

        .cp-hero p {
            color: #dbeafe !important;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .cp-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 16px;
        }

        .cp-tag {
            display: inline-block;
            padding: 8px 13px;
            border-radius: 8px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.20);
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        /* STATISTICS */

        .cp-stats {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 18px;
            margin-bottom: 25px;
        }

        .cp-stat {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 16px;
            padding: 23px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
            min-width: 0;
        }

        .cp-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .cp-stat-label {
            color: #64748b;
            font-size: 13px;
        }

        .cp-stat-icon {
            width: 43px;
            height: 43px;
            border-radius: 11px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .cp-icon-green {
            background: #dcfce7;
        }

        .cp-icon-orange {
            background: #fff1df;
        }

        .cp-stat h3 {
            color: #172b4d;
            font-size: 29px;
            margin: 17px 0 7px;
            overflow-wrap: anywhere;
        }

        .cp-stat small {
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        /* MAIN CARD */

        .cp-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 26px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .cp-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .cp-card-header h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 8px;
        }

        .cp-card-header p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        .cp-count {
            display: inline-block;
            background: #e8efff;
            color: #2563eb;
            padding: 9px 13px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
        }

        /* TABLE */

        .cp-table-scroll {
            overflow-x: auto;
        }

        .cp-table {
            width: 100%;
            min-width: 600px;
            border-collapse: collapse;
        }

        .cp-table th {
            background: #253858;
            color: white;
            padding: 15px 17px;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        .cp-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .cp-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .cp-table td {
            padding: 17px;
            border-bottom: 1px solid #e5ebf3;
            color: #172b4d;
            font-size: 14px;
            vertical-align: middle;
        }

        .cp-table tbody tr:hover {
            background: #f8fafc;
        }

        .cp-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 33px;
            height: 33px;
            background: #edf2f7;
            border-radius: 8px;
            font-weight: bold;
            color: #253858;
        }

        /* CLUB INFORMATION */

        .cp-club {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .cp-club-avatar {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            color: #253858;
            border-radius: 12px;
            font-size: 15px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .cp-club strong {
            display: block;
            color: #172b4d;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .cp-club small {
            color: #64748b;
            font-size: 12px;
        }

        .cp-city {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #475569;
            font-size: 13px;
        }

        .cp-participant {
            display: inline-block;
            padding: 7px 11px;
            background: #dcfce7;
            color: #047857;
            font-size: 11px;
            font-weight: bold;
            border-radius: 7px;
            white-space: nowrap;
        }

        /* EMPTY STATE */

        .cp-empty {
            text-align: center;
            padding: 35px 20px;
        }

        .cp-empty-icon {
            width: 76px;
            height: 76px;
            background: #e8efff;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            margin: 0 auto 17px;
        }

        .cp-empty h3 {
            color: #172b4d;
            font-size: 20px;
            margin: 0 0 10px;
        }

        .cp-empty p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
            margin: 0 0 20px;
        }

        /* LEAGUE SECTION */

        .cp-league {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 17px;
            padding: 25px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .cp-league-content {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .cp-league-icon {
            width: 56px;
            height: 56px;
            background: #dbeafe;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
        }

        .cp-league h2 {
            color: #172b4d;
            font-size: 20px;
            margin: 0 0 7px;
        }

        .cp-league p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
            max-width: 500px;
        }

        /* PAGE ACTIONS */

        .cp-actions {
            display: flex;
            align-items: center;
            gap: 11px;
            flex-wrap: wrap;
        }

        /* RESPONSIVE */

        @media (max-width: 750px) {

            .cp-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .cp-stat:last-child {
                grid-column: 1 / -1;
            }

        }

        @media (max-width: 550px) {

            .cp-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .cp-header h1 {
                font-size: 25px;
            }

            .cp-hero {
                padding: 23px;
            }

            .cp-hero-content {
                gap: 15px;
            }

            .cp-hero-icon {
                width: 65px;
                height: 65px;
                font-size: 32px;
                border-radius: 15px;
            }

            .cp-hero h2 {
                font-size: 24px;
            }

            .cp-stats {
                gap: 12px;
            }

            .cp-stat {
                padding: 16px;
            }

            .cp-stat h3 {
                font-size: 23px;
            }

            .cp-stat-icon {
                width: 33px;
                height: 33px;
                font-size: 17px;
            }

            .cp-card {
                padding: 18px;
            }

            .cp-league {
                padding: 20px;
            }

            .cp-league > a {
                width: 100%;
            }

            .cp-actions .cp-btn {
                flex: 1;
            }

        }
    </style>

    @php

        $klubet = $kampionati->klubet;

        $totalKlubet = $klubet->count();

        $sezoni = $kampionati->sezoni;

    @endphp

    <div class="championship-page">

        {{-- PAGE HEADER --}}

        <div class="cp-header">

            <div>

                <h1>Detajet e Kampionatit</h1>

                <p>

                    Informacionet, klubet pjesemarrese
                    dhe klasifikimi i kampionatit.

                </p>

            </div>

            <a href="{{ route('kampionatet.index') }}"
               class="cp-btn cp-btn-light">

                ← Kthehu te Kampionatet

            </a>

        </div>

        {{-- CHAMPIONSHIP HERO --}}

        <div class="cp-hero">

            <div class="cp-hero-content">

                <div class="cp-hero-icon">

                    🏆

                </div>

                <div>

                <span class="cp-hero-label">

                    KV GJINOCI | CHAMPIONSHIP CENTER

                </span>

                    <h2>

                        {{ $kampionati->emri }}

                    </h2>

                    <p>

                        Kampionati i regjistruar
                        ne sistemin e menaxhimit te klubit.

                    </p>

                    <div class="cp-tags">

                    <span class="cp-tag">

                        📅 {{ $sezoni?->emri ?? 'Pa sezon' }}

                    </span>

                        <span class="cp-tag">

                        🏐 {{ $kampionati->kategoria }}

                    </span>

                        <span class="cp-tag">

                        {{ $totalKlubet }} Klube

                    </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- CHAMPIONSHIP STATISTICS --}}

        <div class="cp-stats">

            {{-- SEASON --}}

            <div class="cp-stat">

                <div class="cp-stat-top">

                <span class="cp-stat-label">

                    Sezoni

                </span>

                    <div class="cp-stat-icon">

                        📅

                    </div>

                </div>

                <h3>

                    {{ $sezoni?->emri ?? 'Pa sezon' }}

                </h3>

                <small>

                    Sezoni sportiv i kampionatit

                </small>

            </div>

            {{-- CATEGORY --}}

            <div class="cp-stat">

                <div class="cp-stat-top">

                <span class="cp-stat-label">

                    Kategoria

                </span>

                    <div class="cp-stat-icon
                            cp-icon-orange">

                        🏐

                    </div>

                </div>

                <h3>

                    {{ $kampionati->kategoria }}

                </h3>

                <small>

                    Kategoria sportive

                </small>

            </div>

            {{-- PARTICIPATING CLUBS --}}

            <div class="cp-stat">

                <div class="cp-stat-top">

                <span class="cp-stat-label">

                    Klube Pjesemarrese

                </span>

                    <div class="cp-stat-icon
                            cp-icon-green">

                        👥

                    </div>

                </div>

                <h3>

                    {{ $totalKlubet }}

                </h3>

                <small>

                    Klube te regjistruara
                    ne kete kampionat

                </small>

            </div>

        </div>

        {{-- PARTICIPATING CLUBS --}}

        <div class="cp-card">

            <div class="cp-card-header">

                <div>

                    <h2>Klubet Pjesemarrese</h2>

                    <p>

                        Lista e klubeve qe marrin pjese
                        ne kete kampionat.

                    </p>

                </div>

                <span class="cp-count">

                {{ $totalKlubet }} Klube

            </span>

            </div>

            @if($klubet->isEmpty())

                <div class="cp-empty">

                    <div class="cp-empty-icon">

                        🏐

                    </div>

                    <h3>

                        Nuk ka klube pjesemarrese

                    </h3>

                    <p>

                        Shto klubet pjesemarrese
                        duke edituar kampionatin.

                    </p>

                    <a href="{{ route(
                    'kampionatet.index'
                ) }}"
                       class="cp-btn">

                        Menaxho Kampionatet

                    </a>

                </div>

            @else

                <div class="cp-table-scroll">

                    <table class="cp-table">

                        <thead>

                        <tr>

                            <th>#</th>

                            <th>Klubi</th>

                            <th>Qyteti</th>

                            <th>Statusi</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($klubet as $klubi)

                            @php

                                $inicialet = collect(
                                    explode(' ', trim($klubi->emri))
                                )
                                ->filter()
                                ->take(2)
                                ->map(
                                    fn($fjala) =>
                                    mb_strtoupper(
                                        mb_substr($fjala, 0, 1)
                                    )
                                )
                                ->implode('');

                            @endphp

                            <tr>

                                {{-- NUMBER --}}

                                <td>

                                    <span class="cp-number">

                                        {{ $loop->iteration }}

                                    </span>

                                </td>

                                {{-- CLUB NAME --}}

                                <td>

                                    <div class="cp-club">

                                        <div class="cp-club-avatar">

                                            {{ $inicialet }}

                                        </div>

                                        <div>

                                            <strong>

                                                {{ $klubi->emri }}

                                            </strong>

                                            <small>

                                                Klub Volejbolli

                                            </small>

                                        </div>

                                    </div>

                                </td>

                                {{-- CITY --}}

                                <td>

                                    <span class="cp-city">

                                        📍

                                        {{ $klubi->qyteti ?? '-' }}

                                    </span>

                                </td>

                                {{-- STATUS --}}

                                <td>

                                    <span class="cp-participant">

                                        ● Pjesemarres

                                    </span>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

        {{-- LEAGUE AND RESULTS --}}

        <div class="cp-league">

            <div class="cp-league-content">

                <div class="cp-league-icon">

                    📊

                </div>

                <div>

                    <h2>

                        Klasifikimi dhe Rezultatet

                    </h2>

                    <p>

                        Shiko renditjen e klubeve,
                        piket, fitoret, humbjet dhe
                        rezultatet e ndeshjeve
                        te ketij kampionati.

                    </p>

                </div>

            </div>

            <a href="{{ route(
            'liga.index',
            $kampionati
        ) }}"
               class="cp-btn">

                Shiko Klasifikimin →

            </a>

        </div>

        {{-- PAGE ACTIONS --}}

        <div class="cp-actions">

            <a href="{{ route('kampionatet.index') }}"
               class="cp-btn cp-btn-gray">

                ← Kthehu te Kampionatet

            </a>

            <a href="{{ route('klubet.index') }}"
               class="cp-btn cp-btn-light">

                Menaxho Klubet

            </a>

        </div>

    </div>

@endsection
