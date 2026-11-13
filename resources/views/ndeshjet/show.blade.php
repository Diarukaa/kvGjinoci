@extends('layouts.club')

@section('title', 'Detajet e Ndeshjes - KV Gjinoci')

@section('content')

    <style>
        .match-detail-page {
            max-width: 1100px;
            margin: 0 auto;
            padding-bottom: 30px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .match-detail-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .md-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 26px;
        }

        .md-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .md-header p {
            font-size: 14px;
            color: #64748b;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .md-btn {
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

        .md-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .md-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .md-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        .md-btn-green {
            background: #dcfce7;
            color: #047857 !important;
        }

        /* SCOREBOARD */

        .md-scoreboard {
            background: linear-gradient(
                130deg,
                #172b4d,
                #315b89
            );
            border-radius: 20px;
            color: white;
            padding: 30px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .md-scoreboard::after {
            content: "🏐";
            position: absolute;
            font-size: 290px;
            right: -50px;
            bottom: -100px;
            opacity: .06;
            pointer-events: none;
        }

        .md-scoreboard-content {
            position: relative;
            z-index: 1;
        }

        .md-scoreboard-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 35px;
            flex-wrap: wrap;
        }

        .md-scoreboard-label {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        .md-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border-radius: 20px;
            padding: 9px 14px;
            font-size: 12px;
            font-weight: bold;
        }

        .md-status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .md-status-planned {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .md-status-completed {
            background: #dcfce7;
            color: #047857;
        }

        .md-status-other {
            background: #edf2f7;
            color: #475569;
        }

        .md-teams {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 25px;
            text-align: center;
        }

        .md-team {
            min-width: 0;
        }

        .md-team-logo {
            width: 85px;
            height: 85px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            margin: 0 auto 17px;
        }

        .md-team h2 {
            color: white !important;
            font-size: 23px;
            margin: 0 0 8px;
            overflow-wrap: anywhere;
        }

        .md-team small {
            color: #bfdbfe;
            font-size: 12px;
        }

        .md-score {
            min-width: 145px;
        }

        .md-score-number {
            font-size: 58px;
            color: white;
            font-weight: 800;
            line-height: 1;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .md-score-vs {
            font-size: 43px;
            font-weight: 800;
            color: white;
        }

        .md-score-caption {
            color: #bfdbfe;
            font-size: 12px;
            margin-top: 12px;
        }

        .md-scoreboard-bottom {
            border-top: 1px solid rgba(255,255,255,.16);
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
            font-size: 13px;
            color: #dbeafe;
            line-height: 1.8;
        }

        /* INFORMATION CARDS */

        .md-info-grid {
            display: grid;
            grid-template-columns: repeat(
            4, minmax(0, 1fr)
        );
            gap: 16px;
            margin-bottom: 25px;
        }

        .md-info-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .md-info-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 15px;
        }

        .md-icon-purple {
            background: #f1eaff;
        }

        .md-icon-green {
            background: #dcfce7;
        }

        .md-icon-orange {
            background: #fff1df;
        }

        .md-info-card small {
            display: block;
            color: #64748b;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .md-info-card strong {
            display: block;
            color: #172b4d;
            font-size: 17px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        /* CONTENT CARDS */

        .md-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 24px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .md-card h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 8px;
        }

        .md-description {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0 0 23px;
        }

        /* CARD HEADER */

        .md-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .md-card-title {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .md-card-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #e8efff;
            font-size: 24px;
            flex-shrink: 0;
        }

        .md-card-header h2 {
            margin: 0 0 6px;
        }

        .md-card-header p {
            margin: 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        /* RESULT MESSAGE */

        .md-result {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .md-result-win {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .md-result-loss {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
        }

        .md-result-icon {
            font-size: 34px;
            flex-shrink: 0;
        }

        .md-result strong {
            display: block;
            font-size: 17px;
            margin-bottom: 5px;
        }

        .md-result p {
            margin: 0;
            font-size: 13px;
            line-height: 1.6;
            color: inherit;
        }

        /* TABLE */

        .md-table-scroll {
            overflow-x: auto;
        }

        .md-table {
            width: 100%;
            min-width: 550px;
            border-collapse: collapse;
        }

        .md-table th {
            background: #253858;
            color: white;
            padding: 15px 16px;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        .md-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .md-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .md-table td {
            color: #172b4d;
            font-size: 14px;
            padding: 17px 16px;
            border-bottom: 1px solid #edf0f5;
            vertical-align: middle;
        }

        .md-table tbody tr:hover {
            background: #f8fafc;
        }

        .md-set-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 8px;
            background: #e8efff;
            color: #253858;
            font-weight: bold;
        }

        .md-set-points {
            font-size: 19px;
            font-weight: bold;
        }

        .md-set-winner {
            display: inline-block;
            background: #dcfce7;
            color: #047857;
            padding: 7px 11px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: bold;
        }

        .md-set-loser {
            background: #fff1f2;
            color: #be123c;
        }

        /* PLAYER STATISTICS */

        .md-player-summary {
            display: grid;
            grid-template-columns: repeat(
            4, minmax(0, 1fr)
        );
            gap: 14px;
            margin-bottom: 24px;
        }

        .md-player-stat {
            background: #f8fafc;
            border: 1px solid #e5ebf3;
            border-radius: 12px;
            padding: 17px;
        }

        .md-player-stat small {
            display: block;
            color: #64748b;
            font-size: 12px;
            margin-bottom: 12px;
        }

        .md-player-stat strong {
            display: block;
            font-size: 25px;
            color: #172b4d;
        }

        .md-player {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .md-player-avatar {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            color: #253858;
            border-radius: 12px;
            font-size: 13px;
            font-weight: bold;
        }

        .md-player-name {
            display: block;
            color: #172b4d;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .md-player-position {
            display: block;
            color: #64748b;
            font-size: 11px;
        }

        .md-player-points {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            padding: 8px 12px;
            background: #e8efff;
            border-radius: 8px;
            color: #1d4ed8;
            font-size: 14px;
            font-weight: bold;
        }

        .md-stats-empty {
            text-align: center;
            padding: 30px 20px;
        }

        .md-stats-empty-icon {
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            background: #e8efff;
            border-radius: 16px;
            font-size: 30px;
        }

        .md-stats-empty h3 {
            font-size: 18px;
            margin: 0 0 10px;
            color: #172b4d;
        }

        .md-stats-empty p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        .md-stats-note {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 16px;
            background: #f0f5ff;
            border: 1px solid #dbeafe;
            border-radius: 10px;
            font-size: 12px;
            color: #475569;
            line-height: 1.6;
            margin-top: 20px;
        }

        /* PLANNED MATCH */

        .md-pending {
            text-align: center;
            padding: 35px 20px;
        }

        .md-pending-icon {
            width: 80px;
            height: 80px;
            background: #e8efff;
            border-radius: 20px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 37px;
        }

        .md-pending h3 {
            color: #172b4d;
            font-size: 21px;
            margin: 0 0 10px;
        }

        .md-pending p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            margin: 0 auto 23px;
            max-width: 480px;
        }

        /* LEAGUE */

        .md-league {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .md-league-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .md-league-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff1df;
            border-radius: 12px;
            font-size: 25px;
            flex-shrink: 0;
        }

        .md-league h3 {
            color: #172b4d;
            font-size: 17px;
            margin: 0 0 6px;
        }

        .md-league p {
            color: #64748b;
            font-size: 12px;
            margin: 0;
            line-height: 1.6;
        }

        /* ACTIONS */

        .md-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .md-success {
            background: #dcfce7;
            color: #166534;
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #bbf7d0;
        }

        .md-error {
            background: #fff1f2;
            color: #be123c;
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #fecdd3;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {

            .md-info-grid {
                grid-template-columns: repeat(
                2, minmax(0, 1fr)
            );
            }

            .md-player-summary {
                grid-template-columns: repeat(
                2, minmax(0, 1fr)
            );
            }

        }

        @media (max-width: 600px) {

            .md-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .md-header h1 {
                font-size: 25px;
            }

            .md-scoreboard {
                padding: 22px 16px;
            }

            .md-teams {
                grid-template-columns:
                minmax(0, 1fr)
                auto
                minmax(0, 1fr);

                gap: 12px;
            }

            .md-team-logo {
                width: 55px;
                height: 55px;
                font-size: 27px;
                border-radius: 13px;
            }

            .md-team h2 {
                font-size: 15px;
            }

            .md-team small {
                font-size: 10px;
            }

            .md-score {
                min-width: 65px;
            }

            .md-score-number {
                font-size: 34px;
            }

            .md-score-vs {
                font-size: 29px;
            }

            .md-score-caption {
                font-size: 10px;
            }

            .md-info-grid {
                gap: 12px;
            }

            .md-info-card {
                padding: 16px;
            }

            .md-info-card strong {
                font-size: 14px;
            }

            .md-card {
                padding: 18px;
            }

            .md-card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .md-card-header > .md-btn {
                width: 100%;
            }

            .md-player-stat {
                padding: 14px;
            }

            .md-player-stat strong {
                font-size: 21px;
            }

            .md-actions .md-btn {
                flex: 1;
            }

            .md-league > .md-btn {
                width: 100%;
            }

        }
    </style>

    @php

        $emriEkipit =
            $ndeshja->ekipi?->emri
            ?? 'Pa ekip';

        $kundershtari =
            $ndeshja->kundershtari;

        $dataNdeshjes = \Carbon\Carbon::parse(
            $ndeshja->data_ndeshjes
        );

        $perfunduar =
            $ndeshja->statusi === 'Perfunduar';

        $setetTona = (int) $ndeshja->setet_tona;

        $setetKundershtarit =
            (int) $ndeshja->setet_kundershtarit;

        $fitore = $perfunduar
            && $setetTona > $setetKundershtarit;

        $statusClass = match($ndeshja->statusi) {
            'Planifikuar' => 'md-status-planned',
            'Perfunduar' => 'md-status-completed',
            default => 'md-status-other'
        };

        $statistikat = $ndeshja->statistikat;

        $totalKills = $statistikat->sum('kills');

        $totalAces = $statistikat->sum('aces');

        $totalBlocks = $statistikat->sum('blocks');

        $totalPike =
            $totalKills + $totalAces + $totalBlocks;

    @endphp

    <div class="match-detail-page">

        {{-- PAGE HEADER --}}

        <div class="md-header">

            <div>

                <h1>Detajet e Ndeshjes</h1>

                <p>
                    Informacionet, rezultatet dhe
                    statistikat e ndeshjes.
                </p>

            </div>

            <a class="md-btn md-btn-light"
               href="{{ route('ndeshjet.index') }}">

                ← Kthehu te Ndeshjet

            </a>

        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="md-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- ERROR MESSAGE --}}

        @if(session('error'))

            <div class="md-error">

                {{ session('error') }}

            </div>

        @endif

        @if($errors->any())

            <div class="md-error">

                @foreach($errors->all() as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif

        {{-- SCOREBOARD --}}

        <div class="md-scoreboard">

            <div class="md-scoreboard-content">

                <div class="md-scoreboard-top">

                <span class="md-scoreboard-label">

                    KV GJINOCI | MATCH CENTER

                </span>

                    <span class="md-status {{ $statusClass }}">

                    <span class="md-status-dot"></span>

                    {{ $ndeshja->statusi }}

                </span>

                </div>

                <div class="md-teams">

                    {{-- OUR TEAM --}}

                    <div class="md-team">

                        <div class="md-team-logo">

                            🏐

                        </div>

                        <h2>{{ $emriEkipit }}</h2>

                        <small>

                            {{ $ndeshja->lokacioni }}

                        </small>

                    </div>

                    {{-- MATCH SCORE --}}

                    <div class="md-score">

                        @if($perfunduar)

                            <div class="md-score-number">

                                {{ $setetTona }}
                                :
                                {{ $setetKundershtarit }}

                            </div>

                            <div class="md-score-caption">

                                Rezultati Final

                            </div>

                        @else

                            <div class="md-score-vs">

                                VS

                            </div>

                            <div class="md-score-caption">

                                Ndeshje e ardhshme

                            </div>

                        @endif

                    </div>

                    {{-- OPPONENT --}}

                    <div class="md-team">

                        <div class="md-team-logo">

                            🛡️

                        </div>

                        <h2>{{ $kundershtari }}</h2>

                        <small>

                            {{ $ndeshja->lokacioni === 'Vendas'
                                ? 'Mysafir'
                                : 'Vendas' }}

                        </small>

                    </div>

                </div>

                <div class="md-scoreboard-bottom">

                    📅 {{ $dataNdeshjes->format('d.m.Y') }}

                    &nbsp; • &nbsp;

                    🕒 {{ $dataNdeshjes->format('H:i') }}

                    &nbsp; • &nbsp;

                    📍 {{ $ndeshja->palestra ?? '-' }}

                </div>

            </div>

        </div>

        {{-- MATCH INFORMATION --}}

        <div class="md-info-grid">

            <div class="md-info-card">

                <div class="md-info-icon">

                    📅

                </div>

                <small>Data e Ndeshjes</small>

                <strong>

                    {{ $dataNdeshjes->format('d.m.Y') }}

                </strong>

            </div>

            <div class="md-info-card">

                <div class="md-info-icon md-icon-purple">

                    🕒

                </div>

                <small>Ora e Ndeshjes</small>

                <strong>

                    {{ $dataNdeshjes->format('H:i') }}

                </strong>

            </div>

            <div class="md-info-card">

                <div class="md-info-icon md-icon-green">

                    📍

                </div>

                <small>Palestra</small>

                <strong>

                    {{ $ndeshja->palestra ?? '-' }}

                </strong>

            </div>

            <div class="md-info-card">

                <div class="md-info-icon md-icon-orange">

                    🏆

                </div>

                <small>Sezoni</small>

                <strong>

                    {{ $ndeshja->sezoni?->emri
                        ?? 'Pa sezon' }}

                </strong>

            </div>

        </div>

        {{-- COMPLETED MATCH --}}

        @if($perfunduar)

            {{-- MATCH RESULT --}}

            <div class="md-result
            {{ $fitore
                ? 'md-result-win'
                : 'md-result-loss' }}">

            <span class="md-result-icon">

                {{ $fitore ? '🏆' : '📉' }}

            </span>

                <div>

                    <strong>

                        {{ $fitore
                            ? 'Fitore e ' . $emriEkipit . '!'
                            : 'Ndeshje e Humbur' }}

                    </strong>

                    <p>

                        {{ $emriEkipit }}

                        {{ $fitore ? 'fitoi' : 'humbi' }}

                        ndeshjen kunder

                        {{ $kundershtari }}

                        me rezultat

                        {{ $setetTona }}

                        -

                        {{ $setetKundershtarit }}.

                    </p>

                </div>

            </div>

            {{-- SET RESULTS --}}

            <div class="md-card">

                <div class="md-card-header">

                    <div class="md-card-title">

                        <div class="md-card-icon">

                            🏐

                        </div>

                        <div>

                            <h2>Rezultatet e Seteve</h2>

                            <p>
                                Rezultatet e detajuara
                                per secilin set te ndeshjes.
                            </p>

                        </div>

                    </div>

                    <span style="
                    background:#e8efff;
                    color:#2563eb;
                    padding:8px 12px;
                    border-radius:8px;
                    font-size:12px;
                    font-weight:600;
                ">

                    {{ $ndeshja->setet->count() }} Sete

                </span>

                </div>

                <div class="md-table-scroll">

                    <table class="md-table">

                        <thead>

                        <tr>

                            <th>Seti</th>

                            <th>{{ $emriEkipit }}</th>

                            <th>{{ $kundershtari }}</th>

                            <th>Fituesi</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($ndeshja->setet as $seti)

                            <tr>

                                <td>

                                    <span class="md-set-number">

                                        {{ $seti->numri_setit }}

                                    </span>

                                </td>

                                <td>

                                    <span class="md-set-points">

                                        {{ $seti->piket_tona }}

                                    </span>

                                </td>

                                <td>

                                    <span class="md-set-points">

                                        {{ $seti->piket_kundershtarit }}

                                    </span>

                                </td>

                                <td>

                                    @if(
                                        $seti->piket_tona
                                        >
                                        $seti->piket_kundershtarit
                                    )

                                        <span class="md-set-winner">

                                            {{ $emriEkipit }}

                                        </span>

                                    @else

                                        <span class="md-set-winner
                                                     md-set-loser">

                                            {{ $kundershtari }}

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4"
                                    style="
                                        text-align:center;
                                        padding:25px;
                                        color:#64748b;
                                    ">

                                    Nuk ka rezultate te
                                    regjistruara per setet.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- INDIVIDUAL PLAYER STATISTICS --}}

            <div class="md-card">

                {{-- STATISTICS HEADER --}}

                <div class="md-card-header">

                    <div class="md-card-title">

                        <div class="md-card-icon">

                            📊

                        </div>

                        <div>

                            <h2>
                                Statistikat e Volejbollisteve
                            </h2>

                            <p>
                                Performanca individuale
                                ne kete ndeshje.
                            </p>

                        </div>

                    </div>

                    <a class="md-btn"
                       href="{{ route(
                       'statistikat-lojtareve.create',
                       $ndeshja
                   ) }}">

                        ✏️ Menaxho Statistikat

                    </a>

                </div>

                @if($statistikat->isNotEmpty())

                    {{-- PLAYER STATISTICS SUMMARY --}}

                    <div class="md-player-summary">

                        <div class="md-player-stat">

                            <small>

                                Volejbolliste te Evidentuara

                            </small>

                            <strong>

                                {{ $statistikat->count() }}

                            </strong>

                        </div>

                        <div class="md-player-stat">

                            <small>Kills Totale</small>

                            <strong>

                                {{ $totalKills }}

                            </strong>

                        </div>

                        <div class="md-player-stat">

                            <small>Aces Totale</small>

                            <strong>

                                {{ $totalAces }}

                            </strong>

                        </div>

                        <div class="md-player-stat"
                             style="background:#edf4ff">

                            <small>Pike Individuale</small>

                            <strong style="color:#2563eb">

                                {{ $totalPike }}

                            </strong>

                        </div>

                    </div>

                    {{-- PLAYER STATISTICS TABLE --}}

                    <div class="md-table-scroll">

                        <table class="md-table">

                            <thead>

                            <tr>

                                <th>Volejbollistja</th>

                                <th>Kills</th>

                                <th>Aces</th>

                                <th>Blocks</th>

                                <th>Digs</th>

                                <th>Pike</th>

                            </tr>

                            </thead>

                            <tbody>

                            @foreach(
                                $statistikat as $statistika
                            )

                                @php

                                    $lojtar =
                                        $statistika->lojtar;

                                    $emri =
                                        $lojtar?->emri ?? '';

                                    $mbiemri =
                                        $lojtar?->mbiemri ?? '';

                                    $inicialet =
                                        mb_strtoupper(
                                            mb_substr($emri, 0, 1)
                                            .
                                            mb_substr($mbiemri, 0, 1)
                                        );

                                    $piket =
                                        (int) $statistika->kills
                                        +
                                        (int) $statistika->aces
                                        +
                                        (int) $statistika->blocks;

                                @endphp

                                <tr>

                                    <td>

                                        <div class="md-player">

                                            <div class="md-player-avatar">

                                                {{ $inicialet ?: '?' }}

                                            </div>

                                            <div>

                                                <span class="md-player-name">

                                                    {{ $emri }}

                                                    {{ $mbiemri }}

                                                </span>

                                                <small class="md-player-position">

                                                    {{ $lojtar?->pozicioni
                                                        ?? '-' }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        {{ $statistika->kills }}

                                    </td>

                                    <td>

                                        {{ $statistika->aces }}

                                    </td>

                                    <td>

                                        {{ $statistika->blocks }}

                                    </td>

                                    <td>

                                        {{ $statistika->digs }}

                                    </td>

                                    <td>

                                        <span class="md-player-points">

                                            {{ $piket }}

                                        </span>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                    <div class="md-stats-note">

                        <span>ℹ️</span>

                        <span>

                        Piket individuale llogariten nga

                        <strong>
                            Kills + Aces + Blocks.
                        </strong>

                        Digs evidentohen vecmas.

                    </span>

                    </div>

                @else

                    {{-- NO PLAYER STATISTICS --}}

                    <div class="md-stats-empty">

                        <div class="md-stats-empty-icon">

                            📊

                        </div>

                        <h3>

                            Nuk ka statistika te regjistruara

                        </h3>

                        <p>

                            Statistikat individuale te
                            volejbollisteve nuk jane
                            regjistruar ende.

                            Kliko Menaxho Statistikat
                            per t'i regjistruar.

                        </p>

                    </div>

                @endif

            </div>

            {{-- LEAGUE SYNCHRONIZATION --}}

            <div class="md-card">

                <div class="md-league">

                    <div class="md-league-info">

                        <div class="md-league-icon">

                            🏆

                        </div>

                        <div>

                            <h3>Kampionati dhe Klasifikimi</h3>

                            <p>

                                Menaxho lidhjen e ndeshjes
                                me kampionatin dhe
                                klasifikimin e liges.

                            </p>

                        </div>

                    </div>

                    <a class="md-btn md-btn-light"
                       href="{{ url(
                       '/ndeshjet/'
                       . $ndeshja->id
                       . '/lidh-ligen'
                   ) }}">

                        Lidh me Kampionatin

                    </a>

                </div>

            </div>

        @else

            {{-- UPCOMING MATCH --}}

            <div class="md-card">

                <h2>Rezultati i Ndeshjes</h2>

                <p class="md-description">

                    Rezultatet do te regjistrohen
                    pas perfundimit te ndeshjes.

                </p>

                <div class="md-pending">

                    <div class="md-pending-icon">

                        ⏳

                    </div>

                    <h3>

                        Ndeshja ende nuk eshte zhvilluar

                    </h3>

                    <p>

                        Kjo ndeshje eshte planifikuar
                        per daten

                        <strong>

                            {{ $dataNdeshjes->format('d.m.Y') }}

                        </strong>

                        ne oren

                        <strong>

                            {{ $dataNdeshjes->format('H:i') }}.

                        </strong>

                        Rezultatet e seteve mund te
                        regjistrohen pasi ndeshja
                        te perfundoje.

                    </p>

                    <a class="md-btn"
                       href="{{ route(
                       'ndeshjet.edit',
                       $ndeshja
                   ) }}">

                        Edito Ndeshjen

                    </a>

                </div>

            </div>

        @endif

        {{-- PAGE ACTIONS --}}

        <div class="md-actions">

            <a class="md-btn"
               href="{{ route(
               'ndeshjet.edit',
               $ndeshja
           ) }}">

                ✏️ Edito Ndeshjen

            </a>

            <a class="md-btn md-btn-gray"
               href="{{ route('ndeshjet.index') }}">

                ← Kthehu te Ndeshjet

            </a>

            <a class="md-btn md-btn-light"
               href="{{ route('dashboard') }}">

                Dashboard

            </a>

        </div>

    </div>

@endsection
