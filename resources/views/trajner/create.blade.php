@extends('layouts.club')

@section('title', 'Shto Trajner - KV Gjinoci')

@section('content')

    <style>
        .coach-page {
            max-width: 1000px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .coach-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .coach-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .coach-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .coach-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* BUTTONS */

        .coach-btn {
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

        .coach-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .coach-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .coach-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* HERO */

        .coach-hero {
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

        .coach-hero::after {
            content: "🏐";
            position: absolute;
            right: 15px;
            bottom: -45px;
            font-size: 190px;
            opacity: .12;
            pointer-events: none;
        }

        .coach-hero-content {
            position: relative;
            z-index: 1;
        }

        .coach-hero-label {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        .coach-hero h2 {
            color: white !important;
            font-size: 26px;
            margin: 13px 0 9px;
        }

        .coach-hero p {
            color: #dbeafe !important;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
            max-width: 600px;
        }

        /* FORM CARD */

        .coach-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 28px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .coach-card > h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 8px;
        }

        .coach-description {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0 0 27px;
        }

        /* SECTION HEADER */

        .coach-section-header {
            display: flex;
            align-items: center;
            gap: 13px;
            padding-bottom: 18px;
            margin-bottom: 23px;
            border-bottom: 1px solid #e5ebf3;
        }

        .coach-section-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            border-radius: 11px;
            font-size: 23px;
            flex-shrink: 0;
        }

        .coach-section-icon-bank {
            background: #dcfce7;
        }

        .coach-section-header h3 {
            color: #172b4d;
            font-size: 18px;
            margin: 0 0 5px;
        }

        .coach-section-header p {
            color: #64748b;
            font-size: 12px;
            margin: 0;
            line-height: 1.5;
        }

        /* FORM GRID */

        .coach-grid {
            display: grid;
            grid-template-columns: repeat(
            2, minmax(0, 1fr)
        );
            gap: 21px;
        }

        .coach-field {
            min-width: 0;
        }

        .coach-full-width {
            grid-column: 1 / -1;
        }

        .coach-page .coach-field > label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin: 0 0 9px;
        }

        .coach-required {
            color: #dc2626;
        }

        .coach-page .coach-field > input,
        .coach-page .coach-field > select {
            width: 100%;
            min-height: 45px;
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

        .coach-page .coach-field > input:focus,
        .coach-page .coach-field > select:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .coach-page .coach-field > input::placeholder {
            color: #94a3b8;
        }

        /* PHONE COMPONENT */

        .coach-page .kg-phone-group {
            margin: 0;
        }

        .coach-page .kg-phone-label {
            color: #475569;
            font-size: 13px;
        }

        .coach-page .kg-phone-wrapper {
            width: 100%;
        }

        .coach-page .kg-phone-wrapper
        .kg-phone-number {
            min-height: 45px;
            margin: 0;
        }

        /* BANK INFORMATION */

        .coach-bank-section {
            margin-top: 32px;
        }

        .coach-iban-wrap {
            display: flex;
            align-items: stretch;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            overflow: hidden;
            background: #f8fafc;
        }

        .coach-iban-wrap:focus-within {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .coach-iban-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            flex-shrink: 0;
            background: #edf2f7;
            border-right: 1px solid #dbe3ee;
            font-size: 20px;
        }

        .coach-page .coach-iban-wrap input {
            flex: 1;
            width: 100%;
            min-width: 0;
            min-height: 45px;
            padding: 12px 14px;
            border: none;
            margin: 0;
            border-radius: 0;
            background: transparent;
            color: #172b4d;
            font-size: 14px;
            font-family: inherit;
            outline: none;
        }

        .coach-help {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-top: 7px;
            line-height: 1.5;
        }

        .coach-field-error {
            display: block;
            color: #dc2626;
            font-size: 12px;
            margin-top: 7px;
        }

        /* INFORMATION PANEL */

        .coach-info {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            padding: 17px;
            margin-top: 25px;
        }

        .coach-info strong {
            display: block;
            color: #1e40af;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .coach-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
        }

        /* ERRORS */

        .coach-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 16px 19px;
            margin-bottom: 23px;
            font-size: 14px;
        }

        .coach-errors ul {
            margin: 9px 0 0;
            padding-left: 20px;
        }

        /* FORM ACTIONS */

        .coach-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 11px;
            flex-wrap: wrap;
            border-top: 1px solid #e5ebf3;
            margin-top: 25px;
            padding-top: 23px;
        }

        /* RESPONSIVE */

        @media (max-width: 650px) {

            .coach-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .coach-header h1 {
                font-size: 25px;
            }

            .coach-hero {
                padding: 23px;
            }

            .coach-card {
                padding: 19px;
            }

            .coach-grid {
                grid-template-columns: 1fr;
                gap: 17px;
            }

            .coach-section-header h3 {
                font-size: 16px;
            }

            .coach-actions {
                justify-content: stretch;
            }

            .coach-actions .coach-btn {
                flex: 1;
            }

        }
    </style>

    <div class="coach-page">

        {{-- PAGE HEADER --}}

        <div class="coach-header">

            <div>

                <h1>Regjistro Trajner te Ri</h1>

                <p>

                    Shto nje trajner te ri
                    ne stafin profesional
                    te klubit KV Gjinoci.

                </p>

            </div>

            <a href="{{ route('trajner.index') }}"
               class="coach-btn coach-btn-light">

                ← Kthehu te Trajneret

            </a>

        </div>

        {{-- HERO --}}

        <div class="coach-hero">

            <div class="coach-hero-content">

            <span class="coach-hero-label">

                KV GJINOCI COACHING STAFF

            </span>

                <h2>Regjistrimi i Trajnerit</h2>

                <p>

                    Krijo profilin e trajnerit,
                    regjistro informacionet personale,
                    kontaktet dhe te dhenat bankare
                    per menaxhimin e stafit profesional.

                </p>

            </div>

        </div>

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="coach-errors">

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

        <div class="coach-card">

            <h2>Informacionet e Trajnerit</h2>

            <p class="coach-description">

                Ploteso te dhenat per regjistrimin
                e trajnerit ne sistem.

            </p>

            <form method="POST"
                  action="{{ route('trajner.store') }}">

                @csrf

                {{-- PERSONAL INFORMATION --}}

                <div class="coach-section-header">

                    <div class="coach-section-icon">

                        👤

                    </div>

                    <div>

                        <h3>Te Dhenat Personale</h3>

                        <p>

                            Informacionet baze dhe
                            kontaktet e trajnerit.

                        </p>

                    </div>

                </div>

                <div class="coach-grid">

                    {{-- FIRST NAME --}}

                    <div class="coach-field">

                        <label for="emri">

                            Emri

                            <span class="coach-required">
                            *
                        </span>

                        </label>

                        <input type="text"
                               name="emri"
                               id="emri"
                               value="{{ old('emri') }}"
                               placeholder="Shkruaj emrin"
                               required>

                        @error('emri')

                        <small class="coach-field-error">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                    {{-- LAST NAME --}}

                    <div class="coach-field">

                        <label for="mbiemri">

                            Mbiemri

                            <span class="coach-required">
                            *
                        </span>

                        </label>

                        <input type="text"
                               name="mbiemri"
                               id="mbiemri"
                               value="{{ old('mbiemri') }}"
                               placeholder="Shkruaj mbiemrin"
                               required>

                        @error('mbiemri')

                        <small class="coach-field-error">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                    {{-- EMAIL --}}

                    <div class="coach-field">

                        <label for="email">

                            Email

                            <span class="coach-required">
                            *
                        </span>

                        </label>

                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               placeholder="emri@email.com"
                               required>

                        @error('email')

                        <small class="coach-field-error">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                    {{-- DATE OF BIRTH --}}

                    <div class="coach-field">

                        <label for="dataELindjes">

                            Data e Lindjes

                            <span class="coach-required">
                            *
                        </span>

                        </label>

                        <input type="date"
                               name="dataELindjes"
                               id="dataELindjes"
                               value="{{ old('dataELindjes') }}"
                               max="{{ now()->format('Y-m-d') }}"
                               required>

                        @error('dataELindjes')

                        <small class="coach-field-error">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                    {{-- PHONE NUMBER --}}

                    <div class="coach-field">

                        <x-phone-input />

                    </div>

                    {{-- RESIDENCE --}}

                    <div class="coach-field">

                        <label for="vendbanimi">

                            Vendbanimi

                            <span class="coach-required">
                            *
                        </span>

                        </label>

                        <input type="text"
                               name="vendbanimi"
                               id="vendbanimi"
                               value="{{ old('vendbanimi') }}"
                               placeholder="P.sh. Suhareke"
                               required>

                        @error('vendbanimi')

                        <small class="coach-field-error">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                </div>

                {{-- BANK INFORMATION --}}

                <div class="coach-bank-section">

                    <div class="coach-section-header">

                        <div class="coach-section-icon
                                coach-section-icon-bank">

                            💳

                        </div>

                        <div>

                            <h3>Informacionet Bankare</h3>

                            <p>

                                Te dhenat per llogarine
                                bankare te trajnerit.

                            </p>

                        </div>

                    </div>

                    <div class="coach-grid">

                        <div class="coach-field coach-full-width">

                            <label for="IBAN">

                                IBAN

                                <span style="color:#94a3b8;
                                         font-weight:normal">

                                (Opsional)

                            </span>

                            </label>

                            <div class="coach-iban-wrap">

                            <span class="coach-iban-icon">

                                🏦

                            </span>

                                <input type="text"
                                       name="IBAN"
                                       id="IBAN"
                                       value="{{ old('IBAN') }}"
                                       placeholder="Shkruaj IBAN-in"
                                       maxlength="255">

                            </div>

                            <small class="coach-help">

                                Mund ta lesh te zbrazet
                                dhe ta plotesosh me vone.

                            </small>

                            @error('IBAN')

                            <small class="coach-field-error">

                                {{ $message }}

                            </small>

                            @enderror

                        </div>

                    </div>

                </div>

                {{-- INFORMATION --}}

                <div class="coach-info">

                <span style="font-size:21px">

                    ℹ️

                </span>

                    <div>

                        <strong>

                            Informacion per regjistrimin

                        </strong>

                        <p>

                            Fushat me yll (*) jane
                            te obligueshme.
                            Numri i telefonit ruhet
                            me prefiksin +383.
                            IBAN mund te plotesohet
                            edhe pas regjistrimit.

                        </p>

                    </div>

                </div>

                {{-- FORM ACTIONS --}}

                <div class="coach-actions">

                    <a href="{{ route('trajner.index') }}"
                       class="coach-btn coach-btn-gray">

                        Anulo

                    </a>

                    <button type="submit"
                            class="coach-btn">

                        ✓ Ruaj Trajnerin

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
