@extends('admin.layouts.guest')
@section('title', 'Accepter l’invitation')

@section('guest-content')
<div class="a-auth-card__head">
    <img src="{{ asset('img/LOGO BRACONGO copie 1.png') }}" alt="Bracongo" class="a-auth-logo">
    <h1 class="a-auth-title">Créer votre accès</h1>
    <p class="a-auth-sub">Invitation pour <strong>{{ $invitation->email }}</strong></p>
    <p class="small text-muted mb-0">Lien valide jusqu’au {{ $invitation->expires_at->format('d/m/Y à H:i') }}.</p>
</div>
<div class="a-auth-card__body">
    @include('admin.layouts.partials.alerts')
    <form method="post" action="{{ route('invitation.accept', ['token' => $token]) }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Nom affiché</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Mot de passe</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
            <div class="form-text">Au moins 12 caractères, majuscules, minuscules, chiffres et symboles.</div>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Confirmation</label>
            <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="bi bi-check2 me-1"></i>Valider et créer le compte
        </button>
    </form>
</div>
@endsection
