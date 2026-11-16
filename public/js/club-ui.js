document.addEventListener('DOMContentLoaded', function () {

    const shell = document.getElementById('clubShell');

    const sidebarToggle = document.getElementById(
        'sidebarToggle'
    );

    const overlay = document.getElementById(
        'sidebarOverlay'
    );

    const themeToggle = document.getElementById(
        'themeToggle'
    );

    const themeIcon = document.getElementById(
        'themeIcon'
    );

    const root = document.documentElement;

    // ==============================
    // MOBILE SIDEBAR
    // ==============================

    function setSidebar(open) {

        if (!shell || !sidebarToggle) {
            return;
        }

        shell.classList.toggle(
            'sidebar-open',
            open
        );

        sidebarToggle.setAttribute(
            'aria-expanded',
            String(open)
        );

    }

    if (sidebarToggle && shell) {

        sidebarToggle.addEventListener(
            'click',
            function () {

                const isOpen = shell.classList.contains(
                    'sidebar-open'
                );

                setSidebar(!isOpen);

            }
        );

    }

    if (overlay) {

        overlay.addEventListener(
            'click',
            function () {

                setSidebar(false);

            }
        );

    }

    document.querySelectorAll(
        '.ui-sidebar .ui-menu-link'
    ).forEach(function (link) {

        link.addEventListener(
            'click',
            function () {

                if (window.innerWidth <= 1024) {

                    setSidebar(false);

                }

            }
        );

    });

    window.addEventListener('resize', function () {

        if (window.innerWidth > 1024) {

            setSidebar(false);

        }

    });

    // ==============================
    // THEME MANAGEMENT
    // ==============================

    function getTheme() {

        try {

            return localStorage.getItem(
                'kv-gjinoci-theme'
            ) === 'dark'
                ? 'dark'
                : 'light';

        } catch (error) {

            return 'light';

        }
    }

    function applyTheme(theme) {

        root.setAttribute(
            'data-theme',
            theme
        );

        if (themeToggle) {

            themeToggle.setAttribute(
                'aria-pressed',
                String(theme === 'dark')
            );

        }

        if (!themeIcon) {
            return;
        }

        if (theme === 'dark') {

            themeIcon.innerHTML = `

                <circle cx="12" cy="12" r="4"/>

                <path d="
                    M12 2v2
                    M12 20v2
                    M2 12h2
                    M20 12h2
                    M4.93 4.93l1.42 1.42
                    M17.65 17.65l1.42 1.42
                    M4.93 19.07l1.42-1.42
                    M17.65 6.35l1.42-1.42
                "/>

            `;

        } else {

            themeIcon.innerHTML = `

                <path d="
                    M20.9 13.35
                    A9 9 0 0 1 10.65 3.1
                    A9 9 0 1 0 20.9 13.35Z
                "/>

            `;

        }
    }

    applyTheme(getTheme());

    if (themeToggle) {

        themeToggle.addEventListener(
            'click',
            function () {

                const theme = root.getAttribute(
                    'data-theme'
                ) === 'dark'
                    ? 'light'
                    : 'dark';

                try {

                    localStorage.setItem(
                        'kv-gjinoci-theme',
                        theme
                    );

                } catch (error) {

                    // Theme still works without storage.

                }

                applyTheme(theme);

            }
        );

    }

    // ==============================
    // CLOSE DROPDOWNS
    // ==============================

    const dropdowns = document.querySelectorAll(
        '.ui-dropdown'
    );

    dropdowns.forEach(function (dropdown) {

        dropdown.addEventListener(
            'toggle',
            function () {

                if (!dropdown.open) {
                    return;
                }

                dropdowns.forEach(function (other) {

                    if (other !== dropdown) {

                        other.open = false;

                    }

                });

            }
        );

    });

    document.addEventListener('click', function (event) {

        dropdowns.forEach(function (dropdown) {

            if (!dropdown.contains(event.target)) {

                dropdown.open = false;

            }

        });

    });

    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            dropdowns.forEach(function (dropdown) {

                dropdown.open = false;

            });

            setSidebar(false);

        }

    });

});
