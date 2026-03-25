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
