@extends('admin.layouts.app')
@section('title', 'Modifier image galerie')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Modifier image galerie</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.footer-gallery.index') }}">Galerie</a></li>
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
			<div class="card-body">
				<form action="{{ route('admin.footer-gallery.update', $footerGallery) }}" method="POST">
					@csrf
					@method('PUT')
					@include('admin.footer-gallery._form')
					<div class="d-flex gap-2 pt-3">
						<button type="submit" class="btn btn-primary">Enregistrer</button>
						<a href="{{ route('admin.footer-gallery.index') }}" class="btn btn-outline-secondary">Annuler</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
