@extends('layouts.club')

@section('title', 'Edito Trajnerin - KV Gjinoci')

@section('content')

    <style>
        .coach-edit-page {
            max-width: 1000px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .coach-edit-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .ce-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .ce-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .ce-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .ce-btn {
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

        .ce-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .ce-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .ce-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* PROFILE HERO */

        .ce-hero {
            background: linear-gradient(
                130deg,
                #172b4d,
                #315b89
            );
            border-radius: 18px;
            padding: 30px;
            color: white;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .ce-hero::after {
            content: "🏐";
            position: absolute;
            right: 15px;
            bottom: -45px;
            font-size: 200px;
            opacity: .09;
            pointer-events: none;
        }

        .ce-hero-content {
            display: flex;
            align-items: center;
            gap: 23px;
            position: relative;
            z-index: 1;
        }

        .ce-avatar {
            width: 86px;
            height: 86px;
            border-radius: 20px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            color: white;
            flex-shrink: 0;
        }

        .ce-hero-label {
            display: block;
            font-size: 11px;
            font-weight: bold;
            color: #bfdbfe;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .ce-hero h2 {
            color: white !important;
            font-size: 28px;
            margin: 0 0 8px;
        }

        .ce-hero p {
            color: #dbeafe !important;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        .ce-hero-details {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            border-top: 1px solid rgba(255,255,255,.18);
            margin-top: 23px;
            padding-top: 18px;
            position: relative;
            z-index: 1;
        }

        .ce-hero-details span {
            color: #dbeafe;
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        /* FORM CARD */

        .ce-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .ce-card > h2 {
            font-size: 22px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .ce-description {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 27px;
            line-height: 1.6;
        }

        /* SECTION HEADER */

        .ce-section-header {
            display: flex;
            align-items: center;
            gap: 13px;
            padding-bottom: 18px;
            margin-bottom: 23px;
            border-bottom: 1px solid #e5ebf3;
        }

        .ce-section-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: #e8efff;
            border-radius: 11px;
            font-size: 23px;
            flex-shrink: 0;
        }

        .ce-section-icon-bank {
            background: #dcfce7;
        }

        .ce-section-header h3 {
            color: #172b4d;
            font-size: 18px;
            margin: 0 0 5px;
        }

        .ce-section-header p {
            color: #64748b;
            font-size: 12px;
            margin: 0;
            line-height: 1.5;
        }

        /* FORM GRID */

        .ce-grid {
            display: grid;
            grid-template-columns: repeat(
            2, minmax(0, 1fr)
        );
            gap: 21px;
        }

        .ce-field {
            min-width: 0;
        }

        .ce-full-width {
            grid-column: 1 / -1;
        }

        .coach-edit-page .ce-field > label {
            display: block;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            margin: 0 0 9px;
        }

        .ce-required {
            color: #dc2626;
        }

        .coach-edit-page .ce-field > input {
            width: 100%;
            min-height: 45px;
            padding: 12px 14px;
            margin: 0;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #172b4d;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: .2s;
        }

        .coach-edit-page .ce-field > input:focus {
            background: white;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .coach-edit-page .ce-field > input::placeholder {
            color: #94a3b8;
        }

        /* PHONE COMPONENT */

        .coach-edit-page .kg-phone-group {
            margin: 0;
        }

        .coach-edit-page .kg-phone-label {
            color: #475569;
            font-size: 13px;
        }

        .coach-edit-page .kg-phone-wrapper {
            width: 100%;
        }

        .coach-edit-page
        .kg-phone-wrapper .kg-phone-number {
            margin: 0;
            min-height: 45px;
        }

        /* BANK SECTION */

        .ce-bank-section {
            margin-top: 32px;
        }

        .ce-iban-wrap {
            display: flex;
            align-items: stretch;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            overflow: hidden;
            background: #f8fafc;
        }

        .ce-iban-wrap:focus-within {
            background: white;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .ce-iban-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            flex-shrink: 0;
            background: #edf2f7;
            border-right: 1px solid #dbe3ee;
            font-size: 20px;
        }

        .coach-edit-page .ce-iban-wrap input {
            flex: 1;
            min-width: 0;
            width: 100%;
            min-height: 45px;
            padding: 12px 14px;
            margin: 0;
            border: none;
            border-radius: 0;
            background: transparent;
            color: #172b4d;
            font-family: inherit;
            font-size: 14px;
            outline: none;
        }

        .ce-help {
            display: block;
            font-size: 11px;
            color: #64748b;
            margin-top: 7px;
            line-height: 1.6;
        }

        .ce-field-error {
            display: block;
            color: #dc2626;
            font-size: 12px;
            margin-top: 7px;
        }

        /* INFORMATION PANEL */

        .ce-info {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            padding: 17px;
            margin-top: 25px;
        }

        .ce-info strong {
            display: block;
            color: #1e40af;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .ce-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* VALIDATION ERRORS */

        .ce-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 16px 19px;
            margin-bottom: 23px;
            font-size: 14px;
        }

        .ce-errors ul {
            margin: 9px 0 0;
            padding-left: 20px;
        }

        /* FORM ACTIONS */

        .ce-actions {
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

            .ce-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .ce-header h1 {
                font-size: 25px;
            }

            .ce-hero {
                padding: 23px;
            }

            .ce-hero-content {
                gap: 15px;
            }

            .ce-avatar {
                width: 60px;
                height: 60px;
                font-size: 23px;
                border-radius: 13px;
            }

            .ce-hero h2 {
                font-size: 23px;
            }

            .ce-card {
                padding: 19px;
            }

            .ce-grid {
                grid-template-columns: 1fr;
                gap: 17px;
            }

            .ce-actions {
                justify-content: stretch;
            }

            .ce-actions .ce-btn {
                flex: 1;
            }

        }
    </style>

    @php

        $inicialet = mb_strtoupper(
            mb_substr($trajner->emri, 0, 1)
            .
            mb_substr($trajner->mbiemri, 0, 1)
        );

        $dataLindjes = $trajner->dataELindjes
            ? \Carbon\Carbon::parse(
                $trajner->dataELindjes
            )->format('Y-m-d')
            : '';

    @endphp

    <div class="coach-edit-page">

        {{-- PAGE HEADER --}}

        <div class="ce-header">

            <div>

                <h1>Edito Trajnerin</h1>

                <p>

                    Perditeso informacionet personale,
                    kontaktet dhe te dhenat bankare
                    te trajnerit.

                </p>

            </div>

            <a href="{{ route('trajner.index') }}"
               class="ce-btn ce-btn-light">

                ← Kthehu te Trajneret

            </a>

        </div>

        {{-- PROFILE HERO --}}

        <div class="ce-hero">

            <div class="ce-hero-content">

                <div class="ce-avatar">

                    {{ $inicialet }}

                </div>

                <div>

                <span class="ce-hero-label">

                    KV GJINOCI COACHING STAFF

                </span>

                    <h2>

                        {{ $trajner->emri }}

                        {{ $trajner->mbiemri }}

                    </h2>

                    <p>

                        Trajner i regjistruar
                        ne sistemin e klubit.

                    </p>

                </div>

            </div>

            <div class="ce-hero-details">

            <span>

                ✉️ {{ $trajner->email }}

            </span>

                <span>

                📞 {{ $trajner->nrTelefonit }}

            </span>

                <span>

                📍 {{ $trajner->vendbanimi }}

            </span>

            </div>

        </div>

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="ce-errors">

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

        <div class="ce-card">

            <h2>Perditeso Informacionet</h2>

            <p class="ce-description">

                Ndrysho te dhenat ekzistuese
                te trajnerit dhe ruaj ndryshimet.

            </p>

            <form method="POST"
                  action="{{ route(
                  'trajner.update',
                  $trajner
              ) }}">

                @csrf

                @method('PUT')

                {{-- PERSONAL INFORMATION --}}

                <div class="ce-section-header">

                    <div class="ce-section-icon">

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

                <div class="ce-grid">

                    {{-- FIRST NAME --}}

                    <div class="ce-field">

                        <label for="emri">

                            Emri

                            <span class="ce-required">
                            *
                        </span>

                        </label>

                        <input
                            type="text"
                            name="emri"
                            id="emri"
                            value="{{ old('emri', $trajner->emri) }}"
                            placeholder="Shkruaj emrin"
                            required
                        >

                        @error('emri')

                        <small class="ce-field-error">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                    {{-- LAST NAME --}}

                    <div class="ce-field">

                        <label for="mbiemri">

                            Mbiemri

                            <span class="ce-required">
                            *
                        </span>

                        </label>

                        <input
                            type="text"
                            name="mbiemri"
                            id="mbiemri"
                            value="{{ old('mbiemri', $trajner->mbiemri) }}"
                            placeholder="Shkruaj mbiemrin"
                            required
                        >

                        @error('mbiemri')

                        <small class="ce-field-error">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                    {{-- EMAIL --}}

                    <div class="ce-field">

                        <label for="email">

                            Email

                            <span class="ce-required">
                            *
                        </span>

                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email', $trajner->email) }}"
                            placeholder="emri@email.com"
                            required
                        >

                        @error('email')

                        <small class="ce-field-error">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                    {{-- DATE OF BIRTH --}}

                    <div class="ce-field">

                        <label for="dataELindjes">

                            Data e Lindjes

                            <span class="ce-required">
                            *
                        </span>

                        </label>

                        <input
                            type="date"
                            name="dataELindjes"
                            id="dataELindjes"
                            value="{{ old('dataELindjes', $dataLindjes) }}"
                            max="{{ now()->format('Y-m-d') }}"
                            required
                        >

                        @error('dataELindjes')

                        <small class="ce-field-error">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                    {{-- PHONE NUMBER --}}

                    <div class="ce-field">

                        <x-phone-input
                            :value="$trajner->nrTelefonit ?? ''"
                        />

                    </div>

                    {{-- RESIDENCE --}}

                    <div class="ce-field">

                        <label for="vendbanimi">

                            Vendbanimi

                            <span class="ce-required">
                            *
                        </span>

                        </label>

                        <input
                            type="text"
                            name="vendbanimi"
                            id="vendbanimi"
                            value="{{ old('vendbanimi', $trajner->vendbanimi) }}"
                            placeholder="P.sh. Suhareke"
                            required
                        >

                        @error('vendbanimi')

                        <small class="ce-field-error">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                </div>

                {{-- BANK INFORMATION --}}

                <div class="ce-bank-section">

                    <div class="ce-section-header">

                        <div class="ce-section-icon
                                ce-section-icon-bank">

                            💳

                        </div>

                        <div>

                            <h3>Informacionet Bankare</h3>

                            <p>

                                Te dhenat e llogarise
                                bankare te trajnerit.

                            </p>

                        </div>

                    </div>

                    <div class="ce-grid">

                        <div class="ce-field ce-full-width">

                            <label for="IBAN">

                                IBAN

                                <span style="color:#94a3b8;
                                         font-weight:normal">

                                (Opsional)

                            </span>

                            </label>

                            <div class="ce-iban-wrap">

                            <span class="ce-iban-icon">

                                🏦

                            </span>

                                <input
                                    type="text"
                                    name="IBAN"
                                    id="IBAN"
                                    value="{{ old('IBAN', $trajner->IBAN) }}"
                                    placeholder="Shkruaj IBAN-in"
                                    maxlength="255"
                                >

                            </div>

                            <small class="ce-help">

                                IBAN mund te ndryshohet
                                ose te lihet i zbrazet.

                            </small>

                            @error('IBAN')

                            <small class="ce-field-error">

                                {{ $message }}

                            </small>

                            @enderror

                        </div>

                    </div>

                </div>

                {{-- INFORMATION --}}

                <div class="ce-info">

                <span style="font-size:21px">

                    ℹ️

                </span>

                    <div>

                        <strong>

                            Informacion per perditesimin

                        </strong>

                        <p>

                            Fushat me yll (*) jane
                            te obligueshme.
                            Numri i telefonit ruhet
                            me prefiksin +383.
                            Kontrollo informacionet
                            para se t'i ruash ndryshimet.

                        </p>

                    </div>

                </div>

                {{-- FORM ACTIONS --}}

                <div class="ce-actions">

                    <a href="{{ route('trajner.index') }}"
                       class="ce-btn ce-btn-gray">

                        Anulo

                    </a>

                    <button type="submit"
                            class="ce-btn">

                        ✓ Ruaj Ndryshimet

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
