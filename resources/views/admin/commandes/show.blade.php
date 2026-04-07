@extends('admin.layouts.app')
@section('title', 'Commande ' . $commande->reference)

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.commandes.index') }}">Commandes</a></li>
        <li class="breadcrumb-item active">{{ $commande->reference }}</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">{{ $commande->reference }}</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<div class="row g-4">

    {{-- Colonne principale --}}
    <div class="col-xl-8">

        {{-- Articles commandés --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header"><h5>Articles commandés</h5></div>
            <div class="card-body p-0">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th class="text-center">Qté</th>
                            <th class="text-end">Prix unit.</th>
                            <th class="text-end">Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commande->lignes as $ligne)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if($ligne->produit?->image)
                                    <img src="{{ asset($ligne->produit->image) }}" alt="" class="a-thumb a-thumb--contain">
                                    @else
                                    <div class="a-thumb-empty"><i class="bi bi-box"></i></div>
                                    @endif
                                    <div>
                                        <div class="fw-semibold small">{{ $ligne->nom_produit }}</div>
                                        @if($ligne->reference_produit)
                                        <div class="text-muted" style="font-size:.72rem">Réf. {{ $ligne->reference_produit }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><span class="a-count-badge">{{ $ligne->quantite }}</span></td>
                            <td class="text-end small">
                                {{ $ligne->prix_unitaire > 0 ? number_format((float)$ligne->prix_unitaire, 0, ',', ' ') . ' CDF' : '—' }}
                            </td>
                            <td class="text-end fw-bold small">
                                {{ $ligne->sous_total > 0 ? number_format((float)$ligne->sous_total, 0, ',', ' ') . ' CDF' : '—' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <td colspan="3" class="text-end fw-bold">Total</td>
                            <td class="text-end fw-bold" style="color:#E30613">
                                {{ $commande->total > 0 ? number_format((float)$commande->total, 0, ',', ' ') . ' CDF' : '—' }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Notes --}}
        @if($commande->notes)
        <div class="card border-0 shadow-sm">
            <div class="card-header"><h5>Notes du client</h5></div>
            <div class="card-body">
                <p class="mb-0 text-muted small">{{ $commande->notes }}</p>
            </div>
        </div>
        @endif

    </div>

    {{-- Colonne latérale --}}
    <div class="col-xl-4">

        {{-- Infos client --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header"><h5>Client</h5></div>
            <div class="card-body">
                <dl class="row mb-0 small">
                    <dt class="col-5 text-muted fw-semibold">Nom</dt>
                    <dd class="col-7 fw-semibold">{{ $commande->nom }}</dd>
                    <dt class="col-5 text-muted fw-semibold">Email</dt>
                    <dd class="col-7"><a href="mailto:{{ $commande->email }}">{{ $commande->email }}</a></dd>
                    @if($commande->telephone)
                    <dt class="col-5 text-muted fw-semibold">Téléphone</dt>
                    <dd class="col-7">{{ $commande->telephone }}</dd>
                    @endif
                    @if($commande->adresse)
                    <dt class="col-5 text-muted fw-semibold">Adresse</dt>
                    <dd class="col-7">{{ $commande->adresse }}</dd>
                    @endif
                    <dt class="col-5 text-muted fw-semibold">Date</dt>
                    <dd class="col-7">{{ $commande->created_at->format('d/m/Y à H:i') }}</dd>
                </dl>
            </div>
        </div>

        {{-- Statut --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Statut</h5>
                <span class="badge bg-{{ $commande->statut_color }} rounded-pill">{{ $commande->statut_label }}</span>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.commandes.statut', $commande) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <select name="statut" class="form-select form-select-sm">
                            @foreach($statuts as $key => $label)
                            <option value="{{ $key }}" @selected($commande->statut === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-check-lg me-1"></i>Mettre à jour
                    </button>
                </form>

                <hr class="my-3">

                <form action="{{ route('admin.commandes.destroy', $commande) }}" method="POST"
                      data-bracongo-confirm
                      data-bc-title="Supprimer cette commande ?"
                      data-bc-confirm-text="Supprimer">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                        <i class="bi bi-trash me-1"></i>Supprimer la commande
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
