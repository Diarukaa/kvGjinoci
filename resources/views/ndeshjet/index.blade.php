@extends('layouts.club')

@section('title', 'Ndeshjet - KV Gjinoci')

@section('content')

    <style>
        .matches-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .matches-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .matches-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .matches-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .matches-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .match-add-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #253858;
            color: white !important;
            padding: 13px 20px;
            border-radius: 9px;
            font-weight: bold;
            font-size: 14px;
            text-decoration: none !important;
            white-space: nowrap;
            transition: .2s;
        }

        .match-add-btn:hover {
            background: #172b4d;
            transform: translateY(-2px);
        }

        /* STATISTICS */

        .matches-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 17px;
            margin-bottom: 28px;
        }

        .match-stat {
            background: white;
            padding: 21px;
            border-radius: 14px;
            border: 1px solid #e5ebf3;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .match-stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
        }

        .match-stat-label {
            color: #64748b;
            font-size: 13px;
        }

        .match-stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            font-size: 21px;
            flex-shrink: 0;
        }

        .match-stat h2 {
            font-size: 35px;
            color: #172b4d;
            margin: 14px 0 6px;
        }

        .match-stat small {
            color: #94a3b8;
            font-size: 12px;
        }

        .match-icon-green {
            background: #e5f8ef;
        }

        .match-icon-red {
            background: #fff0f0;
        }

        .match-icon-purple {
            background: #f1eaff;
        }

        /* MATCH CARDS */

        .matches-section-title {
            font-size: 22px;
            color: #172b4d;
            margin: 0 0 18px;
        }

        .matches-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .match-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e5ebf3;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
            transition: .2s;
        }

        .match-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(15,23,42,.07);
        }

        .match-card-top {
            background: linear-gradient(
                130deg,
                #172b4d,
                #315b89
            );

            color: white;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .match-date {
            font-size: 13px;
            color: #dbeafe;
        }

        .match-status {
            display: inline-block;
            border-radius: 7px;
            padding: 7px 11px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status-win {
            background: #dcfce7;
            color: #047857;
        }

        .status-loss {
            background: #ffe4e6;
            color: #be123c;
        }

        .status-planned {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-neutral {
            background: #edf2f7;
            color: #475569;
        }

        .match-card-body {
            padding: 23px;
        }

        /* SCOREBOARD */

        .match-scoreboard {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto minmax(0, 1fr);
            align-items: center;
            gap: 15px;
            text-align: center;
            margin-bottom: 22px;
        }

        .match-team {
            min-width: 0;
        }

        .match-team strong {
            display: block;
            color: #172b4d;
            font-size: 15px;
            overflow-wrap: anywhere;
        }

        .match-team small {
            display: block;
            color: #94a3b8;
            font-size: 11px;
            margin-top: 6px;
        }

        .match-team-logo {
            background: #e8efff;
            width: 65px;
            height: 65px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 13px;
            font-size: 30px;
        }

        .match-opponent-logo {
            background: #f1f5f9;
        }

        .match-score {
            background: #172b4d;
            color: white;
            border-radius: 12px;
            padding: 16px 19px;
            font-size: 29px;
            font-weight: bold;
            white-space: nowrap;
        }

        .match-score-label {
            display: block;
            color: #94a3b8;
            font-size: 10px;
            margin-top: 8px;
            text-align: center;
        }

        /* MATCH INFORMATION */

        .match-info {
            background: #f8fafc;
            border: 1px solid #edf0f5;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 19px;
        }

        .match-info-item {
            flex: 1;
            min-width: 85px;
        }

        .match-info-item small {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-bottom: 6px;
        }

        .match-info-item strong {
            font-size: 13px;
            color: #172b4d;
        }

        /* ACTION BUTTONS */

        .match-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 8px;
        }

        .match-actions form {
            margin: 0;
        }

        .match-action {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 10px 14px;
            border-radius: 8px;
            border: none;
            text-decoration: none !important;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .match-action:hover {
            filter: brightness(.94);
        }

        .match-view {
            background: #e8efff;
            color: #2563eb !important;
        }

        .match-edit {
            background: #edf2f7;
            color: #253858 !important;
        }

        .match-delete {
            background: #fff0f0;
            color: #dc2626 !important;
        }

        .matches-empty {
            grid-column: 1 / -1;
            padding: 45px;
            text-align: center;
            background: white;
            border-radius: 15px;
            color: #64748b;
        }

        .matches-empty h2 {
            color: #172b4d;
        }

        .matches-pagination {
            margin-top: 25px;
        }

        .matches-alert {
            background: #dcfce7;
            color: #166534;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        /* RESPONSIVE */

        @media (max-width: 1050px) {
            .matches-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 850px) {
            .matches-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 550px) {
            .matches-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .matches-header h1 {
                font-size: 25px;
            }

            .match-stat {
                padding: 15px;
            }

            .match-stat-icon {
                width: 34px;
                height: 34px;
                font-size: 17px;
            }

            .match-stat h2 {
                font-size: 28px;
            }

            .match-card-body {
                padding: 17px;
            }

            .match-score {
                font-size: 22px;
                padding: 12px;
            }

            .match-team-logo {
                width: 45px;
                height: 45px;
                font-size: 23px;
            }

            .match-scoreboard {
                gap: 8px;
            }
        }

        @media (max-width: 380px) {
            .matches-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="matches-page">

        @php
            $lista = $ndeshjet instanceof \Illuminate\Contracts\Pagination\Paginator
                ? $ndeshjet->getCollection()
                : collect($ndeshjet);

            $fitore = $lista->filter(fn ($n) =>
                $n->statusi === 'Perfunduar' &&
                $n->setet_tona > $n->setet_kundershtarit
            )->count();

            $humbje = $lista->filter(fn ($n) =>
                $n->statusi === 'Perfunduar' &&
                $n->setet_tona < $n->setet_kundershtarit
            )->count();

            $planifikuara = $lista
                ->where('statusi', 'Planifikuar')
                ->count();
        @endphp

        {{-- TITULLI --}}

        <div class="matches-header">

            <div>

                <h1>Menaxhimi i Ndeshjeve</h1>

                <p>
                    Orari, rezultatet dhe aktivitetet
                    sportive te KV Gjinocit.
                </p>

            </div>

            <a class="match-add-btn"
               href="{{ route('ndeshjet.create') }}">

                + Shto Ndeshje

            </a>

        </div>

        {{-- STATISTIKAT --}}

        <div class="matches-stats">

            <div class="match-stat">

                <div class="match-stat-top">

                <span class="match-stat-label">
                    Ndeshje ne Liste
                </span>

                    <span class="match-stat-icon">
                    🏐
                </span>

                </div>

                <h2>{{ $lista->count() }}</h2>

                <small>Ndeshjet e shfaqura</small>

            </div>

            <div class="match-stat">

                <div class="match-stat-top">

                <span class="match-stat-label">
                    Fitore
                </span>

                    <span class="match-stat-icon match-icon-green">
                    🏆
                </span>

                </div>

                <h2>{{ $fitore }}</h2>

                <small>Ndeshje te fituara ne liste</small>

            </div>

            <div class="match-stat">

                <div class="match-stat-top">

                <span class="match-stat-label">
                    Humbje
                </span>

                    <span class="match-stat-icon match-icon-red">
                    📉
                </span>

                </div>

                <h2>{{ $humbje }}</h2>

                <small>Ndeshje te humbura ne liste</small>

            </div>

            <div class="match-stat">

                <div class="match-stat-top">

                <span class="match-stat-label">
                    Planifikuara
                </span>

                    <span class="match-stat-icon match-icon-purple">
                    📅
                </span>

                </div>

                <h2>{{ $planifikuara }}</h2>

                <small>Ndeshje te ardhshme ne liste</small>

            </div>

        </div>

        {{-- LISTA E NDESHJEVE --}}

        <h2 class="matches-section-title">
            Ndeshjet e Regjistruara
        </h2>

        <div class="matches-grid">

            @forelse($ndeshjet as $ndeshja)

                @php
                    $perfunduar =
                        $ndeshja->statusi === 'Perfunduar';

                    $fituar = $perfunduar &&
                        $ndeshja->setet_tona >
                        $ndeshja->setet_kundershtarit;

                    $humbur = $perfunduar &&
                        $ndeshja->setet_tona <
                        $ndeshja->setet_kundershtarit;

                    $dataNdeshjes = \Carbon\Carbon::parse(
                        $ndeshja->data_ndeshjes
                    );
                @endphp

                <div class="match-card">

                    {{-- HEADER I NDESHJES --}}

                    <div class="match-card-top">

                    <span class="match-date">

                        📅 {{ $dataNdeshjes->format('d.m.Y H:i') }}

                    </span>

                        @if($fituar)

                            <span class="match-status status-win">
                            Fitore
                        </span>

                        @elseif($humbur)

                            <span class="match-status status-loss">
                            Humbje
                        </span>

                        @elseif($perfunduar)

                            <span class="match-status status-neutral">
                            Perfunduar
                        </span>

                        @else

                            <span class="match-status status-planned">
                            {{ $ndeshja->statusi }}
                        </span>

                        @endif

                    </div>

                    {{-- BODY I NDESHJES --}}

                    <div class="match-card-body">

                        {{-- SCOREBOARD --}}

                        <div class="match-scoreboard">

                            {{-- EKIPI --}}

                            <div class="match-team">

                                <div class="match-team-logo">
                                    🛡️
                                </div>

                                <strong>

                                    {{ $ndeshja->ekipi?->emri
                                        ?? 'Pa ekip' }}

                                </strong>

                                <small>
                                    Ekipi yne
                                </small>

                            </div>

                            {{-- REZULTATI --}}

                            <div>

                                <div class="match-score">

                                    @if($perfunduar)

                                        {{ $ndeshja->setet_tona }}

                                        :

                                        {{ $ndeshja->setet_kundershtarit }}

                                    @else

                                        VS

                                    @endif

                                </div>

                                <small class="match-score-label">

                                    {{ $perfunduar
                                        ? 'REZULTATI FINAL'
                                        : 'NDESHJE E PLANIFIKUAR' }}

                                </small>

                            </div>

                            {{-- KUNDERSHTARI --}}

                            <div class="match-team">

                                <div class="match-team-logo match-opponent-logo">
                                    🏐
                                </div>

                                <strong>

                                    {{ $ndeshja->kundershtari }}

                                </strong>

                                <small>
                                    Kundershtari
                                </small>

                            </div>

                        </div>

                        {{-- INFORMACIONET --}}

                        <div class="match-info">

                            <div class="match-info-item">

                                <small>Palestra</small>

                                <strong>

                                    {{ $ndeshja->palestra ?? '-' }}

                                </strong>

                            </div>

                            <div class="match-info-item">

                                <small>Lokacioni</small>

                                <strong>

                                    {{ $ndeshja->lokacioni }}

                                </strong>

                            </div>

                            <div class="match-info-item">

                                <small>Sezoni</small>

                                <strong>

                                    {{ $ndeshja->sezoni?->emri
                                        ?? 'Pa sezon' }}

                                </strong>

                            </div>

                        </div>

                        {{-- BUTONAT --}}

                        <div class="match-actions">

                            <a class="match-action match-view"
                               href="{{ route('ndeshjet.show', $ndeshja) }}">

                                Detajet

                            </a>

                            <a class="match-action match-edit"
                               href="{{ route('ndeshjet.edit', $ndeshja) }}">

                                Edito

                            </a>

                            <form method="POST"
                                  action="{{ route('ndeshjet.destroy', $ndeshja) }}"
                                  onsubmit="return confirm('A je i sigurt qe deshiron ta fshish ndeshjen?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="match-action match-delete">

                                    Fshi

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="matches-empty">

                    <div style="font-size:50px">

                        🏐

                    </div>

                    <h2>Nuk ka ndeshje te regjistruara.</h2>

                    <p>

                        Regjistro ndeshjen e pare
                        te klubit KV Gjinoci.

                    </p>

                    <a class="match-add-btn"
                       href="{{ route('ndeshjet.create') }}">

                        + Shto Ndeshje

                    </a>

                </div>

            @endforelse

        </div>

        {{-- PAGINATION --}}

        @if($ndeshjet instanceof \Illuminate\Contracts\Pagination\Paginator)

            <div class="matches-pagination">

                {{ $ndeshjet->withQueryString()->links() }}

            </div>

        @endif

    </div>

@endsection
