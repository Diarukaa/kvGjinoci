@extends('layouts.club')

@section('title', 'Financat e Mia - KV Gjinoci')

@section('content')

    <style>
        .fm-page {
            max-width: 1150px;
            margin: 20px auto 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .fm-page * {
            box-sizing: border-box;
        }

        .fm-hero {
            background: linear-gradient(120deg, #172b4d, #315b89);
            color: white;
            padding: 32px;
            border-radius: 20px;
            margin-bottom: 25px;
        }

        .fm-hero h1 {
            color: white !important;
            font-size: 30px;
            margin: 14px 0;
        }

        .fm-hero small {
            color: #bfdbfe;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .fm-hero p {
            color: #dbeafe;
            font-size: 14px;
            margin-bottom: 0;
        }

        .fm-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 17px;
            margin-bottom: 25px;
        }

        .fm-stat {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 23px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .fm-stat small {
            color: #64748b;
            font-size: 13px;
        }

        .fm-stat h2 {
            font-size: 28px;
            margin: 15px 0 0;
        }

        .fm-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 26px;
            margin-bottom: 25px;
        }

        .fm-card h2 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        .fm-subtitle {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 22px;
            line-height: 1.7;
        }

        .fm-contract {
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            padding: 22px;
            border-radius: 13px;
            margin-bottom: 16px;
        }

        .fm-contract-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .fm-contract-header h3 {
            margin: 0;
            font-size: 17px;
        }

        .fm-details {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 15px;
        }

        .fm-detail {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 16px;
            border-radius: 10px;
        }

        .fm-detail small {
            display: block;
            color: #64748b;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .fm-detail strong {
            font-size: 17px;
        }

        .fm-badge {
            background: #e8efff;
            color: #315b89;
            padding: 7px 11px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 7px;
            white-space: nowrap;
        }

        .fm-paid {
            background: #dcfce7;
            color: #15803d;
        }

        .fm-unpaid {
            background: #fff7ed;
            color: #c2410c;
        }

        .fm-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
        }

        .fm-page table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        .fm-page th {
            background: #253858;
            color: white;
            padding: 15px;
            font-size: 12px;
            text-align: left;
        }

        .fm-page td {
            padding: 17px 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .fm-empty {
            text-align: center;
            color: #64748b;
            padding: 30px !important;
        }

        .fm-btn {
            display: inline-block;
            padding: 12px 18px;
            background: #253858;
            border-radius: 9px;
            color: white !important;
            text-decoration: none !important;
            font-size: 13px;
            font-weight: bold;
        }

        @media(max-width: 700px) {
            .fm-stats,
            .fm-details {
                grid-template-columns: 1fr;
            }

            .fm-card,
            .fm-hero {
                padding: 20px;
            }
        }
    </style>

    <div class="fm-page">

        <div class="fm-hero">

            <small>KV GJINOCI | PERSONAL FINANCE</small>

            <h1>Financat e Mia</h1>

            <p>
                {{ auth()->user()->name }} |
                Shiko kontratat dhe historikun e pagesave.
            </p>

        </div>

        <div class="fm-stats">

            <div class="fm-stat">

                <small>Kontratat e Mia</small>

                <h2>{{ $kontratat->count() }}</h2>

            </div>

            <div class="fm-stat">

                <small>Total i Paguar</small>

                <h2 style="color:#15803d;">
                    {{ number_format($totalPaguar, 2) }} €
                </h2>

            </div>

            <div class="fm-stat">

                <small>Paga Pa Paguar</small>

                <h2 style="color:#d97706;">
                    {{ number_format($totalPapaguar, 2) }} €
                </h2>

            </div>

        </div>

        <div class="fm-card">

            <h2>Kontratat e Mia</h2>

            <p class="fm-subtitle">
                Informacionet e kontratave tua ne klub.
            </p>

            @forelse($kontratat as $kontrata)

                <div class="fm-contract">

                    <div class="fm-contract-header">

                        <h3>
                            Kontrata {{ $kontrata->numri_kontrates }}
                        </h3>

                        <span class="fm-badge">

                        {{ $kontrata->gjendja }}

                    </span>

                    </div>

                    <div class="fm-details">

                        <div class="fm-detail">

                            <small>Paga Mujore</small>

                            <strong>
                                {{ number_format($kontrata->paga_mujore, 2) }} €
                            </strong>

                        </div>

                        <div class="fm-detail">

                            <small>Data e Fillimit</small>

                            <strong>
                                {{ $kontrata->data_fillimit->format('d.m.Y') }}
                            </strong>

                        </div>

                        <div class="fm-detail">

                            <small>Data e Mbarimit</small>

                            <strong>
                                {{ $kontrata->data_mbarimit->format('d.m.Y') }}
                            </strong>

                        </div>

                    </div>

                    @if($kontrata->shenime)

                        <p style="font-size:13px;color:#64748b;margin-bottom:0;">

                            {{ $kontrata->shenime }}

                        </p>

                    @endif

                </div>

            @empty

                <div class="fm-empty">

                    Ende nuk ke kontrate te regjistruar.

                </div>

            @endforelse

        </div>

        <div class="fm-card">

            <h2>Historiku i Pagesave</h2>

            <p class="fm-subtitle">

                Pagat mujore dhe statusi i pageses.

            </p>

            <div class="fm-table-wrap">

                <table>

                    <thead>

                    <tr>
                        <th>Muaji</th>
                        <th>Kontrata</th>
                        <th>Shuma</th>
                        <th>Statusi</th>
                        <th>Data e Pageses</th>
                        <th>Metoda</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($pagesat as $pagesa)

                        <tr>

                            <td>
                                {{ $pagesa->muaji->format('m/Y') }}
                            </td>

                            <td>
                                {{ $pagesa->kontrata->numri_kontrates }}
                            </td>

                            <td>

                                <strong>
                                    {{ number_format($pagesa->shuma, 2) }} €
                                </strong>

                            </td>

                            <td>

                                <span class="fm-badge
                                    {{ $pagesa->statusi === 'Paguar'
                                        ? 'fm-paid'
                                        : 'fm-unpaid' }}">

                                    {{ $pagesa->statusi }}

                                </span>

                            </td>

                            <td>
                                {{ $pagesa->data_pageses?->format('d.m.Y') ?? '-' }}
                            </td>

                            <td>
                                {{ $pagesa->metoda_pageses ?? '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="fm-empty">

                                Ende nuk ka pagesa te regjistruara.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <a href="{{ route('dashboard') }}" class="fm-btn">

            Kthehu ne Dashboard

        </a>

    </div>

@endsection
