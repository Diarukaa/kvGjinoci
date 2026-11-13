@extends('layouts.club')

@section('title', 'Shto Ndeshje - KV Gjinoci')

@section('content')

    <style>
        .match-create-page {
            max-width: 1000px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .match-create-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .match-create-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .match-create-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .match-create-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* BUTTONS */

        .match-create-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 19px;
            background: #253858;
            color: white !important;
            text-decoration: none !important;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .match-create-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .match-create-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .match-create-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* HERO */

        .match-create-hero {
            background: linear-gradient(
                130deg,
                #172b4d,
                #315b89
            );
            padding: 28px;
            border-radius: 16px;
            color: white;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .match-create-hero::after {
            content: "🏐";
            position: absolute;
            right: 15px;
            bottom: -45px;
            font-size: 190px;
            opacity: .10;
            pointer-events: none;
        }

        .match-create-hero-content {
            position: relative;
            z-index: 1;
        }

        .match-create-hero-label {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        .match-create-hero h2 {
            font-size: 25px;
            color: white !important;
            margin: 12px 0 9px;
        }

        .match-create-hero p {
            color: #dbeafe !important;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
            max-width: 580px;
        }

        /* FORM CARD */

        .match-create-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .match-create-card h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 8px;
        }

        .match-create-description {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0 0 25px;
        }

        /* FORM FIELDS */

        .match-create-page .match-fields label {
            display: block;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            margin: 0 0 9px;
        }

        .match-create-page .match-fields input:not(
        [type="hidden"]
    ):not(
        [type="checkbox"]
    ):not(
        [type="radio"]
    ),
        .match-create-page .match-fields select,
        .match-create-page .match-fields textarea {
            width: 100%;
            min-height: 44px;
            padding: 12px 14px;
            margin: 0 0 18px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            color: #172b4d;
            background: #f8fafc;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: .2s;
        }

        .match-create-page .match-fields input:focus,
        .match-create-page .match-fields select:focus,
        .match-create-page .match-fields textarea:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .match-create-page .match-fields h3 {
            color: #172b4d;
            font-size: 19px;
            margin: 18px 0 17px;
        }

        .match-create-page .match-fields h4 {
            color: #172b4d;
            font-size: 16px;
            margin: 0 0 17px;
        }

        /* TWO COLUMN FORM */

        .match-create-page .match-fields {
            display: grid;
            grid-template-columns: repeat(
            2, minmax(0, 1fr)
        );
            column-gap: 20px;
        }

        .match-fields > .match-field-group {
            min-width: 0;
        }

        .match-fields > .match-full-width {
            grid-column: 1 / -1;
        }

        .match-fields > h2,
        .match-fields > h3,
        .match-fields > h4,
        .match-fields > script,
        .match-fields > div:not(.match-field-group) {
            grid-column: 1 / -1;
        }

        /* SET RESULTS */

        .match-fields .set-row,
        .match-fields .set-box,
        .match-fields .set-card,
        .match-fields .set-block {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 19px;
            margin-bottom: 15px;
        }

        .match-fields .set-row input,
        .match-fields .set-box input,
        .match-fields .set-card input,
        .match-fields .set-block input {
            background: white !important;
        }

        /* INFO PANEL */

        .match-create-info {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            padding: 17px;
            margin-bottom: 23px;
        }

        .match-create-info-icon {
            font-size: 20px;
            flex-shrink: 0;
        }

        .match-create-info strong {
            display: block;
            color: #1e40af;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .match-create-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
        }

        /* FORM ACTIONS */

        .match-create-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 24px;
            margin-top: 13px;
            border-top: 1px solid #e5ebf3;
        }

        .match-create-actions .match-create-btn {
            min-height: 44px;
        }

        /* VALIDATION ERRORS */

        .match-create-errors {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            padding: 16px 18px;
            border-radius: 10px;
            margin-bottom: 22px;
            font-size: 14px;
        }

        .match-create-errors ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        /* RESPONSIVE */

        @media (max-width: 650px) {

            .match-create-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .match-create-header h1 {
                font-size: 25px;
            }

            .match-create-hero {
                padding: 22px;
            }

            .match-create-card {
                padding: 19px;
            }

            .match-create-page .match-fields {
                grid-template-columns: 1fr;
            }

            .match-create-actions {
                justify-content: stretch;
            }

            .match-create-actions .match-create-btn {
                flex: 1;
            }

        }
    </style>

    <div class="match-create-page">

        {{-- PAGE HEADER --}}

        <div class="match-create-header">

            <div>

                <h1>Shto Ndeshje</h1>

                <p>
                    Regjistro nje ndeshje te re
                    per klubin KV Gjinoci.
                </p>

            </div>

            <a class="match-create-btn match-create-btn-light"
               href="{{ route('ndeshjet.index') }}">

                ← Kthehu te Ndeshjet

            </a>

        </div>

        {{-- HERO --}}

        <div class="match-create-hero">

            <div class="match-create-hero-content">

            <span class="match-create-hero-label">

                KV GJINOCI VOLLEYBALL

            </span>

                <h2>Regjistrimi i Ndeshjes</h2>

                <p>

                    Planifiko ndeshjen e radhes,
                    cakto kundershtarin, ekipin,
                    palestren dhe orarin.
                    Regjistro rezultatet kur
                    ndeshja te perfundoje.

                </p>

            </div>

        </div>

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="match-create-errors">

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

        {{-- FORM CARD --}}

        <div class="match-create-card">

            <h2>Informacionet e Ndeshjes</h2>

            <p class="match-create-description">

                Ploteso informacionet e nevojshme
                per regjistrimin e ndeshjes.

            </p>

            <div class="match-create-info">

            <span class="match-create-info-icon">

                ℹ️

            </span>

                <div>

                    <strong>

                        Si funksionon regjistrimi?

                    </strong>

                    <p>

                        Zgjedh statusin Planifikuar
                        per ndeshjet e ardhshme.
                        Zgjedh Perfunduar per te
                        regjistruar rezultatet e seteve.

                    </p>

                </div>

            </div>

            <form method="POST"
                  action="{{ route('ndeshjet.store') }}">

                @csrf

                {{-- EXISTING MATCH FORM --}}

                <div class="match-fields"
                     id="match-create-fields">

                    @include('ndeshjet.form')

                </div>

                {{-- FORM ACTIONS --}}

                <div class="match-create-actions">

                    <a class="match-create-btn match-create-btn-gray"
                       href="{{ route('ndeshjet.index') }}">

                        Anulo

                    </a>

                    <button type="submit"
                            class="match-create-btn">

                        ✓ Ruaj Ndeshjen

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
                    'match-create-fields'
                );

                if (!container) return;

                /*
                 * Organize existing labels and fields
                 * into two-column groups.
                 * The existing field names and
                 * volleyball set logic stay unchanged.
                 */

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

                    group.className =
                        'match-field-group';

                    container.insertBefore(
                        group,
                        element
                    );

                    group.appendChild(element);
                    group.appendChild(field);

                });

                /*
                 * Keep the existing results area
                 * full width.
                 */

                Array.from(container.children)
                    .forEach(function (element) {

                        if (
                            element.tagName === 'DIV' &&
                            !element.classList.contains(
                                'match-field-group'
                            )
                        ) {

                            element.classList.add(
                                'match-full-width'
                            );

                        }

                    });

            }
        );
    </script>

@endsection
