<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $faviconHref = isset($parametres) && filled($parametres->favicon ?? null)
            ? asset($parametres->favicon)
            : asset('img/LOGO BRACONGO copie 1.png');
    @endphp
    <link rel="icon" href="{{ $faviconHref }}?v=2">
    <link rel="shortcut icon" href="{{ $faviconHref }}?v=2">

    <title>Bracongo - @yield('title', 'Accueil')</title>
    @hasSection('meta_description')
        <meta name="description" content="@yield('meta_description')">
    @elseif(isset($parametres) && filled(trim((string) ($parametres->seo_meta_description ?? ''))))
        <meta name="description" content="{{ e($parametres->seo_meta_description) }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bracongo: '#E30613',
                    },
                    fontFamily: {
                        sans: ['Catamaran', 'ui-sans-serif', 'system-ui'],
                    },
                }
            }
        }
    </script>
    <style>
        .loader-wrapper {
            position: fixed;
            inset: 0;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s;
        }
        .loader-logo {
            width: 120px;
            height: auto;
            animation: pulse-bracongo 2s infinite ease-in-out;
        }
        @keyframes pulse-bracongo {
            0%, 100% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.1); opacity: 1; }
        }
        body.loading {
            overflow: hidden;
        }
    </style>
</head>
<body class="font-sans antialiased overflow-x-hidden loading">
    <div id="loader" class="loader-wrapper">
        <img src="{{ asset(isset($parametres) && filled($parametres->logo ?? null) ? $parametres->logo : 'img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo Loading" class="loader-logo">
    </div>

    <div class="min-h-screen bg-white overflow-x-hidden">
        @include('layout.navbar')

        <main>
            @yield('content')
        </main>

        @include('layout.footer')
    </div>

    <script>
        window.addEventListener('load', function() {
            document.querySelectorAll('img').forEach(img => {
                if (!img.getAttribute('loading')) {
                    img.setAttribute('loading', 'lazy');
                }
            });

            const loader = document.getElementById('loader');
            setTimeout(() => {
                loader.style.opacity = '0';
                loader.style.visibility = 'hidden';
                document.body.classList.remove('loading');
            }, 150);
        });
    </script>
</body>
</html>
