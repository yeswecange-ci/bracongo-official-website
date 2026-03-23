<div class="row g-3">
	<div class="col-12">
		<label class="form-label fw-semibold">Chemin de l'image <span class="text-danger">*</span> <small class="text-muted">(ex: img/beau.png)</small></label>
		<input type="text" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image', $footerGallery->image ?? '') }}">
		@error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
		@if(isset($footerGallery) && $footerGallery->image)
		<img src="{{ asset($footerGallery->image) }}" style="margin-top:8px;height:60px;border-radius:6px;" alt="">
		@endif
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
