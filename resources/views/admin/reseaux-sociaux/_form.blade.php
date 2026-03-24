<div class="row g-3">
	<div class="col-md-5">
		<label class="form-label fw-semibold">Plateforme <span class="text-danger">*</span></label>
		<select class="form-control @error('platform') is-invalid @enderror" name="platform">
			@foreach(['facebook','instagram','twitter','youtube','linkedin','tiktok'] as $p)
			<option value="{{ $p }}" {{ old('platform', $reseauSocial->platform ?? '') === $p ? 'selected' : '' }}>
				{{ ucfirst($p) }}
			</option>
			@endforeach
		</select>
		@error('platform')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-7">
		<label class="form-label fw-semibold">URL <x-admin.readonly-info /> <span class="text-danger">*</span></label>
		<input type="text" class="form-control bg-light @error('url') is-invalid @enderror" name="url" value="{{ old('url', $reseauSocial->url ?? '') }}" placeholder="https://facebook.com/bracongo" readonly>
		@error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-md-4">
		<label class="form-label fw-semibold">Ordre</label>
		<input type="number" class="form-control" name="ordre" value="{{ old('ordre', $reseauSocial->ordre ?? 0) }}" min="0">
	</div>
	<div class="col-md-4 d-flex align-items-end">
		<div class="form-check form-switch mb-2">
			<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
				{{ old('is_active', $reseauSocial->is_active ?? true) ? 'checked' : '' }}>
			<label class="form-check-label fw-semibold" for="is_active">Actif</label>
		</div>
	</div>
</div>
