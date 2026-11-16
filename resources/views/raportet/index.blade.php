@extends('layouts.club')

@section('title', 'Raportet - KV Gjinoci')

@section('content')

    <style>
        .rp-page {
            max-width: 1200px;
            margin: 20px auto 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .rp-page * {
            box-sizing: border-box;
        }

        .rp-hero {
            background: linear-gradient(
                120deg,
                #172b4d,
                #315b89
            );
            color: white;
            padding: 32px;
            border-radius: 20px;
            margin-bottom: 25px;
        }

        .rp-hero small {
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .rp-hero h1 {
            color: white !important;
            margin: 14px 0;
            font-size: 32px;
        }

        .rp-hero p {
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        .rp-grid {
            display: grid;
            grid-template-columns: repeat(
            2,
            minmax(0, 1fr)
        );
            gap: 22px;
        }

        .rp-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            padding: 27px;
            box-shadow: 0 4px 15px
            rgba(15,23,42,.04);
        }

        .rp-card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .rp-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            border-radius: 13px;
            font-size: 25px;
            flex-shrink: 0;
        }

        .rp-card h2 {
            font-size: 20px;
            margin: 0 0 6px;
        }

        .rp-card-header small {
            color: #64748b;
            font-size: 11px;
        }

        .rp-description {
            color: #64748b;
            font-size: 13px;
            line-height: 1.8;
            min-height: 50px;
            margin-bottom: 22px;
        }

        .rp-field {
            margin-bottom: 18px;
        }

        .rp-field label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #334155;
            margin-bottom: 9px;
        }

        .rp-field input,
        .rp-field select {
            width: 100%;
            min-height: 44px;
            padding: 12px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            color: #172b4d;
            font-size: 13px;
            background: #f8fafc;
            outline: none;
        }

        .rp-field input:focus,
        .rp-field select:focus {
            background: white;
            border-color: #2563eb;
        }

        .rp-dates {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .rp-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 9px;
            background: #253858;
            color: white;
            cursor: pointer;
            font-weight: bold;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
        }

        .rp-btn:hover {
            background: #315b89;
        }

        .rp-btn:disabled {
            opacity: .45;
            cursor: not-allowed;
        }

        .rp-info {
            background: #edf4ff;
            color: #315b89;
            border: 1px solid #dbeafe;
            padding: 16px;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .rp-error {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .rp-empty {
            background: #f8fafc;
            border-radius: 9px;
            padding: 15px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 16px;
        }

        .rp-footer {
            text-align: center;
            color: #64748b;
            font-size: 12px;
            margin-top: 25px;
        }

        @media(max-width: 800px) {

            .rp-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 500px) {

            .rp-card,
            .rp-hero {
                padding: 20px;
            }

            .rp-hero h1 {
                font-size: 26px;
            }

            .rp-dates {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>

    @php
        $ngaDefault = now()
            ->startOfMonth()
            ->format('Y-m-d');

        $deriDefault = now()->format('Y-m-d');

        $financeAllowed = in_array(
            $role,
            ['admin', 'manager'],
            true
        );
    @endphp

    <div class="rp-page">

        {{-- HERO --}}

        <div class="rp-hero">

            <small>
                KV GJINOCI | REPORTS CENTER
            </small>

            <h1>Raportet e Klubit</h1>

            <p>
                Gjenero dhe shkarko raporte sportive,
                financiare dhe te prezences ne format PDF.
            </p>

        </div>

        <div class="rp-info">

            <strong>Raporte automatike:</strong>

            Zgjedh periudhen dhe informacionet
            qe deshiron. Raporti gjenerohet direkt
            nga te dhenat e regjistruara ne sistem.

        </div>

        @if($errors->any())

            <div class="rp-error">

                <strong>Kontrollo te dhenat:</strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="rp-grid">

            {{-- RAPORTI FINANCIAR --}}

            @if($financeAllowed)

                <div class="rp-card">

                    <div class="rp-card-header">

                        <div class="rp-icon">💰</div>

                        <div>

                            <h2>Raporti Financiar</h2>

                            <small>
                                PDF | FINANCE
                            </small>

                        </div>

                    </div>

                    <p class="rp-description">

                        Te hyrat, shpenzimet,
                        pagat e paguara dhe bilanci
                        financiar i klubit.

                    </p>

                    <form method="GET"
                          action="{{ route(
                          'raportet.financiar'
                      ) }}">

                        <div class="rp-dates">

                            <div class="rp-field">

                                <label for="fin-nga">
                                    Nga data
                                </label>

                                <input type="date"
                                       id="fin-nga"
                                       name="nga"
                                       value="{{ $ngaDefault }}"
                                       required>

                            </div>

                            <div class="rp-field">

                                <label for="fin-deri">
                                    Deri me date
                                </label>

                                <input type="date"
                                       id="fin-deri"
                                       name="deri"
                                       value="{{ $deriDefault }}"
                                       required>

                            </div>

                        </div>

                        <button type="submit"
                                class="rp-btn">

                            ↓ Shkarko Raportin Financiar

                        </button>

                    </form>

                </div>

            @endif

            {{-- RAPORTI I EKIPIT --}}

            @if($role !== 'player')

                <div class="rp-card">

                    <div class="rp-card-header">

                        <div class="rp-icon">🏐</div>

                        <div>

                            <h2>Raporti i Ekipit</h2>

                            <small>
                                PDF | TEAM PERFORMANCE
                            </small>

                        </div>

                    </div>

                    <p class="rp-description">

                        Rezultatet, fitoret,
                        humbjet dhe statistikat
                        e lojtareve te ekipit.

                    </p>

                    @if($ekipet->isEmpty())

                        <div class="rp-empty">

                            Nuk ka ekipe te disponueshme.

                        </div>

                    @endif

                    <form method="GET"
                          id="teamReportForm">

                        <div class="rp-field">

                            <label for="reportTeam">

                                Zgjedh Ekipin

                            </label>

                            <select id="reportTeam"
                                    required>

                                <option value="">

                                    Zgjedh ekipin

                                </option>

                                @foreach($ekipet as $ekipi)

                                    <option value="{{ route(
                                    'raportet.ekipi',
                                    $ekipi
                                ) }}">

                                        {{ $ekipi->emri }}

                                        -

                                        {{ $ekipi->kategoria }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="rp-dates">

                            <div class="rp-field">

                                <label for="team-nga">

                                    Nga data

                                </label>

                                <input type="date"
                                       name="nga"
                                       id="team-nga"
                                       value="{{ $ngaDefault }}"
                                       required>

                            </div>

                            <div class="rp-field">

                                <label for="team-deri">

                                    Deri me date

                                </label>

                                <input type="date"
                                       name="deri"
                                       id="team-deri"
                                       value="{{ $deriDefault }}"
                                       required>

                            </div>

                        </div>

                        <button type="submit"
                                class="rp-btn"
                            @disabled($ekipet->isEmpty())>

                            ↓ Shkarko Raportin e Ekipit

                        </button>

                    </form>

                </div>

            @endif

            {{-- RAPORTI INDIVIDUAL --}}

            <div class="rp-card">

                <div class="rp-card-header">

                    <div class="rp-icon">📊</div>

                    <div>

                        <h2>

                            {{ $role === 'player'
                                ? 'Performanca Ime'
                                : 'Raporti Individual' }}

                        </h2>

                        <small>

                            PDF | PLAYER PERFORMANCE

                        </small>

                    </div>

                </div>

                <p class="rp-description">

                    Statistikat individuale,
                    piket, kills, aces, blocks
                    dhe performanca ne secilen ndeshje.

                </p>

                @if($lojtaret->isEmpty())

                    <div class="rp-empty">

                        Nuk ka profil te disponueshem
                        te volejbollistes.

                    </div>

                @endif

                <form method="GET"
                      id="playerReportForm">

                    <div class="rp-field">

                        <label for="reportPlayer">

                            Zgjedh Volejbollisten

                        </label>

                        <select id="reportPlayer"
                                required>

                            <option value="">

                                Zgjedh volejbollisten

                            </option>

                            @foreach($lojtaret as $lojtar)

                                <option value="{{ route(
                                'raportet.lojtar',
                                $lojtar
                            ) }}"
                                    @selected(
                                        $role === 'player'
                                    )>

                                    {{ $lojtar->emri }}

                                    {{ $lojtar->mbiemri }}

                                    -

                                    {{ $lojtar->pozicioni }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="rp-dates">

                        <div class="rp-field">

                            <label for="player-nga">

                                Nga data

                            </label>

                            <input type="date"
                                   id="player-nga"
                                   name="nga"
                                   value="{{ $ngaDefault }}"
                                   required>

                        </div>

                        <div class="rp-field">

                            <label for="player-deri">

                                Deri me date

                            </label>

                            <input type="date"
                                   id="player-deri"
                                   name="deri"
                                   value="{{ $deriDefault }}"
                                   required>

                        </div>

                    </div>

                    <button type="submit"
                            class="rp-btn"
                        @disabled($lojtaret->isEmpty())>

                        ↓ Shkarko Raportin Individual

                    </button>

                </form>

            </div>

            {{-- RAPORTI I PREZENCES --}}

            <div class="rp-card">

                <div class="rp-card-header">

                    <div class="rp-icon">📋</div>

                    <div>

                        <h2>Raporti i Prezences</h2>

                        <small>

                            PDF | TRAINING ATTENDANCE

                        </small>

                    </div>

                </div>

                <p class="rp-description">

                    Prezencat, mungesat,
                    vonesat dhe perqindja
                    e pjesemarrjes ne stervitje.

                </p>

                <form method="GET"
                      action="{{ route(
                      'raportet.prezenca'
                  ) }}">

                    @if($role !== 'player')

                        <div class="rp-field">

                            <label for="attendanceTeam">

                                Zgjedh Ekipin

                            </label>

                            <select name="ekipi_id"
                                    id="attendanceTeam">

                                <option value="">

                                    Te gjitha ekipet e lejuara

                                </option>

                                @foreach($ekipet as $ekipi)

                                    <option value="{{ $ekipi->id }}">

                                        {{ $ekipi->emri }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    @endif

                    <div class="rp-dates">

                        <div class="rp-field">

                            <label for="att-nga">

                                Nga data

                            </label>

                            <input type="date"
                                   name="nga"
                                   id="att-nga"
                                   value="{{ $ngaDefault }}"
                                   required>

                        </div>

                        <div class="rp-field">

                            <label for="att-deri">

                                Deri me date

                            </label>

                            <input type="date"
                                   name="deri"
                                   id="att-deri"
                                   value="{{ $deriDefault }}"
                                   required>

                        </div>

                    </div>

                    <button type="submit"
                            class="rp-btn"
                        @disabled($lojtaret->isEmpty())>

                        ↓ Shkarko Raportin e Prezences

                    </button>

                </form>

            </div>

        </div>

        <div class="rp-footer">

            KV Gjinoci | Reports Center

        </div>

    </div>

    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {

                function lidhFormularin(
                    formId,
                    selectId
                ) {

                    const form = document
                        .getElementById(formId);

                    const select = document
                        .getElementById(selectId);

                    if (!form || !select) {
                        return;
                    }

                    form.addEventListener(
                        'submit',
                        function (event) {

                            if (!select.value) {

                                event.preventDefault();

                                alert(
                                    'Zgjedh profilin para shkarkimit.'
                                );

                                return;
                            }

                            form.action = select.value;

                        }
                    );
                }

                lidhFormularin(
                    'teamReportForm',
                    'reportTeam'
                );

                lidhFormularin(
                    'playerReportForm',
                    'reportPlayer'
                );

            }
        );
    </script>

@endsection
