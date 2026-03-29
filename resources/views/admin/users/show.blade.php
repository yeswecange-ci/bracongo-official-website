@extends('admin.layouts.app')
@section('title', $user->name)

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
        <li class="breadcrumb-item active">{{ \Illuminate\Support\Str::limit($user->name, 24) }}</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">{{ $user->name }}</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header"><h5 class="mb-0">Informations</h5></div>
            <div class="card-body">
                <dl class="row mb-0 small">
                    <dt class="col-sm-4 text-muted">E-mail</dt>
                    <dd class="col-sm-8">{{ $user->email }}</dd>
                    <dt class="col-sm-4 text-muted">Rôle</dt>
                    <dd class="col-sm-8">
                        @if($user->isSuperAdmin())
                            <span class="badge" style="background:#E30613">{{ $user->roleEnum()->label() }}</span>
                        @elseif($user->isAdmin())
                            <span class="badge bg-secondary">{{ $user->roleEnum()->label() }}</span>
                        @else
                            <span class="badge bg-light text-dark border">{{ $user->roleEnum()->label() }}</span>
                        @endif
                    </dd>
                    <dt class="col-sm-4 text-muted">Statut</dt>
                    <dd class="col-sm-8">{{ $user->status?->label() ?? '—' }}</dd>
                    <dt class="col-sm-4 text-muted">Dernière connexion</dt>
                    <dd class="col-sm-8">{{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : '—' }}</dd>
                    <dt class="col-sm-4 text-muted">E-mail vérifié</dt>
                    <dd class="col-sm-8">{{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y H:i') : '—' }}</dd>
                    <dt class="col-sm-4 text-muted">2FA confirmé</dt>
                    <dd class="col-sm-8">{{ $user->two_factor_confirmed_at ? $user->two_factor_confirmed_at->format('d/m/Y H:i') : 'Non' }}</dd>
                    <dt class="col-sm-4 text-muted">Créé le</dt>
                    <dd class="col-sm-8">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        @can('resetTwoFactor', $user)
        <div class="card border-warning-subtle">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-shield-exclamation me-2 text-warning"></i>Réinitialiser le 2FA</h5>
            </div>
            <div class="card-body">
                <p class="small text-muted mb-3">Révoque les secrets et codes de récupération. L’utilisateur devra reconfigurer le 2FA à la prochaine connexion (flux à finaliser).</p>
                <form action="{{ route('admin.users.two-factor.reset', $user) }}" method="POST"
                      data-bracongo-confirm
                      data-bc-title="Réinitialiser le 2FA pour {{ e($user->name) }} ?"
                      data-bc-text="L’utilisateur devra reconfigurer son application d’authentification."
                      data-bc-icon="question"
                      data-bc-confirm-text="Réinitialiser">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>Réinitialiser le 2FA
                    </button>
                </form>
            </div>
        </div>
        @endcan
    </div>
</div>
@endsection
