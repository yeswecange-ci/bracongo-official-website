@extends('layout.app')

@section('title', 'Finaliser la commande')

@section('content')
<div class="min-h-[70vh] bg-gray-50 py-16">
    <div class="max-w-5xl mx-auto px-4">

        {{-- En-tête --}}
        <div class="flex items-center gap-3 mb-10">
            <img src="{{ asset('img/Group.png') }}" alt="" class="h-8 w-auto" loading="lazy" decoding="async" aria-hidden="true">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Finaliser la commande</h1>
        </div>

        {{-- Fil d'ariane --}}
        <div class="flex items-center gap-2 text-sm text-gray-400 mb-8 font-medium">
            <a href="{{ route('boutique') }}" class="hover:text-bracongo transition-colors">Boutique</a>
            <span>›</span>
            <a href="{{ route('panier') }}" class="hover:text-bracongo transition-colors">Panier</a>
            <span>›</span>
            <span class="text-gray-700 font-semibold">Commander</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Formulaire --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                    <h2 class="font-bold text-gray-900 text-lg mb-6">Vos coordonnées</h2>

                    <form action="{{ route('commande.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Nom complet <span class="text-bracongo">*</span>
                                </label>
                                <input type="text" name="nom" value="{{ old('nom') }}"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-bracongo @error('nom') border-red-400 @enderror"
                                       placeholder="Jean Mbala">
                                @error('nom')<p class="text-bracongo text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Adresse e-mail <span class="text-bracongo">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-bracongo @error('email') border-red-400 @enderror"
                                       placeholder="jean@example.com">
                                @error('email')<p class="text-bracongo text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Téléphone</label>
                            <input type="text" name="telephone" value="{{ old('telephone') }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-bracongo"
                                   placeholder="+243 8XX XXX XXX">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse de livraison</label>
                            <input type="text" name="adresse" value="{{ old('adresse') }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-bracongo"
                                   placeholder="Avenue, quartier, commune, ville">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Notes / instructions particulières</label>
                            <textarea name="notes" rows="3"
                                      class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-bracongo resize-none"
                                      placeholder="Ex. : disponible le matin, livraison en entreprise…">{{ old('notes') }}</textarea>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                    class="w-full py-3.5 bg-bracongo text-white font-bold rounded-full hover:opacity-90 transition-all text-base">
                                Confirmer la commande →
                            </button>
                            <p class="text-center text-xs text-gray-400 mt-3">
                                En validant, vous acceptez que Bracongo vous contacte pour confirmer votre commande.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Récap commande --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-24">
                    <h2 class="font-bold text-gray-900 text-base mb-4">Votre commande</h2>

                    <div class="space-y-3 text-sm border-b border-gray-100 pb-4 mb-4">
                        @foreach($panier as $ligne)
                        <div class="flex justify-between items-start gap-3">
                            <div class="flex items-center gap-2.5 min-w-0">
                                @if($ligne['image'])
                                <img src="{{ asset($ligne['image']) }}" alt="" class="w-10 h-10 rounded-lg object-contain bg-gray-50 flex-shrink-0" loading="lazy" decoding="async">
                                @endif
                                <span class="text-gray-700 truncate">{{ $ligne['nom'] }}<br>
                                    <span class="text-gray-400 text-xs">× {{ $ligne['quantite'] }}</span>
                                </span>
                            </div>
                            <span class="font-semibold text-gray-900 flex-shrink-0 text-right">
                                {{ $ligne['prix'] > 0 ? number_format($ligne['prix'] * $ligne['quantite'], 0, ',', ' ') : '—' }}
                            </span>
                        </div>
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="font-bold text-gray-900">Total</span>
                        <span class="font-bold text-bracongo text-xl">
                            {{ $total > 0 ? number_format($total, 0, ',', ' ') . ' CDF' : '—' }}
                        </span>
                    </div>

                    <a href="{{ route('panier') }}" class="block text-center text-xs text-gray-400 hover:text-bracongo mt-4 underline transition-colors">
                        ← Modifier le panier
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
