@extends('admin.layouts.app')
@section('title', 'Hero Slides')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Hero Slides</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.pages.accueil.edit') }}">Accueil</a></li>
		<li class="breadcrumb-item active">Hero Slides</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="{{ route('admin.hero-slides.create') }}" class="btn btn-primary">
	<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
	Nouveau slide
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
						<th style="width:80px;">Aperçu</th>
						<th>Image</th>
						<th>Texte alt</th>
						<th class="text-center">Ordre</th>
						<th class="text-center">Actif</th>
						<th class="text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					@forelse($slides as $slide)
					<tr>
						<td><img src="{{ asset($slide->image) }}" alt="{{ $slide->alt }}" style="width:70px;height:45px;object-fit:cover;border-radius:6px;"></td>
						<td><code class="small">{{ $slide->image }}</code></td>
						<td>{{ $slide->alt }}</td>
						<td class="text-center"><span class="badge badge-light">{{ $slide->ordre }}</span></td>
						<td class="text-center">
							@if($slide->is_active)
								<span class="badge badge-success light">Actif</span>
							@else
								<span class="badge badge-secondary light">Inactif</span>
							@endif
						</td>
						<td class="text-end">
							<a href="{{ route('admin.hero-slides.edit', $slide) }}" class="btn btn-xs btn-warning me-1">
								<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
							</a>
							<form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer ce slide ?')">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-xs btn-danger">
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
								</button>
							</form>
						</td>
					</tr>
					@empty
					<tr><td colspan="6" class="text-center py-4 text-muted">Aucun slide. <a href="{{ route('admin.hero-slides.create') }}">Ajouter le premier</a></td></tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
