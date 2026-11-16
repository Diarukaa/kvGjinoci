@extends('layouts.club')

@section('title', 'Profili Im - KV Gjinoci')

@section('content')

    <style>
        .ps-page {
            max-width: 1150px;
            margin: 20px auto 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .ps-page * {
            box-sizing: border-box;
        }

        .ps-hero {
            background: linear-gradient(
                120deg,#172b4d,#315b89
            );
            color: white;
            padding: 32px;
            border-radius: 20px;
            margin-bottom: 24px;
        }

        .ps-hero small {
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .ps-hero h1 {
            color: white !important;
            font-size: 32px;
            margin: 14px 0;
        }

        .ps-hero p {
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        .ps-layout {
            display: grid;
            grid-template-columns: 320px minmax(0,1fr);
            gap: 24px;
            align-items: start;
        }

        .ps-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            padding: 26px;
            margin-bottom: 24px;
            box-shadow: 0 4px 15px
            rgba(15,23,42,.04);
        }

        .ps-card h2 {
            font-size: 21px;
            margin: 0 0 12px;
        }

        .ps-subtitle {
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
            margin: 0 0 24px;
        }

        .ps-profile-top {
            text-align: center;
            padding-bottom: 22px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 22px;
        }

        .ps-avatar {
            width: 112px;
            height: 112px;
            border-radius: 50%;
            background: linear-gradient(
                135deg,#253858,#60a5fa
            );
            color: white;
            font-size: 40px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            overflow: hidden;
            border: 4px solid #e8efff;
        }

        .ps-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .ps-profile-top h2 {
            margin: 0 0 10px;
            overflow-wrap: anywhere;
        }

        .ps-profile-top p {
            font-size: 12px;
            color: #64748b;
            margin: 10px 0;
            overflow-wrap: anywhere;
        }

        .ps-badge {
            display: inline-block;
            background: #e8efff;
            color: #315b89;
            font-weight: bold;
            font-size: 11px;
            padding: 8px 12px;
            border-radius: 8px;
        }

        .ps-detail {
            padding: 14px 0;
            border-bottom: 1px solid #e2e8f0;
            font-size: 12px;
        }

        .ps-detail span {
            display: block;
            color: #64748b;
            margin-bottom: 7px;
        }

        .ps-detail strong {
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .ps-field {
            margin-bottom: 20px;
        }

        .ps-field label {
            display: block;
            color: #334155;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .ps-field input {
            width: 100%;
            min-height: 44px;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            padding: 12px 14px;
            color: #172b4d;
            background: #f8fafc;
            font-size: 14px;
            outline: none;
        }

        .ps-field input:focus {
            border-color: #2563eb;
            background: white;
        }

        .ps-grid {
            display: grid;
            grid-template-columns: repeat(
            2,minmax(0,1fr)
        );
            gap: 18px;
        }

        .ps-help {
            color: #64748b;
            font-size: 11px;
            line-height: 1.7;
            margin-top: 8px;
        }

        .ps-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #253858;
            color: white !important;
            padding: 13px 18px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none !important;
            cursor: pointer;
        }

        .ps-btn:hover {
            background: #315b89;
        }

        .ps-btn-danger {
            background: #fee2e2;
            color: #b91c1c !important;
        }

        .ps-btn-danger:hover {
            background: #fecaca;
        }

        .ps-btn-light {
            background: #e8efff;
            color: #315b89 !important;
        }

        .ps-btn-light:hover {
            background: #dbeafe;
        }

        .ps-full {
            width: 100%;
        }

        .ps-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            padding-top: 10px;
        }

        .ps-photo-actions {
            display: grid;
            gap: 10px;
        }

        .ps-message {
            padding: 16px;
            margin-bottom: 22px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.8;
        }

        .ps-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .ps-error {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
        }

        .ps-info {
            background: #edf4ff;
            color: #315b89;
            border-radius: 10px;
            padding: 16px;
            font-size: 12px;
            line-height: 1.8;
            margin-top: 18px;
        }

        .ps-password {
            display: flex;
            align-items: stretch;
        }

        .ps-password input {
            border-radius: 9px 0 0 9px;
        }

        .ps-toggle {
            background: #edf2f7;
            color: #315b89;
            border: 1px solid #dbe3ee;
            border-left: none;
            border-radius: 0 9px 9px 0;
            padding: 0 13px;
            font-size: 11px;
            font-weight: bold;
            cursor: pointer;
        }

        .ps-section-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8efff;
            border-radius: 11px;
            font-size: 19px;
            margin-bottom: 15px;
        }

        .ps-footer {
            text-align: center;
            color: #64748b;
            font-size: 12px;
            margin-top: 20px;
        }

        @media(max-width: 850px) {

            .ps-layout {
                grid-template-columns: 1fr;
                gap: 0;
            }

        }

        @media(max-width: 600px) {

            .ps-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .ps-card,
            .ps-hero {
                padding: 20px;
            }

            .ps-hero h1 {
                font-size: 26px;
            }

        }
    </style>

    @php

        $roles = [
            'admin' => 'Administrator',
            'manager' => 'Menaxher',
            'coach' => 'Trajner',
            'player' => 'Volejbolliste',
        ];

        $initials = collect(
            preg_split(
                '/\s+/',
                trim($user->name)
            )
        )->filter()->take(2)->map(
            fn ($name) => mb_strtoupper(
                mb_substr($name, 0, 1)
            )
        )->implode('');

    @endphp

    <div class="ps-page">

        {{-- HEADER --}}

        <div class="ps-hero">

            <small>
                KV GJINOCI | ACCOUNT SETTINGS
            </small>

            <h1>Profili Im</h1>

            <p>
                Menaxho informacionet personale,
                foton e profilit dhe sigurine e llogarise.
            </p>

        </div>

        @if(session('success'))

            <div class="ps-message ps-success">

                {{ session('success') }}

            </div>

        @endif

        @if($errors->any())

            <div class="ps-message ps-error">

                <strong>Kontrollo te dhenat:</strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="ps-layout">

            {{-- KOLONA E MAJTE --}}

            <div>

                <div class="ps-card">

                    <div class="ps-profile-top">

                        <div class="ps-avatar">

                        <span id="avatarInitials"
                              @if($user->profile_photo)
                                  style="display:none;"
                              @endif>

                            {{ $initials }}

                        </span>

                            <img id="profilePreview"
                                 alt="Fotoja e profilit"
                                 @if($user->profile_photo)
                                     src="{{ route('profile.photo.show') }}"
                                 @else
                                     style="display:none;"
                                @endif
                            >

                        </div>

                        <h2>{{ $user->name }}</h2>

                        <span class="ps-badge">

                        {{ $roles[$user->role] ?? $user->role }}

                    </span>

                        <p>{{ $user->email }}</p>

                    </div>

                    {{-- UPLOAD PHOTO --}}

                    <form method="POST"
                          enctype="multipart/form-data"
                          action="{{ route(
                          'profile.photo.update'
                      ) }}">

                        @csrf

                        <div class="ps-field">

                            <label for="profilePhoto">
                                Fotoja e Profilit
                            </label>

                            <input type="file"
                                   name="photo"
                                   id="profilePhoto"
                                   accept=".jpg,.jpeg,.png,.webp"
                                   required>

                            <div class="ps-help">
                                JPG, PNG ose WebP.
                                Maksimumi 2 MB.
                            </div>

                        </div>

                        <div class="ps-photo-actions">

                            <button type="submit"
                                    class="ps-btn ps-full">

                                Ruaj Foton

                            </button>

                        </div>

                    </form>

                    @if($user->profile_photo)

                        <form method="POST"
                              action="{{ route(
                              'profile.photo.destroy'
                          ) }}"
                              style="margin-top:10px;"
                              onsubmit="return confirm('A deshiron ta largosh foton e profilit?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="ps-btn ps-btn-danger ps-full">

                                Largo Foton

                            </button>

                        </form>

                    @endif

                </div>

                {{-- ACCOUNT DETAILS --}}

                <div class="ps-card">

                    <h2>Informacionet e Llogarise</h2>

                    <div class="ps-detail">

                        <span>ID e Perdoruesit</span>

                        <strong>
                            #{{ $user->id }}
                        </strong>

                    </div>

                    <div class="ps-detail">

                        <span>Roli</span>

                        <strong>

                            {{ $roles[$user->role] ?? $user->role }}

                        </strong>

                    </div>

                    <div class="ps-detail">

                        <span>Anetar Qe Nga</span>

                        <strong>

                            {{ $user->created_at?->format('d.m.Y') ?? '-' }}

                        </strong>

                    </div>

                    <div class="ps-detail">

                        <span>Profili i Lidhur</span>

                        <strong>

                            @if($profile)

                                {{ $profile->emri }}
                                {{ $profile->mbiemri }}

                            @elseif($user->role === 'admin')

                                Administrator i Sistemit

                            @else

                                Nuk eshte lidhur ende

                            @endif

                        </strong>

                    </div>

                    @if($user->role === 'player' && $profile)

                        <div class="ps-detail">

                            <span>Pozicioni</span>

                            <strong>

                                {{ $profile->pozicioni ?? '-' }}

                            </strong>

                        </div>

                        <div class="ps-detail">

                            <span>Gjatesia</span>

                            <strong>

                                {{ $profile->gjatesia
                                    ? $profile->gjatesia . ' cm'
                                    : '-' }}

                            </strong>

                        </div>

                    @endif

                    <div class="ps-info">

                        Roli dhe profili sportiv
                        menaxhohen nga administratori.

                    </div>

                </div>

            </div>

            {{-- KOLONA E DJATHTE --}}

            <div>

                {{-- PERSONAL INFORMATION --}}

                <div class="ps-card">

                    <div class="ps-section-icon">👤</div>

                    <h2>Informacionet Personale</h2>

                    <p class="ps-subtitle">

                        Ndrysho emrin dhe emailin
                        e llogarise tende.

                    </p>

                    <form method="POST"
                          action="{{ route(
                          'profile.update'
                      ) }}">

                        @csrf
                        @method('PUT')

                        <div class="ps-grid">

                            <div class="ps-field">

                                <label for="name">

                                    Emri dhe Mbiemri

                                </label>

                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old(
                                       'name',
                                       $user->name
                                   ) }}"
                                       maxlength="255"
                                       required>

                            </div>

                            <div class="ps-field">

                                <label for="email">

                                    Email

                                </label>

                                <input type="email"
                                       name="email"
                                       id="email"
                                       value="{{ old(
                                       'email',
                                       $user->email
                                   ) }}"
                                       maxlength="255"
                                       required>

                            </div>

                        </div>

                        <div class="ps-field">

                            <label for="personalPassword">

                                Konfirmo Fjalekalimin Aktual

                            </label>

                            <div class="ps-password">

                                <input type="password"
                                       name="current_password"
                                       id="personalPassword"
                                       autocomplete="current-password"
                                       required>

                                <button type="button"
                                        class="ps-toggle"
                                        data-password="personalPassword">

                                    Shfaq

                                </button>

                            </div>

                            <div class="ps-help">

                                Per siguri, duhet ta konfirmosh
                                fjalekalimin para ndryshimit
                                te te dhenave.

                            </div>

                        </div>

                        <div class="ps-actions">

                            <button type="submit"
                                    class="ps-btn">

                                Ruaj Ndryshimet

                            </button>

                        </div>

                    </form>

                </div>

                {{-- PASSWORD SECURITY --}}

                <div class="ps-card">

                    <div class="ps-section-icon">🔒</div>

                    <h2>Siguria e Llogarise</h2>

                    <p class="ps-subtitle">

                        Ndrysho fjalekalimin per ta
                        mbajtur llogarine te sigurt.

                    </p>

                    <form method="POST"
                          action="{{ route(
                          'profile.password'
                      ) }}">

                        @csrf
                        @method('PUT')

                        <div class="ps-field">

                            <label for="currentPassword">

                                Fjalekalimi Aktual

                            </label>

                            <div class="ps-password">

                                <input type="password"
                                       name="current_password"
                                       id="currentPassword"
                                       autocomplete="current-password"
                                       required>

                                <button type="button"
                                        class="ps-toggle"
                                        data-password="currentPassword">

                                    Shfaq

                                </button>

                            </div>

                        </div>

                        <div class="ps-field">

                            <label for="newPassword">

                                Fjalekalimi i Ri

                            </label>

                            <div class="ps-password">

                                <input type="password"
                                       name="password"
                                       id="newPassword"
                                       minlength="8"
                                       autocomplete="new-password"
                                       required>

                                <button type="button"
                                        class="ps-toggle"
                                        data-password="newPassword">

                                    Shfaq

                                </button>

                            </div>

                            <div class="ps-help">

                                Minimumi 8 karaktere,
                                me shkronja dhe numra.

                            </div>

                        </div>

                        <div class="ps-field">

                            <label for="confirmPassword">

                                Konfirmo Fjalekalimin e Ri

                            </label>

                            <div class="ps-password">

                                <input type="password"
                                       name="password_confirmation"
                                       id="confirmPassword"
                                       minlength="8"
                                       autocomplete="new-password"
                                       required>

                                <button type="button"
                                        class="ps-toggle"
                                        data-password="confirmPassword">

                                    Shfaq

                                </button>

                            </div>

                        </div>

                        <div class="ps-actions">

                            <button type="submit"
                                    class="ps-btn">

                                Ndrysho Fjalekalimin

                            </button>

                        </div>

                    </form>

                </div>

                {{-- LOGOUT --}}

                <div class="ps-card">

                    <h2>Sesioni Aktual</h2>

                    <p class="ps-subtitle">

                        Dil nga llogaria jote
                        kur perfundon punen ne sistem.

                    </p>

                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                                class="ps-btn ps-btn-danger">

                            Dil nga Sistemi

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <div class="ps-footer">

            KV Gjinoci | Account Settings

        </div>

    </div>

    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {

                // SHFAQ OSE FSHEH PASSWORDIN

                document.querySelectorAll(
                    '[data-password]'
                ).forEach(function (button) {

                    button.addEventListener(
                        'click',
                        function () {

                            const input = document
                                .getElementById(
                                    button.dataset.password
                                );

                            if (!input) {
                                return;
                            }

                            const show =
                                input.type === 'password';

                            input.type = show
                                ? 'text'
                                : 'password';

                            button.textContent = show
                                ? 'Fsheh'
                                : 'Shfaq';

                        }
                    );

                });

                // PREVIEW I FOTOS

                const photo = document.getElementById(
                    'profilePhoto'
                );

                const preview = document.getElementById(
                    'profilePreview'
                );

                const initials = document.getElementById(
                    'avatarInitials'
                );

                const originalSrc =
                    preview.getAttribute('src');

                let previewUrl = null;

                photo.addEventListener(
                    'change',
                    function () {

                        if (previewUrl) {

                            URL.revokeObjectURL(previewUrl);

                            previewUrl = null;

                        }

                        const file = photo.files[0];

                        if (!file) {

                            if (originalSrc) {

                                preview.src = originalSrc;
                                preview.style.display = 'block';
                                initials.style.display = 'none';

                            } else {

                                preview.removeAttribute('src');
                                preview.style.display = 'none';
                                initials.style.display = 'block';

                            }

                            return;
                        }

                        if (file.size > 2 * 1024 * 1024) {

                            alert(
                                'Fotoja nuk duhet te jete me e madhe se 2 MB.'
                            );

                            photo.value = '';

                            photo.dispatchEvent(
                                new Event('change')
                            );

                            return;
                        }

                        previewUrl = URL.createObjectURL(file);

                        preview.src = previewUrl;

                        preview.style.display = 'block';

                        initials.style.display = 'none';

                    }
                );

            }
        );
    </script>

@endsection
