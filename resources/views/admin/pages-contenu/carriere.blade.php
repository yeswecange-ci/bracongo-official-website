@extends('admin.layouts.app')
@section('title', 'Page Carrière')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Page Carrière</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Carrière</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="{{ route('carriere') }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">Voir la page</a>
<a href="{{ route('admin.offres-emploi.index') }}" class="btn btn-sm btn-primary">Gérer les offres</a>
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
			<div class="card-header"><h4 class="card-title">Contenu de la page</h4></div>
			<div class="card-body">
				<form action="{{ route('admin.pages.carriere.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="row g-3">
						<div class="col-12">
							<x-admin.image-upload name="hero_image" label="Image hero" :value="$page->hero_image ?? null" help="PNG, JPG, GIF — max 2 Mo" />
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
		<div class="card" style="border-top:4px solid #E30613;">
			<div class="card-header d-flex align-items-center justify-content-between">
				<h4 class="card-title mb-0">Offres d'emploi actives</h4>
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
						<span class="badge badge-xs {{ $offre->is_active ? 'badge-success' : 'badge-secondary' }}">
							{{ $offre->is_active ? 'Active' : 'Inactive' }}
						</span>
					</div>
					<a href="{{ route('admin.offres-emploi.edit', ['offres_emploi' => $offre]) }}" class="btn btn-xs btn-warning">
						<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
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
