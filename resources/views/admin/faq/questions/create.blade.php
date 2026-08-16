@extends('admin.layouts.app')
@section('title', 'Nouvelle question FAQ')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.faq.index') }}">FAQ</a></li>
		<li class="breadcrumb-item active">Nouvelle question</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Nouvelle question</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.faq.questions.store') }}" method="POST">
	@csrf

	<div class="row g-4 align-items-start">

		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Question &amp; réponse</h5></div>
				<div class="card-body">
					@include('admin.faq.questions._form')
				</div>
			</div>
		</div>

		<div class="col-xl-4 a-form-sidebar">
			<div class="card">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre dans la rubrique</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', 0) }}" min="0">
						<div class="form-text">0 s'affiche en premier.</div>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', true) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Question visible sur le site</label>
					</div>
				</div>
			</div>

			@include('admin.layouts.partials.form-actions', ['cancelUrl' => route('admin.faq.index')])
		</div>

	</div>
</form>
@endsection
