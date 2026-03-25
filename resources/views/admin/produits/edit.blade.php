@extends('admin.layouts.app')
@section('title', 'Modifier — ' . $produit->nom)

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.produits.index') }}">Produits</a></li>
		<li class="breadcrumb-item active">Modifier</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Modifier — {{ $produit->nom }}</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.produits.update', $produit) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="row g-4 align-items-start">

		{{-- Colonne principale --}}
		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Informations du produit</h5></div>
				<div class="card-body">
					@include('admin.produits._form')
				</div>
			</div>
		</div>

		{{-- Sidebar métadonnées --}}
		<div class="col-xl-4 a-form-sidebar">

			{{-- Card Image --}}
			<div class="card">
				<div class="card-header"><h5>Image</h5></div>
				<div class="card-body">
					<x-admin.image-upload name="image" label="Image" :value="$produit->image" help="PNG, JPG, GIF — max 2 Mo" />
				</div>
			</div>

			{{-- Card Paramètres --}}
			<div class="card mt-4">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $produit->ordre) }}" min="0">
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', $produit->is_active) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Produit actif</label>
					</div>
				</div>
			</div>

		</div>

	</div>

	{{-- Sticky save bar --}}
	<div class="a-save-bar">
		<a href="{{ route('admin.produits.index') }}" class="btn btn-outline-secondary">
			<i class="bi bi-x me-1"></i>Annuler
		</a>
		<button type="submit" class="btn btn-primary">
			<i class="bi bi-check2 me-1"></i>Enregistrer
		</button>
	</div>

</form>
@endsection
