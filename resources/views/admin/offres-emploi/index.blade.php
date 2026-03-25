@extends('admin.layouts.app')
@section('title', "Offres d'emploi")

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.pages.carriere.edit') }}">Carrière</a></li>
        <li class="breadcrumb-item active">Offres d'emploi</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Offres d'emploi</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('admin.offres-emploi.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Nouvelle offre
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
                        <th style="width:70px;">Image</th>
                        <th>Titre du poste</th>
                        <th class="text-center" style="width:80px;">Ordre</th>
                        <th class="text-center" style="width:100px;">Statut</th>
                        <th class="text-end" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offres as $offre)
                    <tr>
                        <td>
                            @if($offre->image)
                                <img src="{{ asset($offre->image) }}" alt="" class="a-thumb a-thumb--contain">
                            @else
                                <div class="a-thumb-empty"><i class="bi bi-image"></i></div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $offre->titre }}</div>
                            <div class="small text-muted">{{ Str::limit(strip_tags($offre->description), 60) }}</div>
                        </td>
                        <td class="text-center"><span class="a-count-badge">{{ $offre->ordre }}</span></td>
                        <td class="text-center">
                            @if($offre->is_active)
                                <span class="a-status a-status--active">Active</span>
                            @else
                                <span class="a-status a-status--inactive">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.offres-emploi.edit', ['offres_emploi' => $offre]) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.offres-emploi.destroy', ['offres_emploi' => $offre]) }}" method="POST" style="display:contents" onsubmit="return confirm('Supprimer cette offre ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="a-action-btn a-action-btn--danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5">
                        <div class="a-empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Aucune offre d'emploi enregistrée.</p>
                            <a href="{{ route('admin.offres-emploi.create') }}" class="btn btn-primary btn-sm">
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
