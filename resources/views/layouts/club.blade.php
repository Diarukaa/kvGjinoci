<!DOCTYPE html>
<html lang="sq">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/club-ui.css') }}">

    <title>@yield('title', 'KV Gjinoci')</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f5f9;
            color: #172b4d;
        }

        header {
            background: #172b4d;
            color: white;
            padding: 22px 35px;
        }

        header h2 { margin: 0 0 15px; }

        nav {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
        }

        nav a {
            color: white;
            text-decoration: none;
        }

        main {
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 12px;
            margin-bottom: 5px;
        }

        input, select {
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            width: 100%;
        }

        input[type="checkbox"] {
            width: auto;
        }

        button, .btn {
            display: inline-block;
            background: #253858;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            border: 0;
            cursor: pointer;
            text-decoration: none;
        }

        .danger { background: #b91c1c; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #253858;
            color: white;
        }

        .fields {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .club-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .success { color: #15803d; }
        .error { color: #b91c1c; }

        @media (max-width: 700px) {
            .fields, .club-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

@include('partials.navbar')

<main>
    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul class="error">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @yield('content')
</main>

</body>
</html>
