@extends('layouts.club')

@section('title', 'Formacionet 6+1 - KV Gjinoci')

@section('content')

    <style>
        .lineups-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
        }

        .lineups-page * {
            box-sizing: border-box;
        }

        .lineups-hero {
            background: linear-gradient(
                120deg,
                #101e38,
                #315b89
            );
            border-radius: 18px;
            padding: 32px;
            color: white;
            margin-bottom: 25px;
        }

        .lineups-hero small {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.4px;
            color: #bfdbfe;
        }

        .lineups-hero h1 {
            font-size: 30px;
            color: white;
            margin: 14px 0;
        }

        .lineups-hero p {
            font-size: 14px;
            color: #dbeafe;
            line-height: 1.7;
            margin: 0;
        }

        .lineups-summary {
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 23px;
        }

        .lineups-summary h2 {
            margin: 0;
            font-size: 23px;
            color: #172b4d;
        }

        .lineups-count {
            background: #e8efff;
            color: #253858;
            padding: 10px 14px;
            border-radius: 9px;
            font-weight: bold;
            font-size: 13px;
        }

        .lineups-grid {
            display: grid;
            grid-template-columns:
            repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .lineup-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(15,23,42,.04);
        }

        .lineup-card-head {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            padding: 23px;
            color: white;
        }

        .lineup-card-head small {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
        }

        .lineup-card-head h3 {
            color: white;
            margin: 11px 0 8px;
            font-size: 20px;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .lineup-card-head p {
            color: #dbeafe;
            font-size: 13px;
            margin: 0;
            overflow-wrap: anywhere;
        }

        .lineup-card-body {
            padding: 22px;
        }

        .lineup-detail {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #edf2f7;
            font-size: 13px;
        }

        .lineup-detail span {
            color: #64748b;
        }

        .lineup-detail strong {
            color: #172b4d;
            text-align: right;
        }

        .lineup-sets {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin: 18px 0;
        }

        .lineup-set {
            background: #f1f5f9;
            color: #64748b;
            border-radius: 7px;
            padding: 7px 10px;
            font-size: 11px;
            font-weight: bold;
        }

        .lineup-set.saved {
            background: #dcfce7;
            color: #166534;
        }

        .lineup-button {
            display: block;
            width: 100%;
            text-align: center;
            background: #253858;
            color: white !important;
            border-radius: 9px;
            text-decoration: none !important;
            padding: 13px 16px;
            font-size: 13px;
            font-weight: bold;
            margin-top: 20px;
        }

        .lineup-button:hover {
            background: #172b4d;
        }

        .lineup-empty {
            grid-column: 1 / -1;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 55px 24px;
            text-align: center;
            color: #64748b;
        }

        .lineup-empty h2 {
            color: #172b4d;
            margin: 15px 0;
        }

        .lineup-pagination {
            margin-top: 25px;
        }

        @media (max-width: 1200px) {
            .lineups-grid {
                grid-template-columns:
                repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .lineups-grid {
                grid-template-columns: 1fr;
            }

            .lineups-hero {
                padding: 24px;
            }

            .lineups-hero h1 {
                font-size: 25px;
            }
        }
    </style>

    <div class="lineups-page">

        <div class="lineups-hero">
            <small>
                KV GJINOCI | TACTICAL MANAGEMENT
            </small>

            <h1>
                Formacionet Interaktive 6+1
            </h1>

            <p>
                Zgjedh ndeshjen, cakto gjashte
                lojtaret ne fushe dhe Liberon,
                pastaj ruaje formacionin per secilin set.
            </p>
        </div>

        <div class="lineups-summary">
            <h2>
                Zgjedh Ndeshjen
            </h2>

            <span class="lineups-count">
            {{ $ndeshjet->total() }} ndeshje
        </span>
        </div>

        <div class="lineups-grid">

            @forelse($ndeshjet as $ndeshja)

                @php
                    $setet = $formacionet
                        ->get($ndeshja->id, collect())
                        ->pluck('seti')
                        ->map(fn ($nr) => (int) $nr)
                        ->all();
                @endphp

                <article class="lineup-card">

                    <div class="lineup-card-head">
                        <small>
                            NDESHJA #{{ $ndeshja->id }}
                        </small>

                        <h3>
                            {{ $ndeshja->ekipi?->emri
                                ?? 'Ekip pa emer' }}
                        </h3>

                        <p>
                            vs {{ $ndeshja->kundershtari }}
                        </p>
                    </div>

                    <div class="lineup-card-body">

                        <div class="lineup-detail">
                            <span>Data</span>

                            <strong>
                                {{ \Carbon\Carbon::parse(
                                    $ndeshja->data_ndeshjes
                                )->format('d.m.Y') }}
                            </strong>
                        </div>

                        <div class="lineup-detail">
                            <span>Statusi</span>

                            <strong>
                                {{ $ndeshja->statusi }}
                            </strong>
                        </div>

                        <div class="lineup-detail">
                            <span>Palestra</span>

                            <strong>
                                {{ $ndeshja->palestra
                                    ?: 'Pa caktuar' }}
                            </strong>
                        </div>

                        <div class="lineup-detail">
                            <span>Setet e ruajtura</span>

                            <strong>
                                {{ count($setet) }} / 5
                            </strong>
                        </div>

                        <div class="lineup-sets">
                            @foreach(range(1, 5) as $set)
                                <span class="lineup-set
                                {{ in_array($set, $setet)
                                    ? 'saved'
                                    : '' }}">
                                Seti {{ $set }}

                                    @if(in_array($set, $setet))
                                        ✓
                                    @endif
                            </span>
                            @endforeach
                        </div>

                        <a
                            href="{{ route(
                            'formacionet.index',
                            [
                                'ndeshja' => $ndeshja->id
                            ]
                        ) }}"
                            class="lineup-button"
                        >
                            🏐 Hape Formacionin
                        </a>

                    </div>
                </article>

            @empty

                <div class="lineup-empty">
                    <div style="font-size:45px">
                        🏐
                    </div>

                    <h2>
                        Nuk ka ndeshje te regjistruara.
                    </h2>

                    <p>
                        Fillimisht krijo nje ndeshje
                        te moduli Ndeshjet.
                    </p>
                </div>

            @endforelse

        </div>

        <div class="lineup-pagination">
            {{ $ndeshjet->links() }}
        </div>

    </div>

@endsection
