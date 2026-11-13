@extends('layouts.club')

@section('title', $ekipi->emri . ' - KV Gjinoci')

@section('content')

    <style>
        .team-profile-page {
            max-width: 1100px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .team-profile-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .tp-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .tp-header h1 {
            color: #172b4d;
            font-size: 30px;
            margin: 0 0 8px;
        }

        .tp-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .tp-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #253858;
            color: white !important;
            border: none;
            border-radius: 9px;
            padding: 12px 18px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            transition: .2s;
            white-space: nowrap;
        }

        .tp-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .tp-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .tp-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* TEAM HERO */

        .tp-hero {
            background: linear-gradient(
                130deg,
                #172b4d,
                #315b89
            );
            border-radius: 20px;
            padding: 32px;
            color: white;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .tp-hero::after {
            content: "🏐";
            position: absolute;
            right: -10px;
            bottom: -80px;
            font-size: 280px;
            opacity: .08;
            pointer-events: none;
        }

        .tp-hero-content {
            display: flex;
            align-items: center;
            gap: 24px;
            position: relative;
            z-index: 1;
        }

        .tp-team-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
            border-radius: 23px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.24);
            font-size: 48px;
            flex-shrink: 0;
        }

        .tp-hero-label {
            display: block;
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: bold;
            margin-bottom: 11px;
        }

        .tp-hero h2 {
            color: white !important;
            font-size: 32px;
            margin: 0 0 12px;
            overflow-wrap: anywhere;
        }

        .tp-hero p {
            color: #dbeafe !important;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        .tp-hero-bottom {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
            border-top: 1px solid rgba(255,255,255,.18);
            margin-top: 27px;
            padding-top: 21px;
        }

        .tp-hero-bottom span {
            color: #dbeafe;
            font-size: 13px;
        }

        .tp-category {
            display: inline-block;
            background: rgba(255,255,255,.17);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 20px;
            padding: 7px 13px;
            font-size: 12px;
            color: white !important;
            margin-top: 12px;
        }

        /* STATISTICS CARDS */

        .tp-stats {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 18px;
            margin-bottom: 26px;
        }

        .tp-stat-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 16px;
            padding: 23px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .tp-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .tp-stat-label {
            font-size: 13px;
            color: #64748b;
        }

        .tp-stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            background: #e8efff;
            border-radius: 11px;
            font-size: 21px;
        }

        .tp-icon-green {
            background: #dcfce7;
        }

        .tp-icon-orange {
            background: #fff1df;
        }

        .tp-stat-card h3 {
            font-size: 27px;
            color: #172b4d;
            margin: 16px 0 7px;
            overflow-wrap: anywhere;
        }

        .tp-stat-card small {
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.5;
        }

        /* PLAYERS CARD */

        .tp-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 26px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .tp-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 23px;
            flex-wrap: wrap;
        }

        .tp-card-header h2 {
            font-size: 22px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .tp-card-header p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
        }

        /* TABLE */

        .tp-table-scroll {
            overflow-x: auto;
        }

        .tp-table {
            width: 100%;
            min-width: 650px;
            border-collapse: collapse;
        }

        .tp-table th {
            background: #253858;
            color: white;
            padding: 15px 16px;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        .tp-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .tp-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .tp-table td {
            padding: 17px 16px;
            border-bottom: 1px solid #e5ebf3;
            color: #172b4d;
            font-size: 13px;
            vertical-align: middle;
        }

        .tp-table tbody tr:hover {
            background: #f8fafc;
        }

        /* PLAYER PROFILE */

        .tp-player-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .tp-player-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #e8efff;
            color: #253858;
            font-size: 14px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .tp-player-name {
            color: #172b4d;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .tp-player-email {
            color: #64748b;
            font-size: 11px;
        }

        .tp-jersey {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 39px;
            height: 39px;
            padding: 0 8px;
            background: #edf2f7;
            border-radius: 9px;
            color: #253858;
            font-weight: bold;
            font-size: 15px;
        }

        .tp-position {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 7px;
            background: #e8efff;
            color: #2563eb;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .tp-profile-btn {
            display: inline-block;
            padding: 9px 13px;
            border-radius: 7px;
            background: #edf2f7;
            color: #253858 !important;
            text-decoration: none !important;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .tp-profile-btn:hover {
            background: #dbeafe;
        }

        /* EMPTY STATE */

        .tp-empty {
            text-align: center;
            padding: 40px 20px 30px;
        }

        .tp-empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 82px;
            height: 82px;
            background: #e8efff;
            border-radius: 20px;
            font-size: 36px;
            margin: 0 auto 20px;
        }

        .tp-empty h3 {
            color: #172b4d;
            font-size: 21px;
            margin: 0 0 10px;
        }

        .tp-empty p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            max-width: 450px;
            margin: 0 auto 22px;
        }

        /* ACTIONS */

        .tp-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 11px;
        }

        /* RESPONSIVE */

        @media (max-width: 750px) {

            .tp-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .tp-header h1 {
                font-size: 25px;
            }

            .tp-hero {
                padding: 24px;
            }

            .tp-hero-content {
                gap: 16px;
            }

            .tp-team-logo {
                width: 65px;
                height: 65px;
                font-size: 33px;
                border-radius: 16px;
            }

            .tp-hero h2 {
                font-size: 23px;
            }

            .tp-stats {
                grid-template-columns: 1fr;
                gap: 13px;
            }

            .tp-card {
                padding: 18px;
            }

            .tp-actions .tp-btn {
                flex: 1;
            }
        }
    </style>

    @php

        $volejbollistet = \App\Models\Lojtar::where(
            'ekipi_id',
            $ekipi->id
        )
        ->orderBy('numriFanelles')
        ->get();

        $trajneri = $ekipi->trajner;

        $emriTrajnerit = $trajneri
            ? $trajneri->emri . ' ' . $trajneri->mbiemri
            : 'Pa trajner';

    @endphp

    <div class="team-profile-page">

        {{-- PAGE HEADER --}}

        <div class="tp-header">

            <div>

                <h1>Profili i Ekipit</h1>

                <p>
                    Informacionet e ekipit,
                    stafi profesional dhe volejbollistet.
                </p>

            </div>

            <a href="{{ route('ekipet.index') }}"
               class="tp-btn tp-btn-light">

                ← Kthehu te Ekipet

            </a>

        </div>

        {{-- TEAM HERO --}}

        <div class="tp-hero">

            <div class="tp-hero-content">

                <div class="tp-team-logo">

                    🏐

                </div>

                <div>

                <span class="tp-hero-label">

                    KV GJINOCI | TEAM PROFILE

                </span>

                    <h2>{{ $ekipi->emri }}</h2>

                    <p>

                        Ekip i regjistruar ne sistemin
                        e menaxhimit te volejbollit.

                    </p>

                    <span class="tp-category">

                    {{ $ekipi->kategoria }}

                </span>

                </div>

            </div>

            <div class="tp-hero-bottom">

            <span>

                👤 Trajneri: {{ $emriTrajnerit }}

            </span>

                <span>

                👥 Volejbolliste:
                {{ $volejbollistet->count() }}

            </span>

            </div>

        </div>

        {{-- STATISTICS --}}

        <div class="tp-stats">

            <div class="tp-stat-card">

                <div class="tp-stat-top">

                <span class="tp-stat-label">

                    Volejbolliste

                </span>

                    <span class="tp-stat-icon">

                    👥

                </span>

                </div>

                <h3>{{ $volejbollistet->count() }}</h3>

                <small>

                    Volejbolliste ne ekip

                </small>

            </div>

            <div class="tp-stat-card">

                <div class="tp-stat-top">

                <span class="tp-stat-label">

                    Kategoria

                </span>

                    <span class="tp-stat-icon tp-icon-orange">

                    🏆

                </span>

                </div>

                <h3>{{ $ekipi->kategoria }}</h3>

                <small>

                    Kategoria sportive e ekipit

                </small>

            </div>

            <div class="tp-stat-card">

                <div class="tp-stat-top">

                <span class="tp-stat-label">

                    Trajneri

                </span>

                    <span class="tp-stat-icon tp-icon-green">

                    👤

                </span>

                </div>

                <h3 style="font-size:21px">

                    {{ $emriTrajnerit }}

                </h3>

                <small>

                    Trajneri pergjegjes i ekipit

                </small>

            </div>

        </div>

        {{-- PLAYERS LIST --}}

        <div class="tp-card">

            <div class="tp-card-header">

                <div>

                    <h2>Lista e Volejbollisteve</h2>

                    <p>

                        Volejbollistet e regjistruara
                        ne ekipin {{ $ekipi->emri }}.

                    </p>

                </div>

                <a href="{{ route('lojtar.create') }}"
                   class="tp-btn">

                    + Shto Volejbolliste

                </a>

            </div>

            @if($volejbollistet->isEmpty())

                {{-- EMPTY STATE --}}

                <div class="tp-empty">

                    <div class="tp-empty-icon">

                        👥

                    </div>

                    <h3>

                        Nuk ka volejbolliste ne kete ekip

                    </h3>

                    <p>

                        Ky ekip ende nuk ka volejbolliste
                        te regjistruara. Regjistro nje
                        volejbolliste te re ose cakto
                        nje volejbolliste ekzistuese
                        ne kete ekip.

                    </p>

                    <a href="{{ route('lojtar.create') }}"
                       class="tp-btn">

                        + Regjistro Volejbolliste

                    </a>

                </div>

            @else

                {{-- PLAYERS TABLE --}}

                <div class="tp-table-scroll">

                    <table class="tp-table">

                        <thead>

                        <tr>

                            <th>Nr.</th>

                            <th>Volejbollistja</th>

                            <th>Pozicioni</th>

                            <th>Gjatesia</th>

                            <th>Profili</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($volejbollistet as $lojtar)

                            @php

                                $inicialet = mb_strtoupper(
                                    mb_substr(
                                        $lojtar->emri,
                                        0,
                                        1
                                    )
                                    .
                                    mb_substr(
                                        $lojtar->mbiemri,
                                        0,
                                        1
                                    )
                                );

                            @endphp

                            <tr>

                                <td>

                                    <span class="tp-jersey">

                                        #{{ $lojtar->numriFanelles }}

                                    </span>

                                </td>

                                <td>

                                    <div class="tp-player-info">

                                        <div class="tp-player-avatar">

                                            {{ $inicialet }}

                                        </div>

                                        <div>

                                            <div class="tp-player-name">

                                                {{ $lojtar->emri }}

                                                {{ $lojtar->mbiemri }}

                                            </div>

                                            <div class="tp-player-email">

                                                {{ $lojtar->email }}

                                            </div>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <span class="tp-position">

                                        {{ $lojtar->pozicioni }}

                                    </span>

                                </td>

                                <td>

                                    {{ $lojtar->gjatesia
                                        ? $lojtar->gjatesia . ' cm'
                                        : '-' }}

                                </td>

                                <td>

                                    <a class="tp-profile-btn"
                                       href="{{ route(
                                           'lojtar.show',
                                           $lojtar
                                       ) }}">

                                        Shiko Profilin →

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

        {{-- PAGE ACTIONS --}}

        <div class="tp-actions">

            <a href="{{ route(
               'ekipet.edit',
               $ekipi
           ) }}"
               class="tp-btn">

                ✏️ Edito Ekipin

            </a>

            <a href="{{ route('ekipet.index') }}"
               class="tp-btn tp-btn-gray">

                ← Kthehu te Ekipet

            </a>

            <a href="{{ route('lojtar.index') }}"
               class="tp-btn tp-btn-light">

                Menaxho Volejbollistet

            </a>

        </div>

    </div>

@endsection
