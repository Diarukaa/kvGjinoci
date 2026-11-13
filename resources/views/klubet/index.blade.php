@extends('layouts.club')

@section('title', 'Klubet - KV Gjinoci')

@section('content')

    <style>
        /* CLUBS PAGE */

        .clubs-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .clubs-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .clubs-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .clubs-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .clubs-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* BUTTONS */

        .clubs-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #253858;
            color: white !important;
            padding: 12px 18px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .clubs-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .clubs-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .clubs-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* STATISTICS */

        .clubs-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .clubs-stat {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .clubs-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .clubs-stat-label {
            color: #64748b;
            font-size: 13px;
        }

        .clubs-stat-icon {
            width: 43px;
            height: 43px;
            background: #e8efff;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .clubs-icon-green {
            background: #dcfce7;
        }

        .clubs-icon-purple {
            background: #f1eaff;
        }

        .clubs-stat h2 {
            font-size: 35px;
            color: #172b4d;
            margin: 15px 0 6px;
        }

        .clubs-stat small {
            color: #64748b;
            font-size: 12px;
        }

        /* CONTENT CARDS */

        .clubs-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .clubs-card h2 {
            font-size: 22px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .clubs-description {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 23px;
            line-height: 1.6;
        }

        /* FORM */

        .clubs-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 18px;
        }

        .clubs-form-group {
            min-width: 0;
        }

        .clubs-page .clubs-form-group label {
            display: block;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .clubs-page .clubs-form-group input {
            width: 100%;
            padding: 13px 14px;
            background: #f8fafc;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            color: #172b4d;
            font-size: 14px;
            outline: none;
            margin: 0;
        }

        .clubs-page .clubs-form-group input:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .clubs-form-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 21px;
        }

        /* TABLE HEADER */

        .clubs-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .clubs-table-header h2 {
            margin: 0 0 7px;
        }

        .clubs-table-header p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
        }

        .clubs-count {
            background: #e8efff;
            color: #2563eb;
            padding: 9px 14px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
        }

        /* TABLE */

        .clubs-table-scroll {
            overflow-x: auto;
        }

        .clubs-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        .clubs-table th {
            background: #253858;
            color: white;
            padding: 16px 14px;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        .clubs-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .clubs-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .clubs-table td {
            padding: 17px 14px;
            font-size: 14px;
            color: #172b4d;
            border-bottom: 1px solid #edf0f5;
            vertical-align: middle;
        }

        .clubs-table tbody tr:hover {
            background: #f8fafc;
        }

        .clubs-id {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #edf2f7;
            color: #64748b;
            font-size: 13px;
            font-weight: bold;
        }

        /* CLUB NAME */

        .club-name-wrap {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .club-avatar {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #e8efff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            flex-shrink: 0;
        }

        .club-name-wrap strong {
            color: #172b4d;
            font-size: 15px;
            display: block;
        }

        .club-name-wrap small {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-top: 5px;
        }

        .club-home-avatar {
            background: #172b4d;
            color: white;
        }

        .club-home-label {
            display: inline-block;
            margin-top: 6px;
            background: #dcfce7;
            color: #047857;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 10px;
            font-weight: bold;
        }

        /* CITY */

        .club-city {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #475569;
            font-size: 13px;
        }

        /* CHAMPIONSHIPS */

        .club-championship-count {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #fff3df;
            color: #a16207;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 13px;
            font-weight: bold;
        }

        /* ACTIONS */

        .clubs-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* EDIT PANEL */

        .club-edit-row[hidden] {
            display: none !important;
        }

        .club-edit-panel {
            background: #f8fafc;
            border: 1px solid #dbe3ee;
            padding: 22px;
            border-radius: 12px;
        }

        .club-edit-panel h3 {
            font-size: 18px;
            color: #172b4d;
            margin: 0 0 22px;
        }

        /* ALERTS */

        .clubs-success {
            color: #166534;
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .clubs-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .clubs-errors ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        /* EMPTY STATE */

        .clubs-empty {
            text-align: center;
            padding: 40px !important;
            color: #64748b !important;
        }

        .clubs-empty h3 {
            color: #172b4d;
        }

        /* FOOTER */

        .clubs-footer {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {

            .clubs-stats {
                grid-template-columns: repeat(
                2, minmax(0,1fr)
            );
            }

        }

        @media (max-width: 600px) {

            .clubs-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .clubs-header h1 {
                font-size: 25px;
            }

            .clubs-stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .clubs-form-grid {
                grid-template-columns: 1fr;
            }

            .clubs-card {
                padding: 17px;
            }

            .clubs-stat {
                padding: 18px;
            }

            .clubs-stat h2 {
                font-size: 30px;
            }

        }
    </style>

    <div class="clubs-page">

        @php
            $listaKlubeve = $klubet instanceof
                \Illuminate\Contracts\Pagination\Paginator
                    ? $klubet->getCollection()
                    : collect($klubet);

            $totalKlube = $klubet instanceof
                \Illuminate\Contracts\Pagination\LengthAwarePaginator
                    ? $klubet->total()
                    : $listaKlubeve->count();

            $totalQytete = $listaKlubeve
                ->pluck('qyteti')
                ->filter()
                ->unique()
                ->count();

            $totalPjesemarrje = $listaKlubeve
                ->sum(fn ($klub) =>
                    $klub->kampionatet_count
                    ?? $klub->kampionatet()->count()
                );
        @endphp

        {{-- PAGE HEADER --}}

        <div class="clubs-header">

            <div>

                <h1>Menaxhimi i Klubeve</h1>

                <p>

                    Regjistro klubet e volejbollit,
                    menaxho informacionet dhe
                    pjesemarrjen ne kampionate.

                </p>

            </div>

            <a class="clubs-btn clubs-btn-light"
               href="{{ route('kampionatet.index') }}">

                Shiko Kampionatet

            </a>

        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="clubs-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="clubs-errors">

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

        <div class="clubs-stats">

            <div class="clubs-stat">

                <div class="clubs-stat-top">

                <span class="clubs-stat-label">

                    Total Klube

                </span>

                    <span class="clubs-stat-icon">

                    🛡️

                </span>

                </div>

                <h2>{{ $totalKlube }}</h2>

                <small>

                    Klube te regjistruara

                </small>

            </div>

            <div class="clubs-stat">

                <div class="clubs-stat-top">

                <span class="clubs-stat-label">

                    Qytete ne Liste

                </span>

                    <span class="clubs-stat-icon clubs-icon-purple">

                    📍

                </span>

                </div>

                <h2>{{ $totalQytete }}</h2>

                <small>

                    Qytete te klubeve

                </small>

            </div>

            <div class="clubs-stat">

                <div class="clubs-stat-top">

                <span class="clubs-stat-label">

                    Pjesemarrje ne Kampionate

                </span>

                    <span class="clubs-stat-icon clubs-icon-green">

                    🏆

                </span>

                </div>

                <h2>{{ $totalPjesemarrje }}</h2>

                <small>

                    Pjesemarrje te klubeve ne liste

                </small>

            </div>

        </div>

        {{-- CREATE CLUB --}}

        <div class="clubs-card">

            <h2>Regjistro Klub te Ri</h2>

            <p class="clubs-description">

                Shto nje klub te ri ne sistem
                duke plotesuar informacionet
                baze te klubit.

            </p>

            <form method="POST"
                  action="{{ route('klubet.store') }}">

                @csrf

                <div class="clubs-form-grid">

                    {{-- CLUB NAME --}}

                    <div class="clubs-form-group">

                        <label for="emri">

                            Emri i Klubit

                        </label>

                        <input type="text"
                               name="emri"
                               id="emri"
                               value="{{ old('emri') }}"
                               placeholder="P.sh. KV Gjinoci"
                               required>

                    </div>

                    {{-- CITY --}}

                    <div class="clubs-form-group">

                        <label for="qyteti">

                            Qyteti

                        </label>

                        <input type="text"
                               name="qyteti"
                               id="qyteti"
                               value="{{ old('qyteti') }}"
                               placeholder="P.sh. Suhareke"
                               required>

                    </div>

                </div>

                <div class="clubs-form-actions">

                    <button type="submit"
                            class="clubs-btn">

                        + Shto Klub

                    </button>

                </div>

            </form>

        </div>

        {{-- CLUBS TABLE --}}

        <div class="clubs-card">

            <div class="clubs-table-header">

                <div>

                    <h2>Klubet e Regjistruara</h2>

                    <p>

                        Lista e klubeve dhe
                        kampionateve ku marrin pjese.

                    </p>

                </div>

                <span class="clubs-count">

                {{ $totalKlube }} Klube

            </span>

            </div>

            <div class="clubs-table-scroll">

                <table class="clubs-table">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>Klubi</th>

                        <th>Qyteti</th>

                        <th>Kampionate</th>

                        <th>Veprimet</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($klubet as $klubi)

                        @php
                            $eshteKlubiYne =
                                mb_strtolower(
                                    trim($klubi->emri)
                                ) === 'kv gjinoci';

                            $numriKampionateve =
                                $klubi->kampionatet_count
                                ?? $klubi->kampionatet()->count();
                        @endphp

                        <tr>

                            {{-- ID --}}

                            <td>

                                <span class="clubs-id">

                                    {{ $klubi->id }}

                                </span>

                            </td>

                            {{-- CLUB NAME --}}

                            <td>

                                <div class="club-name-wrap">

                                    <div class="club-avatar
                                        {{ $eshteKlubiYne
                                            ? 'club-home-avatar'
                                            : '' }}">

                                        @if($eshteKlubiYne)

                                            🏐

                                        @else

                                            🛡️

                                        @endif

                                    </div>

                                    <div>

                                        <strong>

                                            {{ $klubi->emri }}

                                        </strong>

                                        @if($eshteKlubiYne)

                                            <span class="club-home-label">

                                                Klubi Yne

                                            </span>

                                        @else

                                            <small>

                                                Klub Volejbolli

                                            </small>

                                        @endif

                                    </div>

                                </div>

                            </td>

                            {{-- CITY --}}

                            <td>

                                <div class="club-city">

                                    <span>📍</span>

                                    {{ $klubi->qyteti ?? '-' }}

                                </div>

                            </td>

                            {{-- CHAMPIONSHIPS --}}

                            <td>

                                <span class="club-championship-count">

                                    🏆

                                    {{ $numriKampionateve }}

                                </span>

                            </td>

                            {{-- ACTIONS --}}

                            <td>

                                <div class="clubs-actions">

                                    <button type="button"
                                            class="clubs-btn clubs-btn-light"
                                            id="club-edit-button-{{ $klubi->id }}"
                                            aria-expanded="false"
                                            aria-controls="edit-club-{{ $klubi->id }}"
                                            onclick="toggleClubEdit({{ $klubi->id }})">

                                        Edito

                                    </button>

                                </div>

                            </td>

                        </tr>

                        {{-- EDIT CLUB FORM --}}

                        <tr class="club-edit-row"
                            id="edit-club-{{ $klubi->id }}"
                            hidden>

                            <td colspan="5">

                                <div class="club-edit-panel">

                                    <h3>

                                        Edito Klubin:

                                        {{ $klubi->emri }}

                                    </h3>

                                    <form method="POST"
                                          action="{{ route('klubet.update', $klubi) }}">

                                        @csrf
                                        @method('PUT')

                                        <div class="clubs-form-grid">

                                            {{-- CLUB NAME --}}

                                            <div class="clubs-form-group">

                                                <label for="edit-emri-{{ $klubi->id }}">

                                                    Emri i Klubit

                                                </label>

                                                <input type="text"
                                                       name="emri"
                                                       id="edit-emri-{{ $klubi->id }}"
                                                       value="{{ $klubi->emri }}"
                                                       required>

                                            </div>

                                            {{-- CITY --}}

                                            <div class="clubs-form-group">

                                                <label for="edit-qyteti-{{ $klubi->id }}">

                                                    Qyteti

                                                </label>

                                                <input type="text"
                                                       name="qyteti"
                                                       id="edit-qyteti-{{ $klubi->id }}"
                                                       value="{{ $klubi->qyteti }}"
                                                       required>

                                            </div>

                                        </div>

                                        <div class="clubs-form-actions">

                                            <button type="submit"
                                                    class="clubs-btn">

                                                Ruaj Ndryshimet

                                            </button>

                                            <button type="button"
                                                    class="clubs-btn clubs-btn-gray"
                                                    onclick="toggleClubEdit({{ $klubi->id }})">

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
                                class="clubs-empty">

                                <div style="font-size:40px">

                                    🛡️

                                </div>

                                <h3>

                                    Nuk ka klube te regjistruara.

                                </h3>

                                <p>

                                    Regjistro klubin e pare
                                    duke perdorur formularin lart.

                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            @if($klubet instanceof
                \Illuminate\Contracts\Pagination\Paginator)

                <div style="margin-top:22px">

                    {{ $klubet->withQueryString()->links() }}

                </div>

            @endif

        </div>

        {{-- FOOTER --}}

        <div class="clubs-footer">

            <a class="clubs-btn clubs-btn-gray"
               href="{{ route('dashboard') }}">

                Kthehu ne Dashboard

            </a>

            <a class="clubs-btn clubs-btn-light"
               href="{{ route('kampionatet.index') }}">

                Menaxho Kampionatet

            </a>

        </div>

    </div>

    <script>
        function toggleClubEdit(id) {

            const row = document.getElementById(
                'edit-club-' + id
            );

            const button = document.getElementById(
                'club-edit-button-' + id
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
