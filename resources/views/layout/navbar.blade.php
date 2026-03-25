<nav class="bg-white py-4 px-6 md:px-12 flex items-center justify-between shadow-sm font-sans relative z-50">
    <div class="flex-shrink-0">
        <a href="{{ route('Accueil') }}">
            <img src="{{ asset($parametres->logo ?? 'img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo Logo" class="h-16 w-auto object-contain">
        </a>
    </div>

    {{-- Desktop --}}
    <div class="hidden lg:flex items-center space-x-8">
        @foreach($navItems ?? [] as $item)
        <div class="relative group">
            @if($item->enfants->isEmpty())
            <a href="{{ $item->url }}"
                class="text-gray-800 font-bold hover:text-bracongo transition-colors text-sm py-2">
                {{ $item->label }}
            </a>
            @else
            <button class="flex items-center space-x-1 text-gray-800 font-bold hover:text-bracongo transition-colors text-sm py-2">
                <span>{{ $item->label }}</span>
                <svg class="w-4 h-4 text-bracongo group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                <div class="py-2">
                    @foreach($item->enfants as $enfant)
                    <a href="{{ $enfant->url }}"
                        class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-bracongo font-medium transition-colors border-b border-gray-50 last:border-0">
                        {{ $enfant->label }}
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endforeach

        <button id="desktop-search-button" class="text-gray-800 hover:text-bracongo transition-colors py-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
    </div>

    {{-- Desktop Search Overlay --}}
    <div id="desktop-search-bar" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-[100] transition-all duration-300 opacity-0">
        <div class="absolute inset-x-0 top-0 bg-white shadow-2xl transform -translate-y-full transition-transform duration-300 ease-out py-8 md:py-12" id="search-content">
            <div class="max-w-4xl mx-auto px-6">
                <div class="flex items-center justify-between gap-8 mb-8">
                    <div class="relative flex-grow">
                        <input type="text" id="desktop-search-input" placeholder="Rechercher un produit, une actualité..."
                            class="w-full text-2xl md:text-4xl font-bold border-none focus:ring-0 text-gray-900 placeholder-gray-300 bg-transparent py-2">
                        <div class="absolute bottom-0 left-0 w-full h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-bracongo w-0 transition-all duration-500 ease-out" id="search-underline"></div>
                        </div>
                    </div>
                    <button id="close-search-button" class="p-3 rounded-full hover:bg-gray-100 text-gray-400 hover:text-bracongo transition-all duration-300 flex-shrink-0">
                        <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Suggestions</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $parametres->search_suggestions ?? 'Beaufort,Actualités,Nkoyi,RSE') as $sugg)
                            <a href="#" class="px-4 py-2 bg-gray-50 hover:bg-bracongo hover:text-white rounded-full text-sm font-medium text-gray-600 transition-all">{{ trim($sugg) }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Besoin d'aide ?</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">Trouvez rapidement nos produits, nos points de vente ou nos dernières offres d'emploi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile burger --}}
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

    {{-- Mobile menu --}}
    <div id="mobile-menu" class="hidden fixed inset-x-0 top-[88px] bottom-0 bg-white z-[60] overflow-y-auto lg:hidden">
        <div class="p-6 space-y-4">
            @foreach($navItems ?? [] as $item)
            @if($item->enfants->isEmpty())
            <div class="border-b border-gray-100 pb-4">
                <a href="{{ $item->url }}" class="block text-gray-800 font-bold py-2">{{ $item->label }}</a>
            </div>
            @else
            <div class="border-b border-gray-100 pb-4">
                <button class="flex items-center justify-between w-full text-gray-800 font-bold py-2 mobile-dropdown-btn">
                    <span>{{ $item->label }}</span>
                    <svg class="w-4 h-4 text-bracongo transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="hidden mt-2 space-y-2 pl-4">
                    @foreach($item->enfants as $enfant)
                    <a href="{{ $enfant->url }}" class="block py-2 text-sm text-gray-600 hover:text-bracongo">{{ $enfant->label }}</a>
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach

            <div class="pt-6">
                <div class="relative">
                    <input type="text" placeholder="Rechercher un produit..."
                        class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:outline-none focus:border-bracongo focus:ring-1 focus:ring-bracongo text-gray-900 font-medium">
                    <svg class="w-6 h-6 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        const searchContent = document.getElementById('search-content');
        const searchUnderline = document.getElementById('search-underline');
        const closeSearchButton = document.getElementById('close-search-button');
        const desktopSearchInput = document.getElementById('desktop-search-input');

        if (desktopSearchButton && desktopSearchBar) {
            desktopSearchButton.addEventListener('click', function() {
                desktopSearchBar.classList.remove('hidden');
                desktopSearchBar.offsetHeight;
                desktopSearchBar.classList.add('opacity-100');
                searchContent.classList.remove('-translate-y-full');
                searchContent.classList.add('translate-y-0');
                setTimeout(() => {
                    desktopSearchInput.focus();
                    searchUnderline.classList.remove('w-0');
                    searchUnderline.classList.add('w-full');
                }, 300);
                document.body.style.overflow = 'hidden';
            });
            const closeSearch = () => {
                desktopSearchBar.classList.remove('opacity-100');
                searchContent.classList.remove('translate-y-0');
                searchContent.classList.add('-translate-y-full');
                searchUnderline.classList.remove('w-full');
                searchUnderline.classList.add('w-0');
                setTimeout(() => { desktopSearchBar.classList.add('hidden'); document.body.style.overflow = ''; }, 300);
            };
            closeSearchButton.addEventListener('click', closeSearch);
            desktopSearchBar.addEventListener('click', function(e) { if (e.target === desktopSearchBar) closeSearch(); });
            document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && !desktopSearchBar.classList.contains('hidden')) closeSearch(); });
        }

        mobileMenuButton.addEventListener('click', function() {
            const isOpen = !mobileMenu.classList.contains('hidden');
            if (isOpen) {
                mobileMenu.classList.add('hidden'); burgerIcon.classList.remove('hidden'); closeIcon.classList.add('hidden'); document.body.style.overflow = '';
            } else {
                mobileMenu.classList.remove('hidden'); burgerIcon.classList.add('hidden'); closeIcon.classList.remove('hidden'); document.body.style.overflow = 'hidden';
            }
        });

        mobileDropdownBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const dropdownContent = this.nextElementSibling;
                const arrowIcon = this.querySelector('svg');
                dropdownContent.classList.toggle('hidden');
                arrowIcon.classList.toggle('rotate-180');
            });
        });

        const mobileLinks = mobileMenu ? mobileMenu.querySelectorAll('a') : [];
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden'); burgerIcon.classList.remove('hidden'); closeIcon.classList.add('hidden'); document.body.style.overflow = '';
            });
        });
    });
    </script>
</nav>
