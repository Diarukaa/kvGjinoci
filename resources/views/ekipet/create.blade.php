@extends('layouts.club')

@section('title', 'Shto Ekip - KV Gjinoci')

@section('content')

    <style>
        .team-create-page {
            max-width: 1000px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .team-create-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .team-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .team-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .team-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .team-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 20px;
            background: #253858;
            color: white !important;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .team-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .team-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .team-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* HERO */

        .team-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );

            border-radius: 17px;
            padding: 30px;
            color: white;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .team-hero::after {
            content: "🏐";
            position: absolute;
            right: 20px;
            bottom: -45px;
            font-size: 190px;
            opacity: .12;
            pointer-events: none;
        }

        .team-hero-content {
            position: relative;
            z-index: 1;
        }

        .team-hero-label {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        .team-hero h2 {
            color: white !important;
            font-size: 27px;
            margin: 13px 0 10px;
        }

        .team-hero p {
            color: #dbeafe !important;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
            max-width: 600px;
        }

        /* FORM CARD */

        .team-create-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 28px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .team-create-card h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 8px;
        }

        .team-card-description {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0 0 25px;
        }

        /* SECTION HEADER */

        .team-section-header {
            display: flex;
            align-items: center;
            gap: 13px;
            padding-bottom: 18px;
            margin-bottom: 24px;
            border-bottom: 1px solid #e5ebf3;
        }

        .team-section-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #e8efff;
            font-size: 23px;
            flex-shrink: 0;
        }

        .team-section-header h3 {
            font-size: 18px;
            color: #172b4d;
            margin: 0 0 5px;
        }

        .team-section-header p {
            color: #64748b;
            font-size: 12px;
            margin: 0;
            line-height: 1.5;
        }

        /* EXISTING FORM */

        .team-fields {
            display: grid;
            grid-template-columns: repeat(
            2, minmax(0, 1fr)
        );
            gap: 22px;
        }

        .team-field-group {
            min-width: 0;
        }

        .team-fields > .team-field-group:first-child {
            grid-column: 1 / -1;
        }

        .team-fields > div:not(.team-field-group) {
            grid-column: 1 / -1;
        }

        .team-create-page .team-fields label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin: 0 0 9px;
        }

        .team-create-page
        .team-fields input:not([type="hidden"]),

        .team-create-page .team-fields select,

        .team-create-page .team-fields textarea {
            width: 100%;
            min-height: 46px;
            padding: 12px 14px;
            margin: 0 0 15px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #172b4d;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: .2s;
        }

        .team-create-page
        .team-fields input:focus,

        .team-create-page
        .team-fields select:focus {
            background: white;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .team-create-page
        .team-fields input::placeholder {
            color: #94a3b8;
        }

        .team-fields > br {
            display: none;
        }

        /* INFORMATION PANEL */

        .team-info {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 18px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            margin-top: 25px;
        }

        .team-info-icon {
            font-size: 21px;
            flex-shrink: 0;
        }

        .team-info strong {
            display: block;
            font-size: 13px;
            color: #1e40af;
            margin-bottom: 6px;
        }

        .team-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* ERRORS */

        .team-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 16px 19px;
            margin-bottom: 23px;
            font-size: 14px;
        }

        .team-errors ul {
            margin: 9px 0 0;
            padding-left: 20px;
        }

        /* FORM ACTIONS */

        .team-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 11px;
            flex-wrap: wrap;
            margin-top: 25px;
            padding-top: 23px;
            border-top: 1px solid #e5ebf3;
        }

        /* RESPONSIVE */

        @media (max-width: 650px) {

            .team-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .team-header h1 {
                font-size: 25px;
            }

            .team-hero {
                padding: 23px;
            }

            .team-create-card {
                padding: 19px;
            }

            .team-fields {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .team-actions {
                justify-content: stretch;
            }

            .team-actions .team-btn {
                flex: 1;
            }

        }
    </style>

    <div class="team-create-page">

        {{-- PAGE HEADER --}}

        <div class="team-header">

            <div>

                <h1>Shto Ekip te Ri</h1>

                <p>

                    Regjistro nje ekip te ri
                    ne sistemin e klubit KV Gjinoci.

                </p>

            </div>

            <a href="{{ route('ekipet.index') }}"
               class="team-btn team-btn-light">

                ← Kthehu te Ekipet

            </a>

        </div>

        {{-- HERO --}}

        <div class="team-hero">

            <div class="team-hero-content">

            <span class="team-hero-label">

                KV GJINOCI TEAM MANAGEMENT

            </span>

                <h2>Regjistrimi i Ekipit</h2>

                <p>

                    Krijo nje ekip te ri, percakto
                    kategorine sportive dhe cakto
                    trajnerin pergjegjes per ekipin.

                </p>

            </div>

        </div>

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="team-errors">

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

        <div class="team-create-card">

            <h2>Informacionet e Ekipit</h2>

            <p class="team-card-description">

                Ploteso te dhenat per regjistrimin
                e ekipit ne sistem.

            </p>

            <form method="POST"
                  action="{{ route('ekipet.store') }}">

                @csrf

                <div class="team-section-header">

                    <div class="team-section-icon">

                        👥

                    </div>

                    <div>

                        <h3>Te Dhenat e Ekipit</h3>

                        <p>

                            Emri, kategoria dhe
                            trajneri i ekipit.

                        </p>

                    </div>

                </div>

                {{-- EXISTING TEAM FORM --}}

                <div class="team-fields"
                     id="team-create-fields">

                    @include('ekipet.form')

                </div>

                {{-- INFORMATION --}}

                <div class="team-info">

                <span class="team-info-icon">

                    ℹ️

                </span>

                    <div>

                        <strong>

                            Informacion per ekipin

                        </strong>

                        <p>

                            Zgjedh kategorine e ekipit
                            dhe trajnerin pergjegjes.
                            Ekipi mund te regjistrohet
                            edhe pa trajner dhe te
                            perditesohet me vone.
                            Pas regjistrimit mund t'i
                            shtosh volejbollistet ne ekip.

                        </p>

                    </div>

                </div>

                {{-- FORM ACTIONS --}}

                <div class="team-actions">

                    <a href="{{ route('ekipet.index') }}"
                       class="team-btn team-btn-gray">

                        Anulo

                    </a>

                    <button type="submit"
                            class="team-btn">

                        ✓ Ruaj Ekipin

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
                    'team-create-fields'
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

                    group.className = 'team-field-group';

                    container.insertBefore(
                        group,
                        element
                    );

                    group.appendChild(element);
                    group.appendChild(field);

                });

                const nameInput = container.querySelector(
                    'input[name="emri"]'
                );

                if (nameInput) {

                    nameInput.placeholder =
                        'P.sh. KV Gjinoci U18';

                }

            }
        );
    </script>

@endsection
