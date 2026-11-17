<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Formacionet -
        {{ $ndeshja->ekipi?->emri ?? 'KV Gjinoci' }}
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            color-scheme: light;
        }

        body {
            margin: 0;
            padding: 32px 20px;
            background: #eef2f7;
            color: #172b4d;
            font-family: Arial, Helvetica, sans-serif;
        }

        .print-toolbar {
            max-width: 800px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .print-toolbar h1 {
            font-size: 20px;
            margin: 0;
        }

        .print-toolbar p {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .print-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .print-button {
            display: inline-block;
            padding: 12px 17px;
            border: none;
            border-radius: 9px;
            background: #253858;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .print-button.secondary {
            background: #ffffff;
            color: #253858;
            border: 1px solid #dbe3ee;
        }

        .report-page {
            max-width: 800px;
            min-height: 1060px;
            margin: 0 auto 24px;
            padding: 43px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 28px rgba(15,23,42,.08);
            break-after: page;
        }

        .report-page:last-of-type {
            break-after: auto;
        }

        .report-header {
            border-bottom: 3px solid #253858;
            padding-bottom: 22px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .report-brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .report-logo {
            width: 52px;
            height: 52px;
            background: #253858;
            color: white;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            overflow: hidden;
        }

        .report-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .report-brand h2 {
            margin: 0 0 5px;
            color: #172b4d;
            font-size: 21px;
        }

        .report-brand small {
            color: #64748b;
            font-size: 11px;
            letter-spacing: 1px;
        }

        .report-set {
            text-align: right;
        }

        .report-set strong {
            display: block;
            color: #253858;
            font-size: 28px;
        }

        .report-set span {
            font-size: 11px;
            color: #64748b;
        }

        .report-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 28px;
        }

        .report-info-item {
            padding: 14px;
            background: #f1f5f9;
            border-radius: 10px;
            min-width: 0;
        }

        .report-info-item small {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-bottom: 7px;
        }

        .report-info-item strong {
            display: block;
            font-size: 14px;
            color: #172b4d;
            overflow-wrap: anywhere;
        }

        .report-section-title {
            color: #172b4d;
            font-size: 17px;
            margin: 0 0 15px;
        }

        .report-court {
            position: relative;
            border: 5px solid #ffffff;
            outline: 2px solid #c87945;
            background: #d59768;
            border-radius: 8px;
            padding: 27px 19px 20px;
            overflow: hidden;
        }

        .report-net {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: repeating-linear-gradient(
                90deg,
                #f8fafc 0,
                #f8fafc 9px,
                #64748b 9px,
                #64748b 11px
            );
        }

        .report-line {
            position: absolute;
            top: 49%;
            left: 0;
            right: 0;
            height: 3px;
            background: #ffffff;
        }

        .report-court-label {
            position: relative;
            text-align: center;
            color: white;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .report-positions {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            grid-template-areas:
                "p4 p3 p2"
                "p5 p6 p1";
            grid-template-rows: repeat(2, 125px);
            gap: 13px;
            position: relative;
        }

        .report-player {
            border: 1px solid #dbe3ee;
            border-radius: 10px;
            background: white;
            padding: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-width: 0;
        }

        .report-position-label {
            font-size: 10px;
            color: #64748b;
        }

        .report-jersey {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 39px;
            height: 39px;
            border-radius: 10px;
            background: #253858;
            color: white;
            font-weight: 800;
            font-size: 17px;
        }

        .report-player-name {
            font-size: 11px;
            font-weight: 700;
            color: #172b4d;
            overflow-wrap: anywhere;
        }

        .report-libero {
            margin-top: 20px;
            padding: 17px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 10px;
        }

        .report-libero strong {
            color: #1e40af;
            font-size: 13px;
        }

        .report-libero p {
            margin: 8px 0 0;
            font-size: 13px;
            color: #334155;
        }

        .report-footer {
            margin-top: 30px;
            border-top: 1px solid #cbd5e1;
            padding-top: 14px;
            display: flex;
            justify-content: space-between;
            gap: 15px;
            color: #64748b;
            font-size: 10px;
        }

        .report-empty {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            border-radius: 12px;
            background: white;
            text-align: center;
        }

        .report-empty h2 {
            margin-top: 0;
        }

        .report-empty p {
            color: #64748b;
            line-height: 1.7;
        }

        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        @media print {
            html,
            body {
                background: white !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .print-toolbar {
                display: none !important;
            }

            .report-page {
                max-width: none;
                width: 100%;
                min-height: 0;
                margin: 0;
                padding: 0;
                border-radius: 0;
                box-shadow: none;
                break-after: page;
                page-break-after: always;
            }

            .report-page:last-of-type {
                break-after: auto;
                page-break-after: auto;
            }

            .report-court,
            .report-jersey,
            .report-logo,
            .report-info-item,
            .report-libero {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .report-player,
            .report-court,
            .report-libero {
                break-inside: avoid;
            }

            .report-empty {
                display: none;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 16px;
            }

            .report-page {
                padding: 18px;
                min-height: auto;
            }

            .report-header {
                flex-wrap: wrap;
            }

            .report-info {
                grid-template-columns: 1fr;
            }

            .report-positions {
                gap: 7px;
                grid-template-rows: repeat(2, 120px);
            }

            .report-player {
                padding: 6px 3px;
            }

            .report-player-name {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>

<div class="print-toolbar">
    <div>
        <h1>Raporti i Formacioneve 6+1</h1>
        <p>
            {{ $ndeshja->ekipi?->emri ?? 'Ekipi' }}
            vs
            {{ $ndeshja->kundershtari }}
        </p>
    </div>

    <div class="print-actions">
        <a
            class="print-button secondary"
            href="{{ route('formacionet.index', $ndeshja) }}"
        >
            Kthehu
        </a>

        @if(count($formacionet))
            <button
                class="print-button"
                type="button"
                onclick="window.print()"
            >
                Printo / Ruaj PDF
            </button>
        @endif
    </div>
</div>

@forelse($formacionet as $seti => $formacioni)

    <section class="report-page">

        <div class="report-header">
            <div class="report-brand">
                <div class="report-logo">

                    @if(file_exists(public_path('images/logo.png')))
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="KV Gjinoci"
                        >
                    @else
                        🏐
                    @endif

                </div>

                <div>
                    <h2>KV Gjinoci</h2>
                    <small>
                        FORMACIONI I NDESHJES
                    </small>
                </div>
            </div>

            <div class="report-set">
                <strong>SETI {{ $seti }}</strong>
                <span>Formacioni 6+1</span>
            </div>
        </div>

        <div class="report-info">

            <div class="report-info-item">
                <small>Ekipi</small>
                <strong>
                    {{ $ndeshja->ekipi?->emri ?? 'Pa ekip' }}
                </strong>
            </div>

            <div class="report-info-item">
                <small>Kundershtari</small>
                <strong>
                    {{ $ndeshja->kundershtari }}
                </strong>
            </div>

            <div class="report-info-item">
                <small>Data</small>
                <strong>
                    @if($ndeshja->data_ndeshjes)
                        {{ \Carbon\Carbon::parse(
                            $ndeshja->data_ndeshjes
                        )->format('d.m.Y') }}
                    @else
                        Pa date
                    @endif
                </strong>
            </div>

            <div class="report-info-item">
                <small>Palestra</small>
                <strong>
                    {{ $ndeshja->palestra ?: 'Pa caktuar' }}
                </strong>
            </div>

        </div>

        <h3 class="report-section-title">
            Pozicionet ne Fushen e Volejbollit
        </h3>

        <div class="report-court">

            <div class="report-net"></div>
            <div class="report-line"></div>

            <div class="report-court-label">
                RRJETA / FRONT ROW
            </div>

            <div class="report-positions">

                @foreach([4, 3, 2, 5, 6, 1] as $pozicioni)

                    @php
                        $player = $formacioni[$pozicioni]
                            ?? null;
                    @endphp

                    <div
                        class="report-player"
                        style="grid-area:p{{ $pozicioni }}"
                    >
                            <span class="report-position-label">
                                Pozicioni {{ $pozicioni }}
                            </span>

                        <span class="report-jersey">
                                {{ $player['numri'] ?? '–' }}
                            </span>

                        <span class="report-player-name">
                                {{ $player['emri'] ?? 'Pa lojtare' }}
                            </span>
                    </div>

                @endforeach

            </div>
        </div>

        <div class="report-libero">
            <strong>LIBERO</strong>

            <p>
                @if(isset($formacioni[7]))
                    #{{ $formacioni[7]['numri'] }}
                    –
                    {{ $formacioni[7]['emri'] }}
                @else
                    Nuk eshte caktuar.
                @endif
            </p>
        </div>

        <div class="report-footer">
                <span>
                    KV Gjinoci – Volleyball Management System
                </span>

            <span>
                    Seti {{ $seti }}
                </span>
        </div>

    </section>

@empty

    <div class="report-empty">
        <h2>Nuk ka formacione te ruajtura.</h2>

        <p>
            Kthehu te Formacionet 6+1,
            ruaje te pakten nje set dhe
            pastaj hape raportin.
        </p>
    </div>

@endforelse

</body>
</html>
