@extends('admin.layouts.app')
@section('title', "Modifier l'Offre")

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Modifier — {{ Str::limit($offreEmploi->titre, 40) }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.offres-emploi.index') }}">Offres</a></li>
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
	<div class="col-xl-8">
		@include('admin.layouts.partials.alerts')
		<div class="card">
			<div class="card-header"><h4 class="card-title">Informations de l'offre</h4></div>
			<div class="card-body">
				<form action="{{ route('admin.offres-emploi.update', $offreEmploi) }}" method="POST">
					@csrf
					@method('PUT')
					@include('admin.offres-emploi._form')
					<div class="d-flex gap-2 pt-3">
						<button type="submit" class="btn btn-primary">Enregistrer</button>
						<a href="{{ route('admin.offres-emploi.index') }}" class="btn btn-outline-secondary">Annuler</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
