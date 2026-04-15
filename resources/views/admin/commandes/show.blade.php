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

<div class="row g-4 align-items-start a-commande-detail">

    {{-- Colonne principale --}}
    <div class="col-12 col-xl-8">

        {{-- Articles commandés --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header py-3"><h5 class="mb-0">Articles commandés</h5></div>
            <div class="card-body p-0">
                <div class="table-responsive a-commande-detail__table-wrap">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-3">Produit</th>
                                <th scope="col" class="text-center text-nowrap">Qté</th>
                                <th scope="col" class="text-end text-nowrap">Prix unit.</th>
                                <th scope="col" class="text-end text-nowrap pe-3">Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commande->lignes as $ligne)
                            <tr>
                                <td class="ps-3">
                                    <div class="d-flex align-items-center gap-2 gap-sm-3 py-1">
                                        @if($ligne->produit?->image)
                                        <img src="{{ asset($ligne->produit->image) }}" alt="" class="a-thumb a-thumb--contain flex-shrink-0">
                                        @else
                                        <div class="a-thumb-empty flex-shrink-0"><i class="bi bi-box"></i></div>
                                        @endif
                                        <div class="min-w-0">
                                            <div class="fw-semibold small">{{ $ligne->nom_produit }}</div>
                                            @if($ligne->reference_produit)
                                            <div class="text-muted text-break" style="font-size:.72rem">Réf. {{ $ligne->reference_produit }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-nowrap align-middle"><span class="a-count-badge">{{ $ligne->quantite }}</span></td>
                                <td class="text-end small align-middle text-nowrap">
                                    {{ $ligne->prix_unitaire > 0 ? number_format((float)$ligne->prix_unitaire, 0, ',', ' ') . ' CDF' : '—' }}
                                </td>
                                <td class="text-end fw-bold small align-middle pe-3 text-nowrap">
                                    {{ $ligne->sous_total > 0 ? number_format((float)$ligne->sous_total, 0, ',', ' ') . ' CDF' : '—' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold ps-3 py-3">Total</td>
                                <td class="text-end fw-bold pe-3 py-3" style="color:#E30613">
                                    {{ $commande->total > 0 ? number_format((float)$commande->total, 0, ',', ' ') . ' CDF' : '—' }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Notes --}}
        @if($commande->notes)
        <div class="card border-0 shadow-sm">
            <div class="card-header py-3"><h5 class="mb-0">Notes du client</h5></div>
            <div class="card-body py-3">
                <p class="mb-0 text-muted small text-break">{{ $commande->notes }}</p>
            </div>
        </div>
        @endif

    </div>

    {{-- Colonne latérale --}}
    <div class="col-12 col-xl-4">

        {{-- Infos client --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header py-3"><h5 class="mb-0">Client</h5></div>
            <div class="card-body py-3">
                <dl class="row mb-0 small gy-2 gy-sm-1">
                    <dt class="col-12 col-sm-4 text-muted fw-semibold mb-0">Nom</dt>
                    <dd class="col-12 col-sm-8 fw-semibold mb-0 mb-sm-1 text-break">{{ $commande->nom }}</dd>
                    <dt class="col-12 col-sm-4 text-muted fw-semibold mb-0">Email</dt>
                    <dd class="col-12 col-sm-8 mb-0 mb-sm-1 text-break"><a href="mailto:{{ $commande->email }}">{{ $commande->email }}</a></dd>
                    @if($commande->telephone)
                    <dt class="col-12 col-sm-4 text-muted fw-semibold mb-0">Téléphone</dt>
                    <dd class="col-12 col-sm-8 mb-0 mb-sm-1">{{ $commande->telephone }}</dd>
                    @endif
                    @if($commande->adresse)
                    <dt class="col-12 col-sm-4 text-muted fw-semibold mb-0">Adresse</dt>
                    <dd class="col-12 col-sm-8 mb-0 mb-sm-1 text-break">{{ $commande->adresse }}</dd>
                    @endif
                    <dt class="col-12 col-sm-4 text-muted fw-semibold mb-0">Date</dt>
                    <dd class="col-12 col-sm-8 mb-0">{{ $commande->created_at->format('d/m/Y à H:i') }}</dd>
                </dl>
            </div>
        </div>

        {{-- Statut --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header py-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
                <h5 class="mb-0">Statut</h5>
                <span class="badge bg-{{ $commande->statut_color }} rounded-pill">{{ $commande->statut_label }}</span>
            </div>
            <div class="card-body py-3">
                <form action="{{ route('admin.commandes.statut', $commande) }}" method="POST" class="d-grid gap-2">
                    @csrf @method('PATCH')
                    <div>
                        <label for="statut_commande" class="form-label small text-muted mb-1">Changer le statut</label>
                        <select name="statut" id="statut_commande" class="form-select form-select-sm">
                            @foreach($statuts as $key => $label)
                            <option value="{{ $key }}" @selected($commande->statut === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
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
