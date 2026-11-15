@extends('layouts.club')

@section('title', 'Finance Center - KV Gjinoci')

@section('content')

    <style>
        .fn-page {
            max-width: 1250px;
            margin: 20px auto 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .fn-page * {
            box-sizing: border-box;
        }

        .fn-hero {
            background: linear-gradient(120deg, #172b4d, #315b89);
            color: white;
            padding: 32px;
            border-radius: 20px;
            margin-bottom: 25px;
        }

        .fn-hero h1 {
            color: white !important;
            margin: 14px 0;
            font-size: 32px;
        }

        .fn-hero p {
            color: #dbeafe;
            font-size: 14px;
            margin-bottom: 0;
        }

        .fn-hero small {
            color: #bfdbfe;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .fn-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 25px;
        }

        .fn-stat {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 23px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .fn-stat small {
            color: #64748b;
            font-size: 13px;
        }

        .fn-stat h2 {
            font-size: 27px;
            margin: 14px 0 0;
        }

        .fn-green {
            color: #15803d;
        }

        .fn-orange {
            color: #d97706;
        }

        .fn-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            padding: 26px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .fn-card h2 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        .fn-subtitle {
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
            margin: 0 0 22px;
        }

        .fn-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 20px;
        }

        .fn-full {
            grid-column: 1 / -1;
        }

        .fn-field label {
            display: block;
            color: #334155;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 9px;
        }

        .fn-page input,
        .fn-page select,
        .fn-page textarea {
            width: 100%;
            border: 1px solid #dbe3ee;
            border-radius: 8px;
            padding: 12px;
            color: #172b4d;
            background: #f8fafc;
            font-size: 13px;
            font-family: Arial, sans-serif;
        }

        .fn-page textarea {
            min-height: 90px;
            resize: vertical;
        }

        .fn-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 16px;
            background: #253858;
            color: white !important;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none !important;
        }

        .fn-btn-green {
            background: #15803d;
        }

        .fn-btn-light {
            background: #e8efff;
            color: #315b89 !important;
        }

        .fn-btn-danger {
            background: #fee2e2;
            color: #b91c1c !important;
        }

        .fn-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .fn-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
        }

        .fn-page table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        .fn-page th {
            background: #253858;
            color: white;
            font-size: 12px;
            padding: 15px;
            text-align: left;
        }

        .fn-page td {
            padding: 16px 13px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
            vertical-align: middle;
        }

        .fn-badge {
            display: inline-block;
            background: #e8efff;
            color: #315b89;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .fn-paid {
            background: #dcfce7;
            color: #15803d;
        }

        .fn-unpaid {
            background: #fff7ed;
            color: #c2410c;
        }

        .fn-inline-form {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }

        .fn-inline-form input,
        .fn-inline-form select {
            width: auto;
            min-width: 130px;
        }

        .fn-message {
            padding: 16px;
            margin-bottom: 22px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.8;
        }

        .fn-success {
            background: #dcfce7;
            color: #166534;
        }

        .fn-error {
            background: #fff1f2;
            color: #be123c;
        }

        .fn-empty {
            text-align: center;
            color: #64748b;
            padding: 30px !important;
        }

        .fn-payment-form {
            display: grid;
            gap: 8px;
            min-width: 180px;
        }

        .fn-page details summary {
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
            color: #315b89;
            margin-bottom: 10px;
        }

        @media(max-width: 850px) {
            .fn-stats,
            .fn-grid {
                grid-template-columns: repeat(2,1fr);
            }
        }

        @media(max-width: 500px) {
            .fn-stats,
            .fn-grid {
                grid-template-columns: 1fr;
            }

            .fn-card,
            .fn-hero {
                padding: 20px;
            }
        }
    </style>

    @php
        $roleLabels = [
            'coach' => 'Trajner',
            'player' => 'Volejbolliste',
            'manager' => 'Menaxher'
        ];
    @endphp

    <div class="fn-page">

        <div class="fn-hero">

            <small>KV GJINOCI | FINANCE CENTER</small>

            <h1>Financat dhe Kontratat</h1>

            <p>
                Menaxho kontratat, pagat mujore dhe
                obligimet financiare te klubit.
            </p>

        </div>

        @if(session('success'))

            <div class="fn-message fn-success">
                {{ session('success') }}
            </div>

        @endif

        @if($errors->any())

            <div class="fn-message fn-error">

                <strong>Kontrollo te dhenat:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        <div class="fn-stats">

            <div class="fn-stat">
                <small>Kontrata Aktive</small>
                <h2>{{ $kontrataAktive }}</h2>
            </div>

            <div class="fn-stat">

                <small>Paga Mujore te Kontraktuara</small>

                <h2>
                    {{ number_format($pagaMujore, 2) }} €
                </h2>

            </div>

            <div class="fn-stat">

                <small>Total Paguar</small>

                <h2 class="fn-green">
                    {{ number_format($totalPaguar, 2) }} €
                </h2>

            </div>

            <div class="fn-stat">

                <small>Paga te Gjeneruara Pa Paguar</small>

                <h2 class="fn-orange">
                    {{ number_format($totalPapaguar, 2) }} €
                </h2>

            </div>

        </div>

        {{-- KONTRATA E RE --}}

        <div class="fn-card">

            <h2>+ Krijo Kontrate</h2>

            <p class="fn-subtitle">
                Regjistro kontraten dhe pagen mujore
                te nje volejbollisteje ose anetari te stafit.
            </p>

            @if($perdoruesit->isEmpty())

                <div class="fn-empty">
                    Nuk ka perdorues me rol sportiv.
                    Krijo llogarite nga paneli i Adminit.
                </div>

            @else

                <form method="POST"
                      action="{{ route('financat.kontratat.store') }}">

                    @csrf

                    <div class="fn-grid">

                        <div class="fn-field">

                            <label>Perdoruesi</label>

                            <select name="user_id" required>

                                <option value="">
                                    Zgjedh perdoruesin
                                </option>

                                @foreach($perdoruesit as $user)

                                    <option value="{{ $user->id }}"
                                        @selected(old('user_id') == $user->id)>

                                        {{ $user->name }}
                                        -
                                        {{ $roleLabels[$user->role] ?? $user->role }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="fn-field">

                            <label>Numri i Kontrates</label>

                            <input type="text"
                                   name="numri_kontrates"
                                   value="{{ old('numri_kontrates') }}"
                                   placeholder="KV-2026-001"
                                   required>

                        </div>

                        <div class="fn-field">

                            <label>Paga Mujore (€)</label>

                            <input type="number"
                                   name="paga_mujore"
                                   min="0.01"
                                   step="0.01"
                                   value="{{ old('paga_mujore') }}"
                                   placeholder="500.00"
                                   required>

                        </div>

                        <div class="fn-field">

                            <label>Data e Fillimit</label>

                            <input type="date"
                                   name="data_fillimit"
                                   value="{{ old('data_fillimit') }}"
                                   required>

                        </div>

                        <div class="fn-field">

                            <label>Data e Mbarimit</label>

                            <input type="date"
                                   name="data_mbarimit"
                                   value="{{ old('data_mbarimit') }}"
                                   required>

                        </div>

                        <div class="fn-field fn-full">

                            <label>Shenime shtese</label>

                            <textarea name="shenime"
                                      placeholder="Kushtet e kontrates...">{{ old('shenime') }}</textarea>

                        </div>

                    </div>

                    <div class="fn-actions">

                        <button type="submit" class="fn-btn">
                            Ruaj Kontraten
                        </button>

                    </div>

                </form>

            @endif

        </div>

        {{-- LISTA E KONTRATAVE --}}

        <div class="fn-card">

            <h2>Kontratat e Regjistruara</h2>

            <p class="fn-subtitle">
                Total: {{ $totalKontrata }} kontrata.
                Gjenero pagen e muajit direkt nga kontrata.
            </p>

            <div class="fn-table-wrap">

                <table>

                    <thead>
                    <tr>
                        <th>Numri</th>
                        <th>Perdoruesi</th>
                        <th>Roli</th>
                        <th>Paga Mujore</th>
                        <th>Periudha</th>
                        <th>Statusi</th>
                        <th>Gjenero Pagen</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($kontratat as $kontrata)

                        <tr>

                            <td>
                                <strong>
                                    {{ $kontrata->numri_kontrates }}
                                </strong>
                            </td>

                            <td>{{ $kontrata->user->name }}</td>

                            <td>
                                {{ $roleLabels[$kontrata->roli]
                                    ?? $kontrata->roli }}
                            </td>

                            <td>
                                <strong>
                                    {{ number_format($kontrata->paga_mujore, 2) }} €
                                </strong>
                            </td>

                            <td>
                                {{ $kontrata->data_fillimit->format('d.m.Y') }}
                                <br>
                                {{ $kontrata->data_mbarimit->format('d.m.Y') }}
                            </td>

                            <td>

                                <span class="fn-badge
                                    {{ $kontrata->eshteAktive() ? 'fn-paid' : '' }}">

                                    {{ $kontrata->gjendja }}

                                </span>

                            </td>

                            <td>

                                @if($kontrata->statusi === 'Aktive')

                                    <form method="POST"
                                          class="fn-inline-form"
                                          action="{{ route(
                                              'financat.paga.store',
                                              $kontrata
                                          ) }}">

                                        @csrf

                                        <input type="month"
                                               name="muaji"
                                               value="{{ now()->format('Y-m') }}"
                                               min="{{ $kontrata->data_fillimit->format('Y-m') }}"
                                               max="{{ $kontrata->data_mbarimit->format('Y-m') }}"
                                               required>

                                        <button class="fn-btn"
                                                type="submit">
                                            Gjenero
                                        </button>

                                    </form>

                                @else

                                    -

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="fn-empty">
                                Nuk ka kontrata te regjistruara.
                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- LISTA E PAGESAVE --}}

        <div class="fn-card">

            <h2>Pagat dhe Pagesat</h2>

            <p class="fn-subtitle">
                Regjistro pagesat e kryera dhe percjell
                pagat qe ende nuk jane paguar.
            </p>

            <div class="fn-table-wrap">

                <table>

                    <thead>

                    <tr>
                        <th>Perdoruesi</th>
                        <th>Muaji</th>
                        <th>Shuma</th>
                        <th>Statusi</th>
                        <th>Data e Pageses</th>
                        <th>Metoda</th>
                        <th>Veprimet</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($pagesat as $pagesa)

                        <tr>

                            <td>

                                <strong>
                                    {{ $pagesa->kontrata->user->name }}
                                </strong>

                                <div style="color:#64748b;font-size:11px;margin-top:5px;">
                                    {{ $pagesa->kontrata->numri_kontrates }}
                                </div>

                            </td>

                            <td>
                                {{ $pagesa->muaji->format('m/Y') }}
                            </td>

                            <td>
                                <strong>
                                    {{ number_format($pagesa->shuma, 2) }} €
                                </strong>
                            </td>

                            <td>

                                <span class="fn-badge
                                    {{ $pagesa->statusi === 'Paguar'
                                        ? 'fn-paid'
                                        : 'fn-unpaid' }}">

                                    {{ $pagesa->statusi }}

                                </span>

                            </td>

                            <td>
                                {{ $pagesa->data_pageses?->format('d.m.Y') ?? '-' }}
                            </td>

                            <td>
                                {{ $pagesa->metoda_pageses ?? '-' }}
                            </td>

                            <td>

                                @if($pagesa->statusi === 'Pa paguar')

                                    <details>

                                        <summary>
                                            Regjistro Pagesen
                                        </summary>

                                        <form method="POST"
                                              class="fn-payment-form"
                                              action="{{ route(
                                                  'financat.pagesat.paguaj',
                                                  $pagesa
                                              ) }}">

                                            @csrf
                                            @method('PUT')

                                            <input type="date"
                                                   name="data_pageses"
                                                   value="{{ now()->format('Y-m-d') }}"
                                                   max="{{ now()->format('Y-m-d') }}"
                                                   required>

                                            <select name="metoda_pageses" required>

                                                <option value="Banke">
                                                    Transfer Bankar
                                                </option>

                                                <option value="Cash">
                                                    Cash
                                                </option>

                                            </select>

                                            <input type="text"
                                                   name="shenime"
                                                   placeholder="Referenca e pageses">

                                            <button type="submit"
                                                    class="fn-btn fn-btn-green">

                                                Konfirmo Pagesen

                                            </button>

                                        </form>

                                    </details>

                                @else

                                    <form method="POST"
                                          action="{{ route(
                                              'financat.pagesat.anulo',
                                              $pagesa
                                          ) }}"
                                          onsubmit="return confirm('A je i sigurt qe pagesa eshte regjistruar gabimisht?')">

                                        @csrf
                                        @method('PUT')

                                        <button type="submit"
                                                class="fn-btn fn-btn-danger">

                                            Anulo Regjistrimin

                                        </button>

                                    </form>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="fn-empty">
                                Ende nuk ka paga te gjeneruara.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <p style="text-align:center;color:#64748b;font-size:12px;">
            KV Gjinoci | Finance Center
        </p>

    </div>

@endsection
