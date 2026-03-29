@extends('admin.layouts.app')
@section('title', 'Galerie Footer')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.footer.edit') }}">Footer</a></li>
        <li class="breadcrumb-item active">Galerie</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Galerie du footer</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('admin.footer-gallery.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Ajouter une image
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
                        <th style="width:90px;">Image</th>
                        <th>Alt</th>
                        <th class="text-center" style="width:80px;">Ordre</th>
                        <th class="text-end" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($images as $img)
                    <tr>
                        <td>
                            @if($img->image)
                                <img src="{{ asset($img->image) }}" alt="{{ $img->alt }}" class="a-thumb a-thumb--contain">
                            @else
                                <div class="a-thumb-empty"><i class="bi bi-image"></i></div>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $img->alt ?: '—' }}</td>
                        <td class="text-center"><span class="a-count-badge">{{ $img->ordre }}</span></td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.footer-gallery.edit', $img) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.footer-gallery.destroy', $img) }}" method="POST" style="display:contents"
                                      data-bracongo-confirm
                                      data-bc-title="Supprimer cette image de la galerie ?"
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
                            <p>Aucune image dans la galerie.</p>
                            <a href="{{ route('admin.footer-gallery.create') }}" class="btn btn-primary btn-sm">
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
