@extends('admin.layouts.app')
@section('title', 'Utilisateurs')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Utilisateurs</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Utilisateurs back-office</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th class="text-center">Rôle</th>
                        <th class="text-center">Statut</th>
                        <th class="text-center">2FA</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td class="fw-semibold">{{ $u->name }}</td>
                        <td class="text-muted">{{ $u->email }}</td>
                        <td class="text-center">
                            @if($u->isSuperAdmin())
                                <span class="badge" style="background:#E30613;font-size:.72rem">{{ $u->roleEnum()->label() }}</span>
                            @elseif($u->isAdmin())
                                <span class="badge bg-secondary" style="font-size:.72rem">{{ $u->roleEnum()->label() }}</span>
                            @else
                                <span class="badge bg-light text-dark border" style="font-size:.72rem">{{ $u->roleEnum()->label() }}</span>
                            @endif
                        </td>
                        <td class="text-center small">
                            @if($u->status)
                                {{ $u->status->label() }}
                            @else
                                —
                            @endif
                        </td>
                        <td class="text-center">
                            @if($u->two_factor_confirmed_at)
                                <span class="text-success small"><i class="bi bi-shield-check"></i> Actif</span>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.users.show', $u) }}" class="a-action-btn a-action-btn--edit" title="Détail">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
