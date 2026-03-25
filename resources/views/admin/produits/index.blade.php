@extends('admin.layouts.app')
@section('title', 'Produits')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Produits</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Produits <small class="text-muted fw-normal">(Goodies & Merchandising)</small></h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('admin.produits.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Nouveau produit
</a>
@endpush


@section('content')
@include('admin.layouts.partials.alerts')

<div class="alert alert-info alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
    <i class="bi bi-info-circle-fill"></i>
    <div>Cette section est <strong>réservée au back-office</strong>. Les produits (goodies, articles) ne sont pas visibles sur le site client pour l'instant.</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:70px;">Image</th>
                        <th>Nom</th>
                        <th>Référence</th>
                        <th class="text-end">Prix</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center" style="width:80px;">Ordre</th>
                        <th class="text-center" style="width:100px;">Statut</th>
                        <th class="text-end" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produits as $produit)
                    <tr>
                        <td>
                            @if($produit->image)
                                <img src="{{ asset($produit->image) }}" alt="" class="a-thumb a-thumb--contain">
                            @else
                                <div class="a-thumb-empty"><i class="bi bi-image"></i></div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $produit->nom }}</div>
                            <div class="small text-muted">{{ $produit->slug }}</div>
                        </td>
                        <td class="text-muted small">{{ $produit->reference ?? '—' }}</td>
                        <td class="text-end fw-semibold">{{ $produit->prix ? number_format($produit->prix, 2) . ' CDF' : '—' }}</td>
                        <td class="text-center">{{ $produit->stock ?? 0 }}</td>
                        <td class="text-center"><span class="a-count-badge">{{ $produit->ordre }}</span></td>
                        <td class="text-center">
                            @if($produit->is_active)
                                <span class="a-status a-status--active">Actif</span>
                            @else
                                <span class="a-status a-status--inactive">Inactif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.produits.edit', $produit) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.produits.destroy', $produit) }}" method="POST" style="display:contents" onsubmit="return confirm('Supprimer ce produit ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="a-action-btn a-action-btn--danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8">
                        <div class="a-empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Aucun produit enregistré.</p>
                            <a href="{{ route('admin.produits.create') }}" class="btn btn-primary btn-sm">
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
