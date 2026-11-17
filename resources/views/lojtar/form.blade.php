<style>
    /* KV GJINOCI - PLAYER FORM */

    .kg-player-form {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
        color: #172b4d;
        font-family: Arial, sans-serif;
    }

    .kg-player-form * {
        box-sizing: border-box;
    }

    .kg-player-field {
        display: flex;
        flex-direction: column;
        min-width: 0;
        gap: 9px;
    }

    .kg-player-field label {
        display: block;
        margin: 0;
        color: #253858;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.5;
    }

    .kg-player-required {
        color: #dc2626;
    }

    .kg-player-field > input,
    .kg-player-field > select {
        display: block;
        width: 100%;
        min-width: 0;
        height: 48px;
        padding: 11px 14px;
        margin: 0;
        border: 1px solid #d5deeb;
        border-radius: 9px;
        background: #f8fafc;
        color: #172b4d;
        font-family: inherit;
        font-size: 14px;
        line-height: normal;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .kg-player-field > input:focus,
    .kg-player-field > select:focus {
        background: #ffffff;
        border-color: #315b89;
        box-shadow: 0 0 0 3px rgba(49, 91, 137, .1);
    }

    .kg-player-field > input::placeholder {
        color: #94a3b8;
    }

    .kg-player-field > select {
        cursor: pointer;
    }

    .kg-player-field > input.is-invalid,
    .kg-player-field > select.is-invalid {
        border-color: #dc2626;
        background: #fff7f7;
    }

    .kg-player-error {
        display: block;
        color: #dc2626;
        font-size: 12px;
        line-height: 1.5;
    }

    .kg-player-help {
        display: block;
        color: #64748b;
        font-size: 11px;
        line-height: 1.6;
    }

    .kg-player-full {
        grid-column: 1 / -1;
    }

    /* Existing phone input component */

    .kg-player-form .kg-phone-group {
        margin: 0;
        width: 100%;
    }

    .kg-player-form .kg-phone-label {
        margin-bottom: 9px;
    }

    .kg-player-form .kg-phone-wrapper {
        min-height: 48px;
        width: 100%;
    }

    .kg-player-form .kg-phone-wrapper .kg-phone-number {
        min-width: 0;
        width: 100%;
    }

    @media (max-width: 700px) {
        .kg-player-form {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .kg-player-full {
            grid-column: auto;
        }
    }
</style>

<div class="kg-player-form">

    {{-- EMRI --}}

    <div class="kg-player-field">
        <label for="kg-emri">
            Emri
            <span class="kg-player-required">*</span>
        </label>

        <input
            type="text"
            id="kg-emri"
            name="emri"
            value="{{ old('emri', $lojtar->emri ?? '') }}"
            placeholder="Shkruaj emrin"
            autocomplete="given-name"
            maxlength="100"
            class="@error('emri') is-invalid @enderror"
            required
        >

        @error('emri')
        <span class="kg-player-error">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- MBIEMRI --}}

    <div class="kg-player-field">
        <label for="kg-mbiemri">
            Mbiemri
            <span class="kg-player-required">*</span>
        </label>

        <input
            type="text"
            id="kg-mbiemri"
            name="mbiemri"
            value="{{ old('mbiemri', $lojtar->mbiemri ?? '') }}"
            placeholder="Shkruaj mbiemrin"
            autocomplete="family-name"
            maxlength="100"
            class="@error('mbiemri') is-invalid @enderror"
            required
        >

        @error('mbiemri')
        <span class="kg-player-error">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- EMAIL --}}

    <div class="kg-player-field">
        <label for="kg-email">
            Email
            <span class="kg-player-required">*</span>
        </label>

        <input
            type="email"
            id="kg-email"
            name="email"
            value="{{ old('email', $lojtar->email ?? '') }}"
            placeholder="email@example.com"
            autocomplete="email"
            maxlength="255"
            class="@error('email') is-invalid @enderror"
            required
        >

        @error('email')
        <span class="kg-player-error">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- DATA E LINDJES --}}

    <div class="kg-player-field">
        <label for="kg-data-lindjes">
            Data e Lindjes
            <span class="kg-player-required">*</span>
        </label>

        <input
            type="date"
            id="kg-data-lindjes"
            name="dataELindjes"
            value="{{ old(
                'dataELindjes',
                !empty($lojtar->dataELindjes)
                    ? \Carbon\Carbon::parse($lojtar->dataELindjes)->format('Y-m-d')
                    : ''
            ) }}"
            class="@error('dataELindjes') is-invalid @enderror"
            required
        >

        @error('dataELindjes')
        <span class="kg-player-error">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- TELEFONI --}}

    <div class="kg-player-field kg-player-full">
        <x-phone-input
            :value="$lojtar->nrTelefonit ?? ''"
        />
    </div>

    {{-- VENDBANIMI --}}

    <div class="kg-player-field">
        <label for="kg-vendbanimi">
            Vendbanimi
            <span class="kg-player-required">*</span>
        </label>

        <input
            type="text"
            id="kg-vendbanimi"
            name="vendbanimi"
            value="{{ old('vendbanimi', $lojtar->vendbanimi ?? '') }}"
            placeholder="Shkruaj vendbanimin"
            maxlength="150"
            class="@error('vendbanimi') is-invalid @enderror"
            required
        >

        @error('vendbanimi')
        <span class="kg-player-error">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- NUMRI I FANELLES --}}

    <div class="kg-player-field">
        <label for="kg-fanella">
            Numri i Fanelles
            <span class="kg-player-required">*</span>
        </label>

        <input
            type="number"
            id="kg-fanella"
            name="numriFanelles"
            min="1"
            max="99"
            step="1"
            value="{{ old('numriFanelles', $lojtar->numriFanelles ?? '') }}"
            placeholder="P.sh. 11"
            class="@error('numriFanelles') is-invalid @enderror"
            required
        >

        @error('numriFanelles')
        <span class="kg-player-error">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- POZICIONI --}}

    <div class="kg-player-field">
        <label for="kg-pozicioni">
            Pozicioni
            <span class="kg-player-required">*</span>
        </label>

        <select
            id="kg-pozicioni"
            name="pozicioni"
            class="@error('pozicioni') is-invalid @enderror"
            required
        >
            @foreach([
                'Setter',
                'Libero',
                'Outside Hitter',
                'Opposite Hitter',
                'Middle Blocker'
            ] as $pozicioni)
                <option
                    value="{{ $pozicioni }}"
                    @selected(
                        old(
                            'pozicioni',
                            $lojtar->pozicioni ?? ''
                        ) === $pozicioni
                    )
                >
                    {{ $pozicioni }}
                </option>
            @endforeach
        </select>

        @error('pozicioni')
        <span class="kg-player-error">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- GJATESIA --}}

    <div class="kg-player-field">
        <label for="kg-gjatesia">
            Gjatesia (cm)
        </label>

        <input
            type="number"
            id="kg-gjatesia"
            name="gjatesia"
            min="100"
            max="250"
            step="1"
            value="{{ old('gjatesia', $lojtar->gjatesia ?? '') }}"
            placeholder="P.sh. 178"
            class="@error('gjatesia') is-invalid @enderror"
        >

        @error('gjatesia')
        <span class="kg-player-error">
                {{ $message }}
            </span>
        @enderror
    </div>

    {{-- EKIPI --}}

    <div class="kg-player-field">
        <label for="kg-ekipi">
            Ekipi
        </label>

        <select
            id="kg-ekipi"
            name="ekipi_id"
            class="@error('ekipi_id') is-invalid @enderror"
        >
            <option value="">
                Pa ekip
            </option>

            @foreach($ekipet as $ekipi)
                <option
                    value="{{ $ekipi->id }}"
                    @selected(
                        old(
                            'ekipi_id',
                            $lojtar->ekipi_id ?? ''
                        ) == $ekipi->id
                    )
                >
                    {{ $ekipi->emri }}
                    ({{ $ekipi->kategoria }})
                </option>
            @endforeach
        </select>

        @error('ekipi_id')
        <span class="kg-player-error">
                {{ $message }}
            </span>
        @enderror
    </div>

</div>
