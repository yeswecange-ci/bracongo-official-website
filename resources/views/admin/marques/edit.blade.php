@extends('admin.layouts.app')
@section('title', 'Modifier — ' . $marque->nom)

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Modifier — {{ $marque->nom }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.marques.index') }}">Marques</a></li>
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
			<div class="card-header"><h4 class="card-title">Informations de la marque</h4></div>
			<div class="card-body">
				<form action="{{ route('admin.marques.update', $marque) }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					@include('admin.marques._form')
					<div class="d-flex gap-2 pt-3">
						<button type="submit" class="btn btn-primary">Enregistrer</button>
						<a href="{{ route('admin.marques.index') }}" class="btn btn-outline-secondary">Annuler</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
