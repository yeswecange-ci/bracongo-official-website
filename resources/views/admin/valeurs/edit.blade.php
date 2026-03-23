@extends('admin.layouts.app')
@section('title', 'Modifier la Valeur')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Modifier — <span style="color:#E30613;">{{ $valeur->lettre }}</span> · {{ $valeur->description }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.valeurs.index') }}">Valeurs</a></li>
		<li class="breadcrumb-item active">Modifier</li>
	</ol>
</div>
@endpush

@section('header')
@include('admin.layouts.partials.header')
@endsection
@section('sidebar')
@include('admin.layouts.partials.sidebar')
@endsection

@section('content')
<div class="row justify-content-center">
	<div class="col-xl-6">
		@include('admin.layouts.partials.alerts')
		<div class="card">
			<div class="card-header"><h4 class="card-title">Informations de la valeur</h4></div>
			<div class="card-body">
				<form action="{{ route('admin.valeurs.update', $valeur) }}" method="POST">
					@csrf
					@method('PUT')
					<div class="row g-3">
						<div class="col-md-3">
							<label class="form-label fw-semibold">Lettre <span class="text-danger">*</span></label>
							<input type="text" class="form-control text-center fw-bold fs-4 @error('lettre') is-invalid @enderror" name="lettre" maxlength="1" value="{{ old('lettre', $valeur->lettre) }}" style="border-color:#E30613;">
							@error('lettre')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-md-9">
							<label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description', $valeur->description) }}">
							@error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-md-4">
							<label class="form-label fw-semibold">Ordre</label>
							<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $valeur->ordre) }}" min="0">
						</div>
					</div>
					<div class="d-flex gap-2 pt-4">
						<button type="submit" class="btn btn-primary">Enregistrer</button>
						<a href="{{ route('admin.valeurs.index') }}" class="btn btn-outline-secondary">Annuler</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
