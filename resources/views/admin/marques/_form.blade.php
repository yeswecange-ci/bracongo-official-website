<div class="row g-3">
	<div class="col-md-8">
		<label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $marque->nom ?? '') }}">
		@error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Slug <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $marque->slug ?? '') }}" placeholder="beaufort-lager">
		@error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Catégorie <span class="text-danger">*</span></label>
		<select class="form-select @error('categorie') is-invalid @enderror" name="categorie">
			@foreach($categories as $key => $label)
			<option value="{{ $key }}" {{ old('categorie', $marque->categorie ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
			@endforeach
		</select>
		@error('categorie')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Lien <x-admin.readonly-info /> <small class="text-muted">(ex: /Nos-marques-bieres)</small></label>
		<input type="text" class="form-control bg-light" name="lien" value="{{ old('lien', $marque->lien ?? '') }}" readonly>
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Description</label>
		<textarea class="form-control" name="description" rows="3">{{ old('description', $marque->description ?? '') }}</textarea>
	</div>
	<div class="col-md-6">
		<x-admin.image-upload name="image" label="Image produit" :value="isset($marque) ? $marque->image : null" help="PNG, JPG, GIF — max 2 Mo" />
	</div>
	<div class="col-md-6">
		<x-admin.image-upload name="image_banner" label="Image bannière" :value="isset($marque) ? $marque->image_banner : null" help="PNG, JPG, GIF — max 2 Mo" />
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Ordre</label>
		<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $marque->ordre ?? 0) }}" min="0">
	</div>
	<div class="col-md-4 d-flex align-items-end">
		<div class="form-check form-switch mb-2">
			<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
				{{ old('is_active', $marque->is_active ?? true) ? 'checked' : '' }}>
			<label class="form-check-label fw-semibold" for="is_active">Marque active</label>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
	var nomInput = document.querySelector('[name="nom"]');
	var slugInput = document.querySelector('[name="slug"]');
	if (nomInput && slugInput && !slugInput.value) {
		nomInput.addEventListener('input', function () {
			slugInput.value = nomInput.value.toLowerCase()
				.normalize('NFD').replace(/[\u0300-\u036f]/g,'')
				.replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
		});
	}
});
</script>
