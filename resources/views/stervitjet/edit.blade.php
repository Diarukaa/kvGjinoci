@extends('layouts.club')

@section('title', 'Edito Stervitjen - KV Gjinoci')

@section('content')

    <style>
        .training-edit-page {
            max-width: 1050px;
            margin: 0 auto;
            padding: 10px 0 35px;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .training-edit-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .te-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .te-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .te-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* BUTTONS */

        .te-btn {
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

        .te-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .te-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .te-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* HERO SECTION */

        .te-hero {
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

        .te-hero::after {
            content: "🏐";
            position: absolute;
            right: -20px;
            bottom: -95px;
            font-size: 300px;
            opacity: .07;
            pointer-events: none;
        }

        .te-hero-content {
            position: relative;
            z-index: 1;
        }

        .te-hero-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .te-hero-label {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        /* STATUS */

        .te-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border-radius: 20px;
            padding: 9px 14px;
            font-size: 12px;
            font-weight: 700;
        }

        .te-status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .te-status-completed {
            background: #dcfce7;
            color: #047857;
        }

        .te-status-planned {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .te-status-other {
            background: #fff1df;
            color: #b45309;
        }

        /* TRAINING SUMMARY */

        .te-training {
            display: flex;
            align-items: center;
            gap: 23px;
        }

        .te-training-icon {
            width: 85px;
            height: 85px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 39px;
            flex-shrink: 0;
        }

        .te-training h2 {
            color: white !important;
            font-size: 29px;
            margin: 0 0 9px;
        }

        .te-training p {
            color: #bfdbfe;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        /* INFORMATION GRID */

        .te-info-grid {
            display: grid;
            grid-template-columns: repeat(
            4, minmax(0, 1fr)
        );
            gap: 13px;
            margin-top: 27px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,.2);
        }

        .te-info-item {
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 11px;
            padding: 17px;
        }

        .te-info-item small {
            display: block;
            color: #bfdbfe;
            font-size: 11px;
            margin-bottom: 9px;
        }

        .te-info-item strong {
            display: block;
            color: white;
            font-size: 14px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        /* FORM CARD */

        .te-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .te-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid #e5ebf3;
            padding-bottom: 22px;
            margin-bottom: 25px;
        }

        .te-card-icon {
            width: 49px;
            height: 49px;
            background: #e8efff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .te-card-header h2 {
            font-size: 21px;
            color: #172b4d;
            margin: 0 0 6px;
        }

        .te-card-header p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        /* INFORMATION BOX */

        .te-notice {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 26px;
        }

        .te-notice strong {
            display: block;
            font-size: 13px;
            color: #1e40af;
            margin-bottom: 7px;
        }

        .te-notice p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* EXISTING FORM DESIGN */

        .training-edit-page form {
            margin: 0;
        }

        .training-edit-page form label {
            display: block;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .training-edit-page form input:not([type="hidden"]),
        .training-edit-page form select,
        .training-edit-page form textarea {
            width: 100%;
            min-height: 46px;
            padding: 12px 14px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #172b4d;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: .2s;
        }

        .training-edit-page form input:focus,
        .training-edit-page form select:focus,
        .training-edit-page form textarea:focus {
            background: white;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .training-edit-page form textarea {
            min-height: 130px;
            line-height: 1.7;
            resize: vertical;
        }

        .training-edit-page form .grid,
        .training-edit-page form .form-grid {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 23px;
            margin-bottom: 22px;
        }

        .training-edit-page form .grid > div,
        .training-edit-page form .form-grid > div {
            min-width: 0;
        }

        /* ORIGINAL SAVE BUTTON */

        .training-edit-page form button[type="submit"],
        .training-edit-page form input[type="submit"] {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: auto;
            min-height: 44px;
            background: #253858;
            color: white;
            border: none;
            border-radius: 9px;
            padding: 13px 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 12px;
            transition: .2s;
        }

        .training-edit-page form button[type="submit"]:hover,
        .training-edit-page form input[type="submit"]:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        /* FOOTER */

        .te-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            border-top: 1px solid #e5ebf3;
            padding-top: 22px;
            margin-top: 28px;
        }

        .te-footer small {
            font-size: 12px;
            color: #64748b;
        }

        /* ERRORS */

        .te-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 11px;
            padding: 18px;
            margin-bottom: 23px;
            font-size: 13px;
        }

        .te-errors ul {
            margin: 10px 0 0;
            padding-left: 20px;
        }

        .te-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 11px;
            padding: 17px;
            margin-bottom: 23px;
            font-size: 13px;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {

            .te-info-grid {
                grid-template-columns: repeat(
                2, minmax(0, 1fr)
            );
            }

            .training-edit-page form .grid,
            .training-edit-page form .form-grid {
                grid-template-columns: repeat(
                2, minmax(0, 1fr)
            );
            }

        }

        @media (max-width: 600px) {

            .te-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .te-header h1 {
                font-size: 25px;
            }

            .te-hero {
                padding: 23px;
            }

            .te-training {
                align-items: flex-start;
                gap: 14px;
            }

            .te-training-icon {
                width: 60px;
                height: 60px;
                font-size: 28px;
                border-radius: 13px;
            }

            .te-training h2 {
                font-size: 23px;
            }

            .te-info-grid {
                gap: 10px;
            }

            .te-info-item {
                padding: 13px;
            }

            .te-card {
                padding: 20px;
            }

            .training-edit-page form .grid,
            .training-edit-page form .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .te-footer {
                flex-direction: column;
                align-items: flex-start;
            }

        }
    </style>

    @php

        $emriEkipit =
            $stervitja->ekipi?->emri
            ?? 'Pa ekip';

        $emriTrajnerit =
            $stervitja->trajner
                ? $stervitja->trajner->emri
                    . ' '
                    . $stervitja->trajner->mbiemri
                : 'Pa trajner';

        $dataStervitjes =
            $stervitja->data
                ? \Carbon\Carbon::parse(
                    $stervitja->data
                )->format('d.m.Y')
                : '-';

        $oraFillimit =
            $stervitja->ora_fillimit
                ? substr(
                    $stervitja->ora_fillimit,
                    0,
                    5
                )
                : '--:--';

        $oraMbarimit =
            $stervitja->ora_mbarimit
                ? substr(
                    $stervitja->ora_mbarimit,
                    0,
                    5
                )
                : '--:--';

        $statusClass = match($stervitja->statusi) {

            'Perfunduar' => 'te-status-completed',

            'Planifikuar' => 'te-status-planned',

            default => 'te-status-other'

        };

    @endphp

    <div class="training-edit-page">

        {{-- PAGE HEADER --}}

        <div class="te-header">

            <div>

                <h1>Edito Stervitjen</h1>

                <p>

                    Ndrysho informacionet, orarin
                    dhe statusin e stervitjes.

                </p>

            </div>

            <a href="{{ route(
            'stervitjet.show',
            $stervitja
        ) }}"
               class="te-btn te-btn-light">

                ← Kthehu te Stervitja

            </a>

        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="te-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="te-errors">

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

        {{-- HERO SECTION --}}

        <div class="te-hero">

            <div class="te-hero-content">

                <div class="te-hero-top">

                <span class="te-hero-label">

                    KV GJINOCI | TRAINING CENTER

                </span>

                    <span class="te-status {{ $statusClass }}">

                    <span class="te-status-dot"></span>

                    {{ $stervitja->statusi }}

                </span>

                </div>

                <div class="te-training">

                    <div class="te-training-icon">

                        🏐

                    </div>

                    <div>

                        <h2>{{ $emriEkipit }}</h2>

                        <p>

                            Stervitje

                            •

                            {{ $stervitja->lloji }}

                            •

                            {{ $stervitja->palestra ?? '-' }}

                        </p>

                    </div>

                </div>

                {{-- TRAINING INFORMATION --}}

                <div class="te-info-grid">

                    <div class="te-info-item">

                        <small>

                            📅 Data

                        </small>

                        <strong>

                            {{ $dataStervitjes }}

                        </strong>

                    </div>

                    <div class="te-info-item">

                        <small>

                            🕒 Orari

                        </small>

                        <strong>

                            {{ $oraFillimit }}

                            -

                            {{ $oraMbarimit }}

                        </strong>

                    </div>

                    <div class="te-info-item">

                        <small>

                            👤 Trajneri

                        </small>

                        <strong>

                            {{ $emriTrajnerit }}

                        </strong>

                    </div>

                    <div class="te-info-item">

                        <small>

                            🏆 Sezoni

                        </small>

                        <strong>

                            {{ $stervitja->sezoni?->emri
                                ?? 'Pa sezon' }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

        {{-- TRAINING FORM --}}

        <div class="te-card">

            <div class="te-card-header">

                <div class="te-card-icon">

                    ✏️

                </div>

                <div>

                    <h2>

                        Ndrysho Informacionet

                    </h2>

                    <p>

                        Perditeso te dhenat ekzistuese
                        te stervitjes.

                    </p>

                </div>

            </div>

            {{-- NOTICE --}}

            <div class="te-notice">

            <span style="font-size:22px">

                ℹ️

            </span>

                <div>

                    <strong>

                        Menaxhimi i Stervitjes

                    </strong>

                    <p>

                        Mund ta ndryshosh ekipin,
                        trajnerin, sezonin, daten,
                        orarin dhe pershkrimin.

                        Zgjedh statusin Perfunduar
                        pasi stervitja te perfundoje.

                    </p>

                </div>

            </div>

            {{-- EXISTING FORM --}}

            <form method="POST"
                  action="{{ route(
                  'stervitjet.update',
                  $stervitja
              ) }}">

                @csrf

                @method('PUT')

                @include('stervitjet.form')

            </form>

            {{-- FOOTER --}}

            <div class="te-footer">

                <small>

                    Kontrollo informacionet para
                    ruajtjes se ndryshimeve.

                </small>

                <a href="{{ route(
                'stervitjet.show',
                $stervitja
            ) }}"
                   class="te-btn te-btn-gray">

                    Anulo

                </a>

            </div>

        </div>

        {{-- BOTTOM ACTIONS --}}

        <div style="
        display:flex;
        flex-wrap:wrap;
        gap:10px;
    ">

            <a href="{{ route(
            'stervitjet.show',
            $stervitja
        ) }}"
               class="te-btn">

                Shiko Stervitjen

            </a>

            <a href="{{ route(
            'stervitjet.index'
        ) }}"
               class="te-btn te-btn-gray">

                ← Kthehu te Stervitjet

            </a>

            <a href="{{ route('dashboard') }}"
               class="te-btn te-btn-light">

                Dashboard

            </a>

        </div>

    </div>

@endsection
