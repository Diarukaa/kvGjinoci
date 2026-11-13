<style>
    .uf-page {
        max-width: 1000px;
        margin: 0 auto;
        padding: 10px 0 35px;
        color: #172b4d;
        font-family: Arial, sans-serif;
    }

    .uf-page * {
        box-sizing: border-box;
    }

    .uf-hero {
        background: linear-gradient(
            120deg, #172b4d, #315b89
        );
        color: white;
        border-radius: 18px;
        padding: 30px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .uf-icon {
        width: 75px;
        height: 75px;
        background: rgba(255,255,255,.15);
        border-radius: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        flex-shrink: 0;
    }

    .uf-hero h1 {
        color: white !important;
        margin: 0 0 10px;
        font-size: 28px;
    }

    .uf-hero p {
        color: #dbeafe;
        font-size: 13px;
        margin: 0;
        line-height: 1.6;
    }

    .uf-card {
        background: white;
        border: 1px solid #e5ebf3;
        border-radius: 17px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 5px 18px rgba(15,23,42,.04);
    }

    .uf-card h2 {
        font-size: 22px;
        margin: 0 0 9px;
    }

    .uf-subtitle {
        color: #64748b;
        font-size: 13px;
        margin: 0 0 24px;
    }

    .uf-grid {
        display: grid;
        grid-template-columns: repeat(
            2, minmax(0, 1fr)
        );
        gap: 22px;
    }

    .uf-full {
        grid-column: 1 / -1;
    }

    .uf-field label {
        display: block;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .uf-field input,
    .uf-field select {
        width: 100%;
        height: 47px;
        padding: 12px 14px;
        border: 1px solid #dbe3ee;
        border-radius: 9px;
        background: #f8fafc;
        color: #172b4d;
        font-size: 14px;
        outline: none;
    }

    .uf-field input:focus,
    .uf-field select:focus {
        border-color: #2563eb;
        background: white;
        box-shadow: 0 0 0 3px rgba(37,99,235,.08);
    }

    .uf-field small {
        display: block;
        color: #64748b;
        font-size: 11px;
        margin-top: 8px;
    }

    .uf-password {
        position: relative;
    }

    .uf-password input {
        padding-right: 75px;
    }

    .uf-toggle {
        position: absolute;
        top: 12px;
        right: 10px;
        background: none;
        border: none;
        color: #64748b;
        font-size: 12px;
        cursor: pointer;
    }

    .uf-note {
        background: #edf4ff;
        border: 1px solid #dbeafe;
        color: #1e40af;
        padding: 17px;
        border-radius: 10px;
        font-size: 13px;
        line-height: 1.7;
        margin-bottom: 23px;
    }

    .uf-errors {
        background: #fff1f2;
        color: #be123c;
        border: 1px solid #fecdd3;
        padding: 17px;
        border-radius: 10px;
        font-size: 13px;
        margin-bottom: 23px;
    }

    .uf-errors ul {
        padding-left: 20px;
        margin: 8px 0 0;
    }

    .uf-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 24px;
        margin-top: 25px;
        border-top: 1px solid #e5ebf3;
    }

    .uf-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #253858;
        color: white !important;
        padding: 13px 20px;
        border: none;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none !important;
        cursor: pointer;
    }

    .uf-btn:hover {
        filter: brightness(.94);
    }

    .uf-btn-gray {
        background: #edf2f7;
        color: #253858 !important;
    }

    @media (max-width: 600px) {
        .uf-grid {
            grid-template-columns: 1fr;
        }

        .uf-card,
        .uf-hero {
            padding: 20px;
        }

        .uf-icon {
            width: 55px;
            height: 55px;
            font-size: 25px;
        }

        .uf-hero h1 {
            font-size: 23px;
        }
    }
</style>

@php
    $isEdit = isset($user);

    $roles = [
        'admin' => 'Administrator',
        'manager' => 'Menaxher',
        'coach' => 'Trajner',
        'player' => 'Volejbolliste',
        'pending' => 'Joaktiv / Pending'
    ];
@endphp

