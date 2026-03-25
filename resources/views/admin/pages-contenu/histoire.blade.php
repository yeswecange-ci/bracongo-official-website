@extends('admin.layouts.app')
@section('title', 'Notre Histoire')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Notre Histoire</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Notre Histoire</h6>
</div>
@endpush
@push('header-actions')
<a href="{{ route('histoire') }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">
    <i class="bi bi-box-arrow-up-right me-1"></i>Voir la page
</a>
<a href="{{ route('admin.valeurs.index') }}" class="btn btn-sm btn-primary">
    <i class="bi bi-star me-1"></i>Gérer les Valeurs
</a>
@endpush


@section('content')
@include('admin.layouts.partials.alerts')

<form action="{{ route('admin.pages.histoire.update') }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="row g-4">
		{{-- Hero + Titre --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="a-step-badge">1</span>
					<h5 class="mb-0">Bannière & Titre</h5>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-6">
						<x-admin.image-upload name="hero_image" label="Image hero" :value="$page->hero_image ?? null" help="PNG, JPG, GIF — max 2 Mo" />
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
					<span class="a-step-badge">2</span>
					<h5 class="mb-0">Textes de l'histoire</h5>
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
						<x-admin.image-upload name="image_brasserie" label="Image brasserie" :value="$page->image_brasserie ?? null" help="PNG, JPG, GIF — max 2 Mo" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Titre section « Valeurs »</label>
						<input type="text" class="form-control" name="valeurs_titre" value="{{ old('valeurs_titre', $page->valeurs_titre ?? 'Nos valeurs') }}">
					</div>
				</div>
			</div>
		</div>

		{{-- Section RSE --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="a-step-badge">3</span>
					<h5 class="mb-0">Section RSE</h5>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-6">
						<label class="form-label fw-semibold">Titre section RSE</label>
						<input type="text" class="form-control" name="rse_titre" value="{{ old('rse_titre', $page->rse_titre ?? 'Nos engagements RSE') }}">
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Texte RSE</label>
						<textarea class="form-control" name="rse_texte" rows="4">{{ old('rse_texte', $page->rse_texte) }}</textarea>
					</div>
					<div class="col-md-4">
						<x-admin.image-upload name="rse_image" label="Image RSE" :value="$page->rse_image ?? null" help="PNG, JPG, GIF — max 2 Mo" />
					</div>
					<div class="col-md-4">
						<label class="form-label fw-semibold">Texte du CTA</label>
						<input type="text" class="form-control" name="rse_cta_texte" value="{{ old('rse_cta_texte', $page->rse_cta_texte) }}">
					</div>
					<div class="col-md-4">
						<label class="form-label fw-semibold">Lien du CTA <x-admin.readonly-info /></label>
						<input type="text" class="form-control bg-light" name="rse_cta_lien" value="{{ old('rse_cta_lien', $page->rse_cta_lien) }}" readonly>
					</div>
				</div>
			</div>
		</div>

		{{-- Carte Maps --}}
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex align-items-center gap-2">
					<span class="a-step-badge">4</span>
					<h5 class="mb-0">Présence nationale</h5>
				</div>
				<div class="card-body row g-3">
					<div class="col-md-6">
						<label class="form-label fw-semibold">Titre section carte (grand titre)</label>
						<input type="text" class="form-control" name="presence_titre" value="{{ old('presence_titre', $page->presence_titre ?? 'Notre présence nationale') }}">
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Titre bandeau au-dessus de la carte</label>
						<input type="text" class="form-control" name="carte_panel_titre" value="{{ old('carte_panel_titre', $page->carte_panel_titre ?? 'Centres de distribution Bracongo') }}">
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">URL Google Maps (embed) <x-admin.readonly-info /></label>
						<textarea class="form-control bg-light" name="maps_embed_url" rows="3" readonly>{{ old('maps_embed_url', $page->maps_embed_url) }}</textarea>
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
						<span class="a-step-badge">5</span>
						<h5 class="mb-0">Valeurs PREMIERS ({{ $valeurs->count() }} valeurs)</h5>
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
			<button type="submit" class="btn btn-primary">
			<i class="bi bi-floppy me-1"></i>Enregistrer
		</button>
		</div>
	</div>
</form>
@endsection
