@extends('layouts.club')

@section('title', 'Stervitjet e Mia - KV Gjinoci')

@section('content')

    <style>
        .ct-page {
            max-width: 1150px;
            margin: 0 auto;
            padding: 15px 0 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .ct-page * {
            box-sizing: border-box;
        }

        .ct-hero {
            background: linear-gradient(120deg, #172b4d, #315b89);
            border-radius: 18px;
            padding: 32px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .ct-hero small {
            color: #bfdbfe;
            font-weight: bold;
            letter-spacing: 1.5px;
            font-size: 11px;
        }

        .ct-hero h1 {
            color: white;
            margin: 13px 0;
            font-size: 30px;
        }

        .ct-hero p {
            color: #dbeafe;
            margin: 0;
            font-size: 14px;
            line-height: 1.7;
        }

        .ct-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 25px;
        }

        .ct-stat {
            background: white;
            padding: 23px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .ct-stat small {
            color: #64748b;
            font-size: 13px;
        }

        .ct-stat h2 {
            margin: 13px 0 0;
            font-size: 30px;
        }

        .ct-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
            margin-bottom: 25px;
        }

        .ct-card h2 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        .ct-subtitle {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 25px;
        }

        .ct-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
        }

        .ct-page table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        .ct-page th {
            padding: 15px;
            background: #253858;
            color: white;
            font-size: 12px;
            text-align: left;
        }

        .ct-page td {
            padding: 17px 15px;
            font-size: 13px;
            border-bottom: 1px solid #e2e8f0;
        }

        .ct-page tbody tr:hover {
            background: #f8fafc;
        }

        .ct-badge {
            display: inline-block;
            background: #e8efff;
            color: #315b89;
            border-radius: 7px;
            padding: 7px 10px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .ct-done {
            background: #dcfce7;
            color: #15803d;
        }

        .ct-cancelled {
            background: #fee2e2;
            color: #b91c1c;
        }

        .ct-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 17px;
            background: #253858;
            color: white !important;
            border-radius: 9px;
            text-decoration: none !important;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
        }

        .ct-btn-white {
            background: white;
            color: #172b4d !important;
        }

        .ct-btn-light {
            background: #edf2f7;
            color: #253858 !important;
        }

        .ct-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ct-success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        @media(max-width: 850px) {
            .ct-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .ct-hero {
                flex-wrap: wrap;
            }
        }

        @media(max-width: 500px) {
            .ct-grid {
                grid-template-columns: 1fr;
            }

            .ct-hero, .ct-card {
                padding: 20px;
            }
        }
    </style>

    <div class="ct-page">

        <div class="ct-hero">

            <div>

                <small>KV GJINOCI | COACH PORTAL</small>

                <h1>Stervitjet e Mia</h1>

                <p>
                    Planifiko stervitjet dhe menaxho
                    prezencen e volejbollisteve.
                </p>

            </div>

            <a href="{{ route('coach.stervitjet.create') }}"
               class="ct-btn ct-btn-white">

                + Shto Stervitje

            </a>

        </div>

        @if(session('success'))

            <div class="ct-success">
                ✓ {{ session('success') }}
            </div>

        @endif

        <div class="ct-grid">

            <div class="ct-stat">
                <small>Total Stervitje</small>
                <h2>{{ $stervitjet->count() }}</h2>
            </div>

            <div class="ct-stat">
                <small>Te Planifikuara</small>
                <h2>
                    {{ $stervitjet->where('statusi', 'Planifikuar')->count() }}
                </h2>
            </div>

            <div class="ct-stat">
                <small>Te Perfunduar</small>
                <h2 style="color:#15803d;">
                    {{ $stervitjet->where('statusi', 'Perfunduar')->count() }}
                </h2>
            </div>

            <div class="ct-stat">
                <small>Te Anuluara</small>
                <h2 style="color:#b91c1c;">
                    {{ $stervitjet->where('statusi', 'Anuluar')->count() }}
                </h2>
            </div>

        </div>

        <div class="ct-card">

            <h2>Orari i Stervitjeve</h2>

            <p class="ct-subtitle">
                Stervitjet e ekipeve qe i udheheq.
            </p>

            <div class="ct-table-wrap">

                <table>

                    <thead>

                    <tr>
                        <th>Data</th>
                        <th>Orari</th>
                        <th>Ekipi</th>
                        <th>Palestra</th>
                        <th>Lloji</th>
                        <th>Statusi</th>
                        <th>Veprimet</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($stervitjet as $stervitja)

                        <tr>

                            <td>
                                <strong>
                                    {{ \Carbon\Carbon::parse(
                                        $stervitja->data
                                    )->format('d.m.Y') }}
                                </strong>
                            </td>

                            <td>
                                {{ substr($stervitja->ora_fillimit, 0, 5) }}
                                -
                                {{ substr($stervitja->ora_mbarimit, 0, 5) }}
                            </td>

                            <td>
                                {{ $stervitja->ekipi?->emri ?? '-' }}
                            </td>

                            <td>{{ $stervitja->palestra }}</td>

                            <td>{{ $stervitja->lloji }}</td>

                            <td>

                                <span class="ct-badge
                                    {{ $stervitja->statusi === 'Perfunduar' ? 'ct-done' : '' }}
                                    {{ $stervitja->statusi === 'Anuluar' ? 'ct-cancelled' : '' }}">

                                    {{ $stervitja->statusi }}

                                </span>

                            </td>

                            <td>

                                <div class="ct-actions">

                                    <a href="{{ route(
                                        'coach.stervitjet.edit',
                                        $stervitja
                                    ) }}"
                                       class="ct-btn ct-btn-light">

                                        Edito

                                    </a>

                                    @if($stervitja->statusi === 'Perfunduar')

                                        <a href="{{ route(
                                            'coach.prezenca.edit',
                                            $stervitja
                                        ) }}"
                                           class="ct-btn">

                                            Prezenca

                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                style="text-align:center; padding:35px; color:#64748b;">

                                Nuk ka stervitje te regjistruara.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <a href="{{ route('coach.dashboard') }}"
           class="ct-btn ct-btn-light">

            ← Kthehu ne Dashboard

        </a>

    </div>

@endsection
