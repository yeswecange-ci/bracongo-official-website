@extends('layout.app')

@section('title', $news->titre)

@section('content')
@php
    $typeKey = $news->type;
    $accent = match ($typeKey) {
        'actualites' => [
            'bar' => 'bg-bracongo',
            'pill' => 'bg-bracongo/10 text-bracongo border border-bracongo/20',
            'quote' => 'border-bracongo',
            'label' => 'Actualité',
        ],
        'evenements' => [
            'bar' => 'bg-sky-600',
            'pill' => 'bg-sky-50 text-sky-900 border border-sky-200',
            'quote' => 'border-sky-500',
            'label' => 'Événement',
        ],
        'activations' => [
            'bar' => 'bg-amber-500',
            'pill' => 'bg-amber-50 text-amber-900 border border-amber-200',
            'quote' => 'border-amber-500',
            'label' => 'Activation',
        ],
        'sponsoring' => [
            'bar' => 'bg-amber-700',
            'pill' => 'bg-amber-100/90 text-amber-950 border border-amber-300',
            'quote' => 'border-amber-600',
            'label' => 'Sponsoring',
        ],
        'communiques' => [
            'bar' => 'bg-slate-700',
            'pill' => 'bg-slate-100 text-slate-800 border border-slate-300',
            'quote' => 'border-slate-500',
            'label' => 'Communiqué',
        ],
        'mediatheque' => [
            'bar' => 'bg-violet-600',
            'pill' => 'bg-violet-50 text-violet-900 border border-violet-200',
            'quote' => 'border-violet-500',
            'label' => 'Médiathèque',
        ],
        default => [
            'bar' => 'bg-bracongo',
            'pill' => 'bg-gray-100 text-gray-800 border border-gray-200',
            'quote' => 'border-gray-400',
            'label' => $types[$typeKey] ?? 'Publication',
        ],
    };
@endphp
@php
    $galleryImages = collect($news->gallery_images ?? [])->filter()->take(6)->values();
    $youtubeUrls = \App\Support\YoutubeEmbed::collectEmbedUrls($news->youtube_urls ?? null);
    $whatsappUrl = trim((string) ($news->whatsapp_url ?? ''));
    $whatsappLabel = trim((string) ($news->whatsapp_label ?? '')) ?: 'Vivez l’événement avec nous sur WhatsApp';
@endphp

    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        @if($news->image)
            <img src="{{ asset($news->image) }}" alt="{{ $news->titre }}" class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-900"></div>
        @endif
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/65 via-black/25 to-transparent" aria-hidden="true"></div>
        <div class="absolute inset-0 flex flex-col justify-end pb-10 md:pb-14 px-4 md:px-12 max-w-6xl mx-auto w-full text-white drop-shadow-md">
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
            @if($news->lieu || ($news->type === 'evenements' && $news->date_evenement))
                <div class="mt-6 flex flex-wrap items-center gap-2 text-white/95 text-sm md:text-base">
                    <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    @if($news->lieu)<span>{{ $news->lieu }}</span>@endif
                    @if($news->type === 'evenements' && $news->date_evenement)
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

            <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-p:text-justify prose-a:text-bracongo">
                {!! \App\Support\CmsHtmlSanitizer::sanitize($news->contenu) !!}
            </div>

            @if($galleryImages->isNotEmpty() || $youtubeUrls->isNotEmpty())
                <section class="mt-12 pt-10 border-t border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('img/Group.webp') }}" alt="" class="h-6 w-auto" aria-hidden="true">
                        <h2 class="text-2xl font-bold text-gray-900">Médiathèque</h2>
                    </div>

                    @if($galleryImages->isNotEmpty())
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($galleryImages as $img)
                            <a href="{{ asset($img) }}" target="_blank" rel="noopener noreferrer"
                               class="block rounded-2xl overflow-hidden border border-gray-200 bg-gray-100 group">
                                <img src="{{ asset($img) }}" alt="Galerie {{ $news->titre }}"
                                     class="w-full h-36 md:h-40 object-cover group-hover:scale-105 transition-transform duration-500">
                            </a>
                        @endforeach
                    </div>
                    @endif

                    @if($youtubeUrls->isNotEmpty())
                    <div class="mt-8 md:mt-10 space-y-8">
                        @foreach($youtubeUrls as $videoUrl)
                            <div class="relative w-full max-w-4xl mx-auto h-0 pb-[56.25%] rounded-[2rem] overflow-hidden bg-black shadow-xl ring-1 ring-black/10">
                                <iframe
                                    src="{{ $videoUrl }}"
                                    title="Vidéo {{ $loop->iteration }} — {{ $news->titre }}"
                                    class="absolute top-0 left-0 w-full h-full border-0"
                                    loading="lazy"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allowfullscreen></iframe>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </section>
            @endif

            @if($news->lien_externe)
                <div class="mt-12 pt-10 border-t border-gray-100">
                    <a href="{{ $news->lien_externe }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-bracongo text-bracongo font-bold hover:bg-bracongo hover:text-white transition-colors">
                        Ressource externe
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            @endif

            @if($whatsappUrl !== '')
                <div class="mt-6">
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                        style="display:inline-flex;align-items:center;gap:.5rem;padding:.7rem 1.5rem;border-radius:9999px;background:#16a34a;color:#fff;font-weight:700;text-decoration:none;box-shadow:0 1px 4px rgba(0,0,0,.15);"
                        onmouseover="this.style.background='#15803d'" onmouseout="this.style.background='#16a34a'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" style="flex-shrink:0">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                        </svg>
                        {{ $whatsappLabel }}
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
                    <img src="{{ asset('img/Group.webp') }}" alt="" class="h-8 w-auto">
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
