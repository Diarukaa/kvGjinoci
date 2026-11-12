@extends('layouts.club')

@section('title', $kampionati->emri)

@section('content')

    <div class="card">
        <h1>{{ $kampionati->emri }}</h1>

        <p>
            Sezoni: {{ $kampionati->sezoni->emri }}
        </p>

        <p>
            Kategoria: {{ $kampionati->kategoria }}
        </p>

        <h3>
            Klube pjesemarrese:
            {{ $kampionati->klubet->count() }}
        </h3>
    </div>

    <div class="card">
        <h2>Lista e Klubeve Pjesemarrese</h2>

        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Klubi</th>
                <th>Qyteti</th>
            </tr>
            </thead>

            <tbody>
            @forelse($kampionati->klubet->sortBy('emri') as $klubi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $klubi->emri }}</td>
                    <td>{{ $klubi->qyteti ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        Nuk ka klube ne kete kampionat.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <a class="btn" href="{{ route('kampionatet.index') }}">
        Kthehu te Kampionatet
    </a>

    <a class="btn"
       href="{{ route('liga.index', $kampionati) }}">
        Klasifikimi dhe Rezultatet
    </a>

@endsection
