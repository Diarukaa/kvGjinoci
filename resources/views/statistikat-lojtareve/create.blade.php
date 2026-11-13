@extends('layouts.club')

@section('title', 'Statistikat Individuale - KV Gjinoci')

@section('content')

    <style>
        .player-stats-page {
            max-width: 1050px;
            margin: 0 auto;
            padding-bottom: 35px;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .player-stats-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .ps-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .ps-header h1 {
            color: #172b4d;
            font-size: 30px;
            margin: 0 0 8px;
        }

        .ps-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .ps-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 19px;
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

        .ps-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .ps-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .ps-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* MATCH SCOREBOARD */

        .ps-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            color: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .ps-hero::after {
            content: "🏐";
            position: absolute;
            right: -25px;
            bottom: -100px;
            font-size: 300px;
            opacity: .07;
            pointer-events: none;
        }

        .ps-hero-content {
            position: relative;
            z-index: 1;
        }

        .ps-hero-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .ps-hero-label {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        .ps-hero-status {
            display: inline-block;
            background: rgba(255,255,255,.15);
            color: white;
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: bold;
        }

        .ps-scoreboard {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 25px;
            text-align: center;
        }

        .ps-team {
            min-width: 0;
        }

        .ps-team-icon {
            width: 75px;
            height: 75px;
            border-radius: 17px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.2);
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
        }

        .ps-team h2 {
            color: white !important;
            font-size: 22px;
            margin: 0 0 8px;
            overflow-wrap: anywhere;
        }

        .ps-team small {
            color: #bfdbfe;
            font-size: 12px;
        }

        .ps-score-value {
            font-size: 48px;
            font-weight: 800;
            color: white;
            white-space: nowrap;
            line-height: 1;
        }

        .ps-score-caption {
            margin-top: 12px;
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1px;
        }

        .ps-hero-bottom {
            border-top: 1px solid rgba(255,255,255,.2);
            margin-top: 26px;
            padding-top: 20px;
            text-align: center;
            color: #dbeafe;
            font-size: 13px;
            line-height: 1.8;
        }

        /* CARD */

        .ps-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .ps-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            border-bottom: 1px solid #e5ebf3;
            padding-bottom: 22px;
            margin-bottom: 25px;
        }

        .ps-card-title {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .ps-card-icon {
            width: 49px;
            height: 49px;
            background: #e8efff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            flex-shrink: 0;
        }

        .ps-card-header h2 {
            font-size: 21px;
            color: #172b4d;
            margin: 0 0 6px;
        }

        .ps-card-header p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        /* INFO BOX */

        .ps-info {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            padding: 17px;
            margin-bottom: 25px;
        }

        .ps-info strong {
            display: block;
            color: #1e40af;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .ps-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* FORM */

        .ps-form-grid {
            display: grid;
            grid-template-columns: repeat(
            2, minmax(0, 1fr)
        );
            gap: 22px;
        }

        .ps-field {
            min-width: 0;
        }

        .ps-full {
            grid-column: 1 / -1;
        }

        .ps-field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #172b4d;
            margin-bottom: 10px;
        }

        .player-stats-page .ps-input {
            width: 100%;
            min-height: 48px;
            display: block;
            padding: 12px 14px;
            margin: 0;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #172b4d;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: .2s;
        }

        .player-stats-page .ps-input:focus {
            background: white;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .ps-required {
            color: #dc2626;
        }

        .ps-help {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-top: 8px;
            line-height: 1.6;
        }

        .ps-error {
            display: block;
            color: #dc2626;
            font-size: 12px;
            margin-top: 8px;
        }

        /* STAT INPUT CARDS */

        .ps-stat-box {
            background: #f8fafc;
            border: 1px solid #e5ebf3;
            border-radius: 13px;
            padding: 18px;
        }

        .ps-stat-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .ps-stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            flex-shrink: 0;
        }

        .ps-blue {
            background: #e8efff;
        }

        .ps-green {
            background: #dcfce7;
        }

        .ps-purple {
            background: #f1eaff;
        }

        .ps-orange {
            background: #fff1df;
        }

        .ps-stat-top label {
            font-size: 14px;
            margin: 0 0 5px;
        }

        .ps-stat-top small {
            display: block;
            color: #64748b;
            font-size: 11px;
            line-height: 1.5;
        }

        .ps-stat-box .ps-input {
            background: white;
            min-height: 55px;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
        }

        /* TOTAL POINTS */

        .ps-total {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            color: white;
            border-radius: 16px;
            padding: 25px;
            margin-top: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .ps-total-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .ps-total-icon {
            width: 55px;
            height: 55px;
            border-radius: 13px;
            background: rgba(255,255,255,.14);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
        }

        .ps-total h3 {
            color: white !important;
            font-size: 19px;
            margin: 0 0 8px;
        }

        .ps-total p {
            color: #bfdbfe;
            font-size: 12px;
            margin: 0;
            line-height: 1.6;
        }

        .ps-total-number {
            color: white;
            font-size: 44px;
            font-weight: 800;
            line-height: 1;
            min-width: 75px;
            text-align: right;
        }

        /* ACTIONS */

        .ps-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            border-top: 1px solid #e5ebf3;
            padding-top: 23px;
            margin-top: 28px;
        }

        .ps-actions small {
            color: #64748b;
            font-size: 12px;
        }

        .ps-actions-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* EXISTING STATISTICS */

        .ps-table-scroll {
            overflow-x: auto;
        }

        .ps-table {
            width: 100%;
            min-width: 650px;
            border-collapse: collapse;
        }

        .ps-table th {
            background: #253858;
            color: white;
            font-size: 12px;
            text-align: left;
            padding: 15px;
            white-space: nowrap;
        }

        .ps-table th:first-child {
            border-radius: 9px 0 0 0;
        }

        .ps-table th:last-child {
            border-radius: 0 9px 0 0;
        }

        .ps-table td {
            padding: 16px 15px;
            border-bottom: 1px solid #edf0f5;
            color: #172b4d;
            font-size: 13px;
            vertical-align: middle;
        }

        .ps-table tbody tr:hover {
            background: #f8fafc;
        }

        .ps-player {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .ps-avatar {
            width: 39px;
            height: 39px;
            border-radius: 11px;
            background: #e8efff;
            color: #253858;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .ps-player strong {
            display: block;
            margin-bottom: 4px;
        }

        .ps-player small {
            color: #64748b;
            font-size: 11px;
        }

        .ps-points {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            background: #e8efff;
            color: #2563eb;
            padding: 7px 10px;
            border-radius: 7px;
            font-weight: bold;
        }

        .ps-delete {
            background: #fff1f2;
            color: #dc2626 !important;
            border: none;
            border-radius: 7px;
            padding: 9px 12px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .ps-delete:hover {
            background: #ffe4e6;
        }

        .ps-table form {
            margin: 0;
            display: inline;
        }

        /* MESSAGES */

        .ps-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            padding: 17px;
            border-radius: 11px;
            margin-bottom: 23px;
            font-size: 13px;
        }

        .ps-errors ul {
            margin: 10px 0 0;
            padding-left: 20px;
        }

        .ps-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 16px 18px;
            border-radius: 10px;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .ps-empty {
            text-align: center;
            padding: 35px 20px;
        }

        .ps-empty-icon {
            width: 65px;
            height: 65px;
            border-radius: 15px;
            background: #e8efff;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .ps-empty h3 {
            font-size: 18px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .ps-empty p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        /* RESPONSIVE */

        @media (max-width: 650px) {

            .ps-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .ps-header h1 {
                font-size: 25px;
            }

            .ps-hero {
                padding: 22px 16px;
            }

            .ps-scoreboard {
                grid-template-columns:
                minmax(0, 1fr)
                auto
                minmax(0, 1fr);
                gap: 12px;
            }

            .ps-team-icon {
                width: 55px;
                height: 55px;
                font-size: 26px;
                border-radius: 12px;
            }

            .ps-team h2 {
                font-size: 15px;
            }

            .ps-team small {
                font-size: 10px;
            }

            .ps-score-value {
                font-size: 31px;
            }

            .ps-card {
                padding: 20px;
            }

            .ps-form-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .ps-full {
                grid-column: auto;
            }

            .ps-total {
                padding: 18px;
            }

            .ps-total-number {
                font-size: 34px;
                min-width: 40px;
            }

            .ps-total h3 {
                font-size: 16px;
            }

            .ps-total-icon {
                width: 42px;
                height: 42px;
                font-size: 23px;
            }

            .ps-actions-right {
                width: 100%;
            }

            .ps-actions-right .ps-btn {
                flex: 1;
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

        $statistikat = $ndeshja->statistikat;

        $listaLojtareve = $lojtaret
            ?? $volejbollistet
            ?? $ndeshja->ekipi?->lojtaret
            ?? collect();

    @endphp

    <div class="player-stats-page">

        {{-- PAGE HEADER --}}

        <div class="ps-header">

            <div>

                <h1>Statistikat Individuale</h1>

                <p>

                    Regjistro performancen e
                    volejbollisteve per kete ndeshje.

                </p>

            </div>

            <a class="ps-btn ps-btn-light"
               href="{{ route(
               'ndeshjet.show',
               $ndeshja
           ) }}">

                ← Kthehu te Ndeshja

            </a>

        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="ps-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="ps-errors">

                <strong>

                    Kontrollo te dhenat e vendosura:

                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- MATCH SCOREBOARD --}}

        <div class="ps-hero">

            <div class="ps-hero-content">

                <div class="ps-hero-top">

                <span class="ps-hero-label">

                    KV GJINOCI | PLAYER PERFORMANCE

                </span>

                    <span class="ps-hero-status">

                    {{ $ndeshja->statusi }}

                </span>

                </div>

                <div class="ps-scoreboard">

                    <div class="ps-team">

                        <div class="ps-team-icon">

                            🏐

                        </div>

                        <h2>{{ $emriEkipit }}</h2>

                        <small>Klubi yne</small>

                    </div>

                    <div>

                        <div class="ps-score-value">

                            @if($ndeshja->statusi === 'Perfunduar')

                                {{ $ndeshja->setet_tona }}

                                :

                                {{ $ndeshja->setet_kundershtarit }}

                            @else

                                VS

                            @endif

                        </div>

                        <div class="ps-score-caption">

                            {{ $ndeshja->statusi === 'Perfunduar'
                                ? 'REZULTATI FINAL'
                                : 'NDESHJE E ARDHSHME' }}

                        </div>

                    </div>

                    <div class="ps-team">

                        <div class="ps-team-icon">

                            🛡️

                        </div>

                        <h2>{{ $kundershtari }}</h2>

                        <small>Kundershtari</small>

                    </div>

                </div>

                <div class="ps-hero-bottom">

                    📅 {{ $dataNdeshjes->format('d.m.Y') }}

                    &nbsp; • &nbsp;

                    📍 {{ $ndeshja->palestra ?? '-' }}

                    &nbsp; • &nbsp;

                    🏆 {{ $ndeshja->sezoni?->emri
                    ?? 'Pa sezon' }}

                </div>

            </div>

        </div>

        {{-- STATISTICS FORM --}}

        <div class="ps-card">

            <div class="ps-card-header">

                <div class="ps-card-title">

                    <div class="ps-card-icon">

                        📊

                    </div>

                    <div>

                        <h2>Regjistro Statistikat</h2>

                        <p>

                            Zgjedh volejbollisten dhe
                            ploteso statistikat e saj.

                        </p>

                    </div>

                </div>

            </div>

            <div class="ps-info">

            <span style="font-size:22px">

                ℹ️

            </span>

                <div>

                    <strong>

                        Si funksionon llogaritja?

                    </strong>

                    <p>

                        Piket individuale llogariten
                        automatikisht nga Kills,
                        Aces dhe Blocks.

                        Digs regjistrohen si statistike
                        mbrojtese dhe nuk shtohen
                        ne piket individuale.

                    </p>

                </div>

            </div>

            <form method="POST"
                  action="{{ route(
                  'statistikat-lojtareve.store',
                  $ndeshja
              ) }}"
                  id="player-stats-form">

                @csrf

                <div class="ps-form-grid">

                    {{-- SELECT PLAYER --}}

                    <div class="ps-field ps-full">

                        <label for="lojtar_id">

                            Volejbollistja

                            <span class="ps-required">*</span>

                        </label>

                        <select
                            name="lojtar_id"
                            id="lojtar_id"
                            class="ps-input"
                            required
                        >

                            <option value="">

                                Zgjedh volejbollisten

                            </option>

                            @foreach($listaLojtareve as $lojtar)

                                <option
                                    value="{{ $lojtar->id }}"
                                    @selected(
                                        (string) old('lojtar_id')
                                        ===
                                        (string) $lojtar->id
                                    )
                                >

                                    {{ $lojtar->emri }}

                                    {{ $lojtar->mbiemri }}

                                    @if($lojtar->pozicioni)

                                        - {{ $lojtar->pozicioni }}

                                    @endif

                                </option>

                            @endforeach

                        </select>

                        <small class="ps-help">

                            Zgjedh volejbollisten
                            per te cilen deshiron
                            te regjistrosh statistikat.

                        </small>

                        @error('lojtar_id')

                        <span class="ps-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- KILLS --}}

                    <div class="ps-stat-box">

                        <div class="ps-stat-top">

                            <div class="ps-stat-icon ps-blue">

                                🏐

                            </div>

                            <div>

                                <label for="kills">

                                    Kills

                                </label>

                                <small>

                                    Sulme me pike

                                </small>

                            </div>

                        </div>

                        <input
                            type="number"
                            name="kills"
                            id="kills"
                            class="ps-input"
                            min="0"
                            step="1"
                            value="{{ old('kills', 0) }}"
                            required
                        >

                        @error('kills')

                        <span class="ps-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- ACES --}}

                    <div class="ps-stat-box">

                        <div class="ps-stat-top">

                            <div class="ps-stat-icon ps-green">

                                ⚡

                            </div>

                            <div>

                                <label for="aces">

                                    Aces

                                </label>

                                <small>

                                    Servime direkte me pike

                                </small>

                            </div>

                        </div>

                        <input
                            type="number"
                            name="aces"
                            id="aces"
                            class="ps-input"
                            min="0"
                            step="1"
                            value="{{ old('aces', 0) }}"
                            required
                        >

                        @error('aces')

                        <span class="ps-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- BLOCKS --}}

                    <div class="ps-stat-box">

                        <div class="ps-stat-top">

                            <div class="ps-stat-icon ps-purple">

                                🛡️

                            </div>

                            <div>

                                <label for="blocks">

                                    Blocks

                                </label>

                                <small>

                                    Blloqe me pike

                                </small>

                            </div>

                        </div>

                        <input
                            type="number"
                            name="blocks"
                            id="blocks"
                            class="ps-input"
                            min="0"
                            step="1"
                            value="{{ old('blocks', 0) }}"
                            required
                        >

                        @error('blocks')

                        <span class="ps-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- DIGS --}}

                    <div class="ps-stat-box">

                        <div class="ps-stat-top">

                            <div class="ps-stat-icon ps-orange">

                                🤾

                            </div>

                            <div>

                                <label for="digs">

                                    Digs

                                </label>

                                <small>

                                    Mbrojtje te suksesshme

                                </small>

                            </div>

                        </div>

                        <input
                            type="number"
                            name="digs"
                            id="digs"
                            class="ps-input"
                            min="0"
                            step="1"
                            value="{{ old('digs', 0) }}"
                            required
                        >

                        @error('digs')

                        <span class="ps-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                </div>

                {{-- TOTAL POINTS --}}

                <div class="ps-total">

                    <div class="ps-total-info">

                        <div class="ps-total-icon">

                            🏆

                        </div>

                        <div>

                            <h3>Piket Individuale</h3>

                            <p>

                                Kills + Aces + Blocks

                            </p>

                        </div>

                    </div>

                    <div class="ps-total-number"
                         id="total-piket"
                         aria-live="polite">

                        0

                    </div>

                </div>

                {{-- FORM ACTIONS --}}

                <div class="ps-actions">

                    <small>

                        * Fushat e detyrueshme

                    </small>

                    <div class="ps-actions-right">

                        <a class="ps-btn ps-btn-gray"
                           href="{{ route(
                           'ndeshjet.show',
                           $ndeshja
                       ) }}">

                            Anulo

                        </a>

                        <button
                            type="submit"
                            class="ps-btn"
                        >

                            ✓ Ruaj Statistikat

                        </button>

                    </div>

                </div>

            </form>

        </div>

        {{-- EXISTING STATISTICS --}}

        <div class="ps-card">

            <div class="ps-card-header">

                <div class="ps-card-title">

                    <div class="ps-card-icon">

                        📋

                    </div>

                    <div>

                        <h2>Statistikat e Regjistruara</h2>

                        <p>

                            Volejbollistet me statistika
                            te regjistruara ne kete ndeshje.

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

                {{ $statistikat->count() }}

            </span>

            </div>

            @if($statistikat->isNotEmpty())

                <div class="ps-table-scroll">

                    <table class="ps-table">

                        <thead>

                        <tr>

                            <th>Volejbollistja</th>

                            <th>Kills</th>

                            <th>Aces</th>

                            <th>Blocks</th>

                            <th>Digs</th>

                            <th>Pike</th>

                            <th>Veprimet</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($statistikat as $statistika)

                            @php

                                $lojtarStat =
                                    $statistika->lojtar;

                                $emri =
                                    $lojtarStat?->emri ?? '';

                                $mbiemri =
                                    $lojtarStat?->mbiemri ?? '';

                                $inicialet = mb_strtoupper(
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

                                    <div class="ps-player">

                                        <div class="ps-avatar">

                                            {{ $inicialet ?: '?' }}

                                        </div>

                                        <div>

                                            <strong>

                                                {{ $emri }}

                                                {{ $mbiemri }}

                                            </strong>

                                            <small>

                                                {{ $lojtarStat?->pozicioni
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

                                    <span class="ps-points">

                                        {{ $piket }}

                                    </span>

                                </td>

                                <td>

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'statistikat-lojtareve.destroy',
                                            [
                                                $ndeshja,
                                                $statistika
                                            ]
                                        ) }}"
                                        onsubmit="return confirm(
                                            'A je i sigurt qe deshiron t’i fshish keto statistika?'
                                        )"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="ps-delete"
                                        >

                                            Fshi

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="ps-empty">

                    <div class="ps-empty-icon">

                        📊

                    </div>

                    <h3>

                        Nuk ka statistika te regjistruara

                    </h3>

                    <p>

                        Regjistro statistikat e para
                        duke perdorur formularin me lart.

                    </p>

                </div>

            @endif

        </div>

        {{-- BOTTOM ACTIONS --}}

        <a href="{{ route(
        'ndeshjet.show',
        $ndeshja
    ) }}"
           class="ps-btn ps-btn-light">

            ← Kthehu te Detajet e Ndeshjes

        </a>

    </div>

    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const kills = document.getElementById(
                    'kills'
                );

                const aces = document.getElementById(
                    'aces'
                );

                const blocks = document.getElementById(
                    'blocks'
                );

                const totalPiket = document.getElementById(
                    'total-piket'
                );

                function llogaritPiket() {

                    const total =
                        (Number(kills.value) || 0)
                        +
                        (Number(aces.value) || 0)
                        +
                        (Number(blocks.value) || 0);

                    totalPiket.textContent = total;

                }

                kills.addEventListener(
                    'input',
                    llogaritPiket
                );

                aces.addEventListener(
                    'input',
                    llogaritPiket
                );

                blocks.addEventListener(
                    'input',
                    llogaritPiket
                );

                llogaritPiket();

            }
        );
    </script>

@endsection
