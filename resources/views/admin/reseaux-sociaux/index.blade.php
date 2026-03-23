@extends('admin.layouts.app')
@section('title', 'Réseaux sociaux')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Réseaux sociaux</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.footer.edit') }}">Footer</a></li>
		<li class="breadcrumb-item active">Réseaux sociaux</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="{{ route('admin.reseaux-sociaux.create') }}" class="btn btn-primary">
	<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
	Nouveau réseau
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
						<th>Plateforme</th>
						<th>URL</th>
						<th class="text-center">Ordre</th>
						<th class="text-center">Statut</th>
						<th class="text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					@forelse($reseaux as $rs)
					<tr>
						<td>
							<span class="badge badge-primary light text-capitalize px-3">{{ $rs->platform }}</span>
						</td>
						<td><a href="{{ $rs->url }}" target="_blank" class="small">{{ Str::limit($rs->url, 50) }}</a></td>
						<td class="text-center"><span class="badge badge-light">{{ $rs->ordre }}</span></td>
						<td class="text-center">
							@if($rs->is_active)
								<span class="badge badge-success light">Actif</span>
							@else
								<span class="badge badge-secondary light">Inactif</span>
							@endif
						</td>
						<td class="text-end">
							<a href="{{ route('admin.reseaux-sociaux.edit', $rs) }}" class="btn btn-xs btn-warning me-1">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
							</a>
							<form action="{{ route('admin.reseaux-sociaux.destroy', $rs) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-xs btn-danger">
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
								</button>
							</form>
						</td>
					</tr>
					@empty
					<tr><td colspan="5" class="text-center py-4 text-muted">Aucun réseau social configuré.</td></tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
