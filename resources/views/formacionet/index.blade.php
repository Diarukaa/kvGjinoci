@extends('layouts.club')

@section('title', 'Formacioni 6+1 - KV Gjinoci')

@section('content')

    <style>
        .formation-page {
            max-width: 1250px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .formation-page * {
            box-sizing: border-box;
        }

        .formation-hero {
            background: linear-gradient(120deg, #101e38, #315b89);
            border-radius: 18px;
            padding: 28px;
            color: white;
            margin-bottom: 22px;
        }

        .formation-hero small {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.2px;
        }

        .formation-hero h1 {
            color: white;
            font-size: 29px;
            margin: 12px 0;
        }

        .formation-hero p {
            color: #dbeafe;
            font-size: 13px;
            line-height: 1.7;
            margin: 7px 0;
        }

        .formation-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .formation-card h2 {
            color: #172b4d;
            font-size: 19px;
            margin: 0 0 9px;
        }

        .formation-subtitle {
            color: #64748b;
            font-size: 12px;
            line-height: 1.7;
            margin: 0 0 20px;
        }

        .formation-toolbar {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin: 20px 0 0;
        }

        .formation-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 17px;
            border: 0;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            background: #253858;
            color: white !important;
        }

        .formation-button.secondary {
            background: #e8efff;
            color: #253858 !important;
        }

        .formation-button:hover {
            filter: brightness(.94);
        }

        .formation-button:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .formation-tabs {
            display: flex;
            gap: 9px;
            flex-wrap: wrap;
        }

        .formation-tab {
            padding: 11px 17px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f1f5f9;
            color: #334155;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .formation-tab.active {
            background: #253858;
            color: white;
            border-color: #253858;
        }

        .formation-tab.saved:not(.active) {
            border-color: #86efac;
            background: #f0fdf4;
            color: #166534;
        }

        .formation-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(280px, 1fr);
            gap: 20px;
            align-items: start;
        }

        .formation-print-header {
            display: none;
        }

        .formation-court {
            background: linear-gradient(145deg, #d78c53, #c87945);
            position: relative;
            border: 7px solid #f8fafc;
            outline: 2px solid #dbe3ee;
            border-radius: 12px;
            padding: 33px 18px 23px;
            overflow: hidden;
        }

        .formation-court::before {
            content: "";
            position: absolute;
            inset: 0;
            border: 2px solid rgba(255,255,255,.9);
            pointer-events: none;
        }

        .formation-net {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 9px;
            background: repeating-linear-gradient(
                90deg,
                #e2e8f0 0,
                #e2e8f0 9px,
                #64748b 9px,
                #64748b 11px
            );
            z-index: 2;
        }

        .formation-attack-line {
            position: absolute;
            top: 49%;
            left: 0;
            right: 0;
            height: 3px;
            background: rgba(255,255,255,.9);
            pointer-events: none;
        }

        .formation-court-label {
            color: white;
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.2px;
            margin-bottom: 17px;
        }

        .formation-positions {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            grid-template-areas:
            "p4 p3 p2"
            "p5 p6 p1";
            grid-template-rows: repeat(2, 155px);
            gap: 16px 11px;
            position: relative;
            z-index: 1;
        }

        .formation-slot {
            background: rgba(255,255,255,.97);
            border: 2px solid rgba(255,255,255,.9);
            border-radius: 13px;
            padding: 10px 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 6px;
            cursor: grab;
            min-width: 0;
            user-select: none;
        }

        .formation-slot.dragover {
            border-color: #2563eb;
            background: #dbeafe;
        }

        .formation-slot.dragging {
            opacity: .5;
        }

        .formation-position {
            color: #64748b;
            font-size: 11px;
            font-weight: bold;
        }

        .formation-jersey {
            width: 43px;
            height: 43px;
            background: #253858;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 18px;
        }

        .formation-player {
            color: #172b4d;
            font-size: 11px;
            font-weight: bold;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .formation-pos-note {
            color: #64748b;
            font-size: 10px;
        }

        .formation-liberobox {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 13px;
            padding: 17px;
            margin-top: 18px;
        }

        .formation-liberobox strong {
            color: #1e40af;
            font-size: 14px;
        }

        .formation-liberobox p {
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
            margin: 7px 0 0;
        }

        .formation-field {
            margin-bottom: 17px;
        }

        .formation-field label {
            display: block;
            color: #334155;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .formation-select {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            background: white;
            color: #172b4d;
            font-size: 13px;
        }

        .formation-select:focus {
            border-color: #2563eb;
            outline: 2px solid rgba(37,99,235,.15);
        }

        .formation-message {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .formation-success {
            background: #dcfce7;
            color: #166534;
        }

        .formation-error {
            background: #fff1f2;
            color: #be123c;
        }

        .formation-help {
            margin-top: 20px;
            background: #f1f5f9;
            padding: 14px;
            border-radius: 9px;
            color: #475569;
            font-size: 12px;
            line-height: 1.8;
        }

        .formation-copy-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .formation-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 12px;
            color: #475569;
            margin: 16px 0;
            line-height: 1.6;
        }

        .formation-checkbox input {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
            margin: 1px 0 0;
        }

        .formation-back {
            display: inline-block;
            margin-bottom: 16px;
            color: #315b89;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
        }

        .formation-print-status {
            color: #64748b;
            font-size: 12px;
            margin-top: 12px;
        }

        .formation-print-note {
            display: none;
        }

        @media (max-width: 900px) {
            .formation-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 550px) {
            .formation-hero,
            .formation-card {
                padding: 18px;
            }

            .formation-positions {
                gap: 7px;
                grid-template-rows: repeat(2, 145px);
            }

            .formation-slot {
                padding: 8px 4px;
            }

            .formation-jersey {
                width: 36px;
                height: 36px;
                font-size: 15px;
            }

            .formation-player {
                font-size: 10px;
            }

            .formation-copy-grid {
                grid-template-columns: 1fr;
            }
        }

        /* =========================
           A4 PRINT / SAVE AS PDF
        ========================= */

        @page {
            size: A4 portrait;
            margin: 14mm;
        }

        @media print {
            html,
            body {
                margin: 0 !important;
                padding: 0 !important;
                background: #ffffff !important;
            }

            body * {
                visibility: hidden !important;
            }

            .formation-print-area,
            .formation-print-area * {
                visibility: visible !important;
            }

            .formation-print-area {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                box-shadow: none !important;
                background: #ffffff !important;
                color: #172b4d !important;
                break-inside: avoid;
            }

            .formation-print-header {
                display: block !important;
                padding: 0 0 16px;
                margin-bottom: 16px;
                border-bottom: 2px solid #253858;
            }

            .formation-print-header h1 {
                font-size: 22px;
                margin: 0 0 7px;
                color: #172b4d;
            }

            .formation-print-header p {
                font-size: 12px;
                margin: 5px 0;
                color: #334155;
            }

            .formation-court {
                width: 100%;
                padding: 26px 18px 20px;
                background: #d9a77b !important;
                border: 3px solid #b87949 !important;
                outline: none !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .formation-positions {
                grid-template-rows: repeat(2, 125px);
                gap: 13px;
            }

            .formation-slot {
                background: #ffffff !important;
                border: 1px solid #bdcedd !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .formation-jersey {
                background: #253858 !important;
                color: #ffffff !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .formation-court-label {
                color: #ffffff !important;
            }

            .formation-liberobox {
                margin-top: 15px;
                padding: 14px;
                background: #eff6ff !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .formation-toolbar,
            .formation-help,
            .formation-subtitle,
            .formation-screen-heading {
                display: none !important;
            }

            .formation-print-note {
                display: block !important;
                margin-top: 18px;
                padding-top: 12px;
                border-top: 1px solid #cbd5e1;
                font-size: 11px;
                color: #64748b;
            }
        }
    </style>

    <div class="formation-page">

        <a
            href="{{ route('formacionet.lista') }}"
            class="formation-back"
        >
            ← Kthehu te Formacionet
        </a>

        <div class="formation-hero">
            <small>KV GJINOCI | MATCH LINEUP</small>

            <h1>Formacioni Interaktiv 6+1</h1>

            <p>
                {{ $ndeshja->ekipi?->emri ?? 'Ekipi' }}
                vs {{ $ndeshja->kundershtari }}
            </p>

            <p>
                Cakto pozicionet, ndrysho rotacionin,
                kopjo formacionet dhe printoji ne A4.
            </p>
        </div>

        @if(session('success'))
            <div class="formation-message formation-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="formation-message formation-error">
                <strong>Veprimi nuk u krye.</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ZGJEDHJA E SETIT --}}

        <div class="formation-card">
            <h2>Zgjedhja e Setit</h2>

            <p class="formation-subtitle">
                Shenja ✓ tregon qe seti ka
                formacion te ruajtur.
            </p>

            <div class="formation-tabs">
                @foreach(range(1, 5) as $nr)
                    <a
                        href="{{ route('formacionet.index', [
                        'ndeshja' => $ndeshja->id,
                        'seti' => $nr,
                    ]) }}"
                        class="formation-tab
                        {{ $seti === $nr ? 'active' : '' }}
                        {{ in_array($nr, $teRuajtura)
                            ? 'saved'
                            : '' }}"
                    >
                        Seti {{ $nr }}

                        @if(in_array($nr, $teRuajtura))
                            ✓
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        {{-- FORMACIONI KRYESOR --}}

        <form
            id="formationForm"
            method="POST"
            action="{{ route('formacionet.store', $ndeshja) }}"
        >
            @csrf

            <input
                type="hidden"
                name="seti"
                value="{{ $seti }}"
            >

            <div class="formation-grid">

                <section class="formation-card formation-print-area">

                    {{-- SHFAQET VETEM GJATE PRINTIMIT --}}

                    <div class="formation-print-header">
                        <h1>KV Gjinoci – Formacioni 6+1</h1>

                        <p>
                            <strong>Ekipi:</strong>
                            {{ $ndeshja->ekipi?->emri ?? 'Ekipi' }}
                        </p>

                        <p>
                            <strong>Kundershtari:</strong>
                            {{ $ndeshja->kundershtari }}
                        </p>

                        <p>
                            <strong>Data e ndeshjes:</strong>
                            {{ $ndeshja->data_ndeshjes
                                ? \Carbon\Carbon::parse(
                                    $ndeshja->data_ndeshjes
                                )->format('d.m.Y')
                                : 'Pa date' }}
                        </p>

                        <p>
                            <strong>Seti:</strong> {{ $seti }}
                        </p>

                        <p id="printSaveStatus">
                            <strong>Gjendja:</strong>
                            {{ in_array($seti, $teRuajtura)
                                ? 'Formacion i ruajtur'
                                : 'Formacion ende i paruajtur' }}
                        </p>
                    </div>

                    <h2 class="formation-screen-heading">
                        Fusha e Volejbollit
                    </h2>

                    <p class="formation-subtitle">
                        Terhiq lojtaret nga nje pozicion
                        te tjetri ose ndryshoji nga lista.
                    </p>

                    <div class="formation-court">
                        <div class="formation-net"></div>
                        <div class="formation-attack-line"></div>

                        <div class="formation-court-label">
                            RRJETA / FRONT ROW
                        </div>

                        <div class="formation-positions">
                            @foreach([4, 3, 2, 5, 6, 1] as $pos)
                                <div
                                    class="formation-slot"
                                    draggable="true"
                                    data-position="{{ $pos }}"
                                    style="grid-area:p{{ $pos }}"
                                >
                                <span class="formation-position">
                                    Pozicioni {{ $pos }}
                                </span>

                                    <span
                                        class="formation-jersey"
                                        id="jersey{{ $pos }}"
                                    >
                                    –
                                </span>

                                    <span
                                        class="formation-player"
                                        id="playerLabel{{ $pos }}"
                                    >
                                    Pa lojtare
                                </span>

                                    <span class="formation-pos-note">
                                    {{ in_array($pos, [4, 3, 2])
                                        ? 'Rreshti para'
                                        : 'Rreshti prapa' }}
                                </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="formation-liberobox">
                        <strong>🛡️ Libero</strong>

                        <p id="liberoLabel">
                            Nuk eshte caktuar.
                        </p>

                        <p>
                            Libero ruhet vecmas dhe nuk merr
                            pjese ne rotacionin e gjashte
                            pozicioneve.
                        </p>
                    </div>

                    <div class="formation-toolbar">
                        <button
                            type="button"
                            class="formation-button secondary"
                            id="rotateButton"
                        >
                            ↻ Rotacion +1
                        </button>

                        <button
                            type="button"
                            class="formation-button secondary"
                            id="clearButton"
                        >
                            Pastro Fushen
                        </button>

                        <button
                            type="button"
                            class="formation-button"
                            id="printFormationButton"
                        >
                            🖨️ Printo / Ruaj PDF
                        </button>
                    </div>

                    <div
                        class="formation-print-status"
                        id="formationPrintHint"
                    >
                        Printimi perdor formacionin qe
                        shihet aktualisht ne ekran.
                    </div>

                    <div class="formation-help">
                        <strong>Rotacioni:</strong>
                        2 → 1, 1 → 6, 6 → 5,
                        5 → 4, 4 → 3 dhe 3 → 2.

                        <p>
                            Rotacioni ndryshon vetem
                            pamjen derisa ta ruash
                            formacionin.
                        </p>
                    </div>

                    <div class="formation-print-note">
                        Dokument i gjeneruar nga
                        KV Gjinoci – Volleyball Management System.
                    </div>

                </section>

                <section class="formation-card">
                    <h2>Lista e Lojtareve</h2>

                    <p class="formation-subtitle">
                        Zgjedh 6 lojtare dhe
                        Liberon opsionale.
                    </p>

                    @if($lojtaret->count() < 6)
                        <div class="formation-message formation-error">
                            Ky ekip ka me pak se 6 lojtare.
                            Regjistro te pakten 6 lojtare.
                        </div>
                    @endif

                    @foreach(range(1, 7) as $pos)
                        <div class="formation-field">
                            <label for="position{{ $pos }}">
                                {{ $pos === 7
                                    ? 'Libero (opsionale)'
                                    : 'Pozicioni ' . $pos }}
                            </label>

                            <select
                                class="formation-select"
                                id="position{{ $pos }}"
                                name="pozicionet[{{ $pos }}]"
                                @if($pos !== 7) required @endif
                            >
                                <option value="">
                                    -- Zgjedh lojtaren --
                                </option>

                                @foreach($lojtaret as $lojtare)
                                    @php
                                        $numri = $numrat[
                                            $lojtare->id
                                        ] ?? null;
                                    @endphp

                                    <option
                                        value="{{ $lojtare->id }}"
                                        data-jersey="{{ $numri ?? '' }}"
                                        data-player-name="{{ $lojtare->emri }} {{ $lojtare->mbiemri }}"
                                        @selected(
                                            (string) old(
                                                'pozicionet.' . $pos,
                                                $formacioni[$pos] ?? ''
                                            ) === (string) $lojtare->id
                                        )
                                    >
                                        @if($numri !== null)
                                            #{{ $numri }} –
                                        @endif

                                        {{ $lojtare->emri }}
                                        {{ $lojtare->mbiemri }}

                                        @if($lojtare->pozicioni)
                                            – {{ $lojtare->pozicioni }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach

                    <button
                        type="submit"
                        class="formation-button"
                        style="width:100%"
                        @disabled($lojtaret->count() < 6)
                    >
                        💾 Ruaj Formacionin – Seti {{ $seti }}
                    </button>

                    <p
                        class="formation-subtitle"
                        style="margin-top:15px; margin-bottom:0"
                    >
                        Numrat e fanellave shfaqen
                        automatikisht nese jane
                        te regjistruar te lojtaret.
                    </p>
                </section>

            </div>
        </form>

        {{-- KOPJO FORMACIONIN --}}

        <section class="formation-card">
            <h2>📋 Kopjo Formacionin</h2>

            <p class="formation-subtitle">
                Kopjo 6 lojtaret, pozicionet dhe
                Liberon nga nje set i ruajtur
                ne nje set tjeter.
            </p>

            @if(count($teRuajtura) === 0)
                <div class="formation-help">
                    Fillimisht ruaje formacionin
                    e te pakten nje seti.
                    Pastaj mundesh me e kopju.
                </div>
            @else
                <form
                    id="copyFormationForm"
                    method="POST"
                    action="{{ route('formacionet.kopjo', $ndeshja) }}"
                >
                    @csrf

                    <div class="formation-copy-grid">
                        <div class="formation-field">
                            <label for="setiNga">
                                Kopjo nga seti
                            </label>

                            <select
                                name="seti_nga"
                                id="setiNga"
                                class="formation-select"
                                required
                            >
                                @foreach($teRuajtura as $nr)
                                    <option
                                        value="{{ $nr }}"
                                        @selected(
                                            (int) old(
                                                'seti_nga',
                                                in_array($seti, $teRuajtura)
                                                    ? $seti
                                                    : $teRuajtura[0]
                                            ) === $nr
                                        )
                                    >
                                        Seti {{ $nr }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="formation-field">
                            <label for="setiNe">
                                Kopjo ne setin
                            </label>

                            <select
                                name="seti_ne"
                                id="setiNe"
                                class="formation-select"
                                required
                            >
                                @foreach(range(1, 5) as $nr)
                                    <option
                                        value="{{ $nr }}"
                                        @selected(
                                            (int) old(
                                                'seti_ne',
                                                $seti < 5 ? $seti + 1 : 1
                                            ) === $nr
                                        )
                                    >
                                        Seti {{ $nr }}

                                        @if(in_array($nr, $teRuajtura))
                                            (i ruajtur)
                                        @else
                                            (bosh)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label class="formation-checkbox">
                        <input
                            type="checkbox"
                            name="overwrite"
                            value="1"
                            id="overwriteFormation"
                            @checked(old('overwrite'))
                        >

                        <span>
                        Lejo mbishkrimin nese
                        seti destinacion ka
                        formacion te ruajtur.
                    </span>
                    </label>

                    <button
                        type="submit"
                        class="formation-button"
                    >
                        📋 Kopjo Formacionin
                    </button>
                </form>
            @endif
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const selects = {};

            for (let pos = 1; pos <= 7; pos++) {
                selects[pos] = document.getElementById(
                    'position' + pos
                );
            }

            const formationForm = document.getElementById(
                'formationForm'
            );

            const printButton = document.getElementById(
                'printFormationButton'
            );

            const printStatus = document.getElementById(
                'printSaveStatus'
            );

            const printHint = document.getElementById(
                'formationPrintHint'
            );

            const initiallySaved = @json(
        in_array($seti, $teRuajtura)
    );

            let hasUnsavedChanges = false;

            function markChanged() {
                hasUnsavedChanges = true;

                printStatus.textContent =
                    'Gjendja: Formacion me ndryshime te paruajtura';

                printHint.textContent =
                    'Ke ndryshime te paruajtura. ' +
                    'Printimi do t’i perfshije edhe ato.';
            }

            function getPlayerData(position) {
                const select = selects[position];

                if (!select || !select.value) {
                    return {
                        name: 'Pa lojtare',
                        jersey: '–'
                    };
                }

                const option = select.options[
                    select.selectedIndex
                    ];

                return {
                    name: option.dataset.playerName
                        || option.text.trim(),

                    jersey: option.dataset.jersey
                        || '–'
                };
            }

            function updateCourt() {
                for (let pos = 1; pos <= 6; pos++) {
                    const player = getPlayerData(pos);

                    document.getElementById(
                        'playerLabel' + pos
                    ).textContent = player.name;

                    document.getElementById(
                        'jersey' + pos
                    ).textContent = player.jersey;
                }

                const libero = getPlayerData(7);

                document.getElementById(
                    'liberoLabel'
                ).textContent = selects[7].value
                    ? (
                    libero.jersey !== '–'
                        ? '#' + libero.jersey + ' – '
                        : ''
                ) + libero.name
                    : 'Nuk eshte caktuar.';
            }

            function hasDuplicates() {
                const ids = Object.values(selects)
                    .map(select => select.value)
                    .filter(Boolean);

                return ids.length !== new Set(ids).size;
            }

            Object.values(selects).forEach(function (select) {
                select.addEventListener('change', function () {
                    updateCourt();
                    markChanged();
                });
            });

            // ROTACIONI

            document.getElementById(
                'rotateButton'
            ).addEventListener('click', function () {

                const previous = {};

                for (let pos = 1; pos <= 6; pos++) {
                    previous[pos] = selects[pos].value;
                }

                selects[1].value = previous[2];
                selects[2].value = previous[3];
                selects[3].value = previous[4];
                selects[4].value = previous[5];
                selects[5].value = previous[6];
                selects[6].value = previous[1];

                updateCourt();
                markChanged();
            });

            // PASTRO FUSHEN

            document.getElementById(
                'clearButton'
            ).addEventListener('click', function () {

                if (!confirm(
                    'A deshiron ta pastrosh fushen?'
                )) {
                    return;
                }

                Object.values(selects).forEach(
                    select => select.value = ''
                );

                updateCourt();
                markChanged();
            });

            // DRAG AND DROP

            let sourcePosition = null;

            document.querySelectorAll(
                '.formation-slot'
            ).forEach(function (slot) {

                slot.addEventListener(
                    'dragstart',
                    function (event) {
                        sourcePosition = Number(
                            slot.dataset.position
                        );

                        slot.classList.add('dragging');

                        event.dataTransfer.effectAllowed = 'move';

                        event.dataTransfer.setData(
                            'text/plain',
                            String(sourcePosition)
                        );
                    }
                );

                slot.addEventListener(
                    'dragover',
                    function (event) {
                        event.preventDefault();
                        slot.classList.add('dragover');
                    }
                );

                slot.addEventListener(
                    'dragleave',
                    function () {
                        slot.classList.remove('dragover');
                    }
                );

                slot.addEventListener(
                    'drop',
                    function (event) {
                        event.preventDefault();
                        slot.classList.remove('dragover');

                        const targetPosition = Number(
                            slot.dataset.position
                        );

                        if (
                            !sourcePosition
                            || sourcePosition === targetPosition
                        ) {
                            return;
                        }

                        const oldTarget =
                            selects[targetPosition].value;

                        selects[targetPosition].value =
                            selects[sourcePosition].value;

                        selects[sourcePosition].value =
                            oldTarget;

                        updateCourt();
                        markChanged();
                    }
                );

                slot.addEventListener(
                    'dragend',
                    function () {
                        sourcePosition = null;

                        document.querySelectorAll(
                            '.formation-slot'
                        ).forEach(function (element) {
                            element.classList.remove(
                                'dragging',
                                'dragover'
                            );
                        });
                    }
                );
            });

            // VALIDIMI PARA RUAJTJES

            formationForm.addEventListener(
                'submit',
                function (event) {
                    if (hasDuplicates()) {
                        event.preventDefault();

                        alert(
                            'Nje lojtare nuk mund te jete ' +
                            'ne dy pozicione.'
                        );
                    }
                }
            );

            // PRINTIMI A4

            if (printButton) {
                printButton.addEventListener('click', function () {

                    updateCourt();

                    const filledPositions = [
                        1, 2, 3, 4, 5, 6
                    ].every(function (pos) {
                        return Boolean(selects[pos].value);
                    });

                    if (!filledPositions || hasDuplicates()) {
                        alert(
                            'Per printim zgjedh 6 lojtare ' +
                            'te ndryshme ne fushe.'
                        );

                        return;
                    }

                    if (!hasUnsavedChanges) {
                        printStatus.textContent = initiallySaved
                            ? 'Gjendja: Formacion i ruajtur'
                            : 'Gjendja: Formacion ende i paruajtur';
                    }

                    window.print();
                });
            }

            // KOPJIMI

            const copyForm = document.getElementById(
                'copyFormationForm'
            );

            if (copyForm) {

                copyForm.addEventListener(
                    'submit',
                    function (event) {

                        const from = document.getElementById(
                            'setiNga'
                        ).value;

                        const to = document.getElementById(
                            'setiNe'
                        ).value;

                        if (from === to) {
                            event.preventDefault();

                            alert(
                                'Zgjedh dy sete te ndryshme.'
                            );

                            return;
                        }

                        const savedSets = @json($teRuajtura);

                        const targetHasFormation =
                            savedSets.includes(Number(to));

                        const overwrite = document.getElementById(
                            'overwriteFormation'
                        ).checked;

                        if (targetHasFormation && !overwrite) {
                            event.preventDefault();

                            alert(
                                'Seti ' + to +
                                ' ka formacion te ruajtur. ' +
                                'Aktivizo konfirmimin e mbishkrimit.'
                            );

                            return;
                        }

                        if (targetHasFormation) {
                            const confirmed = confirm(
                                'Kujdes! Formacioni i Setit ' +
                                to +
                                ' do te zevendesohet. A je i sigurt?'
                            );

                            if (!confirmed) {
                                event.preventDefault();
                            }
                        }
                    }
                );
            }

            updateCourt();
        });
    </script>

@endsection
