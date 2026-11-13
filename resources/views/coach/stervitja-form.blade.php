@extends('layouts.club')

@section('title', ($stervitja->exists ? 'Edito Stervitjen' : 'Shto Stervitje') . ' - KV Gjinoci')

@section('content')

    <style>
        .tf-page {
            max-width: 1050px;
            margin: 0 auto;
            padding: 15px 0 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .tf-page * {
            box-sizing: border-box;
        }

        .tf-hero {
            background: linear-gradient(120deg, #172b4d, #315b89);
            border-radius: 18px;
            padding: 32px;
            color: white;
            margin-bottom: 25px;
        }

        .tf-hero small {
            color: #bfdbfe;
            letter-spacing: 1.5px;
            font-weight: bold;
            font-size: 11px;
        }

        .tf-hero h1 {
            color: white;
            font-size: 30px;
            margin: 14px 0;
        }

        .tf-hero p {
            color: #dbeafe;
            font-size: 14px;
            margin: 0;
            line-height: 1.7;
        }

        .tf-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 28px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .tf-card h2 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        .tf-subtitle {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 25px;
        }

        .tf-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 22px;
        }

        .tf-field {
            min-width: 0;
        }

        .tf-full {
            grid-column: 1 / -1;
        }

        .tf-field label {
            display: block;
            color: #334155;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .tf-field input,
        .tf-field select,
        .tf-field textarea {
            display: block;
            width: 100%;
            padding: 13px;
            border-radius: 9px;
            border: 1px solid #dbe3ee;
            background: #f8fafc;
            color: #172b4d;
            font-family: Arial, sans-serif;
            font-size: 14px;
            outline: none;
        }

        .tf-field input,
        .tf-field select {
            height: 46px;
        }

        .tf-field input:focus,
        .tf-field select:focus,
        .tf-field textarea:focus {
            border-color: #2563eb;
            background: white;
        }

        .tf-field textarea {
            min-height: 120px;
            resize: vertical;
        }

        .tf-field input[readonly] {
            background: #edf2f7;
            color: #64748b;
        }

        .tf-info {
            background: #edf4ff;
            border: 1px solid #dbeafe;
            color: #315b89;
            border-radius: 10px;
            padding: 17px;
            margin-bottom: 24px;
            font-size: 13px;
            line-height: 1.7;
        }

        .tf-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 17px;
            color: #be123c;
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .tf-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            border-top: 1px solid #e2e8f0;
            padding-top: 24px;
            margin-top: 28px;
        }

        .tf-btn {
            padding: 13px 20px;
            background: #253858;
            color: white !important;
            border-radius: 9px;
            text-decoration: none !important;
            border: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }

        .tf-btn-light {
            background: #edf2f7;
            color: #253858 !important;
        }

        @media(max-width: 750px) {
            .tf-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 500px) {
            .tf-grid {
                grid-template-columns: 1fr;
            }

            .tf-card, .tf-hero {
                padding: 20px;
            }
        }
    </style>

    @php
        $editing = $stervitja->exists;
    @endphp

    <div class="tf-page">

        <div class="tf-hero">

            <small>KV GJINOCI | COACH PORTAL</small>

            <h1>
                {{ $editing ? 'Edito Stervitjen' : 'Shto Stervitje te Re' }}
            </h1>

            <p>
                Planifiko orarin, cakto palestren dhe
                organizo aktivitetet e ekipit tend.
            </p>

        </div>

        <div class="tf-card">

            <h2>Informacionet e Stervitjes</h2>

            <p class="tf-subtitle">
                Ploteso te dhenat e nevojshme.
            </p>

            @if($errors->any())

                <div class="tf-error">

                    <strong>Kontrollo te dhenat:</strong>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="tf-info">

                <strong>Informacion:</strong>
                Mund te krijosh stervitje vetem per ekipet
                ku je i caktuar si trajner. Per te regjistruar
                prezencen, ndrysho statusin ne Perfunduar.

            </div>

            @if($ekipet->isEmpty())

                <div class="tf-error">

                    Nuk je caktuar ne asnje ekip.
                    Kontakto administratorin.

                </div>

                <a href="{{ route('coach.stervitjet') }}"
                   class="tf-btn tf-btn-light">

                    Kthehu

                </a>

            @else

                <form method="POST"
                      action="{{ $editing
                    ? route('coach.stervitjet.update', $stervitja)
                    : route('coach.stervitjet.store') }}">

                    @csrf

                    @if($editing)
                        @method('PUT')
                    @endif

                    <div class="tf-grid">

                        <div class="tf-field">

                            <label for="ekipi_id">Ekipi</label>

                            <select name="ekipi_id"
                                    id="ekipi_id"
                                    required>

                                <option value="">Zgjedh ekipin</option>

                                @foreach($ekipet as $ekipi)

                                    <option value="{{ $ekipi->id }}"
                                        @selected(old(
                                            'ekipi_id',
                                            $stervitja->ekipi_id
                                        ) == $ekipi->id)>

                                        {{ $ekipi->emri }}
                                        ({{ $ekipi->kategoria }})

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="tf-field">

                            <label>Trajneri</label>

                            <input type="text"
                                   value="{{ auth()->user()->trajner->emri }} {{ auth()->user()->trajner->mbiemri }}"
                                   readonly>

                        </div>

                        <div class="tf-field">

                            <label for="sezoni_id">Sezoni</label>

                            <select name="sezoni_id" id="sezoni_id">

                                <option value="">Pa sezon</option>

                                @foreach($sezonet as $sezoni)

                                    <option value="{{ $sezoni->id }}"
                                        @selected(old(
                                            'sezoni_id',
                                            $stervitja->sezoni_id
                                        ) == $sezoni->id)>

                                        {{ $sezoni->emri }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="tf-field">

                            <label for="data">Data</label>

                            <input type="date"
                                   name="data"
                                   id="data"
                                   value="{{ old(
                                   'data',
                                   $stervitja->data
                                       ? \Carbon\Carbon::parse($stervitja->data)->format('Y-m-d')
                                       : ''
                               ) }}"
                                   required>

                        </div>

                        <div class="tf-field">

                            <label for="ora_fillimit">Ora e Fillimit</label>

                            <input type="time"
                                   name="ora_fillimit"
                                   id="ora_fillimit"
                                   value="{{ old(
                                   'ora_fillimit',
                                   substr($stervitja->ora_fillimit ?? '', 0, 5)
                               ) }}"
                                   required>

                        </div>

                        <div class="tf-field">

                            <label for="ora_mbarimit">Ora e Mbarimit</label>

                            <input type="time"
                                   name="ora_mbarimit"
                                   id="ora_mbarimit"
                                   value="{{ old(
                                   'ora_mbarimit',
                                   substr($stervitja->ora_mbarimit ?? '', 0, 5)
                               ) }}"
                                   required>

                        </div>

                        <div class="tf-field">

                            <label for="palestra">Palestra</label>

                            <input type="text"
                                   name="palestra"
                                   id="palestra"
                                   placeholder="Palestra 13 Qershori"
                                   value="{{ old('palestra', $stervitja->palestra) }}"
                                   required>

                        </div>

                        <div class="tf-field">

                            <label for="lloji">Lloji i Stervitjes</label>

                            <select name="lloji"
                                    id="lloji"
                                    required>

                                @foreach([
                                    'Fizike',
                                    'Teknike',
                                    'Taktike',
                                    'Miqesore',
                                    'Rikuperim'
                                ] as $lloji)

                                    <option value="{{ $lloji }}"
                                        @selected(old(
                                            'lloji',
                                            $stervitja->lloji ?? 'Fizike'
                                        ) === $lloji)>

                                        {{ $lloji }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="tf-field">

                            <label for="statusi">Statusi</label>

                            <select name="statusi"
                                    id="statusi"
                                    required>

                                @foreach([
                                    'Planifikuar',
                                    'Perfunduar',
                                    'Anuluar'
                                ] as $statusi)

                                    <option value="{{ $statusi }}"
                                        @selected(old(
                                            'statusi',
                                            $stervitja->statusi ?? 'Planifikuar'
                                        ) === $statusi)>

                                        {{ $statusi }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="tf-field tf-full">

                            <label for="pershkrimi">

                                Pershkrimi i Stervitjes

                            </label>

                            <textarea name="pershkrimi"
                                      id="pershkrimi"
                                      placeholder="Ushtrimet, objektivat dhe shenimet e stervitjes...">{{ old('pershkrimi', $stervitja->pershkrimi) }}</textarea>

                        </div>

                    </div>

                    <div class="tf-actions">

                        <a href="{{ route('coach.stervitjet') }}"
                           class="tf-btn tf-btn-light">

                            Anulo

                        </a>

                        <button type="submit" class="tf-btn">

                            ✓ {{ $editing ? 'Ruaj Ndryshimet' : 'Ruaj Stervitjen' }}

                        </button>

                    </div>

                </form>

            @endif

        </div>

    </div>

@endsection
