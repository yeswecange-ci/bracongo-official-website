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


@push('styles')
<style>
.table-navigation-parent-row {
	background-color: #4f5866 !important;
	color: #ffffff !important;
	border-color: #606a78;
}
.table-navigation-parent-row td {
	background-color: #4f5866 !important;
	border-color: rgba(255,255,255,.08);
	vertical-align: middle;
	color: #ffffff !important;
}
.table-navigation-parent-row .a-count-badge {
	background: rgba(255,255,255,.15) !important;
	color: #fff !important;
}
.table-navigation-parent-row code {
	color: #c8d4e8;
	background: rgba(255,255,255,.1);
	padding: 2px 6px;
	border-radius: 4px;
}
.table-hover .table-navigation-parent-row:hover {
	background-color: #5b6574 !important;
	color: #fff;
}
.table-hover .table-navigation-parent-row:hover td {
	background-color: #5b6574 !important;
}
</style>
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
                    <tr class="table-navigation-parent-row">
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
                                <a href="{{ action([\App\Http\Controllers\Admin\NavigationItemController::class, 'edit'], ['navigation' => $item->id]) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ action([\App\Http\Controllers\Admin\NavigationItemController::class, 'destroy'], ['navigation' => $item->id]) }}" method="POST" style="display:contents" onsubmit="return confirm('Supprimer ?')">
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
                                <a href="{{ action([\App\Http\Controllers\Admin\NavigationItemController::class, 'edit'], ['navigation' => $enfant->id]) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ action([\App\Http\Controllers\Admin\NavigationItemController::class, 'destroy'], ['navigation' => $enfant->id]) }}" method="POST" style="display:contents" onsubmit="return confirm('Supprimer ?')">
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
