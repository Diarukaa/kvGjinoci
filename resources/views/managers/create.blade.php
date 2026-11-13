@extends('layouts.club')

@section('title', 'Shto Menaxher - KV Gjinoci')

@section('content')

    <style>
        .manager-create-page {
            max-width: 1000px;
            margin: 0 auto;
            padding-bottom: 30px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .manager-create-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .mc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .mc-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .mc-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* BUTTONS */

        .mc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 19px;
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

        .mc-btn:hover {
            transform: translateY(-1px);
            filter: brightness(.94);
        }

        .mc-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .mc-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* HERO */

        .mc-hero {
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

        .mc-hero::after {
            content: "👔";
            position: absolute;
            right: -10px;
            bottom: -80px;
            font-size: 260px;
            opacity: .08;
            pointer-events: none;
        }

        .mc-hero-content {
            display: flex;
            align-items: center;
            gap: 23px;
            position: relative;
            z-index: 1;
        }

        .mc-hero-icon {
            width: 90px;
            height: 90px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 20px;
            font-size: 43px;
        }

        .mc-hero-label {
            display: block;
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .mc-hero h2 {
            color: white !important;
            font-size: 29px;
            margin: 0 0 10px;
        }

        .mc-hero p {
            color: #dbeafe !important;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
            max-width: 600px;
        }

        .mc-tags {
            display: flex;
            gap: 9px;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        .mc-tag {
            display: inline-block;
            color: white;
            font-size: 12px;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.2);
        }

        /* FORM CARD */

        .mc-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .mc-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid #e5ebf3;
            padding-bottom: 22px;
            margin-bottom: 25px;
        }

        .mc-card-icon {
            width: 49px;
            height: 49px;
            border-radius: 12px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 24px;
        }

        .mc-card-header h2 {
            color: #172b4d;
            font-size: 21px;
            margin: 0 0 6px;
        }

        .mc-card-header p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        /* FORM GRID */

        .mc-form-grid {
            display: grid;
            grid-template-columns: repeat(
            2, minmax(0, 1fr)
        );
            gap: 23px;
        }

        .mc-field {
            min-width: 0;
        }

        .mc-full {
            grid-column: 1 / -1;
        }

        .mc-field label {
            display: block;
            color: #172b4d;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .mc-required {
            color: #dc2626;
        }

        .manager-create-page .mc-input {
            display: block;
            width: 100%;
            min-height: 46px;
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

        .manager-create-page .mc-input:focus {
            background: white;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .manager-create-page .mc-invalid {
            border-color: #dc2626;
            background: #fff7f7;
        }

        .mc-help {
            display: block;
            color: #64748b;
            font-size: 11px;
            line-height: 1.6;
            margin-top: 8px;
        }

        .mc-error {
            display: block;
            color: #dc2626;
            font-size: 12px;
            margin-top: 7px;
        }

        /* INFORMATION BOX */

        .mc-info {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            padding: 18px;
            margin-top: 25px;
        }

        .mc-info strong {
            display: block;
            color: #1e40af;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .mc-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* FORM ACTIONS */

        .mc-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 28px;
            padding-top: 23px;
            border-top: 1px solid #e5ebf3;
        }

        .mc-actions-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .mc-actions small {
            color: #64748b;
            font-size: 12px;
        }

        /* VALIDATION ERRORS */

        .mc-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 11px;
            padding: 16px 18px;
            margin-bottom: 23px;
            font-size: 13px;
        }

        .mc-errors ul {
            padding-left: 20px;
            margin: 10px 0 0;
        }

        /* RESPONSIVE */

        @media (max-width: 650px) {

            .mc-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .mc-header h1 {
                font-size: 25px;
            }

            .mc-hero {
                padding: 22px;
            }

            .mc-hero-content {
                gap: 14px;
            }

            .mc-hero-icon {
                width: 65px;
                height: 65px;
                font-size: 30px;
                border-radius: 15px;
            }

            .mc-hero h2 {
                font-size: 23px;
            }

            .mc-card {
                padding: 20px;
            }

            .mc-form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .mc-full {
                grid-column: auto;
            }

            .mc-actions-right {
                width: 100%;
            }

            .mc-actions-right .mc-btn {
                flex: 1;
            }

        }
    </style>

    <div class="manager-create-page">

        {{-- PAGE HEADER --}}

        <div class="mc-header">

            <div>

                <h1>Shto Menaxher te Ri</h1>

                <p>

                    Regjistro nje anetar te ri
                    te stafit administrativ te klubit.

                </p>

            </div>

            <a href="{{ route('managers.index') }}"
               class="mc-btn mc-btn-light">

                ← Kthehu te Menaxheret

            </a>

        </div>

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="mc-errors">

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

        {{-- HERO --}}

        <div class="mc-hero">

            <div class="mc-hero-content">

                <div class="mc-hero-icon">

                    👔

                </div>

                <div>

                <span class="mc-hero-label">

                    KV GJINOCI | STAFF MANAGEMENT

                </span>

                    <h2>

                        Regjistrimi i Menaxherit

                    </h2>

                    <p>

                        Shto nje menaxher te ri
                        ne sistemin e klubit dhe
                        organizo informacionet
                        e stafit administrativ.

                    </p>

                    <div class="mc-tags">

                    <span class="mc-tag">

                        👤 Stafi Administrativ

                    </span>

                        <span class="mc-tag">

                        🏐 KV Gjinoci

                    </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- CREATE FORM --}}

        <div class="mc-card">

            <div class="mc-card-header">

                <div class="mc-card-icon">

                    👤

                </div>

                <div>

                    <h2>Informacionet Personale</h2>

                    <p>

                        Ploteso te dhenat e menaxherit
                        qe deshiron ta regjistrosh.

                    </p>

                </div>

            </div>

            <form method="POST"
                  action="{{ route('managers.store') }}">

                @csrf

                <div class="mc-form-grid">

                    {{-- FIRST NAME --}}

                    <div class="mc-field">

                        <label for="emri">

                            Emri

                            <span class="mc-required">*</span>

                        </label>

                        <input
                            type="text"
                            name="emri"
                            id="emri"
                            class="mc-input @error('emri') mc-invalid @enderror"
                            value="{{ old('emri') }}"
                            placeholder="Sheno emrin"
                            maxlength="255"
                            required
                        >

                        @error('emri')

                        <span class="mc-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- LAST NAME --}}

                    <div class="mc-field">

                        <label for="mbiemri">

                            Mbiemri

                            <span class="mc-required">*</span>

                        </label>

                        <input
                            type="text"
                            name="mbiemri"
                            id="mbiemri"
                            class="mc-input @error('mbiemri') mc-invalid @enderror"
                            value="{{ old('mbiemri') }}"
                            placeholder="Sheno mbiemrin"
                            maxlength="255"
                            required
                        >

                        @error('mbiemri')

                        <span class="mc-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- EMAIL --}}

                    <div class="mc-field">

                        <label for="email">

                            Email

                            <span class="mc-required">*</span>

                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="mc-input @error('email') mc-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="email@example.com"
                            maxlength="255"
                            required
                        >

                        @error('email')

                        <span class="mc-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- DATE OF BIRTH --}}

                    <div class="mc-field">

                        <label for="dataELindjes">

                            Data e Lindjes

                            <span class="mc-required">*</span>

                        </label>

                        <input
                            type="date"
                            name="dataELindjes"
                            id="dataELindjes"
                            class="mc-input @error('dataELindjes') mc-invalid @enderror"
                            value="{{ old('dataELindjes') }}"
                            max="{{ now()->format('Y-m-d') }}"
                            required
                        >

                        @error('dataELindjes')

                        <span class="mc-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- PHONE NUMBER --}}

                    <div class="mc-field">

                        <x-phone-input
                            :value="old('nrTelefonit', '')"
                        />

                    </div>

                    {{-- ADDRESS --}}

                    <div class="mc-field">

                        <label for="vendbanimi">

                            Vendbanimi

                            <span class="mc-required">*</span>

                        </label>

                        <input
                            type="text"
                            name="vendbanimi"
                            id="vendbanimi"
                            class="mc-input @error('vendbanimi') mc-invalid @enderror"
                            value="{{ old('vendbanimi') }}"
                            placeholder="P.sh. Suhareke"
                            maxlength="255"
                            required
                        >

                        @error('vendbanimi')

                        <span class="mc-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                </div>

                {{-- INFORMATION --}}

                <div class="mc-info">

                <span style="font-size:22px">

                    ℹ️

                </span>

                    <div>

                        <strong>

                            Informacion rreth regjistrimit

                        </strong>

                        <p>

                            Kontrollo qe te dhenat
                            e menaxherit jane te sakta.

                            Perdore nje email valid
                            dhe vendose numrin e telefonit
                            me prefiksin +383.

                            Pas ruajtjes, menaxheri
                            do te shfaqet ne listen
                            e stafit administrativ.

                        </p>

                    </div>

                </div>

                {{-- FORM ACTIONS --}}

                <div class="mc-actions">

                    <small>

                        * Fushat e detyrueshme

                    </small>

                    <div class="mc-actions-right">

                        <a href="{{ route('managers.index') }}"
                           class="mc-btn mc-btn-gray">

                            Anulo

                        </a>

                        <button
                            type="submit"
                            class="mc-btn"
                        >

                            ✓ Ruaj Menaxherin

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection
