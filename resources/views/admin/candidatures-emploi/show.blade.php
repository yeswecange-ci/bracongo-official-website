@extends('admin.layouts.app')
@section('title', 'Candidature')

@php
	$initials = strtoupper(\Illuminate\Support\Str::substr($candidature->prenom, 0, 1).\Illuminate\Support\Str::substr($candidature->nom, 0, 1));
@endphp

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.candidatures-emploi.index') }}">Candidatures</a></li>
		<li class="breadcrumb-item active">Détail</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Candidature — {{ $candidature->prenom }} {{ $candidature->nom }}</h6>
</div>
@endpush
@push('header-actions')
<a href="{{ route('admin.candidatures-emploi.index', request()->only('offre')) }}" class="btn btn-outline-secondary">
	<i class="bi bi-arrow-left me-1"></i>Retour à la liste
</a>
<a href="{{ route('admin.candidatures-emploi.cv', $candidature) }}" class="btn btn-primary">
	<i class="bi bi-file-earmark-arrow-down me-1"></i>Télécharger le CV
</a>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<div class="row g-4 align-items-start">
	<div class="col-lg-8">
		<div class="card border-0 shadow-sm" style="border-radius:12px">
			<div class="card-body">
				<div class="d-flex gap-3 align-items-start mb-4">
					<div class="rounded-circle bg-light d-flex align-items-center justify-content-center flex-shrink-0"
						style="width:56px;height:56px;font-weight:700;font-size:1.1rem;color:#E30613;">
						{{ $initials }}
					</div>
					<div>
						<h5 class="mb-1">{{ $candidature->prenom }} {{ $candidature->nom }}</h5>
						<p class="text-muted small mb-0">Reçue le {{ $candidature->created_at->format('d/m/Y à H:i') }}</p>
					</div>
				</div>

				<dl class="row mb-0">
					<dt class="col-sm-4 col-md-3 text-muted small">Offre</dt>
					<dd class="col-sm-8 col-md-9">
						@if($candidature->offre)
							<a href="{{ route('admin.offres-emploi.edit', $candidature->offre) }}">{{ $candidature->offre->titre }}</a>
						@else
							—
						@endif
					</dd>
					<dt class="col-sm-4 col-md-3 text-muted small">E-mail</dt>
					<dd class="col-sm-8 col-md-9"><a href="mailto:{{ $candidature->email }}">{{ $candidature->email }}</a></dd>
					<dt class="col-sm-4 col-md-3 text-muted small">Téléphone</dt>
					<dd class="col-sm-8 col-md-9">{{ $candidature->telephone ?: '—' }}</dd>
				</dl>

				@if($candidature->message)
				<hr class="my-4">
				<h6 class="fw-semibold mb-2">Message</h6>
				<div class="small" style="white-space:pre-wrap;">{{ $candidature->message }}</div>
				@endif

				@if($candidature->lettre_motivation)
				<hr class="my-4">
				<h6 class="fw-semibold mb-2">Lettre de motivation</h6>
				<div class="small" style="white-space:pre-wrap;">{{ $candidature->lettre_motivation }}</div>
				@endif
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card border-0 shadow-sm" style="border-radius:12px">
			<div class="card-header bg-transparent border-0 pb-0"><h6 class="mb-0">Fichier CV</h6></div>
			<div class="card-body pt-3">
				<p class="small text-muted mb-3">Le fichier est stocké de façon sécurisée ; seuls les utilisateurs du back-office peuvent le télécharger.</p>
				<a href="{{ route('admin.candidatures-emploi.cv', $candidature) }}" class="btn btn-outline-primary w-100">
					<i class="bi bi-download me-1"></i>Télécharger
				</a>
				<p class="small text-muted mt-2 mb-0 text-break">{{ basename($candidature->cv_path) }}</p>
			</div>
		</div>
	</div>
</div>
@endsection
