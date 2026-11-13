@extends('layouts.club')

@section('title', 'Edito Ndeshjen - KV Gjinoci')

@section('content')

    <style>
        .match-edit-page {
            max-width: 1050px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .match-edit-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .me-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .me-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .me-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* BUTTONS */

        .me-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #253858;
            color: white !important;
            padding: 13px 20px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .me-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .me-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .me-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* MATCH HERO */

        .me-hero {
            background: linear-gradient(
                130deg,
                #172b4d,
                #315b89
            );
            border-radius: 18px;
            padding: 28px;
            margin-bottom: 25px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .me-hero::after {
            content: "🏐";
            position: absolute;
            font-size: 200px;
            right: 10px;
            bottom: -50px;
            opacity: .09;
            pointer-events: none;
        }

        .me-hero-content {
            position: relative;
            z-index: 1;
        }

        .me-hero-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .me-hero-label {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        .me-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .me-status-planned {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .me-status-completed {
            background: #dcfce7;
            color: #047857;
        }

        .me-hero h2 {
            font-size: 27px;
            color: white !important;
            margin: 20px 0 12px;
        }

        .me-hero p {
            color: #dbeafe !important;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        .me-match-info {
            display: flex;
            align-items: center;
            gap: 23px;
            flex-wrap: wrap;
            border-top: 1px solid rgba(255,255,255,.18);
            margin-top: 23px;
            padding-top: 19px;
        }

        .me-match-info span {
            color: #dbeafe;
            font-size: 13px;
        }

        /* FORM CARD */

        .me-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .me-card h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 8px;
        }

        .me-description {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0 0 25px;
        }

        /* SECTION HEADER */

        .me-section-header {
            display: flex;
            align-items: center;
            gap: 13px;
            padding-bottom: 18px;
            margin-bottom: 24px;
            border-bottom: 1px solid #e5ebf3;
        }

        .me-section-icon {
            width: 46px;
            height: 46px;
            background: #e8efff;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            flex-shrink: 0;
        }

        .me-section-header h3 {
            font-size: 18px;
            color: #172b4d;
            margin: 0 0 5px;
        }

        .me-section-header p {
            color: #64748b;
            font-size: 12px;
            margin: 0;
        }

        /* FORM GRID */

        .me-fields {
            display: grid;
            grid-template-columns: repeat(
            2, minmax(0, 1fr)
        );
            gap: 20px;
        }

        .me-field-group {
            min-width: 0;
        }

        .me-full-width {
            grid-column: 1 / -1;
        }

        .me-fields > div:not(.me-field-group),
        .me-fields > h2,
        .me-fields > h3,
        .me-fields > h4 {
            grid-column: 1 / -1;
        }

        .me-fields > br {
            display: none;
        }

        /* FORM FIELDS */

        .match-edit-page .me-fields label {
            display: block;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            margin: 0 0 9px;
        }

        .match-edit-page
        .me-fields input:not([type="hidden"])
        :not([type="checkbox"])
        :not([type="radio"]) {
            box-sizing: border-box;
        }

        .match-edit-page
        .me-fields input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]),

        .match-edit-page .me-fields select,

        .match-edit-page .me-fields textarea {
            width: 100%;
            min-height: 45px;
            padding: 12px 14px;
            margin: 0 0 15px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #172b4d;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: .2s;
        }

        .match-edit-page .me-fields input:focus,
        .match-edit-page .me-fields select:focus,
        .match-edit-page .me-fields textarea:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        /* SET RESULTS */

        .me-fields h3 {
            font-size: 19px;
            color: #172b4d;
            margin: 18px 0 17px;
        }

        .me-fields h4 {
            font-size: 16px;
            color: #172b4d;
            margin: 0 0 17px;
        }

        .me-fields .set-row,
        .me-fields .set-box,
        .me-fields .set-card,
        .me-fields .set-block {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 19px;
            margin-bottom: 15px;
        }

        .me-fields .set-row input,
        .me-fields .set-box input,
        .me-fields .set-card input,
        .me-fields .set-block input {
            background: white !important;
        }

        /* INFORMATION PANEL */

        .me-info {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            padding: 17px;
            margin: 0 0 24px;
        }

        .me-info-icon {
            font-size: 21px;
            flex-shrink: 0;
        }

        .me-info strong {
            display: block;
            color: #1e40af;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .me-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* VALIDATION ERRORS */

        .me-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 16px 19px;
            margin-bottom: 23px;
            font-size: 14px;
        }

        .me-errors ul {
            margin: 9px 0 0;
            padding-left: 20px;
        }

        .me-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 23px;
            font-size: 14px;
        }

        /* FORM ACTIONS */

        .me-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 11px;
            flex-wrap: wrap;
            border-top: 1px solid #e5ebf3;
            margin-top: 25px;
            padding-top: 23px;
        }

        .me-actions .me-btn {
            min-height: 44px;
        }

        /* RESPONSIVE */

        @media (max-width: 650px) {

            .me-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .me-header h1 {
                font-size: 25px;
            }

            .me-hero {
                padding: 23px;
            }

            .me-hero h2 {
                font-size: 22px;
            }

            .me-match-info {
                gap: 12px;
            }

            .me-card {
                padding: 19px;
            }

            .me-fields {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .me-actions {
                justify-content: stretch;
            }

            .me-actions .me-btn {
                flex: 1;
            }

        }
    </style>

    @php

        $emriEkipit =
            $ndeshja->ekipi?->emri
            ?? 'Pa ekip';

        $dataNdeshjes = \Carbon\Carbon::parse(
            $ndeshja->data_ndeshjes
        );

        $perfunduar =
            $ndeshja->statusi === 'Perfunduar';

    @endphp

    <div class="match-edit-page">

        {{-- PAGE HEADER --}}

        <div class="me-header">

            <div>

                <h1>Edito Ndeshjen</h1>

                <p>

                    Perditeso informacionet,
                    orarin dhe rezultatet e ndeshjes.

                </p>

            </div>

            <a class="me-btn me-btn-light"
               href="{{ route(
               'ndeshjet.show',
               $ndeshja
           ) }}">

                ← Kthehu te Detajet

            </a>

        </div>

        {{-- MATCH HERO --}}

        <div class="me-hero">

            <div class="me-hero-content">

                <div class="me-hero-top">

                <span class="me-hero-label">

                    KV GJINOCI MATCH MANAGEMENT

                </span>

                    <span class="me-status
                    {{ $perfunduar
                        ? 'me-status-completed'
                        : 'me-status-planned' }}">

                    ● {{ $ndeshja->statusi }}

                </span>

                </div>

                <h2>

                    {{ $emriEkipit }}

                    vs

                    {{ $ndeshja->kundershtari }}

                </h2>

                @if($perfunduar)

                    <p>

                        Rezultati aktual:

                        <strong>

                            {{ $ndeshja->setet_tona }}

                            -

                            {{ $ndeshja->setet_kundershtarit }}

                        </strong>

                    </p>

                @else

                    <p>

                        Ndeshja eshte e planifikuar.
                        Mund te perditesosh orarin ose
                        te regjistrosh rezultatet
                        pas perfundimit.

                    </p>

                @endif

                <div class="me-match-info">

                <span>

                    📅 {{ $dataNdeshjes->format('d.m.Y') }}

                </span>

                    <span>

                    🕒 {{ $dataNdeshjes->format('H:i') }}

                </span>

                    <span>

                    📍 {{ $ndeshja->palestra }}

                </span>

                    <span>

                    🏆 {{ $ndeshja->sezoni?->emri
                        ?? 'Pa sezon' }}

                </span>

                </div>

            </div>

        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="me-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="me-errors">

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

        {{-- MAIN FORM --}}

        <div class="me-card">

            <h2>Perditeso Informacionet</h2>

            <p class="me-description">

                Ndrysho te dhenat ekzistuese
                te ndeshjes dhe ruaj ndryshimet.

            </p>

            <form method="POST"
                  action="{{ route(
                  'ndeshjet.update',
                  $ndeshja
              ) }}">

                @csrf

                @method('PUT')

                {{-- SECTION HEADER --}}

                <div class="me-section-header">

                    <div class="me-section-icon">

                        🏐

                    </div>

                    <div>

                        <h3>Te Dhenat e Ndeshjes</h3>

                        <p>

                            Sezoni, ekipet, orari,
                            palestra dhe statusi.

                        </p>

                    </div>

                </div>

                {{-- INFORMATION --}}

                <div class="me-info">

                <span class="me-info-icon">

                    ℹ️

                </span>

                    <div>

                        <strong>

                            Si te perditesosh ndeshjen?

                        </strong>

                        <p>

                            Nese ndeshja ende nuk eshte
                            zhvilluar, mbaje statusin
                            Planifikuar.
                            Kur ndeshja te perfundoje,
                            zgjedh Perfunduar dhe
                            regjistro rezultatet
                            per secilin set.

                        </p>

                    </div>

                </div>

                {{-- EXISTING FORM --}}

                <div class="me-fields"
                     id="match-edit-fields">

                    @include(
                        'ndeshjet.form',
                        ['ndeshja' => $ndeshja]
                    )

                </div>

                {{-- FORM ACTIONS --}}

                <div class="me-actions">

                    <a href="{{ route(
                       'ndeshjet.show',
                       $ndeshja
                   ) }}"
                       class="me-btn me-btn-gray">

                        Anulo

                    </a>

                    <button type="submit"
                            class="me-btn">

                        ✓ Ruaj Ndryshimet

                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const container = document.getElementById(
                    'match-edit-fields'
                );

                if (!container) return;

                const elements = Array.from(
                    container.children
                );

                elements.forEach(function (element) {

                    if (element.tagName !== 'LABEL') {
                        return;
                    }

                    if (element.parentElement !== container) {
                        return;
                    }

                    let field = element.nextElementSibling;

                    while (
                        field &&
                        field.tagName === 'BR'
                        ) {
                        field = field.nextElementSibling;
                    }

                    if (!field) return;

                    if (
                        !['INPUT', 'SELECT', 'TEXTAREA']
                            .includes(field.tagName)
                    ) {
                        return;
                    }

                    if (field.type === 'hidden') {
                        return;
                    }

                    const group = document.createElement(
                        'div'
                    );

                    group.className = 'me-field-group';

                    container.insertBefore(
                        group,
                        element
                    );

                    group.appendChild(element);
                    group.appendChild(field);

                    if (field.name === 'statusi') {

                        group.classList.add(
                            'me-full-width'
                        );

                    }

                });

                Array.from(container.children)
                    .forEach(function (element) {

                        if (
                            element.tagName === 'DIV' &&
                            !element.classList.contains(
                                'me-field-group'
                            )
                        ) {

                            element.classList.add(
                                'me-full-width'
                            );

                        }

                    });

            }
        );
    </script>

@endsection
