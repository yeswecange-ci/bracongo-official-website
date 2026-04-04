@extends('admin.layouts.app')
@section('title', 'Valeurs PREMIERS')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.pages.histoire.edit') }}">Notre Histoire</a></li>
        <li class="breadcrumb-item active">Valeurs</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Valeurs PREMIERS</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('admin.valeurs.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Nouvelle valeur
</a>
@endpush


@section('content')
@include('admin.layouts.partials.alerts')

<div class="row g-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Aperçu — Grille PREMIERS</h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    @foreach($valeurs as $v)
                    <div class="text-center p-3 rounded" style="background:#E30613;color:#fff;min-width:90px;">
                        <div style="font-size:1.8rem;font-weight:800;">{{ $v->lettre }}</div>
                        <div style="font-size:.65rem;line-height:1.2;">{{ $v->description }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width:60px;">Lettre</th>
                                <th>Description</th>
                                <th class="text-center" style="width:80px;">Ordre</th>
                                <th class="text-end" style="width:120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($valeurs as $valeur)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#E30613;color:#fff;border-radius:8px;font-size:1.2rem;font-weight:800;">
                                        {{ $valeur->lettre }}
                                    </div>
                                </td>
                                <td class="fw-semibold">{{ $valeur->description }}</td>
                                <td class="text-center"><span class="a-count-badge">{{ $valeur->ordre }}</span></td>
                                <td class="text-end">
                                    <div class="d-flex gap-1 justify-content-end">
                                        <a href="{{ route('admin.valeurs.edit', $valeur) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.valeurs.destroy', $valeur) }}" method="POST" style="display:contents"
                                        data-bracongo-confirm
                                        data-bc-title="Supprimer cette valeur ?"
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
                                    <i class="bi bi-inbox"></i>
                                    <p>Aucune valeur enregistrée.</p>
                                    <a href="{{ route('admin.valeurs.create') }}" class="btn btn-primary btn-sm">
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
    </div>
</div>
@endsection
