<div class="row g-3">
	<div class="col-12">
		<x-admin.image-upload name="image" label="Image" :value="isset($heroSlide) ? $heroSlide->image : null" :required="true" help="PNG, JPG, GIF — max 2 Mo" />
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Texte alternatif (alt)</label>
		<input type="text" class="form-control" name="alt" value="{{ old('alt', $heroSlide->alt ?? '') }}">
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Ordre d'affichage</label>
		<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $heroSlide->ordre ?? 0) }}" min="0">
	</div>
	<div class="col-md-6 d-flex align-items-end">
		<div class="form-check form-switch mb-2">
			<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
				{{ old('is_active', $heroSlide->is_active ?? true) ? 'checked' : '' }}>
			<label class="form-check-label fw-semibold" for="is_active">Slide actif</label>
		</div>
	</div>
</div>
