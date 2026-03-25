@extends('admin.layouts.app')
@section('title', 'Message de contact')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.messages.index') }}">Messages</a></li>
        <li class="breadcrumb-item active">Lire</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Message de {{ $messageContact->name }}</h6>
</div>
@endpush
@push('header-actions')
<a href="mailto:{{ $messageContact->email }}?subject=Re: {{ $messageContact->subject }}" class="btn btn-primary me-2">
    <i class="bi bi-reply me-1"></i>Répondre
</a>
<a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">
    <i class="bi bi-arrow-left me-1"></i>Retour
</a>
@endpush


@section('content')
<div class="row justify-content-center">
	<div class="col-xl-8">
		<div class="card">
			<div class="card-header d-flex align-items-center justify-content-between">
				<h5 class="mb-0">{{ $messageContact->subject ?: '(Sans sujet)' }}</h5>
				<span class="{{ $messageContact->lu ? 'a-status a-status--active' : 'a-status a-status--unread' }}">
					{{ $messageContact->lu ? 'Lu' : 'Non lu' }}
				</span>
			</div>
			<div class="card-body">
				<div class="row g-3 mb-4">
					<div class="col-md-4">
						<div class="p-3 rounded" class="a-info-block">
							<div class="small text-muted mb-1">Nom</div>
							<div class="fw-semibold">{{ $messageContact->name }}</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="p-3 rounded" class="a-info-block">
							<div class="small text-muted mb-1">Email</div>
							<a href="mailto:{{ $messageContact->email }}" class="fw-semibold" style="color:#E30613;">{{ $messageContact->email }}</a>
						</div>
					</div>
					<div class="col-md-2">
						<div class="p-3 rounded" class="a-info-block">
							<div class="small text-muted mb-1">Téléphone</div>
							<div class="fw-semibold">{{ $messageContact->phone ?: '—' }}</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="p-3 rounded" class="a-info-block">
							<div class="small text-muted mb-1">Date</div>
							<div class="fw-semibold small">{{ $messageContact->created_at->format('d/m/Y H:i') }}</div>
						</div>
					</div>
				</div>

				<div class="a-message-body">
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
