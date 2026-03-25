@extends('admin.layouts.app')
@section('title', 'Réseaux sociaux')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.footer.edit') }}">Footer</a></li>
        <li class="breadcrumb-item active">Réseaux sociaux</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Réseaux sociaux</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('admin.reseaux-sociaux.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Nouveau réseau
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
                        <th>Plateforme</th>
                        <th>URL</th>
                        <th class="text-center" style="width:80px;">Ordre</th>
                        <th class="text-center" style="width:100px;">Statut</th>
                        <th class="text-end" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reseaux as $rs)
                    <tr>
                        <td>
                            <span class="badge" style="background:var(--content-bg);color:var(--text-primary);border:1px solid var(--border);text-transform:capitalize">{{ $rs->platform }}</span>
                        </td>
                        <td><a href="{{ $rs->url }}" target="_blank" class="small">{{ Str::limit($rs->url, 50) }}</a></td>
                        <td class="text-center"><span class="a-count-badge">{{ $rs->ordre }}</span></td>
                        <td class="text-center">
                            @if($rs->is_active)
                                <span class="a-status a-status--active">Actif</span>
                            @else
                                <span class="a-status a-status--inactive">Inactif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ action([\App\Http\Controllers\Admin\ReseauSocialController::class, 'edit'], ['reseaux_sociaux' => $rs->id]) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ action([\App\Http\Controllers\Admin\ReseauSocialController::class, 'destroy'], ['reseaux_sociaux' => $rs->id]) }}" method="POST" style="display:contents" onsubmit="return confirm('Supprimer ?')">
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
                            <p>Aucun réseau social configuré.</p>
                            <a href="{{ route('admin.reseaux-sociaux.create') }}" class="btn btn-primary btn-sm">
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
