@extends('layouts.club')

@section('title', 'Perdoruesit - KV Gjinoci')

@section('content')

    <style>
        .ul-page {
            max-width: 1250px;
            margin: 20px auto 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .ul-hero {
            background: linear-gradient(120deg,#172b4d,#315b89);
            color: white;
            border-radius: 18px;
            padding: 32px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .ul-hero h1 {
            color: white !important;
            margin: 13px 0;
        }

        .ul-hero p {
            color: #dbeafe;
            font-size: 14px;
            margin: 0;
        }

        .ul-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .ul-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
        }

        .ul-page table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        .ul-page th {
            background: #253858;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 12px;
        }

        .ul-page td {
            padding: 17px 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .ul-page tbody tr:hover {
            background: #f8fafc;
        }

        .ul-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .ul-avatar {
            width: 40px;
            height: 40px;
            background: #e8efff;
            color: #253858;
            border-radius: 10px;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
        }

        .ul-badge {
            display: inline-block;
            background: #e8efff;
            color: #315b89;
            border-radius: 7px;
            padding: 7px 11px;
            font-size: 11px;
            font-weight: bold;
        }

        .ul-green {
            background: #dcfce7;
            color: #15803d;
        }

        .ul-orange {
            background: #fff7ed;
            color: #c2410c;
        }

        .ul-purple {
            background: #f3e8ff;
            color: #7e22ce;
        }

        .ul-gray {
            background: #edf2f7;
            color: #64748b;
        }

        .ul-btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 11px 16px;
            background: #253858;
            color: white !important;
            border: none;
            border-radius: 8px;
            text-decoration: none !important;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            white-space: nowrap;
        }

        .ul-btn-light {
            background: #e8efff;
            color: #315b89 !important;
        }

        .ul-btn-white {
            background: white;
            color: #172b4d !important;
        }

        .ul-btn-delete {
            background: #fee2e2;
            color: #b91c1c !important;
        }

        .ul-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ul-actions form {
            margin: 0;
        }

        .ul-success {
            padding: 16px;
            background: #dcfce7;
            color: #166534;
            border-radius: 10px;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .ul-error {
            padding: 16px;
            background: #fff1f2;
            color: #be123c;
            border-radius: 10px;
            margin-bottom: 22px;
            font-size: 13px;
        }

        @media(max-width: 650px) {
            .ul-hero {
                flex-wrap: wrap;
                padding: 22px;
            }

            .ul-card {
                padding: 17px;
            }
        }
    </style>

    @php
        $roleLabels = [
            'admin' => 'Administrator',
            'manager' => 'Menaxher',
            'coach' => 'Trajner',
            'player' => 'Volejbolliste',
            'pending' => 'Ne pritje'
        ];
    @endphp

    <div class="ul-page">

        <div class="ul-hero">

            <div>

                <small style="color:#bfdbfe;letter-spacing:1.5px;">
                    KV GJINOCI | USER MANAGEMENT
                </small>

                <h1>Menaxhimi i Perdoruesve</h1>

                <p>
                    Menaxho llogarite, rolet dhe
                    lidhjet me profilet e klubit.
                </p>

            </div>

            <a href="{{ route('users.create') }}"
               class="ul-btn ul-btn-white">

                + Shto Perdorues

            </a>

        </div>

        @if(session('success'))

            <div class="ul-success">
                {{ session('success') }}
            </div>

        @endif

        @if($errors->any())

            <div class="ul-error">

                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif

        <div class="ul-card">

            <h2 style="margin-top:0;">
                Lista e Perdoruesve
            </h2>

            <p style="color:#64748b;font-size:13px;margin-bottom:24px;">

                Total: {{ $users->total() }} llogari ne sistem.

            </p>

            <div class="ul-table-wrap">

                <table>

                    <thead>

                    <tr>
                        <th>Perdoruesi</th>
                        <th>Email</th>
                        <th>Roli</th>
                        <th>Profili i Lidhur</th>
                        <th>Statusi</th>
                        <th>Veprimet</th>
                    </tr>

                    </thead>

                    <tbody>

                    @forelse($users as $user)

                        @php
                            $profile = match($user->role) {
                                'coach' => $user->trajner,
                                'player' => $user->lojtar,
                                'manager' => $user->manager,
                                default => null
                            };

                            $needsProfile = in_array(
                                $user->role,
                                ['coach','player','manager']
                            );

                            $roleClass = match($user->role) {
                                'admin' => 'ul-purple',
                                'manager' => '',
                                'coach' => 'ul-green',
                                'player' => '',
                                default => 'ul-gray'
                            };
                        @endphp

                        <tr>

                            <td>

                                <div class="ul-user">

                                    <div class="ul-avatar">

                                        {{ mb_strtoupper(
                                            mb_substr($user->name, 0, 1)
                                        ) }}

                                    </div>

                                    <div>

                                        <strong>{{ $user->name }}</strong>

                                        @if($user->id === auth()->id())

                                            <div style="color:#64748b;font-size:11px;">
                                                Llogaria jote
                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </td>

                            <td>{{ $user->email }}</td>

                            <td>

                                <span class="ul-badge {{ $roleClass }}">

                                    {{ $roleLabels[$user->role]
                                        ?? $user->role }}

                                </span>

                            </td>

                            <td>

                                @if($profile)

                                    <strong>

                                        {{ $profile->emri }}
                                        {{ $profile->mbiemri }}

                                    </strong>

                                @elseif($needsProfile)

                                    <span class="ul-badge ul-orange">

                                        Pa profil

                                    </span>

                                @else

                                    <span style="color:#64748b;">
                                        -
                                    </span>

                                @endif

                            </td>

                            <td>

                                @if($user->role === 'pending')

                                    <span class="ul-badge ul-gray">

                                        Joaktiv

                                    </span>

                                @else

                                    <span class="ul-badge ul-green">

                                        Aktiv

                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="ul-actions">

                                    <a href="{{ route('users.edit', $user) }}"
                                       class="ul-btn ul-btn-light">

                                        Edito

                                    </a>

                                    @if($user->id !== auth()->id())

                                        <form method="POST"
                                              action="{{ route('users.destroy', $user) }}"
                                              onsubmit="return confirm('A je i sigurt qe deshiron ta fshish kete llogari?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="ul-btn ul-btn-delete">

                                                Fshi

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                style="text-align:center;padding:35px;color:#64748b;">

                                Nuk ka perdorues te regjistruar.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div style="margin-top:24px;">

                {{ $users->links() }}

            </div>

        </div>

    </div>

@endsection
