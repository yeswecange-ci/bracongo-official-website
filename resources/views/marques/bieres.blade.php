@extends('layout.app')

@section('title', 'Nos Marques')

@section('content')
    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ asset('img/marque.jpg') }}" alt="Nos Marques Banner" class="w-full h-full object-cover">
        
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4">
            <nav class="flex items-center gap-2 text-sm md:text-base font-medium mb-4">
                <a href="{{ route('Accueil') }}" class="hover:text-bracongo transition-colors">Accueil</a>
                <span class="text-bracongo font-bold text-lg">></span>
                <span class="opacity-90">Nos marques</span>
            </nav>

            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-center">
                Nos marques
            </h1>
        </div>
    </div>

    <section class="container mx-auto px-4 py-16">
        <div class="flex justify-center mb-20">
            <div class="relative w-full max-w-2xl flex items-center">
                <input type="text" placeholder="Taper un nom" class="w-full px-8 py-4 rounded-full border border-gray-300 focus:outline-none focus:border-bracongo text-gray-700 shadow-sm pr-20">
                <button class="absolute right-1 top-1 bottom-1 px-8 bg-bracongo text-white rounded-full hover:opacity-90 transition-opacity flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16 max-w-7xl mx-auto">
            <div class="flex flex-col items-center">
                <div class="h-[300px] mb-6 flex items-center justify-center">
                    <img src="{{ asset('img/beaufort.png') }}" alt="Beaufort Lager" class="h-full object-contain hover:scale-105 transition-transform duration-300">
                </div>
                <a href="{{ route('bieres.beaufort') }}" class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                    <span>Beaufort Lager</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="flex flex-col items-center">
                <div class="h-[300px] mb-6 flex items-center justify-center">
                    <img src="{{ asset('img/castel.png') }}" alt="Castel Beer" class="h-full object-contain hover:scale-105 transition-transform duration-300">
                </div>
                <a href="#" class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                    <span>Castel Beer</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="flex flex-col items-center">
                <div class="h-[300px] mb-6 flex items-center justify-center">
                    <img src="{{ asset('img/dopel.png') }}" alt="Doppel Munich" class="h-full object-contain hover:scale-105 transition-transform duration-300">
                </div>
                <a href="#" class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                    <span>Doppel Munich</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="flex flex-col items-center">
                <div class="h-[300px] mb-6 flex items-center justify-center">
                    <img src="{{ asset('img/blonde.png') }}" alt="Nkoyi Blonde" class="h-full object-contain hover:scale-105 transition-transform duration-300">
                </div>
                <a href="#" class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                    <span>Nkoyi Blonde</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="flex flex-col items-center">
                <div class="h-[300px] mb-6 flex items-center justify-center">
                    <img src="{{ asset('img/black.png') }}" alt="Nkoyi Black" class="h-full object-contain hover:scale-105 transition-transform duration-300">
                </div>
                <a href="#" class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                    <span>Nkoyi Black</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="flex flex-col items-center">
                <div class="h-[300px] mb-6 flex items-center justify-center">
                    <img src="{{ asset('img/33b.png') }}" alt="33 Export" class="h-full object-contain hover:scale-105 transition-transform duration-300">
                </div>
                <a href="#" class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                    <span>33 Export</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="flex flex-col items-center">
                <div class="h-[300px] mb-6 flex items-center justify-center">
                    <img src="{{ asset('img/tembo.png') }}" alt="TEMBO" class="h-full object-contain hover:scale-105 transition-transform duration-300">
                </div>
                <a href="#" class="w-full py-3 px-6 border border-bracongo rounded-full text-bracongo font-bold flex items-center justify-between hover:bg-bracongo hover:text-white transition-all group">
                    <span>TEMBO</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
