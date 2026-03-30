<!DOCTYPE html>
<html lang="fr">
<head>
    <title>BRACONGO — @yield('title', 'Configuration 2FA')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="{{ asset('img/LOGO BRACONGO copie 1.png') }}?v=2">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link class="main-css" href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/admin-redesign.css') }}" rel="stylesheet">
    <style>
        .a-onboarding-shell { min-height: 100vh; background: var(--content-bg); }
        .a-onboarding-top {
            height: var(--topbar-height);
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 1.25rem;
        }
        .a-onboarding-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit; }
        .a-onboarding-brand img { height: 36px; width: auto; }
        .a-onboarding-main { max-width: 640px; margin: 0 auto; padding: 2rem 1.25rem 3rem; }
    </style>
    @stack('styles')
</head>
<body class="a-onboarding-shell">
    <header class="a-onboarding-top">
        <a href="{{ url('/') }}" class="a-onboarding-brand" target="_blank" rel="noopener">
            <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo">
            <span class="fw-bold" style="font-size:.95rem;color:var(--text-primary)">BRACONGO</span>
        </a>
        @auth
        <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
            </button>
        </form>
        @endauth
    </header>
    <main class="a-onboarding-main">
        @include('admin.layouts.partials.alerts')
        @yield('content')
    </main>
    <script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/js/bracongo-confirm.js') }}"></script>
    <script src="{{ asset('admin/js/bracongo-form-submit.js') }}"></script>
    @stack('scripts')
</body>
</html>
