<style>
    .kg-navbar {
        background: #172b4d;
        color: white;
        width: 100%;
        padding: 20px 32px;
        font-family: Arial, sans-serif;
        box-sizing: border-box;
    }

    .kg-navbar * {
        box-sizing: border-box;
    }

    .kg-nav-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .kg-brand {
        color: white !important;
        font-size: 23px;
        font-weight: 700;
        text-decoration: none !important;
    }

    .kg-user-area {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .kg-avatar {
        width: 39px;
        height: 39px;
        background: #315b89;
        border-radius: 11px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border: 1px solid rgba(255,255,255,.2);
    }

    .kg-user-info strong {
        display: block;
        color: white;
        font-size: 13px;
    }

    .kg-user-info small {
        display: block;
        color: #bfdbfe;
        font-size: 11px;
        margin-top: 5px;
    }

    .kg-logout-form {
        margin: 0;
    }

    .kg-logout {
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.18);
        color: white;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
    }

    .kg-logout:hover {
        background: #dc2626;
    }

    .kg-nav-links {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 18px;
    }

    .kg-nav-link {
        color: #e2e8f0 !important;
        text-decoration: none !important;
        font-size: 13px;
        padding: 5px 0 9px;
        border-bottom: 2px solid transparent;
        white-space: nowrap;
    }

    .kg-nav-link:hover,
    .kg-nav-link.active {
        color: white !important;
        border-bottom-color: #93c5fd;
    }

    @media (max-width: 800px) {

        .kg-navbar {
            padding: 18px 20px;
        }

        .kg-nav-top {
            flex-wrap: wrap;
        }

        .kg-brand {
            font-size: 19px;
        }

        .kg-nav-links {
            gap: 13px 18px;
        }
    }

    @media (max-width: 500px) {

        .kg-nav-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .kg-user-area {
            width: 100%;
        }

        .kg-logout-form {
            margin-left: auto;
        }
    }
</style>

@php

    $navRoles = [
        'admin' => 'Administrator',
        'manager' => 'Menaxher',
        'coach' => 'Trajner',
        'player' => 'Volejbolliste',
        'pending' => 'Joaktiv'
    ];

    $role = auth()->user()?->role;

    $links = match($role) {

        'admin' => [

            ['Dashboard', 'dashboard', 'dashboard'],

            ['Volejbollistet', 'lojtar.index', 'lojtar.*'],

            ['Trajneret', 'trajner.index', 'trajner.*'],

            ['Ekipet', 'ekipet.index', 'ekipet.*'],

            ['Ndeshjet', 'ndeshjet.index', 'ndeshjet.*'],

            ['Statistikat', 'statistics.index', 'statistics.*'],

            ['Performance', 'performance.index', 'performance.*'],

            ['Sezonet', 'sezonet.index', 'sezonet.*'],

            ['Klubet', 'klubet.index', 'klubet.*'],

            ['Kampionatet', 'kampionatet.index', 'kampionatet.*'],

            ['Stervitjet', 'stervitjet.index', 'stervitjet.*'],

            ['Menaxheret', 'managers.index', 'managers.*'],

            ['Perdoruesit', 'users.index', 'users.*']

        ],

        'coach' => [

            ['Dashboard', 'coach.dashboard', 'coach.dashboard'],

            ['Ndeshjet e Mia', 'coach.ndeshjet', 'coach.ndeshjet*'],

            ['Stervitjet e Mia', 'coach.stervitjet', 'coach.stervitjet*'],

            ['Performance', 'coach.performance', 'coach.performance']

        ],

        'manager' => [

            ['Dashboard', 'manager.dashboard', 'manager.dashboard']

        ],

        'player' => [

            ['Dashboard', 'player.dashboard', 'player.dashboard']

        ],

        default => []

    };

@endphp

<div class="kg-navbar">

    <div class="kg-nav-top">

        <a href="{{ auth()->check() ? route('dashboard') : url('/') }}"
           class="kg-brand">

            KV Gjinoci | Volleyball Management

        </a>

        @auth

            <div class="kg-user-area">

                <div class="kg-avatar">

                    {{ mb_strtoupper(
                        mb_substr(auth()->user()->name, 0, 1)
                    ) }}

                </div>

                <div class="kg-user-info">

                    <strong>

                        {{ auth()->user()->name }}

                    </strong>

                    <small>

                        {{ $navRoles[$role] ?? 'Perdorues' }}

                    </small>

                </div>

                <form method="POST"
                      action="{{ route('logout') }}"
                      class="kg-logout-form">

                    @csrf

                    <button type="submit"
                            class="kg-logout">

                        Dil nga sistemi

                    </button>

                </form>

            </div>

        @endauth

    </div>

    @auth

        @if(count($links))

            <nav class="kg-nav-links">

                @foreach($links as [$label, $routeName, $pattern])

                    @php

                        $active = request()->routeIs($pattern);

                        if ($routeName === 'ndeshjet.index') {

                            $active = $active ||
                                request()->routeIs(
                                    'statistikat-lojtareve.*'
                                );

                        }

                        if ($routeName === 'kampionatet.index') {

                            $active = $active ||
                                request()->routeIs('liga.*');

                        }

                        if ($routeName === 'stervitjet.index') {

                            $active = $active ||
                                request()->routeIs('prezencat.*');

                        }

                        if ($routeName === 'coach.ndeshjet') {

                            $active = $active ||
                                request()->routeIs(
                                    'coach.statistikat*'
                                );

                        }

                        if ($routeName === 'coach.stervitjet') {

                            $active = $active ||
                                request()->routeIs(
                                    'coach.prezenca.*'
                                );

                        }

                    @endphp

                    <a href="{{ route($routeName) }}"
                       class="kg-nav-link {{ $active ? 'active' : '' }}">

                        {{ $label }}

                    </a>

                @endforeach

            </nav>

        @endif

    @endauth

</div>
