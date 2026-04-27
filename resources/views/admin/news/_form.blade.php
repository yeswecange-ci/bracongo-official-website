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
	<div class="col-md-6">
		<label class="form-label fw-semibold">Lien WhatsApp <small class="text-muted">(page détail, optionnel)</small></label>
		<input type="url" class="form-control @error('whatsapp_url') is-invalid @enderror" name="whatsapp_url" value="{{ old('whatsapp_url', isset($news) ? ($news->whatsapp_url ?? '') : '') }}" placeholder="https://wa.me/... ou https://api.whatsapp.com/...">
		@error('whatsapp_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Texte du bouton WhatsApp <small class="text-muted">(optionnel)</small></label>
		<input type="text" class="form-control @error('whatsapp_label') is-invalid @enderror" name="whatsapp_label" value="{{ old('whatsapp_label', isset($news) ? ($news->whatsapp_label ?? '') : '') }}" placeholder="Vivez l’événement avec nous sur WhatsApp" maxlength="200">
		@error('whatsapp_label')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-12">
		<div class="form-text">Si un lien WhatsApp est renseigné, le bouton s’affiche sous le texte de l’article avec ce libellé (ou le texte par défaut si le champ est vide).</div>
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Extrait <small class="text-muted">(résumé court visible sur la liste)</small></label>
		<textarea class="form-control" name="extrait" rows="2">{{ old('extrait', $news->extrait ?? '') }}</textarea>
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Contenu complet <x-admin.html-info /> <small class="text-muted">(HTML autorisé)</small></label>
		<textarea class="form-control" name="contenu" rows="8" style="font-family:monospace;font-size:.82rem;">{{ old('contenu', $news->contenu ?? '') }}</textarea>
	</div>

	<div class="col-12">
		<hr class="my-2">
		<h6 class="fw-600 text-muted mb-3" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em">Dates &amp; Localisation</h6>
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Date de publication</label>
		<input type="date" class="form-control @error('date_publication') is-invalid @enderror" name="date_publication" value="{{ old('date_publication', isset($news) && $news->date_publication ? $news->date_publication->format('Y-m-d') : '') }}">
		@error('date_publication')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6" id="date-evenement-field">
		<label class="form-label fw-semibold">Date de l'événement <small class="text-muted">(si événement)</small></label>
		<input type="date" class="form-control" name="date_evenement" value="{{ old('date_evenement', isset($news) && $news->date_evenement ? $news->date_evenement->format('Y-m-d') : '') }}">
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Lieu <small class="text-muted">(si événement)</small></label>
		<input type="text" class="form-control" name="lieu" value="{{ old('lieu', $news->lieu ?? '') }}" placeholder="Kinshasa, RDC">
	</div>

	<div class="col-12">
		<hr class="my-2">
		<h6 class="fw-600 text-muted mb-3" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em">Galerie &amp; vidéos (page détail)</h6>
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Images de galerie <small class="text-muted">(max 30, affichage 6 sur le site)</small></label>
		<input type="file" class="form-control @error('gallery_images') is-invalid @enderror @error('gallery_images.*') is-invalid @enderror" name="gallery_images[]" multiple accept=".jpg,.jpeg,.png,.gif,.webp">
		@error('gallery_images')<div class="invalid-feedback">{{ $message }}</div>@enderror
		@error('gallery_images.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
		<div class="form-text">Tu peux sélectionner plusieurs fichiers en une fois.</div>
	</div>

	@if(isset($news) && !empty($news->gallery_images))
	<div class="col-12">
		<label class="form-label fw-semibold">Images existantes</label>
		<div class="row g-2">
			@foreach($news->gallery_images as $img)
			<div class="col-6 col-md-4 col-lg-3">
				<div class="border rounded p-2 h-100">
					<img src="{{ asset($img) }}" alt="" class="img-fluid rounded mb-2" style="height:90px;width:100%;object-fit:cover;">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="remove_gallery_images[]" value="{{ $img }}" id="remove_{{ $loop->index }}">
						<label class="form-check-label small" for="remove_{{ $loop->index }}">Retirer</label>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	@endif

	<div class="col-12">
		<label class="form-label fw-semibold">Vidéos YouTube</label>
		<textarea class="form-control @error('youtube_urls') is-invalid @enderror" name="youtube_urls" rows="5" style="font-family:monospace;font-size:.82rem;" placeholder="URL d’embed, lien watch, ou collage du code &lt;iframe&gt; YouTube (une entrée par ligne)">{{ old('youtube_urls', isset($news) && !empty($news->youtube_urls) ? implode("\n", $news->youtube_urls) : '') }}</textarea>
		@error('youtube_urls')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
	var titreInput = document.querySelector('[name="titre"]');
	var slugInput = document.querySelector('[name="slug"]');
	var typeSelect = document.querySelector('[name="type"]');
	var dateEvenementField = document.getElementById('date-evenement-field');
	var dateEvenementInput = document.querySelector('[name="date_evenement"]');
	if (titreInput && slugInput && !slugInput.value) {
		titreInput.addEventListener('input', function () {
			slugInput.value = titreInput.value.toLowerCase()
				.normalize('NFD').replace(/[\u0300-\u036f]/g,'')
				.replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
		});
	}

	function toggleDateEvenementField() {
		if (!typeSelect || !dateEvenementField || !dateEvenementInput) {
			return;
		}
		var isEvenement = typeSelect.value === 'evenements';
		dateEvenementField.style.display = isEvenement ? '' : 'none';
		if (!isEvenement) {
			dateEvenementInput.value = '';
		}
	}

	if (typeSelect) {
		typeSelect.addEventListener('change', toggleDateEvenementField);
		toggleDateEvenementField();
	}
});
</script>
