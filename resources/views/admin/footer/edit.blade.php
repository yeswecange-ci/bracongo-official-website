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
@push('header-actions')
<a href="{{ route('admin.footer-gallery.index') }}" class="btn btn-sm btn-outline-primary me-2">Galerie</a>
<a href="{{ route('admin.reseaux-sociaux.index') }}" class="btn btn-sm btn-primary">Réseaux sociaux</a>
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
	<div class="col-xl-8">
		<div class="card">
			<div class="card-header"><h4 class="card-title">Informations du footer</h4></div>
			<div class="card-body">
				<form action="{{ route('admin.footer.update') }}" method="POST">
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
						<div class="col-md-6">
							<label class="form-label fw-semibold">Image certification <small class="text-muted">(ex: img/image 12.png)</small></label>
							<input type="text" class="form-control" name="certification_image" value="{{ old('certification_image', $footer->certification_image) }}">
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

	<div class="col-xl-4">
		{{-- Galerie --}}
		<div class="card mb-4">
			<div class="card-header d-flex align-items-center justify-content-between">
				<h4 class="card-title mb-0">Galerie ({{ $gallery->count() }} images)</h4>
				<a href="{{ route('admin.footer-gallery.index') }}" class="btn btn-xs btn-primary">Gérer</a>
			</div>
			<div class="card-body">
				<div class="d-flex flex-wrap gap-1">
					@foreach($gallery as $img)
					<img src="{{ asset($img->image) }}" alt="{{ $img->alt }}" style="width:50px;height:38px;object-fit:cover;border-radius:4px;">
					@endforeach
				</div>
			</div>
		</div>

		{{-- Réseaux sociaux --}}
		<div class="card">
			<div class="card-header d-flex align-items-center justify-content-between">
				<h4 class="card-title mb-0">Réseaux sociaux</h4>
				<a href="{{ route('admin.reseaux-sociaux.index') }}" class="btn btn-xs btn-primary">Gérer</a>
			</div>
			<div class="card-body p-0">
				@foreach($reseaux as $rs)
				<div class="d-flex align-items-center justify-content-between p-3 border-bottom">
					<div class="d-flex align-items-center gap-2">
						<span class="badge badge-primary light text-capitalize">{{ $rs->platform }}</span>
						<code class="small">{{ Str::limit($rs->url, 25) }}</code>
					</div>
					<span class="badge {{ $rs->is_active ? 'badge-success' : 'badge-secondary' }} light xs">
						{{ $rs->is_active ? 'Actif' : 'Inactif' }}
					</span>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
