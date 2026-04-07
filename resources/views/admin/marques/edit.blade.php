@extends('admin.layouts.app')
@section('title', 'Modifier — ' . $marque->nom)

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.marques.index') }}">Marques</a></li>
		<li class="breadcrumb-item active">Modifier</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Modifier — {{ $marque->nom }}</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.marques.update', $marque) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="row g-4 align-items-start">

		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Informations de la marque</h5></div>
				<div class="card-body">
					@include('admin.marques._form')
				</div>
			</div>
		</div>

		<div class="col-xl-4 a-form-sidebar">

			<div class="card">
				<div class="card-header"><h5>Images</h5></div>
				<div class="card-body">
					<x-admin.image-upload name="image" label="Image produit" :value="$marque->image" help="PNG, JPG, GIF — max 10 Mo" />
					<p class="small text-muted mb-0 mt-2">La bannière des pages par catégorie (bières, eaux, etc.) se gère dans <strong>Catalogue → Page Nos bières / Page Eaux / …</strong>.</p>
				</div>
			</div>

			<div class="card mt-4">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<p class="small text-muted mb-3">La <strong>catégorie</strong> (bière, gazeuse, eau, énergisante) se règle sur chaque <a href="{{ route('admin.boissons.index') }}">fiche boisson</a>, pas sur la marque.</p>
					<div class="mb-3">
						<label class="form-label fw-semibold">Lien <x-admin.readonly-info /> <small class="text-muted">(ex: /Nos-marques-bieres)</small></label>
						<div class="a-readonly-wrap">
							<i class="bi bi-lock a-lock-icon"></i>
							<input type="text" class="form-control" name="lien" value="{{ old('lien', $marque->lien) }}" readonly>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $marque->ordre) }}" min="0">
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', $marque->is_active) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Marque active</label>
					</div>
				</div>
			</div>

			@include('admin.layouts.partials.form-actions', ['cancelUrl' => route('admin.marques.index')])

		</div>

	</div>

</form>
@endsection
