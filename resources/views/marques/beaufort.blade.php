@extends('layout.app')

@section('title', 'Beaufort Lager')

@section('content')
    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ asset('img/beauban.jpg') }}" alt="Beaufort Lager" class="w-full h-full object-cover">
    </div>

    <section class="flex flex-col md:flex-row min-h-screen">
        <div class="w-full md:w-1/3 bg-[#00382B] flex items-center justify-center p-12">
            <div class="h-[600px] md:h-[800px]">
                <img src="{{ asset('img/beaufort.png') }}" alt="Beaufort Lager Bottle" class="h-full object-contain drop-shadow-2xl">
            </div>
        </div>

        <div class="w-full md:w-2/3 bg-white p-8 md:p-16 lg:p-24">
            <a href="{{ route('bieres') }}" class="inline-flex items-center text-bracongo font-bold gap-2 mb-12 hover:opacity-80 transition-opacity">
                <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span>Bières</span>
            </a>

            <div class="mb-12">
                <img src="{{ asset('img/logob.png') }}" alt="Beaufort Logo" class="h-40 w-auto">
            </div>

            <div class="space-y-6 mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-[#00382B]">Beaufort lager</h1>
                <div class="space-y-4 text-gray-800 leading-relaxed text-lg font-medium">
                    <p>est une bière précieuse et distinguée qui célèbre et prône l'excellence.</p>
                    <p>Depuis 1952, seuls les meilleurs ingrédients sont sélectionnés pour assurer une qualité exceptionnelle à cette bière blonde.</p>
                    <p>Son processus de fabrication ne tolère que la perfection. Sa mousse fine et ses reflets dorés laissent présager une bière d'exception. Son goût subtil et délicat, et sa légendaire finesse vous garantissent un goût unique à chaque gorgée.</p>
                </div>
            </div>

            <div class="space-y-8">
                <h2 class="text-2xl font-bold text-gray-900">Fiche technique</h2>
                <div class="bg-[#F0F4F4] rounded-3xl p-8 md:p-12">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8">
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Année de lancement</h4>
                            <p class="text-gray-700">2013</p>
                        </div>
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Ingrédients</h4>
                            <p class="text-gray-700">Eau, malt, maïs, houblon.</p>
                        </div>
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Type</h4>
                            <p class="text-gray-700">Bière blonde</p>
                        </div>

                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Taux d'alcool</h4>
                            <p class="text-gray-700">5%</p>
                        </div>
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Conditionnement</h4>
                            <p class="text-gray-700">33 cl et 50 cl</p>
                        </div>
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Slogan</h4>
                            <p class="text-gray-700 italic">Au cœur de la fraîcheur</p>
                        </div>

                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Date de Durabilité Minimale</h4>
                            <p class="text-gray-700">12 mois</p>
                        </div>
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Type de bouteille</h4>
                            <p class="text-gray-700">ALE Verte et Bremer verte</p>
                        </div>
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Positionnement</h4>
                            <p class="text-gray-700">Premium</p>
                        </div>

                        <div class="sm:col-span-2">
                            <h4 class="text-gray-900 font-bold mb-1">Coeur de Cible</h4>
                            <p class="text-gray-700">25-35 ans (Amateurs de mode et de beauté)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#002B21] py-20">
        <div class="container mx-auto px-4 lg:px-12 max-w-7xl">
            <div class="flex items-center gap-3 mb-12">
                <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-6 w-auto">
                <h2 class="text-white text-2xl md:text-3xl font-bold">Au cœur de la fraîcheur</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-3/4 relative rounded-[2rem] overflow-hidden group">
                    <iframe width="100%" height="450px" src="https://www.youtube.com/embed/3IS5fjkBA3g?si=ESfada5fR2vLAq2n&amp;start=4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>

                <div class="lg:w-1/4 flex flex-col gap-6">
<div class="relative rounded-[2rem] overflow-hidden group h-[180px] md:h-[220px]">
                    <iframe width="450" height="250" src="https://www.youtube.com/embed/Tiv6UIey21M?si=fmXFYFwNcAED_hey" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <div class="absolute inset-0 flex items-center justify-center">
                            
                        </div>
                    </div>                    <div class="relative rounded-[2rem] overflow-hidden group h-[180px] md:h-[220px]">
                    <iframe width="450" height="250" src="https://www.youtube.com/embed/Tiv6UIey21M?si=fmXFYFwNcAED_hey" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <div class="absolute inset-0 flex items-center justify-center">
                            
                        </div>
                    </div>
                    <div class="mt-auto">
                        <a href="#" class="inline-flex items-center gap-2 px-8 py-3 border border-white rounded-full text-white text-sm font-bold hover:bg-white hover:text-black transition-all">
                            <span>Plus de vidéo</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-4 lg:px-12 max-w-7xl">
            <div class="flex flex-col lg:flex-row gap-16 items-start">
                <div class="lg:w-1/3">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-6 w-auto">
                        <h2 class="text-3xl font-bold text-gray-900">Autres bières</h2>
                    </div>
                    <p class="text-gray-600 text-sm font-medium leading-relaxed mb-8">
                        Lorem ipsum dolor sit amet consectetur. Nec augue tortor cursus vulputate ultricies mattis a. Bibendum gravida morbi urna at id dui vitae.
                    </p>
                </div>

                <div class="lg:w-2/3 w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                        <div class="flex flex-col items-center">
                            <div class="h-[300px] mb-8 flex items-center justify-center">
                                <img src="{{ asset('img/marron.png') }}" alt="Castel Beer" class="h-full object-contain hover:scale-105 transition-transform duration-300">
                            </div>
                            <a href="#" class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                                <span class="text-sm">Castel Beer</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        <div class="flex flex-col items-center">
                            <div class="h-[300px] mb-8 flex items-center justify-center">
                                <img src="{{ asset('img/dopel.png') }}" alt="Doppel Munich" class="h-full object-contain hover:scale-105 transition-transform duration-300">
                            </div>
                            <a href="#" class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                                <span class="text-sm">Doppel Munich</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        <div class="flex flex-col items-center">
                            <div class="h-[300px] mb-8 flex items-center justify-center">
                                <img src="{{ asset('img/blonde.png') }}" alt="Nkoyi Blonde" class="h-full object-contain hover:scale-105 transition-transform duration-300">
                            </div>
                            <a href="#" class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                                <span class="text-sm">Nkoyi Blonde</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center justify-center lg:justify-start gap-6">
                        <button class="w-10 h-10 border border-bracongo rounded-full flex items-center justify-center text-bracongo hover:bg-bracongo hover:text-white transition-all">
                            <svg class="w-5 h-5 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                        <div class="flex gap-2">
                            <span class="w-10 h-1.5 bg-bracongo rounded-full"></span>
                            <span class="w-10 h-1.5 bg-gray-200 rounded-full"></span>
                            <span class="w-10 h-1.5 bg-gray-200 rounded-full"></span>
                            <span class="w-10 h-1.5 bg-gray-200 rounded-full"></span>
                        </div>
                        <button class="w-10 h-10 border border-bracongo rounded-full flex items-center justify-center text-bracongo hover:bg-bracongo hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
