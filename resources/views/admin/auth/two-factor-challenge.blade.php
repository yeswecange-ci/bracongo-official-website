@extends('admin.layouts.guest')
@section('title', 'Code 2FA')

@section('guest-content')
<div class="a-auth-card__head">
    <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo" class="a-auth-logo">
    <h1 class="a-auth-title">Double authentification</h1>
    <p class="a-auth-sub">Saisissez le code à 6 chiffres de votre application d’authentification, ou un code de récupération.</p>
</div>
<div class="a-auth-card__body">
    @if($errors->any())
    <div class="alert alert-danger small py-2 mb-3">
        {{ $errors->first() }}
    </div>
    @endif
    <form method="post" action="{{ route('admin.login.two-factor.verify') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold" for="code">Code</label>
            <input type="text" name="code" id="code" class="form-control form-control-lg text-center tracking-wider"
                   inputmode="numeric" autocomplete="one-time-code" autofocus required
                   placeholder="000000" maxlength="15"
                   style="letter-spacing: 0.2em;">
            <div class="form-text">TOTP (6 chiffres) ou code de récupération (format XXXXX-XXXXX).</div>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="bi bi-shield-check me-1"></i>Valider
        </button>
    </form>
    <p class="text-center text-muted small mt-3 mb-0">
        <a href="{{ route('admin.login') }}" class="text-decoration-none">← Autre compte</a>
    </p>
</div>
@endsection
