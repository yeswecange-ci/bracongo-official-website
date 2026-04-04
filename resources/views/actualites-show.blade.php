@extends('layout.app')

@section('title', $news->titre)

@section('content')
@php
    $typeKey = $news->type;
    $accent = match ($typeKey) {
        'actualites' => [
            'bar' => 'bg-bracongo',
            'pill' => 'bg-bracongo/10 text-bracongo border border-bracongo/20',
            'heroTint' => 'from-black/75 via-black/50 to-bracongo/40',
            'quote' => 'border-bracongo',
            'label' => 'Actualité',
        ],
        'evenements' => [
            'bar' => 'bg-sky-600',
            'pill' => 'bg-sky-50 text-sky-900 border border-sky-200',
            'heroTint' => 'from-black/75 via-sky-900/40 to-sky-600/30',
            'quote' => 'border-sky-500',
            'label' => 'Événement',
        ],
        'activations' => [
            'bar' => 'bg-amber-500',
            'pill' => 'bg-amber-50 text-amber-900 border border-amber-200',
            'heroTint' => 'from-black/70 via-amber-900/30 to-amber-500/25',
            'quote' => 'border-amber-500',
            'label' => 'Activation',
        ],
        'sponsoring' => [
            'bar' => 'bg-amber-700',
            'pill' => 'bg-amber-100/90 text-amber-950 border border-amber-300',
            'heroTint' => 'from-black/80 via-amber-950/35 to-amber-700/25',
            'quote' => 'border-amber-600',
            'label' => 'Sponsoring',
        ],
        'communiques' => [
            'bar' => 'bg-slate-700',
            'pill' => 'bg-slate-100 text-slate-800 border border-slate-300',
            'heroTint' => 'from-black/80 via-slate-900/50 to-slate-700/30',
            'quote' => 'border-slate-500',
            'label' => 'Communiqué',
        ],
        'mediatheque' => [
            'bar' => 'bg-violet-600',
            'pill' => 'bg-violet-50 text-violet-900 border border-violet-200',
            'heroTint' => 'from-black/75 via-violet-900/40 to-violet-600/30',
            'quote' => 'border-violet-500',
            'label' => 'Médiathèque',
        ],
        default => [
            'bar' => 'bg-bracongo',
            'pill' => 'bg-gray-100 text-gray-800 border border-gray-200',
            'heroTint' => 'from-black/70 to-black/40',
            'quote' => 'border-gray-400',
            'label' => $types[$typeKey] ?? 'Publication',
        ],
    };
@endphp

    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        @if($news->image)
            <img src="{{ asset($news->image) }}" alt="{{ $news->titre }}" class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-900"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t {{ $accent['heroTint'] }}"></div>
        <div class="absolute inset-0 flex flex-col justify-end pb-10 md:pb-14 px-4 md:px-12 max-w-6xl mx-auto w-full text-white">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest {{ $accent['pill'] }}">
                    {{ $types[$news->type] ?? $accent['label'] }}
                </span>
                @if($news->date_publication)
                    <span class="text-white/90 text-sm font-medium">{{ $news->date_publication->format('d/m/Y') }}</span>
                @endif
            </div>
            <div class="flex items-start gap-4">
                <span class="hidden md:block w-1.5 self-stretch min-h-[3rem] rounded-full {{ $accent['bar'] }} shrink-0" aria-hidden="true"></span>
                <h1 class="text-3xl md:text-5xl font-bold leading-tight tracking-tight max-w-4xl">
                    {{ $news->titre }}
                </h1>
            </div>
            @if($news->lieu || $news->date_evenement)
                <div class="mt-6 flex flex-wrap items-center gap-2 text-white/95 text-sm md:text-base">
                    <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    @if($news->lieu)<span>{{ $news->lieu }}</span>@endif
                    @if($news->date_evenement)
                        <span class="text-white/70">·</span>
                        <time datetime="{{ $news->date_evenement->format('Y-m-d') }}">{{ $news->date_evenement->format('d/m/Y') }}</time>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white">
        <div class="max-w-4xl mx-auto px-4 py-10 md:py-14">
            <nav class="text-sm text-gray-500 mb-10" aria-label="Fil d'Ariane">
                <a href="{{ route('Accueil') }}" class="hover:text-bracongo">Accueil</a>
                <span class="mx-2">/</span>
                <a href="{{ route('actualites') }}" class="hover:text-bracongo">Actualités &amp; événements</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 font-medium">{{ Str::limit($news->titre, 60) }}</span>
            </nav>

            @if($news->extrait)
                <p class="text-lg md:text-xl text-gray-700 leading-relaxed font-medium border-l-4 pl-6 py-1 mb-10 {{ $accent['quote'] }}">
                    {{ $news->extrait }}
                </p>
            @endif

            <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-a:text-bracongo">
                {!! \App\Support\CmsHtmlSanitizer::sanitize($news->contenu) !!}
            </div>

            @if($news->lien_externe)
                <div class="mt-12 pt-10 border-t border-gray-100">
                    <a href="{{ $news->lien_externe }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-bracongo text-bracongo font-bold hover:bg-bracongo hover:text-white transition-colors">
                        Ressource externe
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            @endif

            <div class="mt-14">
                <a href="{{ route('actualites', ['type' => $news->type]) }}"
                    class="inline-flex items-center gap-2 text-bracongo font-bold hover:underline">
                    <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    Voir le fil « {{ $types[$news->type] ?? $news->type }} »
                </a>
            </div>
        </div>
    </div>

    @if($relatedNews->isNotEmpty())
        <section class="bg-[#F8F8F8] border-t border-gray-100 py-16 md:py-20">
            <div class="max-w-7xl mx-auto px-4 lg:px-12">
                <div class="flex items-center gap-3 mb-10">
                    <img src="{{ asset('img/Group.png') }}" alt="" class="h-8 w-auto">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">À lire aussi</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedNews as $item)
                        <a href="{{ route('actualites.show', $item->slug) }}" class="group flex flex-col bg-white rounded-[1.25rem] overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-shadow text-left">
                            <div class="h-44 overflow-hidden bg-gray-100">
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" stroke-width="1.5"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5 flex flex-col flex-1 gap-2">
                                <span class="text-[10px] font-bold text-bracongo uppercase tracking-widest">{{ $types[$item->type] ?? '' }}</span>
                                <h3 class="text-base font-bold text-gray-900 line-clamp-2 group-hover:text-bracongo transition-colors">{{ $item->titre }}</h3>
                                @if($item->date_publication)
                                    <span class="text-xs text-gray-400 mt-auto">{{ $item->date_publication->format('d/m/Y') }}</span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
