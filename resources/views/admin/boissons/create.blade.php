@extends('admin.layouts.app')
@section('title', 'Nouvelle boisson')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Nouvelle boisson</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.boissons.index') }}">Boissons</a></li>
		<li class="breadcrumb-item active">Nouvelle</li>
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
	<div class="col-xl-9">
		@include('admin.layouts.partials.alerts')
		<div class="card">
			<div class="card-header"><h4 class="card-title">Informations de la boisson</h4></div>
			<div class="card-body">
				<form action="{{ route('admin.boissons.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					@include('admin.boissons._form')
					<div class="d-flex gap-2 pt-3">
						<button type="submit" class="btn btn-primary">Enregistrer</button>
						<a href="{{ route('admin.boissons.index') }}" class="btn btn-outline-secondary">Annuler</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
