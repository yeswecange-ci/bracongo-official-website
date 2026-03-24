@extends('admin.layouts.app')
@section('title', 'Marques & boissons')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Marques & boissons</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Marques</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="{{ route('admin.marques.create') }}" class="btn btn-primary">
	<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
	Nouvelle marque
</a>
<a href="{{ route('admin.boissons.create') }}" class="btn btn-outline-primary">
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

<div class="alert alert-light border mb-4" style="border-color:#e8e8e8!important;">
	<p class="mb-2 fw-semibold text-dark">Comment lire cette page</p>
	<ul class="mb-0 small text-muted ps-3">
		<li><strong>Marques</strong> : liste des enseignes (indépendamment du type de produit).</li>
		<li><strong>Boissons</strong> : produits classés par <strong>catégorie</strong> (bières, gazeuses, eaux, énergisantes). C’est la boisson qui porte la catégorie, pas la marque.</li>
		<li>Les pastilles <span class="badge" style="background:#E30613;">N</span> rouges indiquent le <strong>nombre de boissons</strong> enregistrées dans chaque catégorie (bière, gazeuse, etc.).</li>
	</ul>
</div>

{{-- Compteurs par catégorie (boissons) --}}
<div class="row g-3 mb-4">
	@foreach($categories as $key => $label)
	<div class="col-6 col-md-3">
		<div class="card h-100 border-0 shadow-sm">
			<div class="card-body py-3 d-flex justify-content-between align-items-center">
				<span class="small fw-semibold text-muted">{{ $label }}</span>
				<span class="badge rounded-pill px-3 py-2" style="background:#E30613;font-size:0.95rem;">{{ $countsByCategory[$key] ?? 0 }}</span>
			</div>
		</div>
	</div>
	@endforeach
</div>

{{-- Tableau 1 : marques uniquement --}}
<div class="card mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
		<div>
			<h5 class="card-title mb-0">Marques</h5>
			<small class="text-muted">Enseignes — sans regroupement par type de produit</small>
		</div>
		<span class="badge badge-secondary">{{ $marques->count() }} marque(s)</span>
	</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover mb-0">
				<thead style="background:#f8f8f8;">
					<tr>
						<th style="width:70px;">Image</th>
						<th>Nom</th>
						<th>Slug</th>
						<th class="text-center">Boissons liées</th>
						<th class="text-center" style="width:80px;">Ordre</th>
						<th class="text-center" style="width:100px;">Statut</th>
						<th class="text-end" style="width:120px;">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($marques as $marque)
					<tr>
						<td>
							@if($marque->image)
							<img src="{{ asset($marque->image) }}" alt="" style="width:60px;height:45px;object-fit:contain;border-radius:6px;background:#f5f5f5;padding:2px;">
							@else
							<div style="width:60px;height:45px;background:#f0f0f0;border-radius:6px;display:flex;align-items:center;justify-content:center;">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
							</div>
							@endif
						</td>
						<td class="fw-semibold">{{ $marque->nom }}</td>
						<td class="text-muted small">{{ $marque->slug }}</td>
						<td class="text-center">
							<a href="{{ route('admin.marques.index') }}#boissons" class="badge badge-light">{{ $marque->boissons_count }}</a>
						</td>
						<td class="text-center"><span class="badge badge-light">{{ $marque->ordre }}</span></td>
						<td class="text-center">
							@if($marque->is_active)
								<span class="badge badge-success light">Active</span>
							@else
								<span class="badge badge-secondary light">Inactive</span>
							@endif
						</td>
						<td class="text-end">
							<a href="{{ route('admin.marques.edit', $marque) }}" class="btn btn-xs btn-warning me-1">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
							</a>
							<form action="{{ route('admin.marques.destroy', $marque) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cette marque et toutes ses boissons ?')">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-xs btn-danger">
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
								</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

{{-- Tableau 2 : boissons filtrées par catégorie --}}
<div class="card mb-4" id="boissons">
	<div class="card-header py-3">
		<h5 class="card-title mb-1">Boissons par catégorie</h5>
		<small class="text-muted">Filtre sur la catégorie du <strong>produit</strong> (champ éditable sur chaque fiche boisson)</small>
	</div>
	<div class="card-body border-bottom py-3">
		<div class="d-flex flex-wrap align-items-center gap-2">
			<span class="small text-muted me-1">Filtrer :</span>
			<a href="{{ route('admin.marques.index') }}#boissons"
				class="btn btn-sm rounded-pill {{ !$filter ? 'btn-primary' : 'btn-outline-secondary' }}">
				Toutes <span class="badge bg-white text-dark ms-1">{{ $totalBoissons ?? 0 }}</span>
			</a>
			@foreach($categories as $key => $label)
			<a href="{{ route('admin.marques.index', ['categorie_boisson' => $key]) }}#boissons"
				class="btn btn-sm rounded-pill {{ $filter === $key ? 'btn-primary' : 'btn-outline-secondary' }}">
				{{ $label }}
				<span class="badge ms-1" style="background:#E30613;">{{ $countsByCategory[$key] ?? 0 }}</span>
			</a>
			@endforeach
		</div>
	</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover mb-0">
				<thead style="background:#f8f8f8;">
					<tr>
						<th style="width:70px;">Image</th>
						<th>Nom</th>
						<th>Marque</th>
						<th>Catégorie</th>
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
						<td>
							<span class="badge badge-light border text-dark">{{ $categories[$boisson->categorie] ?? $boisson->categorie }}</span>
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
					<tr><td colspan="8" class="text-center py-4 text-muted">Aucune boisson pour ce filtre.</td></tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
