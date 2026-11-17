@extends('layouts.club')

@section('title', 'Ndeshja - Match Center')

@section('content')

    <style>
        .match-page {
            max-width: 1150px;
            margin: 0 auto;
            color: #172b4d;
        }

        .match-page * {
            box-sizing: border-box;
        }

        .match-hero {
            padding: 26px;
            border-radius: 18px;
            background: linear-gradient(120deg, #101e38, #315b89);
            color: white;
            margin-bottom: 20px;
        }

        .match-hero small {
            color: #bfdbfe;
            font-size: 11px;
        }

        .match-hero h1 {
            color: white;
            font-size: 27px;
            margin: 10px 0;
        }

        .match-hero p {
            color: #dbeafe;
            margin: 0;
            font-size: 13px;
        }

        .match-card {
            padding: 24px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .match-card h2 {
            color: #172b4d;
            margin: 0 0 10px;
            font-size: 19px;
        }

        .match-muted {
            color: #64748b;
            font-size: 12px;
            line-height: 1.7;
        }

        .match-back {
            display: inline-block;
            margin-bottom: 15px;
            color: #315b89;
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
        }

        .match-alert {
            padding: 14px;
            border-radius: 9px;
            margin-bottom: 15px;
            background: #dcfce7;
            color: #166534;
            font-size: 13px;
        }

        .match-alert.error {
            background: #fff1f2;
            color: #be123c;
        }

        .match-scoreboard {
            background: #152640;
            border-radius: 15px;
            padding: 26px;
            color: white;
            margin: 20px 0;
        }

        .match-score-teams {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 12px;
            text-align: center;
        }

        .match-team {
            font-size: 16px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .match-sets-score {
            font-size: 34px;
            font-weight: 800;
            white-space: nowrap;
        }

        .match-current {
            border-top: 1px solid #40536e;
            margin-top: 20px;
            padding-top: 20px;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            text-align: center;
            align-items: center;
            gap: 10px;
        }

        .match-points {
            font-size: 56px;
            font-weight: 800;
            font-variant-numeric: tabular-nums;
        }

        .match-set-label {
            color: #bfdbfe;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .match-live-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 20px;
        }

        .match-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 47px;
            padding: 12px 17px;
            background: #253858;
            border: 0;
            border-radius: 9px;
            color: white;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        .match-button.home {
            background: #16734e;
        }

        .match-button.away {
            background: #ac443d;
        }

        .match-button.secondary {
            background: #e8efff;
            color: #253858;
        }

        .match-button:disabled {
            opacity: .45;
            cursor: not-allowed;
        }

        .match-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .match-table th {
            background: #f1f5f9;
            color: #475569;
            text-align: left;
            padding: 12px;
            font-size: 12px;
        }

        .match-table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .match-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            max-width: 420px;
        }

        .match-input {
            width: 100%;
            min-width: 0;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 11px;
            background: #f8fafc;
            color: #172b4d;
        }

        .match-formrow {
            display: grid;
            grid-template-columns: 110px 1fr;
            align-items: center;
            gap: 12px;
            margin: 12px 0;
        }

        .match-formrow label {
            font-size: 13px;
            font-weight: bold;
        }

        .match-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .match-lock {
            border: 1px solid #bfdbfe;
            background: #eff6ff;
            color: #1e40af;
            padding: 14px;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.7;
        }

        .match-live-indicator {
            display: inline-block;
            color: #b91c1c;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-top: 5px;
        }

        .match-live-indicator.finished {
            color: #166534;
        }

        .match-feedback {
            padding: 12px 15px;
            background: #f1f5f9;
            border-radius: 9px;
            margin-top: 15px;
            color: #475569;
            font-size: 12px;
            line-height: 1.6;
        }

        .match-feedback.error {
            background: #fff1f2;
            color: #be123c;
        }

        @media (max-width: 780px) {
            .match-options {
                grid-template-columns: 1fr;
            }

            .match-hero,
            .match-card {
                padding: 19px;
            }

            .match-points {
                font-size: 42px;
            }

            .match-team {
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .match-formrow {
                grid-template-columns: 1fr;
                gap: 7px;
            }

            .match-scoreboard {
                padding: 17px;
            }

            .match-sets-score {
                font-size: 27px;
            }

            .match-points {
                font-size: 36px;
            }
        }
    </style>

    <div class="match-page">

        <a
            class="match-back"
            href="{{ route('match-center.index') }}"
        >
            ← Kthehu te ndeshjet
        </a>

        <div class="match-hero">

            <small>KV GJINOCI · MATCH CENTER</small>

            <h1>
                {{ $ndeshja->ekipi?->emri ?? 'Ekipi' }}
                vs
                {{ $ndeshja->kundershtari }}
            </h1>

            <p>
                {{ $ndeshja->data_ndeshjes
                    ? \Carbon\Carbon::parse(
                        $ndeshja->data_ndeshjes
                    )->format('d.m.Y')
                    : 'Pa date' }}

                ·

                {{ $ndeshja->palestra
                    ?: 'Pa palester te caktuar' }}
            </p>

        </div>

        @if(session('success'))
            <div class="match-alert">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="match-alert error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- NDESHJE PA MATCH CENTER --}}

        @if(!$match)

            <div class="match-options">

                <section class="match-card">

                    <h2>1. Rezultati Manual</h2>

                    <p class="match-muted">
                        Nese ndeshja ka perfundu,
                        shkruaji rezultatet e seteve
                        dhe ruaje direkt.
                    </p>

                    <form
                        method="POST"
                        action="{{ route(
                        'match-center.manual',
                        $ndeshja
                    ) }}"
                    >
                        @csrf

                        <div class="match-formrow">

                            <strong style="font-size:12px">
                                Seti
                            </strong>

                            <div class="match-inputs">
                                <strong style="font-size:11px">
                                    Gjinoci
                                </strong>

                                <strong style="font-size:11px">
                                    Kundershtari
                                </strong>
                            </div>

                        </div>

                        @foreach(range(1, 5) as $nr)

                            <div class="match-formrow">

                                <label>
                                    Seti {{ $nr }}
                                </label>

                                <div class="match-inputs">

                                    <input
                                        class="match-input"
                                        type="number"
                                        min="0"
                                        max="999"
                                        name="sets[{{ $nr }}][home]"
                                        placeholder="–"
                                        value="{{ old(
                                        'sets.'.$nr.'.home'
                                    ) }}"
                                    >

                                    <input
                                        class="match-input"
                                        type="number"
                                        min="0"
                                        max="999"
                                        name="sets[{{ $nr }}][away]"
                                        placeholder="–"
                                        value="{{ old(
                                        'sets.'.$nr.'.away'
                                    ) }}"
                                    >

                                </div>
                            </div>

                        @endforeach

                        <button
                            class="match-button"
                            type="submit"
                        >
                            Ruaj Ndeshjen si te Perfunduar
                        </button>

                    </form>

                </section>

                <section class="match-card">

                    <h2>2. Aktivizo LIVE</h2>

                    <p class="match-muted">
                        Nese nje person eshte ne palester,
                        aktivizo regjistrimin LIVE te pikeve.
                    </p>

                    <div class="match-lock">
                        LIVE eshte opsional.
                        Nese nuk e aktivizon,
                        mundesh me regjistru rezultatin
                        manualisht pas ndeshjes.
                    </div>

                    <form
                        action="{{ route(
                        'match-center.start',
                        $ndeshja
                    ) }}"
                        method="POST"
                        style="margin-top:18px"
                        onsubmit="return confirm('A deshiron me e aktivizu LIVE per kete ndeshje?')"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="match-button"
                        >
                            ● Fillo Ndeshjen LIVE
                        </button>
                    </form>

                </section>

            </div>

        @endif

        {{-- NDESHJE ME MATCH CENTER --}}

        @if($match)

            <section class="match-card">

                <h2 id="matchStatusTitle">
                    {{ $match->status === 'finished'
                        ? 'Rezultati i Ndeshjes'
                        : 'Scoreboard LIVE' }}
                </h2>

                @if($match->mode === 'live')

                    <span
                        class="match-live-indicator
                    {{ $match->status === 'finished'
                        ? 'finished'
                        : '' }}"
                        id="matchLiveIndicator"
                    >
                    {{ $match->status === 'finished'
                        ? '✓ NDESHJA E PERFUNDUAR'
                        : '● LIVE – Ndeshja ne zhvillim' }}
                </span>

                @endif

                <div class="match-scoreboard">

                    <div class="match-score-teams">

                        <div class="match-team">
                            {{ $ndeshja->ekipi?->emri
                                ?? 'KV Gjinoci' }}
                        </div>

                        <div class="match-sets-score">
                        <span id="setsHome">
                            {{ $summary['home'] }}
                        </span>

                            :

                            <span id="setsAway">
                            {{ $summary['away'] }}
                        </span>
                        </div>

                        <div class="match-team">
                            {{ $ndeshja->kundershtari }}
                        </div>

                    </div>

                    <div class="match-current">

                        <div
                            class="match-points"
                            id="pointsHome"
                        >
                            {{ $sets->last()->home_points ?? 0 }}
                        </div>

                        <div
                            class="match-set-label"
                            id="currentSetLabel"
                        >
                            {{ $match->status === 'live'
                                ? 'SETI '.(
                                    $sets->last()->set_number ?? 1
                                )
                                : 'PERFUNDUAR' }}
                        </div>

                        <div
                            class="match-points"
                            id="pointsAway"
                        >
                            {{ $sets->last()->away_points ?? 0 }}
                        </div>

                    </div>

                    {{--
                        E RENDESISHME:

                        Butonat krijohen GJITHMONE
                        per nje ndeshje te tipit LIVE.

                        Edhe kur ndeshja eshte e
                        perfunduar, ata mbesin ne HTML
                        por jane te fshehur.

                        Pas Undo rikthehen pa reload.
                    --}}

                    @if($match->mode === 'live')

                        <div
                            class="match-live-actions"
                            id="liveActions"
                            @if($match->status === 'finished')
                                style="display:none"
                            @endif
                        >

                            <button
                                class="match-button home"
                                type="button"
                                data-point-team="home"
                            >
                                + Pike Gjinoci
                            </button>

                            <button
                                class="match-button away"
                                type="button"
                                data-point-team="away"
                            >
                                + Pike Kundershtari
                            </button>

                        </div>

                    @endif

                </div>

                @if($match->mode === 'live')

                    <button
                        class="match-button secondary"
                        type="button"
                        id="undoPoint"
                    >
                        ↶ Undo – Kthe piken e fundit
                    </button>

                    <div
                        class="match-feedback"
                        id="liveFeedback"
                        aria-live="polite"
                    >
                        Rezultati perditesohet automatikisht.
                    </div>

                @endif

                <h2 style="margin-top:25px">
                    Rezultatet e Seteve
                </h2>

                <table class="match-table">

                    <thead>
                    <tr>
                        <th>Seti</th>
                        <th>Gjinoci</th>
                        <th>Kundershtari</th>
                        <th>Statusi</th>
                    </tr>
                    </thead>

                    <tbody id="matchSetsTable">

                    @foreach($sets as $set)

                        <tr>
                            <td>
                                {{ $set->set_number }}
                            </td>

                            <td>
                                {{ $set->home_points }}
                            </td>

                            <td>
                                {{ $set->away_points }}
                            </td>

                            <td>
                                {{ $set->is_completed
                                    ? 'Perfunduar'
                                    : 'Ne zhvillim' }}
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </section>

            {{-- KORRIGJIMI MANUAL --}}

            @if($match->mode === 'manual')

                <section class="match-card">

                    <h2>Ndrysho rezultatin manual</h2>

                    <p class="match-muted">
                        Korrigjo rezultatet nese
                        jane regjistruar gabim.
                    </p>

                    <form
                        method="POST"
                        action="{{ route(
                        'match-center.manual',
                        $ndeshja
                    ) }}"
                    >
                        @csrf

                        @foreach(range(1, 5) as $nr)

                            @php
                                $saved = $sets->firstWhere(
                                    'set_number',
                                    $nr
                                );
                            @endphp

                            <div class="match-formrow">

                                <label>
                                    Seti {{ $nr }}
                                </label>

                                <div class="match-inputs">

                                    <input
                                        type="number"
                                        class="match-input"
                                        min="0"
                                        max="999"
                                        name="sets[{{ $nr }}][home]"
                                        placeholder="Gjinoci"
                                        value="{{ old(
                                        'sets.'.$nr.'.home',
                                        $saved?->home_points
                                    ) }}"
                                    >

                                    <input
                                        type="number"
                                        class="match-input"
                                        min="0"
                                        max="999"
                                        name="sets[{{ $nr }}][away]"
                                        placeholder="Kundershtari"
                                        value="{{ old(
                                        'sets.'.$nr.'.away',
                                        $saved?->away_points
                                    ) }}"
                                    >

                                </div>
                            </div>

                        @endforeach

                        <button
                            type="submit"
                            class="match-button"
                        >
                            Ruaj Korrigjimin
                        </button>

                    </form>

                </section>

            @endif

        @endif

    </div>

    {{-- LIVE JAVASCRIPT --}}

    @if($match && $match->mode === 'live')

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const stateUrl = @json(
        route('match-center.state', $ndeshja)
    );

                const pointUrl = @json(
        route('match-center.point', $ndeshja)
    );

                const undoUrl = @json(
        route('match-center.undo', $ndeshja)
    );

                const csrf = @json(csrf_token());

                const feedback = document.getElementById(
                    'liveFeedback'
                );

                const liveActions = document.getElementById(
                    'liveActions'
                );

                const undoButton = document.getElementById(
                    'undoPoint'
                );

                const indicator = document.getElementById(
                    'matchLiveIndicator'
                );

                const statusTitle = document.getElementById(
                    'matchStatusTitle'
                );

                const pointButtons = Array.from(
                    document.querySelectorAll(
                        '[data-point-team]'
                    )
                );

                let busy = false;
                let refreshing = false;
                let finished = @json(
        $match->status === 'finished'
    );

                let currentRequestId = 0;

                // SHFAQ MESAZHIN

                function showFeedback(message, isError = false) {

                    if (!feedback) {
                        return;
                    }

                    feedback.textContent = message;

                    feedback.classList.toggle(
                        'error',
                        isError
                    );
                }

                // KONTROLLO BUTONAT

                function updateButtons() {

                    const canAddPoint = !finished && !busy;

                    pointButtons.forEach(function (button) {
                        button.disabled = !canAddPoint;
                    });

                    if (liveActions) {
                        liveActions.style.display = finished
                            ? 'none'
                            : 'grid';
                    }

                    if (undoButton) {
                        undoButton.disabled = busy;
                    }
                }

                // PERDITESO SCOREBOARD-IN

                function render(data) {

                    if (!data || !data.summary) {
                        return;
                    }

                    finished = data.status === 'finished';

                    document.getElementById(
                        'setsHome'
                    ).textContent = data.summary.home;

                    document.getElementById(
                        'setsAway'
                    ).textContent = data.summary.away;

                    const sets = Array.isArray(data.sets)
                        ? data.sets
                        : [];

                    const current = sets.length
                        ? sets[sets.length - 1]
                        : null;

                    document.getElementById(
                        'pointsHome'
                    ).textContent = current
                        ? current.home
                        : 0;

                    document.getElementById(
                        'pointsAway'
                    ).textContent = current
                        ? current.away
                        : 0;

                    document.getElementById(
                        'currentSetLabel'
                    ).textContent = finished
                        ? 'PERFUNDUAR'
                        : (
                            current
                                ? 'SETI ' + current.number
                                : 'PA SET'
                        );

                    if (statusTitle) {
                        statusTitle.textContent = finished
                            ? 'Rezultati i Ndeshjes'
                            : 'Scoreboard LIVE';
                    }

                    if (indicator) {

                        indicator.textContent = finished
                            ? '✓ NDESHJA E PERFUNDUAR'
                            : '● LIVE – Ndeshja ne zhvillim';

                        indicator.classList.toggle(
                            'finished',
                            finished
                        );
                    }

                    // RIKRIJO TABELEN E SETEVE

                    const tbody = document.getElementById(
                        'matchSetsTable'
                    );

                    tbody.replaceChildren();

                    sets.forEach(function (set) {

                        const tr = document.createElement('tr');

                        const values = [
                            set.number,
                            set.home,
                            set.away,
                            set.completed
                                ? 'Perfunduar'
                                : 'Ne zhvillim'
                        ];

                        values.forEach(function (value) {

                            const td = document.createElement('td');

                            td.textContent = String(value);

                            tr.appendChild(td);
                        });

                        tbody.appendChild(tr);
                    });

                    // KETU RIKTHEHEN BUTONAT PAS UNDO

                    updateButtons();
                }

                // MERR GJENDJEN NGA SERVERI

                async function refresh(force = false) {

                    if (refreshing || (busy && !force)) {
                        return;
                    }

                    if (document.hidden && !force) {
                        return;
                    }

                    refreshing = true;

                    const requestId = ++currentRequestId;

                    try {

                        const response = await fetch(stateUrl, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json'
                            },
                            cache: 'no-store',
                            credentials: 'same-origin'
                        });

                        if (!response.ok) {
                            throw new Error(
                                'Nuk u mor gjendja nga serveri.'
                            );
                        }

                        const data = await response.json();

                        if (requestId === currentRequestId) {
                            render(data);
                        }

                        return true;

                    } catch (error) {

                        showFeedback(
                            'Nuk u perditesua rezultati. ' +
                            'Kontrollo lidhjen me serverin.',
                            true
                        );

                        return false;

                    } finally {

                        refreshing = false;
                    }
                }

                // DERGO PIKE OSE UNDO

                async function sendAction(url, payload) {

                    if (busy) {
                        return;
                    }

                    busy = true;

                    updateButtons();

                    showFeedback('Duke e ruajtur ndryshimin...');

                    try {

                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrf
                            },
                            credentials: 'same-origin',
                            body: JSON.stringify(payload)
                        });

                        if (!response.ok) {

                            let message = 'Veprimi nuk u pranua.';

                            try {
                                const errorData = await response.json();

                                message = errorData.message
                                    || message;
                            } catch (ignored) {
                            }

                            throw new Error(message);
                        }

                        // VEPRIMI U RUAJT NE DATABASE

                        showFeedback(
                            'Ndryshimi u ruajt me sukses.'
                        );

                    } catch (error) {

                        showFeedback(
                            error.message,
                            true
                        );

                    } finally {

                        busy = false;

                        // PERDITESO EDHE KUR BEHET UNDO
                        // NGA NDESHJE E PERFUNDUAR

                        const refreshed = await refresh(true);

                        if (!refreshed) {
                            showFeedback(
                                'Kontrollo rezultatin para se ' +
                                'me regjistru nje pike tjeter.',
                                true
                            );
                        }

                        updateButtons();
                    }
                }

                // SHTIMI I PIKEVE

                pointButtons.forEach(function (button) {

                    button.addEventListener(
                        'click',
                        function () {

                            if (finished || busy) {
                                return;
                            }

                            sendAction(pointUrl, {
                                team: button.dataset.pointTeam
                            });
                        }
                    );
                });

                // UNDO

                if (undoButton) {

                    undoButton.addEventListener(
                        'click',
                        function () {

                            if (busy) {
                                return;
                            }

                            const confirmed = confirm(
                                'A deshiron me e kthy ' +
                                'piken e fundit?'
                            );

                            if (!confirmed) {
                                return;
                            }

                            sendAction(undoUrl, {});
                        }
                    );
                }

                // REFRESH AUTOMATIK CDO 2 SEKONDA

                setInterval(function () {

                    refresh();

                }, 2000);

                // REFRESH KUR KTHEHESH NE TAB

                document.addEventListener(
                    'visibilitychange',
                    function () {

                        if (!document.hidden) {
                            refresh();
                        }
                    }
                );

                // KONTROLLI FILLESTAR

                updateButtons();

                refresh(true);

            });
        </script>

    @endif

@endsection
