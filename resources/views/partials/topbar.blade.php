@php

    $topUser = auth()->user();

    $topRoles = [

        'admin' => 'Administrator',

        'manager' => 'Menaxher',

        'coach' => 'Trajner',

        'player' => 'Volejbolliste',

        'pending' => 'Ne pritje',

    ];

    $pageTitle = trim($__env->yieldContent(
        'title',
        'Dashboard'
    ));

    $pageTitle = str_replace(
        [' - KV Gjinoci', ' | KV Gjinoci'],
        '',
        $pageTitle
    );

    $initials = collect(
        preg_split('/\s+/', trim($topUser->name))
    )->filter()
     ->take(2)
     ->map(fn ($part) =>
        mb_strtoupper(mb_substr($part, 0, 1))
     )->implode('');

    $unreadCount = $topUser
        ->unreadNotifications()
        ->count();

    $latestNotifications = $topUser
        ->notifications()
        ->latest()
        ->take(5)
        ->get();

    $notificationRoute = collect([

        'njoftimet.index',

        'notifications.index',

    ])->first(fn ($name) =>
        \Illuminate\Support\Facades\Route::has($name)
    );

@endphp

<header class="ui-topbar">

    {{-- LEFT SIDE --}}

    <div class="ui-topbar-left">

        <button type="button"
                class="ui-icon-button ui-mobile-menu"
                id="sidebarToggle"
                aria-label="Hape menune"
                aria-controls="clubSidebar"
                aria-expanded="false">

            <svg viewBox="0 0 24 24">

                <path d="M4 6h16M4 12h16M4 18h16"/>

            </svg>

        </button>

        <div style="min-width:0;">

            <div class="ui-topbar-title">

                {{ $pageTitle }}

            </div>

            <div class="ui-breadcrumb">

                KV Gjinoci / {{ $pageTitle }}

            </div>

        </div>

    </div>

    {{-- RIGHT SIDE --}}

    <div class="ui-topbar-right">

        {{-- DARK MODE --}}

        <button type="button"
                class="ui-icon-button"
                id="themeToggle"
                aria-label="Ndrysho temen"
                title="Ndrysho temen">

            <svg viewBox="0 0 24 24"
                 id="themeIcon">

                <path d="M20.9 13.35A9 9 0 0 1 10.65 3.1 9 9 0 1 0 20.9 13.35Z"/>

            </svg>

        </button>

        {{-- NOTIFICATIONS --}}

        <details class="ui-dropdown">

            <summary class="ui-icon-button"
                     aria-label="Njoftimet">

                <svg viewBox="0 0 24 24">

                    <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>

                    <path d="M10 21h4"/>

                </svg>

                @if($unreadCount > 0)

                    <span class="ui-notification-count">

                        {{ $unreadCount > 99
                            ? '99+'
                            : $unreadCount }}

                    </span>

                @endif

            </summary>

            <div class="ui-dropdown-panel">

                <div class="ui-dropdown-heading">

                    Njoftimet

                    <span style="
                        color:var(--ui-muted);
                        font-size:11px;
                        float:right;
                    ">

                        {{ $unreadCount }} te palexuara

                    </span>

                </div>

                @forelse($latestNotifications as $notification)

                    <div class="ui-notification-item"
                         @if(!$notification->read_at)
                             style="border-left:3px solid #60a5fa;"
                        @endif>

                        <strong>

                            {{ data_get(
                                $notification->data,
                                'title',
                                data_get(
                                    $notification->data,
                                    'titulli',
                                    'Njoftim'
                                )
                            ) }}

                        </strong>

                        <p>

                            {{ \Illuminate\Support\Str::limit(
                                data_get(
                                    $notification->data,
                                    'message',
                                    data_get(
                                        $notification->data,
                                        'mesazhi',
                                        ''
                                    )
                                ),
                                100
                            ) }}

                        </p>

                        <time>

                            {{ $notification->created_at
                                ->diffForHumans() }}

                        </time>

                    </div>

                @empty

                    <div class="ui-empty-message">

                        Nuk ke njoftime.

                    </div>

                @endforelse

                @if($notificationRoute)

                    <a href="{{ route($notificationRoute) }}"
                       class="ui-dropdown-link"
                       style="
                           text-align:center;
                           font-weight:700;
                           margin-top:5px;
                       ">

                        Shiko Te Gjitha Njoftimet →

                    </a>

                @endif

            </div>

        </details>

        {{-- PROFILE --}}

        <details class="ui-dropdown">

            <summary class="ui-user-button">

                <div class="ui-avatar">

                    @if($topUser->profile_photo)

                        <img src="{{ route(
                            'profile.photo.show'
                        ) }}"
                             alt="Fotoja e profilit">

                    @else

                        {{ $initials }}

                    @endif

                </div>

                <div class="ui-user-text">

                    <div class="ui-user-name">

                        {{ $topUser->name }}

                    </div>

                    <small class="ui-user-role">

                        {{ $topRoles[$topUser->role]
                            ?? 'Perdorues' }}

                    </small>

                </div>

                <span class="ui-user-text"
                      style="font-size:11px;">

                    ▾

                </span>

            </summary>

            <div class="ui-dropdown-panel"
                 style="width:240px;">

                <div class="ui-dropdown-heading">

                    Llogaria Ime

                </div>

                <a href="{{ route('profile.index') }}"
                   class="ui-dropdown-link">

                    👤 &nbsp; Profili Im

                </a>

                <a href="{{ route('profile.sessions.index') }}"
                   class="ui-dropdown-link">

                    🔒 &nbsp; Sesionet Aktive

                </a>

                <a href="{{ route('raportet.index') }}"
                   class="ui-dropdown-link">

                    📄 &nbsp; Raportet

                </a>

                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                            class="ui-dropdown-link"
                            style="
                                width:100%;
                                border:none;
                                background:transparent;
                                text-align:left;
                                cursor:pointer;
                                color:#dc2626;
                            ">

                        ↪ &nbsp; Dil nga Sistemi

                    </button>

                </form>

            </div>

        </details>

    </div>

</header>
