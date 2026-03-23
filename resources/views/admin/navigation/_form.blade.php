<div class="row g-3">
	<div class="col-12">
		<label class="form-label fw-semibold">Label (texte affiché) <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('label') is-invalid @enderror" name="label" value="{{ old('label', $navigationItem->label ?? '') }}">
		@error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">URL</label>
		<input type="text" class="form-control" name="url" value="{{ old('url', $navigationItem->url ?? '#') }}" placeholder="/histoire, /Contact, #...">
	</div>
	<div class="col-md-6">
		<label class="form-label fw-semibold">Item parent <span class="text-muted small">(laisser vide si item principal)</span></label>
		<select class="form-control" name="parent_id">
			<option value="">— Aucun (item principal) —</option>
			@foreach($parents as $parent)
			<option value="{{ $parent->id }}" {{ old('parent_id', $navigationItem->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
				{{ $parent->label }}
			</option>
			@endforeach
		</select>
	</div>
	<div class="col-md-3">
		<label class="form-label fw-semibold">Ordre</label>
		<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $navigationItem->ordre ?? 0) }}" min="0">
	</div>
	<div class="col-md-3 d-flex align-items-end">
		<div class="form-check form-switch mb-2">
			<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
				{{ old('is_active', $navigationItem->is_active ?? true) ? 'checked' : '' }}>
			<label class="form-check-label fw-semibold" for="is_active">Actif</label>
		</div>
	</div>
</div>
