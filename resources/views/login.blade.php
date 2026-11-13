<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - KV Gjinoci</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #172b4d;
        }

        .login-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* LEFT SIDE */

        .login-brand {
            background: linear-gradient(
                145deg,
                #101e38,
                #172b4d,
                #315b89
            );
            color: white;
            padding: 65px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .login-brand::after {
            content: "🏐";
            position: absolute;
            font-size: 480px;
            right: -100px;
            bottom: -130px;
            opacity: .06;
            pointer-events: none;
        }

        .brand-top,
        .brand-content,
        .brand-footer {
            position: relative;
            z-index: 1;
        }

        .brand-top {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-logo {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .brand-top strong {
            font-size: 22px;
        }

        .brand-top small {
            display: block;
            font-size: 11px;
            color: #bfdbfe;
            margin-top: 5px;
            letter-spacing: 1px;
        }

        .brand-content {
            max-width: 580px;
            padding: 55px 0;
        }

        .brand-label {
            display: inline-block;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1.8px;
            color: #bfdbfe;
            margin-bottom: 20px;
        }

        .brand-content h1 {
            font-size: 53px;
            line-height: 1.15;
            margin: 0 0 25px;
        }

        .brand-content h1 span {
            color: #93c5fd;
        }

        .brand-content p {
            color: #dbeafe;
            font-size: 16px;
            line-height: 1.8;
            margin: 0 0 35px;
            max-width: 490px;
        }

        .brand-features {
            display: flex;
            flex-direction: column;
            gap: 17px;
        }

        .brand-feature {
            display: flex;
            align-items: center;
            gap: 13px;
            color: #e2e8f0;
            font-size: 14px;
        }

        .feature-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.12);
            border-radius: 10px;
            font-size: 19px;
        }

        .brand-footer {
            border-top: 1px solid rgba(255,255,255,.15);
            padding-top: 25px;
            color: #bfdbfe;
            font-size: 12px;
        }

        /* RIGHT SIDE */

        .login-main {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 45px;
        }

        .login-container {
            width: 100%;
            max-width: 440px;
        }

        .login-icon {
            width: 65px;
            height: 65px;
            border-radius: 18px;
            background: #e5edff;
            color: #253858;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 29px;
            margin-bottom: 28px;
        }

        .login-container h2 {
            font-size: 33px;
            color: #172b4d;
            margin: 0 0 12px;
        }

        .login-description {
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 32px;
        }

        /* FORM */

        .login-field {
            margin-bottom: 22px;
        }

        .login-field label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 10px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            color: #64748b;
            font-size: 18px;
            pointer-events: none;
        }

        .login-input {
            width: 100%;
            height: 53px;
            border: 1px solid #d4deeb;
            background: white;
            border-radius: 10px;
            padding: 13px 15px 13px 46px;
            font-size: 14px;
            font-family: inherit;
            color: #172b4d;
            outline: none;
            transition: .2s;
        }

        .login-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37,99,235,.08);
        }

        .login-input::placeholder {
            color: #94a3b8;
        }

        .password-input {
            padding-right: 78px;
        }

        .password-toggle {
            position: absolute;
            right: 13px;
            background: none;
            border: none;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            padding: 5px;
        }

        .password-toggle:hover {
            color: #172b4d;
        }

        .login-button {
            width: 100%;
            height: 53px;
            background: #253858;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 12px;
            transition: .2s;
            box-shadow: 0 5px 12px rgba(37,56,88,.15);
        }

        .login-button:hover {
            background: #172b4d;
            transform: translateY(-1px);
        }

        .login-security {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 25px;
            color: #64748b;
            font-size: 12px;
        }

        /* ERRORS */

        .login-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            padding: 15px 17px;
            border-radius: 10px;
            margin-bottom: 23px;
            font-size: 13px;
            line-height: 1.6;
        }

        .login-error ul {
            margin: 7px 0 0;
            padding-left: 19px;
        }

        .login-success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 15px 17px;
            border-radius: 10px;
            margin-bottom: 23px;
            font-size: 13px;
        }

        .field-error {
            display: block;
            color: #dc2626;
            font-size: 12px;
            margin-top: 8px;
        }

        /* MOBILE */

        @media (max-width: 900px) {

            .login-brand {
                padding: 35px;
            }

            .brand-content h1 {
                font-size: 41px;
            }

            .login-main {
                padding: 30px;
            }

        }

        @media (max-width: 700px) {

            .login-page {
                grid-template-columns: 1fr;
            }

            .login-brand {
                padding: 25px;
                min-height: auto;
            }

            .brand-content {
                padding: 35px 0 10px;
            }

            .brand-content h1 {
                font-size: 32px;
                margin-bottom: 15px;
            }

            .brand-content p {
                font-size: 13px;
                margin-bottom: 0;
            }

            .brand-features,
            .brand-footer {
                display: none;
            }

            .brand-label {
                font-size: 10px;
                margin-bottom: 12px;
            }

            .brand-logo {
                width: 43px;
                height: 43px;
                font-size: 22px;
            }

            .brand-top strong {
                font-size: 18px;
            }

            .login-main {
                padding: 35px 24px;
            }

            .login-container h2 {
                font-size: 28px;
            }

            .login-icon {
                width: 52px;
                height: 52px;
                margin-bottom: 20px;
                font-size: 24px;
            }

        }
    </style>
