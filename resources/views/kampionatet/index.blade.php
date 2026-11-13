@extends('layouts.club')

@section('title', 'Kampionatet - KV Gjinoci')

@section('content')

    <style>
        .championships-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .championships-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .champ-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .champ-header h1 {
            color: #172b4d;
            font-size: 30px;
            margin: 0 0 8px;
        }

        .champ-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .champ-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
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

        .champ-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .champ-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .champ-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        .champ-btn-danger {
            background: #fff0f0;
            color: #dc2626 !important;
        }

        /* STATISTICS */

        .champ-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .champ-stat {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .champ-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .champ-stat-label {
            font-size: 13px;
            color: #64748b;
        }

        .champ-stat-icon {
            width: 43px;
            height: 43px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            font-size: 22px;
            flex-shrink: 0;
        }

        .champ-icon-gold {
            background: #fff1df;
        }

        .champ-icon-green {
            background: #dcfce7;
        }

        .champ-icon-purple {
            background: #f1eaff;
        }

        .champ-stat h2 {
            font-size: 35px;
            color: #172b4d;
            margin: 15px 0 6px;
        }

        .champ-stat small {
            color: #64748b;
            font-size: 12px;
        }

        /* CARDS */

        .champ-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            border: 1px solid #e5ebf3;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .champ-card h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 8px;
        }

        .champ-description {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 23px;
            line-height: 1.6;
        }

        /* FORM */

        .champ-form-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 17px;
        }

        .champ-form-group {
            min-width: 0;
        }

        .championships-page .champ-form-group label {
            display: block;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .championships-page .champ-form-group input,
        .championships-page .champ-form-group select {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #dbe3ee;
            background: #f8fafc;
            border-radius: 9px;
            font-size: 14px;
            color: #172b4d;
            outline: none;
            margin: 0;
        }

        .championships-page .champ-form-group input:focus,
        .championships-page .champ-form-group select:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        /* CLUB SELECTION */

        .champ-clubs-section {
            margin-top: 27px;
        }

        .champ-clubs-heading {
            font-size: 17px;
            color: #172b4d;
            margin: 0 0 7px;
        }

        .champ-clubs-description {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 17px;
        }

        .champ-clubs-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 13px;
        }

        .champ-club-option {
            display: flex;
            align-items: center;
            gap: 11px;
            background: #f8fafc;
            border: 1px solid #dbe3ee;
            border-radius: 11px;
            padding: 15px;
            cursor: pointer;
            transition: .2s;
            min-width: 0;
            margin: 0;
        }

        .champ-club-option:hover {
            border-color: #93b4eb;
            background: #f0f6ff;
        }

        .champ-club-option:has(input:checked) {
            background: #edf4ff;
            border-color: #60a5fa;
        }

        .championships-page .champ-club-option input {
            width: 17px;
            height: 17px;
            margin: 0;
            accent-color: #253858;
            flex-shrink: 0;
        }

        .champ-club-icon {
            width: 39px;
            height: 39px;
            border-radius: 9px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 19px;
        }

        .champ-club-info {
            flex: 1;
            min-width: 0;
        }

        .champ-club-info strong {
            display: block;
            font-size: 13px;
            color: #172b4d;
            overflow-wrap: anywhere;
        }

        .champ-club-info small {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-top: 5px;
        }

        .champ-form-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 23px;
        }

        /* TABLE */

        .champ-table-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .champ-table-heading h2 {
            margin: 0 0 7px;
        }

        .champ-table-heading p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
        }

        .champ-count {
            background: #e8efff;
            color: #2563eb;
            padding: 9px 14px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
        }

        .champ-table-scroll {
            overflow-x: auto;
        }

        .champ-table {
            width: 100%;
            min-width: 780px;
            border-collapse: collapse;
        }

        .champ-table th {
            background: #253858;
            color: white;
            padding: 16px 14px;
            font-size: 13px;
            text-align: left;
            white-space: nowrap;
        }

        .champ-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .champ-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .champ-table td {
            color: #172b4d;
            font-size: 14px;
            padding: 18px 14px;
            border-bottom: 1px solid #edf0f5;
            vertical-align: middle;
        }

        .champ-table tbody tr:hover {
            background: #f8fafc;
        }

        .champ-name {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .champ-trophy {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 11px;
            background: #fff1df;
            font-size: 23px;
            flex-shrink: 0;
        }

        .champ-name strong {
            color: #172b4d;
            font-size: 15px;
            display: block;
        }

        .champ-name small {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-top: 5px;
        }

        /* BADGES */

        .champ-season {
            display: inline-block;
            background: #edf2f7;
            color: #475569;
            padding: 8px 11px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .champ-category {
            display: inline-block;
            background: #e8efff;
            color: #2563eb;
            padding: 8px 11px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .champ-category-senior {
            background: #dcfce7;
            color: #047857;
        }

        .champ-category-youth {
            background: #f1eaff;
            color: #7c3aed;
        }

        .champ-club-count {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #a16207;
            background: #fff3df;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        /* ACTIONS */

        .champ-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .champ-actions form {
            margin: 0;
        }

        .champ-actions .champ-btn {
            padding: 10px 13px;
        }

        /* EDIT FORM */

        .champ-edit-row[hidden] {
            display: none !important;
        }

        .champ-edit-panel {
            background: #f8fafc;
            border: 1px solid #dbe3ee;
            padding: 23px;
            border-radius: 12px;
        }

        .champ-edit-panel h3 {
            font-size: 19px;
            color: #172b4d;
            margin: 0 0 22px;
        }

        /* MESSAGES */

        .champ-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .champ-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .champ-errors ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .champ-empty {
            padding: 40px !important;
            color: #64748b !important;
            text-align: center;
        }

        .champ-empty h3 {
            color: #172b4d;
        }

        .champ-footer {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* RESPONSIVE */

        @media (max-width: 1000px) {

            .champ-clubs-grid {
                grid-template-columns: repeat(
                2, minmax(0, 1fr)
            );
            }

        }

        @media (max-width: 700px) {

            .champ-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .champ-header h1 {
                font-size: 25px;
            }

            .champ-stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .champ-form-grid,
            .champ-clubs-grid {
                grid-template-columns: 1fr;
            }

            .champ-card {
                padding: 17px;
            }

            .champ-stat {
                padding: 18px;
            }

            .champ-stat h2 {
                font-size: 30px;
            }

            .champ-edit-panel {
                padding: 16px;
            }

        }
    </style>

    <div class="championships-page">

        @php
            $listaKampionateve = $kampionatet instanceof
                \Illuminate\Contracts\Pagination\Paginator
                    ? $kampionatet->getCollection()
                    : collect($kampionatet);

            $totalKampionate = $kampionatet instanceof
                \Illuminate\Contracts\Pagination\LengthAwarePaginator
                    ? $kampionatet->total()
                    : $listaKampionateve->count();

            $totalKlube = collect($klubet)->count();

            $totalSezone = collect($sezonet)->count();

            $kategorite = [
                'Senior',
                'U20',
                'U18',
                'U16',
                'U14'
            ];

            $kategorite = collect($kategorite)
                ->merge(
                    $listaKampionateve->pluck('kategoria')
                )
                ->filter()
                ->unique()
                ->values();
        @endphp

        {{-- PAGE HEADER --}}

        <div class="champ-header">

            <div>

                <h1>Menaxhimi i Kampionateve</h1>

                <p>

                    Organizo kampionatet,
                    klubet pjesemarrese dhe
                    garat sportive te KV Gjinocit.

                </p>

            </div>

            <a class="champ-btn champ-btn-light"
               href="{{ route('klubet.index') }}">

                Menaxho Klubet

            </a>

        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="champ-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- ERRORS --}}

        @if(session('error'))

            <div class="champ-errors">

                {{ session('error') }}

            </div>

        @endif

        @if($errors->any())

            <div class="champ-errors">

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

        {{-- STATISTICS --}}

        <div class="champ-stats">

            <div class="champ-stat">

                <div class="champ-stat-top">

                <span class="champ-stat-label">

                    Total Kampionate

                </span>

                    <span class="champ-stat-icon champ-icon-gold">

                    🏆

                </span>

                </div>

                <h2>{{ $totalKampionate }}</h2>

                <small>

                    Kampionate te regjistruara

                </small>

            </div>

            <div class="champ-stat">

                <div class="champ-stat-top">

                <span class="champ-stat-label">

                    Klube te Regjistruara

                </span>

                    <span class="champ-stat-icon champ-icon-green">

                    🛡️

                </span>

                </div>

                <h2>{{ $totalKlube }}</h2>

                <small>

                    Klube ne sistem

                </small>

            </div>

            <div class="champ-stat">

                <div class="champ-stat-top">

                <span class="champ-stat-label">

                    Sezone Sportive

                </span>

                    <span class="champ-stat-icon champ-icon-purple">

                    📅

                </span>

                </div>

                <h2>{{ $totalSezone }}</h2>

                <small>

                    Sezone te regjistruara

                </small>

            </div>

        </div>

        {{-- CREATE CHAMPIONSHIP --}}

        <div class="champ-card">

            <h2>Krijo Kampionat te Ri</h2>

            <p class="champ-description">

                Regjistro nje kampionat,
                cakto sezonin, kategorine dhe
                zgjedh klubet qe do te marrin pjese.

            </p>

            <form method="POST"
                  action="{{ route('kampionatet.store') }}">

                @csrf

                <div class="champ-form-grid">

                    {{-- NAME --}}

                    <div class="champ-form-group">

                        <label for="emri">

                            Emri i Kampionatit

                        </label>

                        <input type="text"
                               name="emri"
                               id="emri"
                               placeholder="P.sh. Superliga A"
                               value="{{ old('emri') }}"
                               required>

                    </div>

                    {{-- SEASON --}}

                    <div class="champ-form-group">

                        <label for="sezoni_id">

                            Sezoni

                        </label>

                        <select name="sezoni_id"
                                id="sezoni_id"
                                required>

                            <option value="">

                                Zgjedh sezonin

                            </option>

                            @foreach($sezonet as $sezoni)

                                <option value="{{ $sezoni->id }}"
                                    @selected(
                                        (string)old('sezoni_id') ===
                                        (string)$sezoni->id
                                    )>

                                    {{ $sezoni->emri }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- CATEGORY --}}

                    <div class="champ-form-group">

                        <label for="kategoria">

                            Kategoria

                        </label>

                        <select name="kategoria"
                                id="kategoria"
                                required>

                            @foreach($kategorite as $kategoria)

                                <option value="{{ $kategoria }}"
                                    @selected(
                                        old('kategoria', 'Senior')
                                        === $kategoria
                                    )>

                                    {{ $kategoria }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                {{-- PARTICIPATING CLUBS --}}

                <div class="champ-clubs-section">

                    <h3 class="champ-clubs-heading">

                        Klubet Pjesemarrese

                    </h3>

                    <p class="champ-clubs-description">

                        Zgjedh klubet qe do te
                        marrin pjese ne kete kampionat.

                    </p>

                    <div class="champ-clubs-grid">

                        @forelse($klubet as $klubi)

                            <label class="champ-club-option">

                                <input type="checkbox"
                                       name="klubet[]"
                                       value="{{ $klubi->id }}"
                                    @checked(
                                        in_array(
                                            (string)$klubi->id,
                                            array_map(
                                                'strval',
                                                old('klubet', [])
                                            )
                                        )
                                    )>

                                <span class="champ-club-icon">

                                🛡️

                            </span>

                                <span class="champ-club-info">

                                <strong>

                                    {{ $klubi->emri }}

                                </strong>

                                <small>

                                    {{ $klubi->qyteti ?? '-' }}

                                </small>

                            </span>

                            </label>

                        @empty

                            <p class="champ-description">

                                Nuk ka klube te regjistruara.

                            </p>

                        @endforelse

                    </div>

                </div>

                <div class="champ-form-actions">

                    <button type="submit"
                            class="champ-btn">

                        + Krijo Kampionatin

                    </button>

                    <a class="champ-btn champ-btn-gray"
                       href="{{ route('klubet.index') }}">

                        Shto Klub

                    </a>

                </div>

            </form>

        </div>

        {{-- CHAMPIONSHIPS TABLE --}}

        <div class="champ-card">

            <div class="champ-table-heading">

                <div>

                    <h2>Kampionatet e Regjistruara</h2>

                    <p>

                        Menaxho garat, sezonet
                        dhe klubet pjesemarrese.

                    </p>

                </div>

                <span class="champ-count">

                {{ $totalKampionate }} Kampionate

            </span>

            </div>

            <div class="champ-table-scroll">

                <table class="champ-table">

                    <thead>

                    <tr>

                        <th>Kampionati</th>

                        <th>Sezoni</th>

                        <th>Kategoria</th>

                        <th>Klubet</th>

                        <th>Veprimet</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($kampionatet as $kampionati)

                        @php
                            $klubetKampionatit =
                                $kampionati->klubet;

                            $klubetZgjedhura =
                                $klubetKampionatit
                                    ->pluck('id')
                                    ->map(fn ($id) => (string)$id)
                                    ->toArray();

                            $numriKlubeve =
                                $kampionati->klubet_count
                                ?? $klubetKampionatit->count();
                        @endphp

                        <tr>

                            {{-- CHAMPIONSHIP NAME --}}

                            <td>

                                <div class="champ-name">

                                    <div class="champ-trophy">

                                        🏆

                                    </div>

                                    <div>

                                        <strong>

                                            {{ $kampionati->emri }}

                                        </strong>

                                        <small>

                                            Kampionat Volejbolli

                                        </small>

                                    </div>

                                </div>

                            </td>

                            {{-- SEASON --}}

                            <td>

                                <span class="champ-season">

                                    {{ $kampionati->sezoni?->emri
                                        ?? 'Pa sezon' }}

                                </span>

                            </td>

                            {{-- CATEGORY --}}

                            <td>

                                <span class="champ-category
                                    {{ $kampionati->kategoria === 'Senior'
                                        ? 'champ-category-senior'
                                        : 'champ-category-youth' }}">

                                    {{ $kampionati->kategoria }}

                                </span>

                            </td>

                            {{-- CLUB COUNT --}}

                            <td>

                                <span class="champ-club-count">

                                    🛡️

                                    {{ $numriKlubeve }}

                                </span>

                            </td>

                            {{-- ACTIONS --}}

                            <td>

                                <div class="champ-actions">

                                    <a class="champ-btn champ-btn-light"
                                       href="{{ route(
                                           'kampionatet.show',
                                           $kampionati
                                       ) }}">

                                        Shiko

                                    </a>

                                    <button type="button"
                                            class="champ-btn champ-btn-gray"
                                            id="champ-edit-button-{{ $kampionati->id }}"
                                            aria-expanded="false"
                                            aria-controls="edit-champ-{{ $kampionati->id }}"
                                            onclick="toggleChampEdit({{ $kampionati->id }})">

                                        Edito

                                    </button>

                                    <form method="POST"
                                          action="{{ route(
                                              'kampionatet.destroy',
                                              $kampionati
                                          ) }}"
                                          onsubmit="return confirm('A je i sigurt qe deshiron ta fshish kampionatin?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="champ-btn champ-btn-danger">

                                            Fshi

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        {{-- EDIT CHAMPIONSHIP --}}

                        <tr class="champ-edit-row"
                            id="edit-champ-{{ $kampionati->id }}"
                            hidden>

                            <td colspan="5">

                                <div class="champ-edit-panel">

                                    <h3>

                                        Edito Kampionatin:

                                        {{ $kampionati->emri }}

                                    </h3>

                                    <form method="POST"
                                          action="{{ route(
                                              'kampionatet.update',
                                              $kampionati
                                          ) }}">

                                        @csrf
                                        @method('PUT')

                                        <div class="champ-form-grid">

                                            {{-- NAME --}}

                                            <div class="champ-form-group">

                                                <label for="emri-{{ $kampionati->id }}">

                                                    Emri i Kampionatit

                                                </label>

                                                <input type="text"
                                                       name="emri"
                                                       id="emri-{{ $kampionati->id }}"
                                                       value="{{ $kampionati->emri }}"
                                                       required>

                                            </div>

                                            {{-- SEASON --}}

                                            <div class="champ-form-group">

                                                <label for="sezoni-{{ $kampionati->id }}">

                                                    Sezoni

                                                </label>

                                                <select name="sezoni_id"
                                                        id="sezoni-{{ $kampionati->id }}"
                                                        required>

                                                    @foreach($sezonet as $sezoni)

                                                        <option value="{{ $sezoni->id }}"
                                                            @selected(
                                                                (string)$kampionati->sezoni_id
                                                                ===
                                                                (string)$sezoni->id
                                                            )>

                                                            {{ $sezoni->emri }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                            {{-- CATEGORY --}}

                                            <div class="champ-form-group">

                                                <label for="kategoria-{{ $kampionati->id }}">

                                                    Kategoria

                                                </label>

                                                <select name="kategoria"
                                                        id="kategoria-{{ $kampionati->id }}"
                                                        required>

                                                    @foreach($kategorite as $kategoria)

                                                        <option value="{{ $kategoria }}"
                                                            @selected(
                                                                $kampionati->kategoria
                                                                === $kategoria
                                                            )>

                                                            {{ $kategoria }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>

                                        {{-- EDIT CLUBS --}}

                                        <div class="champ-clubs-section">

                                            <h3 class="champ-clubs-heading">

                                                Klubet Pjesemarrese

                                            </h3>

                                            <p class="champ-clubs-description">

                                                Perditeso klubet qe
                                                marrin pjese ne kampionat.

                                            </p>

                                            <div class="champ-clubs-grid">

                                                @foreach($klubet as $klubi)

                                                    <label class="champ-club-option">

                                                        <input type="checkbox"
                                                               name="klubet[]"
                                                               value="{{ $klubi->id }}"
                                                            @checked(
                                                                in_array(
                                                                    (string)$klubi->id,
                                                                    $klubetZgjedhura
                                                                )
                                                            )>

                                                        <span class="champ-club-icon">

                                                            🛡️

                                                        </span>

                                                        <span class="champ-club-info">

                                                            <strong>

                                                                {{ $klubi->emri }}

                                                            </strong>

                                                            <small>

                                                                {{ $klubi->qyteti ?? '-' }}

                                                            </small>

                                                        </span>

                                                    </label>

                                                @endforeach

                                            </div>

                                        </div>

                                        <div class="champ-form-actions">

                                            <button type="submit"
                                                    class="champ-btn">

                                                Ruaj Ndryshimet

                                            </button>

                                            <button type="button"
                                                    class="champ-btn champ-btn-gray"
                                                    onclick="toggleChampEdit({{ $kampionati->id }})">

                                                Anulo

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="champ-empty">

                                <div style="font-size:45px">

                                    🏆

                                </div>

                                <h3>

                                    Nuk ka kampionate
                                    te regjistruara.

                                </h3>

                                <p>

                                    Krijo kampionatin e pare
                                    duke perdorur formularin lart.

                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            @if($kampionatet instanceof
                \Illuminate\Contracts\Pagination\Paginator)

                <div style="margin-top:22px">

                    {{ $kampionatet->withQueryString()->links() }}

                </div>

            @endif

        </div>

        {{-- FOOTER --}}

        <div class="champ-footer">

            <a class="champ-btn champ-btn-gray"
               href="{{ route('dashboard') }}">

                Kthehu ne Dashboard

            </a>

            <a class="champ-btn champ-btn-light"
               href="{{ route('sezonet.index') }}">

                Menaxho Sezonet

            </a>

            <a class="champ-btn champ-btn-light"
               href="{{ route('klubet.index') }}">

                Menaxho Klubet

            </a>

        </div>

    </div>

    <script>
        function toggleChampEdit(id) {

            const row = document.getElementById(
                'edit-champ-' + id
            );

            const button = document.getElementById(
                'champ-edit-button-' + id
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
