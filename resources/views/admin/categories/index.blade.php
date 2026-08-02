@extends('admin.layouts.app')
@section('title', 'Catégories de boissons')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Catégories</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Catégories de boissons</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
	<i class="bi bi-plus-lg me-1"></i>Nouvelle catégorie
</a>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<div class="row g-4">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0">{{ $categories->count() }} catégorie(s)</h5>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-hover mb-0 align-middle">
						<thead>
							<tr>
								<th>Nom</th>
								<th>Slug / URL</th>
								<th class="text-center" style="width:100px;">Boissons</th>
								<th class="text-center" style="width:80px;">Ordre</th>
								<th class="text-center" style="width:90px;">Statut</th>
								<th class="text-end" style="width:130px;">Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse($categories as $categorie)
							<tr>
								<td class="fw-semibold">
									{{ $categorie->nom }}
									@if($categorie->estBieres())
									<i class="bi bi-lock ms-1 text-muted" title="Catégorie système : liée à la page dédiée du site"></i>
									@endif
								</td>
								<td>
									<code>/Nos-marques/{{ $categorie->slug }}</code>
								</td>
								<td class="text-center"><span class="a-count-badge">{{ $categorie->boissons_count }}</span></td>
								<td class="text-center"><span class="a-count-badge">{{ $categorie->ordre }}</span></td>
								<td class="text-center">
									@if($categorie->is_active)
									<span class="badge bg-success-subtle text-success">Active</span>
									@else
									<span class="badge bg-secondary-subtle text-secondary">Inactive</span>
									@endif
								</td>
								<td class="text-end">
									<div class="d-flex gap-1 justify-content-end">
										<a href="{{ $categorie->estBieres() ? route('bieres') : route('marque.categorie', $categorie->slug) }}" target="_blank" class="a-action-btn" title="Voir la page publique">
											<i class="bi bi-box-arrow-up-right"></i>
										</a>
										<a href="{{ route('admin.categories.edit', $categorie) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
											<i class="bi bi-pencil"></i>
										</a>
										@unless($categorie->estBieres())
										<form action="{{ route('admin.categories.destroy', $categorie) }}" method="POST" style="display:contents"
										data-bracongo-confirm
										data-bc-title="Supprimer la catégorie « {{ $categorie->nom }} » ?"
										data-bc-icon="warning"
										data-bc-confirm-text="Supprimer">
											@csrf @method('DELETE')
											<button type="submit" class="a-action-btn a-action-btn--danger" title="Supprimer" {{ $categorie->boissons_count > 0 ? 'disabled' : '' }}>
												<i class="bi bi-trash"></i>
											</button>
										</form>
										@endunless
									</div>
								</td>
							</tr>
							@empty
							<tr><td colspan="6">
								<div class="a-empty-state">
									<i class="bi bi-inbox"></i>
									<p>Aucune catégorie enregistrée.</p>
									<a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
										<i class="bi bi-plus-lg me-1"></i>Créer la première
									</a>
								</div>
							</td></tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<p class="small text-muted mt-2 mb-0">
			<i class="bi bi-info-circle me-1"></i>Une catégorie ne peut être supprimée que si aucune boisson ne l'utilise.
			Chaque catégorie possède sa page publique (bannière, recherche, messages) modifiable via « Modifier ».
		</p>
	</div>
</div>
@endsection
