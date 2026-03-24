@extends('admin.layouts.app')
@section('title', 'Footer')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Footer du site</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Footer</li>
	</ol>
</div>
@endpush

@section('header')
@include('admin.layouts.partials.header')
@endsection
@section('sidebar')
@include('admin.layouts.partials.sidebar')
@endsection

@section('content')
@include('admin.layouts.partials.alerts')

<div class="row g-4">
	{{-- Formulaire principal --}}
	<div class="col-xl-8">
		<div class="card">
			<div class="card-header"><h4 class="card-title">Informations du footer</h4></div>
			<div class="card-body">
				<form action="{{ route('admin.footer.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="row g-3">
						<div class="col-12">
							<label class="form-label fw-semibold">Citation / Mission <span class="text-danger">*</span></label>
							<textarea class="form-control @error('mission_texte') is-invalid @enderror" name="mission_texte" rows="3">{{ old('mission_texte', $footer->mission_texte) }}</textarea>
							@error('mission_texte')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Adresse <span class="text-danger">*</span></label>
							<textarea class="form-control @error('adresse') is-invalid @enderror" name="adresse" rows="2">{{ old('adresse', $footer->adresse) }}</textarea>
							@error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Téléphone</label>
							<input type="text" class="form-control" name="telephone" value="{{ old('telephone', $footer->telephone) }}">
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
							<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $footer->email) }}">
							@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>

						{{-- Image certification : upload fichier avec prévisualisation --}}
						<div class="col-12">
							<label class="form-label fw-semibold">Image certification <small class="text-muted">(PNG, JPG — logo certification)</small></label>
							<div class="d-flex align-items-start gap-3 flex-wrap">
								<div class="flex-grow-1" style="min-width:200px;">
									<input class="form-control" type="file" id="certificationFile" name="certification_image" accept="image/*">
									<div id="certificationFileName" class="small text-muted mt-1">Aucun fichier sélectionné</div>
								</div>
								<div class="d-flex align-items-center gap-2">
									@if($footer->certification_image)
									<div id="certificationPreview" class="position-relative" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modalPreviewCertification">
										<img src="{{ asset($footer->certification_image) }}" alt="Certification" style="height:60px;max-width:120px;object-fit:contain;border:1px solid #dee2e6;border-radius:8px;padding:4px;background:#f8f9fa;">
										<span class="badge badge-primary position-absolute top-0 end-0 translate-middle" style="font-size:10px;">Prévisualiser</span>
									</div>
									@else
									<div id="certificationPreview" class="d-none"></div>
									<div id="certificationPlaceholder" class="bg-light border rounded d-flex align-items-center justify-content-center" style="width:80px;height:60px;">
										<svg width="24" height="24" fill="none" stroke="#adb5bd" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
									</div>
									@endif
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<label class="form-label fw-semibold">Année de création <small class="text-muted">(pour le copyright)</small></label>
							<input type="number" class="form-control @error('copyright_debut_annee') is-invalid @enderror" name="copyright_debut_annee" value="{{ old('copyright_debut_annee', $footer->copyright_debut_annee) }}" min="1900" max="2100">
							@error('copyright_debut_annee')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>

						<div class="col-12 pt-2">
							<button type="submit" class="btn btn-primary">
								<svg class="me-1" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
								Enregistrer
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- Carte combinée Galerie + Réseaux sociaux --}}
	<div class="col-xl-4">
		<div class="card">
			<div class="card-header border-0 pb-0">
				<ul class="nav nav-tabs card-header-tabs nav-tabs-sm" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#tab-galerie" role="tab">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
							Galerie ({{ $gallery->count() }})
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#tab-reseaux" role="tab">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><circle cx="12" cy="12" r="10"/><path d="M16 8a5 5 0 0 1 0 8M12 12a4 4 0 0 0 0 8M8 16a9 9 0 0 1 0-8"/></svg>
							Réseaux sociaux
						</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					{{-- Onglet Galerie --}}
					<div class="tab-pane fade show active" id="tab-galerie" role="tabpanel">
						<div class="d-flex justify-content-between align-items-center mb-3">
							<span class="text-muted small">Images du bandeau footer</span>
							<a href="{{ route('admin.footer-gallery.index') }}" class="btn btn-sm btn-primary">Gérer la galerie</a>
						</div>
						<div class="d-flex flex-wrap gap-2">
							@forelse($gallery as $img)
							<div class="img-thumb-preview" style="cursor:pointer;" data-src="{{ asset($img->image) }}" data-alt="{{ $img->alt }}" data-bs-toggle="modal" data-bs-target="#modalPreviewImage">
								<img src="{{ asset($img->image) }}" alt="{{ $img->alt }}" style="width:50px;height:38px;object-fit:cover;border-radius:6px;border:2px solid transparent;transition:border-color .2s;">
							</div>
							@empty
							<div class="text-muted small py-2">Aucune image.</div>
							@endforelse
						</div>
					</div>

					{{-- Onglet Réseaux sociaux --}}
					<div class="tab-pane fade" id="tab-reseaux" role="tabpanel">
						<div class="d-flex justify-content-between align-items-center mb-3">
							<span class="text-muted small">Liens vers vos réseaux</span>
							<a href="{{ route('admin.reseaux-sociaux.index') }}" class="btn btn-sm btn-primary">Gérer</a>
						</div>
						<div class="list-group list-group-flush">
							@foreach($reseaux as $rs)
							<div class="list-group-item d-flex align-items-center justify-content-between px-0 py-2 border-0">
								<div class="d-flex align-items-center gap-2">
									<span class="badge badge-primary light text-capitalize">{{ $rs->platform }}</span>
									<code class="small text-muted" style="font-size:11px;">{{ Str::limit($rs->url, 30) }}</code>
								</div>
								<span class="badge {{ $rs->is_active ? 'badge-success' : 'badge-secondary' }} light">{{ $rs->is_active ? 'Actif' : 'Inactif' }}</span>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Modale prévisualisation image certification --}}
