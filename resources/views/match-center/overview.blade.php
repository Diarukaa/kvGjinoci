@extends('layouts.club')

@section('title', 'Match Center - KV Gjinoci')

@section('content')

    <style>
        .mcov {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .mcov * {
            box-sizing: border-box;
        }

        .mcov-hero {
            background: linear-gradient(120deg, #101e38, #315b89);
            border-radius: 18px;
            padding: 30px;
            color: #ffffff;
            margin-bottom: 24px;
        }

        .mcov-hero small {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
        }

        .mcov-hero h1 {
            margin: 12px 0;
            color: #ffffff;
            font-size: 30px;
        }

        .mcov-hero p {
            color: #dbeafe;
            margin: 0;
            font-size: 13px;
            line-height: 1.7;
        }

        .mcov-alert {
            padding: 14px 18px;
            background: #fff7ed;
            color: #9a3412;
            border: 1px solid #fed7aa;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .mcov-alert.success {
            background: #dcfce7;
            color: #166534;
            border-color: #bbf7d0;
        }

        .mcov-filters {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 13px;
            margin-bottom: 23px;
        }

        .mcov-filter {
            display: block;
            padding: 18px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            text-decoration: none !important;
            color: #172b4d !important;
        }

        .mcov-filter.active {
            border-color: #315b89;
            background: #eff6ff;
        }

        .mcov-filter small {
            display: block;
            color: #64748b;
            font-size: 12px;
        }

        .mcov-filter strong {
            display: block;
            color: #172b4d;
            font-size: 27px;
            margin-top: 7px;
        }

        .mcov-heading {
            font-size: 21px;
            color: #172b4d;
            margin: 0 0 19px;
        }

        .mcov-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 19px;
        }

        .mcov-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            overflow: hidden;
        }

        .mcov-card-head {
            background: #253858;
            padding: 21px;
            color: #ffffff;
        }

        .mcov-card-head small {
            color: #bfdbfe;
            font-size: 11px;
        }

        .mcov-card-head h3 {
            color: #ffffff;
            font-size: 18px;
            margin: 10px 0 7px;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .mcov-card-head p {
            color: #dbeafe;
            font-size: 12px;
            margin: 0;
            overflow-wrap: anywhere;
        }

        .mcov-card-body {
            padding: 20px;
        }

        .mcov-line {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 11px 0;
            border-bottom: 1px solid #edf2f7;
            font-size: 12px;
        }

        .mcov-line span {
            color: #64748b;
        }

        .mcov-line strong {
            color: #172b4d;
            text-align: right;
        }

        .mcov-status {
            display: inline-block;
            padding: 7px 11px;
            background: #f1f5f9;
            color: #475569;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
        }

        .mcov-status.finished {
            background: #dcfce7;
            color: #166534;
        }

        .mcov-status.live {
            background: #fee2e2;
            color: #991b1b;
        }

        .mcov-result {
            margin-top: 17px;
            padding: 16px;
            text-align: center;
            border-radius: 10px;
            background: #f1f5f9;
        }

        .mcov-result strong {
            font-size: 28px;
            color: #172b4d;
        }

        .mcov-result small {
            display: block;
            margin-top: 6px;
            color: #64748b;
            font-size: 11px;
        }

        .mcov-btn {
            display: block;
            text-align: center;
            background: #253858;
            color: #ffffff !important;
            text-decoration: none !important;
            padding: 13px;
            margin-top: 17px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 700;
        }

        .mcov-note {
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
            margin: 13px 0 0;
        }

        .mcov-empty {
            grid-column: 1 / -1;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 42px;
            text-align: center;
            color: #64748b;
        }

        .mcov-pagination {
            margin-top: 24px;
        }

        @media (max-width: 1100px) {
            .mcov-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .mcov-grid {
                grid-template-columns: 1fr;
            }

            .mcov-filters {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .mcov-hero {
                padding: 23px;
            }

            .mcov-hero h1 {
                font-size: 25px;
            }
        }
    </style>

    <div class="mcov">

        <div class="mcov-hero">
            <small>KV GJINOCI · MATCH MANAGEMENT</small>

            <h1>Match Center</h1>

            <p>
                Te gjitha ndeshjet ne nje vend:
                rezultatet ekzistuese, ndeshjet e
                perfunduara manualisht dhe ndeshjet LIVE.
            </p>
        </div>

        @if(session('error'))
            <div class="mcov-alert">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="mcov-alert success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mcov-filters">
            @foreach([
                'all' => 'Te gjitha',
                'finished' => 'Perfunduara',
                'live' => 'LIVE',
                'pending' => 'Pa rezultat'
            ] as $key => $label)

                <a
                    href="{{ route('match-center.index', [
                    'filter' => $key
                ]) }}"
                    class="mcov-filter
                    {{ $filter === $key ? 'active' : '' }}"
                >
                    <small>{{ $label }}</small>
                    <strong>{{ $counts[$key] }}</strong>
                </a>

            @endforeach
        </div>

        <h2 class="mcov-heading">Ndeshjet</h2>

        <div class="mcov-grid">

            @forelse($ndeshjetMeStatus as $row)

                @php
                    $ndeshja = $row['ndeshja'];
                    $category = $row['category'];
                    $source = $row['source'];
                @endphp

                <article class="mcov-card">

                    <div class="mcov-card-head">
                        <small>
                            NDESHJA #{{ $ndeshja->id }}
                        </small>

                        <h3>
                            {{ $ndeshja->ekipi?->emri ?? 'Ekipi' }}
                        </h3>

                        <p>
                            vs {{ $ndeshja->kundershtari }}
                        </p>
                    </div>

                    <div class="mcov-card-body">

                        <div class="mcov-line">
                            <span>Data</span>

                            <strong>
                                {{ $ndeshja->data_ndeshjes
                                    ? \Carbon\Carbon::parse(
                                        $ndeshja->data_ndeshjes
                                    )->format('d.m.Y')
                                    : 'Pa date' }}
                            </strong>
                        </div>

                        <div class="mcov-line">
                            <span>Statusi</span>

                            <span class="mcov-status {{ $category }}">
                            @if($category === 'live')
                                    ● LIVE
                                @elseif($category === 'finished')
                                    Perfunduar
                                @else
                                    Pa rezultat
                                @endif
                        </span>
                        </div>

                        <div class="mcov-line">
                            <span>Regjistrimi</span>

                            <strong>
                                @if($source === 'live')
                                    LIVE
                                @elseif($source === 'manual')
                                    Manual – Match Center
                                @elseif($source === 'existing')
                                    Rezultat ekzistues
                                @else
                                    Ende pa regjistrim
                                @endif
                            </strong>
                        </div>

                        @if(
                            $row['home_sets'] !== null
                            && $row['away_sets'] !== null
                            && $category === 'finished'
                        )
                            <div class="mcov-result">
                                <strong>
                                    {{ $row['home_sets'] }}
                                    :
                                    {{ $row['away_sets'] }}
                                </strong>

                                <small>
                                    Rezultati perfundimtar ne sete
                                </small>
                            </div>
                        @endif

                        @if($source === 'existing')
                            <p class="mcov-note">
                                Kjo ndeshje eshte regjistruar me
                                heret. Rezultati i saj nuk
                                mbishkruhet nga Match Center.
                            </p>

                        @else
                            <a
                                href="{{ route(
                                'match-center.show',
                                $ndeshja
                            ) }}"
                                class="mcov-btn"
                            >
                                @if($category === 'live')
                                    Hape LIVE
                                @elseif($category === 'finished')
                                    Shiko Rezultatin
                                @else
                                    Regjistro / Fillo LIVE
                                @endif
                            </a>
                        @endif

                    </div>
                </article>

            @empty

                <div class="mcov-empty">
                    <h2>Nuk ka ndeshje ne kete kategori.</h2>

                    <p>
                        Ndeshjet krijohen nga moduli Ndeshjet
                        dhe shfaqen automatikisht ketu.
                    </p>
                </div>

            @endforelse
        </div>

        <div class="mcov-pagination">
            {{ $ndeshjetMeStatus->links() }}
        </div>

    </div>

@endsection
