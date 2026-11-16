<!DOCTYPE html>
<html lang="sq">

<head>

    <meta charset="UTF-8">

    <title>{{ $title }} - KV Gjinoci</title>

    <style>
        @page {
            margin: 35px 35px 55px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #172b4d;
            font-size: 10px;
            margin: 0;
            line-height: 1.5;
        }

        .header {
            background: #172b4d;
            color: #ffffff;
            padding: 25px;
            border-bottom: 5px solid #60a5fa;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
            border: none;
        }

        .logo {
            width: 60px;
            max-height: 70px;
        }

        .club-name {
            color: #bfdbfe;
            font-size: 10px;
            letter-spacing: 1px;
            font-weight: bold;
        }

        .report-title {
            font-size: 23px;
            color: white;
            margin: 9px 0;
        }

        .report-subtitle {
            font-size: 10px;
            color: #dbeafe;
            margin: 0;
        }

        .meta {
            width: 100%;
            background: #f1f5f9;
            border-collapse: collapse;
            margin-top: 17px;
            margin-bottom: 24px;
        }

        .meta td {
            width: 50%;
            padding: 14px;
            border: 1px solid #e2e8f0;
        }

        .meta-label {
            display: block;
            color: #64748b;
            font-size: 9px;
            margin-bottom: 5px;
        }

        .meta-value {
            font-weight: bold;
            font-size: 11px;
        }

        .section-title {
            color: #172b4d;
            font-size: 15px;
            margin: 24px 0 12px;
            padding-left: 10px;
            border-left: 4px solid #315b89;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 23px;
        }

        .summary td {
            border-bottom: 1px solid #e2e8f0;
            padding: 10px 12px;
        }

        .summary-label {
            background: #f8fafc;
            color: #475569;
            width: 65%;
        }

        .summary-value {
            text-align: right;
            font-weight: bold;
            font-size: 11px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 22px;
            table-layout: fixed;
        }

        .data-table thead {
            display: table-header-group;
        }

        .data-table th {
            background: #253858;
            color: white;
            padding: 11px 7px;
            text-align: left;
            font-size: 9px;
            word-wrap: break-word;
        }

        .data-table td {
            padding: 10px 7px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 9px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .data-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .data-table tr {
            page-break-inside: avoid;
        }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 20px;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .signature-table td {
            width: 50%;
            padding: 15px;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #94a3b8;
            margin-top: 35px;
            padding-top: 8px;
            font-size: 10px;
            color: #64748b;
        }

        .note {
            background: #f1f5f9;
            color: #64748b;
            padding: 12px;
            font-size: 9px;
            margin-top: 20px;
        }

        .footer {
            position: fixed;
            bottom: -38px;
            left: 0;
            right: 0;
            border-top: 1px solid #cbd5e1;
            padding-top: 10px;
            color: #64748b;
            font-size: 8px;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-table td {
            width: 50%;
        }
    </style>

</head>

<body>

{{-- FOOTER --}}

<div class="footer">

    <table class="footer-table">

        <tr>

            <td>
                KV Gjinoci | Volleyball Management
            </td>

            <td style="text-align:right;">

                Gjeneruar:
                {{ now()->format('d.m.Y H:i') }}

            </td>

        </tr>

    </table>

</div>

{{-- HEADER --}}

<div class="header">

    <table class="header-table">

        <tr>

            @if($logo)

                <td style="width:80px;">

                    <img src="{{ $logo }}"
                         class="logo"
                         alt="KV Gjinoci">

                </td>

            @endif

            <td>

                <div class="club-name">

                    KV GJINOCI | OFFICIAL REPORT

                </div>

                <h1 class="report-title">

                    {{ $title }}

                </h1>

                <p class="report-subtitle">

                    {{ $subtitle }}

                </p>

            </td>

        </tr>

    </table>

</div>

{{-- INFORMACIONET E RAPORTIT --}}

<table class="meta">

    <tr>

        <td>

                <span class="meta-label">

                    PERIUDHA E RAPORTIT

                </span>

            <span class="meta-value">

                    {{ $nga->format('d.m.Y') }}

                    -

                    {{ $deri->format('d.m.Y') }}

                </span>

        </td>

        <td>

                <span class="meta-label">

                    GJENERUAR NGA

                </span>

            <span class="meta-value">

                    {{ auth()->user()->name }}

                </span>

        </td>

    </tr>

</table>

{{-- SUMMARY --}}

<h2 class="section-title">

    Permbledhja e Raportit

</h2>

<table class="summary">

    @foreach($summary as $label => $value)

        <tr>

            <td class="summary-label">

                {{ $label }}

            </td>

            <td class="summary-value">

                {{ $value }}

            </td>

        </tr>

    @endforeach

</table>

{{-- SEKSIONET E RAPORTIT --}}

@foreach($sections as $section)

    <h2 class="section-title">

        {{ $section['title'] }}

    </h2>

    <table class="data-table">

        <thead>

        <tr>

            @foreach($section['headers'] as $header)

                <th>{{ $header }}</th>

            @endforeach

        </tr>

        </thead>

        <tbody>

        @forelse($section['rows'] as $row)

            <tr>

                @foreach($row as $value)

                    <td>{{ $value ?? '-' }}</td>

                @endforeach

            </tr>

        @empty

            <tr>

                <td colspan="{{ count(
                            $section['headers']
                        ) }}" class="empty">

                    Nuk ka te dhena per kete periudhe.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

@endforeach

{{-- SHENIME --}}

<div class="note">

    Ky raport eshte gjeneruar automatikisht
    nga sistemi i menaxhimit te KV Gjinocit.
    Te dhenat pasqyrojne regjistrimet ne sistem
    per periudhen e zgjedhur.

</div>

{{-- NENSHKRIMET --}}

@if(in_array(
    auth()->user()->role,
    ['admin', 'manager'],
    true
))

    <table class="signature-table">

        <tr>

            <td>

                <div class="signature-line">

                    Pergatiti

                </div>

            </td>

            <td>

                <div class="signature-line">

                    Personi i autorizuar

                </div>

            </td>

        </tr>

    </table>

@endif

</body>

</html>
