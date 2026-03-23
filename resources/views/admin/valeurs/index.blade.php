@extends('admin.layouts.app')
@section('title', 'Valeurs PREMIERS')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Valeurs PREMIERS</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.pages.histoire.edit') }}">Notre Histoire</a></li>
		<li class="breadcrumb-item active">Valeurs</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="{{ route('admin.valeurs.create') }}" class="btn btn-primary">
	<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
	Nouvelle valeur
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

<div class="row g-4">
	{{-- Aperçu visuel --}}
	<div class="col-12">
		<div class="card">
			<div class="card-header"><h4 class="card-title">Aperçu — Grille PREMIERS</h4></div>
			<div class="card-body">
				<div class="d-flex flex-wrap gap-2">
					@foreach($valeurs as $v)
					<div class="text-center p-3 rounded" style="background:#E30613;color:#fff;min-width:90px;">
						<div style="font-size:1.8rem;font-weight:800;">{{ $v->lettre }}</div>
						<div style="font-size:.65rem;line-height:1.2;">{{ $v->description }}</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	{{-- Table de gestion --}}
	<div class="col-12">
		<div class="card">
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-hover mb-0">
						<thead style="background:#f8f8f8;">
							<tr>
								<th style="width:60px;">Lettre</th>
								<th>Description</th>
								<th class="text-center" style="width:80px;">Ordre</th>
								<th class="text-end">Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse($valeurs as $valeur)
							<tr>
								<td>
									<div class="d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#E30613;color:#fff;border-radius:8px;font-size:1.2rem;font-weight:800;">
										{{ $valeur->lettre }}
									</div>
								</td>
								<td class="fw-semibold">{{ $valeur->description }}</td>
								<td class="text-center"><span class="badge badge-light">{{ $valeur->ordre }}</span></td>
								<td class="text-end">
									<a href="{{ route('admin.valeurs.edit', $valeur) }}" class="btn btn-xs btn-warning me-1">
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
									</a>
									<form action="{{ route('admin.valeurs.destroy', $valeur) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cette valeur ?')">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-xs btn-danger">
											<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
										</button>
									</form>
								</td>
							</tr>
							@empty
							<tr><td colspan="4" class="text-center py-4 text-muted">Aucune valeur.</td></tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
