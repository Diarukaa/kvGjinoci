<div class="fields">

    <div>
        <label>Emri:</label>

        <input type="text"
               name="emri"
               value="{{ old('emri', $manager->emri ?? '') }}"
               required>
    </div>

    <div>
        <label>Mbiemri:</label>

        <input type="text"
               name="mbiemri"
               value="{{ old('mbiemri', $manager->mbiemri ?? '') }}"
               required>
    </div>

    <div>
        <label>Email:</label>

        <input type="email"
               name="email"
               value="{{ old('email', $manager->email ?? '') }}"
               required>
    </div>

    <div>

        <label for="dataELindjes">
            Data e Lindjes:
        </label>

        <input
            type="date"
            name="dataELindjes"
            id="dataELindjes"
            value="{{ old('dataELindjes',
            !empty($manager->dataELindjes)
                ? \Carbon\Carbon::parse($manager->dataELindjes)->format('Y-m-d')
                : ''
        ) }}"
            required
        >

        @error('dataELindjes')
        <span style="color: red;">
            {{ $message }}
        </span>
        @enderror

    </div>

    <div>
        <x-phone-input :value="$manager->nrTelefonit ?? ''" />
    </div>

    <div>
        <label>Vendbanimi:</label>

        <input type="text"
               name="vendbanimi"
               value="{{ old('vendbanimi', $manager->vendbanimi ?? '') }}"
               required>
    </div>

</div>

<p style="margin-top:25px">

    <button type="submit">
        Ruaj Menaxherin
    </button>

</p>
