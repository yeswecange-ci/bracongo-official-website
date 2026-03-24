@extends('admin.layouts.app')
@section('title', 'Boissons')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Boissons</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.marques.index') }}">Marques</a></li>
		<li class="breadcrumb-item active">Boissons</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="{{ route('admin.boissons.create') }}" class="btn btn-primary">
	<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
	Nouvelle boisson
</a>
@endpush

@section('header')
@include('admin.layouts.partials.header')
@endsection
@section('sidebar')
@include('admin.layouts.partials.sidebar')
@endsection

@section('content')
@include('admin.layouts.partials.alerts')

<div class="card">
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover mb-0">
				<thead style="background:#f8f8f8;">
					<tr>
						<th style="width:70px;">Image</th>
						<th>Nom</th>
						<th>Marque</th>
						<th>Type</th>
						<th class="text-center" style="width:80px;">Ordre</th>
						<th class="text-center" style="width:100px;">Statut</th>
						<th class="text-end" style="width:120px;">Actions</th>
					</tr>
				</thead>
				<tbody>
					@forelse($boissons as $boisson)
					<tr>
						<td>
							@if($boisson->image)
							<img src="{{ asset($boisson->image) }}" alt="" style="width:60px;height:45px;object-fit:contain;border-radius:6px;background:#f5f5f5;padding:2px;">
							@else
							<div style="width:60px;height:45px;background:#f0f0f0;border-radius:6px;display:flex;align-items:center;justify-content:center;">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
							</div>
							@endif
						</td>
						<td>
							<div class="fw-semibold">{{ $boisson->nom }}</div>
							<div class="small text-muted">{{ $boisson->slogan }}</div>
						</td>
						<td>
							@if($boisson->marque)
							<span class="badge badge-light">{{ $boisson->marque->nom }}</span>
							@endif
						</td>
						<td class="small text-muted">{{ $boisson->type }}</td>
						<td class="text-center"><span class="badge badge-light">{{ $boisson->ordre }}</span></td>
						<td class="text-center">
							@if($boisson->is_active)
								<span class="badge badge-success light">Active</span>
							@else
								<span class="badge badge-secondary light">Inactive</span>
							@endif
						</td>
						<td class="text-end">
							<a href="{{ route('admin.boissons.edit', $boisson) }}" class="btn btn-xs btn-warning me-1">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
							</a>
							<form action="{{ route('admin.boissons.destroy', $boisson) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cette boisson ?')">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-xs btn-danger">
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
								</button>
							</form>
						</td>
					</tr>
					@empty
					<tr><td colspan="7" class="text-center py-4 text-muted">Aucune boisson enregistrée.</td></tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
