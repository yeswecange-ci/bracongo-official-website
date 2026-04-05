@extends('layout.app')

@section('title', 'Commande confirmée')

@section('content')
<div class="min-h-[70vh] bg-gray-50 py-20">
    <div class="max-w-2xl mx-auto px-4 text-center">

        {{-- Icône succès --}}
        <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Commande reçue !</h1>
        <p class="text-gray-500 text-sm mb-8">
            Merci <strong class="text-gray-700">{{ $commande->nom }}</strong>. Votre commande a bien été enregistrée.
            Notre équipe vous contactera sous peu à l'adresse
            <strong class="text-gray-700">{{ $commande->email }}</strong> pour confirmer les détails.
        </p>

        {{-- Référence --}}
        <div class="inline-flex items-center gap-3 bg-white border border-gray-200 rounded-2xl px-6 py-4 mb-10 shadow-sm">
            <span class="text-sm text-gray-500 font-medium">Référence de commande</span>
            <span class="font-bold text-bracongo text-lg tracking-wider">{{ $commande->reference }}</span>
        </div>

        {{-- Récap --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-left mb-8">
            <h2 class="font-bold text-gray-900 mb-4 text-base">Détail de votre commande</h2>
            <div class="space-y-3">
                @foreach($commande->lignes as $ligne)
                <div class="flex justify-between items-center text-sm border-b border-gray-50 pb-3 last:border-0 last:pb-0">
                    <span class="text-gray-700 font-medium">{{ $ligne->nom_produit }} <span class="text-gray-400">× {{ $ligne->quantite }}</span></span>
                    <span class="font-semibold text-gray-900">
                        {{ $ligne->prix_unitaire > 0 ? number_format((float) $ligne->sous_total, 0, ',', ' ') . ' CDF' : '—' }}
                    </span>
                </div>
                @endforeach
            </div>
            <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                <span class="font-bold text-gray-900">Total</span>
                <span class="font-bold text-bracongo text-xl">
                    {{ $commande->total > 0 ? number_format((float) $commande->total, 0, ',', ' ') . ' CDF' : '—' }}
                </span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('boutique') }}"
               class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-bracongo text-white font-bold rounded-full hover:opacity-90 transition-all">
                Retour à la boutique
            </a>
            <a href="{{ route('Accueil') }}"
               class="inline-flex items-center justify-center gap-2 px-8 py-3 border border-gray-200 text-gray-600 font-semibold rounded-full hover:border-bracongo hover:text-bracongo transition-all">
                Accueil
            </a>
        </div>

    </div>
</div>
@endsection
