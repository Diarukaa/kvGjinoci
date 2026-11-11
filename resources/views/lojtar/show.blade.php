<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Profili i Volejbollistes</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6fa;
            padding: 40px;
        }
        .profile {
            max-width: 650px;
            background: white;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
        }
        .number {
            font-size: 48px;
            color: #253858;
            font-weight: bold;
        }
        .detail {
            padding: 12px 0;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
<div class="profile">
    <h1>Profili i Volejbollistes</h1>

    <div class="number">
        #{{ $lojtar->numriFanelles }}
    </div>

    <h2>{{ $lojtar->emri }} {{ $lojtar->mbiemri }}</h2>

    <div class="detail">
        <strong>Pozicioni:</strong> {{ $lojtar->pozicioni }}
    </div>

    <div class="detail">
        <strong>Gjatesia:</strong> {{ $lojtar->gjatesia ?? '-' }} cm
    </div>

    <div class="detail">
        <strong>Data e Lindjes:</strong> {{ $lojtar->dataELindjes }}
    </div>

    <div class="detail">
        <strong>Email:</strong> {{ $lojtar->email }}
    </div>

    <div class="detail">
        <strong>Ekipi:</strong>

        @if($lojtar->ekipi)
            <a href="{{ route('ekipet.show', $lojtar->ekipi) }}">
                {{ $lojtar->ekipi->emri }}
            </a>
        @else
            Pa ekip
        @endif
    </div>

    <div class="detail">
        <strong>Vendbanimi:</strong> {{ $lojtar->vendbanimi }}
    </div>

    <p>
        <a href="{{ route('lojtar.edit', $lojtar) }}">
            Edito
        </a>
    </p>

    <a href="{{ route('lojtar.index') }}">
        Kthehu te Lista
    </a>

</div>
</body>
</html>
