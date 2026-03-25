<div class="row g-3">
	<div class="col-md-8">
		<label class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre', $news->titre ?? '') }}">
		@error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
		<select class="form-select @error('type') is-invalid @enderror" name="type">
			@foreach($types as $key => $label)
			<option value="{{ $key }}" {{ old('type', $news->type ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
			@endforeach
		</select>
		@error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Slug <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $news->slug ?? '') }}">
		@error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Lien externe <x-admin.readonly-info /> <small class="text-muted">(optionnel)</small></label>
		<div class="a-readonly-wrap">
			<i class="bi bi-lock a-lock-icon"></i>
			<input type="text" class="form-control" name="lien_externe" value="{{ old('lien_externe', $news->lien_externe ?? '') }}" readonly>
		</div>
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Extrait <small class="text-muted">(résumé court visible sur la liste)</small></label>
		<textarea class="form-control" name="extrait" rows="2">{{ old('extrait', $news->extrait ?? '') }}</textarea>
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Contenu complet <small class="text-muted">(HTML autorisé)</small></label>
		<textarea class="form-control" name="contenu" rows="8" style="font-family:monospace;font-size:.82rem;">{{ old('contenu', $news->contenu ?? '') }}</textarea>
	</div>

	<div class="col-12">
		<hr class="my-2">
		<h6 class="fw-600 text-muted mb-3" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em">Dates &amp; Localisation</h6>
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Date de publication</label>
		<input type="date" class="form-control" name="date_publication" value="{{ old('date_publication', isset($news) && $news->date_publication ? $news->date_publication->format('Y-m-d') : '') }}">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Date de l'événement <small class="text-muted">(si événement)</small></label>
		<input type="date" class="form-control" name="date_evenement" value="{{ old('date_evenement', isset($news) && $news->date_evenement ? $news->date_evenement->format('Y-m-d') : '') }}">
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Lieu <small class="text-muted">(si événement)</small></label>
		<input type="text" class="form-control" name="lieu" value="{{ old('lieu', $news->lieu ?? '') }}" placeholder="Kinshasa, RDC">
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
	var titreInput = document.querySelector('[name="titre"]');
	var slugInput = document.querySelector('[name="slug"]');
	if (titreInput && slugInput && !slugInput.value) {
		titreInput.addEventListener('input', function () {
			slugInput.value = titreInput.value.toLowerCase()
				.normalize('NFD').replace(/[\u0300-\u036f]/g,'')
				.replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
		});
	}
});
</script>
