<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Statistikat Individuale - KV Gjinoci</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f5f9;
            margin: 0;
            padding: 30px;
        }

        .card {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h1 {
            color: #253858;
        }

        label {
            display: block;
            margin-top: 18px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            box-sizing: border-box;
        }

        button {
            background: #253858;
            color: white;
            padding: 13px 22px;
            border: none;
            border-radius: 6px;
            margin-top: 24px;
            cursor: pointer;
        }

        .error {
            color: #b91c1c;
        }

        .info {
            background: #eff6ff;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
<div class="card">

    <h1>Statistikat e Volejbollistes</h1>

    <div class="info">
        <strong>{{ $ndeshja->ekipi->emri }}</strong>
        vs
        <strong>{{ $ndeshja->kundershtari }}</strong>

        <p>
            {{ $ndeshja->data_ndeshjes->format('d.m.Y') }}
        </p>
    </div>

    @if($errors->any())
        <ul class="error">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if($lojtaret->isEmpty())
        <p>
            Nuk ka volejbolliste te regjistruara
            ne kete ekip.
        </p>
    @else

        <form method="POST"
              action="{{ route('statistikat-lojtareve.store', $ndeshja) }}">

            @csrf

            <label>Volejbollistja:</label>

            <select name="lojtar_id" id="lojtar_id" required>
                <option value="">Zgjedh volejbollisten</option>

                @foreach($lojtaret as $lojtar)
                    <option value="{{ $lojtar->id }}"
                        @selected(old('lojtar_id') == $lojtar->id)>
                        #{{ $lojtar->numriFanelles }}
                        {{ $lojtar->emri }}
                        {{ $lojtar->mbiemri }}
                    </option>
                @endforeach
            </select>

            <label>Kills (Sulme me pike):</label>
            <input type="number" name="kills"
                   id="kills" min="0" max="999"
                   value="{{ old('kills', 0) }}" required>

            <label>Aces (Servime direkte):</label>
            <input type="number" name="aces"
                   id="aces" min="0" max="999"
                   value="{{ old('aces', 0) }}" required>

            <label>Blocks (Blloqe me pike):</label>
            <input type="number" name="blocks"
                   id="blocks" min="0" max="999"
                   value="{{ old('blocks', 0) }}" required>

            <label>Digs (Mbrojtje):</label>
            <input type="number" name="digs"
                   id="digs" min="0" max="999"
                   value="{{ old('digs', 0) }}" required>

            <h3>
                Piket individuale:
                <span id="total">0</span>
            </h3>

            <button type="submit">Ruaj Statistikat</button>
        </form>

    @endif

    <p>
        <a href="{{ route('ndeshjet.show', $ndeshja) }}">
            Kthehu te Ndeshja
        </a>
    </p>
</div>

<script>
    const statistikat = @json($statistikat);
    const playerSelect = document.getElementById('lojtar_id');

    const fields = ['kills', 'aces', 'blocks', 'digs'];
    const total = document.getElementById('total');

    function calculateTotal() {
        const kills = Number(document.getElementById('kills').value) || 0;
        const aces = Number(document.getElementById('aces').value) || 0;
        const blocks = Number(document.getElementById('blocks').value) || 0;

        total.textContent = kills + aces + blocks;
    }

    if (playerSelect) {
        playerSelect.addEventListener('change', function () {
            const stats = statistikat[this.value] || {};

            fields.forEach(field => {
                document.getElementById(field).value =
                    stats[field] ?? 0;
            });

            calculateTotal();
        });

        fields.forEach(field => {
            document.getElementById(field)
                .addEventListener('input', calculateTotal);
        });

        @if(!old('lojtar_id'))
        playerSelect.dispatchEvent(new Event('change'));
        @else
        calculateTotal();
        @endif
    }
</script>

</body>
</html>
