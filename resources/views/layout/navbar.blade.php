<nav class="bg-white py-4 px-6 md:px-12 flex items-center justify-between shadow-sm font-sans relative z-50">
    <div class="flex-shrink-0">
        <a href="/">
            <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo Logo" class="h-16 w-auto object-contain">
        </a>
    </div>

    <div class="hidden lg:flex items-center space-x-8">
        <div class="relative group">
            <button class="flex items-center space-x-1 text-gray-800 font-bold hover:text-bracongo transition-colors text-sm  py-2">
                <span>Bracongo SA</span>
                <svg class="w-4 h-4 text-bracongo group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                <div class="py-2">
                    <a href="{{ route('histoire') }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Notre historique</a>
                    <a href="{{ route('histoire') }}#valeurs" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Nos valeurs</a>
                    <a href="{{ route('histoire') }}#rse" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Nos engagements RSE</a>
                    <a href="{{ route('histoire') }}#presence" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors">Présence nationale</a>
                </div>
            </div>
        </div>

        <div class="relative group">
            <button class="flex items-center space-x-1 text-gray-800 font-bold hover:text-bracongo transition-colors text-sm  py-2">
                <span><a href="{{ Route('marque') }}">Nos marques</a></span>
                <svg class="w-4 h-4 text-bracongo group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                <div class="py-2">
                    <a href="{{ Route('bieres') }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Bières</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Boissons gazeuses</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Eaux</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors">Boissons énergisantes</a>
                </div>
            </div>
        </div>

        <div class="relative group">
            <button class="flex items-center space-x-1 text-gray-800 font-bold hover:text-bracongo transition-colors text-sm  py-2">
                <span><a href="{{ Route('actualites') }}">Actualités & événements</a></span>
                <svg class="w-4 h-4 text-bracongo group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                <div class="py-2">
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Dernières actualités</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors">Événements</a>
                </div>
            </div>
        </div>

        <div class="relative group">
            <button class="flex items-center space-x-1 text-gray-800 font-bold hover:text-bracongo transition-colors text-sm  py-2">
                <span>Carrière</span>
                <svg class="w-4 h-4 text-bracongo group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                <div class="py-2">
                    <a href="{{ Route('carriere') }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Nous rejoindre ?</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Offres d'emploi</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors">Espace stagiaire</a>
                </div>
            </div>
        </div>

        <div class="relative group">
            <button class="flex items-center space-x-1 text-gray-800 font-bold hover:text-bracongo transition-colors text-sm  py-2">
                <span>Contacts</span>
                <svg class="w-4 h-4 text-bracongo group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                <div class="py-2">
                    <a href="{{ Route('contact') }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Nous écrire</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Points de vente</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors">Support technique</a>
                </div>
            </div>
        </div>

        <div class="relative group">
            <button class="flex items-center space-x-1 text-gray-800 font-bold hover:text-bracongo transition-colors text-sm  py-2">
                <span>Bracongo Pro</span>
                <svg class="w-4 h-4 text-bracongo group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                <div class="py-2">
                    <a href="{{ Route('pro') }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Rejoindre Bracongo Pro</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Points de vente</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors">Support technique</a>
                </div>
            </div>
        </div>

        <div class="relative group">
            <button class="flex items-center space-x-1 text-gray-800 font-bold hover:text-bracongo transition-colors text-sm  py-2">
                <span>FAQ</span>
                <svg class="w-4 h-4 text-bracongo group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                <div class="py-2">
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Nous écrire</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Points de vente</a>
                    <a href="#" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors">Support technique</a>
                </div>
            </div>
        </div>

        <button class="text-gray-800 hover:text-bracongo transition-colors py-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
    </div>

    <div class="lg:hidden">
        <button class="text-gray-800 hover:text-bracongo focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>
</nav>