<div class="modal fade" id="modalPreviewCertification" tabindex="-1" aria-labelledby="modalPreviewCertificationLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-header py-2">
				<h5 class="modal-title small" id="modalPreviewCertificationLabel">Image certification</h5>
				<button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body text-center p-4">
				<img id="modalPreviewCertificationSrc" src="{{ $footer->certification_image ? asset($footer->certification_image) : '' }}" alt="Certification" class="img-fluid rounded {{ $footer->certification_image ? '' : 'd-none' }}" style="max-height:200px;object-fit:contain;">
				<div id="modalPreviewCertificationEmpty" class="text-muted py-4 {{ $footer->certification_image ? 'd-none' : '' }}">Aucune image</div>
			</div>
		</div>
	</div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
	// Mise à jour nom fichier certification
	var certInput = document.getElementById('certificationFile');
	if (certInput) {
		certInput.addEventListener('change', function() {
			var label = document.getElementById('certificationFileName');
			var preview = document.getElementById('certificationPreview');
			var placeholder = document.getElementById('certificationPlaceholder');
			if (this.files && this.files[0]) {
				label.textContent = this.files[0].name;
				var reader = new FileReader();
				reader.onload = function(e) {
					if (!preview.querySelector('img')) {
						preview.innerHTML = '<img src="" alt="Prévisualisation" style="height:60px;max-width:120px;object-fit:contain;border:1px solid #dee2e6;border-radius:8px;padding:4px;background:#f8f9fa;" data-bs-toggle="modal" data-bs-target="#modalPreviewCertification">';
					}
					preview.querySelector('img').src = e.target.result;
					preview.classList.remove('d-none');
					if (placeholder) placeholder.classList.add('d-none');
				};
				reader.readAsDataURL(this.files[0]);
			} else {
				label.textContent = 'Aucun fichier sélectionné';
			}
		});
	}

	// Modale certification : injecter src au clic sur la prévisualisation
	document.addEventListener('click', function(e) {
		var certPreview = e.target.closest('#certificationPreview');
		if (certPreview) {
			var img = certPreview.querySelector('img');
			if (img) {
				var modalImg = document.getElementById('modalPreviewCertificationSrc');
				var modalEmpty = document.getElementById('modalPreviewCertificationEmpty');
				modalImg.src = img.src;
				modalImg.alt = img.alt || 'Certification';
				modalImg.classList.remove('d-none');
				if (modalEmpty) modalEmpty.classList.add('d-none');
			}
		}
	});

	// Modale galerie : injecter src au clic
	document.querySelectorAll('.img-thumb-preview').forEach(function(el) {
		el.addEventListener('click', function() {
			var src = this.dataset.src;
			var alt = this.dataset.alt || '';
			document.getElementById('modalPreviewImageSrc').src = src;
			document.getElementById('modalPreviewImageSrc').alt = alt;
		});
	});

	// Hover sur les miniatures
	document.querySelectorAll('.img-thumb-preview').forEach(function(el) {
		el.addEventListener('mouseenter', function() { this.querySelector('img').style.borderColor = '#E30613'; });
		el.addEventListener('mouseleave', function() { this.querySelector('img').style.borderColor = 'transparent'; });
	});
});
</script>
@endpush
@endsection
