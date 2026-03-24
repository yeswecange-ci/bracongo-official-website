<div class="row g-3">
	<div class="col-12">
		<x-admin.image-upload name="image" label="Image" :value="isset($footerGallery) ? $footerGallery->image : null" :required="true" help="PNG, JPG, GIF — max 2 Mo" />
	</div>
	<div class="col-md-8">
		<label class="form-label fw-semibold">Texte alt</label>
		<input type="text" class="form-control" name="alt" value="{{ old('alt', $footerGallery->alt ?? '') }}">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Ordre</label>
		<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $footerGallery->ordre ?? 0) }}" min="0">
	</div>
</div>
