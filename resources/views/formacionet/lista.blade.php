@extends('layouts.club')

@section('title', 'Formacionet 6+1 - KV Gjinoci')

@section('content')

    <style>
        .lineups-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .lineups-page * {
            box-sizing: border-box;
        }

        .lineups-hero {
            background: linear-gradient(
                120deg, #101e38, #315b89
            );
            border-radius: 18px;
            padding: 30px;
            color: white;
            margin-bottom: 25px;
        }

        .lineups-hero small {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.4px;
        }

        .lineups-hero h1 {
            color: white;
            font-size: 29px;
            margin: 13px 0;
        }

        .lineups-hero p {
            color: #dbeafe;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        .lineups-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 22px;
        }

        .lineups-summary h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0;
        }

        .lineups-count {
            background: #e8efff;
            color: #253858;
            padding: 10px 14px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 700;
        }

        .lineups-grid {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 20px;
        }

        .lineup-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(15,23,42,.04);
        }

        .lineup-card-head {
            background: linear-gradient(
                125deg, #172b4d, #315b89
            );
            padding: 22px;
            color: white;
        }

        .lineup-card-head small {
            color: #bfdbfe;
            font-size: 11px;
        }

        .lineup-card-head h3 {
            color: white;
            font-size: 19px;
            line-height: 1.4;
            margin: 10px 0 7px;
            overflow-wrap: anywhere;
        }

        .lineup-card-head p {
            color: #dbeafe;
            font-size: 12px;
            margin: 0;
            overflow-wrap: anywhere;
        }

        .lineup-card-body {
            padding: 20px;
        }

        .lineup-detail {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #edf2f7;
            font-size: 12px;
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

        .lineup-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 18px;
        }

        .lineup-button {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 45px;
            text-align: center;
            padding: 10px;
            border: 1px solid #253858;
            border-radius: 9px;
            background: #253858;
            color: white !important;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none !important;
        }

        .lineup-button.secondary {
            background: #e8efff;
            color: #253858 !important;
            border-color: #dbe3ee;
        }

        .lineup-button.disabled {
            background: #f1f5f9;
            color: #94a3b8 !important;
            border-color: #e2e8f0;
            cursor: not-allowed;
        }

        .lineup-empty {
            grid-column: 1 / -1;
            background: white;
            padding: 45px;
            text-align: center;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
        }

        .lineup-empty h2 {
            color: #172b4d;
        }

        .lineup-empty p {
            color: #64748b;
        }

        .lineup-pagination {
            margin-top: 24px;
        }

        @media (max-width: 1200px) {
            .lineups-grid {
                grid-template-columns: repeat(
                2, minmax(0, 1fr)
            );
            }
        }

        @media (max-width: 700px) {
            .lineups-grid {
                grid-template-columns: 1fr;
            }

            .lineups-hero {
                padding: 22px;
            }

            .lineups-hero h1 {
                font-size: 24px;
            }
        }

        @media (max-width: 380px) {
            .lineup-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="lineups-page">

        <div class="lineups-hero">
            <small>
                KV GJINOCI | TACTICAL MANAGEMENT
            </small>

            <h1>Formacionet Interaktive 6+1</h1>

            <p>
                Menaxho formacionet e seciles ndeshje,
                kopjo setet dhe printo raportin A4.
            </p>
        </div>

        <div class="lineups-summary">
            <h2>Zgjedh Ndeshjen</h2>

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
                                @if($ndeshja->data_ndeshjes)
                                    {{ \Carbon\Carbon::parse(
                                        $ndeshja->data_ndeshjes
                                    )->format('d.m.Y') }}
                                @else
                                    Pa date
                                @endif
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
                                    : '' }}"
                                >
                                Seti {{ $set }}

                                    @if(in_array($set, $setet))
                                        ✓
                                    @endif
                            </span>

                            @endforeach

                        </div>

                        <div class="lineup-actions">

                            <a
                                href="{{ route(
                                'formacionet.index',
                                $ndeshja
                            ) }}"
                                class="lineup-button"
                            >
                                🏐 Formacioni
                            </a>

                            @if(count($setet) > 0)

                                <a
                                    href="{{ route(
                                    'formacionet.print',
                                    $ndeshja
                                ) }}"
                                    class="lineup-button secondary"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    🖨️ Raporti A4
                                </a>

                            @else

                                <span
                                    class="lineup-button disabled"
                                    title="Ruaj fillimisht nje set"
                                >
                                🖨️ Raporti A4
                            </span>

                            @endif

                        </div>

                    </div>

                </article>

            @empty

                <div class="lineup-empty">
                    <h2>Nuk ka ndeshje.</h2>

                    <p>
                        Krijo fillimisht nje ndeshje
                        nga moduli Ndeshjet.
                    </p>
                </div>

            @endforelse

        </div>

        <div class="lineup-pagination">
            {{ $ndeshjet->links() }}
        </div>

    </div>

@endsection
