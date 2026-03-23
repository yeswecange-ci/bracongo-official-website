@extends('admin.layouts.app')
@section('title', "Page d'Accueil")

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Page d'Accueil</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Accueil</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="{{ route('Accueil') }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">Voir la page</a>
<a href="{{ route('admin.hero-slides.index') }}" class="btn btn-sm btn-primary">
	<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="m9 8 6 4-6 4V8z"/></svg>
	Gérer les slides
</a>
@endpush

@section('header')
@include('admin.layouts.partials.header')
@endsection
@section('sidebar')
@include('admin.layouts.partials.sidebar')
@endsection

@section('content')
@include('admin.layouts.partials.alerts')

<form action="{{ route('admin.pages.accueil.update') }}" method="POST">
	@csrf
	@method('PUT')
	<div class="row g-4">
		{{-- Section Actualités --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">1</span>
					<h4 class="card-title mb-0">Section "Dernières Actualités"</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-6">
						<label class="form-label fw-semibold">Titre de la section</label>
						<input type="text" class="form-control" name="actualites_titre" value="{{ old('actualites_titre', $page->actualites_titre) }}">
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Lien "Voir plus"</label>
						<input type="text" class="form-control" name="actualites_voir_plus_lien" value="{{ old('actualites_voir_plus_lien', $page->actualites_voir_plus_lien) }}">
					</div>
				</div>
			</div>
		</div>

		{{-- Section Qui sommes-nous --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">2</span>
					<h4 class="card-title mb-0">Section "Qui sommes-nous ?"</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-12">
						<label class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
						<input type="text" class="form-control @error('qui_titre') is-invalid @enderror" name="qui_titre" value="{{ old('qui_titre', $page->qui_titre) }}">
						@error('qui_titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Texte / description</label>
						<textarea class="form-control" name="qui_texte" rows="4">{{ old('qui_texte', $page->qui_texte) }}</textarea>
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Image de fond <small class="text-muted">(ex: img/brasserie.jpg)</small></label>
						<input type="text" class="form-control" name="qui_image_fond" value="{{ old('qui_image_fond', $page->qui_image_fond) }}">
					</div>
					<div class="col-md-3">
						<label class="form-label fw-semibold">Texte CTA</label>
						<input type="text" class="form-control" name="qui_cta_texte" value="{{ old('qui_cta_texte', $page->qui_cta_texte) }}">
					</div>
					<div class="col-md-3">
						<label class="form-label fw-semibold">Lien CTA</label>
						<input type="text" class="form-control" name="qui_cta_lien" value="{{ old('qui_cta_lien', $page->qui_cta_lien) }}">
					</div>
				</div>
			</div>
		</div>

		{{-- Section Nos marques --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">3</span>
					<h4 class="card-title mb-0">Section "Nos Marques"</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-4">
						<label class="form-label fw-semibold">Titre</label>
						<input type="text" class="form-control" name="marques_titre" value="{{ old('marques_titre', $page->marques_titre) }}">
					</div>
					<div class="col-md-8">
						<label class="form-label fw-semibold">Description</label>
						<textarea class="form-control" name="marques_description" rows="2">{{ old('marques_description', $page->marques_description) }}</textarea>
					</div>
				</div>
			</div>
		</div>

		{{-- Section Rejoignez-nous --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">4</span>
					<h4 class="card-title mb-0">Section "Rejoignez nous"</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-4">
						<label class="form-label fw-semibold">Titre</label>
						<input type="text" class="form-control" name="rejoignez_titre" value="{{ old('rejoignez_titre', $page->rejoignez_titre) }}">
					</div>
					<div class="col-md-4">
						<label class="form-label fw-semibold">Image <small class="text-muted">(ex: img/rejoignez.png)</small></label>
						<input type="text" class="form-control" name="rejoignez_image" value="{{ old('rejoignez_image', $page->rejoignez_image) }}">
					</div>
					<div class="col-md-2">
						<label class="form-label fw-semibold">Texte CTA</label>
						<input type="text" class="form-control" name="rejoignez_cta_texte" value="{{ old('rejoignez_cta_texte', $page->rejoignez_cta_texte) }}">
					</div>
					<div class="col-md-2">
						<label class="form-label fw-semibold">Lien CTA</label>
						<input type="text" class="form-control" name="rejoignez_cta_lien" value="{{ old('rejoignez_cta_lien', $page->rejoignez_cta_lien) }}">
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Texte</label>
						<textarea class="form-control" name="rejoignez_texte" rows="3">{{ old('rejoignez_texte', $page->rejoignez_texte) }}</textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 pb-4">
			<button type="submit" class="btn btn-primary btn-lg px-5">
				<svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
				Enregistrer toutes les sections
			</button>
		</div>
	</div>
</form>
@endsection
