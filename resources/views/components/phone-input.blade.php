@props([
    'value' => '',
    'name' => 'nrTelefonit'
])

<style>
    .kg-phone-group {
        margin-bottom: 18px;
        width: 100%;
    }

    .kg-phone-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #172b4d;
        margin-bottom: 9px;
    }

    .kg-phone-wrapper {
        display: flex;
        align-items: stretch;
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        background: #f8fafc;
        overflow: hidden;
        box-sizing: border-box;
    }

    .kg-phone-wrapper:focus-within {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,.10);
    }

    .kg-phone-prefix {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 13px 15px;
        background: #edf2f7;
        color: #172b4d;
        font-weight: 600;
        font-size: 14px;
        border-right: 1px solid #cbd5e1;
        white-space: nowrap;
    }

    .kg-phone-wrapper .kg-phone-number {
        flex: 1;
        min-width: 0;
        width: 100%;
        padding: 13px 14px;
        border: none;
        outline: none;
        background: white;
        font-size: 14px;
        color: #172b4d;
        margin: 0;
        border-radius: 0;
        box-sizing: border-box;
    }

    .kg-phone-help {
        display: block;
        font-size: 12px;
        color: #64748b;
        margin-top: 7px;
    }

    .kg-phone-error {
        color: #dc2626;
        font-size: 12px;
        margin-top: 6px;
    }
</style>

<div class="kg-phone-group">

    <label class="kg-phone-label"
           for="display-{{ $name }}">
        Numri i Telefonit
    </label>

    <div class="kg-phone-wrapper">

        <span class="kg-phone-prefix">
            🇽🇰 +383
        </span>

        <input
            type="tel"
            id="display-{{ $name }}"
            class="kg-phone-number"
            placeholder="44 123 456"
            inputmode="numeric"
            autocomplete="tel-national"
            data-phone-display
            required
        >

        <input
            type="hidden"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            data-phone-full
        >

    </div>

    <small class="kg-phone-help">
        Shembull: 44 123 456
    </small>

    @error($name)
    <div class="kg-phone-error">
        {{ $message }}
    </div>
    @enderror

</div>

<script>
    (() => {
        const group = document.currentScript
            .previousElementSibling;

        const display = group.querySelector(
            '[data-phone-display]'
        );

        const full = group.querySelector(
            '[data-phone-full]'
        );

        function normalize(value) {
            let number = value.replace(/\D/g, '');

            if (number.startsWith('00383')) {
                number = number.slice(5);
            } else if (number.startsWith('383')) {
                number = number.slice(3);
            }

            if (number.startsWith('0')) {
                number = number.slice(1);
            }

            return number;
        }

        function updateNumber() {
            const number = normalize(display.value);

            display.value = number;

            if (/^4[0-9]{7}$/.test(number)) {
                full.value = '+383' + number;
                display.setCustomValidity('');
            } else {
                full.value = '';

                display.setCustomValidity(
                    'Shkruaj nje numer valid me 8 shifra, p.sh. 44123456.'
                );
            }
        }

        display.value = normalize(full.value);

        if (display.value !== '') {
            updateNumber();
        }

        display.addEventListener(
            'input',
            updateNumber
        );

        display.addEventListener(
            'blur',
            updateNumber
        );
    })();
</script>
