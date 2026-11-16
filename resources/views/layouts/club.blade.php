<!DOCTYPE html>
<html lang="sq" data-theme="light">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <meta name="theme-color"
          content="#101e38">

    <title>
        @yield('title', 'KV Gjinoci')
    </title>

    {{-- FAVICON --}}

    @if(file_exists(public_path('images/logo.png')))

        <link rel="icon"
              type="image/png"
              href="{{ asset('images/logo.png') }}">

    @endif

    {{-- LIGHT MODE ONLY --}}

    <script>
        (function () {

            // Largo preferencen e vjeter Dark Mode.

            try {

                localStorage.removeItem(
                    'kv-gjinoci-theme'
                );

            } catch (error) {

                // Aplikacioni vazhdon normalisht.

            }

            // Perdore vetem Light Mode.

            document.documentElement.setAttribute(
                'data-theme',
                'light'
            );

        })();
    </script>

    {{-- GLOBAL CSS --}}

    <link rel="stylesheet"
          href="{{ asset('css/club-ui.css') }}">

    {{-- LIGHT MODE STYLES --}}

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

        .ui-content {

            min-height: calc(100vh - 140px);

            color: #172b4d;

        }

        /* Sidebar dhe topbar mbesin origjinale */

        .ui-main {

            background: #f1f5f9;

        }

        /* Hiqe butonin Dark Mode */

        #themeToggle {

            display: none !important;

        }

        /* Siguro qe kontrollet jane ne Light Mode */

        input,
        select,
        textarea {

            color-scheme: light;

        }

        /* Mos ndrysho pamjen e fotove */

        .ui-content img {

            max-width: 100%;

        }

    </style>

    {{-- MODULE STYLES --}}

    @yield('styles')

    @stack('styles')

</head>

<body>

<div class="ui-shell" id="clubShell">

    {{-- SIDEBAR --}}

    @include('partials.sidebar')

    {{-- MOBILE OVERLAY --}}

    <div class="ui-overlay"
         id="sidebarOverlay"
         aria-hidden="true">
    </div>

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
