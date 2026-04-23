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
	<div class="col-12">
		<label class="form-label fw-semibold">Description</label>
		<textarea class="form-control" name="description" rows="4">{{ old('description', $marque->description ?? '') }}</textarea>
	</div>

	<div class="col-12">
		<hr class="my-2">
		<h6 class="fw-600 text-muted mb-3" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em">Vidéos</h6>
		<div class="form-text mb-2">Maximum 3 liens YouTube.</div>
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Vidéos YouTube</label>
		<textarea class="form-control @error('video_urls') is-invalid @enderror" name="video_urls" rows="5" style="font-family:monospace;font-size:.82rem;" placeholder="URL d’embed, lien watch, ou collage du code &lt;iframe&gt; YouTube (une entrée par ligne)">{{ old('video_urls', isset($marque) && $marque->video_urls ? implode("\n", $marque->video_urls) : '') }}</textarea>
		@error('video_urls')<div class="invalid-feedback">{{ $message }}</div>@enderror
		<div class="form-text">Tu peux coller : une URL YouTube (<code>watch?v=…</code>, <code>youtu.be/…</code>, <code>/embed/…</code>) ou directement le code <code>&lt;iframe&gt;</code> fourni par YouTube. Tout est normalisé automatiquement.</div>
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
