@extends('layouts.club')

@section('title', 'Menaxho Ndeshjen - KV Gjinoci')

@section('content')

    <style>
        .mf-page {
            max-width: 1080px;
            margin: 0 auto;
            padding: 15px 0 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .mf-page * {
            box-sizing: border-box;
        }

        .mf-hero {
            background: linear-gradient(120deg, #172b4d, #315b89);
            padding: 32px;
            border-radius: 18px;
            margin-bottom: 24px;
            color: white;
        }

        .mf-hero small {
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .mf-hero h1 {
            margin: 13px 0;
            font-size: 30px;
            color: white;
        }

        .mf-hero p {
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .mf-card {
            background: white;
            padding: 27px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            margin-bottom: 24px;
            box-shadow: 0 4px 16px rgba(15,23,42,.04);
        }

        .mf-card h2 {
            font-size: 22px;
            margin: 0 0 10px;
        }

        .mf-subtitle {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 24px;
            line-height: 1.7;
        }

        .mf-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .mf-full {
            grid-column: 1 / -1;
        }

        .mf-field label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 13px;
            font-weight: bold;
        }

        .mf-page input,
        .mf-page select {
            width: 100%;
            padding: 12px 14px;
            min-height: 46px;
            background: #f8fafc;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            color: #172b4d;
            font-size: 14px;
            outline: none;
        }

        .mf-page input:focus,
        .mf-page select:focus {
            border-color: #2563eb;
            background: white;
        }

        .mf-info {
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            padding: 17px;
            margin-bottom: 23px;
            color: #315b89;
            font-size: 13px;
            line-height: 1.7;
        }

        .mf-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            border-radius: 11px;
            padding: 17px;
            margin-bottom: 23px;
            font-size: 13px;
            line-height: 1.7;
        }

        .mf-scoreboard {
            background: linear-gradient(120deg, #172b4d, #315b89);
            border-radius: 15px;
            color: white;
            padding: 25px;
            margin: 23px 0;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 20px;
            text-align: center;
        }

        .mf-scoreboard h3 {
            color: white;
            font-size: 17px;
            margin: 0;
        }

        .mf-scoreboard small {
            color: #bfdbfe;
            font-size: 11px;
            display: block;
            margin-top: 7px;
        }

        .mf-score {
            font-size: 36px;
            font-weight: bold;
            padding: 15px 20px;
            background: rgba(255,255,255,.12);
            border-radius: 10px;
            white-space: nowrap;
        }

        .mf-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
        }

        .mf-page table {
            border-collapse: collapse;
            width: 100%;
            min-width: 560px;
        }

        .mf-page th {
            background: #253858;
            padding: 14px;
            text-align: left;
            font-size: 12px;
            color: white;
        }

        .mf-page td {
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .mf-page td input {
            max-width: 130px;
        }

        .mf-set-number {
            display: inline-flex;
            width: 35px;
            height: 35px;
            background: #e8efff;
            border-radius: 9px;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .mf-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 11px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            margin-top: 25px;
        }

        .mf-btn {
            border: none;
            padding: 13px 20px;
            border-radius: 9px;
            background: #253858;
            color: white !important;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none !important;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .mf-btn-light {
            background: #edf2f7;
            color: #253858 !important;
        }

        .mf-result-message {
            padding: 15px;
            border-radius: 9px;
            background: #edf4ff;
            color: #315b89;
            margin-top: 18px;
            font-size: 13px;
        }

        .mf-valid {
            background: #dcfce7;
            color: #15803d;
        }

        .mf-invalid {
            background: #fff1f2;
            color: #be123c;
        }

        .mf-page [hidden] {
            display: none !important;
        }

        @media(max-width: 650px) {
            .mf-grid {
                grid-template-columns: 1fr;
            }

            .mf-card,
            .mf-hero {
                padding: 20px;
            }

            .mf-scoreboard {
                gap: 10px;
                padding: 18px 12px;
            }

            .mf-scoreboard h3 {
                font-size: 14px;
            }

            .mf-score {
                font-size: 24px;
                padding: 12px;
            }

            .mf-actions {
                flex-wrap: wrap;
            }
        }
    </style>

    @php
        $editing = $ndeshja->exists;

        $savedSetet = $editing
            ? $ndeshja->setet->map(fn($seti) => [
                'numri_setit' => $seti->numri_setit,
                'piket_tona' => $seti->piket_tona,
                'piket_kundershtarit' => $seti->piket_kundershtarit,
            ])->values()->all()
            : [];

        $formSetet = array_values(
            old('setet', $savedSetet)
        );

        $numriSeteve = max(
            3,
            min(5, count($formSetet))
        );
    @endphp

    <div class="mf-page">

        <div class="mf-hero">

            <small>KV GJINOCI | MATCH MANAGEMENT</small>

            <h1>
                {{ $editing ? 'Edito Ndeshjen' : 'Shto Ndeshje te Re' }}
            </h1>

            <p>
                Planifiko ndeshjet e ekipit tend,
                regjistro rezultatet dhe percjell performancen.
            </p>

        </div>

        @if($errors->any())

            <div class="mf-error">

                <strong>Kontrollo te dhenat:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        @if($ekipet->isEmpty())

            <div class="mf-card">

                <h2>Nuk ke ekip te caktuar</h2>

                <p>
                    Kontakto administratorin per
                    t'u caktuar ne nje ekip.
                </p>

                <a href="{{ route('coach.ndeshjet') }}"
                   class="mf-btn">

                    Kthehu

                </a>

            </div>

        @else

            <form id="matchForm"
                  method="POST"
                  action="{{ $editing
                ? route('coach.ndeshjet.update', $ndeshja)
                : route('coach.ndeshjet.store') }}">

                @csrf

                @if($editing)
                    @method('PUT')
                @endif

                <div class="mf-card">

                    <h2>Informacionet e Ndeshjes</h2>

                    <p class="mf-subtitle">
                        Ploteso informacionet e ndeshjes.
                    </p>

                    <div class="mf-info">

                        <strong>Si funksionon?</strong>

                        <div>
                            Zgjedh Planifikuar per ndeshjet
                            e ardhshme ose Perfunduar per
                            te regjistruar rezultatet e seteve.
                        </div>

                    </div>

                    <div class="mf-grid">

                        <div class="mf-field">

                            <label for="sezoni_id">Sezoni</label>

                            <select name="sezoni_id" id="sezoni_id">

                                <option value="">Pa sezon</option>

                                @foreach($sezonet as $sezoni)

                                    <option value="{{ $sezoni->id }}"
                                        @selected(old(
                                            'sezoni_id',
                                            $ndeshja->sezoni_id
                                        ) == $sezoni->id)>

                                        {{ $sezoni->emri }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mf-field">

                            <label for="ekipi_id">Ekipi</label>

                            <select name="ekipi_id"
                                    id="ekipi_id"
                                    required
                                @disabled($editing)>

                                <option value="">
                                    Zgjedh ekipin
                                </option>

                                @foreach($ekipet as $ekipi)

                                    <option value="{{ $ekipi->id }}"
                                        @selected(old(
                                            'ekipi_id',
                                            $ndeshja->ekipi_id
                                        ) == $ekipi->id)>

                                        {{ $ekipi->emri }}

                                    </option>

                                @endforeach

                            </select>

                            @if($editing)

                                <input type="hidden"
                                       name="ekipi_id"
                                       value="{{ $ndeshja->ekipi_id }}">

                            @endif

                        </div>

                        <div class="mf-field">

                            <label for="kundershtari">
                                Kundershtari
                            </label>

                            <input type="text"
                                   name="kundershtari"
                                   id="kundershtari"
                                   placeholder="Emri i ekipit kundershtar"
                                   value="{{ old(
                                   'kundershtari',
                                   $ndeshja->kundershtari
                               ) }}"
                                   required>

                        </div>

                        <div class="mf-field">

                            <label for="data_ndeshjes">
                                Data dhe Ora
                            </label>

                            <input type="datetime-local"
                                   name="data_ndeshjes"
                                   id="data_ndeshjes"
                                   value="{{ old(
                                   'data_ndeshjes',
                                   $ndeshja->data_ndeshjes
                                       ? \Carbon\Carbon::parse(
                                           $ndeshja->data_ndeshjes
                                         )->format('Y-m-d\TH:i')
                                       : ''
                               ) }}"
                                   required>

                        </div>

                        <div class="mf-field">

                            <label for="palestra">Palestra</label>

                            <input type="text"
                                   name="palestra"
                                   id="palestra"
                                   placeholder="Palestra sportive"
                                   value="{{ old(
                                   'palestra',
                                   $ndeshja->palestra
                               ) }}"
                                   required>

                        </div>

                        <div class="mf-field">

                            <label for="lokacioni">Lokacioni</label>

                            <select name="lokacioni"
                                    id="lokacioni"
                                    required>

                                @foreach(['Vendas', 'Mysafir'] as $lokacioni)

                                    <option value="{{ $lokacioni }}"
                                        @selected(old(
                                            'lokacioni',
                                            $ndeshja->lokacioni ?? 'Vendas'
                                        ) === $lokacioni)>

                                        {{ $lokacioni }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mf-field mf-full">

                            <label for="statusi">Statusi</label>

                            <select name="statusi"
                                    id="statusi"
                                    required>

                                @foreach(['Planifikuar', 'Perfunduar'] as $statusi)

                                    <option value="{{ $statusi }}"
                                        @selected(old(
                                            'statusi',
                                            $ndeshja->statusi ?? 'Planifikuar'
                                        ) === $statusi)>

                                        {{ $statusi }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

                <div class="mf-card" id="resultsSection" hidden>

                    <h2>Rezultatet e Ndeshjes</h2>

                    <p class="mf-subtitle">
                        Regjistro piket per secilin set.
                        Rezultati final llogaritet automatikisht.
                    </p>

                    <div class="mf-field">

                        <label for="numriSeteve">
                            Numri i seteve te luajtura
                        </label>

                        <select id="numriSeteve">

                            @foreach([3, 4, 5] as $numri)

                                <option value="{{ $numri }}"
                                    @selected($numriSeteve === $numri)>

                                    {{ $numri }} sete

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mf-scoreboard">

                        <div>
                            <h3 id="teamName">Ekipi Yne</h3>
                            <small>EKIPI</small>
                        </div>

                        <div class="mf-score" id="finalScore">
                            0 - 0
                        </div>

                        <div>
                            <h3 id="opponentName">Kundershtari</h3>
                            <small>KUNDERSHTARI</small>
                        </div>

                    </div>

                    <input type="hidden"
                           name="setet_tona"
                           id="setet_tona"
                           value="0">

                    <input type="hidden"
                           name="setet_kundershtarit"
                           id="setet_kundershtarit"
                           value="0">

                    <div class="mf-table-wrap">

                        <table>

                            <thead>
                            <tr>
                                <th>Seti</th>
                                <th>Piket Tona</th>
                                <th>Piket e Kundershtarit</th>
                                <th>Fituesi</th>
                            </tr>
                            </thead>

                            <tbody>

                            @for($i = 0; $i < 5; $i++)

                                <tr class="set-row" data-index="{{ $i }}">

                                    <td>

                                        <span class="mf-set-number">

                                            {{ $i + 1 }}

                                        </span>

                                        <input type="hidden"
                                               name="setet[{{ $i }}][numri_setit]"
                                               value="{{ $i + 1 }}">

                                    </td>

                                    <td>

                                        <input type="number"
                                               name="setet[{{ $i }}][piket_tona]"
                                               class="set-ours"
                                               min="0"
                                               max="999"
                                               step="1"
                                               placeholder="0"
                                               value="{{ $formSetet[$i]['piket_tona'] ?? '' }}">

                                    </td>

                                    <td>

                                        <input type="number"
                                               name="setet[{{ $i }}][piket_kundershtarit]"
                                               class="set-theirs"
                                               min="0"
                                               max="999"
                                               step="1"
                                               placeholder="0"
                                               value="{{ $formSetet[$i]['piket_kundershtarit'] ?? '' }}">

                                    </td>

                                    <td class="set-winner">
                                        -
                                    </td>

                                </tr>

                            @endfor

                            </tbody>

                        </table>

                    </div>

                    <div class="mf-result-message" id="resultMessage">

                        Ploteso rezultatet e seteve.

                    </div>

                </div>

                <div class="mf-card">

                    <div class="mf-actions" style="margin:0; padding:0; border:0;">

                        <a href="{{ route('coach.ndeshjet') }}"
                           class="mf-btn mf-btn-light">

                            Anulo

                        </a>

                        <button type="submit"
                                id="saveMatch"
                                class="mf-btn">

                            {{ $editing
                                ? 'Ruaj Ndryshimet'
                                : 'Ruaj Ndeshjen' }}

                        </button>

                    </div>

                </div>

            </form>

        @endif

    </div>

    <script>
        const matchForm = document.getElementById('matchForm');

        if (matchForm) {

            const statusi = document.getElementById('statusi');

            const numriSeteve = document.getElementById('numriSeteve');

            const resultsSection = document.getElementById('resultsSection');

            const rows = Array.from(
                document.querySelectorAll('.set-row')
            );

            const teamSelect = document.getElementById('ekipi_id');

            const opponentInput = document.getElementById('kundershtari');

            function perditesoEmrat() {

                const teamName = teamSelect.value
                    ? teamSelect.options[
                        teamSelect.selectedIndex
                        ].textContent.trim()
                    : 'Ekipi Yne';

                const opponentName =
                    opponentInput.value.trim() || 'Kundershtari';

                document.getElementById('teamName')
                    .textContent = teamName;

                document.getElementById('opponentName')
                    .textContent = opponentName;

                return {
                    teamName,
                    opponentName
                };
            }

            function llogaritRezultatin() {

                const {teamName, opponentName} = perditesoEmrat();

                const perfunduar =
                    statusi.value === 'Perfunduar';

                const numri = Number(numriSeteve.value);

                resultsSection.hidden = !perfunduar;

                let tona = 0;

                let kundershtarit = 0;

                let valid = true;

                let message = '';

                rows.forEach((row, index) => {

                    const aktiv =
                        perfunduar && index < numri;

                    row.hidden = !aktiv;

                    row.querySelectorAll('input').forEach(input => {

                        input.disabled = !aktiv;

                        if (input.type === 'number') {
                            input.required = aktiv;
                        }
                    });

                    if (!aktiv) return;

                    const aInput = row.querySelector('.set-ours');

                    const bInput = row.querySelector('.set-theirs');

                    const winner = row.querySelector('.set-winner');

                    if (tona === 3 || kundershtarit === 3) {

                        winner.textContent = 'Set i tepert';

                        valid = false;

                        message =
                            'Ndeshja perfundon kur nje ekip fiton 3 sete.';

                        return;
                    }

                    if (
                        aInput.value === '' ||
                        bInput.value === ''
                    ) {
                        winner.textContent = '-';

                        valid = false;

                        return;
                    }

                    const a = Number(aInput.value);

                    const b = Number(bInput.value);

                    const minimum = index === 4 ? 15 : 25;

                    const fituesi = Math.max(a, b);

                    const humbesi = Math.min(a, b);

                    if (
                        a < 0 ||
                        b < 0 ||
                        !Number.isInteger(a) ||
                        !Number.isInteger(b) ||
                        fituesi !== Math.max(minimum, humbesi + 2)
                    ) {

                        winner.textContent = 'Jo valid';

                        winner.style.color = '#dc2626';

                        valid = false;

                        message =
                            'Kontrollo rezultatin e setit ' + (index + 1) + '.';

                        return;
                    }

                    if (a > b) {

                        tona++;

                        winner.textContent = teamName;

                        winner.style.color = '#15803d';

                    } else {

                        kundershtarit++;

                        winner.textContent = opponentName;

                        winner.style.color = '#be123c';

                    }

                });

                document.getElementById('finalScore')
                    .textContent = tona + ' - ' + kundershtarit;

                document.getElementById('setet_tona')
                    .value = perfunduar ? tona : 0;

                document.getElementById('setet_kundershtarit')
                    .value = perfunduar ? kundershtarit : 0;

                const rezultatiValid =
                    valid &&
                    (tona === 3 || kundershtarit === 3);

                const resultMessage =
                    document.getElementById('resultMessage');

                resultMessage.classList.remove(
                    'mf-valid',
                    'mf-invalid'
                );

                if (rezultatiValid) {

                    resultMessage.classList.add('mf-valid');

                    resultMessage.textContent =
                        'Rezultati eshte valid. Fituesi: ' +
                        (tona === 3 ? teamName : opponentName);

                } else {

                    resultMessage.classList.add('mf-invalid');

                    resultMessage.textContent =
                        message ||
                        'Ploteso setet. Nje ekip duhet te fitoje 3 sete.';
                }

                return !perfunduar || rezultatiValid;
            }

            statusi.addEventListener(
                'change',
                llogaritRezultatin
            );

            numriSeteve.addEventListener(
                'change',
                llogaritRezultatin
            );

            teamSelect.addEventListener(
                'change',
                llogaritRezultatin
            );

            opponentInput.addEventListener(
                'input',
                llogaritRezultatin
            );

            document.querySelectorAll(
                '.set-ours, .set-theirs'
            ).forEach(input => {

                input.addEventListener(
                    'input',
                    llogaritRezultatin
                );

            });

            matchForm.addEventListener('submit', event => {

                if (!llogaritRezultatin()) {

                    event.preventDefault();

                    resultsSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                }

            });

            llogaritRezultatin();
        }
    </script>

@endsection
