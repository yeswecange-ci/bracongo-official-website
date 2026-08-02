@extends('admin.layouts.app')
@section('title', 'Modifier — ' . $categorie->nom)

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Catégories</a></li>
		<li class="breadcrumb-item active">Modifier</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Modifier — {{ $categorie->nom }}</h6>
</div>
@endpush
@push('header-actions')
<a href="{{ $categorie->estBieres() ? route('bieres') : route('marque.categorie', $categorie->slug) }}" target="_blank" class="btn btn-sm btn-outline-primary">
	<i class="bi bi-box-arrow-up-right me-1"></i>Voir la page
</a>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.categories.update', $categorie) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="row g-4 align-items-start">

		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Informations de la catégorie</h5></div>
				<div class="card-body">
					@include('admin.categories._form')
				</div>
			</div>
		</div>

		<div class="col-xl-4 a-form-sidebar">

			<div class="card">
				<div class="card-header"><h5>Image bannière</h5></div>
				<div class="card-body">
					<x-admin.image-upload name="hero_image" label="Bannière de la page" :value="$categorie->hero_image" help="PNG, JPG, GIF, WebP — max 10 Mo" />
				</div>
			</div>

			<div class="card mt-4">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre d'affichage</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $categorie->ordre) }}" min="0">
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', $categorie->is_active) ? 'checked' : '' }}
							{{ $categorie->estBieres() ? 'disabled' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Catégorie active</label>
					</div>
					@if($categorie->estBieres())
					<div class="form-text">La catégorie « Bières » reste toujours active.</div>
					@endif
				</div>
			</div>

			@include('admin.layouts.partials.form-actions', ['cancelUrl' => route('admin.categories.index')])

		</div>

	</div>

</form>
@endsection
