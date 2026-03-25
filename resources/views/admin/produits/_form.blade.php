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

	<div class="col-12">
		<hr class="my-2">
		<h6 class="fw-600 text-muted mb-3" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em">Informations commerciales</h6>
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Prix <small class="text-muted">(CDF)</small></label>
		<input type="number" step="0.01" class="form-control" name="prix" value="{{ old('prix', $produit->prix ?? '') }}" min="0">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Stock</label>
		<input type="number" class="form-control" name="stock" value="{{ old('stock', $produit->stock ?? 0) }}" min="0">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Référence</label>
		<input type="text" class="form-control" name="reference" value="{{ old('reference', $produit->reference ?? '') }}">
	</div>
</div>
