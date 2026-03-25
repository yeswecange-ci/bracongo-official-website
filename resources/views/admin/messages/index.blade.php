@extends('admin.layouts.app')
@section('title', 'Messages de contact')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Messages</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Messages de contact</h6>
</div>
@endpush


@section('content')
@include('admin.layouts.partials.alerts')

@if($nonLus > 0)
<div class="alert alert-danger d-flex align-items-center gap-2 mb-4" style="border-radius:10px">
    <i class="bi bi-envelope-exclamation-fill"></i>
    <strong>{{ $nonLus }}</strong>&nbsp;message(s) non lu(s) en attente
</div>
@endif

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:80px;">Statut</th>
                        <th>Expéditeur</th>
                        <th>Sujet</th>
                        <th>Aperçu</th>
                        <th style="width:130px;">Date</th>
                        <th class="text-end" style="width:110px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                    <tr class="{{ $msg->lu ? '' : 'table-warning' }}" style="{{ $msg->lu ? '' : 'font-weight:600;' }}">
                        <td class="text-center">
                            @if(!$msg->lu)
                            <span class="a-status a-status--inactive">Non lu</span>
                            @else
                            <span class="a-status a-status--active">Lu</span>
                            @endif
                        </td>
                        <td>
                            <div>{{ $msg->name }}</div>
                            <div class="small text-muted">{{ $msg->email }}</div>
                        </td>
                        <td>{{ $msg->subject ?: '—' }}</td>
                        <td><span class="small text-muted">{{ Str::limit($msg->message, 60) }}</span></td>
                        <td class="small text-muted">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('admin.messages.show', $msg) }}" class="a-action-btn a-action-btn--view" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" style="display:contents" onsubmit="return confirm('Supprimer ce message ?')">
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
                            <p>Aucun message reçu.</p>
                        </div>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($messages->hasPages())
    <div class="card-footer">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
