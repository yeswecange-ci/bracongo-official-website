<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bracongo - Bienvenue</title>

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
            opacity: 0;
            visibility: hidden;
        }
        .loader-wrapper.active {
            opacity: 1;
            visibility: visible;
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
    </style>
</head>
<body class="antialiased font-sans">
    <!-- Preloader -->
    <div id="loader" class="loader-wrapper">
        <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo Loading" class="loader-logo">
    </div>

    <div class="fixed inset-0 z-0">
        <img src="{{ asset('img/fete.png') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/20"></div>
    </div>

    <div class="relative z-10 flex min-h-screen items-center justify-center p-4">
        <div class="w-full max-w-4xl bg-white/80 backdrop-blur-sm rounded-lg py-12 px-6 md:px-12 text-center shadow-2xl">
            
            <div class="flex justify-center mb-8">
                <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo Logo" class="h-24 md:h-32 object-contain">
            </div>

            <h1 class="text-2xl md:text-4xl font-extrabold text-bracongo mb-4 tracking-tight">
                BIENVENUE SUR LE SITE BRACONGO SA
            </h1>

            <p class="text-sm md:text-lg text-gray-800 font-medium mb-10 max-w-xl mx-auto leading-relaxed">
                Ce site web contient des informations sur nos boissons alcoolisées. <br class="hidden md:block">
                En cliquant sur l'un des boutons ci-dessous, vous confirmez être majeur dans votre pays de résidence.
            </p>

            <div class="space-y-6">
                <div id="errorMessage" class="hidden text-bracongo font-bold text-sm mb-4 animate-bounce">
                    Nous sommes désolés, vous n'avez pas l'âge requis pour accéder à ce site.
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button id="btn-over-18" class="w-full sm:w-auto px-10 py-4 bg-bracongo text-white rounded-full font-bold text-lg hover:bg-white hover:text-bracongo border-2 border-bracongo transition-all duration-300 shadow-lg hover:shadow-bracongo/20">
                        J'ai plus de 18 ans
                    </button>
                    <button id="btn-under-18" class="w-full sm:w-auto px-10 py-4 bg-white text-gray-500 rounded-full font-bold text-lg hover:bg-gray-100 border-2 border-gray-200 transition-all duration-300">
                        J'ai moins de 18 ans
                    </button>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const btnOver18 = document.getElementById('btn-over-18');
                    const btnUnder18 = document.getElementById('btn-under-18');
                    const errorMessage = document.getElementById('errorMessage');
                    const loader = document.getElementById('loader');

                    btnOver18.addEventListener('click', function() {
                        // Masquer l'erreur si elle était affichée
                        errorMessage.classList.add('hidden');
                        
                        // Afficher le loader
                        loader.classList.add('active');
                        
                        // Rediriger après un très court délai
                        setTimeout(() => {
                            window.location.href = "{{ route('Accueil') }}";
                        }, 10);
                    });

                    btnUnder18.addEventListener('click', function() {
                        errorMessage.classList.remove('hidden');
                    });
                });
            </script>

            <div class="mt-12 text-[10px] md:text-xs text-gray-600 italic">
                L'abus de l'alcool est dangereux pour la santé, à consommer avec modération.
            </div>
        </div>
    </div>
</body>
</html>
