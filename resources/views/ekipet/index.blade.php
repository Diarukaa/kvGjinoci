<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Ekipet - KV Gjinoci</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            padding: 35px;
        }
        main { max-width: 1100px; margin: auto; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 20px;
        }
        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th { background: #253858; color: white; }
        .btn {
            display: inline-block;
            background: #253858;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 6px;
        }
        .actions form { display: inline; }
        .actions a { margin-right: 12px; }
        .success { color: green; }
    </style>
</head>
<body>
<main>
    <h1>KV Gjinoci - Menaxhimi i Ekipeve</h1>

    <a class="btn" href="{{ route('ekipet.create') }}">
        + Shto Ekip
    </a>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Emri</th>
            <th>Kategoria</th>
            <th>Trajneri</th>
            <th>Volejbolliste</th>
            <th>Veprimet</th>
        </tr>
        </thead>
        <tbody>
        @forelse($ekipet as $ekipi)
            <tr>
                <td>{{ $ekipi->id }}</td>
                <td>{{ $ekipi->emri }}</td>
                <td>{{ $ekipi->kategoria }}</td>
                <td>
                    {{ $ekipi->trajner?->emri ?? '-' }}
                    {{ $ekipi->trajner?->mbiemri ?? '' }}
                </td>
                <td>{{ $ekipi->lojtaret_count }}</td>
                <td class="actions">
                    <a href="{{ route('ekipet.show', $ekipi) }}">
                        View
                    </a>
                    <a href="{{ route('ekipet.edit', $ekipi) }}">
                        Edit
                    </a>
                    <form method="POST"
                          action="{{ route('ekipet.destroy', $ekipi) }}"
                          onsubmit="return confirm('A je i sigurt?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">
                    Nuk ka ekipe te regjistruara.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px">
        {{ $ekipet->links() }}
    </div>

    <p><a href="{{ route('dashboard') }}">Dashboard</a></p>
</main>
</body>
</html>
