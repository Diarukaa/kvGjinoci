@extends('layouts.club')

@section('title', 'Perdoruesit - KV Gjinoci')

@section('content')

    <style>
        .users-page {
            max-width: 1150px;
            margin: 0 auto;
            padding: 12px 0 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .users-page * {
            box-sizing: border-box;
        }

        .u-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .u-header h1 {
            font-size: 30px;
            margin: 0 0 9px;
        }

        .u-header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .u-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #253858;
            color: white !important;
            padding: 12px 18px;
            border-radius: 9px;
            border: 0;
            text-decoration: none !important;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .u-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .u-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .u-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        .u-btn-danger {
            background: #fff1f2;
            color: #dc2626 !important;
        }

        .u-hero {
            background: linear-gradient(
                120deg,
                #172b4d,
                #315b89
            );
            padding: 28px;
            border-radius: 18px;
            color: white;
            display: flex;
            align-items: center;
            gap: 22px;
            margin-bottom: 25px;
        }

        .u-hero-icon {
            width: 75px;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 17px;
            flex-shrink: 0;
        }

        .u-hero small {
            display: block;
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 9px;
        }

        .u-hero h2 {
            color: white !important;
            font-size: 26px;
            margin: 0 0 10px;
        }

        .u-hero p {
            color: #dbeafe;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        .u-stats {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 16px;
            margin-bottom: 25px;
        }

        .u-stat {
            background: white;
            padding: 23px;
            border: 1px solid #e5ebf3;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .u-stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .u-stat-icon {
            width: 38px;
            height: 38px;
            background: #edf4ff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .u-stat h3 {
            font-size: 30px;
            margin: 0;
            color: #172b4d;
        }

        .u-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .u-card h2 {
            font-size: 21px;
            margin: 0 0 10px;
        }

        .u-card p {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 22px;
        }

        .u-search {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .u-search input {
            flex: 1;
            width: 100%;
            min-width: 0;
            height: 44px;
            padding: 12px 15px;
            border: 1px solid #dbe3ee;
            background: #f8fafc;
            border-radius: 9px;
            outline: none;
            font-size: 13px;
        }

        .u-search input:focus {
            border-color: #2563eb;
        }

        .u-table-wrap {
            overflow-x: auto;
            border-radius: 11px;
        }

        .users-page table {
            width: 100%;
            border-collapse: collapse;
            min-width: 730px;
        }

        .users-page th {
            background: #253858;
            color: white;
            text-align: left;
            font-size: 12px;
            padding: 16px;
            white-space: nowrap;
        }

        .users-page td {
            padding: 16px;
            border-bottom: 1px solid #e5ebf3;
            font-size: 13px;
            vertical-align: middle;
        }

        .users-page tbody tr:hover {
            background: #f8fafc;
        }

        .u-person {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .u-avatar {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e8efff;
            color: #253858;
            font-weight: bold;
            font-size: 15px;
            flex-shrink: 0;
        }

        .u-person strong {
            display: block;
            margin-bottom: 5px;
        }

        .u-person small {
            color: #64748b;
            font-size: 11px;
        }

        .u-role {
            display: inline-flex;
            padding: 7px 11px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .u-role-admin {
            background: #e0e7ff;
            color: #4338ca;
        }

        .u-role-manager {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .u-role-coach {
            background: #dcfce7;
            color: #166534;
        }

        .u-role-player {
            background: #f3e8ff;
            color: #7e22ce;
        }

        .u-role-pending {
            background: #fef3c7;
            color: #b45309;
        }

        .u-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .u-actions form {
            margin: 0;
        }

        .u-actions .u-btn {
            padding: 9px 12px;
            font-size: 12px;
        }

        .u-message {
            padding: 15px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .u-success {
            background: #dcfce7;
            color: #166534;
        }

        .u-error {
            background: #fff1f2;
            color: #be123c;
        }

        .u-empty {
            text-align: center;
            padding: 40px !important;
            color: #64748b;
        }

        .u-pagination {
            margin-top: 20px;
        }

        .u-pagination svg {
            width: 18px;
            height: 18px;
        }

        @media (max-width: 800px) {
            .u-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .u-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 500px) {
            .u-stats {
                grid-template-columns: 1fr;
            }

            .u-card {
                padding: 17px;
            }

            .u-search {
                flex-wrap: wrap;
            }

            .u-search input {
                flex: 0 0 100%;
            }

            .u-hero {
                padding: 20px;
            }

            .u-hero-icon {
                display: none;
            }
        }
    </style>

    @php
        $roleNames = [
            'admin' => 'Administrator',
            'manager' => 'Menaxher',
            'coach' => 'Trajner',
            'player' => 'Volejbolliste',
            'pending' => 'Joaktiv',
        ];
    @endphp

    <div class="users-page">

        <div class="u-header">

            <div>
                <h1>Menaxhimi i Perdoruesve</h1>

                <p>
                    Menaxho llogarite dhe qasjen
                    ne sistemin KV Gjinoci.
                </p>
            </div>

            <a href="{{ route('users.create') }}"
               class="u-btn">
                + Shto Perdorues
            </a>

        </div>

        @if(session('success'))
            <div class="u-message u-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="u-message u-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="u-hero">

            <div class="u-hero-icon">
                🔐
            </div>

            <div>
                <small>KV GJINOCI | ADMINISTRATION</small>

                <h2>Qasja dhe Siguria e Sistemit</h2>

                <p>
                    Krijo llogari, cakto rolet dhe
                    kontrollo kush ka qasje ne
                    modulet e klubit.
                </p>
            </div>

        </div>

        <div class="u-stats">

            @foreach([
                ['Total Perdorues', $totalUsers, '👥'],
                ['Administratore', $totalAdmins, '🛡️'],
                ['Menaxhere', $totalManagers, '💼'],
                ['Trajnere', $totalCoaches, '📋'],
                ['Volejbolliste', $totalPlayers, '🏐'],
                ['Llogari Joaktive', $totalPending, '🔒']
            ] as [$label, $total, $icon])

                <div class="u-stat">

                    <div class="u-stat-top">
                        <span>{{ $label }}</span>

                        <div class="u-stat-icon">
                            {{ $icon }}
                        </div>
                    </div>

                    <h3>{{ $total }}</h3>

                </div>

            @endforeach

        </div>

        <div class="u-card">

            <h2>Kerko Perdorues</h2>

            <form method="GET"
                  action="{{ route('users.index') }}"
                  class="u-search">

                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Kerko sipas emrit ose emailit...">

                <button type="submit" class="u-btn">
                    Kerko
                </button>

                <a href="{{ route('users.index') }}"
                   class="u-btn u-btn-gray">
                    Pastro
                </a>

            </form>

        </div>

        <div class="u-card">

            <h2>Llogarite e Sistemit</h2>

            <p>
                Lista e perdoruesve dhe roleve
                te regjistruara.
            </p>

            <div class="u-table-wrap">

                <table>

                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Perdoruesi</th>
                        <th>Email</th>
                        <th>Roli</th>
                        <th>Regjistruar</th>
                        <th>Veprimet</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($users as $user)

                        <tr>

                            <td>{{ $user->id }}</td>

                            <td>
                                <div class="u-person">

                                    <div class="u-avatar">
                                        {{ mb_strtoupper(
                                            mb_substr($user->name, 0, 1)
                                        ) }}
                                    </div>

                                    <div>
                                        <strong>
                                            {{ $user->name }}
                                        </strong>

                                        <small>
                                            @if($user->id === auth()->id())
                                                Llogaria jote
                                            @else
                                                Perdorues i sistemit
                                            @endif
                                        </small>
                                    </div>

                                </div>
                            </td>

                            <td>{{ $user->email }}</td>

                            <td>
                                <span class="u-role u-role-{{ $user->role }}">
                                    {{ $roleNames[$user->role] ?? 'I panjohur' }}
                                </span>
                            </td>

                            <td>
                                {{ $user->created_at?->format('d.m.Y') ?? '-' }}
                            </td>

                            <td>

                                <div class="u-actions">

                                    <a href="{{ route('users.edit', $user) }}"
                                       class="u-btn u-btn-gray">
                                        Edito
                                    </a>

                                    @if($user->id !== auth()->id())

                                        <form method="POST"
                                              action="{{ route('users.destroy', $user) }}"
                                              onsubmit="return confirm('A je i sigurt qe deshiron ta fshish kete perdorues?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="u-btn u-btn-danger">
                                                Fshi
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="u-empty">
                                Nuk ka perdorues te gjetur.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="u-pagination">
                {{ $users->links() }}
            </div>

        </div>

        <a href="{{ route('dashboard') }}"
           class="u-btn u-btn-gray">
            ← Kthehu ne Dashboard
        </a>

    </div>

@endsection
