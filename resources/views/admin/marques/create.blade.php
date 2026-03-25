@extends('admin.layouts.app')
@section('title', 'Nouvelle marque')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.marques.index') }}">Marques</a></li>
		<li class="breadcrumb-item active">Nouvelle</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Nouvelle marque</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.marques.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	<div class="row g-4 align-items-start">

		{{-- Colonne principale --}}
		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Informations de la marque</h5></div>
				<div class="card-body">
					@include('admin.marques._form')
				</div>
			</div>
		</div>

		{{-- Sidebar métadonnées --}}
		<div class="col-xl-4 a-form-sidebar">

			{{-- Card Images --}}
			<div class="card">
				<div class="card-header"><h5>Images</h5></div>
				<div class="card-body">
					<x-admin.image-upload name="image" label="Image produit" :value="null" help="PNG, JPG, GIF — max 2 Mo" />
					<hr class="my-3">
					<x-admin.image-upload name="image_banner" label="Image bannière" :value="null" help="PNG, JPG, GIF — max 2 Mo" />
				</div>
			</div>

			{{-- Card Paramètres --}}
			<div class="card mt-4">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Catégorie <span class="text-danger">*</span></label>
						<select class="form-select @error('categorie') is-invalid @enderror" name="categorie">
							@foreach($categories as $key => $label)
							<option value="{{ $key }}" {{ old('categorie', '') === $key ? 'selected' : '' }}>{{ $label }}</option>
							@endforeach
						</select>
						@error('categorie')<div class="invalid-feedback">{{ $message }}</div>@enderror
					</div>
					<div class="mb-3">
						<label class="form-label fw-semibold">Lien <x-admin.readonly-info /> <small class="text-muted">(ex: /Nos-marques-bieres)</small></label>
						<div class="a-readonly-wrap">
							<i class="bi bi-lock a-lock-icon"></i>
							<input type="text" class="form-control" name="lien" value="{{ old('lien', '') }}" readonly>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', 0) }}" min="0">
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', true) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Marque active</label>
					</div>
				</div>
			</div>

		</div>

	</div>

	{{-- Sticky save bar --}}
	<div class="a-save-bar">
		<a href="{{ route('admin.marques.index') }}" class="btn btn-outline-secondary">
			<i class="bi bi-x me-1"></i>Annuler
		</a>
		<button type="submit" class="btn btn-primary">
			<i class="bi bi-check2 me-1"></i>Enregistrer
		</button>
	</div>

</form>
@endsection
