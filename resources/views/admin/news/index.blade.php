@extends('admin.layouts.app')
@section('title', 'News')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">News</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">News & Actualités</h6>
</div>
@endpush

@push('header-actions')
<a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Nouvelle news
</a>
@endpush


@section('content')
@include('admin.layouts.partials.alerts')

<div class="a-filter-bar mb-3">
    <a href="{{ route('admin.news.index') }}" class="a-filter-pill {{ !$type ? 'a-filter-pill--active' : '' }}">Tous</a>
    @foreach($types as $key => $label)
    <a href="{{ route('admin.news.index', ['type' => $key]) }}" class="a-filter-pill {{ $type === $key ? 'a-filter-pill--active' : '' }}">{{ $label }}</a>
    @endforeach
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:70px;">Image</th>
                        <th>Titre</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Date pub.</th>
                        <th class="text-center" style="width:100px;">Statut</th>
                        <th class="text-end" style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                    <tr>
                        <td>
                            @if($item->image)
                                <img src="{{ asset($item->image) }}" alt="" class="a-thumb a-thumb--contain">
                            @else
                                <div class="a-thumb-empty"><i class="bi bi-image"></i></div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">{{ Str::limit($item->titre, 60) }}</div>
                            <div class="small text-muted">{{ $item->lieu }}</div>
                        </td>
                        <td class="text-center">
                            <span class="badge" style="background:var(--content-bg);color:var(--text-secondary);border:1px solid var(--border);font-size:.72rem">{{ $types[$item->type] ?? $item->type }}</span>
                        </td>
                        <td class="text-center text-muted small">
                            {{ $item->date_publication ? $item->date_publication->format('d/m/Y') : '—' }}
                        </td>
                        <td class="text-center">
                            @if($item->is_active)
                                <span class="a-status a-status--published">Publiée</span>
                            @else
                                <span class="a-status a-status--draft">Brouillon</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.news.edit', $item) }}" class="a-action-btn a-action-btn--edit" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" style="display:contents"
                                      data-bracongo-confirm
                                      data-bc-title="Supprimer cette actualité ?"
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
                    <tr><td colspan="6">
                        <div class="a-empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Aucune news enregistrée.</p>
                            <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">
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
