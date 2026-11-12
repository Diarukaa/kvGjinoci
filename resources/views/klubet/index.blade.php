@extends('layouts.club')

@section('title', 'Klubet - KV Gjinoci')

@section('content')

    <h1>Menaxhimi i Klubeve</h1>

    <div class="card">
        <h2>Regjistro Klub te Ri</h2>

        <form method="POST" action="{{ route('klubet.store') }}">
            @csrf

            <div class="fields">
                <div>
                    <label>Emri i Klubit:</label>
                    <input name="emri"
                           value="{{ old('emri') }}"
                           placeholder="KV Gjinoci" required>
                </div>

                <div>
                    <label>Qyteti:</label>
                    <input name="qyteti"
                           value="{{ old('qyteti') }}"
                           placeholder="Suhareke">
                </div>
            </div>

            <p>
                <button type="submit">Shto Klub</button>
            </p>
        </form>
    </div>

    <div class="card">
        <h2>Klubet e Regjistruara</h2>

        <p>Total: {{ $klubet->count() }}</p>

        <div style="overflow-x:auto">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Emri</th>
                    <th>Qyteti</th>
                    <th>Kampionate</th>
                    <th>Veprimet</th>
                </tr>
                </thead>

                <tbody>
                @forelse($klubet as $klubi)
                    <tr>
                        <td>{{ $klubi->id }}</td>
                        <td>{{ $klubi->emri }}</td>
                        <td>{{ $klubi->qyteti ?? '-' }}</td>
                        <td>{{ $klubi->kampionatet_count }}</td>

                        <td>
                            <div class="actions">
                                <button type="button"
                                        onclick="document.getElementById('edit-klub-{{ $klubi->id }}').hidden = !document.getElementById('edit-klub-{{ $klubi->id }}').hidden">
                                    Edito
                                </button>

                                @if($klubi->kampionatet_count === 0)
                                    <form method="POST"
                                          action="{{ route('klubet.destroy', $klubi) }}"
                                          onsubmit="return confirm('A je i sigurt?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="danger" type="submit">
                                            Fshi
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <tr id="edit-klub-{{ $klubi->id }}" hidden>
                        <td colspan="5">
                            <form method="POST"
                                  action="{{ route('klubet.update', $klubi) }}">

                                @csrf
                                @method('PUT')

                                <label>Emri:</label>
                                <input name="emri"
                                       value="{{ $klubi->emri }}"
                                       required>

                                <label>Qyteti:</label>
                                <input name="qyteti"
                                       value="{{ $klubi->qyteti }}">

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
                            Nuk ka klube te regjistruara.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
