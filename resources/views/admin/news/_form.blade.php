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
		<x-admin.image-upload name="image" label="Image" :value="isset($news) ? $news->image : null" help="PNG, JPG, GIF — max 2 Mo" />
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Extrait <small class="text-muted">(résumé court visible sur la liste)</small></label>
		<textarea class="form-control" name="extrait" rows="2">{{ old('extrait', $news->extrait ?? '') }}</textarea>
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Contenu complet <small class="text-muted">(HTML autorisé)</small></label>
		<textarea class="form-control" name="contenu" rows="8" style="font-family:monospace;font-size:.82rem;">{{ old('contenu', $news->contenu ?? '') }}</textarea>
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Lien externe <x-admin.readonly-info /> <small class="text-muted">(optionnel)</small></label>
		<input type="text" class="form-control bg-light" name="lien_externe" value="{{ old('lien_externe', $news->lien_externe ?? '') }}" readonly>
	</div>
	<div class="col-md-3">
		<label class="form-label fw-semibold">Date de publication</label>
		<input type="date" class="form-control" name="date_publication" value="{{ old('date_publication', isset($news) && $news->date_publication ? $news->date_publication->format('Y-m-d') : '') }}">
	</div>
	<div class="col-md-3">
		<label class="form-label fw-semibold">Date de l'événement <small class="text-muted">(si événement)</small></label>
		<input type="date" class="form-control" name="date_evenement" value="{{ old('date_evenement', isset($news) && $news->date_evenement ? $news->date_evenement->format('Y-m-d') : '') }}">
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Lieu <small class="text-muted">(si événement)</small></label>
		<input type="text" class="form-control" name="lieu" value="{{ old('lieu', $news->lieu ?? '') }}" placeholder="Kinshasa, RDC">
	</div>
	<div class="col-md-3">
		<label class="form-label fw-semibold">Ordre</label>
		<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $news->ordre ?? 0) }}" min="0">
	</div>
	<div class="col-md-3 d-flex align-items-end">
		<div class="form-check form-switch mb-2">
			<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
				{{ old('is_active', $news->is_active ?? true) ? 'checked' : '' }}>
			<label class="form-check-label fw-semibold" for="is_active">Publiée</label>
		</div>
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
