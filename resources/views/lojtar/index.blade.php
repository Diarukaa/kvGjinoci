<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>KV Gjinoci - Volejbollistet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            padding: 35px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
        }
        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn {
            background: #253858;
            color: white;
            padding: 10px 15px;
            border: 0;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 20px;
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
        .search {
            padding: 10px;
            width: 260px;
        }
        .success { color: green; }
        .actions form { display: inline; }
        .actions a { margin-right: 10px; }
    </style>
</head>
<body>
<div class="container">

    <div class="top">
        <div>
            <h1>KV Gjinoci - Volejbollistet</h1>
            <h3>Total: {{ $totalLojtare }}</h3>
        </div>

        <a class="btn" href="{{ route('lojtar.create') }}">
            + Shto Volejbolliste
        </a>
    </div>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <form method="GET" action="{{ route('lojtar.index') }}">
        <input class="search"
               type="text"
               name="search"
               placeholder="Kerko volejbolliste..."
               value="{{ request('search') }}">

        <button type="submit" class="btn">Kerko</button>
        <a href="{{ route('lojtar.index') }}">Pastro</a>
    </form>

    <table>
        <thead>
        <tr>
            <th>Nr.</th>
            <th>Emri</th>
            <th>Mbiemri</th>
            <th>Pozicioni</th>
            <th>Gjatesia</th>
            <th>Email</th>
            <th>Veprimet</th>
        </tr>
        </thead>
        <tbody>
        @forelse($lojtaret as $lojtar)
            <tr>
                <td>{{ $lojtar->numriFanelles }}</td>
                <td>{{ $lojtar->emri }}</td>
                <td>{{ $lojtar->mbiemri }}</td>
                <td>{{ $lojtar->pozicioni }}</td>
                <td>{{ $lojtar->gjatesia ?? '-' }} cm</td>
                <td>{{ $lojtar->email }}</td>
                <td class="actions">
                    <a href="{{ route('lojtar.show', $lojtar) }}">
                        View
                    </a>

                    <a href="{{ route('lojtar.edit', $lojtar) }}">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('lojtar.destroy', $lojtar) }}"
                          onsubmit="return confirm('A je i sigurt?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">
                    Nuk ka volejbolliste te regjistruara.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px">
        {{ $lojtaret->links() }}
    </div>

    <p>
        <a href="{{ route('dashboard') }}">
            Kthehu ne Dashboard
        </a>
    </p>
</div>
</body>
</html>
