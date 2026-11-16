@extends('layouts.club')

@section('title', 'Detajet e Aktivitetit - KV Gjinoci')

@section('content')

    @include('activity.style')

    @php
        $labels = [

            'name' => 'Emri i llogarise',

            'role' => 'Roli',

            'emri' => 'Emri',

            'mbiemri' => 'Mbiemri',

            'ekipi_id' => 'ID e ekipit',

            'trajner_id' => 'ID e trajnerit',

            'lojtar_id' => 'ID e volejbollistes',

            'manager_id' => 'ID e menaxherit',

            'user_id' => 'ID e perdoruesit',

            'ndeshja_id' => 'ID e ndeshjes',

            'stervitja_id' => 'ID e stervitjes',

            'kontrata_id' => 'ID e kontrates',

            'sezoni_id' => 'ID e sezonit',

            'klubi_id' => 'ID e klubit',

            'setet_tona' => 'Setet tona',

            'setet_kundershtarit' => 'Setet e kundershtarit',

            'data_ndeshjes' => 'Data e ndeshjes',

            'data_fillimit' => 'Data e fillimit',

            'data_mbarimit' => 'Data e mbarimit',

            'ora_fillimit' => 'Ora e fillimit',

            'ora_mbarimit' => 'Ora e mbarimit',

            'data_pageses' => 'Data e pageses',

            'metoda_pageses' => 'Metoda e pageses',

            'paga_mujore' => 'Paga mujore',

            'numri_kontrates' => 'Numri i kontrates',

            'numri_fanelles' => 'Numri i fanelles',

        ];

        $formatValue = function ($value, $field) {

            if ($value === null) {
                return 'Pa vlere';
            }

            if (is_array($value)) {

                return json_encode(
                    $value,
                    JSON_PRETTY_PRINT
                    | JSON_UNESCAPED_UNICODE
                );

            }

            if (is_bool($value)) {

                return $value ? 'Po' : 'Jo';

            }

            if (in_array(
                $field,
                ['shuma', 'paga_mujore'],
                true
            ) && is_numeric($value)) {

                return number_format(
                    (float) $value,
                    2
                ) . ' EUR';

            }

            return (string) $value;
        };

        $actionClasses = [
            'Krijuar' => 'al-created',
            'Perditesuar' => 'al-updated',
            'Fshire' => 'al-deleted',
        ];
    @endphp

    <div class="al-page" style="max-width:1100px;">

        <div class="al-hero">

            <small>

                KV GJINOCI | AUDIT DETAILS

            </small>

            <h1>Detajet e Aktivitetit</h1>

            <p>

                Regjistrimi #{{ $activityLog->id }}

                |

                {{ $activityLog->pershkrimi }}

            </p>

            <div style="margin-top:20px;">

                <a href="{{ route('activity.index') }}"
                   class="al-btn al-btn-light">

                    ← Kthehu te Historiku

                </a>

            </div>

        </div>

        {{-- INFORMACIONET --}}

        <div class="al-card">

            <h2>Informacionet e Veprimit</h2>

            <p class="al-subtitle">

                Te dhenat e regjistruara automatikisht
                ne momentin e ndryshimit.

            </p>

            <div class="al-info-grid">

                <div class="al-detail">

                    <small>Perdoruesi</small>

                    <strong>
                        {{ $activityLog->user_name ?? 'Sistemi' }}
                    </strong>

                </div>

                <div class="al-detail">

                    <small>Roli ne Momentin e Veprimit</small>

                    <strong>
                        {{ ucfirst($activityLog->user_role ?? 'Sistemi') }}
                    </strong>

                </div>

                <div class="al-detail">

                    <small>Data dhe Ora</small>

                    <strong>

                        {{ $activityLog->created_at->format('d.m.Y H:i:s') }}

                    </strong>

                </div>

                <div class="al-detail">

                    <small>Moduli</small>

                    <strong>
                        {{ $activityLog->moduli }}
                    </strong>

                </div>

                <div class="al-detail">

                    <small>Veprimi</small>

                    <span class="al-badge
                    {{ $actionClasses[$activityLog->veprimi] ?? '' }}">

                    {{ $activityLog->veprimi }}

                </span>

                </div>

                <div class="al-detail">

                    <small>ID e Regjistrimit</small>

                    <strong>

                        {{ class_basename($activityLog->model_type) }}

                        #{{ $activityLog->model_id }}

                    </strong>

                </div>

            </div>

            <div class="al-notice">

                <strong>Pershkrimi:</strong>

                {{ $activityLog->pershkrimi }}

            </div>

        </div>

        {{-- NDRYSHIMET --}}

        <div class="al-card">

            <h2>Historiku i Ndryshimeve</h2>

            <p class="al-subtitle">

                Krahasimi i vlerave para dhe pas
                veprimit te kryer.

            </p>

            <div class="al-table-wrap">

                <table style="min-width:650px;table-layout:fixed;">

                    <thead>

                    <tr>

                        <th style="width:30%;">

                            Fusha

                        </th>

                        <th style="width:35%;">

                            Vlera e Vjeter

                        </th>

                        <th style="width:35%;">

                            Vlera e Re

                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($fields as $field)

                        <tr>

                            <td>

                                <strong>

                                    {{ $labels[$field]
                                        ?? ucfirst(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $field
                                            )
                                        ) }}

                                </strong>

                                <div class="al-muted">

                                    {{ $field }}

                                </div>

                            </td>

                            <td>

                                @if(array_key_exists(
                                    $field,
                                    $vleratVjetra
                                ))

                                    <span class="al-old">

                                        {{ $formatValue(
                                            $vleratVjetra[$field],
                                            $field
                                        ) }}

                                    </span>

                                @else

                                    <span class="al-muted">-</span>

                                @endif

                            </td>

                            <td>

                                @if(array_key_exists(
                                    $field,
                                    $vleratReja
                                ))

                                    <span class="al-new">

                                        {{ $formatValue(
                                            $vleratReja[$field],
                                            $field
                                        ) }}

                                    </span>

                                @else

                                    <span class="al-muted">-</span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3" class="al-empty">

                                Nuk ka vlera per shfaqje.

                                Ky aktivitet mund te jete
                                nje ndryshim i sigurise
                                ose i profilit personal.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="al-notice">

                Per siguri, fjalekalimet, tokenat,
                adresat e emailit dhe fajllat privat
                nuk shfaqen ne historikun e ndryshimeve.

            </div>

        </div>

        <a href="{{ route('activity.index') }}"
           class="al-btn">

            Kthehu te Activity Log

        </a>

    </div>

@endsection
