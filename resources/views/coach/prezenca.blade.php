@extends('layouts.club')

@section('title', 'Menaxho Prezencen - KV Gjinoci')

@section('content')

    <style>
        .pa-page {
            max-width: 1150px;
            margin: 0 auto;
            padding: 15px 0 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .pa-page * {
            box-sizing: border-box;
        }

        .pa-hero {
            background: linear-gradient(120deg, #172b4d, #315b89);
            border-radius: 18px;
            padding: 32px;
            color: white;
            margin-bottom: 25px;
        }

        .pa-hero small {
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .pa-hero h1 {
            color: white;
            font-size: 30px;
            margin: 14px 0;
        }

        .pa-hero p {
            color: #dbeafe;
            margin: 7px 0;
            font-size: 14px;
        }

        .pa-details {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
        }

        .pa-details span {
            padding: 8px 12px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 8px;
            font-size: 12px;
            color: white;
        }

        .pa-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 17px;
            margin-bottom: 25px;
        }

        .pa-stat {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .pa-stat small {
            font-size: 13px;
            color: #64748b;
        }

        .pa-stat h2 {
            font-size: 31px;
            margin: 13px 0 0;
        }

        .pa-green {
            color: #15803d;
        }

        .pa-red {
            color: #dc2626;
        }

        .pa-orange {
            color: #d97706;
        }

        .pa-blue {
            color: #2563eb;
        }

        .pa-card {
            padding: 26px;
            border-radius: 16px;
            background: white;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
            margin-bottom: 25px;
        }

        .pa-card h2 {
            font-size: 22px;
            margin: 0 0 10px;
        }

        .pa-subtitle {
            font-size: 13px;
            color: #64748b;
            margin: 0 0 24px;
        }

        .pa-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .pa-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
        }

        .pa-page table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
        }

        .pa-page th {
            background: #253858;
            color: white;
            padding: 15px;
            font-size: 12px;
            text-align: left;
        }

        .pa-page td {
            padding: 17px 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
            vertical-align: middle;
        }

        .pa-page tbody tr:hover {
            background: #f8fafc;
        }

        .pa-player {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .pa-avatar {
            width: 42px;
            height: 42px;
            background: #e8efff;
            color: #253858;
            font-weight: bold;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
        }

        .pa-player strong {
            font-size: 13px;
        }

        .pa-position {
            color: #64748b;
            font-size: 12px;
        }

        .pa-page input,
        .pa-page select {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #dbe3ee;
            border-radius: 8px;
            background: #f8fafc;
            color: #172b4d;
            font-size: 13px;
            outline: none;
        }

        .pa-page select {
            min-width: 150px;
        }

        .pa-page input {
            min-width: 160px;
        }

        .pa-page input:focus,
        .pa-page select:focus {
            border-color: #2563eb;
        }

        .pa-present {
            background: #ecfdf5 !important;
            color: #15803d !important;
            border-color: #bbf7d0 !important;
        }

        .pa-absent {
            background: #fff1f2 !important;
            color: #dc2626 !important;
            border-color: #fecdd3 !important;
        }

        .pa-late {
            background: #fff7ed !important;
            color: #d97706 !important;
            border-color: #fed7aa !important;
        }

        .pa-excused {
            background: #eff6ff !important;
            color: #2563eb !important;
            border-color: #bfdbfe !important;
        }

        .pa-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            background: #253858;
            border-radius: 9px;
            border: none;
            color: white !important;
            text-decoration: none !important;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .pa-btn-light {
            background: #edf2f7;
            color: #253858 !important;
        }

        .pa-btn-green {
            background: #dcfce7;
            color: #15803d !important;
        }

        .pa-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            margin-top: 24px;
        }

        .pa-progress {
            background: #e2e8f0;
            height: 10px;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 12px;
        }

        .pa-progress-bar {
            height: 100%;
            background: #2563eb;
            border-radius: 20px;
            width: 0%;
            transition: width .3s;
        }

        .pa-progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            font-weight: bold;
        }

        .pa-message {
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 22px;
            line-height: 1.7;
            font-size: 13px;
        }

        .pa-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .pa-error {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
        }

        .pa-warning {
            background: #fff7ed;
            color: #9a3412;
            border: 1px solid #fed7aa;
        }

        @media(max-width: 800px) {
            .pa-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 500px) {
            .pa-grid {
                grid-template-columns: 1fr;
            }

            .pa-card, .pa-hero {
                padding: 20px;
            }

            .pa-hero h1 {
                font-size: 24px;
            }
        }
    </style>

    <div class="pa-page">

        <div class="pa-hero">

            <small>KV GJINOCI | ATTENDANCE MANAGEMENT</small>

            <h1>Prezenca ne Stervitje</h1>

            <p>
                {{ $stervitja->ekipi?->emri ?? '-' }}
                - {{ $stervitja->lloji }}
            </p>

            <div class="pa-details">

            <span>

                📅 {{ \Carbon\Carbon::parse(
                    $stervitja->data
                )->format('d.m.Y') }}

            </span>

                <span>

                🕒 {{ substr($stervitja->ora_fillimit, 0, 5) }}
                -
                {{ substr($stervitja->ora_mbarimit, 0, 5) }}

            </span>

                <span>

                📍 {{ $stervitja->palestra }}

            </span>

                <span>

                {{ $stervitja->statusi }}

            </span>

            </div>

        </div>

        @if(session('success'))

            <div class="pa-message pa-success">

                ✓ {{ session('success') }}

            </div>

        @endif

        @if($errors->any())

            <div class="pa-message pa-error">

                <strong>Kontrollo te dhenat:</strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        @if($stervitja->statusi !== 'Perfunduar')

            <div class="pa-message pa-warning">

                Stervitja duhet te jete e perfunduar
                para se te regjistrohet prezenca.

            </div>

            <a href="{{ route('coach.stervitjet.edit', $stervitja) }}"
               class="pa-btn">

                Edito Stervitjen

            </a>

        @else

            <div class="pa-grid">

                <div class="pa-stat">

                    <small>Prezente</small>

                    <h2 class="pa-green" id="presentCount">

                        0

                    </h2>

                </div>

                <div class="pa-stat">

                    <small>Mungesa</small>

                    <h2 class="pa-red" id="absentCount">

                        0

                    </h2>

                </div>

                <div class="pa-stat">

                    <small>Me vonese</small>

                    <h2 class="pa-orange" id="lateCount">

                        0

                    </h2>

                </div>

                <div class="pa-stat">

                    <small>Mungesa te arsyetuara</small>

                    <h2 class="pa-blue" id="excusedCount">

                        0

                    </h2>

                </div>

            </div>

            <div class="pa-card">

                <div class="pa-progress-header">

                    <span>Perqindja e Prezences</span>

                    <span class="pa-blue" id="attendancePercent">

                    0%

                </span>

                </div>

                <div class="pa-progress">

                    <div class="pa-progress-bar"
                         id="attendanceBar">
                    </div>

                </div>

            </div>

            <div class="pa-card">

                <div class="pa-header">

                    <div>

                        <h2>Lista e Volejbollisteve</h2>

                        <p class="pa-subtitle">

                            Regjistro statusin e seciles
                            volejbolliste ne kete stervitje.

                        </p>

                    </div>

                    @if($lojtaret->isNotEmpty())

                        <button type="button"
                                class="pa-btn pa-btn-green"
                                onclick="teGjithaPrezente()">

                            ✓ Sheno te gjitha prezente

                        </button>

                    @endif

                </div>

                @if($lojtaret->isEmpty())

                    <div class="pa-message pa-warning">

                        Nuk ka volejbolliste ne kete ekip.

                    </div>

                @else

                    <form method="POST"
                          action="{{ route(
                          'coach.prezenca.update',
                          $stervitja
                      ) }}">

                        @csrf
                        @method('PUT')

                        <div class="pa-table-wrap">

                            <table>

                                <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Volejbollistja</th>
                                    <th>Pozicioni</th>
                                    <th>Statusi</th>
                                    <th>Shenime</th>
                                </tr>

                                </thead>

                                <tbody>

                                @foreach($lojtaret as $lojtar)

                                    @php

                                        $prezenca = $prezencat->get(
                                            $lojtar->id
                                        );

                                        $statusiAktual = old(
                                            'prezencat.' . $lojtar->id . '.statusi',
                                            $prezenca?->statusi ?? ''
                                        );

                                    @endphp

                                    <tr>

                                        <td>

                                            {{ $loop->iteration }}

                                        </td>

                                        <td>

                                            <div class="pa-player">

                                                <div class="pa-avatar">

                                                    {{ mb_strtoupper(
                                                        mb_substr($lojtar->emri, 0, 1)
                                                        .
                                                        mb_substr($lojtar->mbiemri, 0, 1)
                                                    ) }}

                                                </div>

                                                <strong>

                                                    {{ $lojtar->emri }}
                                                    {{ $lojtar->mbiemri }}

                                                </strong>

                                            </div>

                                        </td>

                                        <td class="pa-position">

                                            {{ $lojtar->pozicioni ?? '-' }}

                                        </td>

                                        <td>

                                            <select name="prezencat[{{ $lojtar->id }}][statusi]"
                                                    class="attendance-status"
                                                    required>

                                                <option value="">

                                                    Zgjedh statusin

                                                </option>

                                                @foreach([
                                                    'Prezente',
                                                    'Mungon',
                                                    'Me vonese',
                                                    'E arsyetuar'
                                                ] as $statusi)

                                                    <option value="{{ $statusi }}"
                                                        @selected($statusiAktual === $statusi)>

                                                        {{ $statusi }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </td>

                                        <td>

                                            <input type="text"
                                                   name="prezencat[{{ $lojtar->id }}][shenime]"
                                                   placeholder="Shenime..."
                                                   maxlength="1000"
                                                   value="{{ old(
                                                       'prezencat.' . $lojtar->id . '.shenime',
                                                       $prezenca?->shenime ?? ''
                                                   ) }}">

                                        </td>

                                    </tr>

                                @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="pa-actions">

                            <a href="{{ route('coach.stervitjet') }}"
                               class="pa-btn pa-btn-light">

                                Anulo

                            </a>

                            <button type="submit"
                                    class="pa-btn">

                                ✓ Ruaj Prezencen

                            </button>

                        </div>

                    </form>

                @endif

            </div>

        @endif

        <a href="{{ route('coach.stervitjet') }}"
           class="pa-btn pa-btn-light">

            ← Kthehu te Stervitjet

        </a>

    </div>

    <script>
        const statusFields = document.querySelectorAll(
            '.attendance-status'
        );

        function perditesoPrezencen() {

            let present = 0;
            let absent = 0;
            let late = 0;
            let excused = 0;

            statusFields.forEach(select => {

                select.classList.remove(
                    'pa-present',
                    'pa-absent',
                    'pa-late',
                    'pa-excused'
                );

                switch (select.value) {

                    case 'Prezente':
                        present++;
                        select.classList.add('pa-present');
                        break;

                    case 'Mungon':
                        absent++;
                        select.classList.add('pa-absent');
                        break;

                    case 'Me vonese':
                        late++;
                        select.classList.add('pa-late');
                        break;

                    case 'E arsyetuar':
                        excused++;
                        select.classList.add('pa-excused');
                        break;
                }

            });

            const total = statusFields.length;

            const percentage = total > 0
                ? Math.round(((present + late) / total) * 100)
                : 0;

            const presentCount = document.getElementById('presentCount');

            if (!presentCount) return;

            presentCount.textContent = present;

            document.getElementById('absentCount')
                .textContent = absent;

            document.getElementById('lateCount')
                .textContent = late;

            document.getElementById('excusedCount')
                .textContent = excused;

            document.getElementById('attendancePercent')
                .textContent = percentage + '%';

            document.getElementById('attendanceBar')
                .style.width = percentage + '%';
        }

        function teGjithaPrezente() {

            statusFields.forEach(select => {

                select.value = 'Prezente';

            });

            perditesoPrezencen();
        }

        statusFields.forEach(select => {

            select.addEventListener(
                'change',
                perditesoPrezencen
            );

        });

        perditesoPrezencen();
    </script>

@endsection
