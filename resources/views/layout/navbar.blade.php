<nav class="bg-white py-4 px-6 md:px-12 flex items-center justify-between shadow-sm font-sans relative z-50" data-search-endpoint="{{ route('recherche.autocomplete') }}">
    <div class="flex-shrink-0">
        <a href="{{ route('Accueil') }}">
            <img src="{{ asset($parametres->logo ?? 'img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo Logo" class="h-16 w-auto object-contain">
        </a>
    </div>

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

    <div id="desktop-search-bar" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-[100] transition-all duration-300 opacity-0">
        <div class="absolute inset-x-0 top-0 bg-white shadow-2xl transform -translate-y-full transition-transform duration-300 ease-out py-8 md:py-12" id="search-content">
            <div class="max-w-4xl mx-auto px-4 sm:px-6">
                <div class="flex items-center justify-between gap-4 sm:gap-8 mb-6 sm:mb-8">
                    <div class="relative flex-grow">
                        <input type="text" id="desktop-search-input" placeholder="{{ isset($parametres) ? $parametres->resolvedSearchPlaceholder() : 'Rechercher sur le site…' }}"
                            class="w-full min-w-0 text-xl sm:text-2xl md:text-4xl font-bold border-none focus:ring-0 text-gray-900 placeholder-gray-300 bg-transparent py-2"
                            autocomplete="off" spellcheck="false">
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
                <div class="w-full max-w-3xl mx-auto space-y-6">
                    <div id="desktop-search-live" class="hidden">
                        <h4 class="text-xs font-bold text-bracongo uppercase tracking-widest mb-2">Meilleure correspondance</h4>
                        <a id="desktop-search-best-link" href="#" class="block rounded-xl border border-gray-100 bg-gray-50/80 px-4 py-3 hover:border-bracongo/40 hover:bg-white transition-colors">
                            <div id="desktop-search-best-title" class="font-bold text-gray-900 text-lg break-words"></div>
                            <div id="desktop-search-best-meta" class="text-xs text-gray-500 mt-1"></div>
                        </a>
                    </div>
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Résultats</h4>
                        <div id="desktop-search-results" class="max-h-[min(50vh,28rem)] sm:max-h-[45vh] overflow-y-auto overscroll-contain pr-1 space-y-1 min-h-[120px] rounded-lg border border-gray-100/80 bg-gray-50/30 p-2 sm:p-3"></div>
                    </div>
                </div>
            </div>
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
                    <input type="text" id="mobile-search-input" placeholder="{{ isset($parametres) ? $parametres->resolvedSearchPlaceholder() : 'Rechercher sur le site…' }}"
                        class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:outline-none focus:border-bracongo focus:ring-1 focus:ring-bracongo text-gray-900 font-medium"
                        autocomplete="off" spellcheck="false">
                    <svg class="w-6 h-6 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div id="mobile-search-results" class="mt-3 max-h-60 overflow-y-auto rounded-xl border border-gray-100 bg-white hidden"></div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const nav = document.querySelector('nav[data-search-endpoint]');
        const searchEndpoint = nav ? nav.getAttribute('data-search-endpoint') : '';
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
        const desktopSearchResults = document.getElementById('desktop-search-results');
        const desktopSearchLive = document.getElementById('desktop-search-live');
        const desktopSearchBestLink = document.getElementById('desktop-search-best-link');
        const desktopSearchBestTitle = document.getElementById('desktop-search-best-title');
        const desktopSearchBestMeta = document.getElementById('desktop-search-best-meta');
        const mobileSearchInput = document.getElementById('mobile-search-input');
        const mobileSearchResults = document.getElementById('mobile-search-results');

        let desktopDebounce = null;
        let mobileDebounce = null;

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text == null ? '' : String(text);
            return div.innerHTML;
        }

        function renderResultLinks(container, items, query) {
            if (!container) return;
            container.innerHTML = '';
            if (!items || !items.length) {
                container.innerHTML = '<p class="text-sm text-gray-500 py-4">Aucun résultat public pour « ' + escapeHtml(query) + ' ».</p>';
                return;
            }
            items.forEach(function(item, idx) {
                var a = document.createElement('a');
                a.href = item.url;
                a.className = 'block rounded-lg px-3 py-2.5 hover:bg-gray-50 border border-transparent hover:border-gray-100 transition-colors';
                if (idx === 0) {
                    a.setAttribute('data-search-result', '1');
                }
                var typeLine = escapeHtml(item.type || '');
                if (item.description) {
                    typeLine += ' · ' + escapeHtml(item.description);
                }
                a.innerHTML = '<div class="font-semibold text-gray-900">' + escapeHtml(item.title) + '</div>' +
                    '<div class="text-xs text-gray-500 mt-0.5">' + typeLine + '</div>';
                container.appendChild(a);
            });
        }

        function resetDesktopPanel() {
            if (desktopSearchLive) desktopSearchLive.classList.add('hidden');
            if (desktopSearchBestLink) desktopSearchBestLink.href = '#';
            if (desktopSearchResults) {
                desktopSearchResults.innerHTML = '<p class="text-sm text-gray-400">Tapez au moins 2 caractères pour voir des suggestions de pages et de produits.</p>';
            }
        }

        function applyDesktopData(data) {
            var q = data.query || '';
            if (data.best_match && desktopSearchLive && desktopSearchBestLink && desktopSearchBestTitle && desktopSearchBestMeta) {
                desktopSearchLive.classList.remove('hidden');
                desktopSearchBestLink.href = data.best_match.url;
                desktopSearchBestTitle.textContent = data.best_match.title;
                var meta = [data.best_match.type, data.best_match.description].filter(Boolean).join(' · ');
                desktopSearchBestMeta.textContent = meta;
            } else if (desktopSearchLive) {
                desktopSearchLive.classList.add('hidden');
            }
            renderResultLinks(desktopSearchResults, data.results || [], q);
        }

        function fetchSearch(q, isDesktop) {
            if (!searchEndpoint) return;
            var trimmed = (q || '').trim();
            if (trimmed.length < 2) {
                if (isDesktop) resetDesktopPanel();
                if (!isDesktop && mobileSearchResults) {
                    mobileSearchResults.classList.add('hidden');
                    mobileSearchResults.innerHTML = '';
                }
                return;
            }
            fetch(searchEndpoint + '?q=' + encodeURIComponent(trimmed), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            }).then(function(r) { return r.json(); }).then(function(data) {
                if (isDesktop) {
                    applyDesktopData(data);
                } else if (mobileSearchResults) {
                    mobileSearchResults.classList.remove('hidden');
                    renderResultLinks(mobileSearchResults, data.results || [], data.query || trimmed);
                }
            }).catch(function() {
                if (isDesktop && desktopSearchResults) {
                    desktopSearchResults.innerHTML = '<p class="text-sm text-red-600 py-4">Impossible de charger les suggestions.</p>';
                }
            });
        }

        if (desktopSearchInput) {
            desktopSearchInput.addEventListener('input', function() {
                clearTimeout(desktopDebounce);
                desktopDebounce = setTimeout(function() {
                    fetchSearch(desktopSearchInput.value, true);
                }, 200);
            });
            desktopSearchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    var first = desktopSearchResults ? desktopSearchResults.querySelector('a[data-search-result="1"]') : null;
                    if (first && first.getAttribute('href')) {
                        e.preventDefault();
                        window.location.href = first.getAttribute('href');
                    }
                }
            });
        }

        if (mobileSearchInput) {
            mobileSearchInput.addEventListener('input', function() {
                clearTimeout(mobileDebounce);
                mobileDebounce = setTimeout(function() {
                    fetchSearch(mobileSearchInput.value, false);
                }, 200);
            });
        }

        if (desktopSearchButton && desktopSearchBar) {
            desktopSearchButton.addEventListener('click', function() {
                desktopSearchBar.classList.remove('hidden');
                desktopSearchBar.offsetHeight;
                desktopSearchBar.classList.add('opacity-100');
                searchContent.classList.remove('-translate-y-full');
                searchContent.classList.add('translate-y-0');
                setTimeout(function() {
                    desktopSearchInput.focus();
                    searchUnderline.classList.remove('w-0');
                    searchUnderline.classList.add('w-full');
                    if (desktopSearchInput.value.trim().length >= 2) {
                        fetchSearch(desktopSearchInput.value, true);
                    } else {
                        resetDesktopPanel();
                    }
                }, 300);
                document.body.style.overflow = 'hidden';
            });
            var closeSearch = function() {
                desktopSearchBar.classList.remove('opacity-100');
                searchContent.classList.remove('translate-y-0');
                searchContent.classList.add('-translate-y-full');
                searchUnderline.classList.remove('w-full');
                searchUnderline.classList.add('w-0');
                setTimeout(function() {
                    desktopSearchBar.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 300);
            };
            closeSearchButton.addEventListener('click', closeSearch);
            desktopSearchBar.addEventListener('click', function(e) { if (e.target === desktopSearchBar) closeSearch(); });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !desktopSearchBar.classList.contains('hidden')) closeSearch();
            });
        }

        mobileMenuButton.addEventListener('click', function() {
            var isOpen = !mobileMenu.classList.contains('hidden');
            if (isOpen) {
                mobileMenu.classList.add('hidden'); burgerIcon.classList.remove('hidden'); closeIcon.classList.add('hidden'); document.body.style.overflow = '';
            } else {
                mobileMenu.classList.remove('hidden'); burgerIcon.classList.add('hidden'); closeIcon.classList.remove('hidden'); document.body.style.overflow = 'hidden';
            }
        });

        mobileDropdownBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var dropdownContent = this.nextElementSibling;
                var arrowIcon = this.querySelector('svg');
                dropdownContent.classList.toggle('hidden');
                arrowIcon.classList.toggle('rotate-180');
            });
        });

        var mobileLinks = mobileMenu ? mobileMenu.querySelectorAll('a') : [];
        mobileLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden'); burgerIcon.classList.remove('hidden'); closeIcon.classList.add('hidden'); document.body.style.overflow = '';
            });
        });
    });
    </script>
</nav>
