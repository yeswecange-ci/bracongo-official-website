@extends('admin.layouts.app')
@section('title', 'Candidatures')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Candidatures</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Candidatures aux offres d'emploi</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<div class="card border-0 shadow-sm mb-4" style="border-radius:12px">
	<div class="card-body">
		<form method="get" action="{{ route('admin.candidatures-emploi.index') }}" class="row g-3 align-items-end flex-wrap">
			<div class="col-12 col-md-8 col-lg-6">
				<label for="filter-offre" class="form-label fw-semibold mb-1">Filtrer par offre</label>
				<select name="offre" id="filter-offre" class="form-select" onchange="this.form.submit()">
					<option value="">Toutes les offres</option>
					@foreach($offres as $o)
						<option value="{{ $o->id }}" @selected((string)$offreId === (string)$o->id)>{{ $o->titre }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-12 col-md-auto">
				<noscript>
					<button type="submit" class="btn btn-outline-primary">Appliquer</button>
				</noscript>
			</div>
		</form>
	</div>
</div>

<div class="a-msg-list-wrap">
<div class="card border-0 shadow-sm" style="border-radius:12px;overflow:hidden">
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover mb-0">
				<thead>
					<tr>
						<th>Date</th>
						<th>Offre</th>
						<th>Candidat</th>
						<th>Contact</th>
						<th class="text-end" style="min-width:120px;">Actions</th>
					</tr>
				</thead>
				<tbody>
					@forelse($candidatures as $c)
					<tr>
						<td class="small text-muted text-nowrap">{{ $c->created_at->format('d/m/Y H:i') }}</td>
						<td>
							@if($c->offre)
								<a href="{{ route('admin.offres-emploi.edit', $c->offre) }}" class="text-decoration-none">{{ $c->offre->titre }}</a>
							@else
								<span class="text-muted">—</span>
							@endif
						</td>
						<td>
							<strong>{{ $c->prenom }} {{ $c->nom }}</strong>
						</td>
						<td>
							<div class="small">{{ $c->email }}</div>
							@if($c->telephone)
								<div class="small text-muted">{{ $c->telephone }}</div>
							@endif
						</td>
						<td class="text-end">
							<div class="d-flex gap-1 justify-content-end flex-wrap">
								<a href="{{ route('admin.candidatures-emploi.show', $c) }}" class="a-action-btn a-action-btn--view" title="Voir">
									<i class="bi bi-eye"></i>
								</a>
								<a href="{{ route('admin.candidatures-emploi.cv', $c) }}" class="a-action-btn a-action-btn--view" title="Télécharger le CV">
									<i class="bi bi-file-earmark-arrow-down"></i>
								</a>
							</div>
						</td>
					</tr>
					@empty
					<tr><td colspan="5">
						<div class="a-empty-state">
							<i class="bi bi-inbox"></i>
							<p>Aucune candidature pour le moment.</p>
						</div>
					</td></tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
	@if($candidatures->hasPages())
	<div class="card-footer bg-transparent border-0 pt-0">
		{{ $candidatures->links() }}
	</div>
	@endif
</div>
</div>
@endsection
