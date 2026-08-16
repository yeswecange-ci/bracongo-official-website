@extends('admin.layouts.app')
@section('title', 'FAQ')

@push('header-left')
<div>
	<nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">FAQ</li>
	</ol></nav>
	<h6 class="a-topbar-page-title">Foire aux questions</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('faq') }}" target="_blank" class="btn btn-outline-secondary btn-sm">
	<i class="bi bi-box-arrow-up-right me-1"></i>Voir la page
</a>
<a href="{{ route('admin.faq.sections.create') }}" class="btn btn-outline-primary btn-sm">
	<i class="bi bi-folder-plus me-1"></i>Nouvelle rubrique
</a>
<a href="{{ route('admin.faq.questions.create') }}" class="btn btn-primary btn-sm">
	<i class="bi bi-plus-lg me-1"></i>Nouvelle question
</a>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<div class="row g-4">
	<div class="col-12">

		@forelse($sections as $section)
		<div class="card mb-4">
			<div class="card-header d-flex flex-wrap gap-2 justify-content-between align-items-center">
				<h5 class="mb-0 d-flex align-items-center gap-2">
					<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-danger">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $section->iconePath() }}"/>
					</svg>
					{{ $section->titre }}
					@if($section->is_active)
					<span class="badge bg-success-subtle text-success">Visible</span>
					@else
					<span class="badge bg-secondary-subtle text-secondary">Masquée</span>
					@endif
					<span class="a-count-badge" title="Ordre d'affichage">#{{ $section->ordre }}</span>
				</h5>
				<div class="d-flex gap-1">
					<a href="{{ route('admin.faq.questions.create', ['section' => $section->id]) }}" class="a-action-btn" title="Ajouter une question dans cette rubrique">
						<i class="bi bi-plus-lg"></i>
					</a>
					<a href="{{ route('admin.faq.sections.edit', $section) }}" class="a-action-btn a-action-btn--edit" title="Modifier la rubrique">
						<i class="bi bi-pencil"></i>
					</a>
					<form action="{{ route('admin.faq.sections.destroy', $section) }}" method="POST" style="display:contents"
						data-bracongo-confirm
						data-bc-title="Supprimer la rubrique « {{ $section->titre }} » ?"
						data-bc-text="Ses {{ $section->questions->count() }} question(s) seront également supprimées."
						data-bc-icon="warning"
						data-bc-confirm-text="Supprimer">
						@csrf @method('DELETE')
						<button type="submit" class="a-action-btn a-action-btn--danger" title="Supprimer la rubrique">
							<i class="bi bi-trash"></i>
						</button>
					</form>
				</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-hover mb-0 align-middle">
						<thead>
							<tr>
								<th style="width:60px;" class="text-center">Ordre</th>
								<th>Question</th>
								<th class="text-center" style="width:90px;">Statut</th>
								<th class="text-end" style="width:100px;">Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse($section->questions as $question)
							<tr>
								<td class="text-center"><span class="a-count-badge">{{ $question->ordre }}</span></td>
								<td>
									<div class="fw-semibold">{{ $question->question }}</div>
									<div class="small text-muted">{{ Str::limit($question->reponse, 140) }}</div>
								</td>
								<td class="text-center">
									@if($question->is_active)
									<span class="badge bg-success-subtle text-success">Visible</span>
									@else
									<span class="badge bg-secondary-subtle text-secondary">Masquée</span>
									@endif
								</td>
								<td class="text-end">
									<div class="d-flex gap-1 justify-content-end">
										<a href="{{ route('admin.faq.questions.edit', $question) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
											<i class="bi bi-pencil"></i>
										</a>
										<form action="{{ route('admin.faq.questions.destroy', $question) }}" method="POST" style="display:contents"
											data-bracongo-confirm
											data-bc-title="Supprimer cette question ?"
											data-bc-icon="warning"
											data-bc-confirm-text="Supprimer">
											@csrf @method('DELETE')
											<button type="submit" class="a-action-btn a-action-btn--danger" title="Supprimer">
												<i class="bi bi-trash"></i>
											</button>
										</form>
									</div>
								</td>
							</tr>
							@empty
							<tr><td colspan="4">
								<div class="a-empty-state">
									<i class="bi bi-question-circle"></i>
									<p>Aucune question dans cette rubrique.</p>
									<a href="{{ route('admin.faq.questions.create', ['section' => $section->id]) }}" class="btn btn-primary btn-sm">
										<i class="bi bi-plus-lg me-1"></i>Ajouter une question
									</a>
								</div>
							</td></tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
		@empty
		<div class="card">
			<div class="card-body">
				<div class="a-empty-state">
					<i class="bi bi-inbox"></i>
					<p>Aucune rubrique enregistrée : la page FAQ du site est vide.</p>
					<a href="{{ route('admin.faq.sections.create') }}" class="btn btn-primary btn-sm">
						<i class="bi bi-plus-lg me-1"></i>Créer la première rubrique
					</a>
				</div>
			</div>
		</div>
		@endforelse

		<p class="small text-muted mt-2 mb-0">
			<i class="bi bi-info-circle me-1"></i>Les rubriques et les questions s'affichent sur le site par ordre croissant
			(0 en premier). Une rubrique ou une question « masquée » reste enregistrée ici mais disparaît de la page publique.
		</p>
	</div>
</div>
@endsection
