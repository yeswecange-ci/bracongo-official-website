@extends('admin.layouts.app')
@section('title', 'Modifier item navigation')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.navigation.index') }}">Navigation</a></li>
		<li class="breadcrumb-item active">Modifier</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Modifier — {{ $navigation->label }}</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ action([\App\Http\Controllers\Admin\NavigationItemController::class, 'update'], ['navigation' => $navigation->id]) }}" method="POST">
	@csrf
	@method('PUT')

	<div class="row g-4 align-items-start">

		{{-- Colonne principale --}}
		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Informations</h5></div>
				<div class="card-body">
					@include('admin.navigation._form')
				</div>
			</div>
		</div>

		{{-- Sidebar paramètres --}}
		<div class="col-xl-4 a-form-sidebar">
			<div class="card">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Item parent <span class="text-muted small">(laisser vide si item principal)</span></label>
						<select class="form-control" name="parent_id">
							<option value="">— Aucun (item principal) —</option>
							@foreach($parents as $parent)
							<option value="{{ $parent->id }}" {{ old('parent_id', $navigation->parent_id) == $parent->id ? 'selected' : '' }}>
								{{ $parent->label }}
							</option>
							@endforeach
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $navigation->ordre) }}" min="0">
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', $navigation->is_active) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Actif</label>
					</div>
				</div>
			</div>
		</div>

	</div>

	{{-- Sticky save bar --}}
	<div class="a-save-bar">
		<a href="{{ route('admin.navigation.index') }}" class="btn btn-outline-secondary">
			<i class="bi bi-x me-1"></i>Annuler
		</a>
		<button type="submit" class="btn btn-primary">
			<i class="bi bi-check2 me-1"></i>Enregistrer
		</button>
	</div>

</form>
@endsection
