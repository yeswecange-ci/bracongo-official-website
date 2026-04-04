@php
    $imgAlt = $page->hero_image_alt ?: $page->titreOnglet();
@endphp
<div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
    <img src="{{ asset($page->hero_image) }}" alt="{{ $imgAlt }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4">
        <nav class="flex items-center gap-2 text-sm md:text-base font-medium mb-4">
            <a href="{{ route('Accueil') }}" class="hover:text-bracongo transition-colors">Accueil</a>
            <span class="text-bracongo font-bold text-lg">></span>
            <a href="{{ route('marque') }}" class="hover:text-bracongo transition-colors">Nos marques</a>
            <span class="text-bracongo font-bold text-lg">></span>
            <span class="opacity-90">{{ $page->breadcrumb_libelle }}</span>
        </nav>
        @if(filled($page->hero_titre))
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-center">{{ $page->hero_titre }}</h1>
        @endif
    </div>
</div>

<section class="container mx-auto px-4 py-16">
    <div class="flex justify-center mb-20">
        <div class="relative w-full max-w-2xl flex items-center">
            <input type="text" id="boisson-search" placeholder="{{ $page->search_placeholder }}"
                class="w-full px-8 py-4 rounded-full border border-gray-300 focus:outline-none focus:border-bracongo text-gray-700 shadow-sm pr-20">
            <button type="button" class="absolute right-1 top-1 bottom-1 px-8 bg-bracongo text-white rounded-full hover:opacity-90 transition-opacity flex items-center justify-center" aria-label="Rechercher">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </div>
    </div>

    <div id="boissons-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16 max-w-7xl mx-auto">
        @forelse($toutesBoissons as $boisson)
        <div class="beer-card flex flex-col items-center" data-nom="{{ strtolower($boisson->nom) }}">
            <div class="h-[300px] mb-6 flex items-center justify-center">
                <img src="{{ asset($boisson->image ?? 'img/beaufort.png') }}" alt="{{ $boisson->nom }}"
                    class="h-full w-auto object-contain scale-110 hover:scale-125 transition-transform duration-300">
            </div>
            <a href="{{ route('boisson.show', $boisson->slug) }}"
                class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                <span>{{ $boisson->nom }}</span>
                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        @empty
        <div class="col-span-4 text-center text-gray-400 py-12">{{ $page->message_liste_vide }}</div>
        @endforelse
    </div>

    <div id="boisson-search-no-result" class="hidden text-center text-gray-400 py-12">{{ $page->message_recherche_vide }}</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var input = document.getElementById('boisson-search');
    if (!input) return;
    input.addEventListener('input', function () {
        var val = this.value.toLowerCase().trim();
        var cards = document.querySelectorAll('.beer-card');
        var count = 0;
        cards.forEach(function (card) {
            var match = !val || card.dataset.nom.includes(val);
            card.style.display = match ? '' : 'none';
            if (match) count++;
        });
        var noResult = document.getElementById('boisson-search-no-result');
        if (noResult) noResult.classList.toggle('hidden', count > 0);
    });
});
</script>
