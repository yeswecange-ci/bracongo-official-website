@props([
	'name' => 'image',
	'label' => 'Image',
	'value' => null,
	'required' => false,
	'help' => 'PNG, JPG, GIF, WebP — max 10 Mo',
	'compactPreview' => false,
])

@php
	$id = 'upload_' . preg_replace('/[^a-zA-Z0-9]/', '_', $name);
	$hasImage = !empty($value);
@endphp

<div class="image-upload-field {{ $compactPreview ? 'image-upload-field--compact' : '' }}" data-field-id="{{ $id }}">
	<label class="form-label fw-semibold">{{ $label }} @if($required)<span class="text-danger">*</span>@endif @if($help)<small class="text-muted">({{ $help }})</small>@endif</label>
	<div class="d-flex align-items-start gap-3 flex-wrap">
		<div class="flex-grow-1" style="min-width:200px;">
			<input class="form-control image-upload-input" type="file" id="{{ $id }}_input" name="{{ $name }}" accept="image/*">
			<div class="image-upload-filename small text-muted mt-1">{{ $hasImage ? basename($value) : 'Aucun fichier sélectionné' }}</div>
		</div>
		<div class="d-flex align-items-center gap-2">
			@if($hasImage)
			<div class="image-upload-preview position-relative" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modalPreviewImage">
				<img src="{{ asset($value) }}" alt="" class="admin-upload-thumb">
				<span class="admin-upload-thumb-zoom" title="Prévisualiser" aria-label="Prévisualiser"><i class="bi bi-eye-fill" aria-hidden="true"></i></span>
			</div>
			@else
			<div class="image-upload-preview d-none"></div>
			<div class="image-upload-placeholder bg-light border rounded d-flex align-items-center justify-content-center">
				<svg width="24" height="24" fill="none" stroke="#adb5bd" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
			</div>
			@endif
		</div>
	</div>
	@error($name)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>
