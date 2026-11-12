@extends('layouts.club')

@section('title', 'Detajet e Stervitjes')

@section('content')

    <div class="card">

        <h1>Detajet e Stervitjes</h1>

        <h2>{{ $stervitja->ekipi->emri }}</h2>

        <p>
            <strong>Data:</strong>
            {{ $stervitja->data->format('d.m.Y') }}
        </p>

        <p>
            <strong>Orari:</strong>
            {{ substr($stervitja->ora_fillimit, 0, 5) }}
            -
            {{ substr($stervitja->ora_mbarimit, 0, 5) }}
        </p>

        <p>
            <strong>Trajneri:</strong>
            {{ $stervitja->trajner?->emri ?? 'Pa trajner' }}
            {{ $stervitja->trajner?->mbiemri }}
        </p>

        <p>
            <strong>Sezoni:</strong>
            {{ $stervitja->sezoni?->emri ?? 'Pa sezon' }}
        </p>

        <p>
            <strong>Palestra:</strong>
            {{ $stervitja->palestra }}
        </p>

        <p>
            <strong>Lloji:</strong>
            {{ $stervitja->lloji }}
        </p>

        <p>
            <strong>Statusi:</strong>
            {{ $stervitja->statusi }}
        </p>

        <hr>

        <h3>Pershkrimi i Stervitjes</h3>

        <p style="white-space:pre-wrap">{{ $stervitja->pershkrimi ?? 'Nuk ka pershkrim.' }}</p>

        <p>
            <a class="btn"
               href="{{ route('stervitjet.edit', $stervitja) }}">
                Edito Stervitjen
            </a>
        </p>

        @if($stervitja->statusi === 'Perfunduar')

            <hr>

            <h3>Prezenca ne Stervitje</h3>

            <p>
                Volejbolliste te evidentuara:
                {{ $stervitja->prezencat()->count() }}
            </p>

            <p>
                Prezente:
                {{ $stervitja->prezencat()
                    ->where('statusi', 'Prezente')->count() }}
            </p>

            <p>
                Mungesa:
                {{ $stervitja->prezencat()
                    ->where('statusi', 'Mungon')->count() }}
            </p>

            <p>
                <a class="btn"
                   href="{{ route('prezencat.edit', $stervitja) }}">
                    Menaxho Prezencen
                </a>
            </p>
        @endif

    </div>

    <a class="btn"
       href="{{ route('stervitjet.index') }}">
        Kthehu te Stervitjet
    </a>

@endsection
