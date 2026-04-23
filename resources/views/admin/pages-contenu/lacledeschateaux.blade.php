@extends('admin.layouts.app')
@section('title', 'Page Clé des Châteaux')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Clé des Châteaux</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Page Clé des Châteaux</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('lacledeschateaux') }}" target="_blank" class="btn btn-sm btn-outline-primary">
    <i class="bi bi-box-arrow-up-right me-1"></i>Voir la page
</a>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<form action="{{ route('admin.pages.lacledeschateaux.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2">
                    <span class="a-step-badge">1</span>
                    <h5 class="mb-0">Hero & contenu principal</h5>
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <x-admin.image-upload
                            name="hero_image"
                            label="Image de bannière"
                            :value="$page->hero_image ?? 'img/brasserie.webp'"
                            help="PNG, JPG, GIF, WEBP — max 10 Mo"
                        />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Titre (H1)</label>
                        <input type="text" class="form-control @error('hero_titre') is-invalid @enderror" name="hero_titre" value="{{ old('hero_titre', $page->hero_titre) }}">
                        @error('hero_titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Paragraphe 1</label>
                        <textarea class="form-control @error('paragraphe_1') is-invalid @enderror" name="paragraphe_1" rows="4">{{ old('paragraphe_1', $page->paragraphe_1) }}</textarea>
                        @error('paragraphe_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Paragraphe 2</label>
                        <textarea class="form-control @error('paragraphe_2') is-invalid @enderror" name="paragraphe_2" rows="4">{{ old('paragraphe_2', $page->paragraphe_2) }}</textarea>
                        @error('paragraphe_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2">
                    <span class="a-step-badge">2</span>
                    <h5 class="mb-0">Coordonnées (bloc hero)</h5>
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Horaire</label>
                        <input type="text" class="form-control" name="horaire" value="{{ old('horaire', $page->horaire) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Téléphone</label>
                        <input type="text" class="form-control" name="telephone" value="{{ old('telephone', $page->telephone) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $page->email) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Adresse</label>
                        <textarea class="form-control" name="adresse" rows="2">{{ old('adresse', $page->adresse) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2">
                    <span class="a-step-badge">3</span>
                    <h5 class="mb-0">Bouton « En savoir plus » (lien externe)</h5>
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Libellé du bouton</label>
                        <input type="text" class="form-control" name="cta_libelle" value="{{ old('cta_libelle', $page->cta_libelle ?? 'En savoir plus') }}">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">URL complète (https://…)</label>
                        <input type="text" class="form-control @error('cta_url') is-invalid @enderror" name="cta_url" value="{{ old('cta_url', $page->cta_url) }}" placeholder="https://bracongo.cd/lacledeschateaux/">
                        @error('cta_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Si vide, le bouton n’apparaît pas sur le site public.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2">
                    <span class="a-step-badge">4</span>
                    <h5 class="mb-0">Sections sous le hero (optionnel)</h5>
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Titre — Sélection du mois</label>
                        <input type="text" class="form-control" name="selection_titre" value="{{ old('selection_titre', $page->selection_titre) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Titre — Nos services</label>
                        <input type="text" class="form-control" name="services_titre" value="{{ old('services_titre', $page->services_titre) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Texte — Sélection du mois</label>
                        <textarea class="form-control" name="selection_texte" rows="3">{{ old('selection_texte', $page->selection_texte) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Contenu HTML — Nos services <x-admin.html-info /></label>
                        <textarea class="form-control font-monospace small" name="services_html" rows="10">{{ old('services_html', $page->services_html) }}</textarea>
                        <small class="text-muted">HTML autorisé (listes, titres). Prévisualisez sur la page publique.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 pb-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-floppy me-1"></i>Enregistrer
            </button>
        </div>
    </div>
</form>
@endsection
