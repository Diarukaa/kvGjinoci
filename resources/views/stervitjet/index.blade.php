@extends('layouts.club')

@section('title', 'Stervitjet - KV Gjinoci')

@section('content')

    <h1>Menaxhimi i Stervitjeve</h1>

    <div class="fields">
        <div class="card">
            <p>Stervitje te planifikuara</p>
            <h1>{{ $totalPlanifikuara }}</h1>
        </div>

        <div class="card">
            <p>Stervitje te perfunduara</p>
            <h1>{{ $totalPerfunduar }}</h1>
        </div>

        <div class="card">
            <p>Regjistro nje stervitje te re</p>

            <a class="btn"
               href="{{ route('stervitjet.create') }}">
                + Shto Stervitje
            </a>
        </div>
    </div>

    <div class="card">

        <h2>Filtro Stervitjet</h2>

        <form method="GET"
              action="{{ route('stervitjet.index') }}">

            <div class="fields">
                <div>
                    <label>Ekipi:</label>

                    <select name="ekipi_id">
                        <option value="">
                            Te gjitha ekipet
                        </option>

                        @foreach($ekipet as $ekipi)
                            <option value="{{ $ekipi->id }}"
                                @selected($ekipiId == $ekipi->id)>
                                {{ $ekipi->emri }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Statusi:</label>

                    <select name="statusi">
                        <option value="">
                            Te gjitha statuset
                        </option>

                        @foreach(['Planifikuar', 'Perfunduar', 'Anuluar'] as $s)
                            <option value="{{ $s }}"
                                @selected($statusi === $s)>
                                {{ $s }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <p>
                <button type="submit">Filtro</button>

                <a href="{{ route('stervitjet.index') }}">
                    Pastro
                </a>
            </p>
        </form>
    </div>

    <div class="card">

        <h2>Orari i Stervitjeve</h2>

        <div style="overflow-x:auto">
            <table>
                <thead>
                <tr>
                    <th>Data</th>
                    <th>Ora</th>
                    <th>Ekipi</th>
                    <th>Trajneri</th>
                    <th>Palestra</th>
                    <th>Lloji</th>
                    <th>Statusi</th>
                    <th>Veprimet</th>
                </tr>
                </thead>

                <tbody>
                @forelse($stervitjet as $stervitja)
                    <tr>
                        <td>
                            {{ $stervitja->data->format('d.m.Y') }}
                        </td>

                        <td>
                            {{ substr($stervitja->ora_fillimit, 0, 5) }}
                            -
                            {{ substr($stervitja->ora_mbarimit, 0, 5) }}
                        </td>

                        <td>
                            {{ $stervitja->ekipi->emri }}
                        </td>

                        <td>
                            {{ $stervitja->trajner?->emri ?? 'Pa trajner' }}
                            {{ $stervitja->trajner?->mbiemri }}
                        </td>

                        <td>{{ $stervitja->palestra }}</td>

                        <td>{{ $stervitja->lloji }}</td>

                        <td>
                            <span style="color:{{ match($stervitja->statusi) {
                                'Perfunduar' => 'green',
                                'Anuluar' => 'red',
                                default => '#2563eb'
                            } }}">
                                {{ $stervitja->statusi }}
                            </span>
                        </td>

                        <td>
                            <div class="actions">

                                <a class="btn"
                                   href="{{ route('stervitjet.show', $stervitja) }}">
                                    View
                                </a>

                                <a class="btn"
                                   href="{{ route('stervitjet.edit', $stervitja) }}">
                                    Edito
                                </a>

                                <form method="POST"
                                      action="{{ route('stervitjet.destroy', $stervitja) }}"
                                      onsubmit="return confirm('A je i sigurt?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="danger"
                                            type="submit">
                                        Fshi
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            Nuk ka stervitje te regjistruara.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px">
            {{ $stervitjet->links() }}
        </div>

    </div>

@endsection
