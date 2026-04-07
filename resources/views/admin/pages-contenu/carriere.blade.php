@extends('admin.layouts.app')
@section('title', 'Page Carrière')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Carrière</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Page Carrière</h6>
</div>
@endpush
@push('header-actions')
<a href="{{ route('carriere') }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">
    <i class="bi bi-box-arrow-up-right me-1"></i>Voir la page
</a>
<a href="{{ route('admin.offres-emploi.index') }}" class="btn btn-sm btn-primary">
    <i class="bi bi-briefcase me-1"></i>Gérer les offres
</a>
@endpush


@section('content')
@include('admin.layouts.partials.alerts')

<div class="row g-4">
	<div class="col-xl-8">
		<div class="card">
			<div class="card-header"><h5 class="mb-0">Contenu de la page</h5></div>
			<div class="card-body">
				<form action="{{ route('admin.pages.carriere.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="row g-3">
						<div class="col-12">
							<x-admin.image-upload name="hero_image" label="Image hero" :value="$page->hero_image ?? null" help="PNG, JPG, GIF — max 10 Mo" />
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Titre hero <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('hero_titre') is-invalid @enderror" name="hero_titre" value="{{ old('hero_titre', $page->hero_titre ?? 'Rejoignez-nous') }}">
							@error('hero_titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Texte d'introduction <span class="text-danger">*</span></label>
							<textarea class="form-control @error('texte_intro') is-invalid @enderror" name="texte_intro" rows="5">{{ old('texte_intro', $page->texte_intro) }}</textarea>
							@error('texte_intro')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Titre section offres <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('offres_titre') is-invalid @enderror" name="offres_titre" value="{{ old('offres_titre', $page->offres_titre ?? "Nos offres d'emploi") }}">
							@error('offres_titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-12 pt-2">
							<button type="submit" class="btn btn-primary">
							<i class="bi bi-floppy me-1"></i>Enregistrer
						</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-xl-4">
		<div class="card">
			<div class="card-header d-flex align-items-center justify-content-between">
				<h5 class="mb-0">Offres d'emploi actives</h5>
				<a href="{{ route('admin.offres-emploi.create') }}" class="btn btn-sm btn-primary">+ Ajouter</a>
			</div>
			<div class="card-body p-0">
				@php $offres = \App\Models\OffreEmploi::orderBy('ordre')->take(5)->get(); @endphp
				@forelse($offres as $offre)
				<div class="d-flex align-items-center gap-3 p-3 border-bottom">
					@if($offre->image)
					<img src="{{ asset($offre->image) }}" style="width:40px;height:40px;object-fit:cover;border-radius:8px;" alt="">
					@endif
					<div class="flex-grow-1">
						<div class="fw-semibold small">{{ Str::limit($offre->titre, 40) }}</div>
						<span class="{{ $offre->is_active ? 'a-status a-status--active' : 'a-status a-status--inactive' }}">
							{{ $offre->is_active ? 'Active' : 'Inactive' }}
						</span>
					</div>
					<a href="{{ route('admin.offres-emploi.edit', ['offres_emploi' => $offre]) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
						<i class="bi bi-pencil"></i>
					</a>
				</div>
				@empty
				<p class="text-muted text-center py-3 small">Aucune offre</p>
				@endforelse
			</div>
		</div>
	</div>
</div>
@endsection
