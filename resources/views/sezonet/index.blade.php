<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Sezonet - KV Gjinoci</title>
    <style>
        body {
            margin: 0;
            padding: 35px;
            font-family: Arial, sans-serif;
            background: #f3f5f9;
            color: #172b4d;
        }

        main {
            max-width: 1050px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        input, select {
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin: 12px 0 5px;
        }

        button {
            padding: 10px 16px;
            background: #253858;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .fields {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .fields input, .fields select {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #253858;
            color: white;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .error { color: #b91c1c; }
        .success { color: #15803d; }

        @media (max-width: 700px) {
            .fields {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<main>
    <h1>KV Gjinoci - Menaxhimi i Sezoneve</h1>

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

    <div class="card">
        <h2>Krijo Sezon te Ri</h2>

        <form method="POST" action="{{ route('sezonet.store') }}">
            @csrf

            <div class="fields">
                <div>
                    <label>Emri</label>
                    <input name="emri" type="text"
                           placeholder="2026/27"
                           value="{{ old('emri') }}" required>
                </div>

                <div>
                    <label>Data e Fillimit</label>
                    <input name="data_fillimit" type="date"
                           value="{{ old('data_fillimit') }}" required>
                </div>

                <div>
                    <label>Data e Mbarimit</label>
                    <input name="data_mbarimit" type="date"
                           value="{{ old('data_mbarimit') }}" required>
                </div>

                <div>
                    <label>Statusi</label>
                    <select name="aktiv">
                        <option value="1">Aktiv</option>
                        <option value="0"
                            @selected(old('aktiv') === '0')>
                            Joaktiv
                        </option>
                    </select>
                </div>
            </div>

            <p><button type="submit">Krijo Sezonin</button></p>
        </form>
    </div>

    <div class="card">
        <h2>Sezonet e Regjistruara</h2>

        <div style="overflow-x:auto">
            <table>
                <thead>
                <tr>
                    <th>Sezoni</th>
                    <th>Fillimi</th>
                    <th>Mbarimi</th>
                    <th>Statusi</th>
                    <th>Ndeshje</th>
                    <th>Veprimet</th>
                </tr>
                </thead>
                <tbody>
                @forelse($sezonet as $sezoni)
                    <tr>
                        <td>{{ $sezoni->emri }}</td>
                        <td>{{ $sezoni->data_fillimit->format('d.m.Y') }}</td>
                        <td>{{ $sezoni->data_mbarimit->format('d.m.Y') }}</td>
                        <td>
                            {{ $sezoni->aktiv ? 'Aktiv' : 'Joaktiv' }}
                        </td>
                        <td>{{ $sezoni->ndeshjet_count }}</td>
                        <td>
                            <div class="actions">
                                <button type="button"
                                        onclick="document.getElementById('edit-{{ $sezoni->id }}').hidden = !document.getElementById('edit-{{ $sezoni->id }}').hidden">
                                    Edito
                                </button>

                                @if($sezoni->ndeshjet_count === 0)
                                    <form method="POST"
                                          action="{{ route('sezonet.destroy', $sezoni) }}"
                                          onsubmit="return confirm('A je i sigurt?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Fshi</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr id="edit-{{ $sezoni->id }}" hidden>
                        <td colspan="6">
                            <form method="POST"
                                  action="{{ route('sezonet.update', $sezoni) }}">
                                @csrf
                                @method('PUT')

                                <div class="fields">
                                    <div>
                                        <label>Emri</label>
                                        <input name="emri"
                                               value="{{ $sezoni->emri }}"
                                               required>
                                    </div>
                                    <div>
                                        <label>Fillimi</label>
                                        <input name="data_fillimit"
                                               type="date"
                                               value="{{ $sezoni->data_fillimit->format('Y-m-d') }}"
                                               required>
                                    </div>
                                    <div>
                                        <label>Mbarimi</label>
                                        <input name="data_mbarimit"
                                               type="date"
                                               value="{{ $sezoni->data_mbarimit->format('Y-m-d') }}"
                                               required>
                                    </div>
                                    <div>
                                        <label>Statusi</label>
                                        <select name="aktiv">
                                            <option value="1"
                                                @selected($sezoni->aktiv)>
                                                Aktiv
                                            </option>
                                            <option value="0"
                                                @selected(!$sezoni->aktiv)>
                                                Joaktiv
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <p>
                                    <button type="submit">
                                        Ruaj Ndryshimet
                                    </button>
                                </p>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            Nuk ka sezona te regjistruara.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('dashboard') }}">
        Kthehu ne Dashboard
    </a>
</main>
</body>
</html>
