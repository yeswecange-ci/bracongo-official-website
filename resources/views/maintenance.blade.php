<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    @php
        $couleur = filled($parametres->couleur_principale ?? null) ? $parametres->couleur_principale : '#E30613';
        $logoHref = filled($parametres->logo ?? null) ? asset($parametres->logo) : asset('img/LOGO BRACONGO copie 1.webp');
        $faviconHref = filled($parametres->favicon ?? null) ? asset($parametres->favicon) : $logoHref;
        $titre = filled(trim((string) ($parametres->maintenance_titre ?? ''))) ? $parametres->maintenance_titre : 'Site en maintenance';
        $message = filled(trim((string) ($parametres->maintenance_message ?? '')))
            ? $parametres->maintenance_message
            : "Notre site est momentanément indisponible pour cause de maintenance. Nous revenons très vite. Merci de votre patience.";
    @endphp
    <link rel="icon" href="{{ $faviconHref }}?v=2">
    <title>{{ $titre }} — Bracongo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --brand: {{ $couleur }}; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Montserrat', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f7f7f8;
            color: #1a1a1a;
            padding: 24px;
            text-align: center;
        }
        .card {
            max-width: 560px;
            width: 100%;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .08);
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 6px;
            background: var(--brand);
        }
        .logo { height: 64px; width: auto; margin-bottom: 28px; }
        .icon {
            width: 72px; height: 72px;
            margin: 0 auto 24px;
            border-radius: 50%;
            background: color-mix(in srgb, var(--brand) 12%, #fff);
            display: flex; align-items: center; justify-content: center;
        }
        .icon svg { width: 38px; height: 38px; stroke: var(--brand); }
        h1 { font-size: 1.6rem; font-weight: 800; margin-bottom: 14px; }
        p { font-size: 1.02rem; line-height: 1.6; color: #555; white-space: pre-line; }
        .footer { margin-top: 32px; font-size: .82rem; color: #9a9a9a; }
    </style>
</head>
<body>
    <div class="card">
        <img src="{{ $logoHref }}" alt="Bracongo" class="logo">
        <div class="icon">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
            </svg>
        </div>
        <h1>{{ $titre }}</h1>
        <p>{{ $message }}</p>
        <div class="footer">&copy; {{ date('Y') }} Bracongo</div>
    </div>
</body>
</html>
