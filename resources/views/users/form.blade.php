<style>
    .uf-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 28px;
        color: #172b4d;
        box-shadow: 0 4px 15px rgba(15,23,42,.04);
    }

    .uf-card * {
        box-sizing: border-box;
    }

    .uf-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0,1fr));
        gap: 22px;
    }

    .uf-field label {
        display: block;
        font-size: 13px;
        font-weight: bold;
        color: #334155;
        margin-bottom: 9px;
    }

    .uf-field input,
    .uf-field select {
        width: 100%;
        min-height: 46px;
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
    }

    .uf-full {
        grid-column: 1 / -1;
    }

    .uf-help {
        color: #64748b;
        font-size: 12px;
        line-height: 1.7;
        margin-top: 8px;
    }

    .uf-profile {
        background: #f0f6ff;
        border: 1px solid #dbeafe;
        border-radius: 12px;
        padding: 20px;
        margin-top: 2px;
    }

    .uf-error {
        background: #fff1f2;
        color: #be123c;
        border: 1px solid #fecdd3;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 22px;
        font-size: 13px;
        line-height: 1.8;
    }

    .uf-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
        border-top: 1px solid #e2e8f0;
        padding-top: 23px;
        margin-top: 28px;
    }

    .uf-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #253858;
        color: white !important;
        border: none;
        padding: 13px 20px;
        border-radius: 9px;
        text-decoration: none !important;
        font-size: 13px;
        font-weight: bold;
        cursor: pointer;
    }

    .uf-btn-light {
        background: #edf2f7;
        color: #253858 !important;
    }

    .uf-card [hidden] {
        display: none !important;
    }

    @media(max-width: 600px) {
        .uf-grid {
            grid-template-columns: 1fr;
        }

        .uf-card {
            padding: 20px;
        }
    }
</style>

@php
    $editing = $user->exists;

    $ownAccount = $editing
        && $user->id === auth()->id();

    $selectedRole = old(
        'role',
        $user->role ?? 'pending'
    );
@endphp

