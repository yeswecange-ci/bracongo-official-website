@extends('admin.layouts.app')
@section('title', 'Galerie Footer')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Galerie du footer</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.footer.edit') }}">Footer</a></li>
		<li class="breadcrumb-item active">Galerie</li>
	</ol>
</div>
@endpush
@push('header-actions')
<a href="{{ route('admin.footer-gallery.create') }}" class="btn btn-primary">
	<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
	Ajouter une image
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
	<div class="card-body">
		<div class="row g-3">
			@forelse($images as $img)
			<div class="col-sm-4 col-md-3 col-xl-2">
				<div class="card h-100" style="border:1px solid #eee;">
					<img src="{{ asset($img->image) }}" alt="{{ $img->alt }}" style="height:100px;object-fit:cover;border-radius:8px 8px 0 0;width:100%;">
					<div class="card-body p-2 text-center">
						<div class="small text-muted mb-1">Ordre: <strong>{{ $img->ordre }}</strong></div>
						<div class="d-flex gap-1 justify-content-center">
							<a href="{{ route('admin.footer-gallery.edit', $img) }}" class="btn btn-xs btn-warning">
								<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
							</a>
							<form action="{{ route('admin.footer-gallery.destroy', $img) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-xs btn-danger">
									<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			@empty
			<div class="col-12 text-center py-5 text-muted">
				<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
				<p class="mt-2">Aucune image dans la galerie.</p>
				<a href="{{ route('admin.footer-gallery.create') }}" class="btn btn-sm btn-primary">Ajouter une image</a>
			</div>
			@endforelse
		</div>
	</div>
</div>
@endsection
