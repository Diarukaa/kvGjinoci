<div class="fields">

    <div>
        <label>Ekipi:</label>

        <select name="ekipi_id" required>
            <option value="">Zgjedh ekipin</option>

            @foreach($ekipet as $ekipi)
                <option value="{{ $ekipi->id }}"
                    @selected(old('ekipi_id', $stervitja->ekipi_id ?? '') == $ekipi->id)>
                    {{ $ekipi->emri }}
                    ({{ $ekipi->kategoria }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Trajneri:</label>

        <select name="trajner_id">
            <option value="">Pa trajner</option>

            @foreach($trajneret as $trajner)
                <option value="{{ $trajner->id }}"
                    @selected(old('trajner_id', $stervitja->trajner_id ?? '') == $trajner->id)>
                    {{ $trajner->emri }}
                    {{ $trajner->mbiemri }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Sezoni:</label>

        <select name="sezoni_id">
            <option value="">Pa sezon</option>

            @foreach($sezonet as $sezoni)
                <option value="{{ $sezoni->id }}"
                    @selected(old('sezoni_id', $stervitja->sezoni_id ?? '') == $sezoni->id)>
                    {{ $sezoni->emri }}
                    {{ $sezoni->aktiv ? '(Aktiv)' : '' }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Data:</label>

        <input type="date"
               name="data"
               value="{{ old('data',
                   isset($stervitja)
                       ? $stervitja->data->format('Y-m-d')
                       : '') }}"
               required>
    </div>

    <div>
        <label>Ora e Fillimit:</label>

        <input type="time"
               name="ora_fillimit"
               value="{{ old('ora_fillimit',
                   isset($stervitja)
                       ? substr($stervitja->ora_fillimit, 0, 5)
                       : '') }}"
               required>
    </div>

    <div>
        <label>Ora e Mbarimit:</label>

        <input type="time"
               name="ora_mbarimit"
               value="{{ old('ora_mbarimit',
                   isset($stervitja)
                       ? substr($stervitja->ora_mbarimit, 0, 5)
                       : '') }}"
               required>
    </div>

    <div>
        <label>Palestra:</label>

        <input name="palestra"
               value="{{ old('palestra', $stervitja->palestra ?? '') }}"
               placeholder="13 Qershori"
               required>
    </div>

    <div>
        <label>Lloji i Stervitjes:</label>

        <select name="lloji" required>

            @foreach(['Fizike', 'Teknike', 'Taktike', 'Miqesore', 'Rikuperim'] as $lloji)
                <option value="{{ $lloji }}"
                    @selected(old('lloji', $stervitja->lloji ?? '') === $lloji)>
                    {{ $lloji }}
                </option>
            @endforeach

        </select>
    </div>

    <div>
        <label>Statusi:</label>

        <select name="statusi" required>

            @foreach(['Planifikuar', 'Perfunduar', 'Anuluar'] as $statusi)
                <option value="{{ $statusi }}"
                    @selected(old('statusi', $stervitja->statusi ?? 'Planifikuar') === $statusi)>
                    {{ $statusi }}
                </option>
            @endforeach

        </select>
    </div>

</div>

<label>Pershkrimi i Stervitjes:</label>

<textarea name="pershkrimi"
          rows="5"
          maxlength="2000"
          style="width:100%;
                 padding:12px;
                 border:1px solid #cbd5e1;
                 border-radius:6px;
                 font-family:Arial;"
          placeholder="Ushtrimet, objektivat dhe shenimet e trajnerit...">{{ old('pershkrimi', $stervitja->pershkrimi ?? '') }}</textarea>

<p>
    <button type="submit">
        Ruaj Stervitjen
    </button>
</p>
