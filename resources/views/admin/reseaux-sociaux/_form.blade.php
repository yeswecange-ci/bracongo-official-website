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
		<div class="a-readonly-wrap">
			<i class="bi bi-lock a-lock-icon"></i>
			<input type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url', $reseauSocial->url ?? '') }}" placeholder="https://facebook.com/bracongo" readonly>
		</div>
		@error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
</div>
