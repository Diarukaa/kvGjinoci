@extends('layouts.club')

@section('title', 'Ndeshjet e Mia - KV Gjinoci')

@section('content')

    <style>
        .cm-page {
            max-width: 1150px;
            margin: 0 auto;
            padding: 15px 0 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .cm-page * {
            box-sizing: border-box;
        }

        .cm-hero {
            background: linear-gradient(120deg, #172b4d, #315b89);
            border-radius: 18px;
            padding: 32px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            color: white;
        }

        .cm-hero small {
            font-size: 11px;
            color: #bfdbfe;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .cm-hero h1 {
            color: white;
            margin: 13px 0;
            font-size: 30px;
        }

        .cm-hero p {
            color: #dbeafe;
            margin: 0;
            line-height: 1.7;
            font-size: 14px;
        }

        .cm-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 17px;
            margin-bottom: 25px;
        }

        .cm-stat {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 23px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .cm-stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
        }

        .cm-stat small {
            color: #64748b;
            font-size: 13px;
        }

        .cm-icon {
            width: 38px;
            height: 38px;
            background: #e8efff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cm-stat h2 {
            margin: 15px 0 0;
            font-size: 31px;
        }

        .cm-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .cm-card h2 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        .cm-subtitle {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 23px;
        }

        .cm-match {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 17px;
        }

        .cm-match-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            color: #64748b;
            font-size: 13px;
        }

        .cm-scoreboard {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 20px;
            text-align: center;
            padding: 26px 0;
        }

        .cm-team h3 {
            font-size: 18px;
            margin: 12px 0 7px;
        }

        .cm-team small {
            color: #64748b;
            font-size: 12px;
        }

        .cm-team-icon {
            width: 50px;
            height: 50px;
            border-radius: 13px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 23px;
        }

        .cm-score {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 18px 23px;
            border-radius: 13px;
            font-size: 29px;
            font-weight: bold;
            white-space: nowrap;
        }

        .cm-badge {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: bold;
            background: #e8efff;
            color: #315b89;
        }

        .cm-win {
            background: #dcfce7;
            color: #15803d;
        }

        .cm-loss {
            background: #fee2e2;
            color: #b91c1c;
        }

        .cm-match-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            border-top: 1px solid #e2e8f0;
            padding-top: 18px;
        }

        .cm-location {
            font-size: 13px;
            color: #64748b;
            line-height: 1.8;
        }

        .cm-actions {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
        }

        .cm-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 17px;
            border-radius: 9px;
            background: #253858;
            color: white !important;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
        }

        .cm-btn:hover {
            filter: brightness(.94);
        }

        .cm-btn-light {
            background: #e8efff;
            color: #315b89 !important;
        }

        .cm-btn-white {
            background: white;
            color: #172b4d !important;
        }

        .cm-success {
            padding: 16px;
            border-radius: 10px;
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .cm-empty {
            text-align: center;
            color: #64748b;
            padding: 40px 20px;
            line-height: 1.8;
        }

        .cm-empty h3 {
            color: #172b4d;
        }

        @media(max-width: 850px) {

            .cm-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .cm-hero {
                flex-wrap: wrap;
            }

        }

        @media(max-width: 500px) {

            .cm-stats {
                grid-template-columns: 1fr;
            }

            .cm-scoreboard {
                gap: 8px;
            }

            .cm-score {
                font-size: 23px;
                padding: 12px;
            }

            .cm-team h3 {
                font-size: 14px;
            }

            .cm-card,
            .cm-hero,
            .cm-match {
                padding: 18px;
            }

            .cm-actions {
                width: 100%;
            }

        }
    </style>

    @php
        $perfunduar = $ndeshjet->where(
            'statusi',
            'Perfunduar'
        );

        $fitore = $perfunduar->filter(
            fn($n) => $n->setet_tona > $n->setet_kundershtarit
        )->count();

        $humbje = $perfunduar->filter(
            fn($n) => $n->setet_tona < $n->setet_kundershtarit
        )->count();

        $planifikuara = $ndeshjet->where(
            'statusi',
            'Planifikuar'
        )->count();
    @endphp

    <div class="cm-page">

        <div class="cm-hero">

            <div>

                <small>KV GJINOCI | MATCH CENTER</small>

                <h1>Ndeshjet e Mia</h1>

                <p>
                    Menaxho ndeshjet, regjistro rezultatet
                    dhe statistikat individuale te ekipit tend.
                </p>

            </div>

            <a href="{{ route('coach.ndeshjet.create') }}"
               class="cm-btn cm-btn-white">

                + Shto Ndeshje

            </a>

        </div>

        @if(session('success'))

            <div class="cm-success">

                ✓ {{ session('success') }}

            </div>

        @endif

        <div class="cm-stats">

            <div class="cm-stat">

                <div class="cm-stat-top">

                    <small>Total Ndeshje</small>

                    <span class="cm-icon">🏐</span>

                </div>

                <h2>{{ $ndeshjet->count() }}</h2>

            </div>

            <div class="cm-stat">

                <div class="cm-stat-top">

                    <small>Fitore</small>

                    <span class="cm-icon">🏆</span>

                </div>

                <h2 style="color:#15803d;">

                    {{ $fitore }}

                </h2>

            </div>

            <div class="cm-stat">

                <div class="cm-stat-top">

                    <small>Humbje</small>

                    <span class="cm-icon">📉</span>

                </div>

                <h2 style="color:#b91c1c;">

                    {{ $humbje }}

                </h2>

            </div>

            <div class="cm-stat">

                <div class="cm-stat-top">

                    <small>Te Planifikuara</small>

                    <span class="cm-icon">📅</span>

                </div>

                <h2>{{ $planifikuara }}</h2>

            </div>

        </div>

        <div class="cm-card">

            <h2>Ndeshjet e Regjistruara</h2>

            <p class="cm-subtitle">
                Lista e ndeshjeve te ekipeve qe i udheheq.
            </p>

            @forelse($ndeshjet as $ndeshja)

                @php
                    $eshtePerfunduar =
                        $ndeshja->statusi === 'Perfunduar';

                    $eshteFitore =
                        $ndeshja->setet_tona >
                        $ndeshja->setet_kundershtarit;
                @endphp

                <div class="cm-match">

                    <div class="cm-match-top">

                    <span>

                        📅 {{ \Carbon\Carbon::parse(
                            $ndeshja->data_ndeshjes
                        )->format('d.m.Y H:i') }}

                    </span>

                        @if($eshtePerfunduar)

                            <span class="cm-badge {{ $eshteFitore ? 'cm-win' : 'cm-loss' }}">

                            {{ $eshteFitore ? 'Fitore' : 'Humbje' }}

                        </span>

                        @else

                            <span class="cm-badge">

                            {{ $ndeshja->statusi }}

                        </span>

                        @endif

                    </div>

                    <div class="cm-scoreboard">

                        <div class="cm-team">

                            <div class="cm-team-icon">🏐</div>

                            <h3>

                                {{ $ndeshja->ekipi?->emri ?? '-' }}

                            </h3>

                            <small>

                                Ekipi Yne

                            </small>

                        </div>

                        <div class="cm-score">

                            @if($eshtePerfunduar)

                                {{ $ndeshja->setet_tona }}
                                :
                                {{ $ndeshja->setet_kundershtarit }}

                            @else

                                VS

                            @endif

                        </div>

                        <div class="cm-team">

                            <div class="cm-team-icon">🏐</div>

                            <h3>

                                {{ $ndeshja->kundershtari }}

                            </h3>

                            <small>

                                Kundershtari

                            </small>

                        </div>

                    </div>

                    <div class="cm-match-footer">

                        <div class="cm-location">

                            <div>

                                📍 {{ $ndeshja->palestra ?? '-' }}

                            </div>

                            <div>

                                {{ $ndeshja->lokacioni }}

                                |

                                {{ $ndeshja->statusi }}

                            </div>

                        </div>

                        <div class="cm-actions">

                            @if($eshtePerfunduar)

                                <a href="{{ route(
                                'coach.ndeshjet.edit',
                                $ndeshja
                            ) }}"
                                   class="cm-btn cm-btn-light">

                                    Edito Rezultatin

                                </a>

                                <a href="{{ route(
                                'coach.statistikat',
                                $ndeshja
                            ) }}"
                                   class="cm-btn">

                                    📊 Menaxho Statistikat

                                </a>

                            @else

                                <a href="{{ route(
                                'coach.ndeshjet.edit',
                                $ndeshja
                            ) }}"
                                   class="cm-btn cm-btn-light">

                                    Edito Ndeshjen

                                </a>

                                <a href="{{ route(
                                'coach.ndeshjet.edit',
                                $ndeshja
                            ) }}?rezultati=1"
                                   class="cm-btn">

                                    Regjistro Rezultatin

                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="cm-empty">

                    <div style="font-size:40px;">

                        🏐

                    </div>

                    <h3>Nuk ka ndeshje</h3>

                    <p>
                        Ende nuk ke regjistruar asnje ndeshje
                        per ekipet e tua.
                    </p>

                    <a href="{{ route('coach.ndeshjet.create') }}"
                       class="cm-btn">

                        + Krijo Ndeshjen e Pare

                    </a>

                </div>

            @endforelse

        </div>

        <a href="{{ route('coach.dashboard') }}"
           class="cm-btn cm-btn-light">

            ← Kthehu ne Dashboard

        </a>

    </div>

@endsection
