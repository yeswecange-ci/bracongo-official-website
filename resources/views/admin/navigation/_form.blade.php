<div class="row g-3">
	<div class="col-12">
		<label class="form-label fw-semibold">Label (texte affiché) <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('label') is-invalid @enderror" name="label" value="{{ old('label', $navigationItem->label ?? '') }}">
		@error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">URL <x-admin.readonly-info /></label>
		<div class="a-readonly-wrap">
			<i class="bi bi-lock a-lock-icon"></i>
			<input type="text" class="form-control" name="url" value="{{ old('url', $navigationItem->url ?? '#') }}" placeholder="/histoire, /Contact, #..." readonly>
		</div>
	</div>
</div>
