@extends('admin.layouts.app')
@section('title', 'Nouveau Slide')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Nouveau Slide</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.hero-slides.index') }}">Hero Slides</a></li>
		<li class="breadcrumb-item active">Nouveau</li>
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
	<div class="col-xl-7">
		@include('admin.layouts.partials.alerts')
		<div class="card">
			<div class="card-header"><h4 class="card-title">Informations du slide</h4></div>
			<div class="card-body">
				<form action="{{ route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					@include('admin.hero-slides._form')
					<div class="d-flex gap-2 pt-3">
						<button type="submit" class="btn btn-primary">Enregistrer</button>
						<a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline-secondary">Annuler</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
