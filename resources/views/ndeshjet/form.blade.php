@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<label>Sezoni:</label>

<select name="sezoni_id">
    <option value="">Pa sezon</option>

    @foreach($sezonet as $sezoni)
        <option value="{{ $sezoni->id }}"
            @selected(
                (string) old(
                    'sezoni_id',
                    $ndeshja->sezoni_id ?? ''
                ) === (string) $sezoni->id
            )>
            {{ $sezoni->emri }}
            {{ $sezoni->aktiv ? '(Aktiv)' : '' }}
        </option>
    @endforeach
</select>

<label>Ekipi:</label>
<select name="ekipi_id" required>
    <option value="">Zgjedh ekipin</option>
    @foreach($ekipet as $ekipi)
        <option value="{{ $ekipi->id }}"
            @selected(old('ekipi_id', $ndeshja->ekipi_id ?? '') == $ekipi->id)>
            {{ $ekipi->emri }}
        </option>
    @endforeach
</select>

<label>Kundershtari:</label>
<input type="text" name="kundershtari"
       value="{{ old('kundershtari', $ndeshja->kundershtari ?? '') }}"
       required>

<label>Data dhe Ora:</label>
<input type="datetime-local" name="data_ndeshjes"
       value="{{ old('data_ndeshjes', isset($ndeshja) ? $ndeshja->data_ndeshjes->format('Y-m-d\TH:i') : '') }}"
       required>

<label>Palestra:</label>
<input type="text" name="palestra"
       value="{{ old('palestra', $ndeshja->palestra ?? '') }}"
       required>

<label>Lokacioni:</label>
<select name="lokacioni" required>
    @foreach(['Vendas', 'Mysafir'] as $opsioni)
        <option value="{{ $opsioni }}"
            @selected(old('lokacioni', $ndeshja->lokacioni ?? '') === $opsioni)>
            {{ $opsioni }}
        </option>
    @endforeach
</select>

<label>Statusi:</label>
<select name="statusi" id="statusi" required>
    @foreach(['Planifikuar', 'Perfunduar'] as $statusi)
        <option value="{{ $statusi }}"
            @selected(old('statusi', $ndeshja->statusi ?? 'Planifikuar') === $statusi)>
            {{ $statusi }}
        </option>
    @endforeach
</select>

@php
    $savedSetet = isset($ndeshja)
        ? $ndeshja->setet->map(fn($s) => [
            'numri_setit' => $s->numri_setit,
            'piket_tona' => $s->piket_tona,
            'piket_kundershtarit' => $s->piket_kundershtarit,
        ])->values()->all()
        : [];

    $setet = old('setet', $savedSetet);
    $numriSeteve = old('numri_seteve', max(3, count($setet)));
@endphp

<div id="rezultatet">
    <h3>Rezultatet e Seteve</h3>

    <label>Numri i seteve:</label>
    <select id="numri_seteve" name="numri_seteve">
        @foreach([3, 4, 5] as $n)
            <option value="{{ $n }}"
                @selected((int)$numriSeteve === $n)>
                {{ $n }} sete
            </option>
        @endforeach
    </select>

    @for($i = 0; $i < 5; $i++)
        <div class="set-row" data-index="{{ $i }}">
            <h4>Seti {{ $i + 1 }}</h4>

            <input type="hidden"
                   name="setet[{{ $i }}][numri_setit]"
                   value="{{ $i + 1 }}">

            <label>Piket KV Gjinoci:</label>
            <input type="number" min="0" max="999"
                   name="setet[{{ $i }}][piket_tona]"
                   value="{{ $setet[$i]['piket_tona'] ?? '' }}">

            <label>Piket e Kundershtarit:</label>
            <input type="number" min="0" max="999"
                   name="setet[{{ $i }}][piket_kundershtarit]"
                   value="{{ $setet[$i]['piket_kundershtarit'] ?? '' }}">
        </div>
    @endfor
</div>

<button type="submit">Ruaj Ndeshjen</button>

<script>
    const statusi = document.getElementById('statusi');
    const numri = document.getElementById('numri_seteve');
    const rezultatet = document.getElementById('rezultatet');

    function ndryshoFormularin() {
        const perfunduar = statusi.value === 'Perfunduar';
        const aktiv = Number(numri.value);

        rezultatet.hidden = !perfunduar;

        document.querySelectorAll('.set-row').forEach(row => {
            const show = perfunduar &&
                Number(row.dataset.index) < aktiv;

            row.hidden = !show;

            row.querySelectorAll('input').forEach(input => {
                input.disabled = !show;

                if (input.type === 'number') {
                    input.required = show;
                }
            });
        });
    }

    statusi.addEventListener('change', ndryshoFormularin);
    numri.addEventListener('change', ndryshoFormularin);
    ndryshoFormularin();
</script>