<div class="uf-page">

    <div class="uf-hero">

        <div class="uf-icon">
            {{ $isEdit ? '✏️' : '👤' }}
        </div>

        <div>
            <h1>
                {{ $isEdit
                    ? 'Edito Perdoruesin'
                    : 'Shto Perdorues te Ri' }}
            </h1>

            <p>
                {{ $isEdit
                    ? 'Perditeso informacionet dhe qasjen e perdoruesit.'
                    : 'Krijo nje llogari te re per sistemin KV Gjinoci.' }}
            </p>
        </div>

    </div>

    @if($errors->any())

        <div class="uf-errors">

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

    <div class="uf-card">

        <h2>Informacionet e Llogarise</h2>

        <p class="uf-subtitle">
            Ploteso te dhenat dhe cakto
            rolin e perdoruesit.
        </p>

        <div class="uf-note">

            <strong>🔐 Me rendesi</strong>

            <br>

            Roli Administrator ka qasje te plote.

            Roli Joaktiv nuk mund te kyçet ne sistem.

            @if($isEdit)
                Lere passwordin bosh nese nuk
                deshiron ta ndryshosh.
            @endif

        </div>

        <form method="POST"
              action="{{ $isEdit
                  ? route('users.update', $user)
                  : route('users.store') }}">

            @csrf

            @if($isEdit)
                @method('PUT')
            @endif

            <div class="uf-grid">

                <div class="uf-field">

                    <label for="name">
                        Emri dhe Mbiemri
                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $user->name ?? '') }}"
                           placeholder="Emri dhe mbiemri"
                           required>

                </div>

                <div class="uf-field">

                    <label for="email">
                        Email
                    </label>

                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', $user->email ?? '') }}"
                           placeholder="email@example.com"
                           required>

                </div>

                <div class="uf-field">

                    <label for="password">
                        {{ $isEdit
                            ? 'Fjalekalimi i Ri'
                            : 'Fjalekalimi' }}
                    </label>

                    <div class="uf-password">

                        <input type="password"
                               id="password"
                               name="password"
                               minlength="8"
                               autocomplete="new-password"
                               placeholder="Minimum 8 karaktere"
                               @if(!$isEdit) required @endif>

                        <button type="button"
                                class="uf-toggle"
                                onclick="toggleUserPassword('password', this)">
                            Shfaq
                        </button>

                    </div>

                    @if($isEdit)
                        <small>
                            Lere bosh per ta mbajtur
                            passwordin aktual.
                        </small>
                    @endif

                </div>

                <div class="uf-field">

                    <label for="password_confirmation">
                        Konfirmo Fjalekalimin
                    </label>

                    <div class="uf-password">

                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               minlength="8"
                               autocomplete="new-password"
                               placeholder="Perserite fjalekalimin"
                               @if(!$isEdit) required @endif>

                        <button type="button"
                                class="uf-toggle"
                                onclick="toggleUserPassword('password_confirmation', this)">
                            Shfaq
                        </button>

                    </div>

                </div>

                <div class="uf-field uf-full">

                    <label for="role">
                        Roli i Perdoruesit
                    </label>

                    @if($isEdit && $user->id === auth()->id())

                        <select id="role" disabled>
                            <option>
                                Administrator
                            </option>
                        </select>

                        <input type="hidden"
                               name="role"
                               value="admin">

                        <small>
                            Nuk mund ta ndryshosh
                            rolin e llogarise tende.
                        </small>

                    @else

                        <select name="role"
                                id="role"
                                required>

                            @foreach($roles as $value => $label)

                                <option value="{{ $value }}"
                                    @selected(
                                        old(
                                            'role',
                                            $user->role ?? 'pending'
                                        ) === $value
                                    )>

                                    {{ $label }}

                                </option>

                            @endforeach

                        </select>

                        <small>
                            Roli percakton qasjen
                            e perdoruesit ne sistem.
                        </small>

                    @endif

                </div>

            </div>

            <div class="uf-footer">

                <a href="{{ route('users.index') }}"
                   class="uf-btn uf-btn-gray">

                    Anulo

                </a>

                <button type="submit" class="uf-btn">

                    {{ $isEdit
                        ? '✓ Ruaj Ndryshimet'
                        : '✓ Krijo Perdoruesin' }}

                </button>

            </div>

        </form>

    </div>

</div>

<script>
    function toggleUserPassword(id, button) {
        const input = document.getElementById(id);

        const hidden = input.type === 'password';

        input.type = hidden ? 'text' : 'password';

        button.textContent = hidden ? 'Fshih' : 'Shfaq';
    }
</script>
