@extends('layouts.club')

@section('title', 'Ses ionet Aktive - KV Gjinoci')

@section('content')

    <style>
        .ss-page {
            max-width: 1100px;
            margin: 20px auto 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .ss-page * {
            box-sizing: border-box;
        }

        .ss-hero {
            background: linear-gradient(
                120deg,
                #172b4d,
                #315b89
            );
            color: white;
            padding: 32px;
            border-radius: 20px;
            margin-bottom: 24px;
        }

        .ss-hero small {
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .ss-hero h1 {
            color: white !important;
            font-size: 32px;
            margin: 14px 0;
        }

        .ss-hero p {
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        .ss-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .ss-stat {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 23px;
            box-shadow: 0 4px 15px
            rgba(15,23,42,.04);
        }

        .ss-stat small {
            color: #64748b;
            font-size: 12px;
        }

        .ss-stat h2 {
            font-size: 32px;
            margin: 12px 0 0;
        }

        .ss-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            padding: 27px;
            margin-bottom: 24px;
            box-shadow: 0 4px 15px
            rgba(15,23,42,.04);
        }

        .ss-card h2 {
            font-size: 21px;
            margin: 0 0 12px;
        }

        .ss-subtitle {
            color: #64748b;
            font-size: 13px;
            line-height: 1.8;
            margin: 0 0 24px;
        }

        .ss-device {
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            padding: 20px;
            margin-bottom: 16px;
        }

        .ss-current {
            background: #f0fdf4;
            border-color: #bbf7d0;
        }

        .ss-device-top {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .ss-device-icon {
            width: 48px;
            height: 48px;
            border-radius: 11px;
            background: #e8efff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .ss-device-info {
            flex: 1;
            min-width: 0;
        }

        .ss-device-info h3 {
            font-size: 16px;
            margin: 0 0 7px;
            overflow-wrap: anywhere;
        }

        .ss-device-info p {
            color: #64748b;
            font-size: 12px;
            margin: 0;
            line-height: 1.6;
        }

        .ss-badge {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 7px 10px;
            border-radius: 7px;
            font-weight: bold;
            font-size: 11px;
            white-space: nowrap;
        }

        .ss-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 19px;
            padding-top: 19px;
            border-top: 1px solid #e2e8f0;
        }

        .ss-detail small {
            display: block;
            color: #64748b;
            font-size: 11px;
            margin-bottom: 6px;
        }

        .ss-detail strong {
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .ss-btn {
            background: #253858;
            color: white !important;
            padding: 13px 17px;
            border-radius: 9px;
            border: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .ss-btn:hover {
            filter: brightness(.94);
        }

        .ss-btn-light {
            background: #e8efff;
            color: #315b89 !important;
        }

        .ss-btn-danger {
            background: #fee2e2;
            color: #b91c1c !important;
        }

        .ss-btn-solid-danger {
            background: #dc2626;
            color: white !important;
        }

        .ss-btn:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .ss-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .ss-field {
            margin-bottom: 18px;
        }

        .ss-field label {
            display: block;
            color: #334155;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .ss-field input {
            width: 100%;
            padding: 13px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            background: #f8fafc;
            color: #172b4d;
            font-size: 14px;
        }

        .ss-field input:focus {
            outline: none;
            border-color: #2563eb;
            background: white;
        }

        .ss-message {
            border-radius: 10px;
            padding: 16px;
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 22px;
        }

        .ss-success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .ss-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
        }

        .ss-info {
            background: #edf4ff;
            color: #315b89;
            padding: 16px;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.8;
            margin-bottom: 22px;
        }

        .ss-danger-zone {
            border-color: #fecaca;
        }

        .ss-empty {
            background: #f8fafc;
            border-radius: 9px;
            padding: 23px;
            text-align: center;
            color: #64748b;
            font-size: 13px;
        }

        .ss-modal {
            width: 100%;
            max-width: 470px;
            padding: 0;
            border: none;
            border-radius: 17px;
            color: #172b4d;
            box-shadow: 0 15px 60px
            rgba(15,23,42,.25);
        }

        .ss-modal::backdrop {
            background: rgba(15,23,42,.55);
        }

        .ss-modal-header {
            background: #172b4d;
            color: white;
            padding: 23px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .ss-modal-header h2 {
            color: white !important;
            margin: 0;
            font-size: 20px;
        }

        .ss-close {
            border: none;
            background: rgba(255,255,255,.15);
            color: white;
            border-radius: 8px;
            width: 34px;
            height: 34px;
            font-size: 20px;
            cursor: pointer;
        }

        .ss-modal-body {
            padding: 25px;
        }

        .ss-modal-body p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.7;
            margin: 0 0 20px;
        }

        @media(max-width: 650px) {

            .ss-hero,
            .ss-card {
                padding: 20px;
            }

            .ss-hero h1 {
                font-size: 26px;
            }

            .ss-device-top {
                flex-wrap: wrap;
            }

            .ss-details {
                grid-template-columns: 1fr;
            }

            .ss-stat {
                padding: 17px;
            }

            .ss-modal {
                max-width: calc(100vw - 30px);
            }
        }
    </style>

    <div class="ss-page">

        {{-- HEADER --}}

        <div class="ss-hero">

            <small>

                KV GJINOCI | ACCOUNT SECURITY

            </small>

            <h1>Sesionet Aktive</h1>

            <p>

                Menaxho pajisjet ku je i kyçur,
                kontrollo aktivitetin e fundit dhe
                largo pajisjet qe nuk i njeh.

            </p>

            <div style="margin-top:20px;">

                <a href="{{ route('profile.index') }}"
                   class="ss-btn ss-btn-light">

                    ← Kthehu te Profili

                </a>

            </div>

        </div>

        {{-- MESSAGES --}}

        @if(session('success'))

            <div class="ss-message ss-success">

                {{ session('success') }}

            </div>

        @endif

        @if($errors->any())

            <div class="ss-message ss-error">

                <strong>Kontrollo te dhenat:</strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- STATISTICS --}}

        <div class="ss-stats">

            <div class="ss-stat">

                <small>Sesionet Aktive</small>

                <h2>{{ $sessions->count() }}</h2>

            </div>

            <div class="ss-stat">

                <small>Pajisjet Tjera</small>

                <h2>{{ $otherSessions }}</h2>

            </div>

        </div>

        {{-- INFORMATION --}}

        <div class="ss-info">

            <strong>Siguria e llogarise:</strong>

            Nese nuk e njeh nje pajisje,
            largoje nga llogaria dhe ndrysho
            fjalekalimin tend.

            Pajisjet e larguara duhet te kyçen
            perseri per te pasur qasje.

        </div>

        {{-- ACTIVE DEVICES --}}

        <div class="ss-card">

            <h2>Pajisjet e Kyçura</h2>

            <p class="ss-subtitle">

                Ketu mund t'i shohesh sesionet
                e fundit te llogarise tende.

            </p>

            @forelse($sessions as $session)

                <div class="ss-device
                {{ $session['is_current']
                    ? 'ss-current'
                    : '' }}">

                    <div class="ss-device-top">

                        <div class="ss-device-icon">

                            @if(in_array(
                                $session['device'],
                                ['iPhone','iPad','Android']
                            ))

                                📱

                            @else

                                💻

                            @endif

                        </div>

                        <div class="ss-device-info">

                            <h3>

                                {{ $session['device'] }}

                            </h3>

                            <p>

                                {{ $session['browser'] }}

                            </p>

                        </div>

                        @if($session['is_current'])

                            <span class="ss-badge">

                            Pajisja Aktuale

                        </span>

                        @endif

                    </div>

                    <div class="ss-details">

                        <div class="ss-detail">

                            <small>IP Adresa</small>

                            <strong>

                                {{ $session['ip'] }}

                            </strong>

                        </div>

                        <div class="ss-detail">

                            <small>Aktiviteti i Fundit</small>

                            <strong>

                                {{ $session['last_activity']
                                    ->timezone('Europe/Belgrade')
                                    ->format('d.m.Y H:i') }}

                            </strong>

                            <div style="
                            color:#64748b;
                            font-size:11px;
                            margin-top:6px;
                        ">

                                {{ $session['last_activity']
                                    ->diffForHumans() }}

                            </div>

                        </div>

                    </div>

                    @unless($session['is_current'])

                        <div class="ss-actions">

                            <button type="button"

                                    class="ss-btn ss-btn-danger"

                                    data-revoke-url="{{ route(
                                    'profile.sessions.destroy',
                                    $session['id']
                                ) }}"

                                    data-device="{{ $session['device'] }}"

                                    data-browser="{{ $session['browser'] }}">

                                Largo Pajisjen

                            </button>

                        </div>

                    @endunless

                </div>

            @empty

                <div class="ss-empty">

                    Nuk ka sesione te regjistruara.
                    Ringarko faqen.

                </div>

            @endforelse

        </div>

        {{-- LOGOUT OTHER DEVICES --}}

        <div class="ss-card ss-danger-zone">

            <h2>Largo Pajisjet Tjera</h2>

            <p class="ss-subtitle">

                Perdor kete funksion nese ke dyshime
                qe dikush tjeter ka qasje ne llogarine
                tende.

                Pajisja qe po perdor aktualisht
                do te mbetet e kyçur.

            </p>

            <form method="POST"

                  action="{{ route(
                  'profile.sessions.destroyOthers'
              ) }}"

                  onsubmit="return confirm('A deshiron t’i largosh te gjitha pajisjet tjera?')">

                @csrf

                @method('DELETE')

                <div class="ss-field">

                    <label for="allSessionsPassword">

                        Konfirmo Fjalekalimin Aktual

                    </label>

                    <input type="password"

                           name="current_password"

                           id="allSessionsPassword"

                           autocomplete="current-password"

                           required>

                </div>

                <div class="ss-actions">

                    <button type="submit"

                            class="ss-btn ss-btn-solid-danger"

                        @disabled($otherSessions === 0)>

                        Largo Te Gjitha Pajisjet Tjera

                    </button>

                </div>

            </form>

        </div>

        <p style="
        text-align:center;
        color:#64748b;
        font-size:12px;
        margin-top:25px;
    ">

            KV Gjinoci | Session Security

        </p>

    </div>

    {{-- CONFIRM DEVICE REMOVAL --}}

    <dialog id="revokeModal" class="ss-modal">

        <div class="ss-modal-header">

            <h2>Largo Pajisjen</h2>

            <button type="button"

                    class="ss-close"

                    id="closeRevokeModal"

                    aria-label="Mbylle">

                ×

            </button>

        </div>

        <div class="ss-modal-body">

            <p id="revokeDescription">

                Konfirmo largimin e pajisjes.

            </p>

            <form method="POST" id="revokeForm">

                @csrf

                @method('DELETE')

                <div class="ss-field">

                    <label for="revokePassword">

                        Fjalekalimi Aktual

                    </label>

                    <input type="password"

                           name="current_password"

                           id="revokePassword"

                           autocomplete="current-password"

                           required>

                </div>

                <div class="ss-actions">

                    <button type="button"

                            class="ss-btn ss-btn-light"

                            id="cancelRevoke">

                        Anulo

                    </button>

                    <button type="submit"

                            class="ss-btn ss-btn-solid-danger">

                        Konfirmo Largimin

                    </button>

                </div>

            </form>

        </div>

    </dialog>

    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const modal = document.getElementById(
                    'revokeModal'
                );

                const form = document.getElementById(
                    'revokeForm'
                );

                const password = document.getElementById(
                    'revokePassword'
                );

                const description = document.getElementById(
                    'revokeDescription'
                );

                document.querySelectorAll(
                    '[data-revoke-url]'
                ).forEach(function (button) {

                    button.addEventListener(
                        'click',
                        function () {

                            form.action =
                                button.dataset.revokeUrl;

                            password.value = '';

                            description.textContent =

                                'A deshiron ta largosh pajisjen '

                                + button.dataset.device

                                + ' - '

                                + button.dataset.browser

                                + ' nga llogaria jote?';

                            modal.showModal();

                            password.focus();

                        }
                    );

                });

                document.getElementById(
                    'closeRevokeModal'
                ).addEventListener('click', function () {

                    modal.close();

                });

                document.getElementById(
                    'cancelRevoke'
                ).addEventListener('click', function () {

                    modal.close();

                });

                modal.addEventListener(
                    'close',
                    function () {

                        password.value = '';

                    }
                );

                modal.addEventListener(
                    'click',
                    function (event) {

                        if (event.target === modal) {

                            modal.close();

                        }

                    }
                );

            }
        );
    </script>

@endsection
