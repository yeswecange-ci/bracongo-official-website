@extends('admin.layouts.app')
@section('title', 'Page Welcome')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Page Welcome</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Page Welcome</h6>
</div>
@endpush
@push('header-actions')
<a href="/" target="_blank" class="btn btn-sm btn-outline-primary">
    <i class="bi bi-box-arrow-up-right me-1"></i>Voir la page
</a>
@endpush


@section('content')
<div class="row">
	<div class="col-xl-8">
		@include('admin.layouts.partials.alerts')
		<div class="card">
			<div class="card-header"><h5 class="mb-0">Contenu de la page de garde</h5></div>
			<div class="card-body">
				<form action="{{ route('admin.pages.welcome.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="row g-4">
						<div class="col-12">
							<x-admin.image-upload name="fond_image" label="Image de fond" :value="$page->fond_image ?? null" help="PNG, JPG, GIF — max 2 Mo" />
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Titre principal <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre', $page->titre) }}">
							@error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Texte d'avertissement alcool <span class="text-danger">*</span></label>
							<textarea class="form-control @error('texte_avertissement') is-invalid @enderror" name="texte_avertissement" rows="3">{{ old('texte_avertissement', $page->texte_avertissement) }}</textarea>
							@error('texte_avertissement')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Bouton "Majeur" <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('btn_majeur_texte') is-invalid @enderror" name="btn_majeur_texte" value="{{ old('btn_majeur_texte', $page->btn_majeur_texte) }}">
							@error('btn_majeur_texte')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-md-6">
							<label class="form-label fw-semibold">Bouton "Mineur" <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('btn_mineur_texte') is-invalid @enderror" name="btn_mineur_texte" value="{{ old('btn_mineur_texte', $page->btn_mineur_texte) }}">
							@error('btn_mineur_texte')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Message de refus (mineur) <span class="text-danger">*</span></label>
							<input type="text" class="form-control @error('message_refus') is-invalid @enderror" name="message_refus" value="{{ old('message_refus', $page->message_refus) }}">
							@error('message_refus')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-12">
							<label class="form-label fw-semibold">Mention légale (bas de page) <span class="text-danger">*</span></label>
							<textarea class="form-control @error('mention_legale') is-invalid @enderror" name="mention_legale" rows="2" maxlength="500">{{ old('mention_legale', $page->mention_legale) }}</textarea>
							<small class="text-muted">Texte type « abus d'alcool », affiché sous les boutons.</small>
							@error('mention_legale')<div class="invalid-feedback">{{ $message }}</div>@enderror
						</div>
						<div class="col-12 pt-2">
							<button type="submit" class="btn btn-primary">
							<i class="bi bi-floppy me-1"></i>Enregistrer
						</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-xl-4">
		<div class="card">
			<div class="card-header"><h5 class="mb-0">Aperçu</h5></div>
			<div class="card-body">
				<div class="p-3 rounded text-center" style="background:rgba(227,6,19,.06);border:1px dashed #E30613;">
					<p class="fw-bold mb-2" style="color:#E30613;">{{ $page->titre }}</p>
					<p class="small text-muted mb-3">{{ $page->texte_avertissement }}</p>
					<div class="d-flex gap-2 justify-content-center flex-wrap">
						<span class="btn btn-sm" style="background:#E30613;color:#fff;border-radius:999px;">{{ $page->btn_majeur_texte }}</span>
						<span class="btn btn-sm btn-outline-secondary" style="border-radius:999px;">{{ $page->btn_mineur_texte }}</span>
					</div>
					<p class="small text-muted fst-italic mt-3 mb-0">{{ Str::limit($page->mention_legale ?? '', 120) }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
