@extends('admin.layouts.app')
@section('title', 'Messages de contact')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Messages de contact</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Messages</li>
	</ol>
</div>
@endpush

@section('header')
@include('admin.layouts.partials.header')
@endsection
@section('sidebar')
@include('admin.layouts.partials.sidebar')
@endsection

@section('content')
@include('admin.layouts.partials.alerts')

@if($nonLus > 0)
<div class="alert alert-warning d-flex align-items-center gap-2 mb-4">
	<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
	<strong>{{ $nonLus }}</strong> message(s) non lu(s)
</div>
@endif

<div class="card">
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover mb-0">
				<thead style="background:#f8f8f8;">
					<tr>
						<th style="width:40px;"></th>
						<th>Expéditeur</th>
						<th>Sujet</th>
						<th>Message</th>
						<th style="width:120px;">Date</th>
						<th class="text-end" style="width:100px;">Actions</th>
					</tr>
				</thead>
				<tbody>
					@forelse($messages as $msg)
					<tr class="{{ $msg->lu ? '' : 'table-warning' }}" style="{{ $msg->lu ? '' : 'font-weight:600;' }}">
						<td class="text-center">
							@if(!$msg->lu)
							<span class="badge badge-danger badge-xs">Non lu</span>
							@endif
						</td>
						<td>
							<div>{{ $msg->name }}</div>
							<div class="small text-muted">{{ $msg->email }}</div>
						</td>
						<td>{{ $msg->subject ?: '—' }}</td>
						<td><span class="small">{{ Str::limit($msg->message, 60) }}</span></td>
						<td class="small text-muted">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
						<td class="text-end">
							<a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-xs btn-primary me-1" title="Lire">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
							</a>
							<form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer ce message ?')">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-xs btn-danger" title="Supprimer">
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
								</button>
							</form>
						</td>
					</tr>
					@empty
					<tr><td colspan="6" class="text-center py-4 text-muted">Aucun message reçu.</td></tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
	@if($messages->hasPages())
	<div class="card-footer">{{ $messages->links() }}</div>
	@endif
</div>
@endsection
