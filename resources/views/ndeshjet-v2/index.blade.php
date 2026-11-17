@extends('layouts.club')

@section('title', 'Ndeshjet - KV Gjinoci')

@section('content')

    <style>
        .matches-v2 {
            max-width: 1350px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .matches-v2 * {
            box-sizing: border-box;
        }

        .matches-v2-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 25px;
        }

        .matches-v2-header h1 {
            margin: 0 0 5px;
            font-size: 29px;
            color: #172b4d;
            font-weight: 800;
        }

        .matches-v2-header p {
            margin: 0;
            font-size: 13px;
            color: #64748b;
        }

        .matches-v2-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #253858;
            color: #ffffff !important;
            text-decoration: none !important;
            border: none;
            border-radius: 9px;
            padding: 12px 18px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
        }

        .matches-v2-button.secondary {
            background: #edf2fa;
            color: #253858 !important;
        }

        .matches-v2-panel {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            overflow: hidden;
        }

        .matches-v2-toolbar {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .matches-v2-search {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .matches-v2-input {
            flex: 1;
            min-width: 180px;
            height: 44px;
            background: #f8fafc;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            padding: 11px 14px;
            font-size: 13px;
            color: #172b4d;
            outline: none;
        }

        .matches-v2-input:focus {
            border-color: #315b89;
            box-shadow: 0 0 0 3px rgba(49,91,137,.1);
        }

        .matches-v2-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
        }

        .matches-v2-filter {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 13px;
            border-radius: 8px;
            background: #f1f5f9;
            color: #475569 !important;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none !important;
            border: 1px solid transparent;
        }

        .matches-v2-filter.active {
            background: #e8efff;
            color: #253858 !important;
            border-color: #b8c9e4;
        }

        .matches-v2-filter span {
            background: #ffffff;
            border-radius: 6px;
            padding: 2px 7px;
            font-size: 11px;
            color: #64748b;
        }

        .matches-v2-list-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 18px 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .matches-v2-list-head h2 {
            margin: 0;
            font-size: 16px;
            color: #172b4d;
        }

        .matches-v2-list-head small {
            color: #64748b;
            font-size: 12px;
        }

        .matches-v2-item {
            display: grid;
            grid-template-columns:
            95px minmax(0, 1.4fr)
            minmax(90px, .7fr)
            minmax(100px, .65fr)
            minmax(160px, 1fr);
            gap: 18px;
            align-items: center;
            padding: 19px 20px;
            border-bottom: 1px solid #edf2f7;
        }

        .matches-v2-item:last-child {
            border-bottom: none;
        }

        .matches-v2-date {
            background: #f1f5f9;
            border-radius: 10px;
            padding: 12px 8px;
            text-align: center;
        }

        .matches-v2-date strong {
            display: block;
            font-size: 23px;
            line-height: 1.1;
            color: #253858;
        }

        .matches-v2-date small {
            display: block;
            margin-top: 5px;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .matches-v2-teams {
            min-width: 0;
        }

        .matches-v2-teams strong {
            display: block;
            font-size: 14px;
            color: #172b4d;
            overflow-wrap: anywhere;
            line-height: 1.4;
        }

        .matches-v2-teams .opponent {
            display: block;
            margin-top: 5px;
            font-size: 13px;
            color: #475569;
            overflow-wrap: anywhere;
        }

        .matches-v2-teams .location {
            display: block;
            margin-top: 7px;
            font-size: 11px;
            color: #94a3b8;
        }

        .matches-v2-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: fit-content;
            border-radius: 7px;
            padding: 8px 11px;
            font-size: 11px;
            font-weight: 700;
            background: #f1f5f9;
            color: #475569;
            white-space: nowrap;
        }

        .matches-v2-status.finished {
            background: #dcfce7;
            color: #166534;
        }

        .matches-v2-status.live {
            background: #fee2e2;
            color: #991b1b;
        }

        .matches-v2-score {
            text-align: center;
        }

        .matches-v2-score strong {
            font-size: 23px;
            font-weight: 800;
            font-variant-numeric: tabular-nums;
            color: #172b4d;
            white-space: nowrap;
        }

        .matches-v2-score small {
            display: block;
            font-size: 10px;
            color: #94a3b8;
            margin-top: 5px;
        }

        .matches-v2-actions {
            display: flex;
            flex-direction: column;
            gap: 7px;
            align-items: stretch;
        }

        .matches-v2-action {
            display: block;
            text-align: center;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            background: #253858;
            color: #ffffff !important;
            text-decoration: none !important;
            white-space: nowrap;
        }

        .matches-v2-action.secondary {
            background: #edf2fa;
            color: #253858 !important;
        }

        .matches-v2-set-results {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
            margin-top: 9px;
        }

        .matches-v2-set-results span {
            font-size: 10px;
            color: #64748b;
            padding: 4px 7px;
            background: #f1f5f9;
            border-radius: 5px;
        }

        .matches-v2-empty {
            text-align: center;
            padding: 60px 20px;
        }

        .matches-v2-empty h3 {
            color: #172b4d;
            margin-bottom: 8px;
        }

        .matches-v2-empty p {
            color: #64748b;
            font-size: 13px;
        }

        .matches-v2-footer {
            padding: 15px 20px;
            border-top: 1px solid #e2e8f0;
        }

        @media (max-width: 1100px) {
            .matches-v2-item {
                grid-template-columns:
                75px minmax(0, 1fr) 100px;
                gap: 14px;
            }

            .matches-v2-status {
                grid-column: 2;
                grid-row: 2;
            }

            .matches-v2-score {
                grid-column: 3;
                grid-row: 1;
            }

            .matches-v2-actions {
                grid-column: 3;
                grid-row: 2;
            }
        }

        @media (max-width: 650px) {
            .matches-v2-header h1 {
                font-size: 25px;
            }

            .matches-v2-item {
                grid-template-columns: 65px minmax(0, 1fr);
                gap: 12px;
                padding: 16px;
            }

            .matches-v2-date {
                grid-column: 1;
                grid-row: 1;
            }

            .matches-v2-date strong {
                font-size: 20px;
            }

            .matches-v2-teams {
                grid-column: 2;
                grid-row: 1;
            }

            .matches-v2-status {
                grid-column: 1;
                grid-row: 2;
                font-size: 10px;
                padding: 7px 8px;
            }

            .matches-v2-score {
                grid-column: 2;
                grid-row: 2;
                text-align: left;
            }

            .matches-v2-actions {
                grid-column: 1 / -1;
                grid-row: 3;
                flex-direction: row;
            }

            .matches-v2-action {
                flex: 1;
            }

            .matches-v2-toolbar,
            .matches-v2-list-head {
                padding: 16px;
            }
        }
    </style>

    <div class="matches-v2">

        <div class="matches-v2-header">

            <div>
                <h1>Ndeshjet</h1>
                <p>
                    Menaxho ndeshjet, rezultatet
                    dhe aktivitetin LIVE.
                </p>
            </div>

            @if(\Illuminate\Support\Facades\Route::has('ndeshjet.index'))
                <a
                    class="matches-v2-button"
                    href="{{ route('ndeshjet.index') }}"
                >
                    + Menaxho Ndeshjet
                </a>
            @endif

        </div>

        <div class="matches-v2-panel">

            {{-- SEARCH DHE FILTRA --}}

            <div class="matches-v2-toolbar">

                <form
                    method="GET"
                    action="{{ route('ndeshjet-v2.index') }}"
                    class="matches-v2-search"
                >
                    <input
                        type="search"
                        name="search"
                        value="{{ $search }}"
                        class="matches-v2-input"
                        placeholder="Kerko ekipin ose kundershtarin..."
                        maxlength="100"
                        aria-label="Kerko ndeshje"
                    >

                    <input
                        type="hidden"
                        name="status"
                        value="{{ $filter }}"
                    >

                    <button
                        type="submit"
                        class="matches-v2-button"
                    >
                        Kerko
                    </button>

                    <a
                        href="{{ route('ndeshjet-v2.index') }}"
                        class="matches-v2-button secondary"
                    >
                        Pastro
                    </a>
                </form>

                <div class="matches-v2-filters">

                    @foreach([
                        'all' => 'Te gjitha',
                        'pending' => 'Pa rezultat',
                        'live' => 'LIVE',
                        'finished' => 'Perfunduar',
                    ] as $key => $label)

                        <a
                            href="{{ route('ndeshjet-v2.index', [
                            'status' => $key,
                            'search' => $search,
                        ]) }}"
                            class="matches-v2-filter
                            {{ $filter === $key
                                ? 'active'
                                : '' }}"
                        >
                            {{ $label }}

                            <span>
                            {{ $counts[$key] }}
                        </span>
                        </a>

                    @endforeach

                </div>

            </div>

            {{-- LISTA --}}

            <div class="matches-v2-list-head">
                <h2>Lista e Ndeshjeve</h2>

                <small>
                    {{ $paginated->total() }} ndeshje
                </small>
            </div>

            <div class="matches-v2-list">

                @forelse($paginated as $row)

                    @php
                        $ndeshja = $row['ndeshja'];

                        $date = $ndeshja->data_ndeshjes
                            ? \Carbon\Carbon::parse(
                                $ndeshja->data_ndeshjes
                            )
                            : null;
                    @endphp

                    <article class="matches-v2-item">

                        {{-- DATA --}}

                        <div class="matches-v2-date">

                            <strong>
                                {{ $date
                                    ? $date->format('d')
                                    : '–' }}
                            </strong>

                            <small>
                                {{ $date
                                    ? $date->locale('sq')
                                        ->translatedFormat('M Y')
                                    : 'Pa date' }}
                            </small>

                        </div>

                        {{-- EKIPET --}}

                        <div class="matches-v2-teams">

                            <strong>
                                {{ $ndeshja->ekipi?->emri
                                    ?? 'KV Gjinoci' }}
                            </strong>

                            <span class="opponent">
                            vs {{ $ndeshja->kundershtari }}
                        </span>

                            @if($ndeshja->palestra)
                                <span class="location">
                                {{ $ndeshja->palestra }}
                            </span>
                            @endif

                            @if(count($row['sets']) > 0)

                                <div class="matches-v2-set-results">

                                    @foreach($row['sets'] as $set)

                                        <span>
                                        S{{ $set['number'] }}:
                                        {{ $set['home'] }}-{{ $set['away'] }}
                                    </span>

                                    @endforeach

                                </div>

                            @endif

                        </div>

                        {{-- STATUSI --}}

                        <div
                            class="matches-v2-status
                            {{ $row['status'] }}"
                        >

                            @if($row['status'] === 'live')
                                ● LIVE
                            @elseif($row['status'] === 'finished')
                                Perfunduar
                            @else
                                Pa rezultat
                            @endif

                        </div>

                        {{-- REZULTATI --}}

                        <div class="matches-v2-score">

                            @if(
                                $row['result_home'] !== null
                                && $row['result_away'] !== null
                                && in_array(
                                    $row['status'],
                                    ['finished', 'live'],
                                    true
                                )
                            )

                                <strong>
                                    {{ $row['result_home'] }}
                                    :
                                    {{ $row['result_away'] }}
                                </strong>

                                <small>
                                    Rezultati ne sete
                                </small>

                            @else

                                <strong>– : –</strong>

                            @endif

                        </div>

                        {{-- VEPRIMET --}}

                        <div class="matches-v2-actions">

                            @if($row['legacy'])

                                <a
                                    href="{{ route('ndeshjet.index') }}"
                                    class="matches-v2-action"
                                >
                                    Ndeshjet
                                </a>

                            @else

                                <a
                                    href="{{ route(
                                    'match-center.show',
                                    $ndeshja
                                ) }}"
                                    class="matches-v2-action"
                                >
                                    {{ $row['status'] === 'live'
                                        ? 'Hape LIVE'
                                        : 'Match Center' }}
                                </a>

                            @endif

                            @if(
                                \Illuminate\Support\Facades\Route::has(
                                    'formacionet.index'
                                )
                            )

                                <a
                                    href="{{ route(
                                    'formacionet.index',
                                    $ndeshja
                                ) }}"
                                    class="matches-v2-action secondary"
                                >
                                    Formacioni 6+1
                                </a>

                            @endif

                        </div>

                    </article>

                @empty

                    <div class="matches-v2-empty">
                        <h3>Nuk u gjet asnje ndeshje.</h3>

                        <p>
                            Ndrysho filtrat ose provo
                            nje emer tjeter ne kerkim.
                        </p>
                    </div>

                @endforelse

            </div>

            <div class="matches-v2-footer">
                {{ $paginated->links() }}
            </div>

        </div>

    </div>

@endsection
