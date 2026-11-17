@extends('layouts.club')

@section('title', 'Trajneret - KV Gjinoci')

@section('content')

    <style>
        .trainers-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .trainers-page * {
            box-sizing: border-box;
        }

        /* HEADER */

        .trainers-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }

        .trainers-header h1 {
            margin: 0 0 6px;
            color: #172b4d;
            font-size: 29px;
            font-weight: 800;
            line-height: 1.3;
        }

        .trainers-header p {
            margin: 0;
            color: #64748b;
            font-size: 13px;
        }

        .trainers-add-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 43px;
            padding: 11px 17px;
            background: #253858;
            color: #ffffff !important;
            border: 1px solid #253858;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none !important;
            white-space: nowrap;
            transition: background .15s ease;
        }

        .trainers-add-button:hover {
            background: #345276;
            border-color: #345276;
        }

        /* MAIN PANEL */

        .trainers-panel {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            overflow: hidden;
        }

        /* SEARCH */

        .trainers-toolbar {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .trainers-search-form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .trainers-search-input {
            flex: 1;
            min-width: 200px;
            height: 44px;
            padding: 11px 14px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #172b4d;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            transition: border-color .15s ease,
            box-shadow .15s ease;
        }

        .trainers-search-input:focus {
            border-color: #315b89;
            box-shadow: 0 0 0 3px rgba(49, 91, 137, .1);
        }

        .trainers-search-input::placeholder {
            color: #94a3b8;
        }

        .trainers-search-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 44px;
            padding: 0 20px;
            background: #253858;
            color: #ffffff;
            border: 0;
            border-radius: 9px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: background .15s ease;
        }

        .trainers-search-button:hover {
            background: #345276;
        }

        .trainers-clear-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 44px;
            padding: 0 17px;
            background: #edf2fa;
            color: #253858 !important;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none !important;
        }

        .trainers-clear-button:hover {
            background: #dfe8f7;
        }

        /* LIST HEADER */

        .trainers-list-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .trainers-list-header h2 {
            margin: 0;
            color: #172b4d;
            font-size: 17px;
            font-weight: 750;
        }

        .trainers-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #64748b;
            background: #f1f5f9;
            border-radius: 8px;
            padding: 8px 11px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* TABLE */

        .trainers-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .trainers-table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        .trainers-table thead {
            background: #f8fafc;
        }

        .trainers-table th {
            padding: 15px 20px;
            color: #64748b;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .2px;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        .trainers-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #edf2f7;
            color: #334155;
            font-size: 12px;
            vertical-align: middle;
        }

        .trainers-table tbody tr:last-child td {
            border-bottom: none;
        }

        .trainers-table tbody tr:hover {
            background: #fafcff;
        }

        .trainers-table .id-cell {
            color: #94a3b8;
            font-size: 11px;
            font-weight: 600;
            width: 65px;
        }

        /* TRAINER */

        .trainer-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 180px;
        }

        .trainer-profile-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #e8efff;
            color: #253858;
            font-size: 12px;
            font-weight: 800;
        }

        .trainer-profile-info {
            min-width: 0;
        }

        .trainer-profile-info strong {
            display: block;
            color: #172b4d;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .trainer-profile-info small {
            display: block;
            margin-top: 4px;
            color: #94a3b8;
            font-size: 11px;
        }

        .trainer-email {
            color: #475569;
            overflow-wrap: anywhere;
        }

        .trainer-phone {
            color: #475569;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .trainer-location {
            color: #475569;
            overflow-wrap: anywhere;
        }

        .trainer-empty-value {
            color: #94a3b8;
        }

        /* ACTIONS */

        .trainer-row-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .trainer-row-actions form {
            margin: 0;
        }

        .trainer-edit-button,
        .trainer-delete-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 62px;
            height: 34px;
            padding: 0 11px;
            border: 0;
            border-radius: 7px;
            font-family: inherit;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none !important;
            cursor: pointer;
            transition: background .15s ease;
        }

        .trainer-edit-button {
            background: #edf2fa;
            color: #253858 !important;
        }

        .trainer-edit-button:hover {
            background: #dfe8f7;
        }

        .trainer-delete-button {
            background: #fff1f2;
            color: #be123c;
        }

        .trainer-delete-button:hover {
            background: #ffe4e6;
        }

        /* EMPTY STATE */

        .trainers-empty {
            padding: 55px 20px !important;
            text-align: center;
        }

        .trainers-empty strong {
            display: block;
            color: #172b4d;
            font-size: 15px;
            margin-bottom: 7px;
        }

        .trainers-empty p {
            margin: 0;
            color: #64748b;
            font-size: 12px;
        }

        /* PAGINATION */

        .trainers-pagination {
            padding: 15px 20px;
            border-top: 1px solid #e2e8f0;
        }

        /* MOBILE */

        @media (max-width: 700px) {
            .trainers-header {
                align-items: flex-start;
            }

            .trainers-header h1 {
                font-size: 25px;
            }

            .trainers-toolbar {
                padding: 15px;
            }

            .trainers-search-input {
                flex-basis: 100%;
            }

            .trainers-search-button,
            .trainers-clear-button {
                flex: 1;
            }

            .trainers-list-header {
                padding: 16px;
            }

            .trainers-table th,
            .trainers-table td {
                padding: 13px 14px;
            }

            .trainers-pagination {
                padding: 12px;
            }
        }
    </style>

    <div class="trainers-page">

        {{-- HEADER --}}

        <div class="trainers-header">

            <div>
                <h1>Trajneret</h1>

                <p>
                    Menaxhimi i trajnerëve të klubit KV Gjinoci.
                </p>
            </div>

            <a
                href="{{ route('trajner.create') }}"
                class="trainers-add-button"
            >
                <span aria-hidden="true">+</span>
                Shto Trajner
            </a>

        </div>

        {{-- PANELI KRYESOR --}}

        <div class="trainers-panel">

            {{-- KERKIMI --}}

            <div class="trainers-toolbar">

                <form
                    method="GET"
                    action="{{ route('trajner.index') }}"
                    class="trainers-search-form"
                >

                    <input
                        type="search"
                        name="search"
                        class="trainers-search-input"
                        value="{{ request('search') }}"
                        placeholder="Kerko sipas emrit, mbiemrit ose emailit..."
                        maxlength="100"
                        aria-label="Kerko trajner"
                    >

                    <button
                        type="submit"
                        class="trainers-search-button"
                    >
                        Kerko
                    </button>

                    <a
                        href="{{ route('trajner.index') }}"
                        class="trainers-clear-button"
                    >
                        Pastro
                    </a>

                </form>

            </div>

            {{-- LISTA E TRAJNEREVE --}}

            <div class="trainers-list-header">

                <h2>Lista e Trajnereve</h2>

                <span class="trainers-count">
                {{ $trajneret->total() }}
                    {{ $trajneret->total() === 1
                        ? 'trajner'
                        : 'trajnere' }}
            </span>

            </div>

            <div class="trainers-table-wrapper">

                <table class="trainers-table">

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

                        @php
                            $emri = trim(
                                (string) $trajner->emri
                            );

                            $mbiemri = trim(
                                (string) $trajner->mbiemri
                            );

                            $initials = mb_strtoupper(
                                mb_substr($emri, 0, 1) .
                                mb_substr($mbiemri, 0, 1)
                            );
                        @endphp

                        <tr>

                            {{-- ID --}}

                            <td class="id-cell">
                                #{{ $trajner->id }}
                            </td>

                            {{-- EMRI --}}

                            <td>
                                <div class="trainer-profile">

                                    <div class="trainer-profile-avatar">
                                        {{ $initials ?: 'TR' }}
                                    </div>

                                    <div class="trainer-profile-info">

                                        <strong>
                                            {{ $emri }}
                                            {{ $mbiemri }}
                                        </strong>

                                        <small>
                                            Trajner
                                        </small>

                                    </div>

                                </div>
                            </td>

                            {{-- EMAIL --}}

                            <td>
                                @if($trajner->email)
                                    <span class="trainer-email">
                                        {{ $trajner->email }}
                                    </span>
                                @else
                                    <span class="trainer-empty-value">
                                        —
                                    </span>
                                @endif
                            </td>

                            {{-- TELEFONI --}}

                            <td>
                                @if($trajner->nrTelefonit)
                                    <span class="trainer-phone">
                                        {{ $trajner->nrTelefonit }}
                                    </span>
                                @else
                                    <span class="trainer-empty-value">
                                        —
                                    </span>
                                @endif
                            </td>

                            {{-- VENDBANIMI --}}

                            <td>
                                @if($trajner->vendbanimi)
                                    <span class="trainer-location">
                                        {{ $trajner->vendbanimi }}
                                    </span>
                                @else
                                    <span class="trainer-empty-value">
                                        —
                                    </span>
                                @endif
                            </td>

                            {{-- VEPRIMET --}}

                            <td>
                                <div class="trainer-row-actions">

                                    <a
                                        href="{{ route(
                                            'trajner.edit',
                                            $trajner
                                        ) }}"
                                        class="trainer-edit-button"
                                    >
                                        Edito
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'trajner.destroy',
                                            $trajner
                                        ) }}"
                                        onsubmit="return confirm('A je i sigurt qe deshiron ta fshish trajnerin?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="trainer-delete-button"
                                        >
                                            Fshi
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="6"
                                class="trainers-empty"
                            >

                                <strong>
                                    Nuk u gjet asnje trajner.
                                </strong>

                                <p>
                                    @if(request()->filled('search'))
                                        Provo nje emer tjeter
                                        ose pastro kerkimin.
                                    @else
                                        Regjistro trajnerin e pare
                                        per te filluar.
                                    @endif
                                </p>

                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}

            @if($trajneret->hasPages())

                <div class="trainers-pagination">
                    {{ $trajneret
                        ->appends(request()->query())
                        ->links() }}
                </div>

            @endif

        </div>

    </div>

@endsection
