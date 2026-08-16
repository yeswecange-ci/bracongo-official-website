@php $sectionCourante = old('faq_section_id', $question->faq_section_id ?? ($sectionSelectionnee ?? null)); @endphp

<div class="row g-3">
	<div class="col-12">
		<label class="form-label fw-semibold">Rubrique <span class="text-danger">*</span></label>
		<select class="form-select @error('faq_section_id') is-invalid @enderror" name="faq_section_id">
			@foreach($sections as $s)
			<option value="{{ $s->id }}" {{ (int) $sectionCourante === $s->id ? 'selected' : '' }}>{{ $s->titre }}</option>
			@endforeach
		</select>
		@error('faq_section_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>

	<div class="col-12">
		<label class="form-label fw-semibold">Question <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('question') is-invalid @enderror" name="question"
			value="{{ old('question', $question->question ?? '') }}" placeholder="Ex. : Comment devenir revendeur Bracongo ?">
		@error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>

	<div class="col-12">
		<label class="form-label fw-semibold">Réponse <span class="text-danger">*</span></label>
		<textarea class="form-control @error('reponse') is-invalid @enderror" name="reponse" rows="7"
			placeholder="Rédigez la réponse en texte simple.">{{ old('reponse', $question->reponse ?? '') }}</textarea>
		@error('reponse')<div class="invalid-feedback">{{ $message }}</div>@enderror
		<div class="form-text">
			Texte simple (le code HTML n'est pas interprété). Vous pouvez insérer <code>{telephone}</code> :
			il sera automatiquement remplacé par le numéro de téléphone défini dans les paramètres du site.
		</div>
	</div>
</div>
