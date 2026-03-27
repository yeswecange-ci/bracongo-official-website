@extends('admin.layouts.app')
@section('title', 'Paramètres du site')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Paramètres</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Paramètres du site</h6>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-xl-8">
		@include('admin.layouts.partials.alerts')

		<div class="card">
			<div class="card-header">
				<h5 class="mb-0"><i class="bi bi-gear me-2" style="color:#E30613"></i>Paramètres globaux</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('admin.parametres.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="row g-4">
						<div class="col-12">
							<x-admin.image-upload name="logo" label="Logo" :value="$parametres->logo ?? null" help="PNG, JPG, GIF — max 2 Mo" />
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Suggestions de recherche <span class="text-muted small">(séparées par des virgules)</span></label>
							<input type="text" class="form-control" name="search_suggestions" value="{{ old('search_suggestions', $parametres->search_suggestions) }}" placeholder="Beaufort Lager,Actualités,Nkoyi">
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Page Actualités — titre hero</label>
							<input type="text" class="form-control" name="actualites_hero_titre" value="{{ old('actualites_hero_titre', $parametres->actualites_hero_titre ?? 'Actualités & Événements') }}">
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Page Actualités — libellé « tout voir »</label>
							<input type="text" class="form-control" name="actualites_filtre_tout_label" value="{{ old('actualites_filtre_tout_label', $parametres->actualites_filtre_tout_label ?? 'Tout voir') }}">
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Invitations — durée de validité</label>
							<select name="invitation_expires_hours" class="form-select @error('invitation_expires_hours') is-invalid @enderror">
								@php
									$currentInvitationHours = (string) old('invitation_expires_hours', $parametres->invitation_expires_hours?->value ?? $parametres->invitation_expires_hours ?? '48');
								@endphp
								@foreach($invitationExpiresOptions as $opt)
								<option value="{{ $opt->value }}" @selected($currentInvitationHours === $opt->value)>{{ $opt->label() }}</option>
								@endforeach
							</select>
							@error('invitation_expires_hours')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
							<div class="form-text">S’applique aux nouvelles invitations.</div>
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
			<div class="card-header"><h5 class="mb-0">Aperçu</h5></div>
			<div class="card-body text-center">
				<img src="{{ asset($parametres->logo ?? 'img/LOGO BRACONGO copie 1.png') }}" alt="Logo" style="height:80px;object-fit:contain;" class="mb-3">
				<div class="badge px-3 py-2" style="background-color:{{ $parametres->couleur_principale }};font-size:1rem;">
					{{ $parametres->couleur_principale }}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
@endpush
