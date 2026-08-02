@extends('admin.layouts.app')
@section('title', 'Nouvelle catégorie')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Catégories</a></li>
		<li class="breadcrumb-item active">Nouvelle</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Nouvelle catégorie</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

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
					<x-admin.image-upload name="hero_image" label="Bannière de la page" :value="null" help="PNG, JPG, GIF, WebP — max 10 Mo" />
				</div>
			</div>

			<div class="card mt-4">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre d'affichage</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', 0) }}" min="0">
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', true) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Catégorie active</label>
					</div>
				</div>
			</div>

			@include('admin.layouts.partials.form-actions', ['cancelUrl' => route('admin.categories.index')])

		</div>

	</div>

</form>
@endsection
