@extends('admin.layouts.guest')
@section('title', 'Invitation invalide')

@section('guest-content')
<div class="a-auth-card__head">
    <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo" class="a-auth-logo">
    <h1 class="a-auth-title">Invitation invalide</h1>
    <p class="a-auth-sub">Ce lien a expiré ou a déjà été utilisé.</p>
</div>
<div class="a-auth-card__body text-center">
    <p class="text-muted small mb-3">Demandez une nouvelle invitation à un administrateur Bracongo.</p>
    <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">Retour au site</a>
</div>
@endsection
