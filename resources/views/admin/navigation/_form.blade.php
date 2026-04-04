@php($nav = $navigation ?? null)
<div class="row g-3">
	<div class="col-12">
		<label class="form-label fw-semibold">Label (texte affiché) <span class="text-danger">*</span></label>
		<input type="text" class="form-control @error('label') is-invalid @enderror" name="label" value="{{ old('label', optional($nav)->label ?? '') }}">
		@error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
	</div>
	<div class="col-12">
		<label class="form-label fw-semibold">URL</label>
		<input type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url', optional($nav)->url ?? '#') }}" placeholder="/histoire, /Contact, https://…">
		@error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
		<div class="form-text">Chemin interne ou URL complète.</div>
	</div>
</div>
