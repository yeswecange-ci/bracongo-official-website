@extends('admin.layouts.app')
@section('title', 'Nouvelle Valeur')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.valeurs.index') }}">Valeurs</a></li>
		<li class="breadcrumb-item active">Nouvelle</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Nouvelle Valeur</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.valeurs.store') }}" method="POST">
	@csrf

	<div class="row g-4 align-items-start">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-header"><h5>Informations de la valeur</h5></div>
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-3">
							<label class="form-label fw-semibold">Lettre <span class="text-danger">*</span></label>
							<input type="text" class="form-control text-center fw-bold fs-4 @error('lettre') is-invalid @enderror" name="lettre" maxlength="1" value="{{ old('lettre') }}" style="border-color:#E30613;">
							@error('lettre')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-md-9">
							<label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">
							@error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-md-4">
							<label class="form-label fw-semibold">Ordre d'affichage</label>
							<input type="number" class="form-control" name="ordre" value="{{ old('ordre', 0) }}" min="0">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Sticky save bar --}}
	<div class="a-save-bar">
		<a href="{{ route('admin.valeurs.index') }}" class="btn btn-outline-secondary">
			<i class="bi bi-x me-1"></i>Annuler
		</a>
		<button type="submit" class="btn btn-primary">
			<i class="bi bi-check2 me-1"></i>Enregistrer
		</button>
	</div>

</form>
@endsection
