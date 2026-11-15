@php
    $editing = isset($transaksioni) && $transaksioni->exists;

    $selectedType = old(
        'lloji',
        $transaksioni->lloji ?? 'Hyrje'
    );

    $selectedCategory = old(
        'kategoria',
        $transaksioni->kategoria ?? ''
    );
@endphp

<form method="POST"
      action="{{ $editing
        ? route('financat.transaksionet.update', $transaksioni)
        : route('financat.transaksionet.store') }}">

    @csrf

    @if($editing)
        @method('PUT')
    @endif

    <div class="tf-grid">

        <div>
            <label for="lloji">Lloji i Transaksionit</label>

            <select name="lloji" id="lloji" required>
                <option value="Hyrje"
                    @selected($selectedType === 'Hyrje')>
                    Te hyra
                </option>

                <option value="Shpenzim"
                    @selected($selectedType === 'Shpenzim')>
                    Shpenzim
                </option>
            </select>
        </div>

        <div>
            <label for="kategoria">Kategoria</label>

            <select name="kategoria"
                    id="kategoria"
                    required>

                <option value="">Zgjedh kategorine</option>

                @foreach($kategorite[$selectedType] ?? [] as $kategori)

                    <option value="{{ $kategori }}"
                        @selected($selectedCategory === $kategori)>
                        {{ $kategori }}
                    </option>

                @endforeach

            </select>
        </div>

        <div>
            <label for="shuma">Shuma (€)</label>

            <input type="number"
                   name="shuma"
                   id="shuma"
                   min="0.01"
                   step="0.01"
                   value="{{ old('shuma', $transaksioni->shuma ?? '') }}"
                   placeholder="0.00"
                   required>
        </div>

        <div>
            <label for="data">Data</label>

            <input type="date"
                   name="data"
                   id="data"
                   max="{{ now()->format('Y-m-d') }}"
                   value="{{ old('data',
                       isset($transaksioni)
                           ? $transaksioni->data->format('Y-m-d')
                           : now()->format('Y-m-d')
                   ) }}"
                   required>
        </div>

        <div>
            <label for="metoda_pageses">Metoda e Pageses</label>

            <select name="metoda_pageses"
                    id="metoda_pageses"
                    required>

                @foreach(['Banke', 'Cash'] as $metoda)

                    <option value="{{ $metoda }}"
                        @selected(old(
                            'metoda_pageses',
                            $transaksioni->metoda_pageses ?? 'Banke'
                        ) === $metoda)>

                        {{ $metoda }}

                    </option>

                @endforeach

            </select>
        </div>

        <div>
            <label for="referenca">Referenca / Fatura</label>

            <input type="text"
                   name="referenca"
                   id="referenca"
                   value="{{ old('referenca', $transaksioni->referenca ?? '') }}"
                   placeholder="FAT-001">
        </div>

        <div class="tf-full">
            <label for="pershkrimi">Pershkrimi</label>

            <input type="text"
                   name="pershkrimi"
                   id="pershkrimi"
                   maxlength="255"
                   value="{{ old('pershkrimi', $transaksioni->pershkrimi ?? '') }}"
                   placeholder="P.sh. Sponsorizim nga kompania ABC"
                   required>
        </div>

        <div class="tf-full">
            <label for="shenime">Shenime shtese</label>

            <textarea name="shenime"
                      id="shenime">{{ old('shenime', $transaksioni->shenime ?? '') }}</textarea>
        </div>

    </div>

    <div class="tf-actions">

        <button type="submit" class="tf-btn">
            {{ $editing
                ? 'Ruaj Ndryshimet'
                : 'Regjistro Transaksionin' }}
        </button>

        @if($editing)

            <a href="{{ route('financat.transaksionet.index', [
                'muaji' => $transaksioni->data->month,
                'viti' => $transaksioni->data->year
            ]) }}" class="tf-btn tf-btn-light">

                Anulo

            </a>

        @endif

    </div>

</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const kategorite = @json($kategorite);

        const lloji = document.getElementById('lloji');

        const kategoria = document.getElementById('kategoria');

        lloji.addEventListener('change', function () {

            kategoria.replaceChildren();

            kategoria.add(
                new Option('Zgjedh kategorine', '')
            );

            (kategorite[lloji.value] || []).forEach(function (emri) {

                kategoria.add(new Option(emri, emri));

            });

        });

    });
</script>
