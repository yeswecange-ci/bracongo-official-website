@extends('admin.layouts.guest')
@section('title', 'Connexion back-office')

@section('guest-content')
<div class="a-auth-card__head">
    <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo" class="a-auth-logo">
    <h1 class="a-auth-title">Back-office</h1>
    <p class="a-auth-sub">Connectez-vous pour gérer les invitations et les utilisateurs.</p>
</div>
<div class="a-auth-card__body">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show small" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger small py-2">
        {{ $errors->first() }}
    </div>
    @endif
    <form method="post" action="{{ route('admin.login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="username" autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Mot de passe</label>
            <input type="password" name="password" class="form-control" required autocomplete="current-password">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" id="remember" class="form-check-input" value="1">
            <label class="form-check-label" for="remember">Se souvenir de moi</label>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="bi bi-box-arrow-in-right me-1"></i>Se connecter
        </button>
    </form>
    <p class="text-center text-muted small mt-3 mb-0">
        <a href="{{ url('/') }}" class="text-decoration-none">← Retour au site</a>
    </p>
</div>
@endsection
