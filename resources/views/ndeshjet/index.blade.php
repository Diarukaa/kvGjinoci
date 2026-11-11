<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Ndeshjet - KV Gjinoci</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f5f9;
            padding: 35px;
        }
        main { max-width: 1200px; margin: auto; }
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            text-align: left;
            padding: 14px;
            border-bottom: 1px solid #ddd;
        }
        th { background: #253858; color: white; }
        .btn {
            background: #253858;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
        }
        .actions form { display: inline; }
        .actions a { margin-right: 8px; }
        .success { color: green; }
    </style>
</head>
<body>
<main>
    <h1>KV Gjinoci - Ndeshjet</h1>

    <a class="btn" href="{{ route('ndeshjet.create') }}">
        + Shto Ndeshje
    </a>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
        <tr>
            <th>Data</th>
            <th>Ekipi</th>
            <th>Kundershtari</th>
            <th>Lokacioni</th>
            <th>Rezultati</th>
            <th>Statusi</th>
            <th>Veprimet</th>
        </tr>
        </thead>
        <tbody>
        @forelse($ndeshjet as $ndeshja)
            <tr>
                <td>
                    {{ $ndeshja->data_ndeshjes->format('d.m.Y H:i') }}
                </td>

                <td>{{ $ndeshja->ekipi->emri }}</td>
                <td>{{ $ndeshja->kundershtari }}</td>
                <td>{{ $ndeshja->lokacioni }}</td>

                <td>
                    @if($ndeshja->statusi === 'Perfunduar')
                        <strong>
                            {{ $ndeshja->setet_tona }}
                            -
                            {{ $ndeshja->setet_kundershtarit }}
                        </strong>
                    @else
                        -
                    @endif
                </td>

                <td>{{ $ndeshja->statusi }}</td>

                <td class="actions">
                    <a href="{{ route('ndeshjet.show', $ndeshja) }}">
                        View
                    </a>
                    <a href="{{ route('ndeshjet.edit', $ndeshja) }}">
                        Edit
                    </a>

                    <form method="POST"
                          action="{{ route('ndeshjet.destroy', $ndeshja) }}"
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
                    Nuk ka ndeshje te regjistruara.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px">
        {{ $ndeshjet->links() }}
    </div>

    <p>
        <a href="{{ route('dashboard') }}">
            Kthehu ne Dashboard
        </a>
    </p>
</main>
</body>
</html>
