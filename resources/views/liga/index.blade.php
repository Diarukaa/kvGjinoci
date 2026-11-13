@extends('layouts.club')

@section('title', 'Klasifikimi - ' . $kampionati->emri)

@section('content')

    <style>
        .league-page {
            max-width: 1150px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .league-page * {
            box-sizing: border-box;
        }

        .lg-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
        }

        .lg-header h1 {
            font-size: 30px;
            margin: 0 0 8px;
            color: #172b4d;
        }

        .lg-header p {
            margin: 0;
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
        }

        .lg-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 12px 17px;
            border: none;
            border-radius: 8px;
            background: #253858;
            color: white !important;
            text-decoration: none !important;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .lg-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .lg-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .lg-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        .lg-btn-danger {
            background: #fff1f2;
            color: #dc2626 !important;
        }

        /* CHAMPIONSHIP HERO */

        .lg-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            color: white;
            padding: 30px;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .lg-hero::after {
            content: "🏆";
            position: absolute;
            right: -10px;
            bottom: -80px;
            font-size: 280px;
            opacity: .08;
            pointer-events: none;
        }

        .lg-hero-content {
            display: flex;
            align-items: center;
            gap: 25px;
            position: relative;
            z-index: 1;
        }

        .lg-hero-icon {
            width: 90px;
            height: 90px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 43px;
            flex-shrink: 0;
        }

        .lg-hero-label {
            display: block;
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .lg-hero h2 {
            color: white !important;
            font-size: 31px;
            margin: 0 0 10px;
        }

        .lg-hero p {
            color: #dbeafe !important;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        .lg-tags {
            display: flex;
            gap: 9px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .lg-tag {
            display: inline-block;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 8px;
            padding: 8px 12px;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        /* STATISTICS */

        .lg-stats {
            display: grid;
            grid-template-columns: repeat(
            4, minmax(0, 1fr)
        );
            gap: 16px;
            margin-bottom: 25px;
        }

        .lg-stat {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .lg-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .lg-stat-top span {
            color: #64748b;
            font-size: 12px;
        }

        .lg-stat-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #e8efff;
            font-size: 19px;
            flex-shrink: 0;
        }

        .lg-stat h3 {
            color: #172b4d;
            font-size: 29px;
            margin: 15px 0 5px;
            overflow-wrap: anywhere;
        }

        .lg-stat small {
            color: #64748b;
            font-size: 11px;
            line-height: 1.6;
        }

        /* MAIN CARDS */

        .lg-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 26px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .lg-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 24px;
        }

        .lg-card-title {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .lg-card-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            border-radius: 11px;
            font-size: 24px;
            flex-shrink: 0;
        }

        .lg-card-header h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 6px;
        }

        .lg-card-header p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        .lg-count {
            background: #e8efff;
            color: #2563eb;
            border-radius: 8px;
            padding: 8px 13px;
            font-size: 12px;
            font-weight: bold;
        }

        /* STANDINGS TABLE */

        .lg-table-scroll {
            overflow-x: auto;
        }

        .lg-table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
        }

        .lg-table th {
            background: #253858;
            color: white;
            padding: 15px 12px;
            text-align: center;
            font-size: 12px;
            white-space: nowrap;
        }

        .lg-table th:nth-child(2) {
            text-align: left;
        }

        .lg-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .lg-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .lg-table td {
            padding: 16px 12px;
            border-bottom: 1px solid #e5ebf3;
            color: #172b4d;
            font-size: 13px;
            text-align: center;
            vertical-align: middle;
        }

        .lg-table td:nth-child(2) {
            text-align: left;
        }

        .lg-table tbody tr:hover {
            background: #f8fafc;
        }

        .lg-table .lg-own-club {
            background: #edf4ff;
        }

        .lg-table .lg-own-club td {
            font-weight: 600;
        }

        .lg-rank {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #edf2f7;
            color: #253858;
            font-weight: bold;
        }

        .lg-rank-first {
            background: #fef3c7;
            color: #b45309;
        }

        .lg-club {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .lg-club-avatar {
            width: 39px;
            height: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            border-radius: 10px;
            color: #253858;
            font-size: 13px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .lg-club strong {
            display: block;
            color: #172b4d;
            margin-bottom: 4px;
        }

        .lg-club small {
            color: #64748b;
            font-size: 11px;
        }

        .lg-points {
            display: inline-block;
            min-width: 34px;
            background: #e8efff;
            color: #1d4ed8;
            padding: 8px 10px;
            border-radius: 8px;
            font-weight: bold;
        }

        .lg-green {
            color: #059669 !important;
            font-weight: 600;
        }

        .lg-red {
            color: #dc2626 !important;
            font-weight: 600;
        }

        /* FORM */

        .lg-form-grid {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 21px;
        }

        .lg-field {
            min-width: 0;
        }

        .lg-field label {
            display: block;
            margin-bottom: 9px;
            color: #172b4d;
            font-size: 13px;
            font-weight: 600;
        }

        .league-page .lg-input {
            width: 100%;
            display: block;
            min-height: 45px;
            padding: 11px 13px;
            margin: 0;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #172b4d;
            font-family: inherit;
            font-size: 13px;
            outline: none;
        }

        .league-page .lg-input:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .lg-form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            margin-top: 24px;
            padding-top: 22px;
            border-top: 1px solid #e5ebf3;
        }

        /* INFORMATION */

        .lg-info {
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            padding: 17px;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 13px;
        }

        .lg-info strong {
            color: #1e40af;
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .lg-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* MATCH RESULTS */

        .lg-match {
            background: #f8fafc;
            border: 1px solid #e5ebf3;
            padding: 19px;
            border-radius: 13px;
            margin-bottom: 14px;
        }

        .lg-match-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 17px;
            flex-wrap: wrap;
        }

        .lg-match-date {
            font-size: 12px;
            color: #64748b;
            font-weight: 600;
        }

        .lg-synced {
            display: inline-block;
            background: #dcfce7;
            color: #047857;
            border-radius: 8px;
            padding: 7px 10px;
            font-size: 11px;
            font-weight: bold;
        }

        .lg-manual {
            display: inline-block;
            background: #edf2f7;
            color: #475569;
            padding: 7px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: bold;
        }

        .lg-match-scoreboard {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 20px;
            align-items: center;
            padding: 12px 0 21px;
        }

        .lg-match-team {
            font-size: 15px;
            color: #172b4d;
            font-weight: 600;
            line-height: 1.6;
        }

        .lg-match-team:last-child {
            text-align: right;
        }

        .lg-match-team small {
            display: block;
            font-weight: normal;
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
        }

        .lg-score {
            background: #253858;
            color: white;
            padding: 12px 20px;
            font-size: 23px;
            border-radius: 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .lg-match-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 9px;
            border-top: 1px solid #e5ebf3;
            padding-top: 15px;
            flex-wrap: wrap;
        }

        .lg-match-actions form {
            display: inline-flex;
            padding: 0;
            margin: 0;
        }

        .lg-edit-box {
            margin-top: 17px;
            padding-top: 20px;
            border-top: 1px solid #dbe3ee;
        }

        .lg-edit-box h3 {
            font-size: 17px;
            margin: 0 0 19px;
        }

        /* EMPTY STATE */

        .lg-empty {
            text-align: center;
            padding: 35px 20px;
        }

        .lg-empty-icon {
            width: 75px;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            border-radius: 18px;
            font-size: 33px;
            margin: 0 auto 17px;
        }

        .lg-empty h3 {
            color: #172b4d;
            font-size: 20px;
            margin: 0 0 10px;
        }

        .lg-empty p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        /* ALERTS */

        .lg-success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 23px;
        }

        .lg-errors {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            padding: 16px 18px;
            border-radius: 10px;
            margin-bottom: 23px;
            font-size: 13px;
        }

        .lg-errors ul {
            padding-left: 20px;
            margin: 10px 0 0;
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {

            .lg-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .lg-form-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            .lg-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .lg-header h1 {
                font-size: 25px;
            }

            .lg-hero {
                padding: 22px;
            }

            .lg-hero-content {
                gap: 15px;
            }

            .lg-hero-icon {
                width: 65px;
                height: 65px;
                font-size: 32px;
            }

            .lg-hero h2 {
                font-size: 24px;
            }

            .lg-stat {
                padding: 16px;
            }

            .lg-stat h3 {
                font-size: 23px;
            }

            .lg-card {
                padding: 18px;
            }

            .lg-form-grid {
                grid-template-columns: 1fr;
            }

            .lg-match-scoreboard {
                gap: 10px;
            }

            .lg-match-team {
                font-size: 12px;
            }

            .lg-score {
                font-size: 19px;
                padding: 10px 13px;
            }

            .lg-form-actions {
                flex-wrap: wrap;
            }

            .lg-form-actions .lg-btn {
                flex: 1;
            }

        }
    </style>

    @php

        $listaKlubeve = $klubet->keyBy('id');

        $sezoni = $kampionati->sezoni;

        $totalKlubet = $klubet->count();

        $totalNdeshjet = $ndeshjet->count();

        $totalSetet = $ndeshjet->sum(
            fn($n) =>
            (int) $n->setet_vendas
            +
            (int) $n->setet_mysafir
        );

        $totalSinkronizuara = $ndeshjet
            ->whereNotNull('ndeshja_id')
            ->count();

    @endphp

    <div class="league-page">

        {{-- PAGE HEADER --}}

        <div class="lg-header">

            <div>

                <h1>Klasifikimi dhe Rezultatet</h1>

                <p>

                    Menaxho rezultatet dhe shiko
                    renditjen e klubeve ne kampionat.

                </p>

            </div>

            <a href="{{ route(
            'kampionatet.show',
            $kampionati
        ) }}"
               class="lg-btn lg-btn-light">

                ← Kthehu te Kampionati

            </a>

        </div>

        {{-- SUCCESS AND ERRORS --}}

        @if(session('success'))

            <div class="lg-success">

                {{ session('success') }}

            </div>

        @endif

        @if($errors->any())

            <div class="lg-errors">

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

        {{-- CHAMPIONSHIP HERO --}}

        <div class="lg-hero">

            <div class="lg-hero-content">

                <div class="lg-hero-icon">

                    🏆

                </div>

                <div>

                <span class="lg-hero-label">

                    KV GJINOCI | LEAGUE CENTER

                </span>

                    <h2>{{ $kampionati->emri }}</h2>

                    <p>

                        Klasifikimi zyrtar dhe rezultatet
                        e klubeve pjesemarrese.

                    </p>

                    <div class="lg-tags">

                    <span class="lg-tag">

                        📅 {{ $sezoni?->emri ?? 'Pa sezon' }}

                    </span>

                        <span class="lg-tag">

                        🏐 {{ $kampionati->kategoria }}

                    </span>

                        <span class="lg-tag">

                        {{ $totalKlubet }} Klube

                    </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- STATISTICS --}}

        <div class="lg-stats">

            <div class="lg-stat">

                <div class="lg-stat-top">

                    <span>Klube Pjesemarrese</span>

                    <div class="lg-stat-icon">

                        👥

                    </div>

                </div>

                <h3>{{ $totalKlubet }}</h3>

                <small>

                    Klube ne kampionat

                </small>

            </div>

            <div class="lg-stat">

                <div class="lg-stat-top">

                    <span>Ndeshje</span>

                    <div class="lg-stat-icon"
                         style="background:#dcfce7">

                        🏐

                    </div>

                </div>

                <h3>{{ $totalNdeshjet }}</h3>

                <small>

                    Rezultate te regjistruara

                </small>

            </div>

            <div class="lg-stat">

                <div class="lg-stat-top">

                    <span>Sete Totale</span>

                    <div class="lg-stat-icon"
                         style="background:#fff1df">

                        📊

                    </div>

                </div>

                <h3>{{ $totalSetet }}</h3>

                <small>

                    Sete te luajtura ne kampionat

                </small>

            </div>

            <div class="lg-stat">

                <div class="lg-stat-top">

                    <span>Te Sinkronizuara</span>

                    <div class="lg-stat-icon"
                         style="background:#f1eaff">

                        🔗

                    </div>

                </div>

                <h3>{{ $totalSinkronizuara }}</h3>

                <small>

                    Ndeshje te lidhura me sistemin

                </small>

            </div>

        </div>

        {{-- STANDINGS --}}

        <div class="lg-card">

            <div class="lg-card-header">

                <div class="lg-card-title">

                    <div class="lg-card-icon">

                        🏆

                    </div>

                    <div>

                        <h2>Tabela e Klasifikimit</h2>

                        <p>

                            Renditja e klubeve
                            sipas rezultateve dhe pikeve.

                        </p>

                    </div>

                </div>

                <span class="lg-count">

                {{ $totalKlubet }} Klube

            </span>

            </div>

            <div class="lg-table-scroll">

                <table class="lg-table">

                    <thead>

                    <tr>

                        <th>#</th>

                        <th>Klubi</th>

                        <th>Ndeshje</th>

                        <th>Fitore</th>

                        <th>Humbje</th>

                        <th>Sete +</th>

                        <th>Sete -</th>

                        <th>Dif.</th>

                        <th>Pike</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($renditja as $rreshti)

                        @php

                            $klubiRenditjes = $rreshti['klubi'];

                            $emriKlubit = is_string($klubiRenditjes)
                                ? $klubiRenditjes
                                : data_get(
                                    $klubiRenditjes,
                                    'emri',
                                    '-'
                                );

                            $eshteGjinoci = strcasecmp(
                                trim($emriKlubit),
                                'KV Gjinoci'
                            ) === 0;

                            $diferenca = $rreshti['diferenca']
                                ?? (
                                    $rreshti['setet_fituara']
                                    -
                                    $rreshti['setet_humbura']
                                );

                            $inicialet = collect(
                                explode(' ', trim($emriKlubit))
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

                        <tr class="{{ $eshteGjinoci
                            ? 'lg-own-club'
                            : '' }}">

                            <td>

                                <span class="lg-rank
                                    {{ $loop->first && $totalNdeshjet > 0
                                        ? 'lg-rank-first'
                                        : '' }}">

                                    {{ $loop->iteration }}

                                </span>

                            </td>

                            <td>

                                <div class="lg-club">

                                    <div class="lg-club-avatar">

                                        {{ $inicialet }}

                                    </div>

                                    <div>

                                        <strong>

                                            {{ $emriKlubit }}

                                        </strong>

                                        <small>

                                            {{ $eshteGjinoci
                                                ? 'Klubi yne'
                                                : 'Klub pjesemarres' }}

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>

                                {{ $rreshti['ndeshje'] }}

                            </td>

                            <td class="lg-green">

                                {{ $rreshti['fitore'] }}

                            </td>

                            <td class="lg-red">

                                {{ $rreshti['humbje'] }}

                            </td>

                            <td>

                                {{ $rreshti['setet_fituara'] }}

                            </td>

                            <td>

                                {{ $rreshti['setet_humbura'] }}

                            </td>

                            <td>

                                {{ $diferenca > 0
                                    ? '+' . $diferenca
                                    : $diferenca }}

                            </td>

                            <td>

                                <span class="lg-points">

                                    {{ $rreshti['piket'] }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9">

                                Nuk ka klube per klasifikim.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="lg-info"
                 style="margin-top:20px;margin-bottom:0">

            <span style="font-size:20px">

                ℹ️

            </span>

                <div>

                    <strong>

                        Klasifikimi automatik

                    </strong>

                    <p>

                        Renditja perditesohet sipas
                        rezultateve te regjistruara.
                        KV Gjinoci eshte i dalluar
                        me sfond te kalter ne tabele.

                    </p>

                </div>

            </div>

        </div>

        {{-- REGISTER NEW RESULT --}}

        <div class="lg-card"
             id="regjistro-rezultat">

            <div class="lg-card-header">

                <div class="lg-card-title">

                    <div class="lg-card-icon"
                         style="background:#dcfce7">

                        ＋

                    </div>

                    <div>

                        <h2>Regjistro Rezultat te Ri</h2>

                        <p>

                            Shto rezultatin e nje
                            ndeshjeje te kampionatit.

                        </p>

                    </div>

                </div>

            </div>

            <div class="lg-info">

            <span style="font-size:20px">

                ℹ️

            </span>

                <div>

                    <strong>

                        Regjistrimi i rezultateve

                    </strong>

                    <p>

                        Zgjedh dy klube te ndryshme
                        dhe vendos rezultatin final.
                        Per ndeshjet e KV Gjinocit
                        mund te perdoret edhe
                        sinkronizimi nga moduli Ndeshjet.

                    </p>

                </div>

            </div>

            <form method="POST"
                  action="{{ route(
                  'liga.store',
                  $kampionati
              ) }}">

                @csrf

                <div class="lg-form-grid">

                    {{-- HOME CLUB --}}

                    <div class="lg-field">

                        <label for="klubi_vendas_id">

                            Klubi Vendas

                        </label>

                        <select
                            class="lg-input"
                            name="klubi_vendas_id"
                            id="klubi_vendas_id"
                            required
                        >

                            <option value="">

                                Zgjedh klubin

                            </option>

                            @foreach($klubet as $klubi)

                                <option value="{{ $klubi->id }}"
                                    @selected(
                                        (string) old('klubi_vendas_id')
                                        ===
                                        (string) $klubi->id
                                    )>

                                    {{ $klubi->emri }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- AWAY CLUB --}}

                    <div class="lg-field">

                        <label for="klubi_mysafir_id">

                            Klubi Mysafir

                        </label>

                        <select
                            class="lg-input"
                            name="klubi_mysafir_id"
                            id="klubi_mysafir_id"
                            required
                        >

                            <option value="">

                                Zgjedh klubin

                            </option>

                            @foreach($klubet as $klubi)

                                <option value="{{ $klubi->id }}"
                                    @selected(
                                        (string) old('klubi_mysafir_id')
                                        ===
                                        (string) $klubi->id
                                    )>

                                    {{ $klubi->emri }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- DATE --}}

                    <div class="lg-field">

                        <label for="data_ndeshjes">

                            Data e Ndeshjes

                        </label>

                        <input
                            type="date"
                            class="lg-input"
                            name="data_ndeshjes"
                            id="data_ndeshjes"
                            value="{{ old('data_ndeshjes') }}"
                            required
                        >

                    </div>

                    {{-- HOME SETS --}}

                    <div class="lg-field">

                        <label for="setet_vendas">

                            Setet Vendas

                        </label>

                        <input
                            type="number"
                            class="lg-input"
                            name="setet_vendas"
                            id="setet_vendas"
                            min="0"
                            max="3"
                            value="{{ old('setet_vendas', 0) }}"
                            required
                        >

                    </div>

                    {{-- AWAY SETS --}}

                    <div class="lg-field">

                        <label for="setet_mysafir">

                            Setet Mysafir

                        </label>

                        <input
                            type="number"
                            class="lg-input"
                            name="setet_mysafir"
                            id="setet_mysafir"
                            min="0"
                            max="3"
                            value="{{ old('setet_mysafir', 0) }}"
                            required
                        >

                    </div>

                </div>

                <div class="lg-form-actions">

                    <button type="reset"
                            class="lg-btn lg-btn-gray">

                        Pastro

                    </button>

                    <button type="submit"
                            class="lg-btn">

                        ✓ Ruaj Rezultatin

                    </button>

                </div>

            </form>

        </div>

        {{-- REGISTERED MATCHES --}}

        <div class="lg-card">

            <div class="lg-card-header">

                <div class="lg-card-title">

                    <div class="lg-card-icon">

                        🏐

                    </div>

                    <div>

                        <h2>Rezultatet e Ndeshjeve</h2>

                        <p>

                            Historiku i ndeshjeve
                            te regjistruara ne kampionat.

                        </p>

                    </div>

                </div>

                <span class="lg-count">

                {{ $totalNdeshjet }} Ndeshje

            </span>

            </div>

            @forelse($ndeshjet as $ndeshja)

                @php

                    $vendas = $listaKlubeve
                        ->get($ndeshja->klubi_vendas_id);

                    $mysafir = $listaKlubeve
                        ->get($ndeshja->klubi_mysafir_id);

                    $data = $ndeshja->data_ndeshjes
                        ? \Carbon\Carbon::parse(
                            $ndeshja->data_ndeshjes
                        )->format('d.m.Y')
                        : '-';

                @endphp

                <div class="lg-match">

                    <div class="lg-match-top">

                    <span class="lg-match-date">

                        📅 {{ $data }}

                    </span>

                        @if($ndeshja->ndeshja_id)

                            <span class="lg-synced">

                            ✓ Sinkronizuar

                        </span>

                        @else

                            <span class="lg-manual">

                            Regjistrim Manual

                        </span>

                        @endif

                    </div>

                    {{-- SCOREBOARD --}}

                    <div class="lg-match-scoreboard">

                        <div class="lg-match-team">

                            {{ $vendas?->emri ?? 'Klubi vendas' }}

                            <small>Vendas</small>

                        </div>

                        <div class="lg-score">

                            {{ $ndeshja->setet_vendas }}

                            -

                            {{ $ndeshja->setet_mysafir }}

                        </div>

                        <div class="lg-match-team">

                            {{ $mysafir?->emri ?? 'Klubi mysafir' }}

                            <small>Mysafir</small>

                        </div>

                    </div>

                    {{-- MATCH ACTIONS --}}

                    <div class="lg-match-actions">

                        @if($ndeshja->ndeshja_id)

                            <a class="lg-btn lg-btn-light"
                               href="{{ route(
                               'ndeshjet.show',
                               $ndeshja->ndeshja_id
                           ) }}">

                                Shiko Ndeshjen →

                            </a>

                        @else

                            <button
                                type="button"
                                class="lg-btn lg-btn-gray"
                                onclick="
                                const box = document.getElementById(
                                    'edit-ndeshja-{{ $ndeshja->id }}'
                                );

                                box.hidden = !box.hidden;
                            "
                            >

                                Edito

                            </button>

                            <form method="POST"
                                  action="{{ route(
                                  'liga.destroy',
                                  [
                                      $kampionati,
                                      $ndeshja
                                  ]
                              ) }}"
                                  onsubmit="return confirm('A je i sigurt qe deshiron ta fshish rezultatin?')">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="lg-btn lg-btn-danger"
                                >

                                    Fshi

                                </button>

                            </form>

                        @endif

                    </div>

                    {{-- EDIT MATCH --}}

                    @unless($ndeshja->ndeshja_id)

                        <div class="lg-edit-box"
                             id="edit-ndeshja-{{ $ndeshja->id }}"
                             hidden>

                            <h3>

                                Edito Rezultatin

                            </h3>

                            <form method="POST"
                                  action="{{ route(
                                  'liga.update',
                                  [
                                      $kampionati,
                                      $ndeshja
                                  ]
                              ) }}">

                                @csrf

                                @method('PUT')

                                <div class="lg-form-grid">

                                    <div class="lg-field">

                                        <label>

                                            Klubi Vendas

                                        </label>

                                        <select
                                            name="klubi_vendas_id"
                                            class="lg-input"
                                            required
                                        >

                                            @foreach($klubet as $klubi)

                                                <option
                                                    value="{{ $klubi->id }}"
                                                    @selected(
                                                        $ndeshja->klubi_vendas_id
                                                        == $klubi->id
                                                    )
                                                >

                                                    {{ $klubi->emri }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="lg-field">

                                        <label>

                                            Klubi Mysafir

                                        </label>

                                        <select
                                            name="klubi_mysafir_id"
                                            class="lg-input"
                                            required
                                        >

                                            @foreach($klubet as $klubi)

                                                <option
                                                    value="{{ $klubi->id }}"
                                                    @selected(
                                                        $ndeshja->klubi_mysafir_id
                                                        == $klubi->id
                                                    )
                                                >

                                                    {{ $klubi->emri }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="lg-field">

                                        <label>

                                            Data e Ndeshjes

                                        </label>

                                        <input
                                            type="date"
                                            name="data_ndeshjes"
                                            class="lg-input"
                                            value="{{ $ndeshja->data_ndeshjes
                                            ? \Carbon\Carbon::parse(
                                                $ndeshja->data_ndeshjes
                                            )->format('Y-m-d')
                                            : '' }}"
                                            required
                                        >

                                    </div>

                                    <div class="lg-field">

                                        <label>

                                            Setet Vendas

                                        </label>

                                        <input
                                            type="number"
                                            name="setet_vendas"
                                            class="lg-input"
                                            value="{{ $ndeshja->setet_vendas }}"
                                            min="0"
                                            max="3"
                                            required
                                        >

                                    </div>

                                    <div class="lg-field">

                                        <label>

                                            Setet Mysafir

                                        </label>

                                        <input
                                            type="number"
                                            name="setet_mysafir"
                                            class="lg-input"
                                            value="{{ $ndeshja->setet_mysafir }}"
                                            min="0"
                                            max="3"
                                            required
                                        >

                                    </div>

                                </div>

                                <div class="lg-form-actions">

                                    <button
                                        type="button"
                                        class="lg-btn lg-btn-gray"
                                        onclick="
                                        document.getElementById(
                                            'edit-ndeshja-{{ $ndeshja->id }}'
                                        ).hidden = true;
                                    "
                                    >

                                        Anulo

                                    </button>

                                    <button
                                        type="submit"
                                        class="lg-btn"
                                    >

                                        ✓ Ruaj Ndryshimet

                                    </button>

                                </div>

                            </form>

                        </div>

                    @endunless

                </div>

            @empty

                <div class="lg-empty">

                    <div class="lg-empty-icon">

                        🏐

                    </div>

                    <h3>

                        Nuk ka rezultate te regjistruara

                    </h3>

                    <p>

                        Ky kampionat ende nuk ka
                        rezultate te ndeshjeve.

                        Regjistro rezultatin e pare
                        per te filluar klasifikimin.

                    </p>

                    <a href="#regjistro-rezultat"
                       class="lg-btn lg-btn-light"
                       style="margin-top:20px">

                        + Regjistro Rezultat

                    </a>

                </div>

            @endforelse

        </div>

        {{-- FOOTER ACTIONS --}}

        <div style="
        display:flex;
        gap:10px;
        flex-wrap:wrap;
    ">

            <a href="{{ route(
            'kampionatet.show',
            $kampionati
        ) }}"
               class="lg-btn lg-btn-gray">

                ← Kthehu te Kampionati

            </a>

            <a href="{{ route('kampionatet.index') }}"
               class="lg-btn lg-btn-light">

                Te gjitha Kampionatet

            </a>

        </div>

    </div>

@endsection
