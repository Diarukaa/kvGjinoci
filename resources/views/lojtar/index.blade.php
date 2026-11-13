@extends('layouts.club')

@section('title', 'Volejbollistet - KV Gjinoci')

@section('content')

    <style>
        .players-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
        }

        .players-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .players-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .players-header h1 {
            font-size: 30px;
            margin: 0 0 8px;
            color: #172b4d;
        }

        .players-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .add-player {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 20px;
            background: #253858;
            color: white !important;
            text-decoration: none !important;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
            white-space: nowrap;
        }

        .add-player:hover {
            background: #172b4d;
            transform: translateY(-2px);
        }

        /* STATISTICS */

        .players-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .player-stat-card {
            background: white;
            padding: 23px;
            border: 1px solid #e8edf5;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(15,23,42,0.035);
        }

        .player-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .player-stat-label {
            color: #64748b;
            font-size: 14px;
        }

        .player-stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
        }

        .player-stat-blue {
            color: #2563eb;
            background: #e8efff;
        }

        .player-stat-green {
            color: #059669;
            background: #e5f8ef;
        }

        .player-stat-purple {
            color: #7c3aed;
            background: #f1eaff;
        }

        .player-stat-card h2 {
            font-size: 35px;
            margin: 15px 0 8px;
            color: #172b4d;
        }

        .player-stat-card small {
            color: #94a3b8;
            font-size: 12px;
        }

        /* SEARCH */

        .players-search-card {
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 15px;
            padding: 23px;
            margin-bottom: 25px;
        }

        .players-search-card h2 {
            font-size: 18px;
            margin: 0 0 17px;
        }

        .players-search {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .players-search input {
            flex: 1;
            min-width: 0;
            padding: 13px 15px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            font-size: 14px;
            background: #f8fafc;
            outline: none;
        }

        .players-search input:focus {
            border-color: #2563eb;
            background: white;
        }

        .players-search button {
            padding: 13px 22px;
            border: 0;
            border-radius: 9px;
            color: white;
            background: #253858;
            cursor: pointer;
            font-weight: 600;
        }

        .players-clear {
            padding: 11px 17px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            color: #64748b !important;
            text-decoration: none !important;
            font-size: 14px;
        }

        /* PLAYERS TABLE */

        .players-table-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #e8edf5;
            box-shadow: 0 4px 15px rgba(15,23,42,0.035);
        }

        .players-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .players-table-header h2 {
            margin: 0 0 5px;
            font-size: 20px;
        }

        .players-table-header p {
            font-size: 13px;
            color: #64748b;
            margin: 0;
        }

        .players-count {
            background: #eef2ff;
            color: #3b5eaa;
            font-size: 12px;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 20px;
        }

        .players-table-scroll {
            overflow-x: auto;
        }

        .players-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        .players-table th {
            background: #253858;
            color: white;
            font-size: 13px;
            padding: 16px 14px;
            text-align: left;
            white-space: nowrap;
        }

        .players-table th:first-child {
            border-radius: 9px 0 0 0;
        }

        .players-table th:last-child {
            border-radius: 0 9px 0 0;
        }

        .players-table td {
            padding: 17px 14px;
            border-bottom: 1px solid #edf0f5;
            vertical-align: middle;
            font-size: 14px;
        }

        .players-table tbody tr:hover {
            background: #f8fafc;
        }

        /* JERSEY NUMBER */

        .jersey-number {
            width: 43px;
            height: 43px;
            background: #172b4d;
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 15px;
        }

        /* PLAYER INFORMATION */

        .player-name-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .player-avatar {
            width: 43px;
            height: 43px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            background: #e8efff;
            font-weight: bold;
            font-size: 14px;
            flex-shrink: 0;
        }

        .player-name-info strong {
            font-size: 14px;
            color: #172b4d;
        }

        .player-name-info small {
            display: block;
            margin-top: 5px;
            color: #64748b;
            font-size: 11px;
        }

        .player-email {
            font-size: 13px;
            color: #64748b;
        }

        /* POSITION LABELS */

        .position-label {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .position-setter {
            background: #e8efff;
            color: #2563eb;
        }

        .position-libero {
            background: #fff1df;
            color: #b45309;
        }

        .position-outside {
            background: #e5f8ef;
            color: #047857;
        }

        .position-opposite {
            background: #f1eaff;
            color: #7c3aed;
        }

        .position-middle {
            background: #ffe4e6;
            color: #be123c;
        }

        .position-default {
            background: #f1f5f9;
            color: #64748b;
        }

        /* ACTION BUTTONS */

        .player-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .player-actions form {
            margin: 0;
        }

        .player-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 12px;
            border: 0;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none !important;
            transition: 0.2s;
            white-space: nowrap;
        }

        .player-view {
            background: #e8efff;
            color: #2563eb !important;
        }

        .player-edit {
            background: #edf2f7;
            color: #253858 !important;
        }

        .player-delete {
            background: #fff0f0;
            color: #dc2626 !important;
        }

        .player-action:hover {
            filter: brightness(0.94);
        }

        .players-empty {
            text-align: center;
            padding: 45px !important;
            color: #64748b;
        }

        .players-pagination {
            margin-top: 23px;
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {
            .players-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .players-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .players-stats {
                grid-template-columns: 1fr;
            }

            .players-search {
                flex-wrap: wrap;
            }

            .players-search input {
                flex-basis: 100%;
            }

            .players-table-card {
                padding: 15px;
            }

            .players-header h1 {
                font-size: 25px;
            }
        }
    </style>

    <div class="players-page">

        {{-- STATISTIKAT E FAQES AKTUALE --}}

        @php
            $lojtaretFaqja = $lojtaret->getCollection();

            $pozicionetFaqja = $lojtaretFaqja
                ->pluck('pozicioni')
                ->filter()
                ->unique()
                ->count();

            $gjatesiaMesatare = $lojtaretFaqja
                ->whereNotNull('gjatesia')
                ->avg('gjatesia');
        @endphp

        {{-- PAGE HEADER --}}

        <div class="players-header">

            <div>
                <h1>Volejbollistet</h1>

                <p>
                    Menaxho lojtaret dhe stafin sportiv
                    te klubit KV Gjinoci.
                </p>
            </div>

            <a class="add-player"
               href="{{ route('lojtar.create') }}">

                + Shto Volejbolliste

            </a>

        </div>

        {{-- STATISTICS --}}

        <div class="players-stats">

            <div class="player-stat-card">

                <div class="player-stat-top">

                <span class="player-stat-label">
                    Total Volejbolliste
                </span>

                    <div class="player-stat-icon player-stat-blue">
                        👥
                    </div>

                </div>

                <h2>{{ $lojtaret->total() }}</h2>

                <small>Volejbolliste ne liste</small>

            </div>

            <div class="player-stat-card">

                <div class="player-stat-top">

                <span class="player-stat-label">
                    Pozicione
                </span>

                    <div class="player-stat-icon player-stat-purple">
                        🏐
                    </div>

                </div>

                <h2>{{ $pozicionetFaqja }}</h2>

                <small>Pozicione ne faqen aktuale</small>

            </div>

            <div class="player-stat-card">

                <div class="player-stat-top">

                <span class="player-stat-label">
                    Gjatesia Mesatare
                </span>

                    <div class="player-stat-icon player-stat-green">
                        📏
                    </div>

                </div>

                <h2>
                    @if($gjatesiaMesatare !== null)
                        {{ number_format($gjatesiaMesatare, 1) }}
                        <span style="font-size:16px">cm</span>
                    @else
                        -
                    @endif
                </h2>

                <small>Mesatarja ne faqen aktuale</small>

            </div>

        </div>

        {{-- SEARCH --}}

        <div class="players-search-card">

            <h2>Kerko Volejbolliste</h2>

            <form method="GET"
                  action="{{ route('lojtar.index') }}"
                  class="players-search">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Kerko sipas emrit ose mbiemrit...">

                <button type="submit">
                    Kerko
                </button>

                <a class="players-clear"
                   href="{{ route('lojtar.index') }}">

                    Pastro

                </a>

            </form>

        </div>

        {{-- PLAYERS TABLE --}}

        <div class="players-table-card">

            <div class="players-table-header">

                <div>
                    <h2>Lista e Volejbollisteve</h2>

                    <p>
                        Te dhenat e lojtareve te regjistruara.
                    </p>
                </div>

                <span class="players-count">
                {{ $lojtaret->total() }} lojtare
            </span>

            </div>

            <div class="players-table-scroll">

                <table class="players-table">

                    <thead>

                    <tr>
                        <th>Fanella</th>
                        <th>Volejbollistja</th>
                        <th>Pozicioni</th>
                        <th>Gjatesia</th>
                        <th>Email</th>
                        <th>Veprimet</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($lojtaret as $lojtar)

                        @php
                            $positionClass = match($lojtar->pozicioni) {
                                'Setter' => 'position-setter',
                                'Libero' => 'position-libero',
                                'Outside Hitter' => 'position-outside',
                                'Opposite Hitter' => 'position-opposite',
                                'Middle Blocker' => 'position-middle',
                                default => 'position-default',
                            };
                        @endphp

                        <tr>

                            {{-- JERSEY NUMBER --}}

                            <td>

                                <div class="jersey-number">

                                    #{{ $lojtar->numriFanelles }}

                                </div>

                            </td>

                            {{-- PLAYER NAME --}}

                            <td>

                                <div class="player-name-cell">

                                    <div class="player-avatar">

                                        {{ mb_strtoupper(
                                            mb_substr($lojtar->emri, 0, 1)
                                            .
                                            mb_substr($lojtar->mbiemri, 0, 1)
                                        ) }}

                                    </div>

                                    <div class="player-name-info">

                                        <strong>
                                            {{ $lojtar->emri }}
                                            {{ $lojtar->mbiemri }}
                                        </strong>

                                        <small>Volejbolliste</small>

                                    </div>

                                </div>

                            </td>

                            {{-- POSITION --}}

                            <td>

                                <span class="position-label {{ $positionClass }}">

                                    {{ $lojtar->pozicioni ?? 'Pa pozicion' }}

                                </span>

                            </td>

                            {{-- HEIGHT --}}

                            <td>

                                @if($lojtar->gjatesia)

                                    <strong>
                                        {{ $lojtar->gjatesia }}
                                    </strong>

                                    <span style="color:#94a3b8">
                                        cm
                                    </span>

                                @else

                                    -

                                @endif

                            </td>

                            {{-- EMAIL --}}

                            <td>

                                <span class="player-email">

                                    {{ $lojtar->email }}

                                </span>

                            </td>

                            {{-- ACTIONS --}}

                            <td>

                                <div class="player-actions">

                                    <a class="player-action player-view"
                                       href="{{ route('lojtar.show', $lojtar) }}">

                                        Profili

                                    </a>

                                    <a class="player-action player-edit"
                                       href="{{ route('lojtar.edit', $lojtar) }}">

                                        Edito

                                    </a>

                                    <form method="POST"
                                          action="{{ route('lojtar.destroy', $lojtar) }}"
                                          onsubmit="return confirm('A je i sigurt qe deshiron ta fshish volejbollisten?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="player-action player-delete">

                                            Fshi

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="players-empty">

                                <h3>Nuk ka volejbolliste.</h3>

                                <p>
                                    Regjistro nje volejbolliste
                                    ose ndrysho kerkimin.
                                </p>

                                <a class="add-player"
                                   href="{{ route('lojtar.create') }}">

                                    + Shto Volejbolliste

                                </a>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="players-pagination">

                {{ $lojtaret->appends(request()->query())->links() }}

            </div>

        </div>

    </div>

@endsection
