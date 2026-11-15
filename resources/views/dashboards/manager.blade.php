@extends('layouts.club')

@section('title', 'Manager Dashboard - KV Gjinoci')

@section('content')

    <style>
        .mg-page {
            max-width: 1250px;
            margin: 0 auto;
            padding: 15px 0 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .mg-page * {
            box-sizing: border-box;
        }

        .mg-hero {
            background: linear-gradient(125deg, #172b4d, #315b89);
            color: white;
            border-radius: 20px;
            padding: 34px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .mg-hero small {
            font-size: 11px;
            letter-spacing: 1.5px;
            color: #bfdbfe;
            font-weight: bold;
        }

        .mg-hero h1 {
            font-size: 32px;
            color: white !important;
            margin: 14px 0;
        }

        .mg-hero p {
            margin: 0;
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.7;
        }

        .mg-avatar {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .mg-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 16px;
            margin-bottom: 25px;
        }

        .mg-stat {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
            color: #172b4d !important;
            text-decoration: none !important;
            transition: transform .2s;
        }

        .mg-stat:hover {
            transform: translateY(-3px);
            border-color: #93c5fd;
        }

        .mg-stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
        }

        .mg-stat small {
            color: #64748b;
            font-size: 13px;
        }

        .mg-stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .mg-stat h2 {
            font-size: 31px;
            margin: 14px 0 10px;
        }

        .mg-stat span.mg-link {
            font-size: 11px;
            color: #315b89;
            font-weight: bold;
        }

        .mg-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .mg-card h2 {
            margin: 0 0 10px;
            font-size: 21px;
        }

        .mg-subtitle {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 22px;
            line-height: 1.7;
        }

        .mg-two-cols {
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 22px;
        }

        .mg-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .mg-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 16px;
            background: #253858;
            color: white !important;
            text-decoration: none !important;
            border-radius: 9px;
            font-weight: bold;
            font-size: 12px;
            white-space: nowrap;
        }

        .mg-btn-light {
            background: #e8efff;
            color: #315b89 !important;
        }

        .mg-btn:hover {
            filter: brightness(.94);
        }

        .mg-quick-actions {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 13px;
        }

        .mg-action {
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 12px;
            padding: 19px;
            text-decoration: none !important;
            color: #172b4d !important;
        }

        .mg-action:hover {
            border-color: #93c5fd;
            background: #edf4ff;
        }

        .mg-action-icon {
            font-size: 23px;
            display: block;
            margin-bottom: 13px;
        }

        .mg-action strong {
            font-size: 14px;
            display: block;
            margin-bottom: 8px;
        }

        .mg-action small {
            font-size: 11px;
            color: #64748b;
        }

        .mg-performance {
            background: linear-gradient(120deg, #172b4d, #315b89);
            border-radius: 17px;
            padding: 27px;
            color: white;
            margin-bottom: 25px;
        }

        .mg-performance h2 {
            color: white !important;
            margin: 0 0 10px;
            font-size: 22px;
        }

        .mg-performance p {
            color: #bfdbfe;
            font-size: 13px;
            line-height: 1.6;
        }

        .mg-performance-grid {
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 12px;
            margin-top: 20px;
        }

        .mg-performance-stat {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.15);
            padding: 18px;
            border-radius: 12px;
        }

        .mg-performance-stat small {
            display: block;
            color: #bfdbfe;
            font-size: 12px;
            margin-bottom: 13px;
        }

        .mg-performance-stat strong {
            font-size: 28px;
        }

        .mg-progress {
            height: 10px;
            background: rgba(255,255,255,.15);
            border-radius: 20px;
            overflow: hidden;
            margin-top: 22px;
        }

        .mg-progress-bar {
            height: 100%;
            background: #60a5fa;
            border-radius: 20px;
        }

        .mg-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
        }

        .mg-page table {
            width: 100%;
            border-collapse: collapse;
            min-width: 620px;
        }

        .mg-page th {
            background: #253858;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 12px;
        }

        .mg-page td {
            padding: 17px 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .mg-page tbody tr:hover {
            background: #f8fafc;
        }

        .mg-team {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .mg-team-icon {
            background: #e8efff;
            width: 39px;
            height: 39px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .mg-badge {
            display: inline-block;
            background: #e8efff;
            color: #315b89;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: bold;
        }

        .mg-event {
            display: flex;
            gap: 14px;
            align-items: center;
            padding: 17px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .mg-event:last-child {
            border-bottom: none;
        }

        .mg-event-date {
            width: 53px;
            height: 60px;
            background: #e8efff;
            border-radius: 11px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .mg-event-date strong {
            font-size: 22px;
        }

        .mg-event-date small {
            font-size: 10px;
            color: #64748b;
            margin-top: 5px;
        }

        .mg-event-info {
            flex: 1;
        }

        .mg-event-info h3 {
            font-size: 14px;
            margin: 0 0 7px;
        }

        .mg-event-info p {
            font-size: 12px;
            line-height: 1.7;
            color: #64748b;
            margin: 0;
        }

        .mg-result {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            text-align: center;
            gap: 15px;
            padding: 20px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .mg-result:last-child {
            border-bottom: none;
        }

        .mg-result strong {
            font-size: 14px;
        }

        .mg-score {
            background: #253858;
            color: white;
            border-radius: 10px;
            font-weight: bold;
            padding: 13px 19px;
            font-size: 21px;
            white-space: nowrap;
        }

        .mg-win {
            background: #dcfce7;
            color: #15803d;
        }

        .mg-loss {
            background: #fee2e2;
            color: #b91c1c;
        }

        .mg-empty {
            padding: 30px 10px;
            text-align: center;
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
        }

        .mg-footer {
            text-align: center;
            font-size: 12px;
            color: #64748b;
            margin-top: 25px;
        }

        @media(max-width: 900px) {
            .mg-stats,
            .mg-quick-actions {
                grid-template-columns: repeat(2,1fr);
            }

            .mg-two-cols {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .mg-performance-grid {
                grid-template-columns: repeat(2,1fr);
            }
        }

        @media(max-width: 500px) {
            .mg-hero,
            .mg-card,
            .mg-performance {
                padding: 20px;
            }

            .mg-hero h1 {
                font-size: 24px;
            }

            .mg-avatar {
                display: none;
            }

            .mg-stat {
                padding: 15px;
            }

            .mg-stat h2 {
                font-size: 25px;
            }

            .mg-stat-icon {
                width: 30px;
                height: 30px;
                font-size: 15px;
            }

            .mg-result {
                gap: 8px;
            }

            .mg-score {
                padding: 10px;
                font-size: 17px;
            }
        }
    </style>

    <div class="mg-page">

        {{-- HERO --}}

        <div class="mg-hero">

            <div>

                <small>KV GJINOCI | MANAGEMENT CENTER</small>

                <h1>
                    Miresevjen, {{ auth()->user()->name }}!
                </h1>

                <p>
                    Menaxho klubin, ekipet, stafin profesional
                    dhe aktivitetet sportive nga nje vend.
                </p>

                <p style="margin-top:12px; color:#bfdbfe;">

                    {{ now()->format('d.m.Y') }}

                </p>

            </div>

            <div class="mg-avatar">

                {{ mb_strtoupper(
                    mb_substr(auth()->user()->name, 0, 1)
                ) }}

            </div>

        </div>

        {{-- STATISTIKAT --}}

        <div class="mg-stats">

            @foreach([
                ['Ekipet', $totalEkipe, '🏐', 'ekipet.index'],
                ['Volejbollistet', $totalLojtare, '👥', 'lojtar.index'],
                ['Trajneret', $totalTrajnere, '👨‍💼', 'trajner.index'],
                ['Ndeshjet', $totalNdeshje, '🏆', 'ndeshjet.index'],
                ['Stervitjet', $totalStervitje, '📋', 'stervitjet.index'],
                ['Kampionatet', $totalKampionate, '🥇', 'kampionatet.index'],
                ['Klubet', $totalKlube, '🏟️', 'klubet.index'],
                ['Sezonet', $totalSezone, '📅', 'sezonet.index']
            ] as [$label, $value, $icon, $routeName])

                <a href="{{ route($routeName) }}" class="mg-stat">

                    <div class="mg-stat-top">

                        <small>{{ $label }}</small>

                        <span class="mg-stat-icon">
                        {{ $icon }}
                    </span>

                    </div>

                    <h2>{{ $value }}</h2>

                    <span class="mg-link">

                    Shiko detajet →

                </span>

                </a>

            @endforeach

        </div>

        {{-- QUICK ACTIONS --}}

        <div class="mg-card">

            <h2>Qasje e Shpejte</h2>

            <p class="mg-subtitle">
                Funksionet kryesore per menaxhimin e klubit.
            </p>

            <div class="mg-quick-actions">

                @foreach([
                    ['Shto Volejbolliste', '👤', 'Regjistro nje lojtare', 'lojtar.create'],
                    ['Shto Ekip', '🏐', 'Organizo ekipet', 'ekipet.create'],
                    ['Shto Ndeshje', '🏆', 'Planifiko nje ndeshje', 'ndeshjet.create'],
                    ['Shto Stervitje', '📋', 'Organizo stervitjen', 'stervitjet.create'],
                    ['Shto Trajner', '👨‍💼', 'Menaxho stafin', 'trajner.create'],
                    ['Performance', '📈', 'Analizo lojtaret', 'performance.index'],
                    ['Statistikat', '📊', 'Analizo ekipet', 'statistics.index'],
                    ['Kampionatet', '🥇', 'Menaxho garat', 'kampionatet.index']
                ] as [$label, $icon, $description, $routeName])

                    <a href="{{ route($routeName) }}"
                       class="mg-action">

                    <span class="mg-action-icon">
                        {{ $icon }}
                    </span>

                        <strong>{{ $label }}</strong>

                        <small>{{ $description }}</small>

                    </a>

                @endforeach

            </div>

        </div>

        {{-- PERFORMANCA E KLUBIT --}}

        <div class="mg-performance">

            <h2>Performanca e Klubit</h2>

            <p>
                Pasqyra e rezultateve te krejt ekipeve
                nga ndeshjet e perfunduara.
            </p>

            <div class="mg-performance-grid">

                <div class="mg-performance-stat">
                    <small>Ndeshje te Perfunduar</small>
                    <strong>{{ $ndeshjetPerfunduar }}</strong>
                </div>

                <div class="mg-performance-stat">
                    <small>Fitore</small>
                    <strong style="color:#86efac;">
                        {{ $fitore }}
                    </strong>
                </div>

                <div class="mg-performance-stat">
                    <small>Humbje</small>
                    <strong style="color:#fca5a5;">
                        {{ $humbje }}
                    </strong>
                </div>

                <div class="mg-performance-stat">
                    <small>Win Rate</small>
                    <strong>{{ $winRate }}%</strong>
                </div>

            </div>

            <div class="mg-progress">

                <div class="mg-progress-bar"
                     style="width: {{ $winRate }}%;">

                </div>

            </div>

        </div>

        {{-- EKIPET --}}

        <div class="mg-card">

            <div class="mg-card-header">

                <h2>Ekipet e Klubit</h2>

                <a href="{{ route('ekipet.index') }}"
                   class="mg-btn mg-btn-light">

                    Menaxho Ekipet

                </a>

            </div>

            <p class="mg-subtitle">
                Organizimi i ekipeve, trajneret dhe volejbollistet.
            </p>

            <div class="mg-table-wrap">

                <table>

                    <thead>

                    <tr>
                        <th>Ekipi</th>
                        <th>Kategoria</th>
                        <th>Trajneri</th>
                        <th>Volejbolliste</th>
                        <th>Veprimet</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($ekipet as $ekipi)

                        @php
                            $trajner = $trajneret->get(
                                $ekipi->trajner_id
                            );
                        @endphp

                        <tr>

                            <td>

                                <div class="mg-team">

                                    <div class="mg-team-icon">
                                        🏐
                                    </div>

                                    <strong>
                                        {{ $ekipi->emri }}
                                    </strong>

                                </div>

                            </td>

                            <td>
                                {{ $ekipi->kategoria ?? '-' }}
                            </td>

                            <td>

                                {{ $trajner
                                    ? $trajner->emri . ' ' . $trajner->mbiemri
                                    : 'Pa trajner' }}

                            </td>

                            <td>

                                <span class="mg-badge">

                                    {{ $lojtaretByTeam->get(
                                        $ekipi->id,
                                        0
                                    ) }}

                                </span>

                            </td>

                            <td>

                                <a href="{{ route(
                                    'ekipet.show',
                                    $ekipi
                                ) }}"
                                   class="mg-btn mg-btn-light">

                                    Shiko

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="mg-empty">

                                Nuk ka ekipe te regjistruara.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- ORARI --}}

        <div class="mg-two-cols">

            <div class="mg-card">

                <div class="mg-card-header">

                    <h2>Ndeshjet e Ardhshme</h2>

                    <a href="{{ route('ndeshjet.index') }}"
                       class="mg-btn mg-btn-light">

                        Shiko te gjitha

                    </a>

                </div>

                <p class="mg-subtitle">
                    Ndeshjet e planifikuara te klubit.
                </p>

                @forelse($ndeshjetArdhshme as $ndeshja)

                    @php
                        $data = \Carbon\Carbon::parse(
                            $ndeshja->data_ndeshjes
                        );
                    @endphp

                    <div class="mg-event">

                        <div class="mg-event-date">

                            <strong>
                                {{ $data->format('d') }}
                            </strong>

                            <small>
                                {{ $data->format('m/Y') }}
                            </small>

                        </div>

                        <div class="mg-event-info">

                            <h3>

                                {{ $ndeshja->ekipi?->emri ?? '-' }}

                                vs

                                {{ $ndeshja->kundershtari }}

                            </h3>

                            <p>

                                {{ $data->format('H:i') }}

                                |

                                {{ $ndeshja->palestra ?? '-' }}

                            </p>

                        </div>

                    </div>

                @empty

                    <div class="mg-empty">

                        Nuk ka ndeshje te ardhshme.

                    </div>

                @endforelse

            </div>

            <div class="mg-card">

                <div class="mg-card-header">

                    <h2>Stervitjet e Ardhshme</h2>

                    <a href="{{ route('stervitjet.index') }}"
                       class="mg-btn mg-btn-light">

                        Shiko te gjitha

                    </a>

                </div>

                <p class="mg-subtitle">
                    Orari i aktiviteteve stervitore.
                </p>

                @forelse($stervitjetArdhshme as $stervitja)

                    @php
                        $data = \Carbon\Carbon::parse(
                            $stervitja->data
                        );
                    @endphp

                    <div class="mg-event">

                        <div class="mg-event-date">

                            <strong>
                                {{ $data->format('d') }}
                            </strong>

                            <small>
                                {{ $data->format('m/Y') }}
                            </small>

                        </div>

                        <div class="mg-event-info">

                            <h3>

                                {{ $stervitja->ekipi?->emri ?? '-' }}

                                -

                                {{ $stervitja->lloji ?? 'Stervitje' }}

                            </h3>

                            <p>

                                {{ substr(
                                    $stervitja->ora_fillimit ?? '',
                                    0,
                                    5
                                ) }}

                                -

                                {{ substr(
                                    $stervitja->ora_mbarimit ?? '',
                                    0,
                                    5
                                ) }}

                                |

                                {{ $stervitja->palestra ?? '-' }}

                            </p>

                        </div>

                    </div>

                @empty

                    <div class="mg-empty">

                        Nuk ka stervitje te ardhshme.

                    </div>

                @endforelse

            </div>

        </div>

        {{-- REZULTATET E FUNDIT --}}

        <div class="mg-card">

            <div class="mg-card-header">

                <h2>Rezultatet e Fundit</h2>

                <a href="{{ route('ndeshjet.index') }}"
                   class="mg-btn mg-btn-light">

                    Menaxho Ndeshjet

                </a>

            </div>

            <p class="mg-subtitle">
                5 ndeshjet e fundit te perfunduara.
            </p>

            @forelse($rezultatetFundit as $ndeshja)

                @php
                    $fitoreNdeshja =
                        $ndeshja->setet_tona >
                        $ndeshja->setet_kundershtarit;
                @endphp

                <div class="mg-result">

                    <div>

                        <strong>
                            {{ $ndeshja->ekipi?->emri ?? '-' }}
                        </strong>

                        <div style="margin-top:9px;">

                        <span class="mg-badge {{ $fitoreNdeshja ? 'mg-win' : 'mg-loss' }}">

                            {{ $fitoreNdeshja ? 'Fitore' : 'Humbje' }}

                        </span>

                        </div>

                    </div>

                    <div class="mg-score">

                        {{ $ndeshja->setet_tona }}

                        :

                        {{ $ndeshja->setet_kundershtarit }}

                    </div>

                    <div>

                        <strong>
                            {{ $ndeshja->kundershtari }}
                        </strong>

                        <div style="font-size:11px; color:#64748b; margin-top:9px;">

                            {{ \Carbon\Carbon::parse(
                                $ndeshja->data_ndeshjes
                            )->format('d.m.Y') }}

                        </div>

                    </div>

                </div>

            @empty

                <div class="mg-empty">

                    Nuk ka rezultate te regjistruara.

                </div>

            @endforelse

        </div>

        <div class="mg-footer">

            KV Gjinoci | Manager Portal |
            {{ auth()->user()->email }}

        </div>

    </div>

@endsection
