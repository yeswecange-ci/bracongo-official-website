@extends('admin.layouts.app')
@section('title', 'Modifier la rubrique')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.faq.index') }}">FAQ</a></li>
		<li class="breadcrumb-item active">{{ $section->titre }}</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Modifier la rubrique</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.faq.sections.update', $section) }}" method="POST">
	@csrf @method('PUT')

	<div class="row g-4 align-items-start">

		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Informations de la rubrique</h5></div>
				<div class="card-body">
					@include('admin.faq.sections._form')
				</div>
			</div>
		</div>

		<div class="col-xl-4 a-form-sidebar">
			<div class="card">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre d'affichage</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $section->ordre) }}" min="0">
						<div class="form-text">0 s'affiche en premier.</div>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', $section->is_active) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Rubrique visible sur le site</label>
					</div>
				</div>
			</div>

			@include('admin.layouts.partials.form-actions', ['cancelUrl' => route('admin.faq.index')])
		</div>

	</div>
</form>
@endsection