</head>

<body>

<div class="login-page">

    <!-- LEFT SIDE -->

    <div class="login-brand">

        <div class="brand-top">

            <div class="brand-logo">

                🏐

            </div>

            <div>

                <strong>KV Gjinoci</strong>

                <small>VOLLEYBALL MANAGEMENT</small>

            </div>

        </div>

        <div class="brand-content">

            <span class="brand-label">

                SISTEMI I MENAXHIMIT TE KLUBIT

            </span>

            <h1>

                Menaxho klubin.<br>

                <span>

                    Nderto suksesin.

                </span>

            </h1>

            <p>

                Platforma digjitale per menaxhimin
                e volejbollisteve, ekipeve,
                stervitjeve dhe kampionateve
                te klubit KV Gjinoci.

            </p>

            <div class="brand-features">

                <div class="brand-feature">

                    <div class="feature-icon">

                        👥

                    </div>

                    Menaxhimi i lojtareve dhe stafit

                </div>

                <div class="brand-feature">

                    <div class="feature-icon">

                        📊

                    </div>

                    Statistikat dhe performanca

                </div>

                <div class="brand-feature">

                    <div class="feature-icon">

                        📅

                    </div>

                    Planifikimi i ndeshjeve dhe stervitjeve

                </div>

                <div class="brand-feature">

                    <div class="feature-icon">

                        🏆

                    </div>

                    Kampionatet dhe klasifikimi

                </div>

            </div>

        </div>

        <div class="brand-footer">

            © {{ date('Y') }} KV Gjinoci.
            Te gjitha te drejtat e rezervuara.

        </div>

    </div>

    <!-- RIGHT SIDE -->

    <div class="login-main">

        <div class="login-container">

            <div class="login-icon">

                🔐

            </div>

            <h2>Miresevini!</h2>

            <p class="login-description">

                Kyçu ne llogarine tende per te
                vazhduar ne sistemin e menaxhimit
                te KV Gjinocit.

            </p>

            @if(session('success'))

                <div class="login-success">

                    {{ session('success') }}

                </div>

            @endif

            @if(session('error'))

                <div class="login-error">

                    {{ session('error') }}

                </div>

            @endif

            @if($errors->any())

                <div class="login-error">

                    <strong>Kyçja deshtoi.</strong>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <!-- LOGIN FORM -->

            <form method="POST"
                  action="{{ url('/login') }}">

                @csrf

                <!-- EMAIL -->

                <div class="login-field">

                    <label for="email">

                        Email

                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">

                            ✉

                        </span>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="login-input"
                            placeholder="email@example.com"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                            autofocus
                        >

                    </div>

                </div>

                <!-- PASSWORD -->

                <div class="login-field">

                    <label for="password">

                        Fjalekalimi

                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">

                            🔒

                        </span>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="login-input password-input"
                            placeholder="Shkruaj fjalekalimin"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            id="password-toggle"
                            class="password-toggle"
                            aria-controls="password"
                            aria-pressed="false"
                        >

                            Shfaq

                        </button>

                    </div>

                </div>

                <button
                    type="submit"
                    class="login-button"
                >

                    Kyçu ne Sistem →

                </button>

            </form>

            <div class="login-security">

                🔒 Qasje e sigurt ne sistemin e klubit

            </div>

        </div>

    </div>

</div>

<script>
    const passwordInput = document.getElementById(
        'password'
    );

    const toggleButton = document.getElementById(
        'password-toggle'
    );

    toggleButton.addEventListener('click', function () {

        const isHidden =
            passwordInput.type === 'password';

        passwordInput.type =
            isHidden ? 'text' : 'password';

        toggleButton.textContent =
            isHidden ? 'Fshih' : 'Shfaq';

        toggleButton.setAttribute(
            'aria-pressed',
            String(isHidden)
        );

    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });

</script>
</body>
</html>
