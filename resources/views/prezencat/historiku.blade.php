@extends('layouts.club')

@section('title', 'Historiku i Prezences')

@section('content')

    <div class="card">

        <h1>Historiku i Prezences</h1>

        <h2>
            {{ $lojtar->emri }}
            {{ $lojtar->mbiemri }}
        </h2>

        <p>
            Ekipi: {{ $lojtar->ekipi?->emri ?? 'Pa ekip' }}
        </p>

        <p>
            Pozicioni: {{ $lojtar->pozicioni }}
        </p>

    </div>

    <div class="fields">

        <div class="card">
            <p>Stervitje te evidentuara</p>
            <h1>{{ $total }}</h1>
        </div>

        <div class="card">
            <p>Prezente</p>
            <h1 style="color:green">{{ $prezente }}</h1>
        </div>

        <div class="card">
            <p>Mungesa</p>
            <h1 style="color:red">{{ $mungesa }}</h1>
        </div>

        <div class="card">
            <p>Me vonese</p>
            <h1>{{ $vonese }}</h1>
        </div>

        <div class="card">
            <p>Mungesa te arsyetuara</p>
            <h1>{{ $arsyetuara }}</h1>
        </div>

        <div class="card">
            <p>Perqindja e Prezences</p>
            <h1 style="color:#2563eb">
                {{ $perqindja }}%
            </h1>

            <div style="background:#e2e8f0;
                    height:10px;
                    border-radius:8px;
                    overflow:hidden">

                <div style="background:#2563eb;
                        width:{{ $perqindja }}%;
                        height:100%">
                </div>

            </div>
        </div>

    </div>

    <div class="card">

        <h2>Historiku i Stervitjeve</h2>

        <div style="overflow-x:auto">

            <table>

                <thead>
                <tr>
                    <th>Data</th>
                    <th>Ekipi</th>
                    <th>Lloji</th>
                    <th>Statusi</th>
                    <th>Shenime</th>
                    <th>Detajet</th>
                </tr>
                </thead>

                <tbody>

                @forelse($prezencat as $prezenca)

                    <tr>
                        <td>
                            {{ $prezenca->stervitja->data->format('d.m.Y') }}
                        </td>

                        <td>
                            {{ $prezenca->stervitja->ekipi->emri }}
                        </td>

                        <td>
                            {{ $prezenca->stervitja->lloji }}
                        </td>

                        <td>
                            <strong>{{ $prezenca->statusi }}</strong>
                        </td>

                        <td>
                            {{ $prezenca->shenime ?? '-' }}
                        </td>

                        <td>
                            <a href="{{ route('stervitjet.show',
                                $prezenca->stervitja) }}">
                                Shiko Stervitjen
                            </a>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6">
                            Nuk ka prezenca te regjistruara.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <a class="btn"
       href="{{ route('lojtar.show', $lojtar) }}">
        Kthehu te Profili
    </a>

@endsection
