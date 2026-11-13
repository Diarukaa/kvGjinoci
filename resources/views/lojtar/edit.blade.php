@extends('layouts.club')

@section('title', 'Edito Volejbollisten - KV Gjinoci')

@section('content')

    <style>
        .ep-page {
            max-width: 1000px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .ep-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .ep-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .ep-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .ep-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .ep-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 19px;
            border: none;
            border-radius: 9px;
            background: #253858;
            color: white !important;
            text-decoration: none !important;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .ep-btn:hover {
            transform: translateY(-1px);
            filter: brightness(.95);
        }

        .ep-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .ep-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* PLAYER HERO */

        .ep-hero {
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

        .ep-hero-number {
            position: absolute;
            right: 25px;
            bottom: -65px;
            font-size: 240px;
            font-weight: 900;
            line-height: 1;
            color: rgba(255,255,255,.07);
            pointer-events: none;
        }

        .ep-hero-content {
            display: flex;
            align-items: center;
            gap: 23px;
            position: relative;
            z-index: 1;
        }

        .ep-avatar {
            width: 90px;
            height: 90px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .ep-hero-label {
            display: block;
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .ep-hero h2 {
            color: white !important;
            font-size: 28px;
            margin: 0 0 10px;
        }

        .ep-hero p {
            color: #dbeafe !important;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        .ep-tags {
            display: flex;
            gap: 9px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .ep-tag {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.2);
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        /* FORM CARDS */

        .ep-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .ep-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid #e5ebf3;
            padding-bottom: 22px;
            margin-bottom: 25px;
        }

        .ep-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            flex-shrink: 0;
        }

        .ep-card-header h2 {
            color: #172b4d;
            font-size: 21px;
            margin: 0 0 7px;
        }

        .ep-card-header p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        /* FORM GRID */

        .ep-form-grid {
            display: grid;
            grid-template-columns: repeat(
            2, minmax(0, 1fr)
        );
            gap: 23px;
        }

        .ep-field {
            min-width: 0;
        }

        .ep-full {
            grid-column: 1 / -1;
        }

        .ep-field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #172b4d;
            margin-bottom: 9px;
        }

        .ep-page .ep-input {
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

        .ep-page .ep-input:focus {
            background: white;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .ep-field select {
            cursor: pointer;
        }

        .ep-required {
            color: #dc2626;
        }

        .ep-help {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-top: 8px;
            line-height: 1.6;
        }

        .ep-error {
            display: block;
            color: #dc2626;
            font-size: 12px;
            margin-top: 7px;
        }

        .ep-page .ep-invalid {
            border-color: #dc2626;
            background: #fff7f7;
        }

        /* CURRENT TEAM */

        .ep-team {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
            background: #f8fafc;
            border: 1px solid #e5ebf3;
            border-radius: 12px;
            margin-top: 25px;
        }

        .ep-team-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 47px;
            height: 47px;
            border-radius: 12px;
            background: #e8efff;
            font-size: 24px;
            flex-shrink: 0;
        }

        .ep-team-text {
            flex: 1;
            min-width: 0;
        }

        .ep-team strong {
            display: block;
            color: #172b4d;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .ep-team small {
            color: #64748b;
            font-size: 12px;
        }

        /* INFORMATION */

        .ep-info {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 18px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            margin-top: 25px;
        }

        .ep-info strong {
            display: block;
            color: #1e40af;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .ep-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* FORM ACTIONS */

        .ep-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            border-top: 1px solid #e5ebf3;
            margin-top: 28px;
            padding-top: 22px;
        }

        .ep-actions-right {
            display: flex;
            align-items: center;
            gap: 11px;
            flex-wrap: wrap;
        }

        .ep-actions small {
            font-size: 12px;
            color: #64748b;
        }

        /* ALERTS */

        .ep-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 11px;
            padding: 16px 19px;
            margin-bottom: 23px;
            font-size: 13px;
        }

        .ep-errors ul {
            margin: 10px 0 0;
            padding-left: 20px;
        }

        /* RESPONSIVE */

        @media (max-width: 650px) {

            .ep-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .ep-header h1 {
                font-size: 25px;
            }

            .ep-hero {
                padding: 22px;
            }

            .ep-hero-content {
                gap: 14px;
            }

            .ep-avatar {
                width: 65px;
                height: 65px;
                font-size: 24px;
                border-radius: 15px;
            }

            .ep-hero h2 {
                font-size: 23px;
            }

            .ep-hero-number {
                font-size: 170px;
                right: 5px;
                bottom: -45px;
            }

            .ep-card {
                padding: 20px;
            }

            .ep-form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .ep-full {
                grid-column: auto;
            }

            .ep-actions-right {
                width: 100%;
            }

            .ep-actions-right .ep-btn {
                flex: 1;
            }

        }
    </style>

    @php

        $inicialet = mb_strtoupper(
            mb_substr($lojtar->emri, 0, 1)
            .
            mb_substr($lojtar->mbiemri, 0, 1)
        );

        $dataLindjes = $lojtar->dataELindjes
            ? \Carbon\Carbon::parse(
                $lojtar->dataELindjes
            )->format('Y-m-d')
            : '';

        $ekipiAktual = $lojtar->ekipi;

        $pozicionet = collect([
            'Setter',
            'Outside Hitter',
            'Opposite Hitter',
            'Middle Blocker',
            'Libero'
        ])
        ->merge([$lojtar->pozicioni])
        ->filter()
        ->unique()
        ->values();

    @endphp

    <div class="ep-page">

        {{-- PAGE HEADER --}}

        <div class="ep-header">

            <div>

                <h1>Edito Volejbollisten</h1>

                <p>

                    Perditeso informacionet personale,
                    sportive dhe ekipin e volejbollistes.

                </p>

            </div>

            <a href="{{ route('lojtar.index') }}"
               class="ep-btn ep-btn-light">

                ← Kthehu te Lista

            </a>

        </div>

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="ep-errors">

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

        {{-- PLAYER HERO --}}

        <div class="ep-hero">

            <div class="ep-hero-number">

                #{{ $lojtar->numriFanelles }}

            </div>

            <div class="ep-hero-content">

                <div class="ep-avatar">

                    {{ $inicialet }}

                </div>

                <div>

                <span class="ep-hero-label">

                    KV GJINOCI | EDIT PLAYER

                </span>

                    <h2>

                        {{ $lojtar->emri }}

                        {{ $lojtar->mbiemri }}

                    </h2>

                    <p>

                        Perditesimi i profilit
                        te volejbollistes.

                    </p>

                    <div class="ep-tags">

                    <span class="ep-tag">

                        #{{ $lojtar->numriFanelles }}

                    </span>

                        <span class="ep-tag">

                        🏐 {{ $lojtar->pozicioni }}

                    </span>

                        <span class="ep-tag">

                        {{ $ekipiAktual?->emri
                            ?? 'Pa ekip' }}

                    </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- EDIT FORM --}}

        <form method="POST"
              action="{{ route(
              'lojtar.update',
              $lojtar
          ) }}">

            @csrf

            @method('PUT')

            {{-- PERSONAL INFORMATION --}}

            <div class="ep-card">

                <div class="ep-card-header">

                    <div class="ep-card-icon">

                        👤

                    </div>

                    <div>

                        <h2>Informacionet Personale</h2>

                        <p>

                            Te dhenat baze dhe kontaktet
                            e volejbollistes.

                        </p>

                    </div>

                </div>

                <div class="ep-form-grid">

                    {{-- FIRST NAME --}}

                    <div class="ep-field">

                        <label for="emri">

                            Emri

                            <span class="ep-required">*</span>

                        </label>

                        <input
                            type="text"
                            name="emri"
                            id="emri"
                            class="ep-input @error('emri') ep-invalid @enderror"
                            value="{{ old('emri', $lojtar->emri) }}"
                            placeholder="Sheno emrin"
                            required
                        >

                        @error('emri')

                        <span class="ep-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- LAST NAME --}}

                    <div class="ep-field">

                        <label for="mbiemri">

                            Mbiemri

                            <span class="ep-required">*</span>

                        </label>

                        <input
                            type="text"
                            name="mbiemri"
                            id="mbiemri"
                            class="ep-input @error('mbiemri') ep-invalid @enderror"
                            value="{{ old('mbiemri', $lojtar->mbiemri) }}"
                            placeholder="Sheno mbiemrin"
                            required
                        >

                        @error('mbiemri')

                        <span class="ep-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- EMAIL --}}

                    <div class="ep-field">

                        <label for="email">

                            Email

                            <span class="ep-required">*</span>

                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="ep-input @error('email') ep-invalid @enderror"
                            value="{{ old('email', $lojtar->email) }}"
                            placeholder="email@example.com"
                            required
                        >

                        @error('email')

                        <span class="ep-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- DATE OF BIRTH --}}

                    <div class="ep-field">

                        <label for="dataELindjes">

                            Data e Lindjes

                            <span class="ep-required">*</span>

                        </label>

                        <input
                            type="date"
                            name="dataELindjes"
                            id="dataELindjes"
                            class="ep-input @error('dataELindjes') ep-invalid @enderror"
                            value="{{ old('dataELindjes', $dataLindjes) }}"
                            max="{{ now()->format('Y-m-d') }}"
                            required
                        >

                        @error('dataELindjes')

                        <span class="ep-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- PHONE NUMBER --}}

                    <div class="ep-field">

                        <x-phone-input
                            :value="$lojtar->nrTelefonit ?? ''"
                        />

                    </div>

                    {{-- ADDRESS --}}

                    <div class="ep-field">

                        <label for="vendbanimi">

                            Vendbanimi

                        </label>

                        <input
                            type="text"
                            name="vendbanimi"
                            id="vendbanimi"
                            class="ep-input @error('vendbanimi') ep-invalid @enderror"
                            value="{{ old('vendbanimi', $lojtar->vendbanimi) }}"
                            placeholder="P.sh. Suhareke"
                        >

                        @error('vendbanimi')

                        <span class="ep-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                </div>

            </div>

            {{-- SPORTS INFORMATION --}}

            <div class="ep-card">

                <div class="ep-card-header">

                    <div class="ep-card-icon"
                         style="background:#fff1df">

                        🏐

                    </div>

                    <div>

                        <h2>Informacionet Sportive</h2>

                        <p>

                            Fanella, pozicioni,
                            gjatesia dhe ekipi.

                        </p>

                    </div>

                </div>

                <div class="ep-form-grid">

                    {{-- JERSEY NUMBER --}}

                    <div class="ep-field">

                        <label for="numriFanelles">

                            Numri i Fanelles

                            <span class="ep-required">*</span>

                        </label>

                        <input
                            type="number"
                            name="numriFanelles"
                            id="numriFanelles"
                            class="ep-input @error('numriFanelles') ep-invalid @enderror"
                            value="{{ old('numriFanelles', $lojtar->numriFanelles) }}"
                            placeholder="P.sh. 11"
                            min="1"
                            max="99"
                            required
                        >

                        @error('numriFanelles')

                        <span class="ep-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- POSITION --}}

                    <div class="ep-field">

                        <label for="pozicioni">

                            Pozicioni

                            <span class="ep-required">*</span>

                        </label>

                        <select
                            name="pozicioni"
                            id="pozicioni"
                            class="ep-input @error('pozicioni') ep-invalid @enderror"
                            required
                        >

                            @foreach($pozicionet as $pozicioni)

                                <option
                                    value="{{ $pozicioni }}"
                                    @selected(
                                        old(
                                            'pozicioni',
                                            $lojtar->pozicioni
                                        ) === $pozicioni
                                    )
                                >

                                    {{ $pozicioni }}

                                </option>

                            @endforeach

                        </select>

                        @error('pozicioni')

                        <span class="ep-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- HEIGHT --}}

                    <div class="ep-field">

                        <label for="gjatesia">

                            Gjatesia (cm)

                            <span class="ep-required">*</span>

                        </label>

                        <input
                            type="number"
                            name="gjatesia"
                            id="gjatesia"
                            class="ep-input @error('gjatesia') ep-invalid @enderror"
                            value="{{ old('gjatesia', $lojtar->gjatesia) }}"
                            placeholder="P.sh. 180"
                            min="1"
                            required
                        >

                        @error('gjatesia')

                        <span class="ep-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                    {{-- TEAM --}}

                    <div class="ep-field">

                        <label for="ekipi_id">

                            Ekipi

                        </label>

                        <select
                            name="ekipi_id"
                            id="ekipi_id"
                            class="ep-input @error('ekipi_id') ep-invalid @enderror"
                        >

                            <option value=""
                                @selected(
                                    !old(
                                        'ekipi_id',
                                        $lojtar->ekipi_id
                                    )
                                )>

                                Pa ekip

                            </option>

                            @foreach($ekipet as $ekipi)

                                <option
                                    value="{{ $ekipi->id }}"
                                    @selected(
                                        (string) old(
                                            'ekipi_id',
                                            $lojtar->ekipi_id
                                        ) === (string) $ekipi->id
                                    )
                                >

                                    {{ $ekipi->emri }}

                                    -
                                    {{ $ekipi->kategoria }}

                                </option>

                            @endforeach

                        </select>

                        @error('ekipi_id')

                        <span class="ep-error">

                            {{ $message }}

                        </span>

                        @enderror

                    </div>

                </div>

                {{-- CURRENT TEAM --}}

                <div class="ep-team">

                    <div class="ep-team-icon">

                        🏐

                    </div>

                    <div class="ep-team-text">

                        <strong>

                            {{ $ekipiAktual?->emri
                                ?? 'Pa ekip' }}

                        </strong>

                        <small>

                            Ekipi aktual i volejbollistes

                        </small>

                    </div>

                    @if($ekipiAktual)

                        <a href="{{ route(
                        'ekipet.show',
                        $ekipiAktual
                    ) }}"
                           class="ep-btn ep-btn-light">

                            Shiko Ekipin

                        </a>

                    @endif

                </div>

                {{-- INFORMATION --}}

                <div class="ep-info">

                <span style="font-size:21px">

                    ℹ️

                </span>

                    <div>

                        <strong>

                            Perditesimi i Profilit

                        </strong>

                        <p>

                            Kontrollo informacionet
                            para ruajtjes.

                            Emaili dhe numri i telefonit
                            duhet te jene unik sipas
                            validimit ekzistues te sistemit.

                            Ndryshimi i profilit nuk
                            fshin statistikat ose
                            historikun e prezences.

                        </p>

                    </div>

                </div>

                {{-- FORM ACTIONS --}}

                <div class="ep-actions">

                    <small>

                        * Fushat e detyrueshme

                    </small>

                    <div class="ep-actions-right">

                        <a href="{{ route(
                        'lojtar.show',
                        $lojtar
                    ) }}"
                           class="ep-btn ep-btn-gray">

                            Anulo

                        </a>

                        <button
                            type="submit"
                            class="ep-btn"
                        >

                            ✓ Ruaj Ndryshimet

                        </button>

                    </div>

                </div>

            </div>

        </form>

        <a href="{{ route(
        'lojtar.show',
        $lojtar
    ) }}"
           class="ep-btn ep-btn-light">

            ← Kthehu te Profili

        </a>

    </div>

@endsection
