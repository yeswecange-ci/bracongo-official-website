@extends('layout.app')

@section('title', $offre->titre.' — Carrière')

@section('content')
    <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ asset($offre->image ?? 'img/brasserie.jpg') }}" alt="" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/45 to-black/20"></div>
        <div class="absolute inset-0 flex flex-col justify-end pb-10 md:pb-14 px-4 md:px-12 max-w-6xl mx-auto w-full text-white">
            <nav class="text-sm text-white/80 mb-6" aria-label="Fil d'Ariane">
                <a href="{{ route('Accueil') }}" class="hover:text-white">Accueil</a>
                <span class="mx-2">/</span>
                <a href="{{ route('carriere') }}" class="hover:text-white">Carrière</a>
                <span class="mx-2">/</span>
                <span class="text-white font-medium">{{ Str::limit($offre->titre, 48) }}</span>
            </nav>
            <h1 class="text-3xl md:text-5xl font-bold leading-tight tracking-tight max-w-4xl">{{ $offre->titre }}</h1>
            <div class="flex flex-wrap gap-3 mt-6">
                @if($offre->lieu)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 text-sm font-medium backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $offre->lieu }}
                    </span>
                @endif
                @if($offre->type_contrat)
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-bracongo/90 text-sm font-bold">{{ $offre->type_contrat }}</span>
                @endif
                @if($offre->date_limite_candidature)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 text-sm font-medium backdrop-blur-sm">
                        Candidatures jusqu’au {{ $offre->date_limite_candidature->format('d/m/Y') }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <section class="bg-white py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-14 items-start">
                <div class="lg:col-span-2 space-y-8">
                    <a href="{{ route('carriere') }}" class="inline-flex items-center gap-2 text-bracongo font-bold hover:underline">
                        <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        Toutes les offres
                    </a>

                    <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-a:text-bracongo">
                        {!! \App\Support\CmsHtmlSanitizer::sanitize($offre->description) !!}
                    </div>

                    @if($offre->lien && $offre->lien !== '#')
                        <div class="pt-4 border-t border-gray-100">
                            <a href="{{ $offre->lien }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-gray-700 text-sm font-medium hover:text-bracongo">
                                Lien complémentaire
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    @endif
                </div>

                <aside class="lg:col-span-1">
                    <div class="lg:sticky lg:top-8 space-y-6">
                        <div id="postuler" class="rounded-2xl border border-gray-200 bg-[#FAFAFA] p-6 md:p-8 shadow-sm scroll-mt-24">
                            @if(session('success'))
                                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm text-green-900 flex gap-3 items-start" role="status">
                                    <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-800" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </span>
                                    <span class="pt-0.5 font-medium">{{ session('success') }}</span>
                                </div>
                            @endif
                            <h2 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-bracongo text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </span>
                                Postuler
                            </h2>
                            <p class="text-sm text-gray-600 mb-6">
                                Envoyez votre CV (PDF ou Word, 10&nbsp;Mo max) et vos coordonnées.
                                @if($offre->require_lettre_motivation)
                                    Une <strong>lettre de motivation</strong> est demandée pour cette offre.
                                @endif
                                Les fichiers sont transmis de façon sécurisée à nos équipes RH.
                            </p>

                            <form action="{{ route('carriere.offre.candidature.store', $offre) }}" method="post" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <input type="text" name="candidature_website_url" value="" tabindex="-1" autocomplete="off"
                                    class="absolute opacity-0 pointer-events-none h-0 w-0 overflow-hidden" aria-hidden="true">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="prenom" class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1">Prénom <span class="text-bracongo">*</span></label>
                                        <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                                            class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm focus:border-bracongo focus:ring-bracongo/20">
                                        @error('prenom')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="nom" class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1">Nom <span class="text-bracongo">*</span></label>
                                        <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                                            class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm focus:border-bracongo focus:ring-bracongo/20">
                                        @error('nom')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="email" class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1">E-mail <span class="text-bracongo">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email"
                                        class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm focus:border-bracongo focus:ring-bracongo/20">
                                    @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="telephone" class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1">Téléphone</label>
                                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" autocomplete="tel"
                                        class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm focus:border-bracongo focus:ring-bracongo/20">
                                    @error('telephone')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="message" class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1">Message <span class="text-gray-400 font-normal">(optionnel)</span></label>
                                    <textarea name="message" id="message" rows="4" class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm focus:border-bracongo focus:ring-bracongo/20">{{ old('message') }}</textarea>
                                    @error('message')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                @if($offre->require_lettre_motivation)
                                <div>
                                    <label for="lettre_motivation" class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1">Lettre de motivation <span class="text-bracongo">*</span></label>
                                    <textarea name="lettre_motivation" id="lettre_motivation" rows="6" required
                                        class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm focus:border-bracongo focus:ring-bracongo/20"
                                        placeholder="Présentez votre parcours et votre motivation pour ce poste…">{{ old('lettre_motivation') }}</textarea>
                                    @error('lettre_motivation')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                @endif
                                <div>
                                    <label for="cv" class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1">CV (PDF, DOC, DOCX) <span class="text-bracongo">*</span></label>
                                    <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required
                                        class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-bracongo file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-red-700">
                                    @error('cv')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                                <button type="submit" class="w-full rounded-full bg-bracongo px-6 py-3.5 text-sm font-bold text-white shadow-sm hover:bg-red-700 transition-colors">
                                    Envoyer ma candidature
                                </button>
                            </form>
                        </div>

                        @if($carriere->texte_intro ?? null)
                            <p class="text-sm text-gray-600 leading-relaxed px-1">{{ $carriere->texte_intro }}</p>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @if($autresOffres->isNotEmpty())
        <section class="bg-[#F8F8F8] border-t border-gray-100 py-14 md:py-16">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">
                <div class="flex items-center gap-3 mb-10">
                    <img src="{{ asset('img/Group.png') }}" alt="" class="h-8 w-auto">
                    <h2 class="text-2xl font-bold text-gray-900">Autres offres</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($autresOffres as $autre)
                        <a href="{{ route('carriere.offre.show', $autre) }}" class="group flex flex-col bg-white rounded-[1.25rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="h-40 overflow-hidden bg-gray-100">
                                <img src="{{ asset($autre->image ?? 'img/brasserie.jpg') }}" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-bracongo transition-colors">{{ $autre->titre }}</h3>
                                @if($autre->lieu || $autre->type_contrat)
                                    <p class="text-sm text-gray-500 mt-2">
                                        @if($autre->lieu){{ $autre->lieu }}@endif
                                        @if($autre->lieu && $autre->type_contrat) · @endif
                                        @if($autre->type_contrat){{ $autre->type_contrat }}@endif
                                    </p>
                                @endif
                                <span class="mt-4 inline-flex items-center gap-1 text-bracongo font-bold text-sm">
                                    Voir l’offre
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
