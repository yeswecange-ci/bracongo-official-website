@extends('admin.layouts.app')
@section('title', 'Nouveau Slide')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.hero-slides.index') }}">Hero Slides</a></li>
		<li class="breadcrumb-item active">Nouveau</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Nouveau Slide</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	<div class="row g-4 align-items-start">

		{{-- Colonne principale --}}
		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Image du slide</h5></div>
				<div class="card-body">
					@include('admin.hero-slides._form')
				</div>
			</div>
		</div>

		{{-- Sidebar paramètres --}}
		<div class="col-xl-4 a-form-sidebar">
			<div class="card">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Texte alternatif (alt)</label>
						<input type="text" class="form-control" name="alt" value="{{ old('alt', '') }}">
					</div>
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre d'affichage</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', 0) }}" min="0">
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', true) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Slide actif</label>
					</div>
				</div>
			</div>
		</div>

	</div>

	{{-- Sticky save bar --}}
	<div class="a-save-bar">
		<a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline-secondary">
			<i class="bi bi-x me-1"></i>Annuler
		</a>
		<button type="submit" class="btn btn-primary">
			<i class="bi bi-check2 me-1"></i>Enregistrer
		</button>
	</div>

</form>
@endsection
