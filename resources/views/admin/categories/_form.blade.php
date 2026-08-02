@php
	$estBieres = isset($categorie) && $categorie->estBieres();
@endphp

<div class="row g-3">
	<div class="col-md-8">
		<label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $categorie->nom ?? '') }}" placeholder="Ex. : Eaux gazeuses">
		@error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Slug <span class="text-danger">*</span>@if($estBieres) <x-admin.readonly-info />@endif</label>
		@if($estBieres)
		<div class="a-readonly-wrap">
			<i class="bi bi-lock a-lock-icon"></i>
			<input type="text" class="form-control" name="slug" value="{{ $categorie->slug }}" readonly>
		</div>
		<div class="form-text">Le slug « bieres » est utilisé par la page dédiée du site.</div>
		@else
		<input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $categorie->slug ?? '') }}" placeholder="eaux-gazeuses">
		@error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
		<div class="form-text">Utilisé dans l'URL : /Nos-marques/<em>slug</em></div>
		@endif
	</div>

	<div class="col-12">
		<hr class="my-2">
		<h6 class="fw-600 text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em">Bannière & fil d'Ariane</h6>
		@if($estBieres)
		<div class="form-text">La page « Bières » du site utilise sa propre mise en page : sa bannière se gère dans <a href="{{ route('admin.pages.bieres.edit') }}">Page Nos bières</a>. Les champs ci-dessous ne sont pas utilisés pour cette catégorie.</div>
		@endif
	</div>
	<div class="col-12 col-md-6">
		<label class="form-label fw-semibold">Titre principal (H1)</label>
		<input type="text" class="form-control" name="hero_titre" value="{{ old('hero_titre', $categorie->hero_titre ?? '') }}" placeholder="Laisser vide pour ne pas afficher de titre">
	</div>
	<div class="col-12 col-md-6">
		<label class="form-label fw-semibold">Titre de l'onglet (SEO)</label>
		<input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $categorie->meta_title ?? '') }}" placeholder="Laisser vide : « Nos Marques – {fil d'Ariane} »">
	</div>
	<div class="col-12 col-md-6">
		<label class="form-label fw-semibold">Dernier segment du fil d'Ariane</label>
		<input type="text" class="form-control" name="breadcrumb_libelle" value="{{ old('breadcrumb_libelle', $categorie->breadcrumb_libelle ?? '') }}" placeholder="Laisser vide : reprend le nom de la catégorie">
	</div>
	<div class="col-12 col-md-6">
		<label class="form-label fw-semibold">Texte alternatif de l'image bannière</label>
		<input type="text" class="form-control" name="hero_image_alt" value="{{ old('hero_image_alt', $categorie->hero_image_alt ?? '') }}">
	</div>

	<div class="col-12">
		<hr class="my-2">
		<h6 class="fw-600 text-muted mb-3" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em">Recherche & messages</h6>
	</div>
	<div class="col-12 col-md-6">
		<label class="form-label fw-semibold">Placeholder du champ de recherche</label>
		<input type="text" class="form-control" name="search_placeholder" value="{{ old('search_placeholder', $categorie->search_placeholder ?? '') }}" placeholder="Taper le nom d'une boisson">
	</div>
	<div class="col-12 col-md-6">
		<label class="form-label fw-semibold">Message si aucun produit</label>
		<input type="text" class="form-control" name="message_liste_vide" value="{{ old('message_liste_vide', $categorie->message_liste_vide ?? '') }}" placeholder="Aucune boisson disponible pour le moment.">
	</div>
	<div class="col-12 col-md-6">
		<label class="form-label fw-semibold">Message si la recherche ne donne rien</label>
		<input type="text" class="form-control" name="message_recherche_vide" value="{{ old('message_recherche_vide', $categorie->message_recherche_vide ?? '') }}" placeholder="Aucune boisson ne correspond à votre recherche.">
	</div>
</div>

@unless($estBieres)
<script>
document.addEventListener('DOMContentLoaded', function () {
	var nomInput = document.querySelector('[name="nom"]');
	var slugInput = document.querySelector('[name="slug"]');
	if (nomInput && slugInput && !slugInput.value) {
		nomInput.addEventListener('input', function () {
			slugInput.value = nomInput.value.toLowerCase()
				.normalize('NFD').replace(/[̀-ͯ]/g,'')
				.replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
		});
	}
});
</script>
@endunless
