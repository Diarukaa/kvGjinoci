<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Edito Volejbollisten</title>
    <style>
        body { font-family: Arial; background: #f4f6fa; }
        .card {
            max-width: 500px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
        }
        label { display: block; margin-top: 15px; }
        input, select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #253858;
            color: white;
            border: 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="card">
    <h1>Edito Volejbollisten</h1>

    <form action="{{ route('lojtar.update', $lojtar) }}"
          method="POST">

        @csrf
        @method('PUT')

        @include('lojtar.form')
    </form>

    <p><a href="{{ route('lojtar.index') }}">Kthehu</a></p>
</div>
</body>
</html>
