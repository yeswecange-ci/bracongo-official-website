@extends('admin.layouts.app')
@section('title', "Modifier l'Offre")

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.offres-emploi.index') }}">Offres</a></li>
		<li class="breadcrumb-item active">Modifier</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Modifier — {{ Str::limit($offres_emploi->titre, 40) }}</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.offres-emploi.update', ['offres_emploi' => $offres_emploi]) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="row g-4 align-items-start">

		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Informations de l'offre</h5></div>
				<div class="card-body">
					@include('admin.offres-emploi._form')
				</div>
			</div>
		</div>

		<div class="col-xl-4 a-form-sidebar">

			<div class="card">
				<div class="card-header"><h5>Image</h5></div>
				<div class="card-body">
					<x-admin.image-upload name="image" label="Image" :value="$offres_emploi->image" help="PNG, JPG, GIF — max 2 Mo" />
				</div>
			</div>

			<div class="card mt-4">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $offres_emploi->ordre) }}" min="0">
					</div>
					<div class="form-check form-switch mb-3">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', $offres_emploi->is_active) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Offre active</label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="require_lettre_motivation" id="require_lettre_motivation" value="1"
							{{ old('require_lettre_motivation', $offres_emploi->require_lettre_motivation) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="require_lettre_motivation">Lettre de motivation obligatoire</label>
						<div class="form-text small">Champ obligatoire sur la page candidature publique.</div>
					</div>
				</div>
			</div>

			@include('admin.layouts.partials.form-actions', ['cancelUrl' => route('admin.offres-emploi.index')])

		</div>

	</div>

</form>
@endsection
