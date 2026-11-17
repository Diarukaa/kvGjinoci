<!DOCTYPE html>
<html lang="sq" data-theme="light">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <meta
        name="theme-color"
        content="#101e38"
    >

    <title>@yield('title', 'KV Gjinoci')</title>

    @if(file_exists(public_path('images/logo.png')))
        <link
            rel="icon"
            type="image/png"
            href="{{ asset('images/logo.png') }}"
        >
    @endif

    {{-- INITIAL SETTINGS --}}

    <script>
        (function () {
            document.documentElement.setAttribute(
                'data-theme',
                'light'
            );

            document.documentElement.classList.add(
                'sidebar-scroll-restoring'
            );

            try {
                localStorage.removeItem('kv-gjinoci-theme');
            } catch (error) {
                // Storage mund te jete i bllokuar.
            }
        })();
    </script>

    {{-- GLOBAL CSS --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/club-ui.css') }}"
    >

    <style>
        :root {
            color-scheme: light;

            --ui-bg: #f1f5f9;
            --ui-surface: #ffffff;
            --ui-text: #172b4d;
            --ui-muted: #64748b;
            --ui-border: #e2e8f0;
            --ui-primary: #253858;
        }

        html,
        body {
            color-scheme: light;
            background: #f1f5f9;
        }

        .ui-main {
            background: #f1f5f9;
        }

        .ui-content {
            min-height: calc(100vh - 140px);
            color: #172b4d;
        }

        #themeToggle {
            display: none !important;
        }

        input,
        select,
        textarea {
            color-scheme: light;
        }

        .ui-content img {
            max-width: 100%;
        }

        /*
         * Sidebar-i fshihet vetem gjate
         * rikthimit te pozicionit.
         *
         * Nuk perdoret display:none,
         * sepse scrollTop nuk do te
         * rikthehej sakte.
         */

        .sidebar-scroll-restoring
        #clubSidebar .ui-sidebar-scroll {
            visibility: hidden;
            scroll-behavior: auto !important;
        }
    </style>

    @yield('styles')
    @stack('styles')

</head>

<body>

<div class="ui-shell" id="clubShell">

    {{-- SIDEBAR --}}

    @include('partials.sidebar')

    {{--
        RESTORE SCROLL IMMEDIATELY

        Ekzekutohet menjehere pasi sidebar-i
        ekziston ne DOM, pa prit DOMContentLoaded
        dhe pa requestAnimationFrame.
    --}}

    <script>
        (function () {
            'use strict';

            const KEY = 'kv-gjinoci-sidebar-scroll';

            const sidebar = document.querySelector(
                '#clubSidebar .ui-sidebar-scroll'
            );

            if (!sidebar) {
                document.documentElement.classList.remove(
                    'sidebar-scroll-restoring'
                );
                return;
            }

            let savedPosition = 0;

            try {
                const value = sessionStorage.getItem(KEY);
                const number = Number(value);

                if (
                    value !== null &&
                    Number.isFinite(number) &&
                    number >= 0
                ) {
                    savedPosition = number;
                }
            } catch (error) {
                savedPosition = 0;
            }

            // Rikthe pa animacion.

            const previousBehavior =
                sidebar.style.scrollBehavior;

            sidebar.style.scrollBehavior = 'auto';

            sidebar.scrollTop = savedPosition;

            sidebar.style.scrollBehavior = previousBehavior;

            // Shfaq sidebar-in ne pozicionin e duhur.

            document.documentElement.classList.remove(
                'sidebar-scroll-restoring'
            );

            // Ruaj pozicionin ne menyre te lehte.

            let lastPosition = Math.round(sidebar.scrollTop);

            function savePosition() {
                const position = Math.round(sidebar.scrollTop);

                if (position === lastPosition) {
                    return;
                }

                lastPosition = position;

                try {
                    sessionStorage.setItem(
                        KEY,
                        String(position)
                    );
                } catch (error) {
                    // Nuk e pengon navigimin.
                }
            }

            sidebar.addEventListener(
                'scroll',
                savePosition,
                { passive: true }
            );

            // Ruaje edhe kur klikohet nje link.

            sidebar.addEventListener(
                'click',
                function (event) {
                    if (
                        event.target instanceof Element &&
                        event.target.closest('a')
                    ) {
                        try {
                            sessionStorage.setItem(
                                KEY,
                                String(
                                    Math.round(sidebar.scrollTop)
                                )
                            );
                        } catch (error) {
                            // Vazhdon normalisht.
                        }
                    }
                },
                true
            );

            window.addEventListener(
                'pagehide',
                function () {
                    try {
                        sessionStorage.setItem(
                            KEY,
                            String(
                                Math.round(sidebar.scrollTop)
                            )
                        );
                    } catch (error) {
                        // Vazhdon normalisht.
                    }
                }
            );
        })();
    </script>

    {{-- MOBILE OVERLAY --}}

    <div
        class="ui-overlay"
        id="sidebarOverlay"
        aria-hidden="true"
    ></div>

    {{-- MAIN APPLICATION --}}

    <div class="ui-main">

        {{-- TOPBAR --}}

        @include('partials.topbar')

        {{-- PAGE CONTENT --}}

        <main class="ui-content">
            @yield('content')
        </main>

        {{-- FOOTER --}}

        <footer class="ui-footer">
            © {{ date('Y') }} KV Gjinoci
            · Volleyball Management System
        </footer>

    </div>

</div>

{{-- GLOBAL JAVASCRIPT --}}

<script src="{{ asset('js/club-ui.js') }}"></script>

{{-- MODULE JAVASCRIPT --}}

@yield('scripts')
@stack('scripts')

</body>
</html>
