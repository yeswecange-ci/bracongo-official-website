@extends('admin.layouts.app')
@section('title', 'Paramètres du site')

@push('header-left')
<div class="me-auto">
	<h4 class="card-title">Paramètres du site</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
		<li class="breadcrumb-item active">Paramètres</li>
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
<div class="row">
	<div class="col-xl-8">
		@include('admin.layouts.partials.alerts')

		<div class="card">
			<div class="card-header">
				<h4 class="card-title">
					<svg class="me-2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#E30613" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
					Paramètres globaux
				</h4>
			</div>
			<div class="card-body">
				<form action="{{ route('admin.parametres.update') }}" method="POST">
					@csrf
					@method('PUT')
					<div class="row g-4">
						<div class="col-12">
							<label class="form-label fw-semibold">Logo <span class="text-muted small">(chemin relatif ex: img/LOGO BRACONGO copie 1.png)</span></label>
							<input type="text" class="form-control @error('logo') is-invalid @enderror" name="logo" value="{{ old('logo', $parametres->logo) }}">
							@if($parametres->logo)
								<div class="mt-2">
									<img src="{{ asset($parametres->logo) }}" alt="Logo" style="height:60px;object-fit:contain;border:1px solid #eee;border-radius:8px;padding:4px;">
								</div>
							@endif
							@error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Couleur principale</label>
							<div class="input-group">
								<input type="color" class="form-control form-control-color" name="couleur_principale" value="{{ old('couleur_principale', $parametres->couleur_principale) }}" style="width:60px;">
								<input type="text" class="form-control" value="{{ old('couleur_principale', $parametres->couleur_principale) }}" readonly id="colorText">
							</div>
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Suggestions de recherche <span class="text-muted small">(séparées par des virgules)</span></label>
							<input type="text" class="form-control" name="search_suggestions" value="{{ old('search_suggestions', $parametres->search_suggestions) }}" placeholder="Beaufort Lager,Actualités,Nkoyi">
						</div>
						<div class="col-12 pt-2">
							<button type="submit" class="btn btn-primary">
								<svg class="me-1" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
								Enregistrer
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-xl-4">
		<div class="card">
			<div class="card-header"><h4 class="card-title">Aperçu</h4></div>
			<div class="card-body text-center">
				<img src="{{ asset($parametres->logo ?? 'img/LOGO BRACONGO copie 1.png') }}" alt="Logo" style="height:80px;object-fit:contain;" class="mb-3">
				<div class="badge px-3 py-2" style="background-color:{{ $parametres->couleur_principale }};font-size:1rem;">
					{{ $parametres->couleur_principale }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
document.querySelector('input[type=color]').addEventListener('input', function() {
    document.getElementById('colorText').value = this.value;
});
</script>
@endpush
