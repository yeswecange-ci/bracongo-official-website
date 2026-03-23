<div class="row g-3">
	<div class="col-12">
		<label class="form-label fw-semibold">Titre du poste <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre', $offreEmploi->titre ?? '') }}">
		@error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Description <small class="text-muted">(HTML autorisé — &lt;p&gt;&lt;strong&gt;)</small> <span class="text-danger">*</span></label>
		<textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="6" style="font-family:monospace;font-size:.82rem;">{{ old('description', $offreEmploi->description ?? '') }}</textarea>
		@error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Image <small class="text-muted">(ex: img/secu.jpg)</small></label>
		<input type="text" class="form-control" name="image" value="{{ old('image', $offreEmploi->image ?? '') }}">
		@if(isset($offreEmploi) && $offreEmploi->image)
		<img src="{{ asset($offreEmploi->image) }}" style="margin-top:8px;height:60px;border-radius:6px;object-fit:cover;" alt="">
		@endif
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Lien "Plus de détails"</label>
		<input type="text" class="form-control" name="lien" value="{{ old('lien', $offreEmploi->lien ?? '#') }}">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Ordre</label>
		<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $offreEmploi->ordre ?? 0) }}" min="0">
	</div>
	<div class="col-md-4 d-flex align-items-end">
		<div class="form-check form-switch mb-2">
			<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
				{{ old('is_active', $offreEmploi->is_active ?? true) ? 'checked' : '' }}>
			<label class="form-check-label fw-semibold" for="is_active">Offre active</label>
		</div>
	</div>
</div>
