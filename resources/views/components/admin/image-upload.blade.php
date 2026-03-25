@props([
	'name' => 'image',
	'label' => 'Image',
	'value' => null,
	'required' => false,
	'help' => 'PNG, JPG, GIF — max 2 Mo',
])

@php
	$id = 'upload_' . preg_replace('/[^a-zA-Z0-9]/', '_', $name);
	$hasImage = !empty($value);
@endphp

<div class="image-upload-field" data-field-id="{{ $id }}">
	<label class="form-label fw-semibold">{{ $label }} @if($required)<span class="text-danger">*</span>@endif @if($help)<small class="text-muted">({{ $help }})</small>@endif</label>
	<div class="d-flex align-items-start gap-3 flex-wrap">
		<div class="flex-grow-1" style="min-width:200px;">
			<input class="form-control image-upload-input" type="file" id="{{ $id }}_input" name="{{ $name }}" accept="image/*">
			<div class="image-upload-filename small text-muted mt-1">{{ $hasImage ? basename($value) : 'Aucun fichier sélectionné' }}</div>
		</div>
		<div class="d-flex align-items-center gap-2">
			@if($hasImage)
			<div class="image-upload-preview position-relative" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modalPreviewImage">
				<img src="{{ asset($value) }}" alt="" style="height:60px;max-width:120px;object-fit:contain;border:1px solid #dee2e6;border-radius:8px;padding:4px;background:#f8f9fa;">
				<span class="badge badge-primary position-absolute top-0 end-0 translate-middle" style="font-size:10px;">Prévisualiser</span>
			</div>
			@else
			<div class="image-upload-preview d-none"></div>
			<div class="image-upload-placeholder bg-light border rounded d-flex align-items-center justify-content-center" style="width:80px;height:60px;">
				<svg width="24" height="24" fill="none" stroke="#adb5bd" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
			</div>
			@endif
		</div>
	</div>
	@error($name)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>
