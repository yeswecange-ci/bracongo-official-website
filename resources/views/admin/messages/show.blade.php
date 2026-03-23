@extends('admin.layouts.app')
@section('title', 'Message de contact')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Message de {{ $messageContact->name }}</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.messages.index') }}">Messages</a></li>
		<li class="breadcrumb-item active">Lire</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="mailto:{{ $messageContact->email }}?subject=Re: {{ $messageContact->subject }}" class="btn btn-primary me-2">
	<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
	Répondre
</a>
<a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">Retour</a>
@endpush

@section('header')
@include('admin.layouts.partials.header')
@endsection
@section('sidebar')
@include('admin.layouts.partials.sidebar')
@endsection

@section('content')
<div class="row justify-content-center">
	<div class="col-xl-8">
		<div class="card">
			<div class="card-header d-flex align-items-center justify-content-between">
				<h4 class="card-title mb-0">{{ $messageContact->subject ?: '(Sans sujet)' }}</h4>
				<span class="badge {{ $messageContact->lu ? 'badge-success' : 'badge-warning' }} light">
					{{ $messageContact->lu ? 'Lu' : 'Non lu' }}
				</span>
			</div>
			<div class="card-body">
				<div class="row g-3 mb-4">
					<div class="col-md-4">
						<div class="p-3 rounded" style="background:#f8f8f8;">
							<div class="small text-muted mb-1">Nom</div>
							<div class="fw-semibold">{{ $messageContact->name }}</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="p-3 rounded" style="background:#f8f8f8;">
							<div class="small text-muted mb-1">Email</div>
							<a href="mailto:{{ $messageContact->email }}" class="fw-semibold" style="color:#E30613;">{{ $messageContact->email }}</a>
						</div>
					</div>
					<div class="col-md-2">
						<div class="p-3 rounded" style="background:#f8f8f8;">
							<div class="small text-muted mb-1">Téléphone</div>
							<div class="fw-semibold">{{ $messageContact->phone ?: '—' }}</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="p-3 rounded" style="background:#f8f8f8;">
							<div class="small text-muted mb-1">Date</div>
							<div class="fw-semibold small">{{ $messageContact->created_at->format('d/m/Y H:i') }}</div>
						</div>
					</div>
				</div>

				<div class="p-4 rounded" style="background:#fff8f8;border-left:4px solid #E30613;">
					<div class="small text-muted mb-2 fw-semibold">Message :</div>
					<p style="white-space:pre-wrap;margin:0;">{{ $messageContact->message }}</p>
				</div>
			</div>
			<div class="card-footer d-flex gap-2">
				<a href="mailto:{{ $messageContact->email }}?subject=Re: {{ $messageContact->subject }}" class="btn btn-primary">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/></svg>
					Répondre par email
				</a>
				<form action="{{ route('admin.messages.destroy', $messageContact) }}" method="POST" onsubmit="return confirm('Supprimer ce message ?')">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-outline-danger">Supprimer</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
