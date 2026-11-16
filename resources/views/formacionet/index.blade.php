@extends('layouts.club')

@section('title', 'Formacioni 6+1 - KV Gjinoci')

@section('content')

    <style>
        .formation-page {
            max-width: 1250px;
            margin: 0 auto;
            color: #172b4d;
        }

        .formation-page * {
            box-sizing: border-box;
        }

        .formation-hero {
            background: linear-gradient(
                120deg,
                #101e38,
                #315b89
            );
            border-radius: 18px;
            padding: 28px;
            color: white;
            margin-bottom: 22px;
        }

        .formation-hero small {
            color: #bfdbfe;
            letter-spacing: 1.3px;
            font-weight: bold;
            font-size: 11px;
        }

        .formation-hero h1 {
            color: white;
            font-size: 29px;
            margin: 12px 0;
        }

        .formation-hero p {
            color: #dbeafe;
            font-size: 13px;
            margin: 0;
            line-height: 1.7;
        }

        .formation-toolbar {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            margin: 22px 0;
        }

        .formation-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 17px;
            border-radius: 9px;
            border: none;
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

        .formation-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .formation-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
        }

        .formation-tab {
            padding: 11px 17px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            background: #f1f5f9;
            color: #334155;
            border: 1px solid #dbe3ee;
        }

        .formation-tab.active {
            background: #253858;
            color: white;
            border-color: #253858;
        }

        .formation-tab.saved:not(.active) {
            border-color: #86efac;
        }

        .formation-grid {
            display: grid;
            grid-template-columns:
            minmax(0, 1.6fr)
            minmax(280px, 1fr);
            gap: 20px;
            align-items: start;
        }

        .formation-card h2 {
            font-size: 19px;
            margin: 0 0 9px;
            color: #172b4d;
        }

        .formation-subtitle {
            margin: 0 0 20px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.7;
        }

        .formation-court {
            background: linear-gradient(
                145deg,
                #d78c53,
                #c87945
            );
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
            text-align: center;
            font-size: 11px;
            color: white;
            font-weight: bold;
            margin-bottom: 17px;
            letter-spacing: 1.2px;
        }

        .formation-positions {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            grid-template-areas:
            "p4 p3 p2"
            "p5 p6 p1";
            grid-template-rows: repeat(2, 145px);
            gap: 16px 11px;
            position: relative;
            z-index: 1;
        }

        .formation-slot {
            background: rgba(255,255,255,.96);
            border: 2px solid rgba(255,255,255,.9);
            border-radius: 13px;
            padding: 12px 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 8px;
            cursor: grab;
            min-width: 0;
        }

        .formation-slot.dragover {
            border-color: #2563eb;
            background: #dbeafe;
        }

        .formation-slot.dragging {
            opacity: .5;
        }

        .formation-position {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #253858;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
        }

        .formation-player {
            font-size: 12px;
            font-weight: bold;
            color: #172b4d;
            overflow-wrap: anywhere;
            line-height: 1.4;
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
            font-size: 14px;
            color: #1e40af;
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
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 7px;
            color: #334155;
        }

        .formation-select {
            width: 100%;
            border: 1px solid #cbd5e1;
            background: white;
            padding: 11px;
            border-radius: 9px;
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
            font-size: 12px;
            color: #475569;
            line-height: 1.8;
        }

        @media(max-width: 900px) {
            .formation-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 550px) {
            .formation-hero,
            .formation-card {
                padding: 18px;
            }

            .formation-positions {
                gap: 7px;
                grid-template-rows: repeat(2, 125px);
            }

            .formation-slot {
                padding: 8px 4px;
            }

            .formation-player {
                font-size: 10px;
            }
        }
    </style>

    <div class="formation-page">

        <div class="formation-hero">
            <small>KV GJINOCI | MATCH LINEUP</small>

            <h1>Formacioni Interaktiv 6+1</h1>

            <p>
                {{ $ndeshja->ekipi?->emri ?? 'Ekipi' }}
                vs
                {{ $ndeshja->kundershtari }}
            </p>

            <p>
                Cakto gjashte lojtaret fillestare dhe Liberon
                per secilin set te ndeshjes.
            </p>
        </div>

        @if(session('success'))
            <div class="formation-message formation-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="formation-message formation-error">
                <strong>Formacioni nuk u ruajt.</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="formation-card">
            <h2>Zgjedhja e Setit</h2>
            <p class="formation-subtitle">
                Secili set ka formacionin e vet te ruajtur.
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
                        {{ in_array($nr, $teRuajtura) ? 'saved' : '' }}"
                    >
                        Seti {{ $nr }}
                        @if(in_array($nr, $teRuajtura))
                            ✓
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        <form
            id="formationForm"
            method="POST"
            action="{{ route('formacionet.store', $ndeshja) }}"
        >
            @csrf

            <input type="hidden" name="seti" value="{{ $seti }}">

            <div class="formation-grid">

                <section class="formation-card">
                    <h2>Fusha e Volejbollit</h2>

                    <p class="formation-subtitle">
                        Terhiq nje pozicion mbi tjetrin per me i
                        nderru lojtaret. Mundesh edhe me perdor
                        listat ne anen e djathte.
                    </p>

                    <div class="formation-court">
                        <div class="formation-net"></div>
                        <div class="formation-attack-line"></div>

                        <div class="formation-court-label">
                            RRJETA / FRONT ROW
                        </div>

                        <div class="formation-positions">
                            @foreach([4,3,2,5,6,1] as $pos)
                                <div
                                    class="formation-slot"
                                    draggable="true"
                                    data-position="{{ $pos }}"
                                    style="grid-area:p{{ $pos }}"
                                >
                                <span class="formation-position">
                                    {{ $pos }}
                                </span>

                                    <span
                                        class="formation-player"
                                        id="playerLabel{{ $pos }}"
                                    >
                                    Pa lojtare
                                </span>

                                    <span class="formation-pos-note">
                                    {{ in_array($pos, [4,3,2])
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
                            Libero ruhet veçmas dhe nuk merr
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
                    </div>

                    <div class="formation-help">
                        <strong>Rregulli i rotacionit:</strong>
                        Pozicioni 2 kalon ne 1,
                        1 ne 6, 6 ne 5, 5 ne 4,
                        4 ne 3 dhe 3 ne 2.
                        Butoni ndryshon vetem formacionin ne ekran;
                        duhet me kliku Ruaj Formacionin per me
                        e regjistru ne databaze.
                    </div>
                </section>

                <section class="formation-card">
                    <h2>Lista e Lojtareve</h2>

                    <p class="formation-subtitle">
                        Zgjedh nje lojtare per secilin pozicion.
                        Nuk lejohet e njejta lojtare dy here.
                    </p>

                    @if($lojtaret->count() < 6)
                        <div class="formation-message formation-error">
                            Ky ekip ka me pak se 6 lojtare.
                            Regjistro te pakten 6 lojtare
                            perpara ruajtjes se formacionit.
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
                                data-position="{{ $pos }}"
                                @if($pos !== 7) required @endif
                            >
                                <option value="">
                                    -- Zgjedh lojtaren --
                                </option>

                                @foreach($lojtaret as $lojtare)
                                    <option
                                        value="{{ $lojtare->id }}"
                                        @selected(
                                            (string) old(
                                                'pozicionet.' . $pos,
                                                $formacioni[$pos] ?? ''
                                            ) === (string) $lojtare->id
                                        )
                                    >
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

                    <p class="formation-subtitle"
                       style="margin-top:15px; margin-bottom:0">
                        Formacioni lidhet automatikisht me
                        ndeshjen dhe ekipin perkates.
                    </p>
                </section>

            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selects = {};

            for (let pos = 1; pos <= 7; pos++) {
                selects[pos] = document.getElementById(
                    'position' + pos
                );
            }

            const playerName = (position) => {
                const select = selects[position];

                if (!select.value) {
                    return 'Pa lojtare';
                }

                return select.options[select.selectedIndex]
                    .text.trim();
            };

            function updateCourt() {
                for (let pos = 1; pos <= 6; pos++) {
                    document.getElementById(
                        'playerLabel' + pos
                    ).textContent = playerName(pos);
                }

                const libero = selects[7].value
                    ? playerName(7)
                    : 'Nuk eshte caktuar.';

                document.getElementById(
                    'liberoLabel'
                ).textContent = libero;
            }

            function hasDuplicates() {
                const values = Object.values(selects)
                    .map(select => select.value)
                    .filter(Boolean);

                return new Set(values).size !== values.length;
            }

            Object.values(selects).forEach(select => {
                select.addEventListener('change', updateCourt);
            });

            document.getElementById(
                'rotateButton'
            ).addEventListener('click', function () {
                const previous = {};

                for (let pos = 1; pos <= 6; pos++) {
                    previous[pos] = selects[pos].value;
                }

                // Rotacioni sipas drejtimit te ores.
                selects[1].value = previous[2];
                selects[2].value = previous[3];
                selects[3].value = previous[4];
                selects[4].value = previous[5];
                selects[5].value = previous[6];
                selects[6].value = previous[1];

                updateCourt();
            });

            document.getElementById(
                'clearButton'
            ).addEventListener('click', function () {
                if (!confirm('A deshiron ta pastrosh fushen?')) {
                    return;
                }

                Object.values(selects).forEach(select => {
                    select.value = '';
                });

                updateCourt();
            });

            // Drag-and-drop i pozicioneve 1-6.
            let sourcePosition = null;

            document.querySelectorAll(
                '.formation-slot'
            ).forEach(slot => {
                slot.addEventListener('dragstart', function (event) {
                    sourcePosition = Number(slot.dataset.position);
                    slot.classList.add('dragging');

                    event.dataTransfer.effectAllowed = 'move';
                    event.dataTransfer.setData(
                        'text/plain',
                        String(sourcePosition)
                    );
                });

                slot.addEventListener('dragover', function (event) {
                    event.preventDefault();
                    slot.classList.add('dragover');
                });

                slot.addEventListener('dragleave', function () {
                    slot.classList.remove('dragover');
                });

                slot.addEventListener('drop', function (event) {
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

                    const previousTarget =
                        selects[targetPosition].value;

                    selects[targetPosition].value =
                        selects[sourcePosition].value;

                    selects[sourcePosition].value =
                        previousTarget;

                    updateCourt();
                });

                slot.addEventListener('dragend', function () {
                    sourcePosition = null;

                    document.querySelectorAll(
                        '.formation-slot'
                    ).forEach(element => {
                        element.classList.remove(
                            'dragging',
                            'dragover'
                        );
                    });
                });
            });

            document.getElementById(
                'formationForm'
            ).addEventListener('submit', function (event) {
                if (hasDuplicates()) {
                    event.preventDefault();

                    alert(
                        'Nje lojtare nuk mund te vendoset ' +
                        'ne dy pozicione. Kontrollo formacionin.'
                    );
                }
            });

            updateCourt();
        });
    </script>

@endsection
