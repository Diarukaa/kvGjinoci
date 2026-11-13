@extends('layouts.club')

@section('title', 'Dashboard - KV Gjinoci')

@section('content')

    <style>

        .dashboard {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
        }

        .dashboard * {
            box-sizing: border-box;
        }

        .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            gap: 15px;
        }

        .dashboard-header h1 {
            margin: 0 0 7px;
            font-size: 29px;
        }

        .dashboard-header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .dashboard-date {
            background: white;
            padding: 12px 18px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13px;
            color: #64748b;
            white-space: nowrap;
        }

        /* HERO SECTION */

        .dashboard-hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(
                125deg,
                #101e36 0%,
                #203c63 65%,
                #315b89 100%
            );
            border-radius: 20px;
            padding: 36px;
            color: white;
            margin-bottom: 28px;
            min-height: 230px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 650px;
        }

        .season-label {
            display: inline-block;
            background: rgba(255,255,255,0.12);
            color: #bfdbfe;
            border: 1px solid rgba(255,255,255,0.18);
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            letter-spacing: 1px;
            font-weight: bold;
        }

        .dashboard-hero h2 {
            font-size: 34px;
            margin: 18px 0 10px;
            color: white;
        }

        .dashboard-hero p {
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 15px;
            max-width: 480px;
            margin-bottom: 24px;
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .hero-btn {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s;
        }

        .hero-btn-primary {
            color: #172b4d !important;
            background: white;
        }

        .hero-btn-secondary {
            color: white !important;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .hero-btn:hover {
            transform: translateY(-2px);
        }

        .hero-ball {
            position: absolute;
            right: 45px;
            top: 35px;
            font-size: 135px;
            opacity: 0.85;
            transform: rotate(-15deg);
            filter: drop-shadow(
                0 15px 20px rgba(0,0,0,0.25)
            );
        }

        .hero-circle {
            position: absolute;
            width: 300px;
            height: 300px;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 50%;
            right: -40px;
            top: -45px;
        }

        .hero-circle-two {
            position: absolute;
            width: 420px;
            height: 420px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 50%;
            right: -100px;
            top: -105px;
        }

        /* STATISTICS CARDS */

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 30px;
        }

        .dashboard-stat {
            display: block;
            text-decoration: none !important;
            color: #172b4d !important;
            background: white;
            padding: 22px;
            border-radius: 15px;
            border: 1px solid #e8edf5;
            box-shadow: 0 4px 15px rgba(15,23,42,0.035);
            transition: 0.2s;
        }

        .dashboard-stat:hover {
            transform: translateY(-4px);
            border-color: #bfdbfe;
            box-shadow: 0 10px 25px rgba(15,23,42,0.07);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .stat-label {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .icon-blue {
            background: #e8efff;
            color: #2563eb;
        }

        .icon-green {
            background: #e5f8ef;
            color: #059669;
        }

        .icon-purple {
            background: #f1eaff;
            color: #7c3aed;
        }

        .icon-orange {
            background: #fff3df;
            color: #d97706;
        }

        .dashboard-stat h2 {
            font-size: 36px;
            margin: 16px 0 10px;
        }

        .stat-bottom {
            font-size: 12px;
            color: #64748b;
            display: flex;
            justify-content: space-between;
        }

        /* MANAGEMENT SECTION */

        .dashboard-section-title {
            margin: 0 0 17px;
            font-size: 21px;
        }

        .module-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .module-card {
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 13px;
            padding: 22px;
            text-decoration: none !important;
            color: #172b4d !important;
            transition: 0.2s;
        }

        .module-card:hover {
            background: #f8faff;
            transform: translateY(-3px);
            border-color: #bfdbfe;
        }

        .module-content {
            flex: 1;
        }

        .module-content h3 {
            font-size: 16px;
            margin: 0 0 5px;
        }

        .module-content p {
            font-size: 12px;
            color: #64748b;
            margin: 0;
            line-height: 1.5;
        }

        .module-arrow {
            color: #94a3b8;
            font-size: 22px;
        }

        /* UPCOMING EVENTS */

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .schedule-card {
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 15px;
            padding: 24px;
        }

        .schedule-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .schedule-heading h2 {
            font-size: 18px;
            margin: 0;
        }

        .schedule-heading a {
            color: #2563eb;
            font-size: 13px;
            text-decoration: none;
        }

        .event-row {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #edf0f5;
            text-decoration: none !important;
            color: #172b4d !important;
        }

        .event-row:last-child {
            border-bottom: none;
        }

        .event-date {
            background: #eaf0fa;
            border-radius: 10px;
            padding: 10px;
            min-width: 55px;
            text-align: center;
        }

        .event-date strong {
            display: block;
            font-size: 21px;
        }

        .event-date small {
            font-size: 11px;
            color: #64748b;
        }

        .event-info {
            flex: 1;
        }

        .event-info h4 {
            margin: 0 0 6px;
            font-size: 14px;
        }

        .event-info p {
            margin: 0;
            font-size: 12px;
            color: #64748b;
        }

        .event-status {
            background: #eaf2ff;
            color: #2563eb;
            padding: 6px 9px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: bold;
        }

        .dashboard-empty {
            text-align: center;
            color: #94a3b8;
            font-size: 14px;
            padding: 30px 10px;
        }

        .dashboard-footer {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            padding: 15px;
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {
            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .module-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-ball {
                right: 20px;
                font-size: 100px;
            }
        }

        @media (max-width: 750px) {
            .dashboard-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .dashboard-hero {
                padding: 25px;
            }

            .dashboard-hero h2 {
                font-size: 25px;
            }

            .hero-ball {
                display: none;
            }

            .module-grid,
            .schedule-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-stat {
                padding: 16px;
            }

            .stat-top {
                align-items: flex-start;
            }

            .stat-label {
                font-size: 12px;
            }

            .stat-icon {
                width: 35px;
                height: 35px;
                font-size: 17px;
            }
        }

        @media (max-width: 420px) {
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
        }

    </style>

    <div class="dashboard">

        {{-- PAGE HEADER --}}

        <div class="dashboard-header">
            <div>
                <h1>Dashboard</h1>
                <p>Permbledhje e aktivitetit te klubit.</p>
            </div>

            <div class="dashboard-date">
                📅 {{ now()->format('d.m.Y') }}
            </div>
        </div>

        {{-- WELCOME SECTION --}}

        <div class="dashboard-hero">

            <div class="hero-circle"></div>
            <div class="hero-circle-two"></div>

            <div class="hero-ball">🏐</div>

            <div class="hero-content">

            <span class="season-label">
                SEZONI {{ $sezoniAktiv?->emri ?? 'PA SEZON AKTIV' }}
            </span>

                <h2>Miresevini ne KV Gjinoci!</h2>

                <p>
                    Menaxho volejbollistet, ekipet,
                    ndeshjet dhe performancen e klubit
                    nga nje vend i vetem.
                </p>

                <div class="hero-buttons">

                    <a class="hero-btn hero-btn-primary"
                       href="{{ route('ndeshjet.create') }}">
                        + Shto Ndeshje
                    </a>

                    <a class="hero-btn hero-btn-secondary"
                       href="{{ route('stervitjet.index') }}">
                        Shiko Orarin →
                    </a>

                </div>

            </div>

        </div>

        {{-- MAIN STATISTICS --}}

        <div class="dashboard-stats">

            <a class="dashboard-stat"
               href="{{ route('lojtar.index') }}">

                <div class="stat-top">
                    <span class="stat-label">Volejbollistet</span>
                    <span class="stat-icon icon-blue">👥</span>
                </div>

                <h2>{{ $totalLojtare }}</h2>

                <div class="stat-bottom">
                    <span>Volejbolliste te regjistruara</span>
                    <span>→</span>
                </div>

            </a>

            <a class="dashboard-stat"
               href="{{ route('trajner.index') }}">

                <div class="stat-top">
                    <span class="stat-label">Trajneret</span>
                    <span class="stat-icon icon-green">👤</span>
                </div>

                <h2>{{ $totalTrajnere }}</h2>

                <div class="stat-bottom">
                    <span>Stafi profesional</span>
                    <span>→</span>
                </div>

            </a>

            <a class="dashboard-stat"
               href="{{ route('ekipet.index') }}">

                <div class="stat-top">
                    <span class="stat-label">Ekipet</span>
                    <span class="stat-icon icon-purple">🛡️</span>
                </div>

                <h2>{{ $totalEkipe }}</h2>

                <div class="stat-bottom">
                    <span>Ekipe te regjistruara</span>
                    <span>→</span>
                </div>

            </a>

            <a class="dashboard-stat"
               href="{{ route('ndeshjet.index') }}">

                <div class="stat-top">
                    <span class="stat-label">Ndeshjet</span>
                    <span class="stat-icon icon-orange">🏆</span>
                </div>

                <h2>{{ $totalNdeshje }}</h2>

                <div class="stat-bottom">
                    <span>Total ndeshje</span>
                    <span>→</span>
                </div>

            </a>

        </div>

        {{-- CLUB MANAGEMENT --}}

        <h2 class="dashboard-section-title">
            Menaxhimi i Klubit
        </h2>

        <div class="module-grid">

            <a class="module-card"
               href="{{ route('kampionatet.index') }}">

                <div class="stat-icon icon-orange">🏆</div>

                <div class="module-content">
                    <h3>Kampionatet</h3>
                    <p>
                        {{ $totalKampionate }} kampionate,
                        rezultate dhe klasifikimi.
                    </p>
                </div>

                <span class="module-arrow">›</span>
            </a>

            <a class="module-card"
               href="{{ route('stervitjet.index') }}">

                <div class="stat-icon icon-blue">📅</div>

                <div class="module-content">
                    <h3>Stervitjet</h3>
                    <p>
                        {{ $totalStervitje }} stervitje,
                        orari dhe prezenca.
                    </p>
                </div>

                <span class="module-arrow">›</span>
            </a>

            <a class="module-card"
               href="{{ route('performance.index') }}">

                <div class="stat-icon icon-green">📈</div>

                <div class="module-content">
                    <h3>Player Performance</h3>
                    <p>
                        Piket dhe performanca
                        individuale.
                    </p>
                </div>

                <span class="module-arrow">›</span>
            </a>

            <a class="module-card"
               href="{{ route('statistics.index') }}">

                <div class="stat-icon icon-purple">📊</div>

                <div class="module-content">
                    <h3>Statistikat</h3>
                    <p>
                        Fitoret, humbjet dhe
                        statistikat e ekipeve.
                    </p>
                </div>

                <span class="module-arrow">›</span>
            </a>

            <a class="module-card"
               href="{{ route('klubet.index') }}">

                <div class="stat-icon icon-blue">🛡️</div>

                <div class="module-content">
                    <h3>Klubet</h3>
                    <p>
                        {{ $totalKlube }} klube
                        te regjistruara.
                    </p>
                </div>

                <span class="module-arrow">›</span>
            </a>

            <a class="module-card"
               href="{{ route('managers.index') }}">

                <div class="stat-icon icon-purple">💼</div>

                <div class="module-content">
                    <h3>Menaxheret</h3>
                    <p>
                        {{ $totalManagers }} anetare
                        te stafit administrativ.
                    </p>
                </div>

                <span class="module-arrow">›</span>
            </a>

            <a class="module-card"
               href="{{ route('sezonet.index') }}">

                <div class="stat-icon icon-green">🗓️</div>

                <div class="module-content">
                    <h3>Sezonet</h3>
                    <p>Menaxhimi i sezoneve sportive.</p>
                </div>

                <span class="module-arrow">›</span>
            </a>

        </div>

        {{-- UPCOMING MATCHES AND TRAINING --}}

        <h2 class="dashboard-section-title">
            Aktivitetet e Ardhshme
        </h2>

        <div class="schedule-grid">

            <div class="schedule-card">

                <div class="schedule-heading">

                    <h2>🏐 Ndeshjet</h2>

                    <a href="{{ route('ndeshjet.index') }}">
                        Shiko te gjitha →
                    </a>

                </div>

                @forelse($ndeshjetEArdhshme as $ndeshja)

                    <a class="event-row"
                       href="{{ route('ndeshjet.show', $ndeshja) }}">

                        <div class="event-date">

                            <strong>
                                {{ $ndeshja->data_ndeshjes->format('d') }}
                            </strong>

                            <small>
                                {{ $ndeshja->data_ndeshjes->format('m/Y') }}
                            </small>

                        </div>

                        <div class="event-info">

                            <h4>
                                {{ $ndeshja->ekipi->emri }}
                                vs
                                {{ $ndeshja->kundershtari }}
                            </h4>

                            <p>
                                {{ $ndeshja->data_ndeshjes->format('H:i') }}
                                · {{ $ndeshja->palestra }}
                            </p>

                        </div>

                        <span class="event-status">
                        Planifikuar
                    </span>

                    </a>

                @empty

                    <div class="dashboard-empty">
                        Nuk ka ndeshje te ardhshme.
                    </div>

                @endforelse

            </div>

            <div class="schedule-card">

                <div class="schedule-heading">

                    <h2>📅 Stervitjet</h2>

                    <a href="{{ route('stervitjet.index') }}">
                        Shiko te gjitha →
                    </a>

                </div>

                @forelse($stervitjetEArdhshme as $stervitja)

                    <a class="event-row"
                       href="{{ route('stervitjet.show', $stervitja) }}">

                        <div class="event-date">

                            <strong>
                                {{ $stervitja->data->format('d') }}
                            </strong>

                            <small>
                                {{ $stervitja->data->format('m/Y') }}
                            </small>

                        </div>

                        <div class="event-info">

                            <h4>
                                {{ $stervitja->ekipi->emri }}
                            </h4>

                            <p>
                                {{ substr($stervitja->ora_fillimit, 0, 5) }}
                                · {{ $stervitja->lloji }}
                                · {{ $stervitja->palestra }}
                            </p>

                        </div>

                        <span class="event-status">
                        Planifikuar
                    </span>

                    </a>

                @empty

                    <div class="dashboard-empty">
                        Nuk ka stervitje te ardhshme.
                    </div>

                @endforelse

            </div>

        </div>

        <div class="dashboard-footer">

            KV Gjinoci © {{ now()->year }}
            · Volleyball Club Management System

        </div>

    </div>

@endsection
