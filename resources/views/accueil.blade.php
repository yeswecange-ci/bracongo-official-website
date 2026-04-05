@extends('layout.app')

@section('title', 'Accueil')

@section('content')
    <section class="relative w-full overflow-hidden group">
        <div id="hero-carousel" class="relative w-full h-[500px] md:h-[900px]">
            @forelse($slides as $i => $slide)
            <div class="carousel-item absolute inset-0 transition-opacity duration-1000 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
                <img src="{{ asset($slide->image) }}" alt="{{ $slide->alt }}" class="w-full h-full object-cover" @if($i === 0) loading="eager" fetchpriority="high" @else loading="lazy" @endif decoding="async">
            </div>
            @empty
            <div class="carousel-item absolute inset-0 transition-opacity duration-1000 opacity-100">
                <img src="{{ asset('img/coverhome.jpg') }}" alt="Hero" class="w-full h-full object-cover" loading="eager" fetchpriority="high" decoding="async">
            </div>
            @endforelse
        </div>

        <div class="py-4 flex justify-center items-center gap-4">
            <button id="prev-hero" class="w-6 h-6 rounded-full border border-bracongo flex items-center justify-center text-bracongo hover:bg-bracongo hover:text-white transition-all cursor-pointer">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <div class="flex items-center gap-2" id="carousel-indicators">
                @forelse($slides as $i => $slide)
                <span class="indicator w-6 h-1 {{ $i === 0 ? 'bg-bracongo' : 'bg-gray-300' }} rounded-full cursor-pointer transition-all"></span>
                @empty
                <span class="indicator w-6 h-1 bg-bracongo rounded-full cursor-pointer transition-all"></span>
                @endforelse
            </div>

            <button id="next-hero" class="w-6 h-6 rounded-full border border-bracongo flex items-center justify-center text-bracongo hover:bg-bracongo hover:text-white transition-all cursor-pointer">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const items = document.querySelectorAll('.carousel-item');
                const indicators = document.querySelectorAll('.indicator');
                const prevBtn = document.getElementById('prev-hero');
                const nextBtn = document.getElementById('next-hero');
                let currentIndex = 0;
                let interval;

                function showSlide(index) {
                    items.forEach((item, i) => {
                        item.classList.replace('opacity-100', 'opacity-0');
                        if (indicators[i]) {
                            indicators[i].classList.replace('bg-bracongo', 'bg-gray-300');
                        }
                    });
                    items[index].classList.replace('opacity-0', 'opacity-100');
                    if (indicators[index]) {
                        indicators[index].classList.replace('bg-gray-300', 'bg-bracongo');
                    }
                    currentIndex = index;
                }

                function nextSlide() { showSlide((currentIndex + 1) % items.length); }
                function prevSlide() { showSlide((currentIndex - 1 + items.length) % items.length); }
                function startAutoPlay() { interval = setInterval(nextSlide, 5000); }
                function stopAutoPlay() { clearInterval(interval); }

                nextBtn.addEventListener('click', () => { nextSlide(); stopAutoPlay(); startAutoPlay(); });
                prevBtn.addEventListener('click', () => { prevSlide(); stopAutoPlay(); startAutoPlay(); });
                indicators.forEach((ind, i) => {
                    ind.addEventListener('click', () => { showSlide(i); stopAutoPlay(); startAutoPlay(); });
                });

                startAutoPlay();
            });
        </script>
    </section>

    <div class="container mx-auto px-4 py-16">
        <div class="flex items-center justify-center gap-4 mb-12">
            <img src="{{ asset('img/Group.png') }}" alt="" class="h-10 w-auto" loading="lazy" decoding="async" aria-hidden="true">
            <h1 class="text-3xl font-bold text-gray-900 uppercase tracking-widest">{{ $accueil->actualites_titre ?? 'Dernières actualités' }}</h1>
        </div>
        
        @php $typesNewsAccueil = \App\Models\News::types(); @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($dernieresNews as $item)
            @php
                $href = $item->lien_externe ?: route('actualites.show', $item->slug);
            @endphp
            <a href="{{ $href }}" @if($item->lien_externe) target="_blank" rel="noopener" @endif class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden flex flex-col h-full shadow-sm hover:shadow-md transition-shadow text-left">
                <div class="h-64 overflow-hidden bg-gray-100">
                    @if($item->image)
                    <img src="{{ asset($item->image) }}" alt="{{ $item->titre }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" stroke-width="1.5"/></svg>
                    </div>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-grow justify-between">
                    @if(isset($typesNewsAccueil[$item->type]))
                    <span class="text-xs font-bold text-bracongo uppercase tracking-wider mb-1">{{ $typesNewsAccueil[$item->type] }}</span>
                    @endif
                    <h3 class="text-gray-900 font-bold text-sm line-clamp-3">{{ $item->titre }}</h3>
                    <div class="flex justify-end mt-4">
                        <span class="text-bracongo">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center text-gray-500 py-8 text-sm">Aucune actualité à afficher pour le moment.</div>
            @endforelse
        </div>

        <div class="flex justify-center mt-12">
            <a href="{{ $accueil->actualites_voir_plus_lien ?? '#' }}" class="flex items-center gap-2 px-8 py-2 border border-bracongo rounded-full text-bracongo font-semibold hover:bg-bracongo hover:text-white transition-all duration-300">
                Voir plus
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>

    <section class="relative w-full h-[500px] mt-20 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset($accueil->qui_image_fond ?? 'img/brasserie.jpg') }}" alt="Brasserie Bracongo" class="w-full h-full object-cover" loading="lazy" decoding="async">
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-4 max-w-4xl mx-auto">
            <div class="flex items-center gap-3 mb-6">
                <img src="{{ asset('img/Group.png') }}" alt="" class="h-8 w-auto" loading="lazy" decoding="async" aria-hidden="true">
                <h2 class="text-white text-3xl md:text-5xl font-bold tracking-tight">{{ $accueil->qui_titre ?? 'Qui sommes-nous ?' }}</h2>
            </div>
            
            <p class="text-gray-200 text-sm md:text-base leading-relaxed mb-10 font-medium">
                {{ $accueil->qui_texte ?? '' }}
            </p>

            <a href="{{ $accueil->qui_cta_lien ?? '/histoire' }}" class="flex items-center gap-2 px-10 py-3 border border-white rounded-full text-white font-bold hover:bg-white hover:text-black transition-all duration-300 group/btn">
                {{ $accueil->qui_cta_texte ?? 'Lire plus' }}
                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="" class="h-6 w-auto" loading="lazy" decoding="async" aria-hidden="true">
                    <h2 class="text-3xl font-bold text-gray-900">{{ $accueil->marques_titre ?? 'Nos marques' }}</h2>
                </div>
                <p class="text-gray-600 max-w-3xl mx-auto text-sm leading-relaxed">
                    {{ $accueil->marques_description ?? '' }}
                </p>
            </div>

            @php
                $categoriesMarques = \App\Models\Marque::categories();
                $ordreCategoriesAccueil = ['bieres', 'gazeuses', 'eaux', 'energisantes'];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-32 pt-32 max-w-7xl mx-auto px-4">
                @foreach($ordreCategoriesAccueil as $cat)
                @php
                    $marquesCat = \App\Models\Marque::actives()
                        ->whereHas('boissons', fn ($q) => $q->where('categorie', $cat))
                        ->orderBy('ordre')
                        ->take(3)
                        ->get();
                    $m1 = $marquesCat->get(0);
                    $m2 = $marquesCat->get(1);
                    $m3 = $marquesCat->get(2);
                    $lienCat = $cat === 'bieres' ? route('bieres') : route('marque.categorie', $cat);
                @endphp
                @continue(!$m1)
                <div class="relative bg-black rounded-[2rem] group h-[400px] flex flex-col items-center justify-end pb-12 transition-all duration-500 hover:shadow-2xl">
                    <div class="absolute top-10 left-0 right-0 flex justify-center opacity-60 pointer-events-none group-hover:opacity-100 transition-opacity duration-500">
                        <img src="{{ asset('img/Group2.png') }}" alt="" class="w-4/5 h-auto object-contain brightness-100 hue-rotate-[340deg] saturate-[500%] contrast-[150%]" loading="lazy" decoding="async" aria-hidden="true">
                    </div>
                    @if($m2)
                    <div class="absolute -top-16 left-0 right-0 flex justify-center z-0 pointer-events-none">
                        <img src="{{ asset($m2->image ?? 'img/marron.png') }}" alt="" class="h-64 w-auto object-contain opacity-0 group-hover:opacity-100 group-hover:-translate-x-20 group-hover:-rotate-12 transition-all duration-500 ease-out" loading="lazy" decoding="async">
                    </div>
                    @endif
                    @if($m3)
                    <div class="absolute -top-16 left-0 right-0 flex justify-center z-0 pointer-events-none">
                        <img src="{{ asset($m3->image ?? 'img/marron.png') }}" alt="" class="h-64 w-auto object-contain opacity-0 group-hover:opacity-100 group-hover:translate-x-20 group-hover:rotate-12 transition-all duration-500 ease-out" loading="lazy" decoding="async">
                    </div>
                    @endif
                    <div class="absolute -top-20 left-0 right-0 flex justify-center z-10 pointer-events-none transition-transform duration-500 group-hover:-translate-y-4 group-hover:scale-105">
                        <img src="{{ asset($m1->image ?? 'img/marron.png') }}" alt="{{ $m1->nom }}" class="h-80 w-auto object-contain drop-shadow-2xl" loading="lazy" decoding="async">
                    </div>
                    <div class="relative z-20 text-center px-4">
                        <h3 class="text-white text-2xl font-bold mb-8">{{ $categoriesMarques[$cat] ?? $cat }}</h3>
                        <a href="{{ $lienCat }}" class="inline-flex items-center gap-3 px-10 py-3 border border-white rounded-full text-white text-sm font-bold hover:bg-white hover:text-black transition-all duration-300">
                            {{ $accueil->marques_cartes_cta_texte ?? 'Voir plus' }} <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-[#F9F9F9]">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="w-full lg:w-1/2">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="" class="h-6 w-auto" loading="lazy" decoding="async" aria-hidden="true">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $accueil->rejoignez_titre ?? 'Rejoignez nous' }}</h2>
                    </div>

                    <div class="lg:hidden mb-10">
                        <div class="rounded-[2rem] overflow-hidden shadow-2xl">
                            <img src="{{ asset($accueil->rejoignez_image ?? 'img/rejoignez.png') }}" alt="Rejoignez Bracongo" class="w-full h-auto object-cover" loading="lazy" decoding="async">
                        </div>
                    </div>
                    
                    <p class="text-gray-700 text-base leading-relaxed mb-10 max-w-xl">
                        {{ $accueil->rejoignez_texte ?? '' }}
                    </p>

                    <a href="{{ $accueil->rejoignez_cta_lien ?? '/Carriere' }}" class="inline-flex items-center gap-2 px-8 py-3 border border-bracongo rounded-full text-bracongo font-bold hover:bg-bracongo hover:text-white transition-all duration-300 group">
                        {{ $accueil->rejoignez_cta_texte ?? "Voir nos offres d'emploi" }}
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                <div class="hidden lg:block w-full lg:w-1/2">
                    <div class="rounded-[2rem] overflow-hidden shadow-2xl">
                        <img src="{{ asset($accueil->rejoignez_image ?? 'img/rejoignez.png') }}" alt="Rejoignez Bracongo" class="w-full h-auto object-cover" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
