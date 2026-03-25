@extends('admin.layouts.app')
@section('title', 'Navigation')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Navigation</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Navigation du site</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('admin.navigation.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Nouvel item
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
                        <th>Label</th>
                        <th>URL</th>
                        <th>Parent</th>
                        <th class="text-center" style="width:80px;">Ordre</th>
                        <th class="text-center" style="width:100px;">Actif</th>
                        <th class="text-end" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->label }}</td>
                        <td><code class="small">{{ $item->url }}</code></td>
                        <td><span class="text-muted small">—</span></td>
                        <td class="text-center"><span class="a-count-badge">{{ $item->ordre }}</span></td>
                        <td class="text-center">
                            @if($item->is_active)
                                <span class="a-status a-status--active">Actif</span>
                            @else
                                <span class="a-status a-status--inactive">Inactif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.navigation.edit', $item) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.navigation.destroy', $item) }}" method="POST" style="display:contents" onsubmit="return confirm('Supprimer ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="a-action-btn a-action-btn--danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @foreach($item->enfants as $enfant)
                    <tr>
                        <td class="ps-4 text-muted">
                            <i class="bi bi-arrow-return-right me-1 text-muted"></i>{{ $enfant->label }}
                        </td>
                        <td><code class="small">{{ $enfant->url }}</code></td>
                        <td><span class="small text-muted">{{ $item->label }}</span></td>
                        <td class="text-center"><span class="a-count-badge">{{ $enfant->ordre }}</span></td>
                        <td class="text-center">
                            @if($enfant->is_active)
                                <span class="a-status a-status--active">Actif</span>
                            @else
                                <span class="a-status a-status--inactive">Inactif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.navigation.edit', $enfant) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.navigation.destroy', $enfant) }}" method="POST" style="display:contents" onsubmit="return confirm('Supprimer ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="a-action-btn a-action-btn--danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @empty
                    <tr><td colspan="6">
                        <div class="a-empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Aucun item de navigation enregistré.</p>
                            <a href="{{ route('admin.navigation.create') }}" class="btn btn-primary btn-sm">
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
