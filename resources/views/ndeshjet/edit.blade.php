<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Edito Ndeshjen</title>
    <style>
        body { font-family: Arial; background: #f3f5f9; }
        .card {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            background: white;
        }
        label { display: block; margin-top: 15px; }
        input, select {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
        }
        button {
            margin-top: 25px;
            background: #253858;
            color: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
        }
        .set-row {
            background: #f3f5f9;
            padding: 15px;
            margin-top: 12px;
        }
        [hidden] { display: none !important; }
    </style>
</head>
<body>
<div class="card">
    <h1>Edito Ndeshjen</h1>

    <form method="POST"
          action="{{ route('ndeshjet.update', $ndeshja) }}">
        @csrf
        @method('PUT')
        @include('ndeshjet.form')
    </form>

    <p><a href="{{ route('ndeshjet.index') }}">Kthehu</a></p>
</div>
</body>
</html>
