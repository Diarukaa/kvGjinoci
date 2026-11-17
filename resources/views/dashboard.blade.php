@extends('layouts.club')

@section('title', 'Dashboard - KV Gjinoci')

@section('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/dashboard.css') }}"
    >

    <style>
        /* Permiresimet e Dashboard-it */

        .dashboard-page .dash-hero {
            min-height: 0;
            padding-top: 26px;
            padding-bottom: 26px;
        }

        .dashboard-page .dash-hero h1 {
            font-size: clamp(23px, 2.2vw, 31px);
        }

        .dash-live-section {
            margin-bottom: 24px;
        }

        .dash-live-list {
            padding: 0 24px 20px;
            display: grid;
            gap: 12px;
        }

        .dash-live-item {
            background: #fff8f8;
            border: 1px solid #fecaca;
            border-radius: 13px;
            padding: 17px;
        }

        .dash-live-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .dash-live-teams {
            font-weight: 700;
            color: #172b4d;
        }

        .dash-live-tag {
            color: #991b1b;
            background: #fee2e2;
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: 800;
        }

        .dash-live-score {
            font-size: 25px;
            font-weight: 800;
            font-variant-numeric: tabular-nums;
            color: #172b4d;
            margin: 11px 0 4px;
        }

        .dash-live-meta {
            color: #64748b;
            font-size: 12px;
            margin-bottom: 14px;
        }

        .dash-live-open {
            display: inline-block;
            background: #253858;
            color: #fff !important;
            border-radius: 8px;
            padding: 10px 14px;
            text-decoration: none !important;
            font-size: 12px;
            font-weight: 700;
        }

        @media (max-width: 700px) {
            .dash-live-list {
                padding: 0 14px 16px;
            }
        }
    </style>
@endsection

