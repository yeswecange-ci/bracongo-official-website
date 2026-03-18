<nav class="bg-white py-4 px-6 md:px-12 flex items-center justify-between shadow-sm font-sans relative z-50">
    <div class="flex-shrink-0">
        <a href="{{ route('Accueil') }}">
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
                <span>Actualités & événements</span>
                <svg class="w-4 h-4 text-bracongo group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                <div class="py-2">
                    <a href="{{ Route('actualites') }}" class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">Dernières actualités</a>
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
        </div>

        <button id="desktop-search-button" class="text-gray-800 hover:text-bracongo transition-colors py-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
    </div>

    <div id="desktop-search-bar" class="hidden absolute inset-0 bg-white z-[60] flex items-center px-6 md:px-12">
        <div class="container mx-auto flex items-center gap-4">
            <div class="relative flex-grow">
                <input type="text" id="desktop-search-input" placeholder="Rechercher un produit, une actualité..." class="w-full pl-12 pr-4 py-4 text-lg border-none focus:ring-0 text-gray-800 placeholder-gray-400">
                <svg class="w-6 h-6 text-gray-400 absolute left-2 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <button id="close-search-button" class="text-gray-400 hover:text-bracongo transition-colors p-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="lg:hidden flex items-center">
        <button id="mobile-menu-button" class="text-gray-800 hover:text-bracongo focus:outline-none transition-colors duration-300">
            <svg id="burger-icon" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg id="close-icon" class="w-8 h-8 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <div id="mobile-menu" class="hidden fixed inset-x-0 top-[88px] bottom-0 bg-white z-[60] overflow-y-auto lg:hidden">
        <div class="p-6 space-y-4">
            <div class="border-b border-gray-100 pb-4">
                <button class="flex items-center justify-between w-full text-gray-800 font-bold py-2 mobile-dropdown-btn">
                    <span>Bracongo SA</span>
                    <svg class="w-4 h-4 text-bracongo transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="hidden mt-2 space-y-2 pl-4">
                    <a href="{{ route('histoire') }}" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Notre historique</a>
                    <a href="{{ route('histoire') }}#valeurs" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Nos valeurs</a>
                    <a href="{{ route('histoire') }}#rse" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Nos engagements RSE</a>
                    <a href="{{ route('histoire') }}#presence" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Présence nationale</a>
                </div>
            </div>

            <div class="border-b border-gray-100 pb-4">
                <button class="flex items-center justify-between w-full text-gray-800 font-bold py-2 mobile-dropdown-btn">
                    <span>Nos marques</span>
                    <svg class="w-4 h-4 text-bracongo transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="hidden mt-2 space-y-2 pl-4">
                    <a href="{{ Route('bieres') }}" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Bières</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Boissons gazeuses</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Eaux</a>
                    <a href="#" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Boissons énergisantes</a>
                </div>
            </div>

            <div class="border-b border-gray-100 pb-4">
                <button class="flex items-center justify-between w-full text-gray-800 font-bold py-2 mobile-dropdown-btn">
                    <span>Actualités & événements</span>
                    <svg class="w-4 h-4 text-bracongo transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="hidden mt-2 space-y-2 pl-4">
                    <a href="{{ Route('actualites') }}" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Dernières actualités</a>
                </div>
            </div>

            <div class="border-b border-gray-100 pb-4">
                <button class="flex items-center justify-between w-full text-gray-800 font-bold py-2 mobile-dropdown-btn">
                    <span>Carrière</span>
                    <svg class="w-4 h-4 text-bracongo transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="hidden mt-2 space-y-2 pl-4">
                    <a href="{{ Route('carriere') }}" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Nous rejoindre ?</a>
                </div>
            </div>

            <div class="border-b border-gray-100 pb-4">
                <button class="flex items-center justify-between w-full text-gray-800 font-bold py-2 mobile-dropdown-btn">
                    <span>Contacts</span>
                    <svg class="w-4 h-4 text-bracongo transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="hidden mt-2 space-y-2 pl-4">
                    <a href="{{ Route('contact') }}" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Nous écrire</a>
                </div>
            </div>

            <div class="border-b border-gray-100 pb-4">
                <button class="flex items-center justify-between w-full text-gray-800 font-bold py-2 mobile-dropdown-btn">
                    <span>Bracongo Pro</span>
                    <svg class="w-4 h-4 text-bracongo transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="hidden mt-2 space-y-2 pl-4">
                    <a href="{{ Route('pro') }}" class="block py-2 text-sm text-gray-600 hover:text-bracongo">Rejoindre Bracongo Pro</a>
                </div>
            </div>

            <div class="py-2">
                <a href="#" class="block text-gray-800 font-bold">FAQ</a>
            </div>

            <div class="pt-6">
                <div class="relative">
                    <input type="text" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-3 rounded-full bg-gray-50 border border-gray-100 focus:outline-none focus:border-bracongo focus:ring-1 focus:ring-bracongo">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const burgerIcon = document.getElementById('burger-icon');
            const closeIcon = document.getElementById('close-icon');
            const mobileDropdownBtns = document.querySelectorAll('.mobile-dropdown-btn');

            const desktopSearchButton = document.getElementById('desktop-search-button');
            const desktopSearchBar = document.getElementById('desktop-search-bar');
            const closeSearchButton = document.getElementById('close-search-button');
            const desktopSearchInput = document.getElementById('desktop-search-input');

            if (desktopSearchButton && desktopSearchBar) {
                desktopSearchButton.addEventListener('click', function() {
                    desktopSearchBar.classList.remove('hidden');
                    desktopSearchInput.focus();
                    document.body.style.overflow = 'hidden'; // Optional: lock scroll
                });

                closeSearchButton.addEventListener('click', function() {
                    desktopSearchBar.classList.add('hidden');
                    document.body.style.overflow = '';
                });

                // Close on Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && !desktopSearchBar.classList.contains('hidden')) {
                        desktopSearchBar.classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                });
            }

            // Toggle Mobile Menu
            mobileMenuButton.addEventListener('click', function() {
                const isOpen = !mobileMenu.classList.contains('hidden');
                
                if (isOpen) {
                    mobileMenu.classList.add('hidden');
                    burgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.style.overflow = ''; // Allow scrolling
                } else {
                    mobileMenu.classList.remove('hidden');
                    burgerIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    document.body.style.overflow = 'hidden'; // Prevent scrolling
                }
            });

            // Handle Mobile Dropdowns
            mobileDropdownBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const dropdownContent = this.nextElementSibling;
                    const arrowIcon = this.querySelector('svg');
                    
                    // Toggle visibility
                    dropdownContent.classList.toggle('hidden');
                    
                    // Rotate arrow
                    if (dropdownContent.classList.contains('hidden')) {
                        arrowIcon.classList.remove('rotate-180');
                    } else {
                        arrowIcon.classList.add('rotate-180');
                    }
                });
            });

            // Close menu when clicking on a link
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                    burgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.style.overflow = '';
                });
            });
        });
    </script>
</nav>
