@extends('admin.layouts.app')
@section('title', 'Modifier image galerie')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.footer-gallery.index') }}">Galerie</a></li>
		<li class="breadcrumb-item active">Modifier</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Modifier image galerie</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.footer-gallery.update', $footerGallery) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="row g-4 align-items-start">

		{{-- Colonne principale --}}
		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Image</h5></div>
				<div class="card-body">
					@include('admin.footer-gallery._form')
				</div>
			</div>
		</div>

		{{-- Sidebar paramètres --}}
		<div class="col-xl-4 a-form-sidebar">
			<div class="card">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Texte alt</label>
						<input type="text" class="form-control" name="alt" value="{{ old('alt', $footerGallery->alt) }}">
					</div>
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $footerGallery->ordre) }}" min="0">
					</div>
				</div>
			</div>
		</div>

	</div>

	{{-- Sticky save bar --}}
	<div class="a-save-bar">
		<a href="{{ route('admin.footer-gallery.index') }}" class="btn btn-outline-secondary">
			<i class="bi bi-x me-1"></i>Annuler
		</a>
		<button type="submit" class="btn btn-primary">
			<i class="bi bi-check2 me-1"></i>Enregistrer
		</button>
	</div>

</form>
@endsection
