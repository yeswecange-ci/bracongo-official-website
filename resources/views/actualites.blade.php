@extends('layout.app')

@section('title', 'Actualités & Événements')

@section('content')
    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ asset('img/bracongo.jpg') }}" alt="Actualités" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-center uppercase tracking-[0.2em]">
                Actualités & Événements
            </h1>
        </div>
    </div>

    <section class="py-10 bg-white border-b border-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('actualites') }}"
                    class="px-6 py-2 rounded-full text-sm font-semibold transition-all {{ !$type ? 'bg-bracongo text-white' : 'border border-gray-300 text-gray-700 hover:border-bracongo hover:text-bracongo' }}">
                    Tout voir
                </a>
                @foreach($types as $key => $label)
                <a href="{{ route('actualites', ['type' => $key]) }}"
                    class="px-6 py-2 rounded-full text-sm font-semibold transition-all {{ $type === $key ? 'bg-bracongo text-white' : 'border border-gray-300 text-gray-700 hover:border-bracongo hover:text-bracongo' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 lg:px-12 max-w-7xl">
            @if($news->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($news as $item)
                <article class="flex flex-col bg-white rounded-[1.5rem] overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    @if($item->image)
                    <div class="h-52 overflow-hidden">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->titre }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    @else
                    <div class="h-52 bg-gray-100 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" stroke-width="1.5"/>
                            <circle cx="8.5" cy="8.5" r="1.5" stroke-width="1.5"/>
                            <polyline points="21 15 16 10 5 21" stroke-width="1.5"/>
                        </svg>
                    </div>
                    @endif
                    <div class="flex flex-col flex-1 p-6 gap-4">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-bracongo uppercase tracking-widest">{{ $types[$item->type] ?? $item->type }}</span>
                            @if($item->date_publication)
                            <span class="text-xs text-gray-400">{{ $item->date_publication->format('d/m/Y') }}</span>
                            @endif
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 leading-snug">{{ $item->titre }}</h2>
                        @if($item->extrait)
                        <p class="text-gray-600 text-sm leading-relaxed flex-1">{{ Str::limit($item->extrait, 150) }}</p>
                        @endif
                        @if($item->lieu || $item->date_evenement)
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $item->lieu }}
                            @if($item->date_evenement)
                             · {{ $item->date_evenement->format('d/m/Y') }}
                            @endif
                        </div>
                        @endif
                        @if($item->lien_externe)
                        <a href="{{ $item->lien_externe }}" target="_blank" rel="noopener"
                            class="inline-flex items-center gap-2 text-bracongo font-bold text-sm hover:underline mt-auto">
                            En savoir plus
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        @endif
                    </div>
                </article>
                @endforeach
            </div>
            @else
            <div class="text-center py-20 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <p class="text-lg font-medium">Aucune actualité disponible pour le moment.</p>
            </div>
            @endif
        </div>
    </section>
@endsection
