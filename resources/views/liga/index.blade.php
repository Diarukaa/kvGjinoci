@extends('layouts.club')

@section('title', 'Klasifikimi - ' . $kampionati->emri)

@section('content')

    <div class="card">
        <h1>{{ $kampionati->emri }}</h1>

        <p>
            Sezoni: {{ $kampionati->sezoni->emri }}
            |
            Kategoria: {{ $kampionati->kategoria }}
        </p>

        <p>Klube pjesemarrese: {{ $klubet->count() }}</p>
        <p>Ndeshje te regjistruara: {{ $ndeshjet->count() }}</p>
    </div>

    <div class="card">

        <h2>Tabela e Klasifikimit</h2>

        <div style="overflow-x:auto">
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Klubi</th>
                    <th>Ndeshje</th>
                    <th>Fitore</th>
                    <th>Humbje</th>
                    <th>Sete +</th>
                    <th>Sete -</th>
                    <th>Dif.</th>
                    <th>Pike</th>
                </tr>
                </thead>

                <tbody>
                @forelse($renditja as $rreshti)
                    <tr style="{{ $rreshti['klubi']->emri === 'KV Gjinoci'
                        ? 'background:#eaf2ff;font-weight:bold;'
                        : '' }}">

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $rreshti['klubi']->emri }}
                        </td>

                        <td>{{ $rreshti['ndeshje'] }}</td>
                        <td>{{ $rreshti['fitore'] }}</td>
                        <td>{{ $rreshti['humbje'] }}</td>

                        <td>{{ $rreshti['setet_fituara'] }}</td>
                        <td>{{ $rreshti['setet_humbura'] }}</td>
                        <td>{{ $rreshti['diferenca'] }}</td>

                        <td>
                            <strong>{{ $rreshti['piket'] }}</strong>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            Nuk ka klube te regjistruara.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <div class="card">

        <h2>Regjistro Rezultat te Ri</h2>

        @if($klubet->count() < 2)
            <p>
                Duhet te regjistrosh te pakten dy klube
                ne kampionat.
            </p>
        @else
            <form method="POST"
                  action="{{ route('liga.store', $kampionati) }}">
                @csrf

                @include('liga.form', ['ndeshja' => null])
            </form>
        @endif

    </div>

    <div class="card">

        <h2>Rezultatet e Ndeshjeve</h2>

        <div style="overflow-x:auto">
            <table>
                <thead>
                <tr>
                    <th>Data</th>
                    <th>Vendas</th>
                    <th>Rezultati</th>
                    <th>Mysafir</th>
                    <th>Veprimet</th>
                </tr>
                </thead>

                <tbody>
                @forelse($ndeshjet as $ndeshja)
                    <tr>
                        <td>
                            {{ $ndeshja->data_ndeshjes->format('d.m.Y') }}
                        </td>

                        <td>{{ $ndeshja->vendas->emri }}</td>

                        <td>
                            <strong>
                                {{ $ndeshja->setet_vendas }}
                                -
                                {{ $ndeshja->setet_mysafir }}
                            </strong>
                        </td>

                        <td>{{ $ndeshja->mysafir->emri }}</td>

                        <td>
                            <div class="actions">

                                <button type="button"
                                        onclick="document.getElementById(
                                        'edit-ndeshja-{{ $ndeshja->id }}'
                                    ).hidden = !document.getElementById(
                                        'edit-ndeshja-{{ $ndeshja->id }}'
                                    ).hidden">
                                    Edito
                                </button>

                                <form method="POST"
                                      action="{{ route('liga.destroy', [
                                          $kampionati,
                                          $ndeshja
                                      ]) }}"
                                      onsubmit="return confirm('A je i sigurt?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="danger">
                                        Fshi
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                    <tr id="edit-ndeshja-{{ $ndeshja->id }}" hidden>
                        <td colspan="5">

                            <form method="POST"
                                  action="{{ route('liga.update', [
                                      $kampionati,
                                      $ndeshja
                                  ]) }}">

                                @csrf
                                @method('PUT')

                                @include('liga.form', [
                                    'ndeshja' => $ndeshja
                                ])

                            </form>

                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5">
                            Nuk ka rezultate te regjistruara.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <a class="btn"
       href="{{ route('kampionatet.show', $kampionati) }}">
        Kthehu te Kampionati
    </a>

@endsection
