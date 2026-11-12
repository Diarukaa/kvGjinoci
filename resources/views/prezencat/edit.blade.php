@extends('layouts.club')

@section('title', 'Prezenca ne Stervitje')

@section('content')

    <div class="card">

        <h1>Prezenca ne Stervitje</h1>

        <h2>{{ $stervitja->ekipi->emri }}</h2>

        <p>
            Data: {{ $stervitja->data->format('d.m.Y') }}
        </p>

        <p>
            Orari:
            {{ substr($stervitja->ora_fillimit, 0, 5) }}
            -
            {{ substr($stervitja->ora_mbarimit, 0, 5) }}
        </p>

        <p>Lloji: {{ $stervitja->lloji }}</p>

        <p>Statusi: {{ $stervitja->statusi }}</p>

    </div>

    <div class="card">

        <h2>Lista e Volejbollisteve</h2>

        @if($stervitja->statusi !== 'Perfunduar')

            <p>
                Stervitja duhet te jete e perfunduar
                para regjistrimit te prezences.
            </p>

            <a class="btn"
               href="{{ route('stervitjet.edit', $stervitja) }}">
                Edito Stervitjen
            </a>

        @elseif($lojtaret->isEmpty())

            <p>
                Nuk ka volejbolliste te regjistruara
                ne kete ekip.
            </p>

        @else

            <form method="POST"
                  action="{{ route('prezencat.update', $stervitja) }}">

                @csrf
                @method('PUT')

                <p>
                    <button type="button"
                            onclick="shenoTeGjitha()">
                        Sheno te gjitha prezente
                    </button>
                </p>

                <div class="fields">

                    <div>
                        <h3>Prezente: <span id="totalPrezente">0</span></h3>
                    </div>

                    <div>
                        <h3>Mungesa: <span id="totalMungesa">0</span></h3>
                    </div>

                    <div>
                        <h3>Me vonese: <span id="totalVonese">0</span></h3>
                    </div>

                </div>

                <div style="overflow-x:auto">

                    <table>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Volejbollistja</th>
                            <th>Pozicioni</th>
                            <th>Statusi</th>
                            <th>Shenime</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($lojtaret as $lojtar)

                            <tr>
                                <td>
                                    {{ $lojtar->numriFanelles }}
                                </td>

                                <td>
                                    <a href="{{ route('lojtar.show', $lojtar) }}">
                                        {{ $lojtar->emri }}
                                        {{ $lojtar->mbiemri }}
                                    </a>
                                </td>

                                <td>{{ $lojtar->pozicioni }}</td>

                                <td>

                                    <select class="status-prezence"
                                            name="prezencat[{{ $lojtar->id }}][statusi]"
                                            required>

                                        <option value="">
                                            Zgjedh statusin
                                        </option>

                                        @foreach([
                                            'Prezente',
                                            'Mungon',
                                            'Me vonese',
                                            'E arsyetuar'
                                        ] as $statusi)

                                            <option value="{{ $statusi }}"
                                                @selected(old(
                                                    'prezencat.'.$lojtar->id.'.statusi',
                                                    $prezencat->get($lojtar->id)?->statusi
                                                ) === $statusi)>

                                                {{ $statusi }}

                                            </option>

                                        @endforeach

                                    </select>

                                </td>

                                <td>
                                    <input
                                        name="prezencat[{{ $lojtar->id }}][shenime]"
                                        maxlength="500"
                                        value="{{ old(
                                            'prezencat.'.$lojtar->id.'.shenime',
                                            $prezencat->get($lojtar->id)?->shenime
                                        ) }}"
                                        placeholder="Shenime...">
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>

                </div>

                <p style="margin-top:25px">

                    <button type="submit">
                        Ruaj Prezencen
                    </button>

                </p>

            </form>

        @endif

    </div>

    <a class="btn"
       href="{{ route('stervitjet.show', $stervitja) }}">
        Kthehu te Stervitja
    </a>

    <script>
        const statuset = document.querySelectorAll(
            '.status-prezence'
        );

        function llogaritPrezencen() {
            let prezente = 0;
            let mungesa = 0;
            let vonese = 0;

            statuset.forEach(select => {
                if (select.value === 'Prezente') {
                    prezente++;
                }

                if (select.value === 'Mungon') {
                    mungesa++;
                }

                if (select.value === 'Me vonese') {
                    vonese++;
                }
            });

            document.getElementById('totalPrezente').textContent =
                prezente;

            document.getElementById('totalMungesa').textContent =
                mungesa;

            document.getElementById('totalVonese').textContent =
                vonese;
        }

        function shenoTeGjitha() {
            statuset.forEach(select => {
                select.value = 'Prezente';
            });

            llogaritPrezencen();
        }

        statuset.forEach(select => {
            select.addEventListener(
                'change',
                llogaritPrezencen
            );
        });

        if (document.getElementById('totalPrezente')) {
            llogaritPrezencen();
        }
    </script>

@endsection
