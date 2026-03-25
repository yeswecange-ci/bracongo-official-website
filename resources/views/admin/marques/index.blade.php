@extends('admin.layouts.app')
@section('title', 'Marques')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Marques</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Marques</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('admin.marques.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Nouvelle marque
</a>
@endpush


@section('content')
@include('admin.layouts.partials.alerts')

@php
$categories = \App\Models\Marque::categories();
$grouped = $marques->groupBy('categorie');
@endphp

@foreach($categories as $key => $label)
@if($grouped->has($key))
<div class="card mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $label }}</h5>
        <span class="a-count-badge">{{ $grouped[$key]->count() }}</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:70px;">Image</th>
                        <th>Nom</th>
                        <th>Slug</th>
                        <th class="text-center">Boissons</th>
                        <th class="text-center" style="width:80px;">Ordre</th>
                        <th class="text-center" style="width:100px;">Statut</th>
                        <th class="text-end" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grouped[$key] as $marque)
                    <tr>
                        <td>
                            @if($marque->image)
                                <img src="{{ asset($marque->image) }}" alt="" class="a-thumb a-thumb--contain">
                            @else
                                <div class="a-thumb-empty"><i class="bi bi-image"></i></div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $marque->nom }}</td>
                        <td class="text-muted small">{{ $marque->slug }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.boissons.index', ['marque_id' => $marque->id]) }}" class="a-count-badge text-decoration-none">{{ $marque->boissons_count }}</a>
                        </td>
                        <td class="text-center"><span class="a-count-badge">{{ $marque->ordre }}</span></td>
                        <td class="text-center">
                            @if($marque->is_active)
                                <span class="a-status a-status--active">Active</span>
                            @else
                                <span class="a-status a-status--inactive">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.marques.edit', $marque) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.marques.destroy', $marque) }}" method="POST" style="display:contents" onsubmit="return confirm('Supprimer cette marque et toutes ses boissons ?')">
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
                            <p>Aucune marque enregistrée.</p>
                            <a href="{{ route('admin.marques.create') }}" class="btn btn-primary btn-sm">
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
@endif
@endforeach
@endsection
