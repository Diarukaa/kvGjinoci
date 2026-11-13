@extends('layouts.club')

@section('title', 'Shto Stervitje - KV Gjinoci')

@section('content')

    <style>
        .training-create-page {
            max-width: 1050px;
            margin: 0 auto;
            padding: 10px 0 35px;
            font-family: Arial, sans-serif;
            color: #172b4d;
        }

        .training-create-page * {
            box-sizing: border-box;
        }

        /* PAGE HEADER */

        .tc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .tc-header h1 {
            font-size: 30px;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .tc-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* BUTTONS */

        .tc-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 19px;
            border: none;
            border-radius: 9px;
            background: #253858;
            color: white !important;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none !important;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .tc-btn:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        .tc-btn-light {
            background: #e8efff;
            color: #2563eb !important;
        }

        .tc-btn-gray {
            background: #edf2f7;
            color: #253858 !important;
        }

        /* HERO SECTION */

        .tc-hero {
            background: linear-gradient(
                125deg,
                #172b4d,
                #315b89
            );
            color: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(23,43,77,.12);
        }

        .tc-hero::after {
            content: "🏐";
            position: absolute;
            right: -20px;
            bottom: -95px;
            font-size: 300px;
            opacity: .07;
            pointer-events: none;
        }

        .tc-hero-content {
            display: flex;
            align-items: center;
            gap: 23px;
            position: relative;
            z-index: 1;
        }

        .tc-hero-icon {
            width: 90px;
            height: 90px;
            border-radius: 20px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 43px;
            flex-shrink: 0;
        }

        .tc-hero-label {
            display: block;
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .tc-hero h2 {
            font-size: 29px;
            color: white !important;
            margin: 0 0 10px;
        }

        .tc-hero p {
            color: #dbeafe !important;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
            max-width: 600px;
        }

        .tc-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 16px;
        }

        .tc-tag {
            display: inline-block;
            padding: 8px 12px;
            color: white;
            font-size: 12px;
            font-weight: 600;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 8px;
        }

        /* FORM CARD */

        .tc-card {
            background: white;
            border: 1px solid #e5ebf3;
            border-radius: 17px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(15,23,42,.04);
        }

        .tc-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid #e5ebf3;
            padding-bottom: 22px;
            margin-bottom: 25px;
        }

        .tc-card-icon {
            width: 49px;
            height: 49px;
            background: #e8efff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .tc-card-header h2 {
            font-size: 21px;
            color: #172b4d;
            margin: 0 0 6px;
        }

        .tc-card-header p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
        }

        /* INFORMATION */

        .tc-info {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            background: #edf4ff;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 26px;
        }

        .tc-info strong {
            display: block;
            font-size: 13px;
            color: #1e40af;
            margin-bottom: 7px;
        }

        .tc-info p {
            color: #475569;
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        /* EXISTING FORM DESIGN */

        .training-create-page form {
            margin: 0;
        }

        .training-create-page form label {
            display: block;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .training-create-page form input:not([type="hidden"]),
        .training-create-page form select,
        .training-create-page form textarea {
            width: 100%;
            min-height: 46px;
            padding: 12px 14px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #172b4d;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: .2s;
        }

        .training-create-page form input:focus,
        .training-create-page form select:focus,
        .training-create-page form textarea:focus {
            background: white;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .training-create-page form textarea {
            min-height: 130px;
            line-height: 1.7;
            resize: vertical;
        }

        .training-create-page form .grid,
        .training-create-page form .form-grid {
            display: grid;
            grid-template-columns: repeat(
            3, minmax(0, 1fr)
        );
            gap: 23px;
            margin-bottom: 22px;
        }

        .training-create-page form .grid > div,
        .training-create-page form .form-grid > div {
            min-width: 0;
        }

        /* ORIGINAL SAVE BUTTON */

        .training-create-page form button[type="submit"],
        .training-create-page form input[type="submit"] {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: auto;
            min-height: 44px;
            background: #253858;
            color: white;
            border: none;
            border-radius: 9px;
            padding: 13px 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 12px;
            transition: .2s;
        }

        .training-create-page form button[type="submit"]:hover,
        .training-create-page form input[type="submit"]:hover {
            filter: brightness(.94);
            transform: translateY(-1px);
        }

        /* FOOTER */

        .tc-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            border-top: 1px solid #e5ebf3;
            padding-top: 22px;
            margin-top: 28px;
        }

        .tc-footer small {
            font-size: 12px;
            color: #64748b;
        }

        /* VALIDATION ERRORS */

        .tc-errors {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 11px;
            padding: 18px;
            margin-bottom: 23px;
            font-size: 13px;
        }

        .tc-errors ul {
            padding-left: 20px;
            margin: 10px 0 0;
        }

        /* RESPONSIVE DESIGN */

        @media (max-width: 850px) {

            .training-create-page form .grid,
            .training-create-page form .form-grid {
                grid-template-columns: repeat(
                2, minmax(0, 1fr)
            );
            }

        }

        @media (max-width: 600px) {

            .training-create-page {
                padding: 5px 0 25px;
            }

            .tc-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .tc-header h1 {
                font-size: 25px;
            }

            .tc-hero {
                padding: 23px;
            }

            .tc-hero-content {
                gap: 14px;
                align-items: flex-start;
            }

            .tc-hero-icon {
                width: 60px;
                height: 60px;
                font-size: 29px;
                border-radius: 13px;
            }

            .tc-hero h2 {
                font-size: 23px;
            }

            .tc-card {
                padding: 20px;
            }

            .training-create-page form .grid,
            .training-create-page form .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .tc-footer {
                align-items: flex-start;
                flex-direction: column;
            }

        }
    </style>

    <div class="training-create-page">

        {{-- PAGE HEADER --}}

        <div class="tc-header">

            <div>

                <h1>Shto Stervitje te Re</h1>

                <p>

                    Planifiko stervitjet dhe organizo
                    aktivitetet sportive te KV Gjinocit.

                </p>

            </div>

            <a href="{{ route('stervitjet.index') }}"
               class="tc-btn tc-btn-light">

                ← Kthehu te Stervitjet

            </a>

        </div>

        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="tc-errors">

                <strong>

                    Kontrollo te dhenat e vendosura:

                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- HERO SECTION --}}

        <div class="tc-hero">

            <div class="tc-hero-content">

                <div class="tc-hero-icon">

                    🏐

                </div>

                <div>

                <span class="tc-hero-label">

                    KV GJINOCI | TRAINING CENTER

                </span>

                    <h2>

                        Planifiko Stervitjen

                    </h2>

                    <p>

                        Regjistro nje stervitje te re,
                        cakto ekipin dhe trajnerin,
                        organizo orarin dhe percakto
                        objektivat e stervitjes.

                    </p>

                    <div class="tc-tags">

                    <span class="tc-tag">

                        📅 Planifikimi i Orarit

                    </span>

                        <span class="tc-tag">

                        👥 Menaxhimi i Ekipit

                    </span>

                        <span class="tc-tag">

                        📋 Evidentimi i Prezences

                    </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- TRAINING FORM --}}

        <div class="tc-card">

            <div class="tc-card-header">

                <div class="tc-card-icon">

                    📋

                </div>

                <div>

                    <h2>

                        Informacionet e Stervitjes

                    </h2>

                    <p>

                        Ploteso informacionet e
                        nevojshme per regjistrimin
                        e stervitjes se re.

                    </p>

                </div>

            </div>

            {{-- INFORMATION --}}

            <div class="tc-info">

            <span style="font-size:22px">

                ℹ️

            </span>

                <div>

                    <strong>

                        Si funksionon planifikimi?

                    </strong>

                    <p>

                        Zgjedh ekipin, trajnerin dhe
                        sezonin perkates.

                        Cakto daten dhe orarin e
                        stervitjes. Pas perfundimit
                        te saj, mund ta ndryshosh
                        statusin dhe te regjistrosh
                        prezencen e volejbollisteve.

                    </p>

                </div>

            </div>

            {{-- EXISTING FORM --}}

            <form method="POST"
                  action="{{ route('stervitjet.store') }}">

                @csrf

                @include('stervitjet.form')

            </form>

            {{-- FOOTER --}}

            <div class="tc-footer">

                <small>

                    Kontrollo daten dhe orarin
                    para ruajtjes se stervitjes.

                </small>

                <a href="{{ route('stervitjet.index') }}"
                   class="tc-btn tc-btn-gray">

                    Anulo

                </a>

            </div>

        </div>

    </div>

@endsection
