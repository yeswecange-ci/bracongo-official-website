@extends('layout.app')

@section('title', $categories[$categorie] ?? $categorie)

@section('content')
@php
	$label = $categories[$categorie] ?? $categorie;
	$banner = $marqueGroupe->first()?->image_banner ?? $marqueGroupe->first()?->image ?? 'img/marque.jpg';
@endphp
<div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
	<img src="{{ asset($banner) }}" alt="{{ $label }}" class="w-full h-full object-cover">
	<div class="absolute inset-0 bg-black/50"></div>
	<div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4">
		<nav class="flex flex-wrap items-center justify-center gap-2 text-sm md:text-base font-medium mb-4">
			<a href="{{ route('Accueil') }}" class="hover:text-bracongo transition-colors">Accueil</a>
			<span class="text-bracongo font-bold text-lg">></span>
			<a href="{{ route('marque') }}" class="hover:text-bracongo transition-colors">Nos marques</a>
			<span class="text-bracongo font-bold text-lg">></span>
			<span class="opacity-90">{{ $label }}</span>
		</nav>
		<h1 class="text-4xl md:text-6xl font-bold tracking-tight text-center">{{ $label }}</h1>
	</div>
</div>

<section class="py-20 bg-white">
	<div class="container mx-auto px-4">
		@if($marqueGroupe->isEmpty())
		<p class="text-center text-gray-500 py-12">Aucune marque dans cette catégorie pour le moment.</p>
		@else
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-20 pt-12">
			@foreach($marqueGroupe as $marque)
			@php
				$lienVoirPlus = ($marque->lien && $marque->lien !== '#')
					? $marque->lien
					: ($marque->categorie === 'bieres' ? route('bieres') : route('marque.categorie', $marque->categorie));
			@endphp
			<div class="relative bg-black rounded-[2rem] group h-[400px] flex flex-col items-center justify-end pb-10">
				<div class="absolute top-10 left-0 right-0 flex justify-center opacity-30 pointer-events-none">
					<img src="{{ asset('img/Group2.png') }}" alt="" class="w-4/5 h-auto object-contain">
				</div>
				<div class="absolute -top-16 left-0 right-0 flex justify-center z-10 pointer-events-none">
					<img src="{{ asset($marque->image ?? 'img/marron.png') }}" alt="{{ $marque->nom }}"
						class="h-72 w-auto object-contain transform group-hover:scale-110 transition-transform duration-500">
				</div>
				<div class="relative z-20 text-center px-4">
					<h3 class="text-white text-xl font-bold mb-6">{{ $marque->nom }}</h3>
					<a href="{{ $lienVoirPlus }}" class="inline-flex items-center gap-2 px-8 py-2 border border-white rounded-full text-white text-xs font-bold hover:bg-white hover:text-black transition-all">
						Voir plus
						<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
						</svg>
					</a>
				</div>
			</div>
			@endforeach
		</div>
		@endif
	</div>
</section>
@endsection
