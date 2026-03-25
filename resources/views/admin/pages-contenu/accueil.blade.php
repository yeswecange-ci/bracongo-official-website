@extends('admin.layouts.app')
@section('title', "Page d'Accueil")

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Accueil</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Page d'Accueil</h6>
</div>
@endpush
@push('header-actions')
<a href="{{ route('Accueil') }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">
    <i class="bi bi-box-arrow-up-right me-1"></i>Voir la page
</a>
<a href="{{ route('admin.hero-slides.index') }}" class="btn btn-sm btn-primary">
    <i class="bi bi-collection-play me-1"></i>Gérer les slides
</a>
@endpush


@section('content')
@include('admin.layouts.partials.alerts')

<form action="{{ route('admin.pages.accueil.update') }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="row g-4">
		{{-- Section Actualités --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="a-step-badge">1</span>
					<h5 class="mb-0">Section "Dernières Actualités"</h5>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-6">
						<label class="form-label fw-semibold">Titre de la section</label>
						<input type="text" class="form-control" name="actualites_titre" value="{{ old('actualites_titre', $page->actualites_titre) }}">
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Lien "Voir plus" <x-admin.readonly-info /></label>
						<input type="text" class="form-control bg-light" name="actualites_voir_plus_lien" value="{{ old('actualites_voir_plus_lien', $page->actualites_voir_plus_lien) }}" readonly>
					</div>
				</div>
			</div>
		</div>

		{{-- Section Qui sommes-nous --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="a-step-badge">2</span>
					<h5 class="mb-0">Section "Qui sommes-nous ?"</h5>
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
						<x-admin.image-upload name="qui_image_fond" label="Image de fond" :value="$page->qui_image_fond ?? null" help="PNG, JPG, GIF — max 2 Mo" />
					</div>
					<div class="col-md-3">
						<label class="form-label fw-semibold">Texte CTA</label>
						<input type="text" class="form-control" name="qui_cta_texte" value="{{ old('qui_cta_texte', $page->qui_cta_texte) }}">
					</div>
					<div class="col-md-3">
						<label class="form-label fw-semibold">Lien CTA <x-admin.readonly-info /></label>
						<input type="text" class="form-control bg-light" name="qui_cta_lien" value="{{ old('qui_cta_lien', $page->qui_cta_lien) }}" readonly>
					</div>
				</div>
			</div>
		</div>

		{{-- Section Nos marques --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="a-step-badge">3</span>
					<h5 class="mb-0">Section "Nos Marques"</h5>
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
					<div class="col-md-4">
						<label class="form-label fw-semibold">Texte bouton sur les cartes par catégorie</label>
						<input type="text" class="form-control" name="marques_cartes_cta_texte" value="{{ old('marques_cartes_cta_texte', $page->marques_cartes_cta_texte ?? 'Voir plus') }}" maxlength="100">
					</div>
				</div>
			</div>
		</div>

		{{-- Section Rejoignez-nous --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="a-step-badge">4</span>
					<h5 class="mb-0">Section "Rejoignez nous"</h5>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-4">
						<label class="form-label fw-semibold">Titre</label>
						<input type="text" class="form-control" name="rejoignez_titre" value="{{ old('rejoignez_titre', $page->rejoignez_titre) }}">
					</div>
					<div class="col-md-4">
						<x-admin.image-upload name="rejoignez_image" label="Image" :value="$page->rejoignez_image ?? null" help="PNG, JPG, GIF — max 2 Mo" />
					</div>
					<div class="col-md-2">
						<label class="form-label fw-semibold">Texte CTA</label>
						<input type="text" class="form-control" name="rejoignez_cta_texte" value="{{ old('rejoignez_cta_texte', $page->rejoignez_cta_texte) }}">
					</div>
					<div class="col-md-2">
						<label class="form-label fw-semibold">Lien CTA <x-admin.readonly-info /></label>
						<input type="text" class="form-control bg-light" name="rejoignez_cta_lien" value="{{ old('rejoignez_cta_lien', $page->rejoignez_cta_lien) }}" readonly>
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Texte</label>
						<textarea class="form-control" name="rejoignez_texte" rows="3">{{ old('rejoignez_texte', $page->rejoignez_texte) }}</textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 pb-4">
			<button type="submit" class="btn btn-primary">
				<i class="bi bi-floppy me-1"></i>Enregistrer toutes les sections
			</button>
		</div>
	</div>
</form>
@endsection
