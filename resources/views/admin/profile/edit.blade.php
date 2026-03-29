@extends('admin.layouts.app')
@section('title', 'Mon profil')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Mon profil</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Mon profil</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

{{-- En-tête type WorldNic : bandeau + avatar --}}
<div class="card a-profile-hero mb-4 overflow-hidden border-0 shadow-sm">
    <div class="a-profile-cover"></div>
    <div class="a-profile-hero-body position-relative px-3 px-md-4 pb-4">
        <div class="a-profile-avatar-wrap">
            <img src="{{ $user->avatarUrl() }}" alt="" class="a-profile-avatar rounded-circle border border-3 border-white shadow">
        </div>
        <div class="pt-2 mt-2 mt-md-0">
            <h4 class="mb-1 fw-bold">{{ $user->name }}</h4>
            <p class="text-muted mb-2 small">{{ $user->email }}</p>
            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                @if($user->isSuperAdmin())
                    <span class="badge a-profile-badge--super">Super administrateur</span>
                @elseif($user->isAdmin())
                    <span class="badge bg-secondary">Administrateur</span>
                @else
                    <span class="badge bg-light text-dark border">Éditeur</span>
                @endif
            </div>
            <div class="a-profile-meta d-flex flex-wrap column-gap-3 row-gap-1 small text-muted">
                <span><span class="a-profile-meta-label">Statut</span> <strong class="text-body fw-semibold">{{ $user->status?->label() ?? '—' }}</strong></span>
                <span class="d-none d-sm-inline text-muted opacity-50" aria-hidden="true">|</span>
                <span><span class="a-profile-meta-label">Créé le</span> {{ $user->created_at->format('d/m/Y') }}</span>
                @if($user->last_login_at)
                    <span class="d-none d-sm-inline text-muted opacity-50" aria-hidden="true">|</span>
                    <span><span class="a-profile-meta-label">Dernière connexion</span> {{ $user->last_login_at->format('d/m/Y H:i') }}</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Colonne gauche : selon le rôle --}}
    <div class="col-lg-4 a-form-sidebar">
        @if($user->isSuperAdmin() && $stats)
            <div class="card border-0 shadow-sm a-profile-role-card a-profile-role-card--super">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-speedometer2 me-2 text-danger"></i>Vue d’ensemble CMS</h6>
                    <p class="small text-muted mb-0 mt-1">Indicateurs réservés au super administrateur.</p>
                </div>
                <div class="card-body pt-3">
                    <div class="row g-2 text-center mb-3">
                        <div class="col-4">
                            <div class="a-profile-stat-val">{{ $stats['users'] }}</div>
                            <div class="a-profile-stat-lbl">Comptes</div>
                        </div>
                        <div class="col-4">
                            <div class="a-profile-stat-val text-primary">{{ $stats['invitations_pending'] }}</div>
                            <div class="a-profile-stat-lbl">Invit.</div>
                        </div>
                        <div class="col-4">
                            <div class="a-profile-stat-val text-danger">{{ $stats['messages_non_lus'] }}</div>
                            <div class="a-profile-stat-lbl">Msg.</div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-people me-1"></i>Utilisateurs</a>
                        <a href="{{ route('admin.invitations.index') }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-envelope-plus me-1"></i>Invitations</a>
                        <a href="{{ route('admin.parametres.edit') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-gear me-1"></i>Paramètres du site</a>
                    </div>
                </div>
            </div>
        @elseif($user->isAdmin() && $stats)
            <div class="card border-0 shadow-sm a-profile-role-card">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-shield-check me-2"></i>Administration</h6>
                    <p class="small text-muted mb-0 mt-1">Gestion des comptes éditeurs et invitations.</p>
                </div>
                <div class="card-body pt-3">
                    <ul class="list-unstyled small mb-3">
                        <li class="d-flex justify-content-between py-1 border-bottom border-light">
                            <span class="text-muted">Éditeurs</span>
                            <strong>{{ $stats['editors'] }}</strong>
                        </li>
                        <li class="d-flex justify-content-between py-1">
                            <span class="text-muted">Invitations actives</span>
                            <strong>{{ $stats['invitations_pending'] }}</strong>
                        </li>
                    </ul>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">Comptes</a>
                        <a href="{{ route('admin.invitations.index') }}" class="btn btn-sm btn-outline-primary">Invitations</a>
                    </div>
                </div>
            </div>
        @else
            <div class="card border-0 shadow-sm a-profile-role-card">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-key me-2"></i>Mes accès</h6>
                    <p class="small text-muted mb-0 mt-1">Permissions effectives sur le CMS (y compris délégation).</p>
                </div>
                <div class="card-body pt-3">
                    @if($permissionsForDisplay->isEmpty())
                        <p class="small text-muted mb-0">Aucune permission listée.</p>
                    @else
                        <ul class="list-unstyled small mb-0 a-profile-perm-list">
                            @foreach($permissionsForDisplay as $perm)
                                <li><i class="bi bi-check-circle text-success me-1"></i>{{ $perm->label }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @endif
    </div>

    {{-- Formulaire --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0">Informations du compte</h5>
                <p class="small text-muted mb-0">Photo, identité et mot de passe.</p>
            </div>
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="name">Nom affiché</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                   class="form-control @error('name') is-invalid @enderror" required autocomplete="name">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="email">E-mail</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                   class="form-control @error('email') is-invalid @enderror" required autocomplete="email">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" for="avatar">Photo de profil</label>
                            <input type="file" name="avatar" id="avatar" accept="image/jpeg,image/png,image/gif,image/webp"
                                   class="form-control @error('avatar') is-invalid @enderror">
                            <div class="form-text">JPG, PNG, GIF ou WebP — max 2 Mo.</div>
                            @error('avatar')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="fw-bold mb-3">Sécurité</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="password">Nouveau mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="password_confirmation">Confirmation</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
                        </div>
                    </div>
                    <p class="small text-muted mb-0">Laissez vide pour ne pas modifier le mot de passe.</p>

                    @include('admin.profile.partials.two-factor', ['user' => $user])
                </div>

                <div class="card-footer bg-light border-top py-3 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i>Enregistrer
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Retour au dashboard</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
