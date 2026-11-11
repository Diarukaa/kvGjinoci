<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Edito Ekipin</title>
    <style>
        body { font-family: Arial; background: #f4f6fa; }
        .card {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
        }
        label { display: block; margin-top: 18px; }
        input, select {
            display: block;
            width: 100%;
            padding: 11px;
            box-sizing: border-box;
        }
        button {
            margin-top: 24px;
            padding: 12px 20px;
            background: #253858;
            border: none;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="card">
    <h1>Edito Ekipin</h1>

    <form method="POST"
          action="{{ route('ekipet.update', $ekipi) }}">
        @csrf
        @method('PUT')
        @include('ekipet.form')
    </form>

    <p><a href="{{ route('ekipet.index') }}">Kthehu</a></p>
</div>
</body>
</html>
