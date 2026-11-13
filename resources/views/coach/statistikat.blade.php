@extends('layouts.club')

@section('title', 'Statistikat Individuale - KV Gjinoci')

@section('content')

    <style>
        .cp-page {
            max-width: 1050px;
            margin: 0 auto;
            padding: 15px 0 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .cp-page * {
            box-sizing: border-box;
        }

        .cp-hero {
            background: linear-gradient(120deg, #172b4d, #315b89);
            padding: 30px;
            border-radius: 18px;
            color: white;
            margin-bottom: 25px;
        }

        .cp-hero small {
            color: #bfdbfe;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .cp-hero h1 {
            color: white;
            margin: 15px 0;
            font-size: 29px;
        }

        .cp-hero p {
            color: #dbeafe;
            font-size: 14px;
        }

        .cp-card {
            background: white;
            padding: 28px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .cp-card h2 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        .cp-subtitle {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0 0 23px;
        }

        .cp-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .cp-full {
            grid-column: 1 / -1;
        }

        .cp-field label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #334155;
        }

        .cp-field input,
        .cp-field select {
            width: 100%;
            padding: 13px;
            height: 48px;
            border-radius: 9px;
            border: 1px solid #dbe3ee;
            background: #f8fafc;
            color: #172b4d;
            font-size: 14px;
            outline: none;
        }

        .cp-field input:focus,
        .cp-field select:focus {
            border-color: #2563eb;
            background: white;
        }

        .cp-field small {
            display: block;
            font-size: 11px;
            color: #64748b;
            margin-top: 7px;
        }

        .cp-total {
            background: #edf4ff;
            border: 1px solid #dbeafe;
            padding: 22px;
            border-radius: 13px;
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .cp-total h3 {
            margin: 0 0 8px;
            font-size: 17px;
        }

        .cp-total small {
            color: #64748b;
        }

        .cp-total strong {
            color: #2563eb;
            font-size: 38px;
        }

        .cp-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .cp-btn {
            padding: 12px 18px;
            background: #253858;
            color: white !important;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .cp-btn:hover {
            filter: brightness(.94);
        }

        .cp-btn-light {
            background: #edf2f7;
            color: #253858 !important;
        }

        .cp-btn-delete {
            background: #fee2e2;
            color: #b91c1c !important;
        }

        .cp-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
        }

        .cp-page table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        .cp-page th {
            padding: 15px;
            background: #253858;
            color: white;
            text-align: left;
            font-size: 12px;
        }

        .cp-page td {
            padding: 16px 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .cp-row-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .cp-row-actions form {
            margin: 0;
        }

        .cp-message {
            padding: 17px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            line-height: 1.7;
        }

        .cp-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .cp-error {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
        }

        .cp-note {
            background: #fff7ed;
            color: #9a3412;
            border: 1px solid #fed7aa;
        }

        @media (max-width: 600px) {
            .cp-grid {
                grid-template-columns: 1fr;
            }

            .cp-card,
            .cp-hero {
                padding: 20px;
            }

            .cp-hero h1 {
                font-size: 23px;
            }
        }
    </style>

    @php
        $perfunduar = $ndeshja->statusi === 'Perfunduar';

        $statData = $statistikat->map(function ($s) {
            return [
                'kills' => $s->kills,
                'aces' => $s->aces,
                'blocks' => $s->blocks,
                'digs' => $s->digs
            ];
        });
    @endphp

    <div class="cp-page">

        <div class="cp-hero">

            <small>KV GJINOCI | PLAYER PERFORMANCE</small>

            <h1>
                Statistikat e Volejbollisteve
            </h1>

            <p>
                {{ $ndeshja->ekipi?->emri ?? '-' }}
                vs
                {{ $ndeshja->kundershtari }}
            </p>

            <p>

                {{ \Carbon\Carbon::parse(
                    $ndeshja->data_ndeshjes
                )->format('d.m.Y H:i') }}

                |

                Rezultati:
                {{ $ndeshja->setet_tona ?? '-' }}
                -
                {{ $ndeshja->setet_kundershtarit ?? '-' }}

            </p>

        </div>

        @if(session('success'))

            <div class="cp-message cp-success">

                ✓ {{ session('success') }}

            </div>

        @endif

        @if($errors->any())

            <div class="cp-message cp-error">

                <strong>Kontrollo te dhenat:</strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="cp-card">

            <h2>Regjistro ose Edito Statistikat</h2>

            <p class="cp-subtitle">
                Zgjedh volejbollisten dhe ploteso
                performancen e saj ne kete ndeshje.
            </p>

            @if(!$perfunduar)

                <div class="cp-message cp-note">

                    Ndeshja ende nuk eshte perfunduar.
                    Statistikat mund te regjistrohen vetem pas ndeshjes.

                </div>

            @elseif($lojtaret->isEmpty())

                <div class="cp-message cp-note">

                    Nuk ka volejbolliste te regjistruara ne kete ekip.

                </div>

            @else

                <form method="POST"
                      id="statForm"
                      action="{{ route('coach.statistikat.store', $ndeshja) }}">

                    @csrf

                    <div class="cp-grid">

                        <div class="cp-field cp-full">

                            <label for="lojtar_id">

                                Volejbollistja

                            </label>

                            <select name="lojtar_id"
                                    id="lojtar_id"
                                    required>

                                <option value="">

                                    Zgjedh volejbollisten

                                </option>

                                @foreach($lojtaret as $lojtar)

                                    <option value="{{ $lojtar->id }}"
                                        @selected(old('lojtar_id') == $lojtar->id)>

                                        {{ $lojtar->emri }}
                                        {{ $lojtar->mbiemri }}

                                        @if($statistikat->has($lojtar->id))

                                            (Statistika ekzistuese)

                                        @endif

                                    </option>

                                @endforeach

                            </select>

                            <small id="playerInfo">

                                Zgjedh nje volejbolliste per te vazhduar.

                            </small>

                        </div>

                        <div class="cp-field">

                            <label for="kills">

                                Kills

                            </label>

                            <input type="number"
                                   name="kills"
                                   id="kills"
                                   min="0"
                                   max="999"
                                   value="{{ old('kills', 0) }}"
                                   required>

                            <small>Sulme me pike</small>

                        </div>

                        <div class="cp-field">

                            <label for="aces">

                                Aces

                            </label>

                            <input type="number"
                                   name="aces"
                                   id="aces"
                                   min="0"
                                   max="999"
                                   value="{{ old('aces', 0) }}"
                                   required>

                            <small>Servime direkte me pike</small>

                        </div>

                        <div class="cp-field">

                            <label for="blocks">

                                Blocks

                            </label>

                            <input type="number"
                                   name="blocks"
                                   id="blocks"
                                   min="0"
                                   max="999"
                                   value="{{ old('blocks', 0) }}"
                                   required>

                            <small>Blloqe me pike</small>

                        </div>

                        <div class="cp-field">

                            <label for="digs">

                                Digs

                            </label>

                            <input type="number"
                                   name="digs"
                                   id="digs"
                                   min="0"
                                   max="999"
                                   value="{{ old('digs', 0) }}"
                                   required>

                            <small>Mbrojtje te suksesshme</small>

                        </div>

                    </div>

                    <div class="cp-total">

                        <div>

                            <h3>Piket Individuale</h3>

                            <small>
                                Kills + Aces + Blocks
                            </small>

                        </div>

                        <strong id="totalPoints">0</strong>

                    </div>

                    <div class="cp-actions">

                        <a href="{{ route('coach.ndeshjet') }}"
                           class="cp-btn cp-btn-light">

                            Anulo

                        </a>

                        <button type="submit"
                                class="cp-btn"
                                id="saveButton">

                            ✓ Ruaj Statistikat

                        </button>

                    </div>

                </form>

            @endif

        </div>

        <div class="cp-card">

            <h2>Statistikat e Regjistruara</h2>

            <p class="cp-subtitle">

                Performanca individuale e volejbollisteve
                ne kete ndeshje.

            </p>

            <div class="cp-table-wrap">

                <table>

                    <thead>

                    <tr>
                        <th>Volejbollistja</th>
                        <th>Kills</th>
                        <th>Aces</th>
                        <th>Blocks</th>
                        <th>Digs</th>
                        <th>Pike</th>
                        <th>Veprimet</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($statistikat as $statistika)

                        @php
                            $lojtar = $lojtaret->firstWhere(
                                'id',
                                $statistika->lojtar_id
                            );
                        @endphp

                        @continue(!$lojtar)

                        <tr>

                            <td>

                                <strong>
                                    {{ $lojtar->emri }}
                                    {{ $lojtar->mbiemri }}
                                </strong>

                            </td>

                            <td>{{ $statistika->kills }}</td>

                            <td>{{ $statistika->aces }}</td>

                            <td>{{ $statistika->blocks }}</td>

                            <td>{{ $statistika->digs }}</td>

                            <td>

                                <strong>

                                    {{ $statistika->kills +
                                       $statistika->aces +
                                       $statistika->blocks }}

                                </strong>

                            </td>

                            <td>

                                @if($perfunduar)

                                    <div class="cp-row-actions">

                                        <button type="button"
                                                class="cp-btn cp-btn-light"
                                                onclick="editoStatistikat({{ $lojtar->id }})">

                                            Edito

                                        </button>

                                        <form method="POST"
                                              action="{{ route('coach.statistikat.destroy', [$ndeshja, $statistika]) }}"
                                              onsubmit="return confirm('A je i sigurt qe deshiron ti fshish statistikat?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="cp-btn cp-btn-delete">

                                                Fshi

                                            </button>

                                        </form>

                                    </div>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                style="text-align:center; color:#64748b; padding:25px;">

                                Nuk ka statistika te regjistruara.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <a href="{{ route('coach.ndeshjet') }}"
           class="cp-btn cp-btn-light">

            ← Kthehu te Ndeshjet

        </a>

    </div>

    <script>
        const statData = @json($statData);

        const fields = ['kills', 'aces', 'blocks', 'digs'];

        const playerSelect = document.getElementById('lojtar_id');

        function llogaritPiket() {

            if (!playerSelect) return;

            let total = 0;

            ['kills', 'aces', 'blocks'].forEach(field => {

                total += Number(
                    document.getElementById(field).value
                ) || 0;

            });

            document.getElementById('totalPoints')
                .textContent = total;
        }

        function ngarkoStatistikat() {

            if (!playerSelect) return;

            const playerId = playerSelect.value;

            const data = statData[playerId];

            fields.forEach(field => {

                document.getElementById(field).value =
                    data ? data[field] : 0;

            });

            document.getElementById('playerInfo')
                .textContent = data
                ? 'Po editon statistikat ekzistuese.'
                : 'Po regjistron statistika te reja.';

            document.getElementById('saveButton')
                .textContent = data
                ? '✓ Ruaj Ndryshimet'
                : '✓ Ruaj Statistikat';

            llogaritPiket();
        }

        function editoStatistikat(id) {

            if (!playerSelect) return;

            playerSelect.value = id;

            ngarkoStatistikat();

            document.getElementById('statForm')
                .scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

        }

        if (playerSelect) {

            playerSelect.addEventListener(
                'change',
                ngarkoStatistikat
            );

            fields.forEach(field => {

                document.getElementById(field)
                    .addEventListener('input', llogaritPiket);

            });

            llogaritPiket();

        }
    </script>

@endsection
