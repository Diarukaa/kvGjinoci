@extends('layouts.club')

@section('title', 'Menaxho Prezencen - KV Gjinoci')

@section('content')

    <style>
        .attendance-edit {
            max-width: 1150px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .attendance-edit * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .ae-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .ae-header h1 {
            font-size: 30px;
            margin: 0 0 8px;
            color: #172b4d;
        }

        .ae-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .ae-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 19px;
            border: none;
            border-radius: 9px;
            background: #253858;
            color: white !important;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .ae-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .ae-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .ae-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        .ae-btn-green {
            background: #dcfce7;
            color: #047857 !important;
        }

        /* TRAINING HERO */

        .ae-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            border-radius: 20px;
            padding: 30px;
            color: white;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .ae-hero::after {
            content: "🏐";
            position: absolute;
            right: -10px;
            bottom: -80px;
            font-size: 260px;
            opacity: .08;
            pointer-events: none;
        }

        .ae-hero-content {
            position: relative;
            z-index: 1;
        }

        .ae-hero-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 23px;
            flex-wrap: wrap;
        }

        .ae-hero-label {
            font-size: 11px;
            font-weight: bold;
            color: #bfdbfe;
            letter-spacing: 1.5px;
        }

        .ae-training-status {
            display: inline-block;
            border-radius: 20px;
            padding: 8px 14px;
            background: #dcfce7;
            color: #047857;
            font-size: 12px;
            font-weight: bold;
        }

        .ae-hero-main {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .ae-hero-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 85px;
            height: 85px;
            flex-shrink: 0;
            border-radius: 20px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.22);
            font-size: 38px;
        }

        .ae-hero h2 {
            font-size: 30px;
            color: white !important;
            margin: 0 0 10px;
        }

        .ae-hero p {
            color: #dbeafe !important;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        .ae-hero-bottom {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            border-top: 1px solid rgba(255,255,255,.18);
            padding-top: 20px;
            margin-top: 25px;
        }

        .ae-hero-bottom span {
            color: #dbeafe;
            font-size: 13px;
        }

        /* STATISTICS */

        .ae-stats {
            display: grid;
            grid-template-columns: repeat(
            5, minmax(0, 1fr)
        );
            gap: 15px;
            margin-bottom: 25px;
        }

        .ae-stat-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 20px;
            min-width: 0;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .ae-stat-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #e8efff;
            font-size: 20px;
            margin-bottom: 13px;
        }

        .ae-icon-green {
            background: #dcfce7;
            color: #059669;
        }

        .ae-icon-red {
            background: #fee2e2;
            color: #dc2626;
        }

        .ae-icon-orange {
            background: #fff1df;
            color: #d97706;
        }

        .ae-icon-purple {
            background: #f1eaff;
            color: #7c3aed;
        }

        .ae-stat-card small {
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .ae-stat-card h3 {
            font-size: 30px;
            margin: 9px 0 0;
            color: #172b4d;
        }

        .ae-green {
            color: #059669 !important;
        }

        .ae-red {
            color: #dc2626 !important;
        }

        .ae-orange {
            color: #d97706 !important;
        }

        .ae-purple {
            color: #7c3aed !important;
        }

        /* ATTENDANCE PROGRESS */

        .ae-progress-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 23px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .ae-progress-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 15px;
        }

        .ae-progress-header h3 {
            color: #172b4d;
            font-size: 17px;
            margin: 0 0 5px;
        }

        .ae-progress-header small {
            color: #64748b;
            font-size: 12px;
        }

        .ae-progress-header strong {
            font-size: 29px;
            color: #2563eb;
        }

        .ae-progress {
            width: 100%;
            height: 11px;
            border-radius: 20px;
            background: #e5ebf3;
            overflow: hidden;
        }

        .ae-progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(
                90deg,
                #2563eb,
                #60a5fa
            );
            border-radius: 20px;
            transition: width .3s ease;
        }

        /* MAIN CARD */

        .ae-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 26px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .ae-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .ae-card-header h2 {
            font-size: 22px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .ae-card-header p {
            font-size: 13px;
            color: #64748b;
            margin: 0;
            line-height: 1.6;
        }

        /* TOOLBAR */

        .ae-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            background: #f8fafc;
            border: 1px solid #e5ebf3;
            border-radius: 11px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .ae-toolbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .ae-search {
            flex: 1;
            min-width: 170px;
            max-width: 300px;
        }

        .attendance-edit .ae-search input {
            width: 100%;
            min-height: 40px;
            padding: 10px 13px;
            margin: 0;
            border: 1px solid #dbe3ee;
            border-radius: 8px;
            background: white;
            font-size: 13px;
            color: #172b4d;
            outline: none;
        }

        .attendance-edit .ae-search input:focus {
            border-color: #2563eb;
        }

        /* TABLE */

        .ae-table-scroll {
            overflow-x: auto;
        }

        .ae-table {
            width: 100%;
            min-width: 780px;
            border-collapse: collapse;
        }

        .ae-table th {
            background: #253858;
            color: white;
            padding: 15px 14px;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        .ae-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .ae-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .ae-table td {
            padding: 17px 14px;
            border-bottom: 1px solid #e5ebf3;
            color: #172b4d;
            font-size: 13px;
            vertical-align: middle;
        }

        .ae-table tbody tr:hover {
            background: #f8fafc;
        }

        .ae-player-info {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .ae-avatar {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 50%;
            background: #e8efff;
            color: #253858;
            font-size: 14px;
            font-weight: bold;
        }

        .ae-player-name {
            display: block;
            font-weight: 600;
            font-size: 14px;
            color: #172b4d !important;
            text-decoration: none !important;
        }

        .ae-player-name:hover {
            color: #2563eb !important;
        }

        .ae-player-position {
            display: inline-block;
            color: #475569;
            background: #edf2f7;
            border-radius: 7px;
            padding: 7px 9px;
            font-size: 11px;
            white-space: nowrap;
        }

        .ae-jersey {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 37px;
            height: 37px;
            border-radius: 8px;
            background: #edf2f7;
            font-size: 14px;
            font-weight: bold;
        }

        /* STATUS SELECT */

        .attendance-edit .ae-status-select {
            width: 100%;
            min-width: 145px;
            min-height: 42px;
            border: 1px solid #dbe3ee;
            border-radius: 8px;
            padding: 10px 12px;
            margin: 0;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            outline: none;
        }

        .attendance-edit .ae-present {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #047857;
        }

        .attendance-edit .ae-absent {
            background: #fff1f2;
            border-color: #fecdd3;
            color: #be123c;
        }

        .attendance-edit .ae-late {
            background: #fff7ed;
            border-color: #fed7aa;
            color: #b45309;
        }

        .attendance-edit .ae-excused {
            background: #f5f3ff;
            border-color: #ddd6fe;
            color: #7c3aed;
        }

        /* NOTES */

        .attendance-edit .ae-notes {
            width: 100%;
            min-width: 160px;
            min-height: 42px;
            padding: 10px 12px;
            margin: 0;
            border: 1px solid #dbe3ee;
            border-radius: 8px;
            background: #f8fafc;
            font-size: 13px;
            color: #172b4d;
            outline: none;
        }

        .attendance-edit .ae-notes:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        /* EMPTY STATE */

        .ae-empty {
            text-align: center;
            padding: 35px 20px;
        }

        .ae-empty-icon {
            width: 75px;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            background: #e8efff;
            font-size: 33px;
            margin: 0 auto 18px;
        }

        .ae-empty h3 {
            color: #172b4d;
            margin: 0 0 10px;
            font-size: 20px;
        }

        .ae-empty p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        /* INFORMATION */

        .ae-info {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            padding: 17px;
            margin-top: 24px;
        }

        .ae-info strong {
            display: block;
            color: #1e40af;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .ae-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* FORM ACTIONS */

        .ae-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            border-top: 1px solid #e5ebf3;
            margin-top: 25px;
            padding-top: 22px;
        }

        .ae-actions-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .ae-save-status {
            color: #64748b;
            font-size: 12px;
        }

        /* ALERTS */

        .ae-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .ae-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .ae-errors ul {
            margin: 10px 0 0;
            padding-left: 20px;
        }

        /* RESPONSIVE */

        @media (max-width: 950px) {

            .ae-stats {
                grid-template-columns: repeat(3, 1fr);
            }

        }

        @media (max-width: 650px) {

            .ae-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .ae-header h1 {
                font-size: 25px;
            }

            .ae-hero {
                padding: 22px;
            }

            .ae-hero-main {
                gap: 14px;
            }

            .ae-hero-icon {
                width: 60px;
                height: 60px;
                font-size: 28px;
                border-radius: 15px;
            }

            .ae-hero h2 {
                font-size: 24px;
            }

            .ae-hero-bottom {
                gap: 12px;
            }

            .ae-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .ae-stat-card {
                padding: 16px;
            }

            .ae-stat-card h3 {
                font-size: 26px;
            }

            .ae-card {
                padding: 18px;
            }

            .ae-toolbar {
                align-items: stretch;
            }

            .ae-search {
                max-width: none;
                width: 100%;
            }

            .ae-actions-right {
                width: 100%;
            }

            .ae-actions-right .ae-btn {
                flex: 1;
            }

        }
    </style>

    @php

        $ekipi = $stervitja->ekipi;

        $listaLojtareve = $lojtaret ?? \App\Models\Lojtar::where(
            'ekipi_id',
            $stervitja->ekipi_id
        )->orderBy('numriFanelles')->get();

        $prezencatEkzistuese = $stervitja
            ->prezencat
            ->keyBy('lojtar_id');

        $dataStervitjes = \Carbon\Carbon::parse(
            $stervitja->data
        )->format('d.m.Y');

        $oraFillimit = substr(
            (string) $stervitja->ora_fillimit,
            0,
            5
        );

        $oraMbarimit = substr(
            (string) $stervitja->ora_mbarimit,
            0,
            5
        );

    @endphp

    <div class="attendance-edit">

        {{-- PAGE HEADER --}}

        <div class="ae-header">

            <div>

                <h1>Menaxho Prezencen</h1>

                <p>

                    Regjistro pjesemarrjen,
                    mungesat dhe vonesat
                    e volejbollisteve ne stervitje.

                </p>

            </div>

            <a href="{{ route(
            'stervitjet.show',
            $stervitja
        ) }}"
               class="ae-btn ae-btn-light">

                ← Kthehu te Stervitja

            </a>

        </div>

        {{-- SUCCESS --}}

        @if(session('success'))

            <div class="ae-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- ERRORS --}}

        @if($errors->any())

            <div class="ae-errors">

                <strong>

                    Kontrollo te dhenat:

                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- TRAINING HERO --}}

        <div class="ae-hero">

            <div class="ae-hero-content">

                <div class="ae-hero-top">

                <span class="ae-hero-label">

                    KV GJINOCI | ATTENDANCE MANAGEMENT

                </span>

                    <span class="ae-training-status">

                    {{ $stervitja->statusi }}

                </span>

                </div>

                <div class="ae-hero-main">

                    <div class="ae-hero-icon">

                        📋

                    </div>

                    <div>

                        <h2>

                            {{ $ekipi?->emri ?? 'Pa ekip' }}

                        </h2>

                        <p>

                            Regjistrimi i prezences
                            per stervitjen e ekipit.

                        </p>

                    </div>

                </div>

                <div class="ae-hero-bottom">

                <span>

                    📅 {{ $dataStervitjes }}

                </span>

                    <span>

                    🕒 {{ $oraFillimit }}
                    -
                    {{ $oraMbarimit }}

                </span>

                    <span>

                    🏐 {{ $stervitja->lloji }}

                </span>

                    <span>

                    📍 {{ $stervitja->palestra ?? '-' }}

                </span>

                </div>

            </div>

        </div>

        {{-- LIVE STATISTICS --}}

        <div class="ae-stats">

            <div class="ae-stat-card">

                <div class="ae-stat-icon">

                    👥

                </div>

                <small>Volejbolliste</small>

                <h3 id="ae-total">

                    {{ $listaLojtareve->count() }}

                </h3>

            </div>

            <div class="ae-stat-card">

                <div class="ae-stat-icon ae-icon-green">

                    ✓

                </div>

                <small>Prezente</small>

                <h3 id="ae-present"
                    class="ae-green">

                    0

                </h3>

            </div>

            <div class="ae-stat-card">

                <div class="ae-stat-icon ae-icon-red">

                    ✕

                </div>

                <small>Mungesa</small>

                <h3 id="ae-absent"
                    class="ae-red">

                    0

                </h3>

            </div>

            <div class="ae-stat-card">

                <div class="ae-stat-icon ae-icon-orange">

                    🕒

                </div>

                <small>Me Vonese</small>

                <h3 id="ae-late"
                    class="ae-orange">

                    0

                </h3>

            </div>

            <div class="ae-stat-card">

                <div class="ae-stat-icon ae-icon-purple">

                    📝

                </div>

                <small>Te Arsyetuara</small>

                <h3 id="ae-excused"
                    class="ae-purple">

                    0

                </h3>

            </div>

        </div>

        {{-- ATTENDANCE PROGRESS --}}

        <div class="ae-progress-card">

            <div class="ae-progress-header">

                <div>

                    <h3>Perqindja e Prezences</h3>

                    <small id="ae-progress-text">

                        Pjesemarrja sipas statuseve
                        te zgjedhura

                    </small>

                </div>

                <strong id="ae-percent">

                    0%

                </strong>

            </div>

            <div class="ae-progress">

                <div class="ae-progress-fill"
                     id="ae-progress-fill">

                </div>

            </div>

        </div>

        {{-- ATTENDANCE FORM --}}

        <div class="ae-card">

            <div class="ae-card-header">

                <div>

                    <h2>Lista e Volejbollisteve</h2>

                    <p>

                        Zgjedh statusin e seciles
                        volejbolliste dhe shto shenime
                        sipas nevojes.

                    </p>

                </div>

            </div>

            @if($listaLojtareve->isEmpty())

                <div class="ae-empty">

                    <div class="ae-empty-icon">

                        👥

                    </div>

                    <h3>Nuk ka volejbolliste</h3>

                    <p>

                        Ky ekip nuk ka volejbolliste
                        te regjistruara per evidentimin
                        e prezences.

                    </p>

                </div>

            @else

                <form method="POST"
                      id="attendance-form"
                      action="{{ route(
                      'prezencat.update',
                      $stervitja
                  ) }}">

                    @csrf

                    @method('PUT')

                    {{-- TOOLBAR --}}

                    <div class="ae-toolbar">

                        <div class="ae-toolbar-left">

                            <button type="button"
                                    id="ae-mark-present"
                                    class="ae-btn ae-btn-green">

                                ✓ Sheno te gjitha prezente

                            </button>

                            <button type="button"
                                    id="ae-reset"
                                    class="ae-btn ae-btn-gray">

                                Rikthe Statuset

                            </button>

                        </div>

                        <div class="ae-search">

                            <input
                                type="search"
                                id="ae-player-search"
                                placeholder="Kerko volejbolliste..."
                            >

                        </div>

                    </div>

                    {{-- PLAYERS TABLE --}}

                    <div class="ae-table-scroll">

                        <table class="ae-table">

                            <thead>

                            <tr>

                                <th>Nr.</th>

                                <th>Volejbollistja</th>

                                <th>Pozicioni</th>

                                <th>Statusi</th>

                                <th>Shenime</th>

                            </tr>

                            </thead>

                            <tbody>

                            @foreach($listaLojtareve as $lojtar)

                                @php

                                    $prezenca =
                                        $prezencatEkzistuese
                                            ->get($lojtar->id);

                                    $statusi = old(
                                        'prezencat.' .
                                        $lojtar->id .
                                        '.statusi',
                                        $prezenca?->statusi
                                            ?? 'Prezente'
                                    );

                                    $shenime = old(
                                        'prezencat.' .
                                        $lojtar->id .
                                        '.shenime',
                                        $prezenca?->shenime
                                            ?? ''
                                    );

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

                                <tr class="ae-player-row"
                                    data-name="{{ $lojtar->emri . ' ' . $lojtar->mbiemri }}">

                                    {{-- JERSEY --}}

                                    <td>

                                        <span class="ae-jersey">

                                            #{{ $lojtar->numriFanelles }}

                                        </span>

                                    </td>

                                    {{-- PLAYER --}}

                                    <td>

                                        <div class="ae-player-info">

                                            <div class="ae-avatar">

                                                {{ $inicialet }}

                                            </div>

                                            <a href="{{ route(
                                                'lojtar.show',
                                                $lojtar
                                            ) }}"
                                               class="ae-player-name">

                                                {{ $lojtar->emri }}

                                                {{ $lojtar->mbiemri }}

                                            </a>

                                        </div>

                                    </td>

                                    {{-- POSITION --}}

                                    <td>

                                        <span class="ae-player-position">

                                            {{ $lojtar->pozicioni }}

                                        </span>

                                    </td>

                                    {{-- STATUS --}}

                                    <td>

                                        <select
                                            name="prezencat[{{ $lojtar->id }}][statusi]"
                                            class="ae-status-select"
                                            data-original="{{ $prezenca?->statusi ?? 'Prezente' }}"
                                            required
                                        >

                                            <option value="Prezente"
                                                @selected($statusi === 'Prezente')>

                                                Prezente

                                            </option>

                                            <option value="Mungon"
                                                @selected($statusi === 'Mungon')>

                                                Mungon

                                            </option>

                                            <option value="Me vonese"
                                                @selected($statusi === 'Me vonese')>

                                                Me vonese

                                            </option>

                                            <option value="E arsyetuar"
                                                @selected($statusi === 'E arsyetuar')>

                                                E arsyetuar

                                            </option>

                                        </select>

                                    </td>

                                    {{-- NOTES --}}

                                    <td>

                                        <input
                                            type="text"
                                            name="prezencat[{{ $lojtar->id }}][shenime]"
                                            class="ae-notes"
                                            value="{{ $shenime }}"
                                            placeholder="Shenime..."
                                        >

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                    {{-- INFORMATION --}}

                    <div class="ae-info">

                    <span style="font-size:21px">

                        ℹ️

                    </span>

                        <div>

                            <strong>

                                Informacion per prezencen

                            </strong>

                            <p>

                                Statistikat perditesohen
                                automatikisht kur ndryshon
                                statusin e volejbollisteve.
                                Prezente dhe Me vonese
                                llogariten si pjesemarrje.
                                Ndryshimet ruhen ne databaze
                                vetem pasi te klikosh
                                Ruaj Prezencen.

                            </p>

                        </div>

                    </div>

                    {{-- FORM ACTIONS --}}

                    <div class="ae-actions">

                    <span class="ae-save-status"
                          id="ae-save-status">

                        Kontrollo statuset para ruajtjes.

                    </span>

                        <div class="ae-actions-right">

                            <a href="{{ route(
                            'stervitjet.show',
                            $stervitja
                        ) }}"
                               class="ae-btn ae-btn-gray">

                                Anulo

                            </a>

                            <button type="submit"
                                    class="ae-btn">

                                ✓ Ruaj Prezencen

                            </button>

                        </div>

                    </div>

                </form>

            @endif

        </div>

        <a href="{{ route(
        'stervitjet.index'
    ) }}"
           class="ae-btn ae-btn-light">

            ← Kthehu te Stervitjet

        </a>

    </div>

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const selects = Array.from(
                    document.querySelectorAll(
                        '.ae-status-select'
                    )
                );

                const rows = Array.from(
                    document.querySelectorAll(
                        '.ae-player-row'
                    )
                );

                const notes = Array.from(
                    document.querySelectorAll(
                        '.ae-notes'
                    )
                );

                const markPresent = document.getElementById(
                    'ae-mark-present'
                );

                const resetButton = document.getElementById(
                    'ae-reset'
                );

                const searchInput = document.getElementById(
                    'ae-player-search'
                );

                const saveStatus = document.getElementById(
                    'ae-save-status'
                );

                function normalize(value) {

                    return String(value)
                        .toLowerCase()
                        .trim();

                }

                function updateStatistics() {

                    let present = 0;
                    let absent = 0;
                    let late = 0;
                    let excused = 0;

                    selects.forEach(function (select) {

                        const status = normalize(
                            select.value
                        );

                        select.classList.remove(
                            'ae-present',
                            'ae-absent',
                            'ae-late',
                            'ae-excused'
                        );

                        if (status === 'prezente') {

                            present++;

                            select.classList.add(
                                'ae-present'
                            );

                        } else if (status === 'mungon') {

                            absent++;

                            select.classList.add(
                                'ae-absent'
                            );

                        } else if (
                            status === 'me vonese'
                        ) {

                            late++;

                            select.classList.add(
                                'ae-late'
                            );

                        } else if (
                            status === 'e arsyetuar'
                        ) {

                            excused++;

                            select.classList.add(
                                'ae-excused'
                            );

                        }

                    });

                    const total = selects.length;

                    const percentage = total > 0
                        ? Math.round(
                            ((present + late) / total) * 100
                        )
                        : 0;

                    document.getElementById(
                        'ae-total'
                    ).textContent = total;

                    document.getElementById(
                        'ae-present'
                    ).textContent = present;

                    document.getElementById(
                        'ae-absent'
                    ).textContent = absent;

                    document.getElementById(
                        'ae-late'
                    ).textContent = late;

                    document.getElementById(
                        'ae-excused'
                    ).textContent = excused;

                    document.getElementById(
                        'ae-percent'
                    ).textContent = percentage + '%';

                    document.getElementById(
                        'ae-progress-fill'
                    ).style.width = percentage + '%';

                    document.getElementById(
                        'ae-progress-text'
                    ).textContent =
                        (present + late)
                        + ' nga '
                        + total
                        + ' volejbolliste pjesemarrese';

                }

                function markUnsaved() {

                    if (saveStatus) {

                        saveStatus.textContent =
                            'Ke ndryshime te paruajtura.';

                        saveStatus.style.color =
                            '#d97706';

                    }

                }

                selects.forEach(function (select) {

                    select.addEventListener(
                        'change',
                        function () {

                            updateStatistics();

                            markUnsaved();

                        }
                    );

                });

                notes.forEach(function (input) {

                    input.addEventListener(
                        'input',
                        markUnsaved
                    );

                });

                if (markPresent) {

                    markPresent.addEventListener(
                        'click',
                        function () {

                            selects.forEach(
                                function (select) {

                                    select.value =
                                        'Prezente';

                                }
                            );

                            updateStatistics();

                            markUnsaved();

                        }
                    );

                }

                if (resetButton) {

                    resetButton.addEventListener(
                        'click',
                        function () {

                            selects.forEach(
                                function (select) {

                                    select.value =
                                        select.dataset.original;

                                }
                            );

                            updateStatistics();

                            markUnsaved();

                        }
                    );

                }

                if (searchInput) {

                    searchInput.addEventListener(
                        'input',
                        function () {

                            const search = normalize(
                                searchInput.value
                            );

                            rows.forEach(function (row) {

                                const name = normalize(
                                    row.dataset.name
                                );

                                row.hidden = !name.includes(
                                    search
                                );

                            });

                        }
                    );

                }

                updateStatistics();

            }
        );

    </script>

@endsection
