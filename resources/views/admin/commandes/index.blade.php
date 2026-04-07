@extends('admin.layouts.app')
@section('title', 'Commandes boutique')

@push('header-left')
<div>
    <h6 class="a-topbar-page-title">Commandes boutique</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

{{-- Statistiques rapides --}}
<div class="row g-3 mb-4">
    @foreach(App\Models\Commande::$statuts as $key => $label)
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card border-0 shadow-sm text-center py-3">
            <div class="fw-bold fs-4">{{ $counts[$key] ?? 0 }}</div>
            <div class="small text-muted">{{ $label }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- Filtres --}}
<form method="GET" class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm"
                       placeholder="Rechercher par référence, nom, email…">
            </div>
            <div class="col-md-4">
                <select name="statut" class="form-select form-select-sm">
                    <option value="">Tous les statuts</option>
                    @foreach($statuts as $key => $label)
                    <option value="{{ $key }}" @selected(request('statut') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm flex-fill">Filtrer</button>
                @if(request()->hasAny(['q','statut']))
                <a href="{{ route('admin.commandes.index') }}" class="btn btn-outline-secondary btn-sm">✕</a>
                @endif
            </div>
        </div>
    </div>
</form>

{{-- Tableau --}}
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Client</th>
                        <th>Articles</th>
                        <th class="text-end">Total</th>
                        <th class="text-center">Statut</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commandes as $cmd)
                    <tr>
                        <td><span class="fw-bold text-bracongo small">{{ $cmd->reference }}</span></td>
                        <td>
                            <div class="fw-semibold small">{{ $cmd->nom }}</div>
                            <div class="text-muted" style="font-size:.75rem">{{ $cmd->email }}</div>
                        </td>
                        <td><span class="a-count-badge">{{ $cmd->lignes->count() }}</span></td>
                        <td class="text-end fw-bold small">
                            {{ $cmd->total > 0 ? number_format((float)$cmd->total, 0, ',', ' ') . ' CDF' : '—' }}
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $cmd->statut_color }} rounded-pill">{{ $cmd->statut_label }}</span>
                        </td>
                        <td class="small text-muted">{{ $cmd->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.commandes.show', $cmd) }}"
                                   class="a-action-btn a-action-btn--edit" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.commandes.destroy', $cmd) }}" method="POST" style="display:contents"
                                      data-bracongo-confirm
                                      data-bc-title="Supprimer cette commande ?"
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
                            <i class="bi bi-bag"></i>
                            <p>Aucune commande enregistrée.</p>
                        </div>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($commandes->hasPages())
<div class="mt-4">{{ $commandes->links() }}</div>
@endif

@endsection
