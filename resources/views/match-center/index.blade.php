@extends('layouts.club')

@section('title', 'Match Center - KV Gjinoci')

@section('content')

    <style>
        .mc-page { max-width:1200px; margin:auto; color:#172b4d; }
        .mc-page * { box-sizing:border-box; }
        .mc-hero {
            background:linear-gradient(120deg,#101e38,#315b89);
            color:white; padding:30px; border-radius:18px;
            margin-bottom:24px;
        }
        .mc-hero h1 { color:white; font-size:29px; margin:8px 0; }
        .mc-hero p { color:#dbeafe; font-size:13px; margin:0; }
        .mc-grid {
            display:grid; grid-template-columns:repeat(3,minmax(0,1fr));
            gap:18px;
        }
        .mc-card {
            background:white; border:1px solid #e2e8f0;
            border-radius:15px; overflow:hidden;
        }
        .mc-head {
            background:#253858; color:white; padding:20px;
        }
        .mc-head small { color:#bfdbfe; font-size:11px; }
        .mc-head h2 { color:white; font-size:19px; margin:9px 0; }
        .mc-head p { color:#dbeafe; margin:0; font-size:13px; }
        .mc-body { padding:20px; }
        .mc-detail {
            display:flex; justify-content:space-between;
            gap:10px; border-bottom:1px solid #edf2f7;
            padding:10px 0; font-size:12px;
        }
        .mc-detail span { color:#64748b; }
        .mc-detail strong { color:#172b4d; text-align:right; }
        .mc-btn {
            display:block; width:100%; margin-top:18px;
            text-align:center; border-radius:9px; padding:13px;
            background:#253858; color:white !important;
            text-decoration:none !important; font-weight:bold; font-size:13px;
        }
        .mc-status {
            display:inline-block; border-radius:7px;
            padding:6px 10px; background:#e8efff;
            color:#253858; font-weight:bold; font-size:11px;
        }
        .mc-status.live { background:#fee2e2; color:#991b1b; }
        .mc-status.finished { background:#dcfce7; color:#166534; }
        .mc-empty {
            grid-column:1/-1; background:white; padding:40px;
            border-radius:14px; text-align:center;
        }
        .mc-pagination { margin-top:22px; }
        @media(max-width:1100px) {
            .mc-grid { grid-template-columns:repeat(2,minmax(0,1fr)); }
        }
        @media(max-width:650px) {
            .mc-grid { grid-template-columns:1fr; }
            .mc-hero { padding:22px; }
        }
    </style>

    <div class="mc-page">

        <div class="mc-hero">
            <small>KV GJINOCI · MATCH MANAGEMENT</small>
            <h1>Match Center</h1>
            <p>
                Regjistro rezultatet e ndeshjeve te perfunduara
                ose menaxho nje ndeshje LIVE.
            </p>
        </div>

        <div class="mc-grid">
            @forelse($ndeshjet as $ndeshja)
                @php
                    $record = $records->get($ndeshja->id);
                    $status = $record->status ?? 'draft';
                @endphp

                <article class="mc-card">
                    <div class="mc-head">
                        <small>NDESHJA #{{ $ndeshja->id }}</small>
                        <h2>{{ $ndeshja->ekipi?->emri ?? 'Ekipi' }}</h2>
                        <p>vs {{ $ndeshja->kundershtari }}</p>
                    </div>

                    <div class="mc-body">
                        <div class="mc-detail">
                            <span>Data</span>
                            <strong>
                                {{ $ndeshja->data_ndeshjes
                                    ? \Carbon\Carbon::parse($ndeshja->data_ndeshjes)->format('d.m.Y')
                                    : 'Pa date' }}
                            </strong>
                        </div>

                        <div class="mc-detail">
                            <span>Statusi Match Center</span>
                            <span class="mc-status {{ $status }}">
                            @if($status === 'live')
                                    ● LIVE
                                @elseif($status === 'finished')
                                    Perfunduar
                                @else
                                    Pa rezultat
                                @endif
                        </span>
                        </div>

                        <div class="mc-detail">
                            <span>Menyra</span>
                            <strong>
                                {{ $record
                                    ? ($record->mode === 'live' ? 'LIVE' : 'Manuale')
                                    : 'Pa zgjedhur' }}
                            </strong>
                        </div>

                        <a
                            class="mc-btn"
                            href="{{ route('match-center.show', $ndeshja) }}"
                        >
                            Hape Match Center
                        </a>
                    </div>
                </article>
            @empty
                <div class="mc-empty">
                    <h2>Nuk ka ndeshje te regjistruara.</h2>
                    <p>Krijo fillimisht nje ndeshje nga moduli Ndeshjet.</p>
                </div>
            @endforelse
        </div>

        <div class="mc-pagination">
            {{ $ndeshjet->links() }}
        </div>
    </div>

@endsection
