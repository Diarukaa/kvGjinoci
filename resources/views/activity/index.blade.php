@extends('layouts.club')

@section('title', 'Activity Log - KV Gjinoci')

@section('content')

    @include('activity.style')

    @php
        $roleLabels = [
            'admin' => 'Administrator',
            'manager' => 'Menaxher',
            'coach' => 'Trajner',
            'player' => 'Volejbolliste',
            'pending' => 'Ne pritje',
        ];

        $actionClasses = [
            'Krijuar' => 'al-created',
            'Perditesuar' => 'al-updated',
            'Fshire' => 'al-deleted',
        ];
    @endphp

    <div class="al-page">

        <div class="al-hero">

            <small>KV GJINOCI | SYSTEM AUDIT</small>

            <h1>Historiku i Aktiviteteve</h1>

            <p>
                Percjell veprimet e perdoruesve,
                ndryshimet ne databaze dhe aktivitetet
                e rendesishme te klubit.
            </p>

        </div>

        {{-- STATISTIKAT --}}

        <div class="al-stats">

            <div class="al-stat">

                <small>Gjithsej Aktivitete</small>

                <h2>{{ $totalLogs }}</h2>

            </div>

            <div class="al-stat">

                <small>Aktivitete Sot</small>

                <h2 style="color:#2563eb;">
                    {{ $sot }}
                </h2>

            </div>

            <div class="al-stat">

                <small>Krijime</small>

                <h2 style="color:#15803d;">
                    {{ $krijuar }}
                </h2>

            </div>

            <div class="al-stat">

                <small>Perditesime</small>

                <h2 style="color:#1d4ed8;">
                    {{ $perditesuar }}
                </h2>

            </div>

            <div class="al-stat">

                <small>Fshirje</small>

                <h2 style="color:#b91c1c;">
                    {{ $fshire }}
                </h2>

            </div>

        </div>

        @if($errors->any())

            <div class="al-error">

                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif

        {{-- FILTRAT --}}

        <div class="al-card">

            <h2>Filtro Aktivitetet</h2>

            <p class="al-subtitle">

                Kerko nje veprim specifik sipas
                perdoruesit, modulit ose periudhes.

            </p>

            <form method="GET"
                  action="{{ route('activity.index') }}">

                <div class="al-grid">

                    <div class="al-field">

                        <label for="search">
                            Kerko
                        </label>

                        <input type="text"
                               name="search"
                               id="search"
                               value="{{ $filters['search'] ?? '' }}"
                               placeholder="Emri, pershkrimi ose ID">

                    </div>

                    <div class="al-field">

                        <label for="user_id">
                            Perdoruesi
                        </label>

                        <select name="user_id" id="user_id">

                            <option value="">
                                Te gjithe perdoruesit
                            </option>

                            @foreach($perdoruesit as $perdoruesi)

                                <option value="{{ $perdoruesi->user_id }}"
                                    @selected(
                                        ($filters['user_id'] ?? '')
                                        == $perdoruesi->user_id
                                    )>

                                    {{ $perdoruesi->user_name }}
                                    (#{{ $perdoruesi->user_id }})

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="al-field">

                        <label for="moduli">
                            Moduli
                        </label>

                        <select name="moduli" id="moduli">

                            <option value="">
                                Te gjitha modulet
                            </option>

                            @foreach($modulet as $moduli)

                                <option value="{{ $moduli }}"
                                    @selected(
                                        ($filters['moduli'] ?? '')
                                        === $moduli
                                    )>

                                    {{ $moduli }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="al-field">

                        <label for="veprimi">
                            Veprimi
                        </label>

                        <select name="veprimi" id="veprimi">

                            <option value="">
                                Te gjitha veprimet
                            </option>

                            @foreach($veprimet as $veprimi)

                                <option value="{{ $veprimi }}"
                                    @selected(
                                        ($filters['veprimi'] ?? '')
                                        === $veprimi
                                    )>

                                    {{ $veprimi }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="al-field">

                        <label for="nga">
                            Nga data
                        </label>

                        <input type="date"
                               name="nga"
                               id="nga"
                               value="{{ $filters['nga'] ?? '' }}">

                    </div>

                    <div class="al-field">

                        <label for="deri">
                            Deri me date
                        </label>

                        <input type="date"
                               name="deri"
                               id="deri"
                               value="{{ $filters['deri'] ?? '' }}">

                    </div>

                </div>

                <div class="al-actions">

                    <a href="{{ route('activity.index') }}"
                       class="al-btn al-btn-light">

                        Pastro Filtrat

                    </a>

                    <button type="submit" class="al-btn">

                        Filtro Aktivitetet

                    </button>

                </div>

            </form>

        </div>

        {{-- HISTORIKU --}}

        <div class="al-card">

            <h2>Lista e Aktiviteteve</h2>

            <p class="al-subtitle">

                {{ $logs->total() }} regjistrime
                per filtrat e zgjedhur.

                Aktivitetet me te reja shfaqen ne fillim.

            </p>

            <div class="al-table-wrap">

                <table>

                    <thead>

                    <tr>
                        <th>Data dhe Ora</th>
                        <th>Perdoruesi</th>
                        <th>Roli</th>
                        <th>Moduli</th>
                        <th>Veprimi</th>
                        <th>Pershkrimi</th>
                        <th>Detajet</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($logs as $log)

                        <tr>

                            <td>

                                <strong>
                                    {{ $log->created_at->format('d.m.Y') }}
                                </strong>

                                <div class="al-muted">

                                    {{ $log->created_at->format('H:i:s') }}

                                </div>

                            </td>

                            <td>

                                <div class="al-user">

                                    <div class="al-avatar">

                                        {{ mb_strtoupper(
                                            mb_substr(
                                                $log->user_name ?? 'S',
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>

                                    <div>

                                        <strong>

                                            {{ $log->user_name ?? 'Sistemi' }}

                                        </strong>

                                        @if($log->user_id)

                                            <div class="al-muted">

                                                ID: {{ $log->user_id }}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </td>

                            <td>

                                {{ $roleLabels[$log->user_role]
                                    ?? $log->user_role
                                    ?? 'Sistemi' }}

                            </td>

                            <td>

                                <span class="al-badge">

                                    {{ $log->moduli }}

                                </span>

                            </td>

                            <td>

                                <span class="al-badge
                                    {{ $actionClasses[$log->veprimi] ?? '' }}">

                                    {{ $log->veprimi }}

                                </span>

                            </td>

                            <td>

                                {{ $log->pershkrimi }}

                            </td>

                            <td>

                                <a href="{{ route(
                                    'activity.show',
                                    $log
                                ) }}" class="al-btn al-btn-light">

                                    Shiko

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="al-empty">

                                Nuk ka aktivitete te regjistruara
                                per filtrat e zgjedhur.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div style="margin-top:22px;">

                {{ $logs->links() }}

            </div>

            <div class="al-notice">

                <strong>Audit Trail:</strong>

                Regjistrimet e historikut jane vetem
                per shikim dhe nuk mund te editohen
                ose fshihen nga ky panel.

            </div>

        </div>

        <div style="
        text-align:center;
        color:#64748b;
        font-size:12px;
    ">

            KV Gjinoci | Activity Log

        </div>

    </div>

@endsection
