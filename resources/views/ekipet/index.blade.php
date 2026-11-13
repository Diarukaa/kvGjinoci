@extends('layouts.club')

@section('title', 'Ekipet - KV Gjinoci')

@section('content')

    <style>
        .teams-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
        }

        .teams-page * {
            box-sizing: border-box;
        }

        .teams-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .teams-header h1 {
            margin: 0 0 7px;
            font-size: 30px;
        }

        .teams-header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .team-add-btn {
            background: #253858;
            color: white !important;
            text-decoration: none !important;
            padding: 13px 20px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: bold;
            white-space: nowrap;
            transition: 0.2s;
        }

        .team-add-btn:hover {
            background: #172b4d;
            transform: translateY(-2px);
        }

        /* STATISTICS */

        .teams-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 30px;
        }

        .team-stat-card {
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(15,23,42,0.04);
        }

        .team-stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .team-stat-label {
            font-size: 14px;
            color: #64748b;
        }

        .team-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 21px;
        }

        .team-blue {
            background: #e8efff;
        }

        .team-purple {
            background: #f1eaff;
        }

        .team-green {
            background: #e5f8ef;
        }

        .team-stat-card h2 {
            font-size: 35px;
            margin: 15px 0 7px;
        }

        .team-stat-card small {
            color: #94a3b8;
            font-size: 12px;
        }

        /* TEAM CARDS */

        .teams-section-title {
            font-size: 22px;
            margin: 0 0 18px;
        }

        .teams-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .team-card {
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(15,23,42,0.04);
            transition: 0.2s;
        }

        .team-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(15,23,42,0.09);
        }

        .team-card-header {
            background: linear-gradient(
                130deg,
                #172b4d,
                #315b89
            );

            color: white;
            padding: 25px;
            position: relative;
            overflow: hidden;
        }

        .team-card-header::after {
            content: "🏐";
            position: absolute;
            right: -12px;
            bottom: -24px;
            font-size: 110px;
            opacity: 0.13;
            transform: rotate(-15deg);
            pointer-events: none;
        }

        .team-logo {
            position: relative;
            z-index: 1;
            width: 55px;
            height: 55px;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.12);
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 16px;
        }

        .team-card-header h2 {
            position: relative;
            z-index: 1;
            color: white;
            margin: 0 0 10px;
            font-size: 22px;
        }

        .team-category {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            border-radius: 20px;
            color: #dbeafe;
            padding: 6px 11px;
            font-size: 12px;
        }

        /* TEAM DETAILS */

        .team-card-body {
            padding: 22px;
        }

        .team-info-row {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 0;
            border-bottom: 1px solid #edf0f5;
        }

        .team-info-row:first-child {
            padding-top: 0;
        }

        .team-info-icon {
            width: 40px;
            height: 40px;
            background: #f1f5f9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .team-info-content {
            flex: 1;
        }

        .team-info-content small {
            display: block;
            color: #64748b;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .team-info-content strong {
            color: #172b4d;
            font-size: 15px;
        }

        .team-player-count {
            font-size: 24px !important;
        }

        /* TEAM ACTIONS */

        .team-card-actions {
            margin-top: 20px;
        }

        .team-view-btn {
            display: block;
            width: 100%;
            background: #e8efff;
            color: #2563eb !important;
            text-align: center;
            padding: 12px 15px;
            border-radius: 8px;
            text-decoration: none !important;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .team-view-btn:hover {
            background: #dbeafe;
        }

        .team-secondary-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .team-secondary-actions form {
            margin: 0;
        }

        .team-edit-btn,
        .team-delete-btn {
            display: block;
            width: 100%;
            padding: 11px 14px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            text-align: center;
            cursor: pointer;
        }

        .team-edit-btn {
            color: #253858 !important;
            background: #edf2f7;
        }

        .team-delete-btn {
            color: #dc2626 !important;
            background: #fff0f0;
        }

        .team-edit-btn:hover {
            background: #e2e8f0;
        }

        .team-delete-btn:hover {
            background: #ffe4e6;
        }

        .teams-empty {
            grid-column: 1 / -1;
            background: white;
            padding: 45px 25px;
            border-radius: 15px;
            text-align: center;
            color: #64748b;
        }

        .teams-empty h2 {
            color: #172b4d;
        }

        .teams-pagination {
            margin-top: 25px;
        }

        /* RESPONSIVE */

        @media (max-width: 1050px) {
            .teams-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 650px) {
            .teams-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .teams-header h1 {
                font-size: 25px;
            }

            .teams-grid,
            .teams-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="teams-page">

        @php
            $ekipetLista = $ekipet instanceof
                \Illuminate\Contracts\Pagination\Paginator
                    ? $ekipet->getCollection()
                    : collect($ekipet);

            $totalEkipe = $ekipet instanceof
                \Illuminate\Contracts\Pagination\LengthAwarePaginator
                    ? $ekipet->total()
                    : $ekipetLista->count();

            $totalVolejbolliste = $ekipetLista->sum(
                fn ($ekip) => $ekip->lojtaret_count
                    ?? $ekip->lojtaret()->count()
            );

            $ekipetMeTrajner = $ekipetLista
                ->whereNotNull('trajner_id')
                ->count();
        @endphp

        {{-- PAGE HEADER --}}

        <div class="teams-header">

            <div>
                <h1>Menaxhimi i Ekipeve</h1>

                <p>
                    Organizo ekipet, trajneret dhe
                    volejbollistet e KV Gjinocit.
                </p>
            </div>

            <a class="team-add-btn"
               href="{{ route('ekipet.create') }}">

                + Shto Ekip

            </a>

        </div>

        {{-- STATISTICS --}}

        <div class="teams-stats">

            <div class="team-stat-card">

                <div class="team-stat-top">

                <span class="team-stat-label">
                    Total Ekipe
                </span>

                    <div class="team-stat-icon team-blue">
                        🛡️
                    </div>

                </div>

                <h2>{{ $totalEkipe }}</h2>

                <small>Ekipe te regjistruara</small>

            </div>

            <div class="team-stat-card">

                <div class="team-stat-top">

                <span class="team-stat-label">
                    Volejbolliste ne Ekipe
                </span>

                    <div class="team-stat-icon team-purple">
                        👥
                    </div>

                </div>

                <h2>{{ $totalVolejbolliste }}</h2>

                <small>Ne ekipet e shfaqura</small>

            </div>

            <div class="team-stat-card">

                <div class="team-stat-top">

                <span class="team-stat-label">
                    Ekipe me Trajner
                </span>

                    <div class="team-stat-icon team-green">
                        👤
                    </div>

                </div>

                <h2>{{ $ekipetMeTrajner }}</h2>

                <small>Ne ekipet e shfaqura</small>

            </div>

        </div>

        {{-- TEAM CARDS --}}

        <h2 class="teams-section-title">
            Ekipet e Regjistruara
        </h2>

        <div class="teams-grid">

            @forelse($ekipet as $ekipi)

                <div class="team-card">

                    {{-- CARD HEADER --}}

                    <div class="team-card-header">

                        <div class="team-logo">
                            🛡️
                        </div>

                        <h2>{{ $ekipi->emri }}</h2>

                        <span class="team-category">

                        {{ $ekipi->kategoria }} · Volleyball

                    </span>

                    </div>

                    {{-- CARD BODY --}}

                    <div class="team-card-body">

                        <div class="team-info-row">

                            <div class="team-info-icon">
                                👤
                            </div>

                            <div class="team-info-content">

                                <small>Trajneri</small>

                                <strong>
                                    @if($ekipi->trajner)

                                        {{ $ekipi->trajner->emri }}
                                        {{ $ekipi->trajner->mbiemri }}

                                    @else

                                        Pa trajner

                                    @endif
                                </strong>

                            </div>

                        </div>

                        <div class="team-info-row">

                            <div class="team-info-icon">
                                👥
                            </div>

                            <div class="team-info-content">

                                <small>Volejbolliste</small>

                                <strong class="team-player-count">

                                    {{ $ekipi->lojtaret_count
                                        ?? $ekipi->lojtaret()->count() }}

                                </strong>

                            </div>

                        </div>

                        {{-- ACTION BUTTONS --}}

                        <div class="team-card-actions">

                            <a class="team-view-btn"
                               href="{{ route('ekipet.show', $ekipi) }}">

                                Shiko Ekipin →

                            </a>

                            <div class="team-secondary-actions">

                                <a class="team-edit-btn"
                                   href="{{ route('ekipet.edit', $ekipi) }}">

                                    Edito

                                </a>

                                <form method="POST"
                                      action="{{ route('ekipet.destroy', $ekipi) }}"
                                      onsubmit="return confirm('A je i sigurt qe deshiron ta fshish ekipin?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="team-delete-btn">

                                        Fshi

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="teams-empty">

                    <div style="font-size:50px">
                        🏐
                    </div>

                    <h2>Nuk ka ekipe te regjistruara.</h2>

                    <p>
                        Krijo ekipin e pare per te filluar
                        menaxhimin e klubit.
                    </p>

                    <a class="team-add-btn"
                       href="{{ route('ekipet.create') }}">

                        + Shto Ekip

                    </a>

                </div>

            @endforelse

        </div>

        @if($ekipet instanceof \Illuminate\Contracts\Pagination\Paginator)

            <div class="teams-pagination">

                {{ $ekipet->links() }}

            </div>

        @endif

    </div>

@endsection
