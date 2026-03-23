@extends('admin.layouts.app')
@section('title', 'Page Contact')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Page Contact</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Contact</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="{{ route('contact') }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">Voir la page</a>
<a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-primary">Voir les messages</a>
@endpush

@section('header')
@include('admin.layouts.partials.header')
@endsection
@section('sidebar')
@include('admin.layouts.partials.sidebar')
@endsection

@section('content')
@include('admin.layouts.partials.alerts')

<form action="{{ route('admin.pages.contact.update') }}" method="POST">
	@csrf
	@method('PUT')
	<div class="row g-4">
		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h4 class="card-title">Informations de contact</h4></div>
				<div class="card-body row g-3">
					<div class="col-12">
						<label class="form-label fw-semibold">Image hero <small class="text-muted">(ex: img/bracongo.jpg)</small></label>
						<input type="text" class="form-control" name="hero_image" value="{{ old('hero_image', $page->hero_image) }}">
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Dénomination sociale <span class="text-danger">*</span></label>
						<textarea class="form-control @error('denomination') is-invalid @enderror" name="denomination" rows="2">{{ old('denomination', $page->denomination) }}</textarea>
						@error('denomination')<div class="invalid-feedback">{{ $message }}</div>@enderror
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Adresse complète <span class="text-danger">*</span></label>
						<textarea class="form-control @error('adresse') is-invalid @enderror" name="adresse" rows="3">{{ old('adresse', $page->adresse) }}</textarea>
						@error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Boîte postale (BP)</label>
						<input type="text" class="form-control" name="bp" value="{{ old('bp', $page->bp) }}">
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Email principal <span class="text-danger">*</span></label>
						<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $page->email) }}">
						@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Tél. consommateurs</label>
						<input type="text" class="form-control" name="tel_consommateurs" value="{{ old('tel_consommateurs', $page->tel_consommateurs) }}">
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Tél. service fêtes</label>
						<input type="text" class="form-control" name="tel_fetes" value="{{ old('tel_fetes', $page->tel_fetes) }}">
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Tél. fournisseurs</label>
						<input type="text" class="form-control" name="tel_fournisseurs" value="{{ old('tel_fournisseurs', $page->tel_fournisseurs) }}">
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Tél. Clé des Châteaux</label>
						<input type="text" class="form-control" name="tel_cle_chateaux" value="{{ old('tel_cle_chateaux', $page->tel_cle_chateaux) }}">
					</div>
					<div class="col-12">
						<label class="form-label fw-semibold">Lien "Devenir client"</label>
						<input type="text" class="form-control" name="devenir_client_lien" value="{{ old('devenir_client_lien', $page->devenir_client_lien) }}">
					</div>
					<div class="col-12 pt-2">
						<button type="submit" class="btn btn-primary">
							<svg class="me-1" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
							Enregistrer
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4">
			<div class="card">
				<div class="card-header"><h4 class="card-title">Récapitulatif</h4></div>
				<div class="card-body">
					<ul class="list-group list-group-flush">
						<li class="list-group-item d-flex gap-2 px-0">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E30613" stroke-width="2" class="flex-shrink-0 mt-1"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 12 19.79 19.79 0 0 1 1.93 3.5 2 2 0 0 1 3.77 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
							<span class="small">{{ $page->tel_consommateurs }}</span>
						</li>
						<li class="list-group-item d-flex gap-2 px-0">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E30613" stroke-width="2" class="flex-shrink-0 mt-1"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
							<span class="small">{{ $page->email }}</span>
						</li>
						<li class="list-group-item d-flex gap-2 px-0">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E30613" stroke-width="2" class="flex-shrink-0 mt-1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
							<span class="small">{{ Str::limit($page->adresse, 80) }}</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
