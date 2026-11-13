@extends('layouts.club')

@section('title', 'Profili i Volejbollistes - KV Gjinoci')

@section('content')

    <style>
        .player-profile {
            max-width: 1100px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .player-profile * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .pp-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .pp-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .pp-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .pp-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #253858;
            color: white !important;
            padding: 13px 19px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .pp-btn:hover {
            transform: translateY(-2px);
            filter: brightness(.95);
        }

        .pp-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .pp-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* PROFILE HERO */

        .pp-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            color: white;
            padding: 35px;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .pp-hero-number {
            position: absolute;
            right: 25px;
            bottom: -70px;
            font-size: 250px;
            font-weight: 900;
            color: rgba(255,255,255,.07);
            line-height: 1;
            pointer-events: none;
        }

        .pp-hero-content {
            display: flex;
            align-items: center;
            gap: 25px;
            position: relative;
            z-index: 1;
        }

        .pp-avatar {
            width: 110px;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 23px;
            color: white;
            font-size: 38px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .pp-hero-label {
            display: block;
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }

        .pp-hero h2 {
            font-size: 33px;
            color: white !important;
            margin: 0 0 12px;
            overflow-wrap: anywhere;
        }

        .pp-hero p {
            color: #dbeafe !important;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        .pp-hero-tags {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        .pp-tag {
            display: inline-flex;
            align-items: center;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.19);
            padding: 8px 12px;
            border-radius: 7px;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .pp-hero-bottom {
            display: flex;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
            border-top: 1px solid rgba(255,255,255,.18);
            margin-top: 28px;
            padding-top: 20px;
        }

        .pp-hero-bottom span {
            font-size: 13px;
            color: #dbeafe;
            overflow-wrap: anywhere;
        }

        /* SPORT STAT CARDS */

        .pp-stats {
            display: grid;
            grid-template-columns: repeat(
            4, minmax(0, 1fr)
        );
            gap: 16px;
            margin-bottom: 25px;
        }

        .pp-stat-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 21px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
            min-width: 0;
        }

        .pp-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .pp-stat-label {
            font-size: 13px;
            color: #64748b;
        }

        .pp-stat-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #e8efff;
            font-size: 21px;
            flex-shrink: 0;
        }

        .pp-icon-green {
            background: #dcfce7;
        }

        .pp-icon-orange {
            background: #fff1df;
        }

        .pp-icon-purple {
            background: #f1eaff;
        }

        .pp-stat-card h3 {
            color: #172b4d;
            font-size: 26px;
            margin: 16px 0 7px;
            overflow-wrap: anywhere;
        }

        .pp-stat-card small {
            color: #64748b;
            font-size: 11px;
            line-height: 1.5;
        }

        /* MAIN GRID */

        .pp-content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: start;
            gap: 20px;
            margin-bottom: 25px;
        }

        .pp-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
            min-width: 0;
        }

        .pp-card-header {
            display: flex;
            align-items: center;
            gap: 13px;
            padding-bottom: 20px;
            margin-bottom: 5px;
            border-bottom: 1px solid #e5ebf3;
        }

        .pp-card-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            flex-shrink: 0;
        }

        .pp-card-icon-sport {
            background: #fff1df;
        }

        .pp-card-header h2 {
            color: #172b4d;
            font-size: 19px;
            margin: 0 0 6px;
        }

        .pp-card-header p {
            color: #64748b;
            font-size: 12px;
            margin: 0;
            line-height: 1.5;
        }

        /* INFORMATION ROWS */

        .pp-info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 0;
            border-bottom: 1px solid #edf0f5;
            font-size: 13px;
        }

        .pp-info-row:last-child {
            border-bottom: none;
            padding-bottom: 5px;
        }

        .pp-info-row span {
            color: #64748b;
            flex-shrink: 0;
        }

        .pp-info-row strong {
            color: #172b4d;
            font-weight: 600;
            text-align: right;
            overflow-wrap: anywhere;
            min-width: 0;
        }

        .pp-info-row a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .pp-info-row a:hover {
            text-decoration: underline;
        }

        /* TEAM CARD */

        .pp-team-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #f8fafc;
            border: 1px solid #e5ebf3;
            border-radius: 12px;
            padding: 17px;
            margin-top: 20px;
        }

        .pp-team-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 53px;
            height: 53px;
            background: #e8efff;
            border-radius: 12px;
            font-size: 26px;
            flex-shrink: 0;
        }

        .pp-team-content {
            flex: 1;
            min-width: 0;
        }

        .pp-team-content strong {
            display: block;
            color: #172b4d;
            font-size: 15px;
            margin-bottom: 5px;
            overflow-wrap: anywhere;
        }

        .pp-team-content small {
            color: #64748b;
            font-size: 12px;
        }

        .pp-team-link {
            color: #2563eb !important;
            text-decoration: none !important;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* ATTENDANCE */

        .pp-attendance-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .pp-attendance-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .pp-attendance-icon {
            width: 57px;
            height: 57px;
            background: #e8efff;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
        }

        .pp-attendance-card h2 {
            color: #172b4d;
            font-size: 20px;
            margin: 0 0 7px;
        }

        .pp-attendance-card p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        /* ACTIONS */

        .pp-actions {
            display: flex;
            align-items: center;
            gap: 11px;
            flex-wrap: wrap;
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {

            .pp-stats {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 650px) {

            .pp-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .pp-header h1 {
                font-size: 25px;
            }

            .pp-hero {
                padding: 23px;
            }

            .pp-hero-content {
                gap: 15px;
            }

            .pp-avatar {
                width: 70px;
                height: 70px;
                font-size: 25px;
                border-radius: 15px;
            }

            .pp-hero h2 {
                font-size: 24px;
            }

            .pp-hero-number {
                font-size: 170px;
                right: 5px;
                bottom: -40px;
            }

            .pp-content-grid {
                grid-template-columns: 1fr;
            }

            .pp-stats {
                gap: 12px;
            }

            .pp-stat-card {
                padding: 16px;
            }

            .pp-stat-card h3 {
                font-size: 21px;
            }

            .pp-stat-icon {
                width: 33px;
                height: 33px;
                font-size: 17px;
            }

            .pp-card {
                padding: 20px;
            }

            .pp-attendance-card {
                padding: 20px;
            }

            .pp-attendance-card > a {
                width: 100%;
            }

            .pp-actions .pp-btn {
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

        $dataLindjes = $lojtar->dataELindjes
            ? \Carbon\Carbon::parse(
                $lojtar->dataELindjes
            )
            : null;

        $mosha = $dataLindjes
            ? (int) $dataLindjes->age
            : null;

        $ekipi = $lojtar->ekipi;

    @endphp

    <div class="player-profile">

        {{-- PAGE HEADER --}}

        <div class="pp-header">

            <div>

                <h1>Profili i Volejbollistes</h1>

                <p>

                    Informacionet personale,
                    sportive dhe historiku i volejbollistes.

                </p>

            </div>

            <a href="{{ route('lojtar.index') }}"
               class="pp-btn pp-btn-light">

                ← Kthehu te Lista

            </a>

        </div>

        {{-- PROFILE HERO --}}

        <div class="pp-hero">

            <div class="pp-hero-number">

                #{{ $lojtar->numriFanelles }}

            </div>

            <div class="pp-hero-content">

                <div class="pp-avatar">

                    {{ $inicialet }}

                </div>

                <div>

                <span class="pp-hero-label">

                    KV GJINOCI | PLAYER PROFILE

                </span>

                    <h2>

                        {{ $lojtar->emri }}

                        {{ $lojtar->mbiemri }}

                    </h2>

                    <p>

                        Volejbolliste e regjistruar
                        ne sistemin e klubit.

                    </p>

                    <div class="pp-hero-tags">

                    <span class="pp-tag">

                        #{{ $lojtar->numriFanelles }}

                    </span>

                        <span class="pp-tag">

                        🏐 {{ $lojtar->pozicioni }}

                    </span>

                        @if($ekipi)

                            <span class="pp-tag">

                            {{ $ekipi->emri }}

                        </span>

                        @endif

                    </div>

                </div>

            </div>

            <div class="pp-hero-bottom">

            <span>

                📍 {{ $lojtar->vendbanimi ?? '-' }}

            </span>

                @if($mosha !== null)

                    <span>

                    🎂 {{ $mosha }} vjec

                </span>

                @endif

                <span>

                ✉️ {{ $lojtar->email }}

            </span>

            </div>

        </div>

        {{-- SPORTS STATISTICS --}}

        <div class="pp-stats">

            <div class="pp-stat-card">

                <div class="pp-stat-top">

                <span class="pp-stat-label">

                    Fanella

                </span>

                    <div class="pp-stat-icon">

                        👕

                    </div>

                </div>

                <h3>

                    #{{ $lojtar->numriFanelles }}

                </h3>

                <small>

                    Numri i fanelles

                </small>

            </div>

            <div class="pp-stat-card">

                <div class="pp-stat-top">

                <span class="pp-stat-label">

                    Gjatesia

                </span>

                    <div class="pp-stat-icon pp-icon-green">

                        📏

                    </div>

                </div>

                <h3>

                    {{ $lojtar->gjatesia ?? '-' }}

                    <span style="font-size:14px">

                    cm

                </span>

                </h3>

                <small>

                    Gjatesia e volejbollistes

                </small>

            </div>

            <div class="pp-stat-card">

                <div class="pp-stat-top">

                <span class="pp-stat-label">

                    Mosha

                </span>

                    <div class="pp-stat-icon pp-icon-purple">

                        🎂

                    </div>

                </div>

                <h3>

                    {{ $mosha ?? '-' }}

                    <span style="font-size:14px">

                    vjec

                </span>

                </h3>

                <small>

                    Mosha aktuale

                </small>

            </div>

            <div class="pp-stat-card">

                <div class="pp-stat-top">

                <span class="pp-stat-label">

                    Pozicioni

                </span>

                    <div class="pp-stat-icon pp-icon-orange">

                        🏐

                    </div>

                </div>

                <h3 style="font-size:20px">

                    {{ $lojtar->pozicioni }}

                </h3>

                <small>

                    Pozicioni ne fushe

                </small>

            </div>

        </div>

        {{-- PERSONAL AND SPORTS INFORMATION --}}

        <div class="pp-content-grid">

            {{-- PERSONAL INFORMATION --}}

            <div class="pp-card">

                <div class="pp-card-header">

                    <div class="pp-card-icon">

                        👤

                    </div>

                    <div>

                        <h2>Te Dhenat Personale</h2>

                        <p>

                            Informacionet baze dhe kontaktet.

                        </p>

                    </div>

                </div>

                <div class="pp-info-row">

                    <span>Emri</span>

                    <strong>

                        {{ $lojtar->emri }}

                    </strong>

                </div>

                <div class="pp-info-row">

                    <span>Mbiemri</span>

                    <strong>

                        {{ $lojtar->mbiemri }}

                    </strong>

                </div>

                <div class="pp-info-row">

                    <span>Data e Lindjes</span>

                    <strong>

                        {{ $dataLindjes
                            ? $dataLindjes->format('d.m.Y')
                            : '-' }}

                    </strong>

                </div>

                <div class="pp-info-row">

                    <span>Email</span>

                    <strong>

                        {{ $lojtar->email ?? '-' }}

                    </strong>

                </div>

                <div class="pp-info-row">

                    <span>Telefoni</span>

                    <strong>

                        {{ $lojtar->nrTelefonit ?? '-' }}

                    </strong>

                </div>

                <div class="pp-info-row">

                    <span>Vendbanimi</span>

                    <strong>

                        {{ $lojtar->vendbanimi ?? '-' }}

                    </strong>

                </div>

            </div>

            {{-- SPORTS INFORMATION --}}

            <div class="pp-card">

                <div class="pp-card-header">

                    <div class="pp-card-icon
                            pp-card-icon-sport">

                        🏐

                    </div>

                    <div>

                        <h2>Informacionet Sportive</h2>

                        <p>

                            Fanella, pozicioni dhe ekipi.

                        </p>

                    </div>

                </div>

                <div class="pp-info-row">

                    <span>Numri i Fanelles</span>

                    <strong>

                        #{{ $lojtar->numriFanelles }}

                    </strong>

                </div>

                <div class="pp-info-row">

                    <span>Pozicioni</span>

                    <strong>

                        {{ $lojtar->pozicioni }}

                    </strong>

                </div>

                <div class="pp-info-row">

                    <span>Gjatesia</span>

                    <strong>

                        {{ $lojtar->gjatesia
                            ? $lojtar->gjatesia . ' cm'
                            : '-' }}

                    </strong>

                </div>

                <div class="pp-info-row">

                    <span>Ekipi</span>

                    <strong>

                        @if($ekipi)

                            <a href="{{ route(
                            'ekipet.show',
                            $ekipi
                        ) }}">

                                {{ $ekipi->emri }}

                            </a>

                        @else

                            Pa ekip

                        @endif

                    </strong>

                </div>

                <div class="pp-info-row">

                    <span>Kategoria</span>

                    <strong>

                        {{ $ekipi?->kategoria
                            ?? '-' }}

                    </strong>

                </div>

                {{-- TEAM PROFILE --}}

                <div class="pp-team-card">

                    <div class="pp-team-logo">

                        🏐

                    </div>

                    <div class="pp-team-content">

                        <strong>

                            {{ $ekipi?->emri
                                ?? 'Pa ekip' }}

                        </strong>

                        <small>

                            {{ $ekipi
                                ? 'Ekipi aktual'
                                : 'Ende pa ekip te caktuar' }}

                        </small>

                    </div>

                    @if($ekipi)

                        <a class="pp-team-link"
                           href="{{ route(
                           'ekipet.show',
                           $ekipi
                       ) }}">

                            Shiko →

                        </a>

                    @endif

                </div>

            </div>

        </div>

        {{-- ATTENDANCE HISTORY --}}

        <div class="pp-attendance-card">

            <div class="pp-attendance-info">

                <div class="pp-attendance-icon">

                    📋

                </div>

                <div>

                    <h2>Historiku i Prezences</h2>

                    <p>

                        Shiko pjesemarrjen e volejbollistes
                        ne stervitje, prezencat dhe mungesat.

                    </p>

                </div>

            </div>

            <a href="{{ route(
            'prezencat.historiku',
            $lojtar
        ) }}"
               class="pp-btn">

                Shiko Historikun →

            </a>

        </div>

        {{-- PAGE ACTIONS --}}

        <div class="pp-actions">

            <a href="{{ route(
            'lojtar.edit',
            $lojtar
        ) }}"
               class="pp-btn">

                ✏️ Edito Volejbollisten

            </a>

            <a href="{{ route('lojtar.index') }}"
               class="pp-btn pp-btn-gray">

                ← Kthehu te Lista

            </a>

            @if($ekipi)

                <a href="{{ route(
                'ekipet.show',
                $ekipi
            ) }}"
                   class="pp-btn pp-btn-light">

                    Shiko Ekipin

                </a>

            @endif

        </div>

    </div>

@endsection
