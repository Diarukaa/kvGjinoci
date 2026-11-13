@extends('layouts.club')

@section('title', 'Edito Ekipin - KV Gjinoci')

@section('content')

    <style>
        .edit-team-page {
            max-width: 900px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .edit-team-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .et-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .et-header h1 {
            color: #172b4d;
            font-size: 30px;
            margin: 0 0 8px;
        }

        .et-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* BUTTONS */

        .et-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            background: #253858;
            color: white !important;
            padding: 13px 19px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            transition: .2s;
            white-space: nowrap;
        }

        .et-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .et-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .et-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* TEAM HERO */

        .et-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            border-radius: 20px;
            color: white;
            padding: 28px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .et-hero::after {
            content: "🏐";
            position: absolute;
            right: -15px;
            bottom: -80px;
            font-size: 250px;
            opacity: .08;
            pointer-events: none;
        }

        .et-hero-content {
            display: flex;
            align-items: center;
            gap: 22px;
            position: relative;
            z-index: 1;
        }

        .et-team-icon {
            width: 85px;
            height: 85px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            flex-shrink: 0;
        }

        .et-hero-label {
            display: block;
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .et-hero h2 {
            color: white !important;
            font-size: 27px;
            margin: 0 0 10px;
            overflow-wrap: anywhere;
        }

        .et-hero p {
            color: #dbeafe !important;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        .et-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 15px;
        }

        .et-tag {
            display: inline-block;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 7px;
            padding: 7px 11px;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        /* FORM CARD */

        .et-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .et-card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #e5ebf3;
            padding-bottom: 23px;
            margin-bottom: 25px;
        }

        .et-card-icon {
            width: 49px;
            height: 49px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #e8efff;
            font-size: 24px;
            flex-shrink: 0;
        }

        .et-card-header h2 {
            color: #172b4d;
            font-size: 21px;
            margin: 0 0 6px;
        }

        .et-card-header p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        /* FORM GRID */

        .et-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 23px;
        }

        .et-field {
            min-width: 0;
        }

        .et-full {
            grid-column: 1 / -1;
        }

        .et-field label {
            display: block;
            color: #172b4d;
            font-size: 13px;
            font-weight: 600;
            margin: 0 0 9px;
        }

        .et-required {
            color: #dc2626;
        }

        .edit-team-page .et-input {
            display: block;
            width: 100%;
            min-height: 47px;
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

        .edit-team-page .et-input:focus {
            background: white;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .et-field select {
            cursor: pointer;
        }

        .et-help {
            display: block;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.6;
            margin-top: 8px;
        }

        .edit-team-page .et-invalid {
            border-color: #dc2626;
            background: #fff7f7;
        }

        .et-error {
            display: block;
            color: #dc2626;
            font-size: 12px;
            margin-top: 7px;
        }

        /* COACH INFORMATION */

        .et-coach-box {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #f8fafc;
            border: 1px solid #e5ebf3;
            border-radius: 12px;
            padding: 17px;
            margin-top: 25px;
        }

        .et-coach-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #e8efff;
            color: #253858;
            font-weight: bold;
            font-size: 15px;
        }

        .et-coach-box strong {
            display: block;
            color: #172b4d;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .et-coach-box small {
            color: #64748b;
            font-size: 12px;
        }

        /* INFORMATION */

        .et-info {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            padding: 18px;
            margin-top: 25px;
        }

        .et-info strong {
            display: block;
            color: #1e40af;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .et-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* FORM ACTIONS */

        .et-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            border-top: 1px solid #e5ebf3;
            margin-top: 28px;
            padding-top: 23px;
        }

        .et-actions-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .et-actions small {
            color: #64748b;
            font-size: 12px;
        }

        .et-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 16px 18px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .et-errors ul {
            margin: 10px 0 0;
            padding-left: 20px;
        }

        /* RESPONSIVE */

        @media (max-width: 650px) {

            .et-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .et-header h1 {
                font-size: 25px;
            }

            .et-hero {
                padding: 23px;
            }

            .et-hero-content {
                gap: 15px;
            }

            .et-team-icon {
                width: 65px;
                height: 65px;
                font-size: 30px;
                border-radius: 15px;
            }

            .et-hero h2 {
                font-size: 22px;
            }

            .et-card {
                padding: 20px;
            }

            .et-form-grid {
                grid-template-columns: 1fr;
            }

            .et-full {
                grid-column: auto;
            }

            .et-actions-right {
                width: 100%;
            }

            .et-actions-right .et-btn {
                flex: 1;
            }

        }
    </style>

    @php

        $trajneriAktual = $ekipi->trajner;

        $emriTrajnerit = $trajneriAktual
            ? $trajneriAktual->emri . ' ' .
              $trajneriAktual->mbiemri
            : 'Pa trajner';

        $inicialet = $trajneriAktual
            ? mb_strtoupper(
                mb_substr($trajneriAktual->emri, 0, 1)
                .
                mb_substr($trajneriAktual->mbiemri, 0, 1)
            )
            : '-';

        $listaTrajnereve = $trajneret
            ?? \App\Models\Trajner::orderBy('emri')->get();

        $kategorite = collect([
            'Senior',
            'U18',
            'U16',
            'U14'
        ])
        ->merge([$ekipi->kategoria])
        ->filter()
        ->unique()
        ->values();

    @endphp

    <div class="edit-team-page">

        {{-- PAGE HEADER --}}

        <div class="et-header">

            <div>

                <h1>Edito Ekipin</h1>

                <p>

                    Perditeso informacionet dhe
                    stafin profesional te ekipit.

                </p>

            </div>

            <a href="{{ route('ekipet.index') }}"
               class="et-btn et-btn-light">

                ← Kthehu te Ekipet

            </a>

        </div>

        {{-- ERRORS --}}

        @if($errors->any())

            <div class="et-errors">

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

        {{-- TEAM HERO --}}

        <div class="et-hero">

            <div class="et-hero-content">

                <div class="et-team-icon">

                    🏐

                </div>

                <div>

                <span class="et-hero-label">

                    KV GJINOCI | EDIT TEAM

                </span>

                    <h2>{{ $ekipi->emri }}</h2>

                    <p>

                        Menaxhimi i informacioneve
                        dhe organizimit te ekipit.

                    </p>

                    <div class="et-tags">

                    <span class="et-tag">

                        {{ $ekipi->kategoria }}

                    </span>

                        <span class="et-tag">

                        👤 {{ $emriTrajnerit }}

                    </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- EDIT FORM --}}

        <div class="et-card">

            <div class="et-card-header">

                <div class="et-card-icon">

                    ✏️

                </div>

                <div>

                    <h2>Informacionet e Ekipit</h2>

                    <p>

                        Ndrysho te dhenat ekzistuese
                        te ekipit dhe ruaj ndryshimet.

                    </p>

                </div>

            </div>

            <form method="POST"
                  action="{{ route(
                  'ekipet.update',
                  $ekipi
              ) }}">

                @csrf

                @method('PUT')

                <div class="et-form-grid">

                    {{-- TEAM NAME --}}

                    <div class="et-field et-full">

                        <label for="emri">

                            Emri i Ekipit

                            <span class="et-required">

                            *

                        </span>

                        </label>

                        <input
                            type="text"
                            id="emri"
                            name="emri"
                            value="{{ old('emri', $ekipi->emri) }}"
                            class="et-input @error('emri') et-invalid @enderror"
                            placeholder="P.sh. KV Gjinoci"
                            maxlength="255"
                            required
                        >

                        @error('emri')

                        <span class="et-error">

                            {{ $message }}

                        </span>

                        @enderror

                        <small class="et-help">

                            Emri zyrtar i ekipit
                            ne sistemin e klubit.

                        </small>

                    </div>

                    {{-- CATEGORY --}}

                    <div class="et-field">

                        <label for="kategoria">

                            Kategoria

                            <span class="et-required">

                            *

                        </span>

                        </label>

                        <select
                            id="kategoria"
                            name="kategoria"
                            class="et-input @error('kategoria') et-invalid @enderror"
                            required
                        >

                            @foreach($kategorite as $kategoria)

                                <option value="{{ $kategoria }}"
                                    @selected(
                                        old(
                                            'kategoria',
                                            $ekipi->kategoria
                                        ) === $kategoria
                                    )>

                                    {{ $kategoria }}

                                </option>

                            @endforeach

                        </select>

                        @error('kategoria')

                        <span class="et-error">

                            {{ $message }}

                        </span>

                        @enderror

                        <small class="et-help">

                            Kategoria sportive e ekipit.

                        </small>

                    </div>

                    {{-- COACH --}}

                    <div class="et-field">

                        <label for="trajner_id">

                            Trajneri

                        </label>

                        <select
                            id="trajner_id"
                            name="trajner_id"
                            class="et-input @error('trajner_id') et-invalid @enderror"
                        >

                            <option value=""
                                @selected(
                                    !old(
                                        'trajner_id',
                                        $ekipi->trajner_id
                                    )
                                )>

                                Pa trajner

                            </option>

                            @foreach($listaTrajnereve as $trajner)

                                <option
                                    value="{{ $trajner->id }}"
                                    @selected(
                                        (string) old(
                                            'trajner_id',
                                            $ekipi->trajner_id
                                        ) === (string) $trajner->id
                                    )>

                                    {{ $trajner->emri }}

                                    {{ $trajner->mbiemri }}

                                </option>

                            @endforeach

                        </select>

                        @error('trajner_id')

                        <span class="et-error">

                            {{ $message }}

                        </span>

                        @enderror

                        <small class="et-help">

                            Zgjedh trajnerin
                            pergjegjes te ekipit.

                        </small>

                    </div>

                </div>

                {{-- CURRENT COACH --}}

                <div class="et-coach-box">

                    <div class="et-coach-avatar">

                        {{ $inicialet }}

                    </div>

                    <div>

                        <strong>

                            {{ $emriTrajnerit }}

                        </strong>

                        <small>

                            Trajneri aktual i ekipit

                        </small>

                    </div>

                </div>

                {{-- INFORMATION --}}

                <div class="et-info">

                <span style="font-size:22px">

                    ℹ️

                </span>

                    <div>

                        <strong>

                            Perditesimi i Ekipit

                        </strong>

                        <p>

                            Ndryshimet e emrit,
                            kategorise dhe trajnerit
                            do te ruhen ne profilin
                            ekzistues te ekipit.

                            Volejbollistet e regjistruara
                            nuk fshihen nga ekipi.

                        </p>

                    </div>

                </div>

                {{-- ACTIONS --}}

                <div class="et-actions">

                    <small>

                        * Fushat e detyrueshme

                    </small>

                    <div class="et-actions-right">

                        <a href="{{ route('ekipet.index') }}"
                           class="et-btn et-btn-gray">

                            Anulo

                        </a>

                        <button type="submit"
                                class="et-btn">

                            ✓ Ruaj Ndryshimet

                        </button>

                    </div>

                </div>

            </form>

        </div>

        <a href="{{ route(
        'ekipet.show',
        $ekipi
    ) }}"
           class="et-btn et-btn-light">

            ← Shiko Profilin e Ekipit

        </a>

    </div>

@endsection
