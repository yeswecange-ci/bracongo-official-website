<div class="row g-3">
	<div class="col-12">
		<label class="form-label fw-semibold">Titre du poste <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre', $offres_emploi->titre ?? '') }}">
		@error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Slug URL <small class="text-muted">(optionnel)</small></label>
		<input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $offres_emploi->slug ?? '') }}" placeholder="Généré automatiquement si vide">
		@error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Lieu</label>
		<input type="text" class="form-control @error('lieu') is-invalid @enderror" name="lieu" value="{{ old('lieu', $offres_emploi->lieu ?? '') }}" placeholder="ex. Kinshasa">
		@error('lieu')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Type de contrat</label>
		<input type="text" class="form-control @error('type_contrat') is-invalid @enderror" name="type_contrat" value="{{ old('type_contrat', $offres_emploi->type_contrat ?? '') }}" placeholder="ex. CDI, CDD">
		@error('type_contrat')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Date limite de candidature</label>
		<input type="date" class="form-control @error('date_limite_candidature') is-invalid @enderror" name="date_limite_candidature" value="{{ old('date_limite_candidature', $offres_emploi->date_limite_candidature?->format('Y-m-d')) }}">
		@error('date_limite_candidature')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Description courte (index) <small class="text-muted">(HTML autorisé — &lt;p&gt;&lt;strong&gt;)</small> <span class="text-danger">*</span></label>
		<textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="8" style="font-family:monospace;font-size:.82rem;">{{ old('description', $offres_emploi->description ?? '') }}</textarea>
		@error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
		<div class="form-text">Ce texte est affiché dans la carte de l’offre sur la page Carrière (liste).</div>
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Descriptif du poste (détail / show) <small class="text-muted">(HTML autorisé — &lt;h3&gt;&lt;ul&gt;&lt;li&gt;)</small></label>
		<textarea class="form-control @error('descriptif_poste') is-invalid @enderror" name="descriptif_poste" rows="14" style="font-family:monospace;font-size:.82rem;">{{ old('descriptif_poste', $offres_emploi->descriptif_poste ?? '') }}</textarea>
		@error('descriptif_poste')<div class="invalid-feedback">{{ $message }}</div>@enderror
		<div class="form-text">Si vide, la page détail réutilise la description courte.</div>
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">Lien externe <small class="text-muted">(LinkedIn, Educarrier, etc. — optionnel)</small></label>
		<input type="url" class="form-control @error('lien') is-invalid @enderror" name="lien"
			value="{{ old('lien', isset($offres_emploi) && filled($offres_emploi->lien) && $offres_emploi->lien !== '#' ? $offres_emploi->lien : '') }}"
			placeholder="https://…">
		@error('lien')<div class="invalid-feedback">{{ $message }}</div>@enderror
		<div class="form-text">Si renseigné, un bouton « Voir Plus » s’affiche sous la description sur la page publique de l’offre.</div>
	</div>
</div>
