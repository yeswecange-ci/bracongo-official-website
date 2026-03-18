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
</head>
<body class="antialiased font-sans">
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

            <p class="text-sm md:text-base text-gray-800 font-medium mb-10 max-w-xl mx-auto">
                Quelle est votre date de naissance ? Pour accéder au site vous devez être majeur.
            </p>

            <form id="ageForm" class="space-y-8">
                @csrf
                <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                    <div class="relative w-full md:w-32">
                        <select id="day" name="day" required class="w-full appearance-none bg-white border border-gray-200 rounded-md px-4 py-3 pr-8 text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-bracongo/50 transition-all cursor-pointer shadow-sm">
                            <option value="">Jour</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}">{{ sprintf('%02d', $i) }}</option>
                            @endfor
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-bracongo">
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </div>
                    </div>

                    <div class="relative w-full md:w-40">
                        <select id="month" name="month" required class="w-full appearance-none bg-white border border-gray-200 rounded-md px-4 py-3 pr-8 text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-bracongo/50 transition-all cursor-pointer shadow-sm">
                            <option value="">Mois</option>
                            @php
                                $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                            @endphp
                            @foreach ($months as $key => $month)
                                <option value="{{ $key + 1 }}">{{ $month }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-bracongo">
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </div>
                    </div>

                    <div class="relative w-full md:w-32">
                        <select id="year" name="year" required class="w-full appearance-none bg-white border border-gray-200 rounded-md px-4 py-3 pr-8 text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-bracongo/50 transition-all cursor-pointer shadow-sm">
                            <option value="">Année</option>
                            @for ($i = date('Y'); $i >= date('Y') - 100; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-bracongo">
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </div>
                    </div>
                </div>

                <div id="errorMessage" class="hidden text-bracongo font-bold text-sm mt-4">
                    Nous sommes désolés vous n'êtes pas majeur
                </div>

                <div class="flex justify-center mt-10">
                    <button type="submit" class="group flex items-center gap-2 px-8 py-2 border border-bracongo rounded-full text-bracongo font-semibold hover:bg-bracongo hover:text-white transition-all duration-300">
                        Valider
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <script>
                document.getElementById('ageForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const day = parseInt(document.getElementById('day').value);
                    const month = parseInt(document.getElementById('month').value);
                    const year = parseInt(document.getElementById('year').value);
                    const errorMessage = document.getElementById('errorMessage');

                    if (!day || !month || !year) {
                        alert('Veuillez remplir tous les champs');
                        return;
                    }

                    const today = new Date();
                    const birthDate = new Date(year, month - 1, day);
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const m = today.getMonth() - birthDate.getMonth();
                    
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }

                    if (age >= 18) {
                        window.location.href = "{{ route('Accueil') }}";
                    } else {
                        errorMessage.classList.remove('hidden');
                    }
                });
            </script>

            <div class="mt-12 text-[10px] md:text-xs text-gray-600 italic">
                L'abus de l'alcool est dangereux pour la santé, à consommer avec modération.
            </div>
        </div>
    </div>
</body>
</html>
