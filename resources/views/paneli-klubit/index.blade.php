@extends('layouts.club')

@section('title', 'Paneli i Klubit - KV Gjinoci')

@section('content')

    <style>
        .club-overview {
            max-width: 1350px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .club-overview * {
            box-sizing: border-box;
        }

        .club-overview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 25px;
        }

        .club-overview-header h1 {
            font-size: 29px;
            color: #172b4d;
            margin: 0 0 6px;
        }

        .club-overview-header p {
            font-size: 13px;
            color: #64748b;
            margin: 0;
        }

        .club-overview-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .club-overview-btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 7px;
            padding: 12px 15px;
            background: #253858;
            color: white !important;
            border: 0;
            border-radius: 9px;
            text-decoration: none !important;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .club-overview-btn.secondary {
            background: #e8efff;
            color: #253858 !important;
        }

        .club-overview-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 24px;
        }

        .club-overview-stat {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px;
        }

        .club-overview-stat small {
            display: block;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 13px;
        }

        .club-overview-stat strong {
            display: block;
            font-size: 31px;
            line-height: 1;
            color: #172b4d;
            font-variant-numeric: tabular-nums;
        }

        .club-overview-stat.live {
            border-color: #fecaca;
        }

        .club-overview-stat.live strong {
            color: #b91c1c;
        }

        .club-overview-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            align-items: start;
        }

        .club-overview-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .club-overview-card-header {
            padding: 20px;
            border-bottom: 1px solid #edf2f7;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .club-overview-card-header h2 {
            margin: 0;
            font-size: 17px;
            color: #172b4d;
        }

        .club-overview-card-header a {
            color: #315b89;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
        }

        .club-overview-match {
            display: grid;
            grid-template-columns: 75px minmax(0, 1fr) auto;
            gap: 15px;
            align-items: center;
            padding: 17px 20px;
            border-bottom: 1px solid #edf2f7;
        }

        .club-overview-match:last-child {
            border-bottom: none;
        }

        .club-overview-date {
            background: #f1f5f9;
            border-radius: 9px;
            padding: 10px 6px;
            text-align: center;
        }

        .club-overview-date strong {
            display: block;
            font-size: 20px;
            color: #253858;
        }

        .club-overview-date small {
            display: block;
            color: #64748b;
            margin-top: 4px;
            font-size: 10px;
            text-transform: uppercase;
        }

        .club-overview-team {
            min-width: 0;
        }

        .club-overview-team strong {
            display: block;
            color: #172b4d;
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .club-overview-team small {
            display: block;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
            margin-top: 5px;
            overflow-wrap: anywhere;
        }

        .club-overview-result {
            font-size: 21px;
            font-weight: 800;
            color: #172b4d;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .club-overview-tag {
            display: inline-block;
            border-radius: 7px;
            background: #e8efff;
            color: #253858;
            padding: 7px 9px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .club-overview-live {
            background: #fff7f7;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 16px;
            margin: 15px;
        }

        .club-overview-live-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 10px;
        }

        .club-overview-live-top strong {
            color: #172b4d;
            font-size: 13px;
        }

        .club-overview-live-tag {
            background: #fee2e2;
            color: #991b1b;
            border-radius: 7px;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: bold;
        }

        .club-overview-live p {
            color: #64748b;
            font-size: 12px;
            margin: 0 0 13px;
        }

        .club-overview-empty {
            padding: 36px 20px;
            text-align: center;
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
        }

        @media (max-width: 950px) {
            .club-overview-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .club-overview-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 550px) {
            .club-overview-header h1 {
                font-size: 25px;
            }

            .club-overview-match {
                grid-template-columns: 58px minmax(0, 1fr) auto;
                gap: 9px;
                padding: 14px;
            }

            .club-overview-date strong {
                font-size: 17px;
            }

            .club-overview-result {
                font-size: 18px;
            }

            .club-overview-stat {
                padding: 17px;
            }

            .club-overview-stat strong {
                font-size: 27px;
            }
        }
    </style>

    <div class="club-overview">

        <header class="club-overview-header">
            <div>
                <h1>Paneli i Klubit</h1>
                <p>
                    Pasqyra e ndeshjeve dhe aktivitetit sportiv.
                </p>
            </div>

            <div class="club-overview-actions">
                <a
                    href="{{ route('ndeshjet-v2.index') }}"
                    class="club-overview-btn secondary"
                >
                    Pasqyra e Ndeshjeve
                </a>

                <a
                    href="{{ route('match-center.index') }}"
                    class="club-overview-btn"
                >
                    Match Center
                </a>
            </div>
        </header>

        {{-- STATISTIKAT --}}

        <div class="club-overview-stats">

            <div class="club-overview-stat">
                <small>Gjithsej ndeshje</small>
                <strong>{{ $stats['total'] }}</strong>
            </div>

            <div class="club-overview-stat">
                <small>Ndeshje te perfunduara</small>
                <strong>{{ $stats['finished'] }}</strong>
            </div>

            <div class="club-overview-stat">
                <small>Ndeshje te ardhshme</small>
                <strong>{{ $stats['upcoming'] }}</strong>
            </div>

            <div class="club-overview-stat live">
                <small>Ndeshje LIVE</small>
                <strong>{{ $stats['live'] }}</strong>
            </div>

        </div>

        {{-- NDESHJET LIVE --}}

        @if($liveMatches->isNotEmpty())

            <section class="club-overview-card">
                <div class="club-overview-card-header">
                    <h2>Ndeshjet LIVE</h2>

                    <a href="{{ route('match-center.index', [
                    'filter' => 'live'
                ]) }}">
                        Shiko te gjitha
                    </a>
                </div>

                @foreach($liveMatches as $row)
                    <div class="club-overview-live">
                        <div class="club-overview-live-top">
                            <strong>
                                {{ $row['ndeshja']->ekipi?->emri
                                    ?? 'KV Gjinoci' }}
                                vs
                                {{ $row['ndeshja']->kundershtari }}
                            </strong>

                            <span class="club-overview-live-tag">
                            ● LIVE
                        </span>
                        </div>

                        <p>
                            Ndeshja eshte duke u regjistruar
                            ne Match Center.
                        </p>

                        <a
                            href="{{ route(
                            'match-center.show',
                            $row['ndeshja']
                        ) }}"
                            class="club-overview-btn"
                        >
                            Hape LIVE
                        </a>
                    </div>
                @endforeach
            </section>

        @endif

        <div class="club-overview-grid">

            {{-- REZULTATET E FUNDIT --}}

            <section class="club-overview-card">
                <div class="club-overview-card-header">
                    <h2>Rezultatet e Fundit</h2>

                    <a href="{{ route('ndeshjet-v2.index', [
                    'status' => 'finished'
                ]) }}">
                        Shiko te gjitha
                    </a>
                </div>

                @forelse($recentMatches as $row)

                    @php
                        $ndeshja = $row['ndeshja'];
                        $date = $row['date'];
                    @endphp

                    <div class="club-overview-match">

                        <div class="club-overview-date">
                            <strong>
                                {{ $date ? $date->format('d') : '–' }}
                            </strong>

                            <small>
                                {{ $date
                                    ? $date->locale('sq')
                                        ->translatedFormat('M')
                                    : 'Pa date' }}
                            </small>
                        </div>

                        <div class="club-overview-team">
                            <strong>
                                {{ $ndeshja->ekipi?->emri
                                    ?? 'KV Gjinoci' }}
                            </strong>

                            <small>
                                vs {{ $ndeshja->kundershtari }}
                            </small>
                        </div>

                        <div class="club-overview-result">
                            @if(
                                $row['home'] !== null
                                && $row['away'] !== null
                            )
                                {{ $row['home'] }}
                                :
                                {{ $row['away'] }}
                            @else
                                – : –
                            @endif
                        </div>

                    </div>

                @empty

                    <div class="club-overview-empty">
                        Nuk ka ende rezultate te perfunduara.
                    </div>

                @endforelse
            </section>

            {{-- NDESHJET E ARDHSHME --}}

            <section class="club-overview-card">
                <div class="club-overview-card-header">
                    <h2>Ndeshjet e Ardhshme</h2>

                    <a href="{{ route('ndeshjet-v2.index', [
                    'status' => 'pending'
                ]) }}">
                        Shiko te gjitha
                    </a>
                </div>

                @forelse($upcomingMatches as $row)

                    @php
                        $ndeshja = $row['ndeshja'];
                        $date = $row['date'];
                    @endphp

                    <div class="club-overview-match">

                        <div class="club-overview-date">
                            <strong>
                                {{ $date ? $date->format('d') : '–' }}
                            </strong>

                            <small>
                                {{ $date
                                    ? $date->locale('sq')
                                        ->translatedFormat('M')
                                    : 'Pa date' }}
                            </small>
                        </div>

                        <div class="club-overview-team">
                            <strong>
                                {{ $ndeshja->ekipi?->emri
                                    ?? 'KV Gjinoci' }}
                            </strong>

                            <small>
                                vs {{ $ndeshja->kundershtari }}
                            </small>

                            @if($ndeshja->palestra)
                                <small>
                                    {{ $ndeshja->palestra }}
                                </small>
                            @endif
                        </div>

                        <span class="club-overview-tag">
                        Planifikuar
                    </span>

                    </div>

                @empty

                    <div class="club-overview-empty">
                        Nuk ka ndeshje te ardhshme
                        te planifikuara.
                    </div>

                @endforelse
            </section>

        </div>

    </div>

@endsection
