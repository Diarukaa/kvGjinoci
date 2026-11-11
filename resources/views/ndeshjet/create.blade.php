<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Shto Ndeshje - KV Gjinoci</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f5f9;
        }
        .card {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
        }
        label {
            display: block;
            margin-top: 15px;
        }
        input, select {
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
            border-radius: 8px;
        }
        [hidden] { display: none !important; }
    </style>
</head>
<body>
<div class="card">
    <h1>Shto Ndeshje</h1>

    <form method="POST" action="{{ route('ndeshjet.store') }}">
        @csrf
        @include('ndeshjet.form')
    </form>

    <p><a href="{{ route('ndeshjet.index') }}">Kthehu</a></p>
</div>
</body>
</html>
