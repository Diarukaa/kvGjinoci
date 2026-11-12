@extends('layouts.club')

@section('title', 'Lidh Ndeshjen me Ligen')

@section('content')

    <div class="card">
        <h1>Lidh Ndeshjen me Kampionatin</h1>

        <h2>
            {{ $ndeshja->ekipi->emri }}
            vs
            {{ $ndeshja->kundershtari }}
        </h2>

        <p>
            Data:
            {{ $ndeshja->data_ndeshjes->format('d.m.Y') }}
        </p>

        <p>
            Sezoni:
            {{ $ndeshja->sezoni?->emri ?? 'Pa sezon' }}
        </p>

        <p>
            Rezultati:
            <strong>
                {{ $ndeshja->setet_tona }}
                -
                {{ $ndeshja->setet_kundershtarit }}
            </strong>
        </p>
    </div>

    <div class="card">

        @if($ndeshja->rezultatiLiges)

            <h3>Ndeshja tashme eshte e lidhur!</h3>

            <a class="btn"
               href="{{ route('liga.index', $ndeshja->rezultatiLiges->kampionati_id) }}">
                Shiko Klasifikimin
            </a>

        @elseif($kampionatet->isEmpty())

            <h3>Nuk ka kampionate te pershtatshme.</h3>

            <p>
                Kontrollo sezonin, kategorine e ekipit
                dhe pjesemarrjen e KV Gjinocit ne kampionat.
            </p>

            <a href="{{ route('kampionatet.index') }}">
                Menaxho Kampionatet
            </a>

        @else

            <form method="POST"
                  action="{{ route('ndeshjet.lidh-ligen.store', $ndeshja) }}">

                @csrf

                <label>Kampionati:</label>

                <select name="kampionati_id"
                        id="kampionati_id" required>

                    <option value="">Zgjedh Kampionatin</option>

                    @foreach($kampionatet as $kampionati)
                        <option value="{{ $kampionati->id }}"
                            @selected(old('kampionati_id') == $kampionati->id)>
                            {{ $kampionati->emri }}
                            ({{ $kampionati->kategoria }})
                        </option>
                    @endforeach

                </select>

                <label>Klubi Kundershtar:</label>

                <select name="kundershtari_id"
                        id="kundershtari_id" required>

                    <option value="">Zgjedh Kundershtarin</option>

                </select>

                <p>
                    Zgjedh klubin qe korrespondon me:
                    <strong>{{ $ndeshja->kundershtari }}</strong>
                </p>

                <p>
                    <button type="submit">
                        Lidh me Kampionatin
                    </button>
                </p>

            </form>

        @endif

    </div>

    <a class="btn"
       href="{{ route('ndeshjet.show', $ndeshja) }}">
        Kthehu te Ndeshja
    </a>

    <script>
        const kampionatet = @json($kampionatet);
        const gjinociId = @json($gjinoci->id);
        const oldKundershtari = @json(old('kundershtari_id'));

        const kampionatiSelect =
            document.getElementById('kampionati_id');

        const kundershtariSelect =
            document.getElementById('kundershtari_id');

        function ngarkoKlubet() {
            if (!kampionatiSelect || !kundershtariSelect) {
                return;
            }

            const kampionati = kampionatet.find(k =>
                String(k.id) === kampionatiSelect.value
            );

            kundershtariSelect.replaceChildren(
                new Option('Zgjedh Kundershtarin', '')
            );

            if (!kampionati) {
                return;
            }

            kampionati.klubet.forEach(klubi => {
                if (Number(klubi.id) !== Number(gjinociId)) {
                    const option = new Option(
                        klubi.emri,
                        klubi.id
                    );

                    if (String(klubi.id) === String(oldKundershtari)) {
                        option.selected = true;
                    }

                    kundershtariSelect.add(option);
                }
            });
        }

        if (kampionatiSelect) {
            kampionatiSelect.addEventListener(
                'change',
                ngarkoKlubet
            );

            ngarkoKlubet();
        }
    </script>

@endsection
