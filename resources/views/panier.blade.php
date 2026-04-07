@extends('layout.app')

@section('title', 'Mon panier')

@section('content')
<div class="min-h-[70vh] bg-gray-50 py-16">
    <div class="max-w-5xl mx-auto px-4">

        {{-- En-tête --}}
        <div class="flex items-center gap-3 mb-10">
            <img src="{{ asset('img/Group.png') }}" alt="" class="h-8 w-auto" loading="lazy" decoding="async" aria-hidden="true">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Mon panier</h1>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 text-sm font-semibold rounded-2xl px-5 py-3">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-bracongo text-sm font-semibold rounded-2xl px-5 py-3">
            {{ session('error') }}
        </div>
        @endif

        @if(empty($panier))
        {{-- Panier vide --}}
        <div class="text-center py-24">
            <div class="w-20 h-20 rounded-full bg-white border border-gray-100 flex items-center justify-center mx-auto mb-6 shadow-sm">
                <svg class="w-9 h-9 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-700 mb-2">Votre panier est vide</h2>
            <p class="text-gray-400 text-sm mb-8">Ajoutez des produits depuis notre boutique.</p>
            <a href="{{ route('boutique') }}"
               class="inline-flex items-center gap-2 px-8 py-3 bg-bracongo text-white rounded-full font-bold hover:opacity-90 transition-all">
                Découvrir la boutique
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        @else

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Liste des articles --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach($panier as $ligne)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center gap-5">

                    {{-- Image --}}
                    <div class="w-20 h-20 flex-shrink-0 rounded-xl overflow-hidden bg-gray-50 border border-gray-100">
                        @if($ligne['image'])
                            <img src="{{ asset($ligne['image']) }}" alt="{{ $ligne['nom'] }}"
                                 class="w-full h-full object-contain p-2" loading="lazy" decoding="async">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-200">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Infos --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-900 text-sm truncate">{{ $ligne['nom'] }}</p>
                        @if($ligne['reference'])
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest">Réf. {{ $ligne['reference'] }}</p>
                        @endif
                        <p class="text-bracongo font-bold mt-1">
                            {{ $ligne['prix'] > 0 ? number_format($ligne['prix'], 0, ',', ' ') . ' CDF' : 'Prix sur demande' }}
                        </p>
                    </div>

                    {{-- Quantité --}}
                    <form action="{{ route('panier.update', $ligne['id']) }}" method="POST" class="flex items-center gap-2">
                        @csrf @method('PATCH')
                        <input type="number" name="quantite" value="{{ $ligne['quantite'] }}" min="1" max="99"
                               class="w-14 text-center border border-gray-200 rounded-full text-sm py-1.5 focus:outline-none focus:border-bracongo">
                        <button type="submit" class="text-xs text-gray-500 hover:text-bracongo font-semibold transition-colors">
                            Màj
                        </button>
                    </form>

                    {{-- Sous-total --}}
                    <div class="text-right flex-shrink-0 min-w-[80px]">
                        <p class="font-bold text-gray-900 text-sm">
                            {{ $ligne['prix'] > 0 ? number_format($ligne['prix'] * $ligne['quantite'], 0, ',', ' ') . ' CDF' : '—' }}
                        </p>
                    </div>

                    {{-- Supprimer --}}
                    <form action="{{ route('panier.supprimer', $ligne['id']) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-gray-300 hover:text-bracongo transition-colors p-1" title="Retirer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach

                {{-- Vider le panier --}}
                <div class="flex justify-end pt-2">
                    <form action="{{ route('panier.vider') }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-gray-400 hover:text-bracongo font-semibold transition-colors underline">
                            Vider le panier
                        </button>
                    </form>
                </div>
            </div>

            {{-- Récapitulatif --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-24">
                    <h2 class="font-bold text-gray-900 text-lg mb-5">Récapitulatif</h2>

                    <div class="space-y-3 text-sm border-b border-gray-100 pb-4 mb-4">
                        @foreach($panier as $ligne)
                        <div class="flex justify-between items-start gap-2">
                            <span class="text-gray-600 truncate max-w-[150px]">{{ $ligne['nom'] }} × {{ $ligne['quantite'] }}</span>
                            <span class="font-semibold text-gray-900 flex-shrink-0">
                                {{ $ligne['prix'] > 0 ? number_format($ligne['prix'] * $ligne['quantite'], 0, ',', ' ') : '—' }}
                            </span>
                        </div>
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <span class="font-bold text-gray-900">Total</span>
                        <span class="font-bold text-bracongo text-xl">
                            {{ $total > 0 ? number_format($total, 0, ',', ' ') . ' CDF' : '—' }}
                        </span>
                    </div>

                    <a href="{{ route('commande.checkout') }}"
                       class="block w-full text-center px-6 py-3 bg-bracongo text-white font-bold rounded-full hover:opacity-90 transition-all">
                        Passer la commande →
                    </a>
                    <a href="{{ route('boutique') }}"
                       class="block w-full text-center px-6 py-3 mt-3 border border-gray-200 text-gray-600 font-semibold rounded-full hover:border-bracongo hover:text-bracongo transition-all text-sm">
                        Continuer mes achats
                    </a>
                </div>
            </div>

        </div>
        @endif

    </div>
</div>
@endsection
