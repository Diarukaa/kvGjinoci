@extends('layouts.club')

@section('title', 'Menaxheret - KV Gjinoci')

@section('content')

    <style>
        /* MAIN PAGE */

        .managers-page {
            max-width: 1400px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .managers-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .managers-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .managers-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .managers-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* BUTTONS */

        .manager-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 12px 18px;
            background: #253858;
            color: white !important;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .manager-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .manager-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .manager-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        .manager-btn-danger {
            background: #fff0f0;
            color: #dc2626 !important;
        }

        /* STATISTICS */

        .manager-stats {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 18px;
            margin-bottom: 25px;
        }

        .manager-stat {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 15px;
            padding: 23px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .manager-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .manager-stat-label {
            color: #64748b;
            font-size: 13px;
        }

        .manager-stat-icon {
            width: 44px;
            height: 44px;
            background: #e8efff;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            flex-shrink: 0;
        }

        .manager-icon-green {
            background: #dcfce7;
        }

        .manager-icon-purple {
            background: #f1eaff;
        }

        .manager-stat h2 {
            font-size: 36px;
            color: #172b4d;
            margin: 16px 0 7px;
        }

        .manager-stat small {
            color: #64748b;
            font-size: 12px;
        }

        /* STAFF HERO CARD */

        .manager-hero {
            background: linear-gradient(
                130deg,
                #172b4d,
                #315b89
            );

            border-radius: 16px;
            padding: 26px;
            color: white;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .manager-hero::after {
            content: "👥";
            position: absolute;
            right: 10px;
            bottom: -40px;
            font-size: 180px;
            opacity: .10;
            pointer-events: none;
        }

        .manager-hero-content {
            position: relative;
            z-index: 1;
        }

        .manager-hero-label {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            color: #bfdbfe;
        }

        .manager-hero h2 {
            font-size: 25px;
            color: white !important;
            margin: 12px 0 9px;
        }

        .manager-hero p {
            color: #dbeafe !important;
            font-size: 13px;
            margin: 0 0 20px;
            line-height: 1.7;
            max-width: 650px;
        }

        .manager-hero .manager-btn {
            background: white;
            color: #253858 !important;
        }

        /* CONTENT CARDS */

        .manager-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            border: 1px solid #e5ebf3;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .manager-card h2 {
            font-size: 22px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .manager-description {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0 0 22px;
        }

        /* SEARCH */

        .manager-search-form {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .manager-search-input-wrap {
            position: relative;
            flex: 1;
            min-width: 200px;
        }

        .manager-search-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            pointer-events: none;
            font-size: 17px;
        }

        .managers-page .manager-search-input {
            width: 100%;
            padding: 14px 15px 14px 43px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            font-size: 14px;
            color: #172b4d;
            outline: none;
            margin: 0;
        }

        .managers-page .manager-search-input:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        /* TABLE HEADER */

        .manager-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 22px;
        }

        .manager-table-header h2 {
            margin: 0 0 7px;
        }

        .manager-table-header p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
        }

        .manager-count {
            background: #e8efff;
            color: #2563eb;
            padding: 9px 14px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
        }

        /* TABLE */

        .manager-table-scroll {
            overflow-x: auto;
        }

        .manager-table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        .manager-table th {
            background: #253858;
            color: white;
            padding: 16px 14px;
            font-size: 13px;
            text-align: left;
            white-space: nowrap;
        }

        .manager-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .manager-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .manager-table td {
            padding: 17px 14px;
            color: #172b4d;
            font-size: 14px;
            vertical-align: middle;
            border-bottom: 1px solid #edf0f5;
        }

        .manager-table tbody tr:hover {
            background: #f8fafc;
        }

        /* ID */

        .manager-id {
            width: 33px;
            height: 33px;
            background: #edf2f7;
            color: #64748b;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: bold;
        }

        /* MANAGER PROFILE */

        .manager-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .manager-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #e8efff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .manager-profile-info strong {
            display: block;
            font-size: 14px;
            color: #172b4d;
            white-space: nowrap;
        }

        .manager-profile-info small {
            display: block;
            font-size: 11px;
            color: #64748b;
            margin-top: 5px;
        }

        /* CONTACT INFORMATION */

        .manager-contact {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #475569;
        }

        .manager-contact a {
            color: #315b89;
            text-decoration: none;
            overflow-wrap: anywhere;
        }

        .manager-contact a:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        /* ACTIONS */

        .manager-actions {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }

        .manager-actions form {
            margin: 0;
        }

        .manager-actions .manager-btn {
            padding: 9px 12px;
            font-size: 12px;
        }

        /* EMPTY STATE */

        .manager-empty {
            padding: 50px 20px !important;
            text-align: center;
        }

        .manager-empty-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: #edf4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 37px;
            margin: 0 auto 20px;
        }

        .manager-empty h3 {
            color: #172b4d;
            font-size: 20px;
            margin: 0 0 10px;
        }

        .manager-empty p {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 23px;
            line-height: 1.6;
        }

        /* ALERTS */

        .manager-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .manager-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .manager-errors ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        /* PAGINATION */

        .manager-pagination {
            margin-top: 22px;
        }

        /* FOOTER */

        .manager-footer {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {

            .manager-stats {
                grid-template-columns: repeat(
                2, minmax(0, 1fr)
            );
            }

        }

        @media (max-width: 600px) {

            .managers-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .managers-header h1 {
                font-size: 25px;
            }

            .manager-stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .manager-stat {
                padding: 18px;
            }

            .manager-card {
                padding: 17px;
            }

            .manager-hero {
                padding: 22px;
            }

            .manager-hero h2 {
                font-size: 22px;
            }

            .manager-search-input-wrap {
                flex-basis: 100%;
            }

        }
    </style>

    <div class="managers-page">

        @php
            $listaMenaxhereve =
                $managers ?? $menaxheret ?? null;

            $lista = $listaMenaxhereve instanceof
                \Illuminate\Contracts\Pagination\Paginator
                    ? $listaMenaxhereve->getCollection()
                    : collect($listaMenaxhereve);

            $totalMenaxhere = $listaMenaxhereve instanceof
                \Illuminate\Contracts\Pagination\LengthAwarePaginator
                    ? $listaMenaxhereve->total()
                    : $lista->count();

            $meEmail = $lista
                ->filter(fn ($manager) =>
                    filled($manager->email)
                )
                ->count();

            $meTelefon = $lista
                ->filter(fn ($manager) =>
                    filled($manager->nrTelefonit)
                )
                ->count();
        @endphp

        {{-- PAGE HEADER --}}

        <div class="managers-header">

            <div>

                <h1>Menaxhimi i Stafit Administrativ</h1>

                <p>

                    Menaxho stafin administrativ,
                    kontaktet dhe informacionet
                    e menaxhereve te klubit KV Gjinoci.

                </p>

            </div>

            <a class="manager-btn"
               href="{{ route('managers.create') }}">

                + Shto Menaxher

            </a>

        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="manager-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- ERRORS --}}

        @if(session('error'))

            <div class="manager-errors">

                {{ session('error') }}

            </div>

        @endif

        @if($errors->any())

            <div class="manager-errors">

                <strong>

                    Kontrollo te dhenat:

                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- STATISTICS --}}

        <div class="manager-stats">

            {{-- TOTAL MANAGERS --}}

            <div class="manager-stat">

                <div class="manager-stat-top">

                <span class="manager-stat-label">

                    Menaxhere ne Liste

                </span>

                    <span class="manager-stat-icon">

                    👥

                </span>

                </div>

                <h2>{{ $totalMenaxhere }}</h2>

                <small>

                    Menaxhere sipas kerkimit

                </small>

            </div>

            {{-- EMAIL CONTACTS --}}

            <div class="manager-stat">

                <div class="manager-stat-top">

                <span class="manager-stat-label">

                    Kontakte me Email

                </span>

                    <span class="manager-stat-icon manager-icon-green">

                    ✉️

                </span>

                </div>

                <h2>{{ $meEmail }}</h2>

                <small>

                    Me email ne faqen aktuale

                </small>

            </div>

            {{-- PHONE CONTACTS --}}

            <div class="manager-stat">

                <div class="manager-stat-top">

                <span class="manager-stat-label">

                    Kontakte Telefonike

                </span>

                    <span class="manager-stat-icon manager-icon-purple">

                    📞

                </span>

                </div>

                <h2>{{ $meTelefon }}</h2>

                <small>

                    Me telefon ne faqen aktuale

                </small>

            </div>

        </div>

        {{-- ADMINISTRATION HERO --}}

        <div class="manager-hero">

            <div class="manager-hero-content">

            <span class="manager-hero-label">

                KV GJINOCI MANAGEMENT

            </span>

                <h2>

                    Stafi Administrativ i Klubit

                </h2>

                <p>

                    Organizo stafin administrativ
                    dhe mbaj informacionet e
                    menaxhereve ne nje vend.
                    Regjistro anetare te rinj dhe
                    perditeso kontaktet ekzistuese.

                </p>

                <a class="manager-btn"
                   href="{{ route('managers.create') }}">

                    + Regjistro Menaxher

                </a>

            </div>

        </div>

        {{-- SEARCH --}}

        <div class="manager-card">

            <h2>Kerko Menaxher</h2>

            <p class="manager-description">

                Gjej menaxherin sipas emrit,
                mbiemrit ose emailit.

            </p>

            <form method="GET"
                  action="{{ route('managers.index') }}"
                  class="manager-search-form">

                <div class="manager-search-input-wrap">

                <span class="manager-search-icon">

                    🔍

                </span>

                    <input type="text"
                           class="manager-search-input"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Kerko sipas emrit, mbiemrit ose emailit...">

                </div>

                <button type="submit"
                        class="manager-btn">

                    Kerko

                </button>

                <a class="manager-btn manager-btn-gray"
                   href="{{ route('managers.index') }}">

                    Pastro

                </a>

            </form>

        </div>

        {{-- MANAGERS TABLE --}}

        <div class="manager-card">

            <div class="manager-table-header">

                <div>

                    <h2>Lista e Menaxhereve</h2>

                    <p>

                        Menaxheret e regjistruar
                        ne sistemin e klubit.

                    </p>

                </div>

                <span class="manager-count">

                {{ $totalMenaxhere }} Menaxhere

            </span>

            </div>

            <div class="manager-table-scroll">

                <table class="manager-table">

                    <thead>

                    <tr>

                        <th>ID</th>

                        <th>Menaxheri</th>

                        <th>Email</th>

                        <th>Telefoni</th>

                        <th>Vendbanimi</th>

                        <th>Veprimet</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($lista as $manager)

                        <tr>

                            {{-- ID --}}

                            <td>

                                <span class="manager-id">

                                    {{ $manager->id }}

                                </span>

                            </td>

                            {{-- MANAGER NAME --}}

                            <td>

                                <div class="manager-profile">

                                    <div class="manager-avatar">

                                        {{ mb_strtoupper(
                                            mb_substr(
                                                $manager->emri,
                                                0, 1
                                            )
                                            .
                                            mb_substr(
                                                $manager->mbiemri,
                                                0, 1
                                            )
                                        ) }}

                                    </div>

                                    <div class="manager-profile-info">

                                        <strong>

                                            {{ $manager->emri }}

                                            {{ $manager->mbiemri }}

                                        </strong>

                                        <small>

                                            Menaxher i Klubit

                                        </small>

                                    </div>

                                </div>

                            </td>

                            {{-- EMAIL --}}

                            <td>

                                <div class="manager-contact">

                                    <span>✉️</span>

                                    @if($manager->email)

                                        <a href="mailto:{{ $manager->email }}">

                                            {{ $manager->email }}

                                        </a>

                                    @else

                                        -

                                    @endif

                                </div>

                            </td>

                            {{-- PHONE --}}

                            <td>

                                <div class="manager-contact">

                                    <span>📞</span>

                                    {{ $manager->nrTelefonit ?? '-' }}

                                </div>

                            </td>

                            {{-- ADDRESS --}}

                            <td>

                                <div class="manager-contact">

                                    <span>📍</span>

                                    {{ $manager->vendbanimi ?? '-' }}

                                </div>

                            </td>

                            {{-- ACTIONS --}}

                            <td>

                                <div class="manager-actions">

                                    <a class="manager-btn manager-btn-light"
                                       href="{{ route(
                                           'managers.edit',
                                           $manager
                                       ) }}">

                                        Edito

                                    </a>

                                    <form method="POST"
                                          action="{{ route(
                                              'managers.destroy',
                                              $manager
                                          ) }}"
                                          onsubmit="return confirm('A je i sigurt qe deshiron ta fshish kete menaxher?')">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                class="manager-btn manager-btn-danger">

                                            Fshi

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="manager-empty">

                                <div class="manager-empty-icon">

                                    👥

                                </div>

                                @if(request()->filled('search'))

                                    <h3>

                                        Nuk u gjet asnje menaxher

                                    </h3>

                                    <p>

                                        Nuk ka rezultate
                                        per kerkimin tuaj.
                                        Provo nje emer tjeter.

                                    </p>

                                    <a class="manager-btn manager-btn-gray"
                                       href="{{ route('managers.index') }}">

                                        Pastro Kerkimin

                                    </a>

                                @else

                                    <h3>

                                        Nuk ka menaxhere te regjistruar

                                    </h3>

                                    <p>

                                        Fillo duke regjistruar
                                        menaxherin e pare te klubit
                                        KV Gjinoci.

                                    </p>

                                    <a class="manager-btn"
                                       href="{{ route('managers.create') }}">

                                        + Shto Menaxherin e Pare

                                    </a>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}

            @if($listaMenaxhereve instanceof
                \Illuminate\Contracts\Pagination\Paginator)

                <div class="manager-pagination">

                    {{ $listaMenaxhereve
                        ->withQueryString()
                        ->links() }}

                </div>

            @endif

        </div>

        {{-- FOOTER --}}

        <div class="manager-footer">

            <a class="manager-btn manager-btn-gray"
               href="{{ route('dashboard') }}">

                Kthehu ne Dashboard

            </a>

            <a class="manager-btn manager-btn-light"
               href="{{ route('trajner.index') }}">

                Menaxho Trajneret

            </a>

            <a class="manager-btn manager-btn-light"
               href="{{ route('ekipet.index') }}">

                Menaxho Ekipet

            </a>

        </div>

    </div>

@endsection
