<div class="fields">

    <div>
        <label>Klubi Vendas:</label>

        <select name="klubi_vendas_id" required>
            <option value="">Zgjedh klubin</option>

            @foreach($klubet as $klubi)
                <option value="{{ $klubi->id }}"
                    @selected(old(
                        'klubi_vendas_id',
                        $ndeshja->klubi_vendas_id ?? ''
                    ) == $klubi->id)>
                    {{ $klubi->emri }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Klubi Mysafir:</label>

        <select name="klubi_mysafir_id" required>
            <option value="">Zgjedh klubin</option>

            @foreach($klubet as $klubi)
                <option value="{{ $klubi->id }}"
                    @selected(old(
                        'klubi_mysafir_id',
                        $ndeshja->klubi_mysafir_id ?? ''
                    ) == $klubi->id)>
                    {{ $klubi->emri }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Data e Ndeshjes:</label>

        <input type="date"
               name="data_ndeshjes"
               value="{{ old(
                   'data_ndeshjes',
                   isset($ndeshja)
                       ? $ndeshja->data_ndeshjes->format('Y-m-d')
                       : ''
               ) }}"
               required>
    </div>

    <div>
        <label>Setet Vendas:</label>

        <input type="number"
               name="setet_vendas"
               min="0" max="3"
               value="{{ old(
                   'setet_vendas',
                   $ndeshja->setet_vendas ?? 0
               ) }}"
               required>
    </div>

    <div>
        <label>Setet Mysafir:</label>

        <input type="number"
               name="setet_mysafir"
               min="0" max="3"
               value="{{ old(
                   'setet_mysafir',
                   $ndeshja->setet_mysafir ?? 0
               ) }}"
               required>
    </div>

</div>

<p>
    <button type="submit">Ruaj Rezultatin</button>
</p>
