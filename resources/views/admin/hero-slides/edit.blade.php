@extends('admin.layouts.app')
@section('title', 'Modifier le Slide')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.hero-slides.index') }}">Hero Slides</a></li>
		<li class="breadcrumb-item active">Modifier</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Modifier le Slide</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.hero-slides.update', $heroSlide) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="row g-4 align-items-start">

		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Image du slide</h5></div>
				<div class="card-body">
					@include('admin.hero-slides._form')
				</div>
			</div>
		</div>

		<div class="col-xl-4 a-form-sidebar">
			<div class="card">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Texte alternatif (alt)</label>
						<input type="text" class="form-control" name="alt" value="{{ old('alt', $heroSlide->alt) }}">
					</div>
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre d'affichage</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $heroSlide->ordre) }}" min="0">
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', $heroSlide->is_active) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Slide actif</label>
					</div>
				</div>
			</div>

			@include('admin.layouts.partials.form-actions', ['cancelUrl' => route('admin.hero-slides.index')])

		</div>

	</div>

</form>
@endsection
