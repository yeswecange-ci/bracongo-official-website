<div class="row g-3">
	<div class="col-md-8">
		<label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $produit->nom ?? '') }}">
		@error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Slug <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $produit->slug ?? '') }}">
		@error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Description</label>
		<textarea class="form-control" name="description" rows="4">{{ old('description', $produit->description ?? '') }}</textarea>
	</div>
	<div class="col-md-6">
		<x-admin.image-upload name="image" label="Image" :value="isset($produit) ? $produit->image : null" help="PNG, JPG, GIF — max 2 Mo" />
	</div>
	<div class="col-md-3">
		<label class="form-label fw-semibold">Prix <small class="text-muted">(CDF)</small></label>
		<input type="number" step="0.01" class="form-control" name="prix" value="{{ old('prix', $produit->prix ?? '') }}" min="0">
	</div>
	<div class="col-md-3">
		<label class="form-label fw-semibold">Stock</label>
		<input type="number" class="form-control" name="stock" value="{{ old('stock', $produit->stock ?? 0) }}" min="0">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Référence</label>
		<input type="text" class="form-control" name="reference" value="{{ old('reference', $produit->reference ?? '') }}">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Ordre</label>
		<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $produit->ordre ?? 0) }}" min="0">
	</div>
	<div class="col-md-4 d-flex align-items-end">
		<div class="form-check form-switch mb-2">
			<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
				{{ old('is_active', $produit->is_active ?? true) ? 'checked' : '' }}>
			<label class="form-check-label fw-semibold" for="is_active">Produit actif</label>
		</div>
	</div>
</div>
