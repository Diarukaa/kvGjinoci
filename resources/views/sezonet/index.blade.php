@extends('layouts.club')

@section('title', 'Sezonet - KV Gjinoci')

@section('content')

    <style>
        .seasons-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .seasons-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .seasons-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .seasons-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .seasons-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .season-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #253858;
            color: white !important;
            text-decoration: none !important;
            padding: 12px 18px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .season-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .season-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .season-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        .season-btn-danger {
            background: #fff0f0;
            color: #dc2626 !important;
        }

        /* ACTIVE SEASON */

        .season-hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(
                130deg,
                #172b4d,
                #315b89
            );
            padding: 30px;
            border-radius: 17px;
            color: white;
            margin-bottom: 25px;
            box-shadow: 0 7px 20px rgba(23,43,77,.12);
        }

        .season-hero::after {
            content: "🏐";
            position: absolute;
            font-size: 210px;
            right: -25px;
            bottom: -65px;
            opacity: .09;
            transform: rotate(-15deg);
            pointer-events: none;
        }

        .season-hero-content {
            position: relative;
            z-index: 1;
        }

        .season-hero-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .season-hero-label {
            color: #bfdbfe;
            font-size: 12px;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .season-hero-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(255,255,255,.12);
            font-size: 25px;
        }

        .season-hero h2 {
            color: white !important;
            font-size: 43px;
            margin: 16px 0 8px;
            font-weight: bold;
        }

        .season-hero p {
            color: #dbeafe !important;
            font-size: 14px;
            margin: 0 0 18px;
        }

        .season-active-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(134,239,172,.13);
            border: 1px solid rgba(134,239,172,.3);
            color: #86efac;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .season-active-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #86efac;
            box-shadow: 0 0 10px #86efac;
        }

        .season-hero-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 35px;
            border-top: 1px solid rgba(255,255,255,.15);
            margin-top: 25px;
            padding-top: 23px;
        }

        .season-hero-stat small {
            display: block;
            color: #bfdbfe;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .season-hero-stat strong {
            color: white;
            font-size: 26px;
        }

        /* STATISTICS */

        .seasons-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .season-stat {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .season-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .season-stat-label {
            color: #64748b;
            font-size: 13px;
        }

        .season-stat-icon {
            width: 43px;
            height: 43px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            font-size: 21px;
            flex-shrink: 0;
        }

        .season-icon-purple {
            background: #f1eaff;
        }

        .season-icon-green {
            background: #dcfce7;
        }

        .season-stat h2 {
            color: #172b4d;
            font-size: 35px;
            margin: 15px 0 6px;
        }

        .season-stat small {
            color: #64748b;
            font-size: 12px;
        }

        /* CARDS */

        .season-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e5ebf3;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .season-card h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 8px;
        }

        .season-description {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 23px;
            line-height: 1.6;
        }

        /* FORMS */

        .season-form-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 16px;
        }

        .season-form-group {
            min-width: 0;
        }

        .seasons-page .season-form-group label {
            display: block;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .seasons-page .season-form-group input,
        .seasons-page .season-form-group select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 9px;
            border: 1px solid #dbe3ee;
            background: #f8fafc;
            color: #172b4d;
            font-size: 14px;
            outline: none;
            margin: 0;
        }

        .seasons-page .season-form-group input:focus,
        .seasons-page .season-form-group select:focus {
            border-color: #2563eb;
            background: white;
        }

        .season-form-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 22px;
            flex-wrap: wrap;
        }

        /* TABLE */

        .season-table-scroll {
            overflow-x: auto;
        }

        .season-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .season-table th {
            background: #253858;
            color: white;
            padding: 16px 14px;
            font-size: 13px;
            text-align: left;
            white-space: nowrap;
        }

        .season-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .season-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .season-table td {
            color: #172b4d;
            padding: 18px 14px;
            border-bottom: 1px solid #edf0f5;
            font-size: 14px;
            vertical-align: middle;
        }

        .season-table tbody tr:hover {
            background: #f8fafc;
        }

        .season-name {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .season-name-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #e8efff;
            font-size: 21px;
            flex-shrink: 0;
        }

        .season-name strong {
            color: #172b4d;
            font-size: 15px;
        }

        .season-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .season-status-active {
            color: #047857;
            background: #dcfce7;
        }

        .season-status-inactive {
            color: #64748b;
            background: #edf2f7;
        }

        .season-match-count {
            display: inline-block;
            background: #e8efff;
            color: #2563eb;
            border-radius: 7px;
            padding: 8px 13px;
            font-size: 13px;
            font-weight: bold;
        }

        .season-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .season-actions form {
            margin: 0;
        }

        /* EDIT FORM */

        .season-edit-panel {
            background: #f8fafc;
            border: 1px solid #dbe3ee;
            padding: 22px;
            border-radius: 12px;
        }

        .season-edit-panel h3 {
            color: #172b4d;
            font-size: 18px;
            margin: 0 0 22px;
        }

        .season-edit-row[hidden] {
            display: none !important;
        }

        /* MESSAGES */

        .season-success {
            color: #166534;
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .season-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .season-errors ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .season-empty {
            text-align: center;
            padding: 35px !important;
            color: #64748b !important;
        }

        .season-footer {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* RESPONSIVE */

        @media (max-width: 950px) {

            .season-form-grid {
                grid-template-columns: repeat(
                2, minmax(0,1fr)
            );
            }

        }

        @media (max-width: 600px) {

            .seasons-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .seasons-header h1 {
                font-size: 25px;
            }

            .seasons-stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .season-form-grid {
                grid-template-columns: 1fr;
            }

            .season-card {
                padding: 17px;
            }

            .season-hero {
                padding: 22px;
            }

            .season-hero h2 {
                font-size: 35px;
            }

            .season-hero-stats {
                gap: 22px;
            }

            .season-stat {
                padding: 18px;
            }

        }
    </style>

    <div class="seasons-page">

        @php
            $listaSezoneve = collect($sezonet);

            $sezoniAktual = $listaSezoneve->first(
                fn ($s) => (bool) $s->aktiv
            );

            $totalSezone = $listaSezoneve->count();

            $sezoneJoaktive = $listaSezoneve
                ->filter(fn ($s) => !$s->aktiv)
                ->count();

            $ndeshjeTotale = $listaSezoneve
                ->sum('ndeshjet_count');
        @endphp

        {{-- PAGE HEADER --}}

        <div class="seasons-header">

            <div>

                <h1>Menaxhimi i Sezoneve</h1>

                <p>
                    Organizo sezonet sportive,
                    kampionatet dhe ndeshjet
                    e klubit KV Gjinoci.
                </p>

            </div>

            <a class="season-btn season-btn-light"
               href="{{ route('kampionatet.index') }}">

                Shiko Kampionatet

            </a>

        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="season-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="season-errors">

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

        {{-- ACTIVE SEASON --}}

        @if($sezoniAktual)

            <div class="season-hero">

                <div class="season-hero-content">

                    <div class="season-hero-top">

                    <span class="season-hero-label">

                        SEZONI AKTUAL

                    </span>

                        <div class="season-hero-icon">

                            📅

                        </div>

                    </div>

                    <h2>

                        {{ $sezoniAktual->emri }}

                    </h2>

                    <p>

                        {{ \Carbon\Carbon::parse(
                            $sezoniAktual->data_fillimit
                        )->format('d.m.Y') }}

                        —

                        {{ \Carbon\Carbon::parse(
                            $sezoniAktual->data_mbarimit
                        )->format('d.m.Y') }}

                    </p>

                    <span class="season-active-label">

                    <span class="season-active-dot">
                    </span>

                    Sezon Aktiv

                </span>

                    <div class="season-hero-stats">

                        <div class="season-hero-stat">

                            <small>

                                Ndeshje te Regjistruara

                            </small>

                            <strong>

                                {{ $sezoniAktual->ndeshjet_count ?? 0 }}

                            </strong>

                        </div>

                        <div class="season-hero-stat">

                            <small>

                                Statusi

                            </small>

                            <strong>

                                Aktiv

                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        @else

            <div class="season-card">

                <h2>Nuk ka sezon aktiv</h2>

                <p class="season-description">

                    Krijo nje sezon te ri ose
                    aktivizo nje sezon ekzistues.

                </p>

            </div>

        @endif

        {{-- STATISTICS --}}

        <div class="seasons-stats">

            <div class="season-stat">

                <div class="season-stat-top">

                <span class="season-stat-label">

                    Total Sezone

                </span>

                    <span class="season-stat-icon">

                    📅

                </span>

                </div>

                <h2>{{ $totalSezone }}</h2>

                <small>

                    Sezone te regjistruara

                </small>

            </div>

            <div class="season-stat">

                <div class="season-stat-top">

                <span class="season-stat-label">

                    Sezone Joaktive

                </span>

                    <span class="season-stat-icon season-icon-purple">

                    📁

                </span>

                </div>

                <h2>{{ $sezoneJoaktive }}</h2>

                <small>

                    Sezone me status joaktiv

                </small>

            </div>

            <div class="season-stat">

                <div class="season-stat-top">

                <span class="season-stat-label">

                    Ndeshje Totale

                </span>

                    <span class="season-stat-icon season-icon-green">

                    🏐

                </span>

                </div>

                <h2>{{ $ndeshjeTotale }}</h2>

                <small>

                    Ndeshje ne sezonet e regjistruara

                </small>

            </div>

        </div>

        {{-- CREATE SEASON --}}

        <div class="season-card">

            <h2>Krijo Sezon te Ri</h2>

            <p class="season-description">

                Regjistro sezonin sportiv,
                cakto datat dhe statusin e tij.

            </p>

            <form method="POST"
                  action="{{ route('sezonet.store') }}">

                @csrf

                <div class="season-form-grid">

                    {{-- EMRI --}}

                    <div class="season-form-group">

                        <label for="emri">

                            Emri i Sezonit

                        </label>

                        <input type="text"
                               name="emri"
                               id="emri"
                               placeholder="2027/28"
                               value="{{ old('emri') }}"
                               required>

                    </div>

                    {{-- DATA E FILLIMIT --}}

                    <div class="season-form-group">

                        <label for="data_fillimit">

                            Data e Fillimit

                        </label>

                        <input type="date"
                               name="data_fillimit"
                               id="data_fillimit"
                               value="{{ old('data_fillimit') }}"
                               required>

                    </div>

                    {{-- DATA E MBARIMIT --}}

                    <div class="season-form-group">

                        <label for="data_mbarimit">

                            Data e Mbarimit

                        </label>

                        <input type="date"
                               name="data_mbarimit"
                               id="data_mbarimit"
                               value="{{ old('data_mbarimit') }}"
                               required>

                    </div>

                    {{-- STATUSI --}}

                    <div class="season-form-group">

                        <label for="aktiv">

                            Statusi

                        </label>

                        <select name="aktiv"
                                id="aktiv">

                            <option value="1"
                                @selected(
                                    (string) old('aktiv', '1') === '1'
                                )>

                                Aktiv

                            </option>

                            <option value="0"
                                @selected(
                                    (string) old('aktiv', '1') === '0'
                                )>

                                Joaktiv

                            </option>

                        </select>

                    </div>

                </div>

                <div class="season-form-actions">

                    <button type="submit"
                            class="season-btn">

                        + Krijo Sezonin

                    </button>

                </div>

            </form>

        </div>

        {{-- SEASONS TABLE --}}

        <div class="season-card">

            <h2>Sezonet e Regjistruara</h2>

            <p class="season-description">

                Menaxho sezonet ekzistuese,
                datat dhe statusin e tyre.

            </p>

            <div class="season-table-scroll">

                <table class="season-table">

                    <thead>

                    <tr>

                        <th>Sezoni</th>

                        <th>Fillimi</th>

                        <th>Mbarimi</th>

                        <th>Statusi</th>

                        <th>Ndeshje</th>

                        <th>Veprimet</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($sezonet as $sezoni)

                        <tr>

                            {{-- SEASON NAME --}}

                            <td>

                                <div class="season-name">

                                    <div class="season-name-icon">

                                        📅

                                    </div>

                                    <strong>

                                        {{ $sezoni->emri }}

                                    </strong>

                                </div>

                            </td>

                            {{-- START DATE --}}

                            <td>

                                {{ \Carbon\Carbon::parse(
                                    $sezoni->data_fillimit
                                )->format('d.m.Y') }}

                            </td>

                            {{-- END DATE --}}

                            <td>

                                {{ \Carbon\Carbon::parse(
                                    $sezoni->data_mbarimit
                                )->format('d.m.Y') }}

                            </td>

                            {{-- STATUS --}}

                            <td>

                                <span class="season-status
                                    {{ $sezoni->aktiv
                                        ? 'season-status-active'
                                        : 'season-status-inactive' }}">

                                    ●

                                    {{ $sezoni->aktiv
                                        ? 'Aktiv'
                                        : 'Joaktiv' }}

                                </span>

                            </td>

                            {{-- MATCHES --}}

                            <td>

                                <span class="season-match-count">

                                    {{ $sezoni->ndeshjet_count ?? 0 }}

                                </span>

                            </td>

                            {{-- ACTIONS --}}

                            <td>

                                <div class="season-actions">

                                    <button type="button"
                                            class="season-btn season-btn-light"
                                            onclick="toggleSeason({{ $sezoni->id }})"
                                            aria-expanded="false"
                                            aria-controls="edit-season-{{ $sezoni->id }}"
                                            id="edit-button-{{ $sezoni->id }}">

                                        Edito

                                    </button>

                                    @if(
                                        \Illuminate\Support\Facades\Route::has('sezonet.destroy')
                                        && (int) $sezoni->ndeshjet_count === 0
                                    )

                                        <form method="POST"
                                              action="{{ route('sezonet.destroy', $sezoni) }}"
                                              onsubmit="return confirm('A je i sigurt qe deshiron ta fshish sezonin?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="season-btn season-btn-danger">

                                                Fshi

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                        {{-- EDIT SEASON FORM --}}

                        <tr class="season-edit-row"
                            id="edit-season-{{ $sezoni->id }}"
                            hidden>

                            <td colspan="6">

                                <div class="season-edit-panel">

                                    <h3>

                                        Edito Sezonin:
                                        {{ $sezoni->emri }}

                                    </h3>

                                    <form method="POST"
                                          action="{{ route('sezonet.update', $sezoni) }}">

                                        @csrf
                                        @method('PUT')

                                        <div class="season-form-grid">

                                            {{-- EMRI --}}

                                            <div class="season-form-group">

                                                <label for="emri-{{ $sezoni->id }}">

                                                    Emri i Sezonit

                                                </label>

                                                <input type="text"
                                                       name="emri"
                                                       id="emri-{{ $sezoni->id }}"
                                                       value="{{ $sezoni->emri }}"
                                                       required>

                                            </div>

                                            {{-- FILLIMI --}}

                                            <div class="season-form-group">

                                                <label for="fillimi-{{ $sezoni->id }}">

                                                    Data e Fillimit

                                                </label>

                                                <input type="date"
                                                       name="data_fillimit"
                                                       id="fillimi-{{ $sezoni->id }}"
                                                       value="{{ \Carbon\Carbon::parse(
                                                           $sezoni->data_fillimit
                                                       )->format('Y-m-d') }}"
                                                       required>

                                            </div>

                                            {{-- MBARIMI --}}

                                            <div class="season-form-group">

                                                <label for="mbarimi-{{ $sezoni->id }}">

                                                    Data e Mbarimit

                                                </label>

                                                <input type="date"
                                                       name="data_mbarimit"
                                                       id="mbarimi-{{ $sezoni->id }}"
                                                       value="{{ \Carbon\Carbon::parse(
                                                           $sezoni->data_mbarimit
                                                       )->format('Y-m-d') }}"
                                                       required>

                                            </div>

                                            {{-- STATUSI --}}

                                            <div class="season-form-group">

                                                <label for="aktiv-{{ $sezoni->id }}">

                                                    Statusi

                                                </label>

                                                <select name="aktiv"
                                                        id="aktiv-{{ $sezoni->id }}">

                                                    <option value="1"
                                                        @selected($sezoni->aktiv)>

                                                        Aktiv

                                                    </option>

                                                    <option value="0"
                                                        @selected(!$sezoni->aktiv)>

                                                        Joaktiv

                                                    </option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="season-form-actions">

                                            <button type="submit"
                                                    class="season-btn">

                                                Ruaj Ndryshimet

                                            </button>

                                            <button type="button"
                                                    class="season-btn season-btn-gray"
                                                    onclick="toggleSeason({{ $sezoni->id }})">

                                                Anulo

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="season-empty">

                                Nuk ka sezone te regjistruara.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- FOOTER --}}

        <div class="season-footer">

            <a class="season-btn season-btn-gray"
               href="{{ route('dashboard') }}">

                Kthehu ne Dashboard

            </a>

            <a class="season-btn season-btn-light"
               href="{{ route('kampionatet.index') }}">

                Shiko Kampionatet

            </a>

        </div>

    </div>

    <script>
        function toggleSeason(id) {

            const row = document.getElementById(
                'edit-season-' + id
            );

            const button = document.getElementById(
                'edit-button-' + id
            );

            if (row) {

                row.hidden = !row.hidden;

                if (button) {
                    button.setAttribute(
                        'aria-expanded',
                        String(!row.hidden)
                    );
                }

            }

        }
    </script>

@endsection
