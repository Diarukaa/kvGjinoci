@extends('layouts.club')

@section('title', $title . ' - KV Gjinoci')

@section('content')

    <style>
        .role-page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 15px 0 40px;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .role-page * {
            box-sizing: border-box;
        }

        .role-hero {
            background: linear-gradient(
                120deg,
                #172b4d,
                #315b89
            );
            color: white;
            padding: 35px;
            border-radius: 18px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow: hidden;
        }

        .role-hero::after {
            content: "🏐";
            position: absolute;
            right: -30px;
            bottom: -70px;
            font-size: 230px;
            opacity: .07;
            pointer-events: none;
        }

        .role-hero-content {
            position: relative;
            z-index: 1;
        }

        .role-hero small {
            display: block;
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 14px;
        }

        .role-hero h1 {
            color: white !important;
            font-size: 32px;
            margin: 0 0 13px;
        }

        .role-hero p {
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
            max-width: 650px;
        }

        .role-avatar {
            width: 78px;
            height: 78px;
            border: 1px solid rgba(255,255,255,.2);
            background: rgba(255,255,255,.12);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            flex-shrink: 0;
            z-index: 1;
        }

        .role-section-title {
            font-size: 23px;
            margin: 28px 0 18px;
            color: #172b4d;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 18px;
        }

        .role-card {
            background: white;
            border: 1px solid #e1e8f2;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
            transition: .2s;
        }

        .role-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(15,23,42,.07);
        }

        .role-card-icon {
            width: 49px;
            height: 49px;
            background: #e8efff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            margin-bottom: 18px;
        }

        .role-card h3 {
            font-size: 18px;
            margin: 0 0 10px;
        }

        .role-card p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
            margin: 0 0 18px;
        }

        .role-card-status {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 11px;
            font-weight: bold;
        }

        .role-info {
            background: white;
            border: 1px solid #e1e8f2;
            border-radius: 15px;
            padding: 25px;
            margin-top: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .role-info-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: #dcfce7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .role-info h3 {
            font-size: 16px;
            margin: 0 0 7px;
        }

        .role-info p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        .role-account {
            background: white;
            padding: 25px;
            border: 1px solid #e1e8f2;
            border-radius: 15px;
            margin-top: 25px;
        }

        .role-account h2 {
            font-size: 21px;
            margin: 0 0 20px;
        }

        .role-account-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .role-account-item {
            background: #f8fafc;
            padding: 17px;
            border: 1px solid #e5ebf3;
            border-radius: 10px;
            overflow-wrap: anywhere;
        }

        .role-account-item small {
            display: block;
            color: #64748b;
            font-size: 12px;
            margin-bottom: 9px;
        }

        .role-account-item strong {
            font-size: 14px;
        }

        .role-logout {
            margin-top: 25px;
            padding: 12px 18px;
            border: none;
            background: #253858;
            color: white;
            font-size: 13px;
            font-weight: bold;
            border-radius: 9px;
            cursor: pointer;
        }

        .role-logout:hover {
            background: #172b4d;
        }

        @media (max-width: 850px) {

            .role-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .role-account-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 550px) {

            .role-grid {
                grid-template-columns: 1fr;
            }

            .role-hero {
                padding: 24px;
            }

            .role-hero h1 {
                font-size: 25px;
            }

            .role-avatar {
                display: none;
            }

            .role-info {
                align-items: flex-start;
            }

        }
    </style>

    <div class="role-page">

        <!-- HERO -->

        <div class="role-hero">

            <div class="role-hero-content">

                <small>
                    KV GJINOCI | {{ strtoupper($roleName) }}
                </small>

                <h1>
                    Miresevjen, {{ auth()->user()->name }}!
                </h1>

                <p>
                    {{ $description }}
                </p>

            </div>

            <div class="role-avatar">

                {{ mb_strtoupper(
                    mb_substr(auth()->user()->name, 0, 1)
                ) }}

            </div>

        </div>

        <!-- MODULET -->

        <h2 class="role-section-title">
            {{ $title }}
        </h2>

        <div class="role-grid">

            @foreach($modules as $module)

                <div class="role-card">

                    <div class="role-card-icon">

                        {{ $module['icon'] }}

                    </div>

                    <h3>

                        {{ $module['title'] }}

                    </h3>

                    <p>

                        {{ $module['description'] }}

                    </p>

                    <span class="role-card-status">

                    Ne zhvillim

                </span>

                </div>

            @endforeach

        </div>

        <!-- STATUSI -->

        <div class="role-info">

            <div class="role-info-icon">

                ✓

            </div>

            <div>

                <h3>Llogaria jote eshte aktive</h3>

                <p>
                    Je kycur me sukses si {{ $roleName }}.
                    Modulet e dedikuara per rolin tend
                    do te aktivizohen pasi te perfundoje
                    lidhja me profilin tend ne klub.
                </p>

            </div>

        </div>

        <!-- LLOGARIA -->

        <div class="role-account">

            <h2>Informacionet e Llogarise</h2>

            <div class="role-account-grid">

                <div class="role-account-item">

                    <small>Emri dhe Mbiemri</small>

                    <strong>
                        {{ auth()->user()->name }}
                    </strong>

                </div>

                <div class="role-account-item">

                    <small>Email</small>

                    <strong>
                        {{ auth()->user()->email }}
                    </strong>

                </div>

                <div class="role-account-item">

                    <small>Roli</small>

                    <strong>
                        {{ $roleName }}
                    </strong>

                </div>

            </div>

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="role-logout">

                    Dil nga Sistemi

                </button>

            </form>

        </div>

    </div>

@endsection
