@extends('layouts.club')

@section('title', 'Stervitjet - KV Gjinoci')

@section('content')

    <style>
        .training-page {
            max-width: 1400px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .training-page * {
            box-sizing: border-box;
        }

        /* HEADER */

        .training-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 28px;
        }

        .training-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .training-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .training-btn {
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

        .training-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .training-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .training-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        .training-btn-danger {
            background: #fff0f0;
            color: #dc2626 !important;
        }

        .training-btn-green {
            background: #dcfce7;
            color: #047857 !important;
        }

        /* STATISTICS */

        .training-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .training-stat {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .training-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .training-stat-label {
            color: #64748b;
            font-size: 13px;
        }

        .training-stat-icon {
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

        .training-icon-purple {
            background: #f1eaff;
        }

        .training-icon-green {
            background: #dcfce7;
        }

        .training-icon-orange {
            background: #fff1df;
        }

        .training-stat h2 {
            font-size: 35px;
            color: #172b4d;
            margin: 15px 0 6px;
        }

        .training-stat small {
            color: #64748b;
            font-size: 12px;
        }

        /* CONTENT CARDS */

        .training-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .training-card h2 {
            font-size: 22px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .training-description {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 22px;
            line-height: 1.6;
        }

        /* FILTERS */

        .training-filter {
            display: flex;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 15px;
        }

        .training-filter-group {
            flex: 1;
            min-width: 180px;
        }

        .training-page .training-filter-group label {
            display: block;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .training-page .training-filter-group select {
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

        .training-page .training-filter-group select:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        /* TABLE HEADER */

        .training-table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 22px;
        }

        .training-table-header h2 {
            margin: 0 0 7px;
        }

        .training-table-header p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
        }

        .training-count {
            background: #e8efff;
            color: #2563eb;
            padding: 9px 14px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
        }

        /* TABLE */

        .training-table-scroll {
            overflow-x: auto;
        }

        .training-table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
        }

        .training-table th {
            background: #253858;
            color: white;
            padding: 16px 13px;
            font-size: 13px;
            text-align: left;
            white-space: nowrap;
        }

        .training-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .training-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .training-table td {
            color: #172b4d;
            padding: 17px 13px;
            font-size: 14px;
            border-bottom: 1px solid #edf0f5;
            vertical-align: middle;
        }

        .training-table tbody tr:hover {
            background: #f8fafc;
        }

        /* DATE */

        .training-date {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .training-date-box {
            width: 46px;
            height: 50px;
            border-radius: 10px;
            background: #e8efff;
            color: #253858;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            flex-shrink: 0;
        }

        .training-date-box strong {
            font-size: 19px;
            line-height: 1;
        }

        .training-date-box small {
            font-size: 10px;
            margin-top: 4px;
            font-weight: bold;
        }

        .training-date-text strong {
            display: block;
            color: #172b4d;
            font-size: 13px;
            white-space: nowrap;
        }

        .training-date-text small {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-top: 5px;
            white-space: nowrap;
        }

        /* TIME */

        .training-time {
            background: #f1f5f9;
            color: #475569;
            padding: 8px 11px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }

        /* TEAM */

        .training-team {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .training-team-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            border-radius: 9px;
            font-size: 18px;
            flex-shrink: 0;
        }

        .training-team strong {
            font-size: 13px;
            color: #172b4d;
            white-space: nowrap;
        }

        /* COACH */

        .training-coach {
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .training-coach-avatar {
            width: 33px;
            height: 33px;
            background: #edf2f7;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 11px;
            font-weight: bold;
            flex-shrink: 0;
        }

        /* LOCATION */

        .training-location {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #64748b;
            font-size: 13px;
        }

        /* TYPE */

        .training-type {
            background: #edf4ff;
            color: #315b89;
            padding: 8px 11px;
            border-radius: 7px;
            display: inline-block;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .training-type-physical {
            background: #fff1df;
            color: #a16207;
        }

        .training-type-friendly {
            background: #f1eaff;
            color: #7c3aed;
        }

        /* STATUS */

        .training-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 7px;
            padding: 8px 11px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .training-status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
            flex-shrink: 0;
        }

        .training-completed {
            background: #dcfce7;
            color: #047857;
        }

        .training-planned {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .training-cancelled {
            background: #ffe4e6;
            color: #be123c;
        }

        .training-neutral {
            background: #edf2f7;
            color: #64748b;
        }

        /* ACTIONS */

        .training-actions {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }

        .training-actions form {
            margin: 0;
        }

        .training-actions .training-btn {
            padding: 9px 11px;
            font-size: 12px;
        }

        /* EMPTY STATE */

        .training-empty {
            text-align: center;
            padding: 40px !important;
            color: #64748b !important;
        }

        .training-empty h3 {
            font-size: 19px;
            color: #172b4d;
        }

        /* ALERTS */

        .training-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .training-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .training-errors ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        /* PAGINATION */

        .training-pagination {
            margin-top: 22px;
        }

        /* FOOTER */

        .training-footer {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {

            .training-stats {
                grid-template-columns: repeat(
                2, minmax(0, 1fr)
            );
            }

        }

        @media (max-width: 600px) {

            .training-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .training-header h1 {
                font-size: 25px;
            }

            .training-stats {
                gap: 12px;
            }

            .training-stat {
                padding: 16px;
            }

            .training-stat h2 {
                font-size: 28px;
            }

            .training-stat-icon {
                width: 35px;
                height: 35px;
                font-size: 17px;
            }

            .training-filter-group {
                flex-basis: 100%;
            }

            .training-card {
                padding: 17px;
            }

        }

        @media (max-width: 380px) {

            .training-stats {
                grid-template-columns: 1fr;
            }

        }
    </style>

    <div class="training-page">

        @php
            $listaStervitjeve = $stervitjet instanceof
                \Illuminate\Contracts\Pagination\Paginator
                    ? $stervitjet->getCollection()
                    : collect($stervitjet);

            $totalStervitje = $stervitjet instanceof
                \Illuminate\Contracts\Pagination\LengthAwarePaginator
                    ? $stervitjet->total()
                    : $listaStervitjeve->count();

            $planifikuara = $listaStervitjeve
                ->where('statusi', 'Planifikuar')
                ->count();

            $perfunduara = $listaStervitjeve
                ->where('statusi', 'Perfunduar')
                ->count();

            $ekipeNeListe = $listaStervitjeve
                ->pluck('ekipi_id')
                ->filter()
                ->unique()
                ->count();

            $muajt = [
                1 => 'Jan',
                2 => 'Shk',
                3 => 'Mar',
                4 => 'Pri',
                5 => 'Maj',
                6 => 'Qer',
                7 => 'Kor',
                8 => 'Gus',
                9 => 'Sht',
                10 => 'Tet',
                11 => 'Nen',
                12 => 'Dhj'
            ];

            $statuset = collect([
                'Planifikuar',
                'Perfunduar'
            ])->merge(
                $listaStervitjeve->pluck('statusi')
            )->filter()->unique()->values();
        @endphp

        {{-- PAGE HEADER --}}

        <div class="training-header">

            <div>

                <h1>Menaxhimi i Stervitjeve</h1>

                <p>

                    Planifiko stervitjet,
                    organizo orarin dhe menaxho
                    prezencen e volejbollisteve.

                </p>

            </div>

            <a class="training-btn"
               href="{{ route('stervitjet.create') }}">

                + Shto Stervitje

            </a>

        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="training-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- ERRORS --}}

        @if(session('error'))

            <div class="training-errors">

                {{ session('error') }}

            </div>

        @endif

        @if($errors->any())

            <div class="training-errors">

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

        <div class="training-stats">

            {{-- TOTAL --}}

            <div class="training-stat">

                <div class="training-stat-top">

                <span class="training-stat-label">

                    Total Stervitje

                </span>

                    <span class="training-stat-icon">

                    🏐

                </span>

                </div>

                <h2>{{ $totalStervitje }}</h2>

                <small>

                    Stervitje sipas filtrave

                </small>

            </div>

            {{-- PLANNED --}}

            <div class="training-stat">

                <div class="training-stat-top">

                <span class="training-stat-label">

                    Planifikuara

                </span>

                    <span class="training-stat-icon training-icon-purple">

                    📅

                </span>

                </div>

                <h2>{{ $planifikuara }}</h2>

                <small>

                    Stervitje ne faqen aktuale

                </small>

            </div>

            {{-- COMPLETED --}}

            <div class="training-stat">

                <div class="training-stat-top">

                <span class="training-stat-label">

                    Perfunduar

                </span>

                    <span class="training-stat-icon training-icon-green">

                    ✅

                </span>

                </div>

                <h2>{{ $perfunduara }}</h2>

                <small>

                    Te perfunduara ne kete faqe

                </small>

            </div>

            {{-- TEAMS --}}

            <div class="training-stat">

                <div class="training-stat-top">

                <span class="training-stat-label">

                    Ekipe ne Liste

                </span>

                    <span class="training-stat-icon training-icon-orange">

                    👥

                </span>

                </div>

                <h2>{{ $ekipeNeListe }}</h2>

                <small>

                    Ekipe me stervitje

                </small>

            </div>

        </div>

        {{-- FILTERS --}}

        <div class="training-card">

            <h2>Filtro Stervitjet</h2>

            <p class="training-description">

                Kerko stervitjet sipas ekipit
                dhe statusit te tyre.

            </p>

            <form method="GET"
                  action="{{ route('stervitjet.index') }}"
                  class="training-filter">

                {{-- TEAM --}}

                <div class="training-filter-group">

                    <label for="ekipi_id">

                        Ekipi

                    </label>

                    <select name="ekipi_id"
                            id="ekipi_id">

                        <option value="">

                            Te gjitha ekipet

                        </option>

                        @foreach($ekipet as $ekipi)

                            <option value="{{ $ekipi->id }}"
                                @selected(
                                    (string) request('ekipi_id')
                                    ===
                                    (string) $ekipi->id
                                )>

                                {{ $ekipi->emri }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- STATUS --}}

                <div class="training-filter-group">

                    <label for="statusi">

                        Statusi

                    </label>

                    <select name="statusi"
                            id="statusi">

                        <option value="">

                            Te gjitha statuset

                        </option>

                        @foreach($statuset as $status)

                            <option value="{{ $status }}"
                                @selected(
                                    request('statusi') === $status
                                )>

                                {{ $status }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <button type="submit"
                        class="training-btn">

                    Filtro

                </button>

                <a class="training-btn training-btn-gray"
                   href="{{ route('stervitjet.index') }}">

                    Pastro

                </a>

            </form>

        </div>

        {{-- TRAINING SCHEDULE --}}

        <div class="training-card">

            <div class="training-table-header">

                <div>

                    <h2>Orari i Stervitjeve</h2>

                    <p>

                        Menaxho orarin, trajneret
                        dhe aktivitetet e ekipeve.

                    </p>

                </div>

                <span class="training-count">

                {{ $totalStervitje }} Stervitje

            </span>

            </div>

            <div class="training-table-scroll">

                <table class="training-table">

                    <thead>

                    <tr>

                        <th>Data</th>

                        <th>Ora</th>

                        <th>Ekipi</th>

                        <th>Trajneri</th>

                        <th>Palestra</th>

                        <th>Lloji</th>

                        <th>Statusi</th>

                        <th>Veprimet</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($stervitjet as $stervitja)

                        @php
                            $data = \Carbon\Carbon::parse(
                                $stervitja->data
                            );

                            $oraFillimit =
                                \Carbon\Carbon::parse(
                                    $stervitja->ora_fillimit
                                )->format('H:i');

                            $oraMbarimit =
                                \Carbon\Carbon::parse(
                                    $stervitja->ora_mbarimit
                                )->format('H:i');

                            $statusClass = match(
                                $stervitja->statusi
                            ) {
                                'Perfunduar' =>
                                    'training-completed',

                                'Planifikuar' =>
                                    'training-planned',

                                'Anuluar' =>
                                    'training-cancelled',

                                default =>
                                    'training-neutral'
                            };

                            $llojiClass = match(
                                $stervitja->lloji
                            ) {
                                'Fizike' =>
                                    'training-type-physical',

                                'Miqesore' =>
                                    'training-type-friendly',

                                default => ''
                            };
                        @endphp

                        <tr>

                            {{-- DATE --}}

                            <td>

                                <div class="training-date">

                                    <div class="training-date-box">

                                        <strong>

                                            {{ $data->format('d') }}

                                        </strong>

                                        <small>

                                            {{ $muajt[$data->month] }}

                                        </small>

                                    </div>

                                    <div class="training-date-text">

                                        <strong>

                                            {{ $data->format('d.m.Y') }}

                                        </strong>

                                        <small>

                                            Stervitje

                                        </small>

                                    </div>

                                </div>

                            </td>

                            {{-- TIME --}}

                            <td>

                                <span class="training-time">

                                    {{ $oraFillimit }}

                                    -

                                    {{ $oraMbarimit }}

                                </span>

                            </td>

                            {{-- TEAM --}}

                            <td>

                                <div class="training-team">

                                    <span class="training-team-icon">

                                        🏐

                                    </span>

                                    <strong>

                                        {{ $stervitja->ekipi?->emri
                                            ?? 'Pa ekip' }}

                                    </strong>

                                </div>

                            </td>

                            {{-- COACH --}}

                            <td>

                                @if($stervitja->trajner)

                                    <div class="training-coach">

                                        <div class="training-coach-avatar">

                                            {{ mb_strtoupper(
                                                mb_substr(
                                                    $stervitja->trajner->emri,
                                                    0,
                                                    1
                                                )
                                                .
                                                mb_substr(
                                                    $stervitja->trajner->mbiemri,
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        </div>

                                        <span>

                                            {{ $stervitja->trajner->emri }}

                                            {{ $stervitja->trajner->mbiemri }}

                                        </span>

                                    </div>

                                @else

                                    <span style="color:#94a3b8">

                                        Pa trajner

                                    </span>

                                @endif

                            </td>

                            {{-- LOCATION --}}

                            <td>

                                <div class="training-location">

                                    <span>📍</span>

                                    {{ $stervitja->palestra ?? '-' }}

                                </div>

                            </td>

                            {{-- TRAINING TYPE --}}

                            <td>

                                <span class="training-type {{ $llojiClass }}">

                                    {{ $stervitja->lloji }}

                                </span>

                            </td>

                            {{-- STATUS --}}

                            <td>

                                <span class="training-status {{ $statusClass }}">

                                    <span class="training-status-dot">
                                    </span>

                                    {{ $stervitja->statusi }}

                                </span>

                            </td>

                            {{-- ACTIONS --}}

                            <td>

                                <div class="training-actions">

                                    {{-- VIEW --}}

                                    <a class="training-btn training-btn-light"
                                       href="{{ route(
                                           'stervitjet.show',
                                           $stervitja
                                       ) }}">

                                        Shiko

                                    </a>

                                    {{-- ATTENDANCE --}}

                                    @if(
                                        \Illuminate\Support\Facades\Route::has(
                                            'prezencat.edit'
                                        )
                                    )

                                        <a class="training-btn training-btn-green"
                                           href="{{ route(
                                               'prezencat.edit',
                                               $stervitja
                                           ) }}">

                                            Prezenca

                                        </a>

                                    @endif

                                    {{-- EDIT --}}

                                    <a class="training-btn training-btn-gray"
                                       href="{{ route(
                                           'stervitjet.edit',
                                           $stervitja
                                       ) }}">

                                        Edito

                                    </a>

                                    {{-- DELETE --}}

                                    <form method="POST"
                                          action="{{ route(
                                              'stervitjet.destroy',
                                              $stervitja
                                          ) }}"
                                          onsubmit="return confirm('A je i sigurt qe deshiron ta fshish kete stervitje?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="training-btn training-btn-danger">

                                            Fshi

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="training-empty">

                                <div style="font-size:45px">

                                    🏐

                                </div>

                                <h3>

                                    Nuk ka stervitje.

                                </h3>

                                <p>

                                    Nuk u gjet asnje stervitje
                                    per filtrat e zgjedhur.

                                </p>

                                <a class="training-btn"
                                   href="{{ route('stervitjet.create') }}">

                                    + Shto Stervitje

                                </a>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}

            @if($stervitjet instanceof
                \Illuminate\Contracts\Pagination\Paginator)

                <div class="training-pagination">

                    {{ $stervitjet->withQueryString()->links() }}

                </div>

            @endif

        </div>

        {{-- FOOTER --}}

        <div class="training-footer">

            <a class="training-btn training-btn-gray"
               href="{{ route('dashboard') }}">

                Kthehu ne Dashboard

            </a>

            <a class="training-btn training-btn-light"
               href="{{ route('ekipet.index') }}">

                Menaxho Ekipet

            </a>

            <a class="training-btn training-btn-light"
               href="{{ route('lojtar.index') }}">

                Volejbollistet

            </a>

        </div>

    </div>

@endsection
