@extends('layouts.club')

@section('title', 'Lidh Ndeshjen me Kampionatin - KV Gjinoci')

@section('content')

    <style>
        .sync-page {
            max-width: 1000px;
            margin: 0 auto;
            padding-bottom: 30px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .sync-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .sy-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .sy-header h1 {
            color: #172b4d;
            font-size: 30px;
            margin: 0 0 8px;
        }

        .sy-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* BUTTONS */

        .sy-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 19px;
            background: #253858;
            color: white !important;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .sy-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .sy-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .sy-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        .sy-btn:disabled {
            opacity: .5;
            cursor: not-allowed;
            transform: none;
        }

        /* MATCH HERO */

        .sy-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            color: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .sy-hero::after {
            content: "🏐";
            position: absolute;
            right: -20px;
            bottom: -100px;
            font-size: 300px;
            opacity: .07;
            pointer-events: none;
        }

        .sy-hero-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
            flex-wrap: wrap;
        }

        .sy-hero-label {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        .sy-status {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,.15);
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        /* SCOREBOARD */

        .sy-scoreboard {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 25px;
            position: relative;
            z-index: 1;
            margin-bottom: 30px;
        }

        .sy-team {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 13px;
        }

        .sy-team-icon {
            width: 76px;
            height: 76px;
            border-radius: 19px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            font-weight: bold;
        }

        .sy-team h2 {
            color: white !important;
            font-size: 20px;
            margin: 0;
            overflow-wrap: anywhere;
        }

        .sy-team small {
            color: #bfdbfe;
            font-size: 12px;
        }

        .sy-score {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 9px;
        }

        .sy-score-value {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 17px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.22);
            padding: 19px 25px;
            border-radius: 15px;
            font-size: 38px;
            font-weight: bold;
            color: white;
            white-space: nowrap;
        }

        .sy-score small {
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1px;
        }

        /* MATCH INFORMATION */

        .sy-match-info {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 12px;
            position: relative;
            z-index: 1;
            border-top: 1px solid rgba(255,255,255,.2);
            padding-top: 24px;
        }

        .sy-info-item {
            background: rgba(255,255,255,.10);
            border-radius: 11px;
            padding: 16px;
        }

        .sy-info-item span {
            display: block;
            font-size: 11px;
            color: #bfdbfe;
            margin-bottom: 8px;
        }

        .sy-info-item strong {
            color: white;
            font-size: 14px;
        }

        /* FORM CARD */

        .sy-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .sy-card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-bottom: 22px;
            margin-bottom: 24px;
            border-bottom: 1px solid #e5ebf3;
        }

        .sy-card-icon {
            width: 49px;
            height: 49px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #e8efff;
            font-size: 23px;
            flex-shrink: 0;
        }

        .sy-card-header h2 {
            color: #172b4d;
            font-size: 21px;
            margin: 0 0 6px;
        }

        .sy-card-header p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        /* FORM GRID */

        .sy-form-grid {
            display: grid;
            grid-template-columns: repeat(
            2, minmax(0, 1fr)
        );
            gap: 23px;
        }

        .sy-field {
            min-width: 0;
        }

        .sy-field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #172b4d;
            margin-bottom: 9px;
        }

        .sy-required {
            color: #dc2626;
        }

        .sync-page .sy-input {
            width: 100%;
            min-height: 47px;
            display: block;
            padding: 12px 14px;
            margin: 0;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #172b4d;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            cursor: pointer;
            transition: .2s;
        }

        .sync-page .sy-input:focus {
            background: white;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .sync-page .sy-input:disabled {
            cursor: not-allowed;
            background: #edf2f7;
            color: #94a3b8;
        }

        .sy-help {
            display: block;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
            margin-top: 9px;
        }

        .sy-error {
            display: block;
            color: #dc2626;
            font-size: 12px;
            margin-top: 7px;
        }

        /* INFORMATION BOX */

        .sy-info-box {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            padding: 18px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .sy-info-box strong {
            display: block;
            color: #1e40af;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .sy-info-box p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* OPPONENT SUMMARY */

        .sy-opponent {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 18px;
            background: #f8fafc;
            border: 1px solid #e5ebf3;
            border-radius: 12px;
            margin-top: 25px;
        }

        .sy-opponent-icon {
            width: 46px;
            height: 46px;
            background: #e8efff;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .sy-opponent strong {
            display: block;
            color: #172b4d;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .sy-opponent small {
            color: #64748b;
            font-size: 12px;
        }

        /* FORM ACTIONS */

        .sy-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #e5ebf3;
        }

        .sy-actions-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .sy-actions small {
            color: #64748b;
            font-size: 12px;
        }

        /* ERRORS */

        .sy-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 11px;
            padding: 17px 19px;
            margin-bottom: 24px;
            font-size: 13px;
        }

        .sy-errors ul {
            padding-left: 20px;
            margin: 10px 0 0;
        }

        /* EMPTY STATE */

        .sy-empty {
            text-align: center;
            padding: 35px 20px;
        }

        .sy-empty-icon {
            width: 76px;
            height: 76px;
            background: #fff1df;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            font-size: 33px;
            margin: 0 auto 18px;
        }

        .sy-empty h3 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 12px;
        }

        .sy-empty p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            margin: 0 auto 22px;
            max-width: 520px;
        }

        /* RESPONSIVE */

        @media (max-width: 650px) {

            .sy-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .sy-header h1 {
                font-size: 25px;
            }

            .sy-hero {
                padding: 22px;
            }

            .sy-scoreboard {
                gap: 12px;
            }

            .sy-team-icon {
                width: 55px;
                height: 55px;
                font-size: 19px;
                border-radius: 13px;
            }

            .sy-team h2 {
                font-size: 14px;
            }

            .sy-score-value {
                font-size: 26px;
                padding: 13px 15px;
                gap: 10px;
            }

            .sy-match-info {
                grid-template-columns: 1fr;
            }

            .sy-card {
                padding: 20px;
            }

            .sy-form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .sy-actions-right {
                width: 100%;
            }

            .sy-actions-right .sy-btn {
                flex: 1;
            }

        }
    </style>

    @php

        $emriEkipit = $ndeshja->ekipi?->emri
            ?? 'KV Gjinoci';

        $emriKundershtarit = $ndeshja->kundershtari;

        $dataNdeshjes = $ndeshja->data_ndeshjes
            ? \Carbon\Carbon::parse(
                $ndeshja->data_ndeshjes
            )->format('d.m.Y')
            : '-';

        $emriSezonit = $ndeshja->sezoni?->emri
            ?? 'Pa sezon';

        $inicialetEkipit = collect(
            explode(' ', $emriEkipit)
        )
        ->filter()
        ->take(2)
        ->map(fn($fjala) =>
            mb_strtoupper(
                mb_substr($fjala, 0, 1)
            )
        )
        ->implode('');

        $inicialetKundershtarit = collect(
            explode(' ', $emriKundershtarit)
        )
        ->filter()
        ->take(2)
        ->map(fn($fjala) =>
            mb_strtoupper(
                mb_substr($fjala, 0, 1)
            )
        )
        ->implode('');

    @endphp

    <div class="sync-page">

        {{-- PAGE HEADER --}}

        <div class="sy-header">

            <div>

                <h1>Lidh Ndeshjen me Kampionatin</h1>

                <p>

                    Sinkronizo rezultatin e ndeshjes
                    me klasifikimin e kampionatit.

                </p>

            </div>

            <a href="{{ route(
            'ndeshjet.show',
            $ndeshja
        ) }}"
               class="sy-btn sy-btn-light">

                ← Kthehu te Ndeshja

            </a>

        </div>

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="sy-errors">

                <strong>

                    Kontrollo te dhenat e vendosura:

                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- MATCH HERO --}}

        <div class="sy-hero">

            <div class="sy-hero-top">

            <span class="sy-hero-label">

                KV GJINOCI | MATCH SYNC

            </span>

                <span class="sy-status">

                {{ $ndeshja->statusi === 'Perfunduar'
                    ? '✓ Ndeshje e Perfunduar'
                    : $ndeshja->statusi }}

            </span>

            </div>

            {{-- SCOREBOARD --}}

            <div class="sy-scoreboard">

                <div class="sy-team">

                    <div class="sy-team-icon">

                        {{ $inicialetEkipit }}

                    </div>

                    <h2>{{ $emriEkipit }}</h2>

                    <small>Klubi yne</small>

                </div>

                <div class="sy-score">

                    <div class="sy-score-value">

                        {{ $ndeshja->setet_tona }}

                        <span style="opacity:.5">:</span>

                        {{ $ndeshja->setet_kundershtarit }}

                    </div>

                    <small>REZULTATI FINAL</small>

                </div>

                <div class="sy-team">

                    <div class="sy-team-icon">

                        {{ $inicialetKundershtarit }}

                    </div>

                    <h2>{{ $emriKundershtarit }}</h2>

                    <small>Kundershtari</small>

                </div>

            </div>

            {{-- MATCH INFORMATION --}}

            <div class="sy-match-info">

                <div class="sy-info-item">

                    <span>📅 Data e Ndeshjes</span>

                    <strong>

                        {{ $dataNdeshjes }}

                    </strong>

                </div>

                <div class="sy-info-item">

                    <span>🏆 Sezoni</span>

                    <strong>

                        {{ $emriSezonit }}

                    </strong>

                </div>

                <div class="sy-info-item">

                    <span>📍 Lokacioni</span>

                    <strong>

                        {{ $ndeshja->lokacioni ?? '-' }}

                    </strong>

                </div>

            </div>

        </div>

        {{-- SYNC FORM --}}

        <div class="sy-card">

            <div class="sy-card-header">

                <div class="sy-card-icon">

                    🔗

                </div>

                <div>

                    <h2>Sinkronizimi me Kampionatin</h2>

                    <p>

                        Zgjedh kampionatin dhe klubin
                        kundershtar per kete ndeshje.

                    </p>

                </div>

            </div>

            @if($kampionatet->isEmpty())

                {{-- NO CHAMPIONSHIPS --}}

                <div class="sy-empty">

                    <div class="sy-empty-icon">

                        ⚠️

                    </div>

                    <h3>

                        Nuk ka kampionate te pershtatshme

                    </h3>

                    <p>

                        Kontrollo sezonin e ndeshjes,
                        kategorine e ekipit dhe
                        pjesemarrjen e KV Gjinocit
                        ne kampionatet e regjistruara.

                    </p>

                    <a href="{{ route(
                    'kampionatet.index'
                ) }}"
                       class="sy-btn">

                        Menaxho Kampionatet

                    </a>

                </div>

            @else

                {{-- INFORMATION --}}

                <div class="sy-info-box">

                <span style="font-size:22px">

                    ℹ️

                </span>

                    <div>

                        <strong>

                            Si funksionon sinkronizimi?

                        </strong>

                        <p>

                            Zgjedh kampionatin ne te cilin
                            eshte zhvilluar ndeshja dhe
                            klubin qe korrespondon me
                            kundershtarin.

                            Rezultati do te lidhet me
                            kampionatin dhe klasifikimi
                            do te perditesohet automatikisht.

                        </p>

                    </div>

                </div>

                <form method="POST"
                      action="{{ route(
                      'ndeshjet.lidh-ligen.store',
                      $ndeshja
                  ) }}">

                    @csrf

                    <div class="sy-form-grid">

                        {{-- CHAMPIONSHIP --}}

                        <div class="sy-field">

                            <label for="kampionati_id">

                                Kampionati

                                <span class="sy-required">*</span>

                            </label>

                            <select
                                name="kampionati_id"
                                id="kampionati_id"
                                class="sy-input"
                                required
                            >

                                <option value="">

                                    Zgjedh Kampionatin

                                </option>

                                @foreach($kampionatet as $kampionati)

                                    <option
                                        value="{{ $kampionati->id }}"
                                        @selected(
                                            (string) old(
                                                'kampionati_id'
                                            ) ===
                                            (string) $kampionati->id
                                        )
                                    >

                                        {{ $kampionati->emri }}

                                        ({{ $kampionati->kategoria }})

                                    </option>

                                @endforeach

                            </select>

                            @error('kampionati_id')

                            <span class="sy-error">

                                {{ $message }}

                            </span>

                            @enderror

                            <small class="sy-help">

                                Kampionatet qe perputhen
                                me sezonin dhe kategorine.

                            </small>

                        </div>

                        {{-- OPPONENT CLUB --}}

                        <div class="sy-field">

                            <label for="kundershtari_id">

                                Klubi Kundershtar

                                <span class="sy-required">*</span>

                            </label>

                            <select
                                name="kundershtari_id"
                                id="kundershtari_id"
                                class="sy-input"
                                required
                                disabled
                            >

                                <option value="">

                                    Zgjedh fillimisht kampionatin

                                </option>

                            </select>

                            @error('kundershtari_id')

                            <span class="sy-error">

                                {{ $message }}

                            </span>

                            @enderror

                            <small class="sy-help">

                                Shfaqen klubet pjesemarrese
                                te kampionatit te zgjedhur.

                            </small>

                        </div>

                    </div>

                    {{-- EXPECTED OPPONENT --}}

                    <div class="sy-opponent">

                        <div class="sy-opponent-icon">

                            🏐

                        </div>

                        <div>

                            <strong>

                                {{ $emriKundershtarit }}

                            </strong>

                            <small>

                                Zgjedh klubin qe korrespondon
                                me kete kundershtar.

                            </small>

                        </div>

                    </div>

                    {{-- FORM ACTIONS --}}

                    <div class="sy-actions">

                        <small>

                            * Fushat e detyrueshme

                        </small>

                        <div class="sy-actions-right">

                            <a href="{{ route(
                            'ndeshjet.show',
                            $ndeshja
                        ) }}"
                               class="sy-btn sy-btn-gray">

                                Anulo

                            </a>

                            <button
                                type="submit"
                                id="sync-button"
                                class="sy-btn"
                                disabled
                            >

                                🔗 Lidh me Kampionatin

                            </button>

                        </div>

                    </div>

                </form>

            @endif

        </div>

        <a href="{{ route(
        'ndeshjet.show',
        $ndeshja
    ) }}"
           class="sy-btn sy-btn-light">

            ← Kthehu te Detajet e Ndeshjes

        </a>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const kampionatet = @json($kampionatet->values());

            const gjinociId = @json(data_get($gjinoci, 'id'));

            const oldKundershtari = @json(old('kundershtari_id'));

            const kampionatiSelect = document.getElementById(
                'kampionati_id'
            );

            const kundershtariSelect = document.getElementById(
                'kundershtari_id'
            );

            const syncButton = document.getElementById(
                'sync-button'
            );

            if (!kampionatiSelect || !kundershtariSelect) {

                return;

            }

            function perditesoButonin() {

                syncButton.disabled = !(
                    kampionatiSelect.value &&
                    kundershtariSelect.value
                );

            }

            function shfaqKundershtaret(vleraAktuale = null) {

                const kampionati = kampionatet.find(
                    k => String(k.id) ===
                        String(kampionatiSelect.value)
                );

                kundershtariSelect.innerHTML = '';

                const opsioniFillestar = document.createElement(
                    'option'
                );

                opsioniFillestar.value = '';

                opsioniFillestar.textContent = kampionati
                    ? 'Zgjedh Kundershtarin'
                    : 'Zgjedh fillimisht kampionatin';

                kundershtariSelect.appendChild(
                    opsioniFillestar
                );

                if (!kampionati) {

                    kundershtariSelect.disabled = true;

                    perditesoButonin();

                    return;

                }

                const klubet = (kampionati.klubet || [])
                    .filter(
                        klubi =>
                            String(klubi.id) !==
                            String(gjinociId)
                    );

                klubet.forEach(function (klubi) {

                    const option = document.createElement(
                        'option'
                    );

                    option.value = klubi.id;

                    option.textContent = klubi.emri;

                    if (
                        vleraAktuale !== null &&
                        String(klubi.id) ===
                        String(vleraAktuale)
                    ) {

                        option.selected = true;

                    }

                    kundershtariSelect.appendChild(option);

                });

                if (klubet.length === 0) {

                    opsioniFillestar.textContent =
                        'Nuk ka klube kundershtare';

                    kundershtariSelect.disabled = true;

                } else {

                    kundershtariSelect.disabled = false;

                }

                perditesoButonin();

            }

            kampionatiSelect.addEventListener(
                'change',
                function () {

                    shfaqKundershtaret();

                }
            );

            kundershtariSelect.addEventListener(
                'change',
                perditesoButonin
            );

            shfaqKundershtaret(oldKundershtari);

        });

    </script>

@endsection
