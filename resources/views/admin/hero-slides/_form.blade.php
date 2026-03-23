<div class="row g-3">
	<div class="col-12">
		<label class="form-label fw-semibold">Chemin de l'image <span class="text-danger">*</span> <small class="text-muted">(ex: img/coverhome.jpg)</small></label>
		<input type="text" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image', $heroSlide->image ?? '') }}">
		@error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	@if(isset($heroSlide) && $heroSlide->image)
	<div class="col-12">
		<img src="{{ asset($heroSlide->image) }}" alt="Aperçu" style="max-height:120px;border-radius:8px;object-fit:cover;width:100%;">
	</div>
	@endif
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
