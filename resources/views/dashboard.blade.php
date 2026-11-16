@extends('layouts.club')

@section('title', 'Dashboard - KV Gjinoci')

@section('styles')

    <link rel="stylesheet"
          href="{{ asset('css/dashboard.css') }}">

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
                'route' => 'ndeshjet.index',
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

        {{-- =========================
             WELCOME HERO
        ========================= --}}

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

                    Ketu mund ta kontrollosh
                    aktivitetin e klubit,
                    performancen sportive,
                    ekipet dhe financat,
                    nga nje vend i vetem.

                </p>

                <div class="dash-date">

                    📅 &nbsp;

                    {{ now()
                        ->timezone('Europe/Belgrade')
                        ->format('d.m.Y') }}

                </div>

            </div>

        </div>

        {{-- =========================
             KEY STATISTICS
        ========================= --}}

        <div class="dash-stats">

            @foreach($statCards as $stat)

                @if(\Illuminate\Support\Facades\Route::has(
                    $stat['route']
                ))

                    <a href="{{ route($stat['route']) }}"
                       class="dash-stat-card">

                        <div class="dash-stat-top">

                        <span>

                            {{ $stat['label'] }}

                        </span>

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

                        <span>

                            {{ $stat['label'] }}

                        </span>

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

        {{-- =========================
             PERFORMANCE & ACTIONS
        ========================= --}}

        <div class="dash-grid">

            {{-- PERFORMANCE --}}

            <section class="dash-card">

                <div class="dash-card-header">

                    <div>

                        <h2>

                            Performanca e Klubit

                        </h2>

                        <p>

                            Permbledhja e rezultateve
                            te regjistruara.

                        </p>

                    </div>

                    <a href="{{ route('statistics.index') }}"
                       class="dash-link">

                        Statistikat →

                    </a>

                </div>

                <div class="dash-performance">

                    <div class="dash-donut"
                         style="background:{{ $donutBackground }}">

                        <div class="dash-donut-inner">

                            <strong>

                                {{ $winRate }}%

                            </strong>

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

                            <strong>

                                {{ $totalRezultate }}

                            </strong>

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

                        @if(\Illuminate\Support\Facades\Route::has(
                            $action['route']
                        ))

                            <a href="{{ route($action['route']) }}"
                               class="dash-action">

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

        {{-- =========================
             UPCOMING EVENTS
        ========================= --}}

        <div class="dash-grid dash-grid-equal">

            {{-- UPCOMING MATCHES --}}

            <section class="dash-card">

                <div class="dash-card-header">

                    <div>

                        <h2>Ndeshjet e Ardhshme</h2>

                        <p>

                            5 ndeshjet e ardhshme
                            te klubit.

                        </p>

                    </div>

                    <a href="{{ route('ndeshjet.index') }}"
                       class="dash-link">

                        Shiko te gjitha →

                    </a>

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

                                    {{ \Carbon\Carbon::parse(
                                        $ndeshja->data_ndeshjes
                                    )->format('d.m.Y') }}

                                    ·

                                    {{ $ndeshja->palestra
                                        ?? 'Palestra pa caktuar' }}

                                </small>

                                <small>

                                    {{ $ndeshja->lokacioni
                                        ?? '' }}

                                </small>

                            </div>

                            <span class="dash-status"
                                  style="
                                background:#dbeafe;
                                color:#1d4ed8;
                              ">

                            E ardhshme

                        </span>

                        </div>

                    @empty

                        <div class="dash-empty">

                            Nuk ka ndeshje
                            te ardhshme.

                        </div>

                    @endforelse

                </div>

            </section>

            {{-- UPCOMING TRAININGS --}}

            <section class="dash-card">

                <div class="dash-card-header">

                    <div>

                        <h2>Stervitjet e Ardhshme</h2>

                        <p>

                            Orari i seancave
                            stervitore.

                        </p>

                    </div>

                    <a href="{{ route('stervitjet.index') }}"
                       class="dash-link">

                        Shiko te gjitha →

                    </a>

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

                                    {{ \Carbon\Carbon::parse(
                                        $stervitja->data
                                    )->format('d.m.Y') }}

                                    ·

                                    {{ substr(
                                        $stervitja->ora_fillimit,
                                        0,
                                        5
                                    ) }}

                                    -

                                    {{ substr(
                                        $stervitja->ora_mbarimit,
                                        0,
                                        5
                                    ) }}

                                </small>

                                <small>

                                    {{ $stervitja->palestra
                                        ?? 'Palestra pa caktuar' }}

                                </small>

                            </div>

                            <span class="dash-status"
                                  style="
                                background:#e0e7ff;
                                color:#4338ca;
                              ">

                            {{ $stervitja->lloji
                                ?? 'Stervitje' }}

                        </span>

                        </div>

                    @empty

                        <div class="dash-empty">

                            Nuk ka stervitje
                            te ardhshme.

                        </div>

                    @endforelse

                </div>

            </section>

        </div>

        {{-- =========================
             RESULTS & FINANCE
        ========================= --}}

        <div class="dash-grid dash-grid-equal">

            {{-- RECENT RESULTS --}}

            <section class="dash-card">

                <div class="dash-card-header">

                    <div>

                        <h2>Rezultatet e Fundit</h2>

                        <p>

                            Ndeshjet e fundit
                            te perfunduara.

                        </p>

                    </div>

                    <a href="{{ route('ndeshjet.index') }}"
                       class="dash-link">

                        Ndeshjet →

                    </a>

                </div>

                <div>

                    @forelse($rezultatetEFundit as $rezultati)

                        @php

                            $eshteFitore =
                                $rezultati->setet_tona
                                >
                                $rezultati->setet_kundershtarit;

                            $eshteHumbje =
                                $rezultati->setet_tona
                                <
                                $rezultati->setet_kundershtarit;

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

                                    {{ \Carbon\Carbon::parse(
                                        $rezultati->data_ndeshjes
                                    )->format('d.m.Y') }}

                                </small>

                            </div>

                            <span class="dash-score">

                            {{ $rezultati->setet_tona }}

                            :

                            {{ $rezultati->setet_kundershtarit }}

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

                            Nuk ka ndeshje
                            te perfunduara.

                        </div>

                    @endforelse

                </div>

            </section>

            {{-- FINANCIAL OVERVIEW --}}

            <section class="dash-card">

                <div class="dash-card-header">

                    <div>

                        <h2>Permbledhja Financiare</h2>

                        <p>

                            Kontratat dhe pagesat
                            e regjistruara.

                        </p>

                    </div>

                    @if(\Illuminate\Support\Facades\Route::has(
                        'financat.index'
                    ))

                        <a href="{{ route('financat.index') }}"
                           class="dash-link">

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

                <div class="dash-empty"
                     style="margin-top:20px;">

                    Per shumat e pagave,
                    transaksionet dhe bilancin,
                    vizito modulin e financave.

                </div>

            </section>

        </div>

        {{-- =========================
             RECENT ACTIVITY
        ========================= --}}

        <section class="dash-card">

            <div class="dash-card-header">

                <div>

                    <h2>Aktivitetet e Fundit</h2>

                    <p>

                        Ndryshimet e fundit
                        te regjistruara ne sistem.

                    </p>

                </div>

                @if(\Illuminate\Support\Facades\Route::has(
                    'activity.index'
                ))

                    <a href="{{ route('activity.index') }}"
                       class="dash-link">

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

                    Nuk ka aktivitete
                    te regjistruara.

                </div>

            @endforelse

        </section>

    </div>

@endsection
