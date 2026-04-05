@extends('admin.layouts.app')
@section('title', 'Nouveau réseau social')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.reseaux-sociaux.index') }}">Réseaux</a></li>
		<li class="breadcrumb-item active">Nouveau</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Nouveau réseau social</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.reseaux-sociaux.store') }}" method="POST">
	@csrf

	<div class="row g-4 align-items-start">

		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Informations</h5></div>
				<div class="card-body">
					@include('admin.reseaux-sociaux._form')
				</div>
			</div>
		</div>

		<div class="col-xl-4 a-form-sidebar">
			<div class="card">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', 0) }}" min="0">
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', true) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Actif</label>
					</div>
				</div>
			</div>

			@include('admin.layouts.partials.form-actions', ['cancelUrl' => route('admin.reseaux-sociaux.index')])

		</div>

	</div>

</form>
@endsection
