@php
    $user = auth()->user();
    $role = $user->role;

    $roleLabels = [
        'admin' => 'Administrator',
        'manager' => 'Menaxher',
        'coach' => 'Trajner',
        'player' => 'Volejbolliste',
        'pending' => 'Ne pritje',
    ];

    $isManagement = in_array(
        $role,
        ['admin', 'manager'],
        true
    );

    $dashboardRoute = match ($role) {
        'manager' => 'manager.dashboard',
        'coach' => 'coach.dashboard',
        'player' => 'player.dashboard',
        default => 'dashboard',
    };

    $groups = [
        'OVERVIEW' => [
            [
                'Dashboard',
                $dashboardRoute,
                $dashboardRoute,
                '◈',
            ],
        ],
    ];

    if (
        in_array(
            $role,
            ['admin', 'manager', 'coach'],
            true
        )
    ) {
        $groups['OVERVIEW'][] = [
            'Paneli i Klubit',
            'paneli-klubit.index',
            'paneli-klubit.*',
            '▥',
        ];
    }

    $groups['OVERVIEW'][] = [
        'Kalendari',
        'kalendari.index',
        'kalendari.*',
        '▦',
    ];

    $groups['OVERVIEW'][] = [
        'Njoftimet',
        'njoftimet.index',
        'njoftimet.*',
        '♧',
    ];

    if ($isManagement) {

        $groups['SPORTS'] = [
            [
                'Ekipet',
                'ekipet.index',
                'ekipet.*',
                '◎',
            ],
            [
                'Volejbollistet',
                'lojtar.index',
                'lojtar.*',
                '♙',
            ],
            [
                'Trajneret',
                'trajner.index',
                'trajner.*',
                '♟',
            ],
            [
                'Pasqyra e Ndeshjeve',
                'ndeshjet-v2.index',
                'ndeshjet-v2.*',
                '▦',
            ],
            [
                'Menaxhimi i Ndeshjeve',
                'ndeshjet.index',
                'ndeshjet.*',
                '🏐',
            ],
            [
                'Match Center',
                'match-center.index',
                'match-center.*',
                '◉',
            ],
            [
                'Formacionet 6+1',
                'formacionet.lista',
                'formacionet.*',
                '▤',
            ],
            [
                'Stervitjet',
                'stervitjet.index',
                'stervitjet.*',
                '▤',
            ],
            [
                'Statistikat',
                'statistics.index',
                'statistics.*',
                '▥',
            ],
            [
                'Performanca',
                'performance.index',
                'performance.*',
                '↗',
            ],
        ];

        $groups['COMPETITIONS'] = [
            [
                'Sezonet',
                'sezonet.index',
                'sezonet.*',
                '◷',
            ],
            [
                'Klubet',
                'klubet.index',
                'klubet.*',
                '⚑',
            ],
            [
                'Kampionatet',
                'kampionatet.index',
                'kampionatet.*',
                '🏆',
            ],
        ];

        $groups['FINANCE'] = [
            [
                'Financat',
                'financat.index',
                'financat.index',
                '€',
            ],
            [
                'Transaksionet',
                'financat.transaksionet.index',
                'financat.transaksionet.*',
                '⇄',
            ],
        ];

        if ($role === 'manager') {
            $groups['FINANCE'][] = [
                'Financat e Mia',
                'financat.mine',
                'financat.mine',
                '€',
            ];
        }
    }

    if ($role === 'coach') {

        $groups['SPORTS'] = [
            [
                'Pasqyra e Ndeshjeve',
                'ndeshjet-v2.index',
                'ndeshjet-v2.*',
                '▦',
            ],
            [
                'Menaxhimi i Ndeshjeve',
                'coach.ndeshjet',
                'coach.ndeshjet*',
                '🏐',
            ],
            [
                'Match Center',
                'match-center.index',
                'match-center.*',
                '◉',
            ],
            [
                'Formacionet 6+1',
                'formacionet.lista',
                'formacionet.*',
                '▤',
            ],
            [
                'Stervitjet',
                'coach.stervitjet',
                'coach.stervitjet*',
                '▤',
            ],
            [
                'Performanca',
                'coach.performance',
                'coach.performance',
                '↗',
            ],
        ];

        $groups['FINANCE'] = [
            [
                'Financat e Mia',
                'financat.mine',
                'financat.mine',
                '€',
            ],
        ];
    }

    if ($role === 'player') {
        $groups['FINANCE'] = [
            [
                'Financat e Mia',
                'financat.mine',
                'financat.mine',
                '€',
            ],
        ];
    }

    if ($role === 'admin') {
        $groups['ADMINISTRATION'] = [
            [
                'Menaxheret',
                'managers.index',
                'managers.*',
                '♟',
            ],
            [
                'Perdoruesit',
                'users.index',
                'users.*',
                '♙',
            ],
            [
                'Activity Log',
                'activity.index',
                'activity.*',
                '◴',
            ],
        ];
    }

    $groups['REPORTS'] = [
        [
            'Raportet PDF',
            'raportet.index',
            'raportet.*',
            '▧',
        ],
    ];

    $groups['SETTINGS'] = [
        [
            'Profili Im',
            'profile.index',
            'profile.index',
            '○',
        ],
        [
            'Sesionet Aktive',
            'profile.sessions.index',
            'profile.sessions.*',
            '◇',
        ],
    ];
@endphp

<aside class="ui-sidebar" id="clubSidebar">

    <a
        href="{{ route($dashboardRoute) }}"
        class="ui-brand"
    >
        <div class="ui-brand-logo">

            @if(file_exists(public_path('images/logo.png')))
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="KV Gjinoci"
                >
            @else
                🏐
            @endif

        </div>

        <div class="ui-brand-text">
            <div class="ui-brand-name">
                KV Gjinoci
            </div>

            <small>
                VOLLEYBALL CLUB
            </small>
        </div>
    </a>

    <nav
        class="ui-sidebar-scroll"
        aria-label="Menu kryesore"
    >
        @foreach($groups as $group => $links)

            @php
                $availableLinks = collect($links)
                    ->filter(
                        fn ($link) =>
                            \Illuminate\Support\Facades\Route::has(
                                $link[1]
                            )
                    );
            @endphp

            @if($availableLinks->isNotEmpty())

                <div class="ui-menu-group">

                    <div class="ui-menu-label">
                        {{ $group }}
                    </div>

                    @foreach($availableLinks as $link)

                        <a
                            href="{{ route($link[1]) }}"
                            class="ui-menu-link
                                {{ request()->routeIs($link[2])
                                    ? 'is-active'
                                    : '' }}"
                            @if(request()->routeIs($link[2]))
                                aria-current="page"
                            @endif
                        >

                            <span
                                class="ui-menu-icon"
                                aria-hidden="true"
                            >
                                {{ $link[3] }}
                            </span>

                            <span class="ui-menu-text">
                                {{ $link[0] }}
                            </span>

                        </a>

                    @endforeach

                </div>

            @endif

        @endforeach
    </nav>

    <div class="ui-sidebar-bottom">

        <div class="ui-sidebar-role">
            {{ strtoupper(
                $roleLabels[$role] ?? 'Perdorues'
            ) }}
        </div>

        <form
            method="POST"
            action="{{ route('logout') }}"
        >
            @csrf

            <button
                type="submit"
                class="ui-logout"
            >
                <span class="ui-menu-icon">
                    ↪
                </span>

                Dil nga Sistemi
            </button>
        </form>

    </div>

</aside>
