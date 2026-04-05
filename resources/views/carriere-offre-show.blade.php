@extends('layout.app')

@section('title', $offre->titre.' — Carrière')
@section('meta_description', Str::limit(strip_tags($offre->description ?? ''), 155))

@section('content')

    {{-- ===== HERO ===== --}}
    <div class="relative w-full h-[420px] md:h-[540px] overflow-hidden">
        <img src="{{ asset($offre->image ?? 'img/brasserie.jpg') }}" alt="{{ $offre->titre }}"
             class="absolute inset-0 w-full h-full object-cover scale-105">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-black/10"></div>

        {{-- Fil d'Ariane --}}
        <div class="absolute top-6 left-0 right-0 px-4 md:px-12 max-w-7xl mx-auto">
            <nav class="text-xs text-white/70 flex items-center gap-2" aria-label="Fil d'Ariane">
                <a href="{{ route('Accueil') }}" class="hover:text-white transition-colors">Accueil</a>
                <span class="opacity-50">/</span>
                <a href="{{ route('carriere') }}" class="hover:text-white transition-colors">Carrière</a>
                <span class="opacity-50">/</span>
                <span class="text-white/90">{{ Str::limit($offre->titre, 40) }}</span>
            </nav>
        </div>

        {{-- Contenu héro --}}
        <div class="absolute inset-0 flex flex-col justify-end pb-10 md:pb-14 px-4 md:px-12">
            <div class="max-w-7xl mx-auto w-full">

                {{-- Badges --}}
                <div class="flex flex-wrap gap-2 mb-5">
                    @if($offre->type_contrat)
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-bracongo text-white text-xs font-bold uppercase tracking-wider">
                            {{ $offre->type_contrat }}
                        </span>
                    @endif
                    @if($offre->lieu)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 text-white text-xs font-medium backdrop-blur-sm border border-white/20">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $offre->lieu }}
                        </span>
                    @endif
                    @if($offre->date_limite_candidature)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 text-white text-xs font-medium backdrop-blur-sm border border-white/20">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Date limite : {{ $offre->date_limite_candidature->format('d/m/Y') }}
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight tracking-tight max-w-4xl">
                    {{ $offre->titre }}
                </h1>

                {{-- CTA rapide --}}
                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="#postuler"
                       class="inline-flex items-center gap-2 px-7 py-3 bg-bracongo text-white rounded-full font-bold text-sm hover:bg-red-700 transition-colors shadow-lg">
                        Postuler maintenant
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </a>
                    <a href="{{ route('carriere') }}"
                       class="inline-flex items-center gap-2 px-7 py-3 bg-white/15 text-white rounded-full font-bold text-sm hover:bg-white/25 transition-colors border border-white/30 backdrop-blur-sm">
                        <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        Toutes les offres
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== CORPS ===== --}}
    <section class="bg-white py-14 md:py-20">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16 items-start">

                {{-- ---- COLONNE GAUCHE : description ---- --}}
                <div class="lg:col-span-2 space-y-10">

                    {{-- Résumé rapide --}}
                    @if($offre->lieu || $offre->type_contrat || $offre->date_limite_candidature)
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-px bg-gray-100 rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                        @if($offre->lieu)
                        <div class="bg-white px-5 py-4 flex items-center gap-3">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-bracongo/10 text-bracongo">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Lieu</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $offre->lieu }}</p>
                            </div>
                        </div>
                        @endif
                        @if($offre->type_contrat)
                        <div class="bg-white px-5 py-4 flex items-center gap-3">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-bracongo/10 text-bracongo">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Contrat</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $offre->type_contrat }}</p>
                            </div>
                        </div>
                        @endif
                        @if($offre->date_limite_candidature)
                        <div class="bg-white px-5 py-4 flex items-center gap-3">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-bracongo/10 text-bracongo">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Date limite</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $offre->date_limite_candidature->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    {{-- Description --}}
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <img src="{{ asset('img/Group.png') }}" alt="" class="h-7 w-auto">
                            <h2 class="text-2xl font-bold text-gray-900">Description du poste</h2>
                        </div>
                        <div class="prose prose-lg max-w-none
                            prose-headings:text-gray-900 prose-headings:font-bold
                            prose-p:text-gray-700 prose-p:leading-relaxed
                            prose-li:text-gray-700
                            prose-a:text-bracongo prose-a:font-semibold hover:prose-a:underline
                            prose-strong:text-gray-900">
                            {!! \App\Support\CmsHtmlSanitizer::sanitize($offre->description) !!}
                        </div>
                    </div>

                    @if($offre->lien && $offre->lien !== '#')
                        <div class="pt-4 border-t border-gray-100">
                            <a href="{{ $offre->lien }}" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-bracongo transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Voir le lien complémentaire
                            </a>
                        </div>
                    @endif

                    {{-- CTA mobile (visible uniquement sur petit écran) --}}
                    <div class="lg:hidden pt-2">
                        <a href="#postuler"
                           class="flex items-center justify-center gap-2 w-full py-4 bg-bracongo text-white rounded-full font-bold text-sm hover:bg-red-700 transition-colors shadow">
                            Postuler à cette offre
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- ---- COLONNE DROITE : formulaire ---- --}}
                <aside class="lg:col-span-1">
                    <div class="lg:sticky lg:top-8 space-y-6">

                        <div id="postuler" class="rounded-2xl overflow-hidden shadow-md border border-gray-100 scroll-mt-8">

                            {{-- En-tête formulaire --}}
                            <div class="bg-bracongo px-6 py-5">
                                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Postuler à cette offre
                                </h2>
                                <p class="text-sm text-white/80 mt-1">
                                    CV (PDF ou Word, 10&nbsp;Mo max)
                                    @if($offre->require_lettre_motivation)
                                        · lettre de motivation requise
                                    @endif
                                </p>
                            </div>

                            <div class="bg-white px-6 py-6">

                                {{-- Message succès --}}
                                @if(session('success'))
                                    <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-4 flex gap-3 items-start" role="status">
                                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-100 text-green-700">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </span>
                                        <p class="text-sm text-green-900 font-medium pt-0.5">{{ session('success') }}</p>
                                    </div>
                                @endif

                                <form action="{{ route('carriere.offre.candidature.store', $offre) }}"
                                      method="post" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    {{-- Honeypot --}}
                                    <input type="text" name="candidature_website_url" value="" tabindex="-1"
                                           autocomplete="off" class="absolute opacity-0 pointer-events-none h-0 w-0" aria-hidden="true">

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label for="prenom" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">
                                                Prénom <span class="text-bracongo">*</span>
                                            </label>
                                            <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                                                   class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400
                                                          focus:border-bracongo focus:ring-2 focus:ring-bracongo/20 focus:bg-white outline-none transition">
                                            @error('prenom')
                                                <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="nom" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">
                                                Nom <span class="text-bracongo">*</span>
                                            </label>
                                            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                                                   class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400
                                                          focus:border-bracongo focus:ring-2 focus:ring-bracongo/20 focus:bg-white outline-none transition">
                                            @error('nom')
                                                <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label for="email" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">
                                            E-mail <span class="text-bracongo">*</span>
                                        </label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                               autocomplete="email" placeholder="votre@email.com"
                                               class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400
                                                      focus:border-bracongo focus:ring-2 focus:ring-bracongo/20 focus:bg-white outline-none transition">
                                        @error('email')
                                            <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="telephone" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">
                                            Téléphone <span class="text-gray-300 font-normal normal-case tracking-normal">— optionnel</span>
                                        </label>
                                        <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}"
                                               autocomplete="tel" placeholder="+242 06 …"
                                               class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400
                                                      focus:border-bracongo focus:ring-2 focus:ring-bracongo/20 focus:bg-white outline-none transition">
                                        @error('telephone')
                                            <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="message" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">
                                            Message <span class="text-gray-300 font-normal normal-case tracking-normal">— optionnel</span>
                                        </label>
                                        <textarea name="message" id="message" rows="3"
                                                  placeholder="Quelques mots sur votre profil…"
                                                  class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400
                                                         focus:border-bracongo focus:ring-2 focus:ring-bracongo/20 focus:bg-white outline-none transition resize-none">{{ old('message') }}</textarea>
                                        @error('message')
                                            <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    @if($offre->require_lettre_motivation)
                                    <div>
                                        <label for="lettre_motivation" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">
                                            Lettre de motivation <span class="text-bracongo">*</span>
                                        </label>
                                        <textarea name="lettre_motivation" id="lettre_motivation" rows="5" required
                                                  placeholder="Présentez votre parcours et votre motivation pour ce poste…"
                                                  class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400
                                                         focus:border-bracongo focus:ring-2 focus:ring-bracongo/20 focus:bg-white outline-none transition resize-none">{{ old('lettre_motivation') }}</textarea>
                                        @error('lettre_motivation')
                                            <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    @endif

                                    {{-- Upload CV --}}
                                    <div>
                                        <label for="cv" class="block text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">
                                            Votre CV <span class="text-bracongo">*</span>
                                        </label>
                                        <label for="cv"
                                               class="flex flex-col items-center justify-center gap-2 w-full rounded-xl border-2 border-dashed border-gray-200 bg-gray-50
                                                      hover:border-bracongo hover:bg-bracongo/5 transition cursor-pointer px-4 py-5 text-center group">
                                            <svg class="w-8 h-8 text-gray-300 group-hover:text-bracongo transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                            <span id="cv-label" class="text-sm text-gray-500 group-hover:text-bracongo transition font-medium">
                                                Cliquez pour déposer votre CV
                                            </span>
                                            <span class="text-xs text-gray-400">PDF, DOC ou DOCX · 10 Mo max</span>
                                        </label>
                                        <input type="file" name="cv" id="cv" required
                                               accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                               class="sr-only"
                                               onchange="document.getElementById('cv-label').textContent = this.files[0]?.name ?? 'Cliquez pour déposer votre CV'">
                                        @error('cv')
                                            <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="submit"
                                            class="w-full rounded-full bg-bracongo px-6 py-3.5 text-sm font-bold text-white
                                                   hover:bg-red-700 active:scale-95 transition-all shadow-sm flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                        </svg>
                                        Envoyer ma candidature
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Texte RH --}}
                        @if($carriere->texte_intro ?? null)
                            <div class="bg-[#F8F8F8] rounded-2xl px-5 py-4 border border-gray-100">
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $carriere->texte_intro }}</p>
                            </div>
                        @endif

                    </div>
                </aside>

            </div>
        </div>
    </section>

    {{-- ===== AUTRES OFFRES ===== --}}
    @if($autresOffres->isNotEmpty())
        <section class="bg-[#F8F8F8] border-t border-gray-100 py-16 md:py-20">
            <div class="max-w-7xl mx-auto px-4 lg:px-8">

                <div class="flex items-center gap-3 mb-12">
                    <img src="{{ asset('img/Group.png') }}" alt="" class="h-8 w-auto">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Autres offres</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($autresOffres as $autre)
                        <a href="{{ route('carriere.offre.show', $autre) }}"
                           class="group flex flex-col bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                            <div class="relative h-44 overflow-hidden bg-gray-100">
                                <img src="{{ asset($autre->image ?? 'img/brasserie.jpg') }}" alt="{{ $autre->titre }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                {{-- Overlay au hover --}}
                                <div class="absolute inset-0 bg-bracongo/0 group-hover:bg-bracongo/10 transition-all duration-300"></div>
                                @if($autre->type_contrat)
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-bracongo text-white text-[10px] font-bold uppercase tracking-wider shadow">
                                        {{ $autre->type_contrat }}
                                    </span>
                                @endif
                            </div>

                            <div class="p-5 flex flex-col flex-1 gap-3">
                                <h3 class="text-base font-bold text-gray-900 group-hover:text-bracongo transition-colors leading-snug">
                                    {{ $autre->titre }}
                                </h3>

                                @if($autre->lieu || $autre->date_limite_candidature)
                                    <div class="flex flex-wrap gap-2 text-xs text-gray-500">
                                        @if($autre->lieu)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-bracongo/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                </svg>
                                                {{ $autre->lieu }}
                                            </span>
                                        @endif
                                        @if($autre->date_limite_candidature)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-bracongo/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $autre->date_limite_candidature->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                <div class="mt-auto pt-2 flex items-center gap-1 text-bracongo font-bold text-sm">
                                    Voir l'offre
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

@endsection
