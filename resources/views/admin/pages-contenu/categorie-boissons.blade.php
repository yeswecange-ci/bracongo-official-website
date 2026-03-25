@extends('admin.layouts.app')
@section('title', $label)

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">{{ $label }}</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">{{ $label }}</h6>
</div>
@endpush
@push('header-actions')
<a href="{{ route('marque.categorie', $categorie) }}" target="_blank" class="btn btn-sm btn-outline-primary">
    <i class="bi bi-box-arrow-up-right me-1"></i>Voir la page
</a>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<form action="{{ route('admin.pages.categorie-boissons.update', $categorie) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="row g-4">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="a-step-badge">1</span>
					<h5 class="mb-0">Bannière & fil d’Ariane</h5>
				</div>
				<div class="card-body row g-3">
					<div class="col-12 col-md-6">
						<label class="form-label fw-semibold">Titre principal (H1)</label>
						<input type="text" class="form-control" name="hero_titre" value="{{ old('hero_titre', $page->hero_titre) }}" placeholder="À remplir par l’équipe communication">
					</div>
					<div class="col-12 col-md-6">
						<label class="form-label fw-semibold">Titre de l’onglet (SEO)</label>
						<input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" placeholder="Laisser vide : « Nos Marques – {fil d’Ariane} »">
						<small class="text-muted">Si vide, le titre sera « Nos Marques – » suivi du libellé ci-dessous.</small>
					</div>
					<div class="col-12 col-md-6">
						<label class="form-label fw-semibold">Dernier segment du fil d’Ariane</label>
						<input type="text" class="form-control" name="breadcrumb_libelle" value="{{ old('breadcrumb_libelle', $page->breadcrumb_libelle) }}">
					</div>
					<div class="col-md-6">
						<x-admin.image-upload name="hero_image" label="Image bannière" :value="$page->hero_image ?? null" help="PNG, JPG, GIF, WebP — max 2 Mo" />
					</div>
					<div class="col-12 col-md-6">
						<label class="form-label fw-semibold">Texte alternatif de l’image</label>
						<input type="text" class="form-control" name="hero_image_alt" value="{{ old('hero_image_alt', $page->hero_image_alt) }}">
					</div>
				</div>
			</div>
		</div>

		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="a-step-badge">2</span>
					<h5 class="mb-0">Recherche & messages</h5>
				</div>
				<div class="card-body row g-3">
					<div class="col-12 col-md-6">
						<label class="form-label fw-semibold">Placeholder du champ de recherche</label>
						<input type="text" class="form-control" name="search_placeholder" value="{{ old('search_placeholder', $page->search_placeholder) }}">
					</div>
					<div class="col-12 col-md-6">
						<label class="form-label fw-semibold">Message si aucun produit dans cette catégorie</label>
						<input type="text" class="form-control" name="message_liste_vide" value="{{ old('message_liste_vide', $page->message_liste_vide) }}">
					</div>
					<div class="col-12 col-md-6">
						<label class="form-label fw-semibold">Message si la recherche ne donne rien</label>
						<input type="text" class="form-control" name="message_recherche_vide" value="{{ old('message_recherche_vide', $page->message_recherche_vide) }}">
					</div>
				</div>
			</div>
		</div>

		<div class="col-12">
			<button type="submit" class="btn btn-primary">
				<i class="bi bi-check-lg me-1"></i>Enregistrer
			</button>
		</div>
	</div>
</form>
@endsection
