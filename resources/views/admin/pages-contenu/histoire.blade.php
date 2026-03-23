@extends('admin.layouts.app')
@section('title', 'Notre Histoire')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Notre Histoire</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Notre Histoire</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="{{ route('histoire') }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">Voir la page</a>
<a href="{{ route('admin.valeurs.index') }}" class="btn btn-sm btn-primary">Gérer les Valeurs</a>
@endpush

@section('header')
@include('admin.layouts.partials.header')
@endsection
@section('sidebar')
@include('admin.layouts.partials.sidebar')
@endsection

@section('content')
@include('admin.layouts.partials.alerts')

<form action="{{ route('admin.pages.histoire.update') }}" method="POST">
	@csrf
	@method('PUT')
	<div class="row g-4">
		{{-- Hero + Titre --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">1</span>
					<h4 class="card-title mb-0">Bannière & Titre</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-6">
						<label class="form-label fw-semibold">Image hero <small class="text-muted">(ex: img/bracongo.jpg)</small></label>
						<input type="text" class="form-control" name="hero_image" value="{{ old('hero_image', $page->hero_image) }}">
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Titre de la page <span class="text-danger">*</span></label>
						<input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre', $page->titre) }}">
						@error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
					</div>
				</div>
			</div>
		</div>

		{{-- Textes histoire --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">2</span>
					<h4 class="card-title mb-0">Textes de l'histoire</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-12">
						<label class="form-label fw-semibold">Paragraphe 1</label>
						<textarea class="form-control" name="paragraphe_1" rows="4">{{ old('paragraphe_1', $page->paragraphe_1) }}</textarea>
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Paragraphe 2</label>
						<textarea class="form-control" name="paragraphe_2" rows="4">{{ old('paragraphe_2', $page->paragraphe_2) }}</textarea>
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Paragraphe 3</label>
						<textarea class="form-control" name="paragraphe_3" rows="4">{{ old('paragraphe_3', $page->paragraphe_3) }}</textarea>
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Image brasserie <small class="text-muted">(ex: img/Frame-115.png)</small></label>
						<input type="text" class="form-control" name="image_brasserie" value="{{ old('image_brasserie', $page->image_brasserie) }}">
					</div>
				</div>
			</div>
		</div>

		{{-- Section RSE --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">3</span>
					<h4 class="card-title mb-0">Section RSE</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-12">
						<label class="form-label fw-semibold">Texte RSE</label>
						<textarea class="form-control" name="rse_texte" rows="4">{{ old('rse_texte', $page->rse_texte) }}</textarea>
					</div>
					<div class="col-md-4">
						<label class="form-label fw-semibold">Image RSE</label>
						<input type="text" class="form-control" name="rse_image" value="{{ old('rse_image', $page->rse_image) }}">
					</div>
					<div class="col-md-4">
						<label class="form-label fw-semibold">Texte du CTA</label>
						<input type="text" class="form-control" name="rse_cta_texte" value="{{ old('rse_cta_texte', $page->rse_cta_texte) }}">
					</div>
					<div class="col-md-4">
						<label class="form-label fw-semibold">Lien du CTA</label>
						<input type="text" class="form-control" name="rse_cta_lien" value="{{ old('rse_cta_lien', $page->rse_cta_lien) }}">
					</div>
				</div>
			</div>
		</div>

		{{-- Carte Maps --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="badge" style="background:#E30613;">4</span>
					<h4 class="card-title mb-0">Présence nationale</h4>
				</div>
				<div class="card-body row g-3">
					<div class="col-12">
						<label class="form-label fw-semibold">URL Google Maps (embed)</label>
						<textarea class="form-control" name="maps_embed_url" rows="3">{{ old('maps_embed_url', $page->maps_embed_url) }}</textarea>
						<small class="text-muted">Copiez l'URL depuis Google Maps → Partager → Intégrer une carte</small>
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Note sous la carte</label>
						<input type="text" class="form-control" name="presence_note" value="{{ old('presence_note', $page->presence_note) }}">
					</div>
				</div>
			</div>
		</div>

		{{-- Valeurs (lecture seule, gestion via autre page) --}}
		<div class="col-12">
			<div class="card border-dashed">
				<div class="card-header d-flex align-items-center justify-content-between">
					<div class="d-flex align-items-center gap-2">
						<span class="badge" style="background:#E30613;">5</span>
						<h4 class="card-title mb-0">Valeurs PREMIERS ({{ $valeurs->count() }} valeurs)</h4>
					</div>
					<a href="{{ route('admin.valeurs.index') }}" class="btn btn-sm btn-primary">Gérer les valeurs</a>
				</div>
				<div class="card-body">
					<div class="d-flex flex-wrap gap-2">
						@foreach($valeurs as $v)
						<div class="text-center p-3 rounded" style="background:#E30613;color:#fff;min-width:90px;">
							<div style="font-size:1.5rem;font-weight:800;">{{ $v->lettre }}</div>
							<div style="font-size:.7rem;">{{ $v->description }}</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 pb-4">
			<button type="submit" class="btn btn-primary btn-lg px-5">
				<svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
				Enregistrer
			</button>
		</div>
	</div>
</form>
@endsection
