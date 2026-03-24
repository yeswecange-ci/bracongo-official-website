@extends('layout.app')

@section('title', $boisson->nom)

@section('content')
    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ asset($boisson->hero_image ?? $boisson->image ?? 'img/beauban.jpg') }}" alt="{{ $boisson->nom }}" class="w-full h-full object-cover">
    </div>

    <section class="flex flex-col md:flex-row min-h-screen">
        <div class="w-full md:w-1/3 bg-[#00382B] flex items-center justify-center p-12">
            <div class="h-[600px] md:h-[800px]">
                <img src="{{ asset($boisson->image ?? 'img/beaufort.png') }}" alt="{{ $boisson->nom }} Bouteille"
                    class="h-full object-contain drop-shadow-2xl">
            </div>
        </div>

        <div class="w-full md:w-2/3 bg-white p-8 md:p-16 lg:p-24">
            <a href="{{ route('bieres') }}" class="inline-flex items-center text-bracongo font-bold gap-2 mb-12 hover:opacity-80 transition-opacity">
                <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span>Bières</span>
            </a>

            @if($boisson->logo)
            <div class="mb-12">
                <img src="{{ asset($boisson->logo) }}" alt="{{ $boisson->nom }} Logo" class="h-40 w-auto">
            </div>
            @endif

            <div class="space-y-6 mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-[#00382B]">{{ $boisson->nom }}</h1>
                @if($boisson->description)
                <div class="space-y-4 text-gray-800 leading-relaxed text-lg font-medium">
                    <p>{{ $boisson->description }}</p>
                </div>
                @endif
            </div>

            @if($boisson->annee_lancement || $boisson->ingredients || $boisson->type || $boisson->taux_alcool || $boisson->conditionnement || $boisson->slogan || $boisson->ddm || $boisson->type_bouteille || $boisson->positionnement || $boisson->coeur_cible)
            <div class="space-y-8">
                <h2 class="text-2xl font-bold text-gray-900">Fiche technique</h2>
                <div class="bg-[#F0F4F4] rounded-3xl p-8 md:p-12">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8">
                        @if($boisson->annee_lancement)
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Année de lancement</h4>
                            <p class="text-gray-700">{{ $boisson->annee_lancement }}</p>
                        </div>
                        @endif
                        @if($boisson->ingredients)
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Ingrédients</h4>
                            <p class="text-gray-700">{{ $boisson->ingredients }}</p>
                        </div>
                        @endif
                        @if($boisson->type)
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Type</h4>
                            <p class="text-gray-700">{{ $boisson->type }}</p>
                        </div>
                        @endif
                        @if($boisson->taux_alcool)
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Taux d'alcool</h4>
                            <p class="text-gray-700">{{ $boisson->taux_alcool }}</p>
                        </div>
                        @endif
                        @if($boisson->conditionnement)
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Conditionnement</h4>
                            <p class="text-gray-700">{{ $boisson->conditionnement }}</p>
                        </div>
                        @endif
                        @if($boisson->slogan)
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Slogan</h4>
                            <p class="text-gray-700 italic">{{ $boisson->slogan }}</p>
                        </div>
                        @endif
                        @if($boisson->ddm)
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Date de Durabilité Minimale</h4>
                            <p class="text-gray-700">{{ $boisson->ddm }}</p>
                        </div>
                        @endif
                        @if($boisson->type_bouteille)
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Type de bouteille</h4>
                            <p class="text-gray-700">{{ $boisson->type_bouteille }}</p>
                        </div>
                        @endif
                        @if($boisson->positionnement)
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Positionnement</h4>
                            <p class="text-gray-700">{{ $boisson->positionnement }}</p>
                        </div>
                        @endif
                        @if($boisson->coeur_cible)
                        <div class="sm:col-span-2">
                            <h4 class="text-gray-900 font-bold mb-1">Cœur de Cible</h4>
                            <p class="text-gray-700">{{ $boisson->coeur_cible }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

    @if($boisson->video_urls && count($boisson->video_urls) > 0)
    <section class="bg-[#002B21] py-20">
        <div class="container mx-auto px-4 lg:px-12 max-w-7xl">
            <div class="flex items-center gap-3 mb-12">
                <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-6 w-auto">
                <h2 class="text-white text-2xl md:text-3xl font-bold">{{ $boisson->slogan ?? $boisson->nom }}</h2>
            </div>
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-3/4 relative rounded-[2rem] overflow-hidden">
                    <iframe width="100%" height="450px" src="{{ $boisson->video_urls[0] }}"
                        title="{{ $boisson->nom }}" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                @if(count($boisson->video_urls) > 1)
                <div class="lg:w-1/4 flex flex-col gap-6">
                    @foreach(array_slice($boisson->video_urls, 1, 2) as $url)
                    <div class="relative rounded-[2rem] overflow-hidden h-[180px] md:h-[220px]">
                        <iframe width="100%" height="100%" src="{{ $url }}" title="{{ $boisson->nom }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    @if($autresBoissons->isNotEmpty())
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-4 lg:px-12 max-w-7xl">
            <div class="flex flex-col lg:flex-row gap-16 items-start">
                <div class="lg:w-1/3">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-6 w-auto">
                        <h2 class="text-3xl font-bold text-gray-900">Autres bières</h2>
                    </div>
                </div>
                <div class="lg:w-2/3 w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($autresBoissons->take(6) as $autre)
                        <div class="flex flex-col items-center">
                            <div class="h-[300px] mb-8 flex items-center justify-center">
                                <img src="{{ asset($autre->image ?? 'img/beaufort.png') }}" alt="{{ $autre->nom }}"
                                    class="h-full object-contain hover:scale-105 transition-transform duration-300">
                            </div>
                            <a href="{{ route('boisson.show', $autre->slug) }}"
                                class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                                <span class="text-sm">{{ $autre->nom }}</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
