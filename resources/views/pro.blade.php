@extends('layout.app')

@section('title', $pro->hero_titre ?? 'Bracongo Pro')

@section('content')
    <div class="relative w-full h-[400px] md:h-[700px] overflow-hidden">
        <img src="{{ asset($pro->hero_image ?? 'img/brcpro.png') }}" alt="{{ $pro->hero_titre ?? 'Bracongo Pro' }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-center uppercase tracking-widest">
                {{ $pro->hero_titre ?? 'Bracongo Pro' }}
            </h1>
        </div>
    </div>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-16 items-center">

                <div class="flex justify-center lg:justify-end lg:col-span-2">
                    <div class="w-full max-w-[900px] h-[500px] md:h-[700px]">
                        <img src="{{ asset($pro->app_image ?? 'img/tel.png') }}" alt="Application Bracongo Pro" class="w-full h-auto object-contain scale-110 md:scale-125">
                    </div>
                </div>

                <div class="space-y-12 lg:col-span-3">
                    @if($pro->description ?? null)
                    <p class="text-gray-800 text-sm md:text-base leading-relaxed font-bold">
                        {{ $pro->description }}
                    </p>
                    @endif

                    @if($pro->pourquoi_titre || $pro->pourquoi_intro || $pro->pourquoi_items)
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-6 w-auto">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $pro->pourquoi_titre ?? 'Pourquoi choisir Bracongo Pro?' }}</h2>
                        </div>
                        @if($pro->pourquoi_intro ?? null)
                        <p class="text-gray-700 text-sm md:text-base font-medium">
                            {{ $pro->pourquoi_intro }}
                        </p>
                        @endif
                        @if($pro->pourquoi_items ?? null)
                        <div class="text-gray-700 text-sm md:text-base font-medium [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:space-y-3 [&_strong]:font-bold">
                            {!! \App\Support\CmsHtmlSanitizer::sanitize($pro->pourquoi_items) !!}
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($pro->fonctionnalites_titre || $pro->fonctionnalites_items)
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('img/Group.png') }}" alt="Icon" class="h-6 w-auto">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $pro->fonctionnalites_titre ?? 'Fonctionnalités clés' }}</h2>
                        </div>
                        @if($pro->fonctionnalites_items ?? null)
                        <div class="text-gray-700 text-sm md:text-base font-medium [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:space-y-3 [&_strong]:font-bold [&_a]:text-bracongo [&_a]:hover:underline">
                            {!! \App\Support\CmsHtmlSanitizer::sanitize($pro->fonctionnalites_items) !!}
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="pt-4">
                        <a href="{{ $pro->cta_lien ?? '#' }}" class="inline-flex items-center gap-3 px-10 py-4 bg-bracongo text-white rounded-full font-bold hover:opacity-90 transition-all shadow-lg group">
                            <span>{{ $pro->cta_texte ?? 'Télécharger Bracongo pro' }}</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
