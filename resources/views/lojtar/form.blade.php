@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<label>Emri:</label>
<input type="text" name="emri"
       value="{{ old('emri', $lojtar->emri ?? '') }}" required>

<label>Mbiemri:</label>
<input type="text" name="mbiemri"
       value="{{ old('mbiemri', $lojtar->mbiemri ?? '') }}" required>

<label>Email:</label>
<input type="email" name="email"
       value="{{ old('email', $lojtar->email ?? '') }}" required>

<label>Data e Lindjes:</label>
<input type="date" name="dataELindjes"
       value="{{ old('dataELindjes', $lojtar->dataELindjes ?? '') }}"
       required>

<label>Telefoni:</label>
<input type="number" name="nrTelefonit"
       value="{{ old('nrTelefonit', $lojtar->nrTelefonit ?? '') }}"
       required>

<label>Vendbanimi:</label>
<input type="text" name="vendbanimi"
       value="{{ old('vendbanimi', $lojtar->vendbanimi ?? '') }}"
       required>

<label>Numri i Fanelles:</label>
<input type="number" name="numriFanelles"
       min="1" max="99"
       value="{{ old('numriFanelles', $lojtar->numriFanelles ?? '') }}"
       required>

<label>Pozicioni:</label>
<select name="pozicioni" required>
    @foreach([
        'Setter',
        'Libero',
        'Outside Hitter',
        'Opposite Hitter',
        'Middle Blocker'
    ] as $pozicioni)
        <option value="{{ $pozicioni }}"
            @selected(old('pozicioni', $lojtar->pozicioni ?? '') === $pozicioni)>
            {{ $pozicioni }}
        </option>
    @endforeach
</select>

<label>Gjatesia (cm):</label>
<input type="number" name="gjatesia"
       min="100" max="250"
       value="{{ old('gjatesia', $lojtar->gjatesia ?? '') }}">

<button type="submit">Ruaj</button>
