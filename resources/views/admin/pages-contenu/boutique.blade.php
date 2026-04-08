@extends('admin.layouts.app')
@section('title', 'Page Boutique')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Boutique</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Page Boutique</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('boutique') }}" target="_blank" class="btn btn-sm btn-outline-primary">
    <i class="bi bi-box-arrow-up-right me-1"></i>Voir la page
</a>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<form action="{{ route('admin.pages.boutique.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2">
                    <span class="a-step-badge">1</span>
                    <h5 class="mb-0">Bannière / Hero</h5>
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <x-admin.image-upload
                            name="hero_image"
                            label="Image de bannière"
                            :value="$page->hero_image ?? 'img/brasserie.jpg'"
                            help="PNG, JPG, GIF, WEBP — max 10 Mo"
                        />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Badge (au-dessus du titre)</label>
                        <input type="text" class="form-control @error('hero_badge') is-invalid @enderror" name="hero_badge" value="{{ old('hero_badge', $page->hero_badge ?? 'Bracongo officiel') }}">
                        @error('hero_badge')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Titre</label>
                        <input type="text" class="form-control @error('hero_titre') is-invalid @enderror" name="hero_titre" value="{{ old('hero_titre', $page->hero_titre ?? 'Boutique') }}">
                        @error('hero_titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control @error('hero_description') is-invalid @enderror" name="hero_description" rows="3">{{ old('hero_description', $page->hero_description ?? 'Retrouvez ici nos produits et accessoires officiels.') }}</textarea>
                        @error('hero_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
