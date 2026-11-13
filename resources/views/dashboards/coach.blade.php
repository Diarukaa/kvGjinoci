@extends('layouts.club')

@section('title', 'Dashboard i Trajnerit - KV Gjinoci')

@section('content')

    <style>
        .coach-page {
            max-width: 1150px;
            margin: 0 auto;
            padding: 15px 0 40px;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .coach-page * {
            box-sizing: border-box;
        }

        .coach-hero {
            background: linear-gradient(120deg, #172b4d, #315b89);
            border-radius: 20px;
            padding: 35px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .coach-hero small {
            display: block;
            color: #bfdbfe;
            letter-spacing: 1.5px;
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 14px;
        }

        .coach-hero h1 {
            color: white !important;
            font-size: 32px;
            margin: 0 0 13px;
        }

        .coach-hero p {
            color: #dbeafe;
            line-height: 1.6;
            font-size: 14px;
            margin: 0;
        }

        .coach-avatar {
            width: 80px;
            height: 80px;
            border-radius: 22px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .coach-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 25px;
        }

        .coach-stat {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 23px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .coach-stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .coach-stat-icon {
            background: #e8efff;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .coach-stat h2 {
            font-size: 32px;
            margin: 0;
            color: #172b4d;
        }

        .coach-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .coach-card h2 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        .coach-subtitle {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 23px;
        }

        .coach-teams {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .coach-team {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .coach-team-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .coach-team h3 {
            margin: 0 0 7px;
            font-size: 16px;
        }

        .coach-team p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
        }

        .coach-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
        }

        .coach-page table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        .coach-page th {
            background: #253858;
            color: white;
            text-align: left;
            padding: 15px;
            font-size: 13px;
        }

        .coach-page td {
            padding: 16px 15px;
            border-bottom: 1px solid #e5ebf3;
            font-size: 13px;
        }

        .coach-page tbody tr:hover {
            background: #f8fafc;
        }

        .coach-player {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .coach-player-avatar {
            width: 39px;
            height: 39px;
            background: #e8efff;
            border-radius: 50%;
            color: #253858;
            font-size: 13px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .coach-position {
            display: inline-block;
            background: #e8efff;
            color: #315b89;
            padding: 7px 10px;
            border-radius: 7px;
            font-weight: bold;
            font-size: 11px;
        }

        .coach-warning {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            border-radius: 13px;
            padding: 22px;
            margin-bottom: 25px;
            line-height: 1.7;
            font-size: 14px;
        }

        .coach-warning strong {
            display: block;
            margin-bottom: 7px;
        }

        .coach-empty {
            text-align: center;
            color: #64748b;
            padding: 30px !important;
        }

        .coach-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            color: #64748b;
            font-size: 13px;
        }

        .coach-bottom form {
            margin: 0;
        }

        .coach-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            border: none;
            border-radius: 9px;
            background: #253858;
            color: white;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .coach-btn:hover {
            background: #172b4d;
        }

        @media (max-width: 900px) {
            .coach-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 550px) {
            .coach-stats,
            .coach-teams {
                grid-template-columns: 1fr;
            }

            .coach-hero {
                padding: 24px;
            }

            .coach-hero h1 {
                font-size: 24px;
            }

            .coach-avatar {
                display: none;
            }

            .coach-card {
                padding: 17px;
            }

            .coach-bottom {
                flex-wrap: wrap;
            }
        }
    </style>

    <div class="coach-page">

        <div class="coach-hero">

            <div>

                <small>KV GJINOCI | COACH PORTAL</small>

                <h1>
                    Miresevjen, {{ auth()->user()->name }}!
                </h1>

                <p>
                    Percjell ekipet, lojtaret dhe aktivitetet sportive
                    qe jane nen menaxhimin tend.
                </p>

            </div>

            <div class="coach-avatar">
                {{ mb_strtoupper(
                    mb_substr(auth()->user()->name, 0, 1)
                ) }}
            </div>

        </div>

        @if(!$trajner)

            <div class="coach-warning">

                <strong>Profili ende nuk eshte lidhur</strong>

                Llogaria jote eshte aktive, por ende nuk eshte
                lidhur me profilin e trajnerit ne klub.
                Kontakto administratorin per ta perfunduar lidhjen.

            </div>

        @else

            <div class="coach-stats">

                @foreach([
                    ['Ekipet e Mia', $totalEkipe, '👥'],
                    ['Volejbollistet', $totalLojtare, '🏐'],
                    ['Stervitjet', $totalStervitje, '📋'],
                    ['Ndeshjet', $totalNdeshje, '🏆']
                ] as [$label, $value, $icon])

                    <div class="coach-stat">

                        <div class="coach-stat-top">

                            <span>{{ $label }}</span>

                            <span class="coach-stat-icon">
                            {{ $icon }}
                        </span>

                        </div>

                        <h2>{{ $value }}</h2>

                    </div>

                @endforeach

            </div>

            <div class="coach-card">

                <h2>Ekipet e Mia</h2>

                <p class="coach-subtitle">
                    Ekipet ku je i caktuar si trajner.
                </p>

                <div class="coach-teams">

                    @forelse($ekipet as $ekipi)

                        <div class="coach-team">

                            <div class="coach-team-icon">
                                🏐
                            </div>

                            <div>

                                <h3>{{ $ekipi->emri }}</h3>

                                <p>
                                    {{ $ekipi->kategoria ?? '-' }}
                                </p>

                            </div>

                        </div>

                    @empty

                        <p class="coach-empty">
                            Nuk je caktuar ende ne asnje ekip.
                        </p>

                    @endforelse

                </div>

            </div>

            <div class="coach-card">

                <h2>Volejbollistet e Mia</h2>

                <p class="coach-subtitle">
                    Lista e lojtareve nga ekipet qe i udheheq.
                </p>

                <div class="coach-table-wrap">

                    <table>

                        <thead>

                        <tr>
                            <th>Volejbollistja</th>
                            <th>Ekipi</th>
                            <th>Pozicioni</th>
                            <th>Gjatesia</th>
                        </tr>

                        </thead>

                        <tbody>

                        @forelse($lojtaret as $lojtar)

                            <tr>

                                <td>

                                    <div class="coach-player">

                                        <div class="coach-player-avatar">

                                            {{ mb_strtoupper(
                                                mb_substr($lojtar->emri, 0, 1)
                                                .
                                                mb_substr($lojtar->mbiemri, 0, 1)
                                            ) }}

                                        </div>

                                        <strong>
                                            {{ $lojtar->emri }}
                                            {{ $lojtar->mbiemri }}
                                        </strong>

                                    </div>

                                </td>

                                <td>

                                    {{ $ekipet->firstWhere(
                                        'id',
                                        $lojtar->ekipi_id
                                    )?->emri ?? '-' }}

                                </td>

                                <td>

                                    <span class="coach-position">
                                        {{ $lojtar->pozicioni ?? '-' }}
                                    </span>

                                </td>

                                <td>

                                    {{ $lojtar->gjatesia
                                        ? $lojtar->gjatesia . ' cm'
                                        : '-' }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="coach-empty">

                                    Nuk ka volejbolliste
                                    ne ekipet e tua.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        @endif

        <div class="coach-bottom">

        <span>

            KV Gjinoci |
            {{ auth()->user()->email }}

        </span>

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit" class="coach-btn">

                    Dil nga Sistemi

                </button>

            </form>

        </div>

    </div>

@endsection
