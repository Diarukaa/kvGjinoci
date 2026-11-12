@extends('layouts.club')

@section('title', 'Kampionatet - KV Gjinoci')

@section('content')

    <h1>Menaxhimi i Kampionateve</h1>

    <div class="card">
        <h2>Krijo Kampionat te Ri</h2>

        <form method="POST"
              action="{{ route('kampionatet.store') }}">

            @csrf

            <div class="fields">
                <div>
                    <label>Emri i Kampionatit:</label>
                    <input name="emri"
                           value="{{ old('emri') }}"
                           placeholder="Superliga e Femrave"
                           required>
                </div>

                <div>
                    <label>Sezoni:</label>

                    <select name="sezoni_id" required>
                        <option value="">Zgjedh sezonin</option>

                        @foreach($sezonet as $sezoni)
                            <option value="{{ $sezoni->id }}"
                                @selected(old('sezoni_id') == $sezoni->id)>
                                {{ $sezoni->emri }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Kategoria:</label>

                    <select name="kategoria" required>
                        @foreach(['Senior', 'U18', 'U16', 'U14'] as $kategoria)
                            <option value="{{ $kategoria }}">
                                {{ $kategoria }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <h3>Klubet Pjesemarrese</h3>

            <div class="club-list">
                @foreach($klubet as $klubi)
                    <label>
                        <input type="checkbox"
                               name="klubet[]"
                               value="{{ $klubi->id }}"
                            @checked(in_array($klubi->id, old('klubet', [])))>

                        {{ $klubi->emri }}
                    </label>
                @endforeach
            </div>

            <p>
                <button type="submit">Krijo Kampionatin</button>
            </p>
        </form>
    </div>

    <div class="card">
        <h2>Kampionatet e Regjistruara</h2>

        <div style="overflow-x:auto">
            <table>
                <thead>
                <tr>
                    <th>Kampionati</th>
                    <th>Sezoni</th>
                    <th>Kategoria</th>
                    <th>Klubet</th>
                    <th>Veprimet</th>
                </tr>
                </thead>

                <tbody>
                @forelse($kampionatet as $kampionati)
                    <tr>
                        <td>{{ $kampionati->emri }}</td>
                        <td>{{ $kampionati->sezoni->emri }}</td>
                        <td>{{ $kampionati->kategoria }}</td>
                        <td>{{ $kampionati->klubet_count }}</td>

                        <td>
                            <div class="actions">
                                <a class="btn"
                                   href="{{ route('kampionatet.show', $kampionati) }}">
                                    View
                                </a>

                                <button type="button"
                                        onclick="document.getElementById('edit-kampionati-{{ $kampionati->id }}').hidden = !document.getElementById('edit-kampionati-{{ $kampionati->id }}').hidden">
                                    Edito
                                </button>

                                <form method="POST"
                                      action="{{ route('kampionatet.destroy', $kampionati) }}"
                                      onsubmit="return confirm('A je i sigurt?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="danger" type="submit">
                                        Fshi
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <tr id="edit-kampionati-{{ $kampionati->id }}" hidden>
                        <td colspan="5">
                            <form method="POST"
                                  action="{{ route('kampionatet.update', $kampionati) }}">

                                @csrf
                                @method('PUT')

                                <label>Emri:</label>
                                <input name="emri"
                                       value="{{ $kampionati->emri }}"
                                       required>

                                <label>Sezoni:</label>

                                <select name="sezoni_id">
                                    @foreach($sezonet as $sezoni)
                                        <option value="{{ $sezoni->id }}"
                                            @selected($kampionati->sezoni_id == $sezoni->id)>
                                            {{ $sezoni->emri }}
                                        </option>
                                    @endforeach
                                </select>

                                <label>Kategoria:</label>

                                <select name="kategoria">
                                    @foreach(['Senior', 'U18', 'U16', 'U14'] as $kategoria)
                                        <option value="{{ $kategoria }}"
                                            @selected($kampionati->kategoria === $kategoria)>
                                            {{ $kategoria }}
                                        </option>
                                    @endforeach
                                </select>

                                <h3>Klubet Pjesemarrese</h3>

                                <div class="club-list">
                                    @foreach($klubet as $klubi)
                                        <label>
                                            <input type="checkbox"
                                                   name="klubet[]"
                                                   value="{{ $klubi->id }}"
                                                @checked($kampionati->klubet->contains('id', $klubi->id))>

                                            {{ $klubi->emri }}
                                        </label>
                                    @endforeach
                                </div>

                                <p>
                                    <button type="submit">
                                        Ruaj Ndryshimet
                                    </button>
                                </p>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            Nuk ka kampionate te regjistruara.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
