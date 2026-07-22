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
        $bgHref = asset('img/usine-bracongo.webp');
        $titre = filled(trim((string) ($parametres->maintenance_titre ?? ''))) ? $parametres->maintenance_titre : 'Site en maintenance';
        $message = filled(trim((string) ($parametres->maintenance_message ?? '')))
            ? $parametres->maintenance_message
            : "Nous améliorons votre expérience. Notre site est momentanément indisponible et sera de retour très bientôt. Merci de votre patience.";
        $tel = filled(trim((string) ($parametres->telephone_public ?? ''))) ? $parametres->telephone_public : null;
    @endphp
    <link rel="icon" href="{{ $faviconHref }}?v=2">
    <title>{{ $titre }} — Bracongo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@400;600;700;800;900&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand: {{ $couleur }};
            --ink: #0e1116;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }
        body {
            font-family: 'Montserrat', system-ui, -apple-system, sans-serif;
            color: #fff;
            background: var(--ink);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        /* Fond photo + dégradés de marque */
        .bg {
            position: fixed;
            inset: 0;
            background: url('{{ $bgHref }}') center/cover no-repeat;
            transform: scale(1.08);
            filter: saturate(1.05);
            z-index: 0;
            animation: slowZoom 26s ease-in-out infinite alternate;
        }
        @keyframes slowZoom { from { transform: scale(1.08); } to { transform: scale(1.18); } }
        .bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(120% 90% at 80% 0%, color-mix(in srgb, var(--brand) 45%, transparent) 0%, transparent 55%),
                linear-gradient(180deg, rgba(14,17,22,.72) 0%, rgba(14,17,22,.86) 55%, rgba(14,17,22,.95) 100%);
        }

        /* Carte verre dépoli */
        .card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 620px;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 26px;
            padding: 52px 48px 44px;
            text-align: center;
            backdrop-filter: blur(18px) saturate(120%);
            -webkit-backdrop-filter: blur(18px) saturate(120%);
            box-shadow: 0 30px 80px rgba(0, 0, 0, .55);
            animation: rise .8s cubic-bezier(.2, .8, .2, 1) both;
        }
        @keyframes rise { from { opacity: 0; transform: translateY(26px); } to { opacity: 1; transform: translateY(0); } }
        .card::before {
            content: '';
            position: absolute;
            top: -1px; left: 10%; right: 10%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--brand), transparent);
        }

        .logo { height: 58px; width: auto; margin-bottom: 30px; filter: drop-shadow(0 6px 18px rgba(0,0,0,.4)); }

        /* Icône animée */
        .badge {
            width: 92px; height: 92px;
            margin: 0 auto 26px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            background: radial-gradient(circle at 50% 40%, color-mix(in srgb, var(--brand) 30%, transparent), transparent 70%);
            position: relative;
        }
        .badge::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 2px solid color-mix(in srgb, var(--brand) 60%, transparent);
            animation: ping 2.4s cubic-bezier(0, 0, .2, 1) infinite;
        }
        @keyframes ping { 0% { transform: scale(.9); opacity: .9; } 70%, 100% { transform: scale(1.5); opacity: 0; } }
        .gear { width: 44px; height: 44px; stroke: #fff; fill: none; stroke-width: 1.6; }
        .gear .cog { transform-origin: 50% 50%; animation: spin 8s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        .eyebrow {
            font-size: .74rem;
            letter-spacing: .22em;
            text-transform: uppercase;
            font-weight: 600;
            color: color-mix(in srgb, var(--brand) 70%, #fff);
            margin-bottom: 14px;
        }
        h1 {
            font-family: 'Catamaran', sans-serif;
            font-size: clamp(1.7rem, 4.5vw, 2.5rem);
            font-weight: 900;
            line-height: 1.12;
            margin-bottom: 16px;
            letter-spacing: -.01em;
        }
        p.msg {
            font-size: 1.02rem;
            line-height: 1.65;
            color: rgba(255, 255, 255, .78);
            max-width: 46ch;
            margin: 0 auto;
            white-space: pre-line;
        }

        /* Barre de progression indéterminée */
        .bar {
            margin: 32px auto 0;
            width: 220px;
            height: 5px;
            border-radius: 99px;
            background: rgba(255, 255, 255, .14);
            overflow: hidden;
        }
        .bar span {
            display: block;
            height: 100%;
            width: 40%;
            border-radius: 99px;
            background: linear-gradient(90deg, transparent, var(--brand), color-mix(in srgb, var(--brand) 40%, #fff));
            animation: slide 1.6s ease-in-out infinite;
        }
        @keyframes slide { 0% { transform: translateX(-120%); } 100% { transform: translateX(320%); } }

        .contact {
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, .1);
            font-size: .9rem;
            color: rgba(255, 255, 255, .65);
        }
        .contact a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            border-bottom: 1px solid color-mix(in srgb, var(--brand) 80%, transparent);
            padding-bottom: 1px;
        }
        .footer { margin-top: 22px; font-size: .78rem; color: rgba(255, 255, 255, .4); }

        @media (max-width: 560px) {
            .card { padding: 40px 26px 34px; border-radius: 22px; }
            .logo { height: 48px; margin-bottom: 24px; }
        }
        @media (prefers-reduced-motion: reduce) {
            .bg, .card, .badge::before, .gear .cog, .bar span { animation: none !important; }
        }
    </style>
</head>
<body>
    <div class="bg" aria-hidden="true"></div>

    <main class="card">
        <img src="{{ $logoHref }}" alt="Bracongo" class="logo">

        <div class="badge" aria-hidden="true">
            <svg class="gear" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <g class="cog">
                    <circle cx="12" cy="12" r="3.2"/>
                    <path d="M12 2v3M12 19v3M2 12h3M19 12h3M4.9 4.9l2.1 2.1M17 17l2.1 2.1M19.1 4.9L17 7M7 17l-2.1 2.1"/>
                </g>
            </svg>
        </div>

        <div class="eyebrow">Bracongo</div>
        <h1>{{ $titre }}</h1>
        <p class="msg">{{ $message }}</p>

        <div class="bar" aria-hidden="true"><span></span></div>

        @if($tel)
            <div class="contact">
                Une question&nbsp;? Contactez-nous au <a href="tel:{{ preg_replace('/\s+/', '', $tel) }}">{{ $tel }}</a>
            </div>
        @endif

        <div class="footer">&copy; {{ date('Y') }} Bracongo — Tous droits réservés</div>
    </main>
</body>
</html>
