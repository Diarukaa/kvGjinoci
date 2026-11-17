<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Mire se erdhe ne KV Gjinoci</title>
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
                letter-spacing:.2px;
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
                font-size:23px;
                line-height:1.35;
                color:#172b4d;
            ">
            Mire se erdhe!
        </h1>

        <p style="
                margin:0 0 18px;
                font-size:14px;
                line-height:1.8;
            ">
            Pershendetje
            <strong>{{ $userName }}</strong>,
        </p>

        <p style="
                margin:0 0 20px;
                font-size:14px;
                line-height:1.8;
                color:#475569;
            ">
            Llogaria juaj eshte krijuar me sukses
            ne platformen e menaxhimit te klubit
            KV Gjinoci.
        </p>

        <div style="
                padding:16px 18px;
                margin-bottom:25px;
                background:#f8fafc;
                border:1px solid #e2e8f0;
                border-radius:8px;
            ">

            <div style="
                    color:#64748b;
                    font-size:12px;
                    margin-bottom:5px;
                ">
                Roli juaj ne platforme
            </div>

            <div style="
                    font-size:15px;
                    font-weight:700;
                    color:#253858;
                ">
                {{ $userRole }}
            </div>

        </div>

        <p style="
                margin:0 0 20px;
                font-size:14px;
                line-height:1.8;
                color:#475569;
            ">
            Per te hyre ne platforme,
            perdorni adresen tuaj te emailit
            dhe fjalekalimin e vendosur
            per llogarine tuaj.
        </p>

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
                margin:26px 0 0;
                color:#64748b;
                font-size:12px;
                line-height:1.7;
            ">
            Nese nuk e prisnit kete email,
            kontaktoni administratorin e klubit.
            Mos ndani fjalekalimin tuaj me askend.
        </p>

        <p style="
                margin:26px 0 0;
                font-size:13px;
                line-height:1.8;
            ">
            Me respekt,<br>
            <strong>KV Gjinoci</strong>
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
