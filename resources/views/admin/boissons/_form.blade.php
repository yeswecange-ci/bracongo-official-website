<div class="row g-3">
	{{-- Marque & Identification --}}
	<div class="col-md-6">
		<label class="form-label fw-semibold">Marque <span class="text-danger">*</span></label>
		<select class="form-select @error('marque_id') is-invalid @enderror" name="marque_id">
			<option value="">— Choisir une marque —</option>
			@foreach($marques as $m)
			<option value="{{ $m->id }}" {{ old('marque_id', $boisson->marque_id ?? '') == $m->id ? 'selected' : '' }}>
				{{ $m->nom }}
			</option>
			@endforeach
		</select>
		@error('marque_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Catégorie produit <span class="text-danger">*</span></label>
		<select class="form-select @error('categorie') is-invalid @enderror" name="categorie">
			@foreach(\App\Models\Marque::categories() as $key => $label)
			<option value="{{ $key }}" {{ old('categorie', $boisson->categorie ?? 'bieres') === $key ? 'selected' : '' }}>{{ $label }}</option>
			@endforeach
		</select>
		@error('categorie')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $boisson->nom ?? '') }}">
		@error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Slug <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $boisson->slug ?? '') }}">
		@error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Slogan</label>
		<input type="text" class="form-control" name="slogan" value="{{ old('slogan', $boisson->slogan ?? '') }}">
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Description</label>
		<textarea class="form-control" name="description" rows="4">{{ old('description', $boisson->description ?? '') }}</textarea>
	</div>

	{{-- Images --}}
	<div class="col-12"><hr class="my-1"><p class="fw-semibold text-muted mb-1 small text-uppercase">Images</p></div>
	<div class="col-md-4">
		<x-admin.image-upload name="hero_image" label="Image bannière hero" :value="isset($boisson) ? $boisson->hero_image : null" help="PNG, JPG, GIF — max 2 Mo" />
	</div>
	<div class="col-md-4">
		<x-admin.image-upload name="image" label="Image produit/bouteille" :value="isset($boisson) ? $boisson->image : null" help="PNG, JPG, GIF — max 2 Mo" />
	</div>
	<div class="col-md-4">
		<x-admin.image-upload name="logo" label="Logo" :value="isset($boisson) ? $boisson->logo : null" help="PNG, JPG, GIF — max 2 Mo" />
	</div>

	{{-- Fiche technique --}}
	<div class="col-12"><hr class="my-1"><p class="fw-semibold text-muted mb-1 small text-uppercase">Fiche technique</p></div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Année de lancement</label>
		<input type="number" class="form-control" name="annee_lancement" value="{{ old('annee_lancement', $boisson->annee_lancement ?? '') }}" placeholder="2013">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Type</label>
		<input type="text" class="form-control" name="type" value="{{ old('type', $boisson->type ?? '') }}" placeholder="Bière blonde">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Taux d'alcool</label>
		<input type="text" class="form-control" name="taux_alcool" value="{{ old('taux_alcool', $boisson->taux_alcool ?? '') }}" placeholder="5%">
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Ingrédients</label>
		<input type="text" class="form-control" name="ingredients" value="{{ old('ingredients', $boisson->ingredients ?? '') }}" placeholder="Eau, malt, maïs, houblon.">
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Conditionnement</label>
		<input type="text" class="form-control" name="conditionnement" value="{{ old('conditionnement', $boisson->conditionnement ?? '') }}" placeholder="33 cl et 50 cl">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">DDM <small class="text-muted">(Durabilité Minimale)</small></label>
		<input type="text" class="form-control" name="ddm" value="{{ old('ddm', $boisson->ddm ?? '') }}" placeholder="12 mois">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Type de bouteille</label>
		<input type="text" class="form-control" name="type_bouteille" value="{{ old('type_bouteille', $boisson->type_bouteille ?? '') }}">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Positionnement</label>
		<input type="text" class="form-control" name="positionnement" value="{{ old('positionnement', $boisson->positionnement ?? '') }}" placeholder="Premium">
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Cœur de cible</label>
		<input type="text" class="form-control" name="coeur_cible" value="{{ old('coeur_cible', $boisson->coeur_cible ?? '') }}" placeholder="25-35 ans...">
	</div>

	{{-- Vidéos --}}
	<div class="col-12">
		<label class="form-label fw-semibold">URLs vidéos YouTube <small class="text-muted">(une URL embed par ligne)</small></label>
		<textarea class="form-control" name="video_urls" rows="3" style="font-family:monospace;font-size:.82rem;" placeholder="https://www.youtube.com/embed/xxxxx">{{ old('video_urls', isset($boisson) && $boisson->video_urls ? implode("\n", $boisson->video_urls) : '') }}</textarea>
	</div>

	{{-- Ordre et statut --}}
	<div class="col-md-4">
		<label class="form-label fw-semibold">Ordre</label>
		<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $boisson->ordre ?? 0) }}" min="0">
	</div>
	<div class="col-md-4 d-flex align-items-end">
		<div class="form-check form-switch mb-2">
			<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
				{{ old('is_active', $boisson->is_active ?? true) ? 'checked' : '' }}>
			<label class="form-check-label fw-semibold" for="is_active">Boisson active</label>
		</div>
	</div>
</div>
