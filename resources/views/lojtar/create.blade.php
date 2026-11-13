@extends('layouts.club')

@section('title', 'Regjistro Volejbolliste - KV Gjinoci')

@section('content')

    <style>
        .player-create-page {
            max-width: 1050px;
            margin: 0 auto;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .player-create-page * {
            box-sizing: border-box;
        }

        .player-create-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .player-create-header h1 {
            font-size: 30px;
            margin: 0 0 8px;
            color: #172b4d;
        }

        .player-create-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* BUTTONS */

        .player-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #253858;
            color: white !important;
            padding: 13px 20px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .player-btn:hover {
            filter: brightness(.95);
            transform: translateY(-1px);
        }

        .player-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .player-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* HERO */

        .player-create-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            border-radius: 17px;
            padding: 30px;
            color: white;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .player-create-hero::after {
            content: "🏐";
            position: absolute;
            right: 20px;
            bottom: -40px;
            font-size: 185px;
            opacity: .12;
            pointer-events: none;
        }

        .player-hero-content {
            position: relative;
            z-index: 1;
        }

        .player-hero-label {
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .player-create-hero h2 {
            font-size: 27px;
            color: white !important;
            margin: 13px 0 10px;
        }

        .player-create-hero p {
            font-size: 13px;
            color: #dbeafe !important;
            line-height: 1.7;
            max-width: 580px;
            margin: 0;
        }

        /* FORM CARD */

        .player-create-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 28px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .player-create-card > h2 {
            color: #172b4d;
            font-size: 22px;
            margin: 0 0 8px;
        }

        .player-card-description {
            color: #64748b;
            font-size: 13px;
            margin: 0 0 27px;
            line-height: 1.6;
        }

        /* ERRORS */

        .player-create-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 16px 19px;
            margin-bottom: 23px;
            font-size: 14px;
        }

        .player-create-errors ul {
            margin: 9px 0 0;
            padding-left: 20px;
        }

        /* FORM ACTIONS */

        .player-create-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 11px;
            flex-wrap: wrap;
            border-top: 1px solid #e5ebf3;
            padding-top: 23px;
            margin-top: 24px;
        }

        @media (max-width: 650px) {

            .player-create-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .player-create-header h1 {
                font-size: 25px;
            }

            .player-create-hero {
                padding: 23px;
            }

            .player-create-card {
                padding: 19px;
            }

            .player-create-actions {
                justify-content: stretch;
            }

            .player-create-actions .player-btn {
                flex: 1;
            }

        }
    </style>

    <div class="player-create-page">

        {{-- PAGE HEADER --}}

        <div class="player-create-header">

            <div>

                <h1>Regjistro Volejbolliste</h1>

                <p>

                    Shto nje volejbolliste te re
                    ne klubin KV Gjinoci.

                </p>

            </div>

            <a href="{{ route('lojtar.index') }}"
               class="player-btn player-btn-light">

                ← Kthehu te Lista

            </a>

        </div>

        {{-- HERO --}}

        <div class="player-create-hero">

            <div class="player-hero-content">

            <span class="player-hero-label">

                KV GJINOCI WOMEN'S VOLLEYBALL

            </span>

                <h2>Regjistrimi i Volejbollistes</h2>

                <p>

                    Krijo profilin e nje volejbollisteje,
                    regjistro informacionet personale,
                    pozicionin, numrin e fanelles
                    dhe cakto ekipin ku do te luaje.

                </p>

            </div>

        </div>

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="player-create-errors">

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

        {{-- MAIN FORM --}}

        <div class="player-create-card">

            <h2>Informacionet e Volejbollistes</h2>

            <p class="player-card-description">

                Ploteso te dhenat personale
                dhe informacionet sportive
                te volejbollistes.

            </p>

            <form method="POST"
                  action="{{ route('lojtar.store') }}">

                @csrf

                @include('lojtar.form')

                <div class="player-create-actions">

                    <a href="{{ route('lojtar.index') }}"
                       class="player-btn player-btn-gray">

                        Anulo

                    </a>

                    <button type="submit"
                            class="player-btn">

                        ✓ Regjistro Volejbollisten

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
