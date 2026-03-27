@extends('admin.layouts.app')
@section('title', 'Accès refusé')

@push('header-left')
<div>
    <h6 class="a-topbar-page-title">Accès refusé</h6>
</div>
@endpush

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body text-center py-5">
        <div class="display-4 text-muted mb-3"><i class="bi bi-shield-lock"></i></div>
        <h5 class="mb-2">Vous n’avez pas l’autorisation d’accéder à cette page.</h5>
        <p class="text-muted small mb-4">Connectez-vous avec un compte <strong>super administrateur</strong> ou revenez au tableau de bord.</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm me-2">Dashboard</a>
        <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm">Page précédente</a>
    </div>
</div>
@endsection
