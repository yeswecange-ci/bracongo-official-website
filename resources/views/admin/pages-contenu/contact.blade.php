@extends('admin.layouts.app')
@section('title', 'Page Contact')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Contact</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Page Contact</h6>
</div>
@endpush
@push('header-actions')
<a href="{{ route('contact') }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">
    <i class="bi bi-box-arrow-up-right me-1"></i>Voir la page
</a>
<a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-primary">
    <i class="bi bi-envelope me-1"></i>Voir les messages
</a>
@endpush


@section('content')
@include('admin.layouts.partials.alerts')

<form action="{{ route('admin.pages.contact.update') }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="row g-4">
		<div class="col-xl-8">
			<div class="card">
				<div class="card-header"><h5 class="mb-0">Informations de contact</h5></div>
				<div class="card-body row g-3">
					<div class="col-12">
						<x-admin.image-upload name="hero_image" label="Image hero" :value="$page->hero_image ?? null" help="PNG, JPG, GIF — max 2 Mo" />
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Titre de la bannière <span class="text-danger">*</span></label>
						<input type="text" class="form-control @error('hero_titre') is-invalid @enderror" name="hero_titre" value="{{ old('hero_titre', $page->hero_titre ?? 'Nos Contacts') }}">
						@error('hero_titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
					</div>
					<div class="col-md-6">
						<label class="form-label fw-semibold">Titre au-dessus du formulaire <span class="text-danger">*</span></label>
						<input type="text" class="form-control @error('form_titre') is-invalid @enderror" name="form_titre" value="{{ old('form_titre', $page->form_titre ?? 'Nous contacter') }}">
						@error('form_titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
						<label class="form-label fw-semibold">Lien "Devenir client" <x-admin.readonly-info /></label>
						<input type="text" class="form-control bg-light" name="devenir_client_lien" value="{{ old('devenir_client_lien', $page->devenir_client_lien) }}" readonly>
					</div>
					<div class="col-12 pt-2">
						<button type="submit" class="btn btn-primary">
							<i class="bi bi-floppy me-1"></i>Enregistrer
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4">
			<div class="card">
				<div class="card-header"><h5 class="mb-0">Récapitulatif</h5></div>
				<div class="card-body">
					<ul class="list-group list-group-flush">
						<li class="list-group-item d-flex gap-2 px-0">
							<i class="bi bi-telephone" style="color:#E30613;flex-shrink:0;margin-top:3px"></i>
							<span class="small">{{ $page->tel_consommateurs }}</span>
						</li>
						<li class="list-group-item d-flex gap-2 px-0">
							<i class="bi bi-envelope" style="color:#E30613;flex-shrink:0;margin-top:3px"></i>
							<span class="small">{{ $page->email }}</span>
						</li>
						<li class="list-group-item d-flex gap-2 px-0">
							<i class="bi bi-geo-alt" style="color:#E30613;flex-shrink:0;margin-top:3px"></i>
							<span class="small">{{ Str::limit($page->adresse, 80) }}</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
