<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bracongo - @yield('title', 'Accueil')</title>

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
</head>
<body class="antialiased font-sans">
    
    @include('layout.navbar')

    <main>
        @yield('content')
    </main>

    @include('layout.footer')

</body>
</html>
