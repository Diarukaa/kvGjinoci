<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Llogaria u aktivizua - KV Gjinoci</title>
</head>

<body style="
    margin:0;
    padding:30px 12px;
    background:#f1f5f9;
    color:#172b4d;
    font-family:Arial,Helvetica,sans-serif;
">

    <div style="
        max-width:560px;
        margin:0 auto;
        background:#ffffff;
        border:1px solid #e2e8f0;
        border-radius:12px;
        overflow:hidden;
    ">

        <div style="
            padding:24px 30px;
            background:#253858;
            color:#ffffff;
        ">
            <div style="
                font-size:21px;
                font-weight:700;
            ">
                KV Gjinoci
            </div>

            <div style="
                margin-top:5px;
                font-size:12px;
                color:#cbd5e1;
            ">
                Volleyball Management System
            </div>
        </div>

        <div style="padding:32px 30px;">

            <h1 style="
                margin:0 0 20px;
                color:#172b4d;
                font-size:23px;
                line-height:1.35;
            ">
                Llogaria juaj u aktivizua!
            </h1>

            <p style="
                font-size:14px;
                line-height:1.8;
            ">
                Pershendetje
                <strong>{{ $userName }}</strong>,
            </p>

            <p style="
                font-size:14px;
                line-height:1.8;
                color:#475569;
            ">
                Kemi kenaqesine t'ju njoftojme
                se administratori i KV Gjinocit
                e ka miratuar dhe aktivizuar
                llogarine tuaj.
            </p>

            <div style="
                margin:24px 0;
                padding:16px 18px;
                background:#f0fdf4;
                border:1px solid #bbf7d0;
                border-radius:8px;
            ">

                <div style="
                    margin-bottom:6px;
                    color:#166534;
                    font-size:12px;
                    font-weight:700;
                ">
                    STATUSI I LLOGARISE
                </div>

                <div style="
                    color:#166534;
                    font-size:16px;
                    font-weight:700;
                ">
                    Aktiv
                </div>

            </div>

            <p style="
                font-size:14px;
                line-height:1.8;
                color:#475569;
            ">
                Nga ky moment, llogaria juaj
                eshte aktive dhe mund ta
                perdorni platformen sipas
                autorizimeve te rolit tuaj.
            </p>

            <div style="
                margin:20px 0 26px;
                padding:14px 17px;
                background:#f8fafc;
                border:1px solid #e2e8f0;
                border-radius:8px;
            ">

                <div style="
                    margin-bottom:5px;
                    color:#64748b;
                    font-size:12px;
                ">
                    Roli juaj
                </div>

                <strong style="
                    color:#253858;
                    font-size:15px;
                ">
                    {{ $userRole }}
                </strong>

            </div>

            <a
                href="{{ $loginUrl }}"
                style="
                    display:inline-block;
                    padding:13px 22px;
                    background:#253858;
                    border-radius:7px;
                    color:#ffffff;
                    text-decoration:none;
                    font-size:13px;
                    font-weight:700;
                "
            >
                Hyr ne platforme
            </a>

            <p style="
                margin:24px 0 0;
                font-size:12px;
                line-height:1.8;
                color:#64748b;
            ">
                Per hyrje perdorni emailin
                dhe fjalekalimin e llogarise suaj.
                Mos e ndani fjalekalimin me askend.
            </p>

            <p style="
                margin:28px 0 0;
                font-size:13px;
                line-height:1.8;
            ">
                Me respekt,<br>
                <strong>Administrata e KV Gjinocit</strong>
            </p>

        </div>

        <div style="
            padding:19px 30px;
            background:#f8fafc;
            border-top:1px solid #e2e8f0;
            text-align:center;
            color:#94a3b8;
            font-size:11px;
        ">
            &copy; {{ date('Y') }} KV Gjinoci.
            Te gjitha te drejtat e rezervuara.
        </div>

    </div>

</body>
</html>
