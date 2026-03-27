<!DOCTYPE html>
<html lang="fr">
<head>
    <title>BRACONGO — @yield('title', 'Connexion')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('img/LOGO BRACONGO copie 1.png') }}?v=2">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link class="main-css" href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/admin-redesign.css') }}" rel="stylesheet">
    @stack('styles')
    <style>
        .a-auth-page { min-height: 100vh; display: flex; align-items: center; justify-content: center;
            padding: 2rem 1rem; background: linear-gradient(160deg, #fafafa 0%, #f0f1f3 45%, #eceef1 100%); }
        .a-auth-card { width: 100%; max-width: 420px; border-radius: 14px; border: 1px solid var(--border);
            box-shadow: 0 12px 40px rgba(15, 23, 42, 0.08); overflow: hidden; background: #fff; }
        .a-auth-card__head { padding: 1.75rem 1.75rem 1rem; text-align: center; border-bottom: 1px solid var(--border); }
        .a-auth-card__body { padding: 1.75rem; }
        .a-auth-logo { height: 52px; width: auto; object-fit: contain; margin-bottom: 0.75rem; }
        .a-auth-title { font-weight: 700; font-size: 1.1rem; color: var(--text-primary); margin: 0; }
        .a-auth-sub { font-size: 0.82rem; color: var(--text-secondary); margin: 0.35rem 0 0; }
    </style>
</head>
<body>
    <div class="a-auth-page">
        <div class="a-auth-card">
            @yield('guest-content')
        </div>
    </div>
    <script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