<div class="uf-card">

    @if($errors->any())

        <div class="uf-error">

            <strong>Kontrollo te dhenat:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <form method="POST"
          action="{{ $editing
            ? route('users.update', $user)
            : route('users.store') }}">

        @csrf

        @if($editing)
            @method('PUT')
        @endif

        <div class="uf-grid">

            {{-- EMRI --}}

            <div class="uf-field">

                <label for="name">
                    Emri dhe Mbiemri
                </label>

                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $user->name) }}"
                       maxlength="255"
                       required>

            </div>

            {{-- EMAIL --}}

            <div class="uf-field">

                <label for="email">
                    Email
                </label>

                <input type="email"
                       name="email"
                       id="email"
                       value="{{ old('email', $user->email) }}"
                       maxlength="255"
                       required>

            </div>

            {{-- ROLI --}}

            <div class="uf-field uf-full">

                <label for="role">
                    Roli i Perdoruesit
                </label>

                <select name="role"
                        id="role"
                        required
                    @disabled($ownAccount)>

                    @foreach($roles as $value => $label)

                        <option value="{{ $value }}"
                            @selected($selectedRole === $value)>

                            {{ $label }}

                        </option>

                    @endforeach

                </select>

                @if($ownAccount)

                    <input type="hidden"
                           name="role"
                           value="admin">

                    <div class="uf-help">
                        Nuk mund ta ndryshosh rolin
                        e llogarise tende.
                    </div>

                @else

                    <div class="uf-help">
                        Zgjedh rolin dhe profilin perkates.
                    </div>

                @endif

            </div>

            {{-- TRAJNERI --}}

            <div class="uf-profile uf-full"
                 id="coachProfile"
                 hidden>

                <div class="uf-field">

                    <label for="trajner_id">
                        Lidhe me Profilin e Trajnerit
                    </label>

                    <select name="trajner_id"
                            id="trajner_id">

                        <option value="">
                            Zgjedh trajnerin
                        </option>

                        @foreach($trajneret as $trajner)

                            <option value="{{ $trajner->id }}"
                                @selected(old(
                                    'trajner_id',
                                    $user->trajner_id
                                ) == $trajner->id)>

                                {{ $trajner->emri }}
                                {{ $trajner->mbiemri }}

                            </option>

                        @endforeach

                    </select>

                    <div class="uf-help">

                        Trajneri do te kete qasje ne ekipet
                        ku eshte i caktuar.

                    </div>

                    @if($trajneret->isEmpty())

                        <div class="uf-help">
                            Nuk ka trajner te lire.
                            <a href="{{ route('trajner.create') }}">
                                Krijo trajner te ri
                            </a>
                        </div>

                    @endif

                </div>

            </div>

            {{-- VOLEJBOLLISTJA --}}

            <div class="uf-profile uf-full"
                 id="playerProfile"
                 hidden>

                <div class="uf-field">

                    <label for="lojtar_id">
                        Lidhe me Profilin e Volejbollistes
                    </label>

                    <select name="lojtar_id"
                            id="lojtar_id">

                        <option value="">
                            Zgjedh volejbollisten
                        </option>

                        @foreach($lojtaret as $lojtar)

                            <option value="{{ $lojtar->id }}"
                                @selected(old(
                                    'lojtar_id',
                                    $user->lojtar_id
                                ) == $lojtar->id)>

                                {{ $lojtar->emri }}
                                {{ $lojtar->mbiemri }}
                                - {{ $lojtar->pozicioni ?? '-' }}

                            </option>

                        @endforeach

                    </select>

                    <div class="uf-help">

                        Volejbollistja do t'i shohe
                        statistikat dhe prezencen e vet.

                    </div>

                    @if($lojtaret->isEmpty())

                        <div class="uf-help">
                            Nuk ka volejbolliste te lire.
                            <a href="{{ route('lojtar.create') }}">
                                Krijo volejbolliste te re
                            </a>
                        </div>

                    @endif

                </div>

            </div>

            {{-- MENAXHERI --}}

            <div class="uf-profile uf-full"
                 id="managerProfile"
                 hidden>

                <div class="uf-field">

                    <label for="manager_id">
                        Lidhe me Profilin e Menaxherit
                    </label>

                    <select name="manager_id"
                            id="manager_id">

                        <option value="">
                            Zgjedh menaxherin
                        </option>

                        @foreach($menaxheret as $manager)

                            <option value="{{ $manager->id }}"
                                @selected(old(
                                    'manager_id',
                                    $user->manager_id
                                ) == $manager->id)>

                                {{ $manager->emri }}
                                {{ $manager->mbiemri }}

                            </option>

                        @endforeach

                    </select>

                    <div class="uf-help">

                        Menaxheri do te kete qasje
                        ne modulet sportive te klubit.

                    </div>

                    @if($menaxheret->isEmpty())

                        <div class="uf-help">
                            Nuk ka menaxher te lire.
                            <a href="{{ route('managers.create') }}">
                                Krijo menaxher te ri
                            </a>
                        </div>

                    @endif

                </div>

            </div>

            {{-- PASSWORD --}}

            <div class="uf-field">

                <label for="password">

                    {{ $editing
                        ? 'Fjalekalimi i Ri'
                        : 'Fjalekalimi' }}

                </label>

                <input type="password"
                       name="password"
                       id="password"
                       minlength="8"
                       autocomplete="new-password"
                    @required(!$editing)>

                <div class="uf-help">

                    {{ $editing
                        ? 'Lere bosh nese nuk deshiron ta ndryshosh.'
                        : 'Minimumi 8 karaktere.' }}

                </div>

            </div>

            <div class="uf-field">

                <label for="password_confirmation">
                    Konfirmo Fjalekalimin
                </label>

                <input type="password"
                       name="password_confirmation"
                       id="password_confirmation"
                       minlength="8"
                       autocomplete="new-password"
                    @required(!$editing)>

            </div>

        </div>

        <div class="uf-actions">

            <a href="{{ route('users.index') }}"
               class="uf-btn uf-btn-light">

                Anulo

            </a>

            <button type="submit" class="uf-btn">

                {{ $editing
                    ? 'Ruaj Ndryshimet'
                    : 'Krijo Perdoruesin' }}

            </button>

        </div>

    </form>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const role = document.getElementById('role');

        const profiles = {
            coach: document.getElementById('coachProfile'),
            player: document.getElementById('playerProfile'),
            manager: document.getElementById('managerProfile')
        };

        function perditesoProfilin() {

            Object.entries(profiles).forEach(
                ([key, container]) => {

                    const active = role.value === key;

                    container.hidden = !active;

                    const select = container.querySelector('select');

                    select.disabled = !active;

                    select.required = active;
                }
            );
        }

        role.addEventListener(
            'change',
            perditesoProfilin
        );

        perditesoProfilin();
    });
</script>
