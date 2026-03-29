@extends('admin.layouts.app')
@section('title', 'Hero Slides')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.pages.accueil.edit') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Hero Slides</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Hero Slides</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('admin.hero-slides.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Nouveau slide
</a>
@endpush


@section('content')
@include('admin.layouts.partials.alerts')

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:90px;">Aperçu</th>
                        <th>Chemin image</th>
                        <th>Alt</th>
                        <th class="text-center" style="width:80px;">Ordre</th>
                        <th class="text-center" style="width:100px;">Actif</th>
                        <th class="text-end" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides as $slide)
                    <tr>
                        <td>
                            @if($slide->image)
                                <img src="{{ asset($slide->image) }}" alt="{{ $slide->alt }}" class="a-thumb a-thumb--contain">
                            @else
                                <div class="a-thumb-empty"><i class="bi bi-image"></i></div>
                            @endif
                        </td>
                        <td><code class="small">{{ $slide->image }}</code></td>
                        <td class="text-muted small">{{ $slide->alt }}</td>
                        <td class="text-center"><span class="a-count-badge">{{ $slide->ordre }}</span></td>
                        <td class="text-center">
                            @if($slide->is_active)
                                <span class="a-status a-status--active">Actif</span>
                            @else
                                <span class="a-status a-status--inactive">Inactif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" style="display:contents"
                                      data-bracongo-confirm
                                      data-bc-title="Supprimer ce slide ?"
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
                    <tr><td colspan="6">
                        <div class="a-empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Aucun slide enregistré.</p>
                            <a href="{{ route('admin.hero-slides.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg me-1"></i>Créer le premier
                            </a>
                        </div>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
