@extends('layouts.club')

@section('title', 'Detajet e Stervitjes - KV Gjinoci')

@section('content')

    <style>
        .training-detail {
            max-width: 1100px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .training-detail * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .td-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .td-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .td-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .td-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #253858;
            color: white !important;
            padding: 12px 18px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .td-btn:hover {
            transform: translateY(-1px);
            filter: brightness(.94);
        }

        .td-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .td-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* TRAINING HERO */

        .td-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            border-radius: 20px;
            color: white;
            padding: 30px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .td-hero::after {
            content: "🏐";
            position: absolute;
            right: -15px;
            bottom: -85px;
            font-size: 280px;
            opacity: .08;
            pointer-events: none;
        }

        .td-hero-content {
            position: relative;
            z-index: 1;
        }

        .td-hero-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .td-hero-label {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            color: #bfdbfe;
        }

        .td-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .td-status-completed {
            background: #dcfce7;
            color: #047857;
        }

        .td-status-planned {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .td-status-cancelled {
            background: #fee2e2;
            color: #dc2626;
        }

        .td-status-neutral {
            background: #edf2f7;
            color: #475569;
        }

        .td-hero-main {
            display: flex;
            align-items: center;
            gap: 23px;
        }

        .td-hero-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 90px;
            height: 90px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 20px;
            font-size: 43px;
            flex-shrink: 0;
        }

        .td-hero h2 {
            color: white !important;
            font-size: 30px;
            margin: 0 0 10px;
        }

        .td-hero p {
            color: #dbeafe !important;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .td-hero-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 15px;
        }

        .td-tag {
            display: inline-block;
            background: rgba(255,255,255,.13);
            border: 1px solid rgba(255,255,255,.20);
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            color: white;
        }

        .td-hero-bottom {
            display: flex;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
            border-top: 1px solid rgba(255,255,255,.18);
            margin-top: 28px;
            padding-top: 20px;
        }

        .td-hero-bottom span {
            color: #dbeafe;
            font-size: 13px;
        }

        /* INFORMATION CARDS */

        .td-info-grid {
            display: grid;
            grid-template-columns: repeat(
            4, minmax(0, 1fr)
        );
            gap: 16px;
            margin-bottom: 25px;
        }

        .td-info-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 16px;
            padding: 21px;
            min-width: 0;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .td-info-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: #e8efff;
            font-size: 21px;
            margin-bottom: 15px;
        }

        .td-icon-green {
            background: #dcfce7;
        }

        .td-icon-orange {
            background: #fff1df;
        }

        .td-icon-purple {
            background: #f1eaff;
        }

        .td-info-card small {
            display: block;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 9px;
        }

        .td-info-card strong {
            display: block;
            color: #172b4d;
            font-size: 18px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        /* CONTENT GRID */

        .td-content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
            align-items: start;
        }

        .td-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
            min-width: 0;
        }

        .td-card-header {
            display: flex;
            align-items: center;
            gap: 13px;
            border-bottom: 1px solid #e5ebf3;
            padding-bottom: 19px;
            margin-bottom: 5px;
        }

        .td-card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            background: #e8efff;
            border-radius: 12px;
            font-size: 22px;
            flex-shrink: 0;
        }

        .td-card-header h2 {
            color: #172b4d;
            font-size: 19px;
            margin: 0 0 6px;
        }

        .td-card-header p {
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
        }

        /* INFORMATION ROWS */

        .td-info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 17px 0;
            border-bottom: 1px solid #edf0f5;
            font-size: 13px;
        }

        .td-info-row:last-child {
            border-bottom: none;
            padding-bottom: 5px;
        }

        .td-info-row span {
            color: #64748b;
            flex-shrink: 0;
        }

        .td-info-row strong {
            color: #172b4d;
            text-align: right;
            font-weight: 600;
            overflow-wrap: anywhere;
            min-width: 0;
        }

        .td-info-row a {
            color: #2563eb;
            text-decoration: none;
        }

        .td-info-row a:hover {
            text-decoration: underline;
        }

        /* TRAINING DESCRIPTION */

        .td-description {
            background: #f8fafc;
            border: 1px solid #e5ebf3;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            color: #475569;
            font-size: 14px;
            line-height: 1.8;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            min-height: 110px;
        }

        .td-coach {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 17px;
            border: 1px solid #e5ebf3;
            background: #f8fafc;
            border-radius: 12px;
            margin-top: 20px;
        }

        .td-coach-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #e8efff;
            color: #253858;
            font-weight: bold;
            font-size: 16px;
            flex-shrink: 0;
        }

        .td-coach strong {
            color: #172b4d;
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .td-coach small {
            color: #64748b;
            font-size: 12px;
        }

        /* ATTENDANCE SECTION */

        .td-attendance {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 26px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .td-attendance-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .td-attendance-header h2 {
            font-size: 22px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .td-attendance-header p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        .td-attendance-grid {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 16px;
            margin-bottom: 23px;
        }

        .td-attendance-stat {
            background: #f8fafc;
            border: 1px solid #e5ebf3;
            padding: 20px;
            border-radius: 13px;
        }

        .td-attendance-stat small {
            color: #64748b;
            font-size: 12px;
        }

        .td-attendance-stat h3 {
            font-size: 31px;
            color: #172b4d;
            margin: 13px 0 5px;
        }

        .td-attendance-stat p {
            color: #64748b;
            font-size: 11px;
            margin: 0;
        }

        .td-stat-green {
            background: #f0fdf4;
            border-color: #dcfce7;
        }

        .td-stat-green h3 {
            color: #059669 !important;
        }

        .td-stat-red {
            background: #fff5f5;
            border-color: #fee2e2;
        }

        .td-stat-red h3 {
            color: #dc2626 !important;
        }

        /* ATTENDANCE PROGRESS */

        .td-progress-card {
            background: #f8fafc;
            border: 1px solid #e5ebf3;
            border-radius: 13px;
            padding: 21px;
        }

        .td-progress-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 14px;
        }

        .td-progress-header span {
            color: #475569;
            font-size: 13px;
            font-weight: 600;
        }

        .td-progress-header strong {
            color: #2563eb;
            font-size: 25px;
        }

        .td-progress {
            height: 12px;
            width: 100%;
            background: #e2e8f0;
            border-radius: 20px;
            overflow: hidden;
        }

        .td-progress-fill {
            height: 100%;
            background: linear-gradient(
                90deg,
                #2563eb,
                #60a5fa
            );
            border-radius: 20px;
        }

        .td-progress-note {
            color: #64748b;
            font-size: 12px;
            margin: 12px 0 0;
            line-height: 1.6;
        }

        /* PENDING ATTENDANCE */

        .td-pending {
            text-align: center;
            padding: 25px 15px;
        }

        .td-pending-icon {
            width: 76px;
            height: 76px;
            background: #e8efff;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin: 0 auto 18px;
        }

        .td-pending h3 {
            color: #172b4d;
            font-size: 20px;
            margin: 0 0 10px;
        }

        .td-pending p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
            max-width: 460px;
            margin: 0 auto 20px;
        }

        /* ACTIONS */

        .td-actions {
            display: flex;
            align-items: center;
            gap: 11px;
            flex-wrap: wrap;
        }

        .td-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 23px;
        }

        .td-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 23px;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {

            .td-info-grid {
                grid-template-columns: repeat(
                2, minmax(0, 1fr)
            );
            }

            .td-content-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 600px) {

            .td-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .td-header h1 {
                font-size: 25px;
            }

            .td-hero {
                padding: 23px;
            }

            .td-hero-main {
                gap: 15px;
            }

            .td-hero-icon {
                width: 65px;
                height: 65px;
                font-size: 30px;
                border-radius: 15px;
            }

            .td-hero h2 {
                font-size: 23px;
            }

            .td-hero-bottom {
                gap: 12px;
            }

            .td-info-grid {
                gap: 12px;
            }

            .td-info-card {
                padding: 16px;
            }

            .td-info-card strong {
                font-size: 15px;
            }

            .td-card,
            .td-attendance {
                padding: 19px;
            }

            .td-attendance-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .td-attendance-header > a {
                width: 100%;
            }

            .td-actions .td-btn {
                flex: 1;
            }

        }
    </style>

    @php

        $ekipi = $stervitja->ekipi;

        $trajneri = $stervitja->trajner;

        $sezoni = $stervitja->sezoni;

        $emriEkipit = $ekipi?->emri
            ?? 'Pa ekip';

        $emriTrajnerit = $trajneri
            ? $trajneri->emri . ' ' . $trajneri->mbiemri
            : 'Pa trajner';

        $inicialet = $trajneri
            ? mb_strtoupper(
                mb_substr($trajneri->emri, 0, 1)
                .
                mb_substr($trajneri->mbiemri, 0, 1)
            )
            : '-';

        $dataStervitjes = $stervitja->data
            ? \Carbon\Carbon::parse(
                $stervitja->data
            )->format('d.m.Y')
            : '-';

        $oraFillimit = $stervitja->ora_fillimit
            ? \Carbon\Carbon::parse(
                $stervitja->ora_fillimit
            )->format('H:i')
            : '-';

        $oraMbarimit = $stervitja->ora_mbarimit
            ? \Carbon\Carbon::parse(
                $stervitja->ora_mbarimit
            )->format('H:i')
            : '-';

        $perfunduar =
            $stervitja->statusi === 'Perfunduar';

        $statusClass = match($stervitja->statusi) {

            'Perfunduar' =>
                'td-status-completed',

            'Planifikuar' =>
                'td-status-planned',

            'Anuluar' =>
                'td-status-cancelled',

            default =>
                'td-status-neutral'
        };

        /*
        |--------------------------------------------------------------------------
        | PREZENCA
        |--------------------------------------------------------------------------
        */

        $listaPrezencave = $stervitja->prezencat;

        $totalPrezenca = $listaPrezencave->count();

        $totalPrezente = $listaPrezencave
            ->where('statusi', 'Prezente')
            ->count();

        $totalMungesa = $listaPrezencave
            ->filter(function ($prezenca) {

                return in_array(
                    $prezenca->statusi,
                    ['Mungon', 'Mungese', 'Mungesa']
                );

            })
            ->count();

        $totalVonese = $listaPrezencave
            ->filter(function ($prezenca) {

                return in_array(
                    mb_strtolower($prezenca->statusi),
                    ['me vonese', 'vonese']
                );

            })
            ->count();

        $perqindjaPrezences = $totalPrezenca > 0
            ? round(
                (
                    ($totalPrezente + $totalVonese)
                    / $totalPrezenca
                ) * 100
            )
            : 0;

    @endphp

    <div class="training-detail">

        {{-- PAGE HEADER --}}

        <div class="td-header">

            <div>

                <h1>Detajet e Stervitjes</h1>

                <p>

                    Informacionet, orari dhe
                    pjesemarrja ne stervitje.

                </p>

            </div>

            <a href="{{ route('stervitjet.index') }}"
               class="td-btn td-btn-light">

                ← Kthehu te Stervitjet

            </a>

        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="td-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- ERROR MESSAGES --}}

        @if($errors->any())

            <div class="td-errors">

                @foreach($errors->all() as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif

        {{-- TRAINING HERO --}}

        <div class="td-hero">

            <div class="td-hero-content">

                <div class="td-hero-top">

                <span class="td-hero-label">

                    KV GJINOCI | TRAINING CENTER

                </span>

                    <span class="td-status {{ $statusClass }}">

                    ● {{ $stervitja->statusi }}

                </span>

                </div>

                <div class="td-hero-main">

                    <div class="td-hero-icon">

                        🏐

                    </div>

                    <div>

                        <h2>{{ $emriEkipit }}</h2>

                        <p>

                            Stervitje e regjistruar
                            ne sistemin e klubit.

                        </p>

                        <div class="td-hero-tags">

                        <span class="td-tag">

                            {{ $stervitja->lloji }}

                        </span>

                            <span class="td-tag">

                            {{ $sezoni?->emri
                                ?? 'Pa sezon' }}

                        </span>

                            @if($ekipi)

                                <span class="td-tag">

                                {{ $ekipi->kategoria }}

                            </span>

                            @endif

                        </div>

                    </div>

                </div>

                <div class="td-hero-bottom">

                <span>

                    📅 {{ $dataStervitjes }}

                </span>

                    <span>

                    🕒 {{ $oraFillimit }}
                    -
                    {{ $oraMbarimit }}

                </span>

                    <span>

                    📍 {{ $stervitja->palestra ?? '-' }}

                </span>

                    <span>

                    👤 {{ $emriTrajnerit }}

                </span>

                </div>

            </div>

        </div>

        {{-- INFORMATION CARDS --}}

        <div class="td-info-grid">

            <div class="td-info-card">

                <div class="td-info-icon">

                    📅

                </div>

                <small>Data e Stervitjes</small>

                <strong>

                    {{ $dataStervitjes }}

                </strong>

            </div>

            <div class="td-info-card">

                <div class="td-info-icon td-icon-purple">

                    🕒

                </div>

                <small>Orari</small>

                <strong>

                    {{ $oraFillimit }}
                    -
                    {{ $oraMbarimit }}

                </strong>

            </div>

            <div class="td-info-card">

                <div class="td-info-icon td-icon-green">

                    📍

                </div>

                <small>Palestra</small>

                <strong>

                    {{ $stervitja->palestra ?? '-' }}

                </strong>

            </div>

            <div class="td-info-card">

                <div class="td-info-icon td-icon-orange">

                    🏆

                </div>

                <small>Sezoni</small>

                <strong>

                    {{ $sezoni?->emri ?? 'Pa sezon' }}

                </strong>

            </div>

        </div>

        {{-- TRAINING INFORMATION --}}

        <div class="td-content-grid">

            {{-- DETAILS --}}

            <div class="td-card">

                <div class="td-card-header">

                    <div class="td-card-icon">

                        📋

                    </div>

                    <div>

                        <h2>Informacionet e Stervitjes</h2>

                        <p>

                            Detajet e organizimit.

                        </p>

                    </div>

                </div>

                <div class="td-info-row">

                    <span>Ekipi</span>

                    <strong>

                        @if($ekipi)

                            <a href="{{ route(
                            'ekipet.show',
                            $ekipi
                        ) }}">

                                {{ $emriEkipit }}

                            </a>

                        @else

                            Pa ekip

                        @endif

                    </strong>

                </div>

                <div class="td-info-row">

                    <span>Lloji</span>

                    <strong>

                        {{ $stervitja->lloji ?? '-' }}

                    </strong>

                </div>

                <div class="td-info-row">

                    <span>Sezoni</span>

                    <strong>

                        {{ $sezoni?->emri ?? '-' }}

                    </strong>

                </div>

                <div class="td-info-row">

                    <span>Statusi</span>

                    <strong>

                        {{ $stervitja->statusi }}

                    </strong>

                </div>

                <div class="td-coach">

                    <div class="td-coach-avatar">

                        {{ $inicialet }}

                    </div>

                    <div>

                        <strong>

                            {{ $emriTrajnerit }}

                        </strong>

                        <small>

                            Trajneri pergjegjes

                        </small>

                    </div>

                </div>

            </div>

            {{-- DESCRIPTION --}}

            <div class="td-card">

                <div class="td-card-header">

                    <div class="td-card-icon td-icon-purple">

                        📝

                    </div>

                    <div>

                        <h2>Pershkrimi i Stervitjes</h2>

                        <p>

                            Ushtrimet dhe aktivitetet
                            e planifikuara.

                        </p>

                    </div>

                </div>

                <div class="td-description">{{ $stervitja->pershkrimi ?: 'Nuk ka pershkrim te regjistruar per kete stervitje.' }}</div>

                <div style="margin-top:20px">

                    <a href="{{ route(
                    'stervitjet.edit',
                    $stervitja
                ) }}"
                       class="td-btn td-btn-light">

                        ✏️ Edito Stervitjen

                    </a>

                </div>

            </div>

        </div>

        {{-- ATTENDANCE SECTION --}}

        <div class="td-attendance">

            <div class="td-attendance-header">

                <div>

                    <h2>Prezenca ne Stervitje</h2>

                    <p>

                        Monitoro pjesemarrjen
                        dhe mungesat e volejbollisteve.

                    </p>

                </div>

                @if($perfunduar)

                    <a href="{{ route(
                    'prezencat.edit',
                    $stervitja
                ) }}"
                       class="td-btn">

                        📋 Menaxho Prezencen

                    </a>

                @endif

            </div>

            @if($perfunduar)

                {{-- ATTENDANCE STATISTICS --}}

                <div class="td-attendance-grid">

                    <div class="td-attendance-stat">

                        <small>

                            Volejbolliste te Evidentuara

                        </small>

                        <h3>{{ $totalPrezenca }}</h3>

                        <p>

                            Total prezenca te regjistruara

                        </p>

                    </div>

                    <div class="td-attendance-stat td-stat-green">

                        <small>

                            ✓ Prezente

                        </small>

                        <h3>{{ $totalPrezente }}</h3>

                        <p>

                            Volejbolliste prezente

                        </p>

                    </div>

                    <div class="td-attendance-stat td-stat-red">

                        <small>

                            ✕ Mungesa

                        </small>

                        <h3>{{ $totalMungesa }}</h3>

                        <p>

                            Mungesa te paarsyetuara

                        </p>

                    </div>

                </div>

                {{-- PROGRESS BAR --}}

                @if($totalPrezenca > 0)

                    <div class="td-progress-card">

                        <div class="td-progress-header">

                        <span>

                            Perqindja e Prezences

                        </span>

                            <strong>

                                {{ $perqindjaPrezences }}%

                            </strong>

                        </div>

                        <div class="td-progress"
                             role="progressbar"
                             aria-label="Perqindja e prezences"
                             aria-valuemin="0"
                             aria-valuemax="100"
                             aria-valuenow="{{ $perqindjaPrezences }}">

                            <div class="td-progress-fill"
                                 style="width: {{ $perqindjaPrezences }}%">

                            </div>

                        </div>

                        <p class="td-progress-note">

                            {{ $totalPrezente + $totalVonese }}

                            nga

                            {{ $totalPrezenca }}

                            volejbolliste te evidentuara
                            kane marre pjese ne stervitje,
                            duke perfshire ardhjet me vonese.

                        </p>

                    </div>

                @else

                    <div class="td-pending">

                        <div class="td-pending-icon">

                            📋

                        </div>

                        <h3>

                            Prezenca ende nuk eshte regjistruar

                        </h3>

                        <p>

                            Kliko Menaxho Prezencen
                            per te regjistruar pjesemarrjen
                            e volejbollisteve ne kete stervitje.

                        </p>

                        <a href="{{ route(
                        'prezencat.edit',
                        $stervitja
                    ) }}"
                           class="td-btn">

                            Regjistro Prezencen

                        </a>

                    </div>

                @endif

            @else

                {{-- PLANNED TRAINING --}}

                <div class="td-pending">

                    <div class="td-pending-icon">

                        ⏳

                    </div>

                    <h3>

                        Prezenca nuk eshte ende e disponueshme

                    </h3>

                    <p>

                        Regjistrimi i prezences behet
                        pasi stervitja te perfundoje.
                        Perditeso statusin e stervitjes
                        kur aktiviteti te kete perfunduar.

                    </p>

                    <a href="{{ route(
                    'stervitjet.edit',
                    $stervitja
                ) }}"
                       class="td-btn">

                        Edito Stervitjen

                    </a>

                </div>

            @endif

        </div>

        {{-- PAGE ACTIONS --}}

        <div class="td-actions">

            <a href="{{ route(
            'stervitjet.edit',
            $stervitja
        ) }}"
               class="td-btn">

                ✏️ Edito Stervitjen

            </a>

            @if($perfunduar)

                <a href="{{ route(
                'prezencat.edit',
                $stervitja
            ) }}"
                   class="td-btn td-btn-light">

                    Menaxho Prezencen

                </a>

            @endif

            <a href="{{ route('stervitjet.index') }}"
               class="td-btn td-btn-gray">

                ← Kthehu te Stervitjet

            </a>

        </div>

    </div>

@endsection
