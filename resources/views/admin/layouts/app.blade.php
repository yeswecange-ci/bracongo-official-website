<!DOCTYPE html>
<html lang="fr">

<head>
    <title>BRACONGO — @yield('title', 'Admin')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="BRACONGO">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('img/LOGO BRACONGO copie 1.png') }}?v=2">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/LOGO BRACONGO copie 1.png') }}?v=2">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="{{ asset('admin/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet">

    <link class="main-css" href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/admin-redesign.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>

    <div id="a-preloader">
        <div class="a-preloader-inner">
            <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo">
            <div class="a-preloader-bar"></div>
        </div>
    </div>

    <div class="a-overlay" id="aOverlay"></div>

    <div class="a-layout" id="aLayout">

        <aside class="a-sidebar" id="aSidebar">

            <a href="{{ route('admin.dashboard') }}" class="a-sidebar-brand">
                <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo">
                <span class="a-brand-name">BRA<em>CONGO</em></span>
            </a>

            <div class="a-sidebar-body">
                @include('admin.layouts.partials.sidebar')
            </div>

        </aside>

        <div class="a-main" id="aMain">

            @include('admin.layouts.partials.header')

            <main class="a-content">
                @yield('content')
            </main>

            @include('admin.layouts.partials.footer')

        </div>

    </div>

    @include('admin.layouts.partials.modal-image-preview')

    <script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/js/bracongo-confirm.js') }}"></script>
    <script src="{{ asset('admin/js/bracongo-form-submit.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    @stack('scripts-vendor')

    <script>
    (function () {

        window.addEventListener('load', function () {
            var el = document.getElementById('a-preloader');
            if (!el) return;
            el.classList.add('a-hidden');
            setTimeout(function () { el.remove(); }, 400);
        });

        var layout  = document.getElementById('aLayout');
        var sidebar = document.getElementById('aSidebar');
        var overlay = document.getElementById('aOverlay');

        if (window.innerWidth > 991 && localStorage.getItem('sidebarCollapsed') === 'true') {
            layout.classList.add('sidebar-collapsed');
        }

        document.querySelectorAll('.a-sidebar-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (window.innerWidth <= 991) {
                    sidebar.classList.toggle('is-open');
                    overlay.classList.toggle('show');
                } else {
                    layout.classList.toggle('sidebar-collapsed');
                    localStorage.setItem(
                        'sidebarCollapsed',
                        layout.classList.contains('sidebar-collapsed') ? 'true' : 'false'
                    );
                }
            });
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('is-open');
            overlay.classList.remove('show');
        });

        document.querySelectorAll('.a-nav-link[data-sub]').forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                var targetId = this.getAttribute('data-sub');
                var menu = document.getElementById(targetId);
                if (!menu) return;

                var isOpen = (menu.style.display === 'block');

                document.querySelectorAll('.a-submenu').forEach(function (m) {
                    if (m.id !== targetId) {
                        m.style.display = 'none';
                        var pl = document.querySelector('[data-sub="' + m.id + '"]');
                        if (pl) pl.setAttribute('aria-expanded', 'false');
                    }
                });

                if (isOpen) {
                    menu.style.display = 'none';
                    this.setAttribute('aria-expanded', 'false');
                } else {
                    menu.style.display = 'block';
                    this.setAttribute('aria-expanded', 'true');
                }
            });
        });

        document.querySelectorAll('.a-submenu').forEach(function (menu) {
            if (menu.querySelector('.a-nav-link.is-active')) {
                menu.style.display = 'block';
                var pl = document.querySelector('[data-sub="' + menu.id + '"]');
                if (pl) pl.setAttribute('aria-expanded', 'true');
            }
        });

    })();
    </script>

    @stack('scripts')

</body>
</html>
