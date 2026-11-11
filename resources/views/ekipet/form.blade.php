@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<label>Emri i Ekipit:</label>
<input type="text" name="emri"
       value="{{ old('emri', $ekipi->emri ?? '') }}"
       required>

<label>Kategoria:</label>
<select name="kategoria" required>
    @foreach(['Senior', 'U18', 'U16', 'U14'] as $kategoria)
        <option value="{{ $kategoria }}"
            @selected(old('kategoria', $ekipi->kategoria ?? '') === $kategoria)>
            {{ $kategoria }}
        </option>
    @endforeach
</select>

<label>Trajneri:</label>
<select name="trajner_id">
    <option value="">Pa trajner</option>

    @foreach($trajneret as $trajner)
        <option value="{{ $trajner->id }}"
            @selected(old('trajner_id', $ekipi->trajner_id ?? '') == $trajner->id)>
            {{ $trajner->emri }} {{ $trajner->mbiemri }}
        </option>
    @endforeach
</select>

<button type="submit">Ruaj Ekipin</button>
