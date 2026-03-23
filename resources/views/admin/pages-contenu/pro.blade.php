@extends('admin.layouts.app')
@section('title', 'Bracongo Pro')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Bracongo Pro</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Bracongo Pro</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="{{ route('pro') }}" target="_blank" class="btn btn-sm btn-outline-primary">Voir la page</a>
@endpush

@section('header')
@include('admin.layouts.partials.header')
@endsection
@section('sidebar')
@include('admin.layouts.partials.sidebar')
@endsection

@section('content')
@include('admin.layouts.partials.alerts')

<form action="{{ route('admin.pages.pro.update') }}" method="POST">
	@csrf
	@method('PUT')
	<div class="row g-4">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">1</span>
					<h4 class="card-title mb-0">Bannière & Description</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-6">
						<label class="form-label fw-semibold">Image hero <small class="text-muted">(ex: img/brcpro.png)</small></label>
						<input type="text" class="form-control" name="hero_image" value="{{ old('hero_image', $page->hero_image) }}">
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Image mockup app <small class="text-muted">(ex: img/tel.png)</small></label>
						<input type="text" class="form-control" name="app_image" value="{{ old('app_image', $page->app_image) }}">
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Description principale</label>
						<textarea class="form-control" name="description" rows="3">{{ old('description', $page->description) }}</textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">2</span>
					<h4 class="card-title mb-0">Section "Pourquoi choisir Bracongo Pro ?"</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-4">
						<label class="form-label fw-semibold">Titre</label>
						<input type="text" class="form-control" name="pourquoi_titre" value="{{ old('pourquoi_titre', $page->pourquoi_titre) }}">
					</div>
					<div class="col-md-8">
						<label class="form-label fw-semibold">Introduction</label>
						<input type="text" class="form-control" name="pourquoi_intro" value="{{ old('pourquoi_intro', $page->pourquoi_intro) }}">
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Liste des raisons <small class="text-muted">(HTML autorisé — liste &lt;ul&gt;&lt;li&gt;)</small></label>
						<textarea class="form-control" name="pourquoi_items" rows="8" style="font-family:monospace;font-size:.8rem;">{{ old('pourquoi_items', $page->pourquoi_items) }}</textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">3</span>
					<h4 class="card-title mb-0">Section "Fonctionnalités clés"</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-12">
						<label class="form-label fw-semibold">Titre</label>
						<input type="text" class="form-control" name="fonctionnalites_titre" value="{{ old('fonctionnalites_titre', $page->fonctionnalites_titre) }}">
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Liste <small class="text-muted">(HTML autorisé)</small></label>
						<textarea class="form-control" name="fonctionnalites_items" rows="8" style="font-family:monospace;font-size:.8rem;">{{ old('fonctionnalites_items', $page->fonctionnalites_items) }}</textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">4</span>
					<h4 class="card-title mb-0">CTA Téléchargement</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-4">
						<label class="form-label fw-semibold">Texte du bouton</label>
						<input type="text" class="form-control" name="cta_texte" value="{{ old('cta_texte', $page->cta_texte) }}">
					</div>
					<div class="col-md-4">
						<label class="form-label fw-semibold">Lien de téléchargement</label>
						<input type="text" class="form-control" name="cta_lien" value="{{ old('cta_lien', $page->cta_lien) }}">
					</div>
					<div class="col-md-4">
						<label class="form-label fw-semibold">Lien PDF de présentation</label>
						<input type="text" class="form-control" name="pdf_lien" value="{{ old('pdf_lien', $page->pdf_lien) }}">
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 pb-4">
			<button type="submit" class="btn btn-primary btn-lg px-5">
				<svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
				Enregistrer
			</button>
		</div>
	</div>
</form>
@endsection