@section('content')

    @php

        $statCards = [
            [
                'label' => 'Ekipet',
                'value' => $totalEkipe,
                'icon' => '🏐',
                'note' => 'Ekipet e regjistruara',
                'route' => 'ekipet.index',
            ],
            [
                'label' => 'Volejbollistet',
                'value' => $totalLojtare,
                'icon' => '👥',
                'note' => 'Lojtaret e regjistruara',
                'route' => 'lojtar.index',
            ],
            [
                'label' => 'Trajneret',
                'value' => $totalTrajnere,
                'icon' => '👤',
                'note' => 'Stafi sportiv',
                'route' => 'trajner.index',
            ],
            [
                'label' => 'Menaxheret',
                'value' => $totalManagers,
                'icon' => '💼',
                'note' => 'Stafi menaxhues',
                'route' => 'managers.index',
            ],
            [
                'label' => 'Ndeshjet',
                'value' => $totalNdeshje,
                'icon' => '🏆',
                'note' => 'Ndeshjet e regjistruara',
                'route' => 'ndeshjet-v2.index',
            ],
            [
                'label' => 'Stervitjet',
                'value' => $totalStervitje,
                'icon' => '📅',
                'note' => 'Seancat stervitore',
                'route' => 'stervitjet.index',
            ],
            [
                'label' => 'Fitoret',
                'value' => $fitore,
                'icon' => '🥇',
                'note' => 'Rezultatet pozitive',
                'route' => 'statistics.index',
            ],
            [
                'label' => 'Win Rate',
                'value' => $winRate . '%',
                'icon' => '📈',
                'note' => 'Perqindja e fitoreve',
                'route' => 'performance.index',
            ],
        ];

        $quickActions = [
            [
                'title' => 'Shto Lojtare',
                'description' => 'Regjistro nje lojtare te re',
                'icon' => '👤',
                'route' => 'lojtar.create',
            ],
            [
                'title' => 'Shto Ndeshje',
                'description' => 'Planifiko nje ndeshje',
                'icon' => '🏐',
                'route' => 'ndeshjet.create',
            ],
            [
                'title' => 'Shto Stervitje',
                'description' => 'Organizo seancen e rradhes',
                'icon' => '📅',
                'route' => 'stervitjet.create',
            ],
            [
                'title' => 'Raportet PDF',
                'description' => 'Gjenero raportet e klubit',
                'icon' => '📄',
                'route' => 'raportet.index',
            ],
        ];

        $donutBackground = $totalRezultate > 0
            ? 'conic-gradient(
                #22c55e 0% ' . $winRate . '%,
                #ef4444 ' . $winRate . '% 100%
            )'
            : 'var(--ui-border)';

    @endphp

    <div class="dashboard-page">

        {{-- WELCOME BANNER --}}

        <div class="dash-hero">
            <div class="dash-hero-content">

            <span class="dash-label">
                KV GJINOCI | ADMINISTRATION
            </span>

                <h1>
                    Mire se erdhe,
                    {{ auth()->user()->name }}!
                </h1>

                <p>
                    Ketu mund ta kontrollosh aktivitetin
                    e klubit, performancen sportive,
                    ekipet dhe financat, nga nje vend i vetem.
                </p>

                <div class="dash-date">
                    📅 &nbsp;
                    {{ now()
                        ->timezone('Europe/Belgrade')
                        ->format('d.m.Y') }}
                </div>

            </div>
        </div>

        {{-- KARTELAT STATISTIKORE --}}

        <div class="dash-stats">

            @foreach($statCards as $stat)

                @if(\Illuminate\Support\Facades\Route::has($stat['route']))

                    <a
                        href="{{ route($stat['route']) }}"
                        class="dash-stat-card"
                    >

                        <div class="dash-stat-top">
                            <span>{{ $stat['label'] }}</span>

                            <span class="dash-stat-icon">
                            {{ $stat['icon'] }}
                        </span>
                        </div>

                        <div class="dash-stat-value">
                            {{ $stat['value'] }}
                        </div>

                        <div class="dash-stat-note">
                            {{ $stat['note'] }}
                        </div>

                    </a>

                @else

                    <div class="dash-stat-card">

                        <div class="dash-stat-top">
                            <span>{{ $stat['label'] }}</span>

                            <span class="dash-stat-icon">
                            {{ $stat['icon'] }}
                        </span>
                        </div>

                        <div class="dash-stat-value">
                            {{ $stat['value'] }}
                        </div>

                        <div class="dash-stat-note">
                            {{ $stat['note'] }}
                        </div>

                    </div>

                @endif

            @endforeach

        </div>

        {{-- NDESHJET LIVE --}}

        @if($liveMatches->isNotEmpty())

            <section
                class="dash-card dash-live-section"
                id="dashboardLiveMatches"
            >

                <div class="dash-card-header">
                    <div>
                        <h2>Ndeshjet LIVE</h2>

                        <p>
                            Rezultatet nga Match Center,
                            me rifreskim automatik.
                        </p>
                    </div>

                    @if(\Illuminate\Support\Facades\Route::has('match-center.index'))
                        <a
                            href="{{ route('match-center.index', [
                            'filter' => 'live'
                        ]) }}"
                            class="dash-link"
                        >
                            Match Center →
                        </a>
                    @endif
                </div>

                <div class="dash-live-list">

                    @foreach($liveMatches as $live)

                        <article
                            class="dash-live-item"
                            data-live-state-url="{{ route(
                            'match-center.state',
                            $live['ndeshja']
                        ) }}"
                        >

                            <div class="dash-live-header">

                            <span class="dash-live-teams">
                                {{ $live['ndeshja']->ekipi?->emri
                                    ?? 'KV Gjinoci' }}

                                vs

                                {{ $live['ndeshja']->kundershtari }}
                            </span>

                                <span class="dash-live-tag">
                                ● LIVE
                            </span>
                            </div>

                            <div class="dash-live-score">
                            <span data-live-home>
                                {{ $live['home'] }}
                            </span>

                                :

                                <span data-live-away>
                                {{ $live['away'] }}
                            </span>

                                <span style="font-size:12px;font-weight:500;">
                                (sete)
                            </span>
                            </div>

                            <div class="dash-live-meta">
                                Seti
                                <span data-live-set>
                                {{ $live['current_set'] ?? '–' }}
                            </span>

                                · Piket

                                <span data-live-points-home>
                                {{ $live['current_home'] }}
                            </span>

                                :

                                <span data-live-points-away>
                                {{ $live['current_away'] }}
                            </span>
                            </div>

                            <a
                                href="{{ route(
                                'match-center.show',
                                $live['ndeshja']
                            ) }}"
                                class="dash-live-open"
                            >
                                Hape Match Center
                            </a>

                        </article>

                    @endforeach

                </div>
            </section>

        @endif

        {{-- PERFORMANCA DHE QUICK ACTIONS --}}

        <div class="dash-grid">

            <section class="dash-card">

                <div class="dash-card-header">

                    <div>
                        <h2>Performanca e Klubit</h2>

                        <p>
                            Permbledhja e rezultateve
                            te regjistruara.
                        </p>
                    </div>

                    @if(\Illuminate\Support\Facades\Route::has('statistics.index'))
                        <a
                            href="{{ route('statistics.index') }}"
                            class="dash-link"
                        >
                            Statistikat →
                        </a>
                    @endif

                </div>

                <div class="dash-performance">

                    <div
                        class="dash-donut"
                        style="background:{{ $donutBackground }}"
                    >

                        <div class="dash-donut-inner">

                            <strong>{{ $winRate }}%</strong>

                            <small>Win Rate</small>

                        </div>
                    </div>

                    <div class="dash-legend">

                        <div class="dash-legend-row">
                            <div class="dash-legend-label">
                                <span class="dash-dot dash-dot-green"></span>
                                Fitore
                            </div>

                            <strong>{{ $fitore }}</strong>
                        </div>

                        <div class="dash-legend-row">
                            <div class="dash-legend-label">
                                <span class="dash-dot dash-dot-red"></span>
                                Humbje
                            </div>

                            <strong>{{ $humbje }}</strong>
                        </div>

                        <div class="dash-legend-row">
                            <div class="dash-legend-label">
                                <span class="dash-dot dash-dot-blue"></span>
                                Gjithsej rezultate
                            </div>

                            <strong>{{ $totalRezultate }}</strong>
                        </div>

                    </div>
                </div>

                <div class="dash-performance-footer">

                    <div class="dash-mini-stat">
                        <strong>
                            {{ $ndeshjePerfunduara }}
                        </strong>

                        <small>
                            Ndeshje te perfunduara
                        </small>
                    </div>

                    <div class="dash-mini-stat">
                        <strong>
                            {{ $ndeshjePlanifikuara }}
                        </strong>

                        <small>
                            Ndeshje te planifikuara
                        </small>
                    </div>

                </div>

            </section>

            {{-- QUICK ACTIONS --}}

            <section class="dash-card">

                <div class="dash-card-header">
                    <div>
                        <h2>Quick Actions</h2>

                        <p>
                            Qasje e shpejte ne
                            funksionet kryesore.
                        </p>
                    </div>
                </div>

                <div class="dash-actions">

                    @foreach($quickActions as $action)

                        @if(\Illuminate\Support\Facades\Route::has($action['route']))

                            <a
                                href="{{ route($action['route']) }}"
                                class="dash-action"
                            >

                            <span class="dash-action-icon">
                                {{ $action['icon'] }}
                            </span>

                                <strong>
                                    {{ $action['title'] }}
                                </strong>

                                <small>
                                    {{ $action['description'] }}
                                </small>

                            </a>

                        @endif

                    @endforeach

                </div>

            </section>

        </div>

        {{-- NDESHJET DHE STERVITJET E ARDHSHME --}}

        <div class="dash-grid dash-grid-equal">

            <section class="dash-card">

                <div class="dash-card-header">

                    <div>
                        <h2>Ndeshjet e Ardhshme</h2>

                        <p>
                            Ndeshjet e planifikuara te klubit.
                        </p>
                    </div>

                    @if(\Illuminate\Support\Facades\Route::has('ndeshjet-v2.index'))
                        <a
                            href="{{ route('ndeshjet-v2.index', [
                            'status' => 'pending'
                        ]) }}"
                            class="dash-link"
                        >
                            Shiko te gjitha →
                        </a>
                    @endif

                </div>

                <div>

                    @forelse($ndeshjetEArdhshme as $ndeshja)

                        <div class="dash-list-item">

                            <div class="dash-list-icon">
                                🏐
                            </div>

                            <div class="dash-list-info">

                                <strong>
                                    {{ $ndeshja->ekipi?->emri
                                        ?? 'KV Gjinoci' }}

                                    vs

                                    {{ $ndeshja->kundershtari }}
                                </strong>

                                <small>
                                    {{ $ndeshja->data_ndeshjes
                                        ? \Carbon\Carbon::parse(
                                            $ndeshja->data_ndeshjes
                                        )->format('d.m.Y')
                                        : 'Pa date' }}

                                    ·

                                    {{ $ndeshja->palestra
                                        ?? 'Palestra pa caktuar' }}
                                </small>

                                @if($ndeshja->lokacioni)
                                    <small>
                                        {{ $ndeshja->lokacioni }}
                                    </small>
                                @endif

                            </div>

                            <span
                                class="dash-status"
                                style="background:#dbeafe;color:#1d4ed8;"
                            >
                            E ardhshme
                        </span>

                        </div>

                    @empty

                        <div class="dash-empty">
                            Nuk ka ndeshje te ardhshme.
                        </div>

                    @endforelse

                </div>

            </section>

            {{-- STERVITJET --}}

            <section class="dash-card">

                <div class="dash-card-header">

                    <div>
                        <h2>Stervitjet e Ardhshme</h2>

                        <p>
                            Orari i seancave stervitore.
                        </p>
                    </div>

                    @if(\Illuminate\Support\Facades\Route::has('stervitjet.index'))
                        <a
                            href="{{ route('stervitjet.index') }}"
                            class="dash-link"
                        >
                            Shiko te gjitha →
                        </a>
                    @endif

                </div>

                <div>

                    @forelse($stervitjetEArdhshme as $stervitja)

                        <div class="dash-list-item">

                            <div class="dash-list-icon">
                                📅
                            </div>

                            <div class="dash-list-info">

                                <strong>
                                    {{ $stervitja->ekipi?->emri
                                        ?? 'KV Gjinoci' }}
                                </strong>

                                <small>
                                    {{ $stervitja->data
                                        ? \Carbon\Carbon::parse(
                                            $stervitja->data
                                        )->format('d.m.Y')
                                        : 'Pa date' }}

                                    ·

                                    {{ substr(
                                        (string) $stervitja->ora_fillimit,
                                        0,
                                        5
                                    ) }}

                                    -

                                    {{ substr(
                                        (string) $stervitja->ora_mbarimit,
                                        0,
                                        5
                                    ) }}
                                </small>

                                <small>
                                    {{ $stervitja->palestra
                                        ?? 'Palestra pa caktuar' }}
                                </small>

                            </div>

                            <span
                                class="dash-status"
                                style="background:#e0e7ff;color:#4338ca;"
                            >
                            {{ $stervitja->lloji ?? 'Stervitje' }}
                        </span>

                        </div>

                    @empty

                        <div class="dash-empty">
                            Nuk ka stervitje te ardhshme.
                        </div>

                    @endforelse

                </div>

            </section>

        </div>

        {{-- REZULTATET DHE FINANCAT --}}

        <div class="dash-grid dash-grid-equal">

            <section class="dash-card">

                <div class="dash-card-header">

                    <div>
                        <h2>Rezultatet e Fundit</h2>

                        <p>
                            Ndeshjet e fundit te perfunduara.
                        </p>
                    </div>

                    @if(\Illuminate\Support\Facades\Route::has('ndeshjet-v2.index'))
                        <a
                            href="{{ route('ndeshjet-v2.index', [
                            'status' => 'finished'
                        ]) }}"
                            class="dash-link"
                        >
                            Ndeshjet →
                        </a>
                    @endif

                </div>

                <div>

                    @forelse($rezultatetEFundit as $row)

                        @php
                            $rezultati = $row['ndeshja'];

                            $eshteFitore =
                                $row['home'] !== null
                                && $row['away'] !== null
                                && $row['home'] > $row['away'];

                            $eshteHumbje =
                                $row['home'] !== null
                                && $row['away'] !== null
                                && $row['home'] < $row['away'];
                        @endphp

                        <div class="dash-list-item">

                            <div class="dash-list-icon">
                                {{ $eshteFitore ? '🏆' : '🏐' }}
                            </div>

                            <div class="dash-list-info">

                                <strong>
                                    {{ $rezultati->ekipi?->emri
                                        ?? 'KV Gjinoci' }}

                                    vs

                                    {{ $rezultati->kundershtari }}
                                </strong>

                                <small>
                                    {{ $row['date']
                                        ? $row['date']->format('d.m.Y')
                                        : 'Pa date' }}
                                </small>

                            </div>

                            <span class="dash-score">
                            {{ $row['home'] ?? '–' }}
                            :
                            {{ $row['away'] ?? '–' }}
                        </span>

                            @if($eshteFitore)

                                <span class="dash-status dash-win">
                                Fitore
                            </span>

                            @elseif($eshteHumbje)

                                <span class="dash-status dash-loss">
                                Humbje
                            </span>

                            @else

                                <span class="dash-status">
                                Pa rezultat valid
                            </span>

                            @endif

                        </div>

                    @empty

                        <div class="dash-empty">
                            Nuk ka ndeshje te perfunduara.
                        </div>

                    @endforelse

                </div>

            </section>

            {{-- FINANCAT --}}

            <section class="dash-card">

                <div class="dash-card-header">

                    <div>
                        <h2>Permbledhja Financiare</h2>

                        <p>
                            Kontratat dhe pagesat e regjistruara.
                        </p>
                    </div>

                    @if(\Illuminate\Support\Facades\Route::has('financat.index'))
                        <a
                            href="{{ route('financat.index') }}"
                            class="dash-link"
                        >
                            Financat →
                        </a>
                    @endif

                </div>

                <div class="dash-finance">

                    <div class="dash-finance-box">

                        <small>
                            📄 Kontratat
                        </small>

                        <strong>
                            {{ $totalKontrata }}
                        </strong>

                    </div>

                    <div class="dash-finance-box">

                        <small>
                            💳 Pagesat
                        </small>

                        <strong>
                            {{ $totalPagesa }}
                        </strong>

                    </div>

                </div>

                <div
                    class="dash-empty"
                    style="margin-top:20px;"
                >
                    Per shumat e pagave,
                    transaksionet dhe bilancin,
                    vizito modulin e financave.
                </div>

            </section>

        </div>

        {{-- AKTIVITETET E FUNDIT --}}

        <section class="dash-card">

            <div class="dash-card-header">

                <div>
                    <h2>Aktivitetet e Fundit</h2>

                    <p>
                        Ndryshimet e fundit te
                        regjistruara ne sistem.
                    </p>
                </div>

                @if(\Illuminate\Support\Facades\Route::has('activity.index'))
                    <a
                        href="{{ route('activity.index') }}"
                        class="dash-link"
                    >
                        Activity Log →
                    </a>
                @endif

            </div>

            @forelse($aktivitetetEFundit as $aktiviteti)

                <div class="dash-list-item">

                    <div class="dash-list-icon">
                        📝
                    </div>

                    <div class="dash-list-info">

                        <strong>
                            {{ $aktiviteti->description
                                ?? $aktiviteti->action
                                ?? 'Aktivitet ne sistem' }}
                        </strong>

                        <small>
                            {{ $aktiviteti->created_at
                                ->timezone('Europe/Belgrade')
                                ->format('d.m.Y H:i') }}
                        </small>

                    </div>

                    <small style="
                    color:var(--ui-muted);
                    font-size:11px;
                    flex-shrink:0;
                ">
                        {{ $aktiviteti->created_at
                            ->diffForHumans() }}
                    </small>

                </div>

            @empty

                <div class="dash-empty">
                    Nuk ka aktivitete te regjistruara.
                </div>

            @endforelse

        </section>

    </div>

    {{-- LIVE REFRESH AUTOMATIK --}}

    @if($liveMatches->isNotEmpty())

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                let inFlight = false;

                async function syncLive() {

                    if (inFlight || document.hidden) {
                        return;
                    }

                    inFlight = true;

                    try {

                        const cards = Array.from(
                            document.querySelectorAll(
                                '[data-live-state-url]'
                            )
                        );

                        const responses = await Promise.all(
                            cards.map(async function (card) {

                                const response = await fetch(
                                    card.dataset.liveStateUrl,
                                    {
                                        headers: {
                                            'Accept': 'application/json'
                                        },
                                        cache: 'no-store',
                                        credentials: 'same-origin'
                                    }
                                );

                                if (!response.ok) {
                                    return null;
                                }

                                return {
                                    card: card,
                                    state: await response.json()
                                };
                            })
                        );

                        for (const result of responses) {

                            if (!result) {
                                continue;
                            }

                            const card = result.card;
                            const state = result.state;

                            if (state.status !== 'live') {

                                // Ndeshja perfundoi.
                                // Rikarko Dashboard-in me rezultatet e reja.

                                window.location.reload();
                                return;
                            }

                            const sets = Array.isArray(state.sets)
                                ? state.sets
                                : [];

                            const last = sets.length
                                ? sets[sets.length - 1]
                                : null;

                            card.querySelector(
                                '[data-live-home]'
                            ).textContent = state.summary?.home ?? 0;

                            card.querySelector(
                                '[data-live-away]'
                            ).textContent = state.summary?.away ?? 0;

                            card.querySelector(
                                '[data-live-set]'
                            ).textContent = last?.number ?? '–';

                            card.querySelector(
                                '[data-live-points-home]'
                            ).textContent = last?.home ?? 0;

                            card.querySelector(
                                '[data-live-points-away]'
                            ).textContent = last?.away ?? 0;
                        }

                    } catch (error) {

                        // Nese deshton lidhja, provojme perseri.
                        console.error('LIVE refresh:', error);

                    } finally {

                        inFlight = false;
                    }
                }

                // Rifresko cdo 4 sekonda.

                setInterval(syncLive, 4000);

                document.addEventListener(
                    'visibilitychange',
                    function () {
                        if (!document.hidden) {
                            syncLive();
                        }
                    }
                );

                syncLive();

            });
        </script>

    @endif

@endsection
