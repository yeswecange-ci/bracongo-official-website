@extends('admin.layouts.app')
@section('title', 'Boissons')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.marques.index') }}">Marques</a></li>
        <li class="breadcrumb-item active">Boissons</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Boissons</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('admin.boissons.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Nouvelle boisson
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
                        <th>Nom</th>
                        <th>Marque</th>
                        <th>Type</th>
                        <th class="text-center" style="width:80px;">Ordre</th>
                        <th class="text-center" style="width:100px;">Statut</th>
                        <th class="text-end" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($boissons as $boisson)
                    <tr>
                        <td>
                            @if($boisson->image)
                                <img src="{{ asset($boisson->image) }}" alt="" class="a-thumb a-thumb--contain">
                            @else
                                <div class="a-thumb-empty"><i class="bi bi-image"></i></div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $boisson->nom }}</div>
                            <div class="small text-muted">{{ $boisson->slogan }}</div>
                        </td>
                        <td>
                            @if($boisson->marque)
                            <span class="badge" style="background:var(--content-bg);color:var(--text-secondary);border:1px solid var(--border);font-size:.72rem">{{ $boisson->marque->nom }}</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $boisson->type }}</td>
                        <td class="text-center"><span class="a-count-badge">{{ $boisson->ordre }}</span></td>
                        <td class="text-center">
                            @if($boisson->is_active)
                                <span class="a-status a-status--active">Active</span>
                            @else
                                <span class="a-status a-status--inactive">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.boissons.edit', $boisson) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.boissons.destroy', $boisson) }}" method="POST" style="display:contents"
                                      data-bracongo-confirm
                                      data-bc-title="Supprimer cette boisson ?"
                                      data-bc-text="Cette action est irréversible."
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
                    <tr><td colspan="7">
                        <div class="a-empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Aucune boisson enregistrée.</p>
                            <a href="{{ route('admin.boissons.create') }}" class="btn btn-primary btn-sm">
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
