<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Lista e Trajnereve</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f6fa;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #253858;
            color: white;
        }
        a, button {
            padding: 8px 12px;
            cursor: pointer;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>

<h1>Lista e Trajnereve</h1>

<h3>Total Trajnere: {{ $totalTrajnere }}</h3>

<a href="{{ route('trajner.create') }}">
    + Shto Trajner
</a>


<form action="{{ route('trajner.index') }}"
      method="GET"
      style="margin: 20px 0;">

    <input type="text"
           name="search"
           placeholder="Kerko trajner..."
           value="{{ request('search') }}">

    <button type="submit">Kerko</button>

    <a href="{{ route('trajner.index') }}">
        Pastro
    </a>
</form>

@if(session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Emri</th>
        <th>Mbiemri</th>
        <th>Email</th>
        <th>Telefoni</th>
        <th>Vendbanimi</th>
        <th>Veprimet</th>
    </tr>
    </thead>
    <tbody>
    @forelse($trajneret as $trajner)
        <tr>
            <td>{{ $trajner->id }}</td>
            <td>{{ $trajner->emri }}</td>
            <td>{{ $trajner->mbiemri }}</td>
            <td>{{ $trajner->email }}</td>
            <td>{{ $trajner->nrTelefonit }}</td>
            <td>{{ $trajner->vendbanimi }}</td>
            <td>
                <a href="{{ route('trajner.edit', $trajner) }}">
                    Edit
                </a>

                <form action="{{ route('trajner.destroy', $trajner) }}"
                      method="POST"
                      style="display:inline"
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
                Nuk ka trajnere te regjistruar.
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
<div style="margin-top:20px;">
    {{ $trajneret->links() }}
</div>
</body>
</html>
