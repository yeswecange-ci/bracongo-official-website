@extends('layout.app')

@section('title', 'Boutique')

@section('meta_description', 'Découvrez les produits et accessoires officiels Bracongo.')

@section('content')

    {{-- Hero --}}
    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ asset('img/bracongo.jpg') }}" alt="Boutique Bracongo"
             class="w-full h-full object-cover" loading="eager" fetchpriority="high" decoding="async">
        <div class="absolute inset-0 bg-black/65"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4 text-center">
            <span class="inline-block px-4 py-1 border border-white/40 rounded-full text-xs font-semibold tracking-[0.2em] uppercase text-white/80 mb-4">Bracongo officiel</span>
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight uppercase tracking-[0.15em]">
                Boutique
            </h1>
            <p class="mt-4 text-white/75 text-sm md:text-base max-w-xl font-medium">
                Retrouvez ici nos produits et accessoires officiels.
            </p>
        </div>
    </div>

    {{-- Flash --}}
    @if(session('success'))
    <div class="bg-green-50 border-b border-green-200 text-green-800 text-sm font-semibold text-center py-3 px-4">
        {{ session('success') }} —
        <a href="{{ route('panier') }}" class="underline hover:text-green-900">Voir le panier</a>
    </div>
    @endif

    {{-- Contenu --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 lg:px-12 max-w-7xl">

            @if($produits->isNotEmpty())

                {{-- En-tête section --}}
                <div class="flex items-center justify-between mb-12">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('img/Group.png') }}" alt="" class="h-8 w-auto" loading="lazy" decoding="async" aria-hidden="true">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                            Nos produits
                            <span class="text-bracongo text-lg font-semibold">({{ $produits->total() }})</span>
                        </h2>
                    </div>
                </div>

                {{-- Grille produits --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($produits as $produit)
                    <article class="group bg-white rounded-[1.5rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">

                        {{-- Image --}}
                        <div class="relative overflow-hidden bg-gray-50 h-56">
                            @if($produit->image)
                                <img src="{{ asset($produit->image) }}"
                                     alt="{{ $produit->nom }}"
                                     class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500"
                                     loading="lazy" decoding="async">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-200">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                                    </svg>
                                    <span class="text-xs text-gray-300 mt-2 font-medium">Aperçu indisponible</span>
                                </div>
                            @endif

                            {{-- Badge stock --}}
                            @if($produit->stock !== null)
                                @if($produit->stock > 0)
                                    <span class="absolute top-3 right-3 bg-green-100 text-green-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wide">
                                        En stock
                                    </span>
                                @else
                                    <span class="absolute top-3 right-3 bg-gray-100 text-gray-500 text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wide">
                                        Épuisé
                                    </span>
                                @endif
                            @endif
                        </div>

                        {{-- Infos --}}
                        <div class="flex flex-col flex-1 p-5 gap-3">

                            @if($produit->reference)
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                Réf. {{ $produit->reference }}
                            </span>
                            @endif

                            <h3 class="text-gray-900 font-bold text-base leading-snug">
                                {{ $produit->nom }}
                            </h3>

                            @if($produit->description)
                            <p class="text-gray-500 text-sm leading-relaxed flex-1">
                                {{ Str::limit(strip_tags($produit->description), 100) }}
                            </p>
                            @endif

                            {{-- Prix --}}
                            <div class="mt-auto pt-3 border-t border-gray-100">
                                @if($produit->prix !== null)
                                    <span class="text-bracongo font-bold text-lg">
                                        {{ number_format((float) $produit->prix, 0, ',', ' ') }}
                                        <span class="text-xs font-semibold text-gray-500">CDF</span>
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm font-medium italic">Prix sur demande</span>
                                @endif

                                {{-- Ajouter au panier --}}
                                @if($produit->stock === null || $produit->stock > 0)
                                <form action="{{ route('panier.ajouter', $produit) }}" method="POST" class="mt-3 flex items-center gap-2">
                                    @csrf
                                    <input type="number" name="quantite" value="1" min="1" max="99"
                                           class="w-14 text-center border border-gray-200 rounded-full text-sm py-1.5 focus:outline-none focus:border-bracongo">
                                    <button type="submit"
                                            class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-bracongo text-white text-xs font-bold rounded-full hover:opacity-90 transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        Ajouter
                                    </button>
                                </form>
                                @else
                                <p class="mt-3 text-xs text-gray-400 italic text-center">Indisponible</p>
                                @endif
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($produits->hasPages())
                <div class="mt-14 flex justify-center">
                    <nav class="flex items-center gap-1" aria-label="Pagination">
                        @if($produits->onFirstPage())
                            <span class="px-4 py-2 rounded-full text-sm text-gray-300 border border-gray-200 cursor-not-allowed">←</span>
                        @else
                            <a href="{{ $produits->previousPageUrl() }}" class="px-4 py-2 rounded-full text-sm border border-gray-300 text-gray-600 hover:border-bracongo hover:text-bracongo transition-all">←</a>
                        @endif

                        @foreach($produits->getUrlRange(1, $produits->lastPage()) as $page => $url)
                            @if($page == $produits->currentPage())
                                <span class="px-4 py-2 rounded-full text-sm font-bold bg-bracongo text-white">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 rounded-full text-sm border border-gray-300 text-gray-600 hover:border-bracongo hover:text-bracongo transition-all">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($produits->hasMorePages())
                            <a href="{{ $produits->nextPageUrl() }}" class="px-4 py-2 rounded-full text-sm border border-gray-300 text-gray-600 hover:border-bracongo hover:text-bracongo transition-all">→</a>
                        @else
                            <span class="px-4 py-2 rounded-full text-sm text-gray-300 border border-gray-200 cursor-not-allowed">→</span>
                        @endif
                    </nav>
                </div>
                @endif

            @else

                {{-- État vide --}}
                <div class="flex flex-col items-center justify-center py-28 text-center">
                    <div class="w-24 h-24 rounded-full bg-gray-50 flex items-center justify-center mb-6 border border-gray-100">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-700 mb-2">Aucun produit disponible</h2>
                    <p class="text-gray-400 text-sm max-w-sm">
                        Notre boutique est en cours de préparation. Revenez bientôt pour découvrir nos produits.
                    </p>
                    <a href="{{ route('contact') }}"
                       class="mt-8 inline-flex items-center gap-2 px-8 py-3 border border-bracongo text-bracongo rounded-full font-bold hover:bg-bracongo hover:text-white transition-all duration-300">
                        Nous contacter
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

            @endif
        </div>
    </section>

@endsection
