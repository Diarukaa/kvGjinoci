@extends('layouts.club')

@section('title', 'Bilanci Financiar - KV Gjinoci')

@section('content')

    @include('financat.transaksioni-style')

    <div class="tf-page">

        <div class="tf-hero">

            <small>KV GJINOCI | FINANCE CENTER</small>

            <h1>Te Hyrat dhe Shpenzimet</h1>

            <p>
                Menaxho transaksionet, percjell shpenzimet
                dhe analizo bilancin financiar te klubit.
            </p>

            <div class="tf-actions">

                <a href="{{ route('financat.index') }}"
                   class="tf-btn tf-btn-light">

                    Kontratat dhe Pagat

                </a>

            </div>

        </div>

        @if(session('success'))

            <div class="tf-message tf-success">
                {{ session('success') }}
            </div>

        @endif

        @if($errors->any())

            <div class="tf-message tf-error">

                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif

        {{-- FILTERS --}}

        <div class="tf-card">

            <h2>Periudha Financiare</h2>

            <p class="tf-subtitle">

                Zgjedh muajin dhe vitin per te pare
                te hyrat, shpenzimet dhe bilancin.

            </p>

            <form method="GET"
                  action="{{ route('financat.transaksionet.index') }}"
                  class="tf-filter">

                <div>

                    <label>Muaji</label>

                    <select name="muaji">

                        @foreach($emratMuajve as $numri => $emri)

                            <option value="{{ $numri }}"
                                @selected($muaji == $numri)>

                                {{ $emri }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div>

                    <label>Viti</label>

                    <input type="number"
                           name="viti"
                           min="2000"
                           max="2100"
                           value="{{ $viti }}"
                           required>

                </div>

                <button type="submit" class="tf-btn">

                    Filtro

                </button>

            </form>

        </div>

        {{-- STATISTICS --}}

        <div class="tf-stats">

            <div class="tf-stat">

                <small>Te Hyrat e Muajit</small>

                <h2 class="tf-green">

                    {{ number_format($totalHyrje, 2) }} €

                </h2>

            </div>

            <div class="tf-stat">

                <small>Shpenzime Operative</small>

                <h2 class="tf-red">

                    {{ number_format($totalShpenzime, 2) }} €

                </h2>

            </div>

            <div class="tf-stat">

                <small>Pagat e Paguara</small>

                <h2 class="tf-orange">

                    {{ number_format($totalPaga, 2) }} €

                </h2>

            </div>

            <div class="tf-stat">

                <small>Bilanci i Muajit</small>

                <h2 class="{{ $bilanci >= 0
                ? 'tf-green'
                : 'tf-red' }}">

                    {{ number_format($bilanci, 2) }} €

                </h2>

            </div>

        </div>

        <div class="tf-stats"
             style="grid-template-columns:repeat(2,minmax(0,1fr));">

            <div class="tf-stat">

                <small>Shpenzime Gjithsej me Paga</small>

                <h2 class="tf-red">

                    {{ number_format($shpenzimeGjithsej, 2) }} €

                </h2>

            </div>

            <div class="tf-stat">

                <small>Paga te Gjeneruara Pa Paguar - Krejt Periudhat</small>

                <h2 class="tf-orange">

                    {{ number_format($totalPapaguar, 2) }} €

                </h2>

            </div>

        </div>

        {{-- ANNUAL CHART --}}

        <div class="tf-card">

            <h2>Analiza Financiare {{ $viti }}</h2>

            <p class="tf-subtitle">

                Krahasimi i te hyrave me shpenzimet
                dhe pagat e paguara per secilin muaj.

            </p>

            @php
                $maxVlera = max(
                    1,
                    collect($grafiku)->max('hyrje') ?? 0,
                    collect($grafiku)->max('shpenzime') ?? 0
                );
            @endphp

            <div class="tf-chart-wrap">

                <div class="tf-chart">

                    @foreach($grafiku as $item)

                        <div class="tf-chart-month">

                            <div class="tf-chart-bars">

                                <div class="tf-bar"
                                     title="Te hyrat: {{ number_format($item['hyrje'], 2) }} €"
                                     style="height:{{ ($item['hyrje'] / $maxVlera) * 100 }}%;">

                                </div>

                                <div class="tf-bar tf-bar-out"
                                     title="Shpenzimet: {{ number_format($item['shpenzime'], 2) }} €"
                                     style="height:{{ ($item['shpenzime'] / $maxVlera) * 100 }}%;">

                                </div>

                            </div>

                            <small>{{ $item['muaji'] }}</small>

                        </div>

                    @endforeach

                </div>

            </div>

            <div class="tf-legend">

            <span>

                <span class="tf-dot"
                      style="background:#22c55e;"></span>

                Te Hyrat

            </span>

                <span>

                <span class="tf-dot"
                      style="background:#ef4444;"></span>

                Shpenzimet + Pagat

            </span>

            </div>

        </div>

        {{-- CREATE TRANSACTION --}}

        <div class="tf-card">

            <h2>+ Regjistro Transaksion</h2>

            <p class="tf-subtitle">

                Shto nje hyrje financiare ose nje
                shpenzim te ri te klubit.

            </p>

            @include('financat.transaksioni-form')

        </div>

        {{-- TRANSACTION HISTORY --}}

        <div class="tf-card">

            <h2>Historiku i Transaksioneve</h2>

            <p class="tf-subtitle">

                Transaksionet per {{ $emratMuajve[$muaji] }}
                {{ $viti }}.

                Total: {{ $transaksionet->total() }} regjistrime.

            </p>

            <div class="tf-table-wrap">

                <table>

                    <thead>

                    <tr>
                        <th>Data</th>
                        <th>Lloji</th>
                        <th>Kategoria</th>
                        <th>Pershkrimi</th>
                        <th>Shuma</th>
                        <th>Metoda</th>
                        <th>Regjistroi</th>
                        <th>Veprimet</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($transaksionet as $transaksioni)

                        <tr>

                            <td>

                                {{ $transaksioni->data->format('d.m.Y') }}

                            </td>

                            <td>

                                <span class="tf-badge
                                    {{ $transaksioni->lloji === 'Hyrje'
                                        ? 'tf-badge-in'
                                        : 'tf-badge-out' }}">

                                    {{ $transaksioni->lloji }}

                                </span>

                            </td>

                            <td>

                                {{ $transaksioni->kategoria }}

                            </td>

                            <td>

                                <strong>
                                    {{ $transaksioni->pershkrimi }}
                                </strong>

                                @if($transaksioni->referenca)

                                    <div style="
                                        color:#64748b;
                                        font-size:11px;
                                        margin-top:5px;
                                    ">

                                        {{ $transaksioni->referenca }}

                                    </div>

                                @endif

                            </td>

                            <td>

                                <strong class="{{ $transaksioni->lloji === 'Hyrje'
                                    ? 'tf-green'
                                    : 'tf-red' }}">

                                    {{ $transaksioni->lloji === 'Hyrje'
                                        ? '+'
                                        : '-' }}

                                    {{ number_format($transaksioni->shuma, 2) }} €

                                </strong>

                            </td>

                            <td>

                                {{ $transaksioni->metoda_pageses }}

                            </td>

                            <td>

                                {{ $transaksioni->user?->name ?? '-' }}

                            </td>

                            <td>

                                <div style="
                                    display:flex;
                                    gap:7px;
                                    align-items:center;
                                ">

                                    <a href="{{ route(
                                        'financat.transaksionet.edit',
                                        $transaksioni
                                    ) }}" class="tf-btn tf-btn-light">

                                        Edito

                                    </a>

                                    <form method="POST"
                                          style="margin:0;"
                                          action="{{ route(
                                              'financat.transaksionet.destroy',
                                              $transaksioni
                                          ) }}"
                                          onsubmit="return confirm('A je i sigurt qe deshiron ta fshish transaksionin?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="tf-btn tf-btn-delete">

                                            Fshi

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="tf-empty">

                                Nuk ka transaksione per
                                periudhen e zgjedhur.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div style="margin-top:20px;">

                {{ $transaksionet->links() }}

            </div>

        </div>

        {{-- SALARY EXPENSES --}}

        <div class="tf-card">

            <h2>Pagat e Paguara ne Kete Periudhe</h2>

            <p class="tf-subtitle">

                Keto pagesa merren automatikisht nga
                moduli i kontratave dhe pagave.

            </p>

            <div class="tf-table-wrap">

                <table style="min-width:650px;">

                    <thead>

                    <tr>
                        <th>Perdoruesi</th>
                        <th>Muaji i Pages</th>
                        <th>Data e Pageses</th>
                        <th>Shuma</th>
                        <th>Metoda</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($pagat as $pagesa)

                        <tr>

                            <td>

                                <strong>

                                    {{ $pagesa->kontrata->user->name }}

                                </strong>

                            </td>

                            <td>

                                {{ $pagesa->muaji->format('m/Y') }}

                            </td>

                            <td>

                                {{ $pagesa->data_pageses?->format('d.m.Y') }}

                            </td>

                            <td class="tf-red">

                                <strong>

                                    {{ number_format($pagesa->shuma, 2) }} €

                                </strong>

                            </td>

                            <td>

                                {{ $pagesa->metoda_pageses }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="tf-empty">

                                Nuk ka paga te paguara
                                ne kete periudhe.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="tf-actions">

                <a href="{{ route('financat.index') }}"
                   class="tf-btn">

                    Menaxho Pagat

                </a>

            </div>

        </div>

        <div style="text-align:center;color:#64748b;font-size:12px;">

            KV Gjinoci | Finance Center

        </div>

    </div>

@endsection
