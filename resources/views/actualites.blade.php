@extends('layout.app')

@section('title', 'Notre Histoire')

@section('content')
<div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ asset('img/event.jpg') }}" alt="Nos Marques Banner" class="w-full h-full object-cover">
        
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-center">
                Nos actualités et évènements 
            </h1>
        </div>
    </div>
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
            <div class="flex flex-wrap justify-center gap-4 mb-16">
                <a href="#" class="px-8 py-2 bg-bracongo text-white rounded-full text-sm font-bold transition-all shadow-md">Actualités</a>
                <a href="#" class="px-8 py-2 border border-gray-200 text-gray-400 rounded-full text-sm font-bold hover:border-bracongo hover:text-bracongo transition-all">Activations</a>
                <a href="#" class="px-8 py-2 border border-gray-200 text-gray-400 rounded-full text-sm font-bold hover:border-bracongo hover:text-bracongo transition-all">Sponsoring</a>
                <a href="#" class="px-8 py-2 border border-gray-200 text-gray-400 rounded-full text-sm font-bold hover:border-bracongo hover:text-bracongo transition-all">Communiqués</a>
                <a href="#" class="px-8 py-2 border border-gray-200 text-gray-400 rounded-full text-sm font-bold hover:border-bracongo hover:text-bracongo transition-all">Médiathèque</a>
            </div>

            <div class="flex items-center justify-center gap-3 mb-16">
                <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-8 w-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Actualités</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('img/lumumba.png') }}" alt="Rencontre avec Lumumba" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex items-center justify-between mt-auto">
                        <h3 class="text-gray-900 font-bold text-sm">Rencontre avec Lumumba</h3>
                        <svg class="w-6 h-6 text-bracongo transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('img/influ.png') }}" alt="Rencontre des influenceurs" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex items-center justify-between mt-auto">
                        <h3 class="text-gray-900 font-bold text-sm">Rencontre des influenceurs</h3>
                        <svg class="w-6 h-6 text-bracongo transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('img/champ.png') }}" alt="Rencontre des influenceurs" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex items-center justify-between mt-auto">
                        <h3 class="text-gray-900 font-bold text-sm">Rencontre des influenceurs</h3>
                        <svg class="w-6 h-6 text-bracongo transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('img/bièrre.png') }}" alt="Rencontre des influenceurs" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex items-center justify-between mt-auto">
                        <h3 class="text-gray-900 font-bold text-sm">Rencontre des influenceurs</h3>
                        <svg class="w-6 h-6 text-bracongo transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('img/lumumba.png') }}" alt="Rencontre avec Lumumba" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex items-center justify-between mt-auto">
                        <h3 class="text-gray-900 font-bold text-sm">Rencontre avec Lumumba</h3>
                        <svg class="w-6 h-6 text-bracongo transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('img/influ.png') }}" alt="Rencontre des influenceurs" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex items-center justify-between mt-auto">
                        <h3 class="text-gray-900 font-bold text-sm">Rencontre des influenceurs</h3>
                        <svg class="w-6 h-6 text-bracongo transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('img/champ.png') }}" alt="Rencontre des influenceurs" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex items-center justify-between mt-auto">
                        <h3 class="text-gray-900 font-bold text-sm">Rencontre des influenceurs</h3>
                        <svg class="w-6 h-6 text-bracongo transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-[#F8F8F8] rounded-[2rem] overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('img/bièrre.png') }}" alt="Rencontre des influenceurs" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex items-center justify-between mt-auto">
                        <h3 class="text-gray-900 font-bold text-sm">Rencontre des influenceurs</h3>
                        <svg class="w-6 h-6 text-bracongo transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center gap-4 mt-12">
                <span class="text-bracongo font-bold text-sm cursor-pointer">1</span>
                <span class="text-gray-400 font-bold text-sm cursor-pointer hover:text-bracongo transition-colors">2</span>
                <span class="text-gray-400 font-bold text-sm cursor-pointer hover:text-bracongo transition-colors">3</span>
                <span class="text-gray-400 font-bold text-sm cursor-pointer hover:text-bracongo transition-colors">4</span>
                <span class="text-gray-400 font-bold text-sm cursor-pointer hover:text-bracongo transition-colors">5</span>
                <div class="flex items-center text-bracongo">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>
@endsection
