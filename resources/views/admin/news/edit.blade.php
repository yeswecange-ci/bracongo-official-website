@extends('admin.layouts.app')
@section('title', 'Modifier — ' . Str::limit($news->titre, 40))

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">News</a></li>
		<li class="breadcrumb-item active">Modifier</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Modifier — {{ Str::limit($news->titre, 40) }}</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')
<form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="row g-4 align-items-start">

		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5>Informations de la news</h5></div>
				<div class="card-body">
					@include('admin.news._form')
				</div>
			</div>
		</div>

		<div class="col-xl-4 a-form-sidebar">

			<div class="card">
				<div class="card-header"><h5>Image</h5></div>
				<div class="card-body">
					<x-admin.image-upload name="image" label="Image" :value="$news->image" help="PNG, JPG, GIF — max 2 Mo" />
				</div>
			</div>

			<div class="card mt-4">
				<div class="card-header"><h5>Paramètres</h5></div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Ordre</label>
						<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $news->ordre) }}" min="0">
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
							{{ old('is_active', $news->is_active) ? 'checked' : '' }}>
						<label class="form-check-label fw-semibold" for="is_active">Publiée</label>
					</div>
				</div>
			</div>

			@include('admin.layouts.partials.form-actions', ['cancelUrl' => route('admin.news.index')])

		</div>

	</div>

</form>
@endsection
