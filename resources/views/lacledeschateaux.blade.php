@extends('layout.app')

@section('title', $page->hero_titre ?? 'Clé des Châteaux')

@section('meta_description', 'La Clé des Châteaux — vins, champagnes et spiritueux à Kinshasa. Boutique et bar à vins Bracongo.')

@section('content')

    {{-- Hero premium — image bannière fixe (dynamisation à valider plus tard) --}}
    <section class="relative min-h-[600px] md:min-h-[720px] w-full overflow-hidden">
        <img src="{{ asset('img/clechateau3.jpg.jpeg') }}"
             alt="{{ $page->hero_titre ?? 'Clé des Châteaux' }}"
             class="absolute inset-0 w-full h-full object-cover scale-110 motion-safe:transition-transform motion-safe:duration-[20s] hover:scale-100"
             loading="eager"
             fetchpriority="high"
             decoding="async">

        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/60 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/20 pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-12 flex items-center min-h-[600px] md:min-h-[720px] pt-24 pb-24 md:pt-12 md:pb-28 lg:pb-32">
            <div class="max-w-2xl text-white space-y-6">

                <!-- <span class="uppercase text-xs tracking-[0.3em] text-bracongo font-semibold">
                    Expérience premium
                </span>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight uppercase tracking-wide">
                    {{ $page->hero_titre ?? 'Clé des Châteaux' }}
                </h1> -->

                <div class="w-20 h-[3px] bg-bracongo" aria-hidden="true"></div>

                @if(filled($page->paragraphe_1 ?? null))
                <p class="text-base md:text-lg text-white/85 leading-relaxed">
                    {!! nl2br(e($page->paragraphe_1)) !!}
                </p>
                @endif
                @if(filled($page->paragraphe_2 ?? null))
                <p class="text-base md:text-lg text-white/75 leading-relaxed">
                    {!! nl2br(e($page->paragraphe_2)) !!}
                </p>
                @endif

                @if(filled($page->horaire ?? null) || filled($page->adresse ?? null) || filled($page->telephone ?? null) || filled($page->email ?? null))
                <div class="mt-2 rounded-2xl bg-white/10 backdrop-blur-lg border border-white/10 p-6 space-y-3 text-sm md:text-base">
                    @if(filled($page->horaire ?? null))
                    <p class="text-white/90"><strong class="text-white font-semibold">Horaire :</strong> {{ $page->horaire }}</p>
                    @endif
                    @if(filled($page->adresse ?? null))
                    <p class="text-bracongo font-semibold leading-relaxed">
                        <strong class="text-white font-semibold">Adresse :</strong> {{ $page->adresse }}
                    </p>
                    @endif
                    @if(filled($page->telephone ?? null))
                    <p class="text-white/90"><strong class="text-white font-semibold">Tél :</strong> {{ $page->telephone }}</p>
                    @endif
                    @if(filled($page->email ?? null))
                    <p class="text-white/90">
                        <strong class="text-white font-semibold">Email :</strong>
                        <a href="mailto:{{ $page->email }}" class="text-bracongo font-semibold hover:underline ml-1">{{ $page->email }}</a>
                    </p>
                    @endif
                </div>
                @endif

                @if(filled($page->cta_url ?? null))
                <div class="pt-4 pb-2 md:pb-4">
                    <a href="{{ $page->cta_url }}"
                       target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-bracongo text-white text-sm font-bold uppercase tracking-wide shadow-lg hover:scale-105 motion-safe:transition-transform duration-300">
                        {{ $page->cta_libelle ?? 'Découvrir' }}
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>

    @if(filled($page->selection_titre ?? null) || filled($page->selection_texte ?? null) || filled($page->services_titre ?? null) || filled($page->services_html ?? null))
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                @if(filled($page->selection_titre ?? null) || filled($page->selection_texte ?? null))
                <div class="group bg-white rounded-3xl px-10 pt-10 pb-14 shadow-md hover:shadow-2xl motion-safe:transition-shadow duration-500 border border-gray-100/80 flex flex-col">
                    @if(filled($page->selection_titre ?? null))
                    <h2 class="text-3xl font-bold mb-4 text-gray-900">{{ $page->selection_titre }}</h2>
                    @endif
                    <div class="w-16 h-[3px] bg-bracongo mb-6" aria-hidden="true"></div>
                    @if(filled($page->selection_texte ?? null))
                    <p class="text-gray-600 text-lg leading-relaxed">{{ $page->selection_texte }}</p>
                    @endif
                    <div class="mt-14">
                        <a href="https://bracongo.cd/wp-content/uploads/2018/02/liste-de-vins-du-05-aout-2021-compress_compressed-1.pdf"
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full border-2 border-bracongo text-bracongo text-sm font-bold uppercase tracking-wide hover:bg-bracongo hover:text-white motion-safe:transition-colors duration-300">
                            Découvrir
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endif

                @if(filled($page->services_titre ?? null) || filled($page->services_html ?? null))
                <div class="relative bg-black text-white rounded-3xl p-10 overflow-hidden shadow-xl border border-white/5">
                    <div class="absolute inset-0 opacity-10 pointer-events-none"
                         style="background: radial-gradient(circle at top right, #E30613, transparent)"></div>
                    <div class="relative z-[1]">
                        @if(filled($page->services_titre ?? null))
                        <h2 class="text-3xl font-bold mb-4">{{ $page->services_titre }}</h2>
                        @endif
                        <div class="w-16 h-[3px] bg-bracongo mb-6" aria-hidden="true"></div>
                        @if(filled($page->services_html ?? null))
                        <div class="prose prose-invert prose-p:text-white/85 prose-headings:text-white prose-li:marker:text-bracongo max-w-none text-base leading-relaxed">
                            {!! $page->services_html !!}
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif
@endsection
