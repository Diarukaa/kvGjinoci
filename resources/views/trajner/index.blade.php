@extends('layouts.club')

@section('title', 'Trajneret - KV Gjinoci')

@section('content')

    <style>
        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            margin-bottom: 8px;
            color: #172b4d;
        }

        .page-title p {
            color: #64748b;
            margin: 0;
        }

        .trainer-summary {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .summary-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        }

        .summary-card p {
            color: #64748b;
            margin: 0 0 12px;
        }

        .summary-card h2 {
            font-size: 36px;
            margin: 0;
            color: #172b4d;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-form input {
            flex: 1;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            min-width: 0;
        }

        .trainer-name {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .trainer-avatar {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #e8effb;
            color: #253858;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .trainer-info small {
            display: block;
            color: #64748b;
            margin-top: 4px;
        }

        .trainer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .trainer-table th {
            background: #253858;
            color: white;
            padding: 16px;
            text-align: left;
        }

        .trainer-table td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .trainer-table tbody tr:hover {
            background: #f8fafc;
        }

        .trainer-table th:first-child {
            border-radius: 8px 0 0 0;
        }

        .trainer-table th:last-child {
            border-radius: 0 8px 0 0;
        }

        .trainer-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .trainer-actions form {
            margin: 0;
        }

        .trainer-actions .btn,
        .trainer-actions button {
            padding: 9px 14px;
            font-size: 14px;
        }

        .empty-state {
            padding: 35px !important;
            text-align: center !important;
            color: #64748b;
        }

        @media (max-width: 700px) {
            .trainer-summary {
                grid-template-columns: 1fr;
            }

            .search-form {
                flex-wrap: wrap;
            }

            .search-form input {
                flex-basis: 100%;
            }
        }

        .page-title {
            margin-bottom: 20px;
        }

        .page-title h1 {
            font-size: 30px;
            margin: 0 0 6px;
        }

        .trainer-summary {
            gap: 18px;
            margin-bottom: 20px;
        }

        .summary-card {
            padding: 18px 22px;
            border: 1px solid #e8edf5;
            border-radius: 15px;
        }

        .summary-card h2 {
            font-size: 32px;
        }

        .card {
            padding: 22px;
            margin-bottom: 20px;
            border-radius: 15px;
        }

        .card h2 {
            margin: 0 0 15px;
            font-size: 20px;
        }

        .search-form {
            gap: 10px;
        }

        .search-form input {
            padding: 11px 14px;
            background: #f8fafc;
            border-radius: 9px;
        }

        .trainer-table th {
            padding: 13px 14px;
            font-size: 13px;
        }

        .trainer-table td {
            padding: 13px 14px;
        }

        .trainer-actions .btn {
            background: #edf2f7;
            color: #253858;
            border-radius: 7px;
        }

        .trainer-actions .danger {
            background: #fff0f0;
            color: #dc2626;
            border: none;
            border-radius: 7px;
        }
    </style>

    <div class="page-title">
        <h1>Menaxhimi i Trajnereve</h1>

        <p>
            Menaxho stafin profesional
            te klubit KV Gjinoci.
        </p>
    </div>

    <div class="trainer-summary">

        <div class="summary-card">
            <p>Total Trajnere</p>

            <h2>{{ $totalTrajnere }}</h2>
        </div>

        <div class="summary-card">
            <p>Regjistro nje trajner te ri</p>

            <a class="btn"
               href="{{ route('trajner.create') }}">
                + Shto Trajner
            </a>
        </div>

    </div>

    <div class="card">

        <h2>Kerko Trajner</h2>

        <form method="GET"
              action="{{ route('trajner.index') }}"
              class="search-form">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Kerko sipas emrit, mbiemrit ose emailit...">

            <button type="submit">
                Kerko
            </button>

            <a href="{{ route('trajner.index') }}">
                Pastro
            </a>

        </form>

    </div>

    <div class="card">

        <h2>Lista e Trajnereve</h2>

        <p style="color:#64748b">
            Trajneret e regjistruar ne sistem.
        </p>

        <div style="overflow-x:auto">

            <table class="trainer-table">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Trajneri</th>
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

                        <td>
                            <div class="trainer-name">

                                <div class="trainer-avatar">
                                    {{ mb_strtoupper(
                                        mb_substr($trajner->emri, 0, 1) .
                                        mb_substr($trajner->mbiemri, 0, 1)
                                    ) }}
                                </div>

                                <div class="trainer-info">

                                    <strong>
                                        {{ $trajner->emri }}
                                        {{ $trajner->mbiemri }}
                                    </strong>

                                    <small>Trajner</small>

                                </div>

                            </div>
                        </td>

                        <td>
                            {{ $trajner->email }}
                        </td>

                        <td>
                            {{ $trajner->nrTelefonit }}
                        </td>

                        <td>
                            {{ $trajner->vendbanimi }}
                        </td>

                        <td>

                            <div class="trainer-actions">

                                <a class="btn"
                                   href="{{ route('trajner.edit', $trajner) }}">
                                    Edito
                                </a>

                                <form method="POST"
                                      action="{{ route('trajner.destroy', $trajner) }}"
                                      onsubmit="return confirm('A je i sigurt qe deshiron ta fshish trajnerin?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="danger">
                                        Fshi
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6"
                            class="empty-state">

                            Nuk ka trajner te regjistruar.

                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div style="margin-top:25px">

            {{ $trajneret->appends(request()->query())->links() }}

        </div>

    </div>

@endsection
