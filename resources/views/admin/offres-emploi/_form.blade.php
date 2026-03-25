<div class="row g-3">
	<div class="col-12">
		<label class="form-label fw-semibold">Titre du poste <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre', $offres_emploi->titre ?? '') }}">
		@error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Description <small class="text-muted">(HTML autorisé — &lt;p&gt;&lt;strong&gt;)</small> <span class="text-danger">*</span></label>
		<textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="8" style="font-family:monospace;font-size:.82rem;">{{ old('description', $offres_emploi->description ?? '') }}</textarea>
		@error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>
