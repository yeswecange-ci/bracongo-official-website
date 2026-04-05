@extends('admin.layouts.app')
@section('title', 'Bracongo Pro')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Bracongo Pro</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Bracongo Pro</h6>
</div>
@endpush
@push('header-actions')
<a href="{{ route('pro') }}" target="_blank" class="btn btn-sm btn-outline-primary">
    <i class="bi bi-box-arrow-up-right me-1"></i>Voir la page
</a>
@endpush


@section('content')
@include('admin.layouts.partials.alerts')

<form action="{{ route('admin.pages.pro.update') }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="row g-4">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="a-step-badge">1</span>
					<h5 class="mb-0">Bannière & Description</h5>
				</div>
				<div class="card-body row g-3">
					<div class="col-12 col-md-6">
						<label class="form-label fw-semibold">Titre sur la bannière</label>
						<input type="text" class="form-control" name="hero_titre" value="{{ old('hero_titre', $page->hero_titre ?? 'Bracongo Pro') }}">
					</div>
					<div class="col-md-6">
						<x-admin.image-upload name="hero_image" label="Image hero" :value="$page->hero_image ?? null" help="PNG, JPG, GIF — max 2 Mo" />
					</div>
					<div class="col-md-6">
						<x-admin.image-upload name="app_image" label="Image mockup app" :value="$page->app_image ?? null" help="PNG, JPG, GIF — max 2 Mo" />
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
					<span class="a-step-badge">2</span>
					<h5 class="mb-0">Section "Pourquoi choisir Bracongo Pro ?"</h5>
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
					<span class="a-step-badge">3</span>
					<h5 class="mb-0">Section "Fonctionnalités clés"</h5>
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
					<span class="a-step-badge">4</span>
					<h5 class="mb-0">CTA Téléchargement</h5>
				</div>
				<div class="card-body row g-3">
					<div class="{{ auth()->user()->isAdministration() ? 'col-md-6' : 'col-12' }}">
						<label class="form-label fw-semibold">Texte du bouton</label>
						<input type="text" class="form-control" name="cta_texte" value="{{ old('cta_texte', $page->cta_texte) }}">
					</div>
					@if(auth()->user()->isAdministration())
					<div class="col-md-6">
						<label class="form-label fw-semibold">Lien de téléchargement</label>
						<input type="text" class="form-control" name="cta_lien" value="{{ old('cta_lien', $page->cta_lien) }}" placeholder="https://… ou schéma d’app (ex. bracongopro://)">
						<div class="form-text">Store, site ou deeplink vers l’application.</div>
					</div>
					@endif
				</div>
			</div>
		</div>

		<div class="col-12 pb-4">
			<button type="submit" class="btn btn-primary">
			<i class="bi bi-floppy me-1"></i>Enregistrer
		</button>
		</div>
	</div>
</form>
@endsection
