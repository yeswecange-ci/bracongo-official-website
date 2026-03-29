@extends('admin.layouts.onboarding')
@section('title', 'Configurer la 2FA')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4 p-md-5">
        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                 style="width:56px;height:56px;background:var(--primary-light);color:var(--primary);">
                <i class="bi bi-shield-lock" style="font-size:1.5rem"></i>
            </div>
            <h1 class="h4 fw-bold mb-2">Sécurisez votre compte</h1>
            <p class="text-muted small mb-0">
                Étape obligatoire : scannez le QR code avec <strong>Google Authenticator</strong> (ou Microsoft Authenticator, Authy…), puis entrez le code à 6 chiffres.
            </p>
        </div>

        <div class="text-center mb-4">
            <div class="d-inline-block bg-white p-3 rounded-3 border border-light shadow-sm">{!! $qrSvg !!}</div>
            <p class="small text-muted mt-3 mb-0">
                Compte : <strong>{{ $user->email }}</strong>
            </p>
        </div>

        <form action="{{ route('admin.two-factor.confirm') }}" method="POST" class="mx-auto" style="max-width:320px">
            @csrf
            <label class="form-label fw-semibold" for="code">Code à 6 chiffres</label>
            <input type="text" name="code" id="code" inputmode="numeric" maxlength="6" autocomplete="one-time-code" autofocus
                   class="form-control form-control-lg text-center @error('code') is-invalid @enderror"
                   style="letter-spacing:0.25em;font-variant-numeric:tabular-nums;" placeholder="••••••" required>
            @error('code')
                <div class="invalid-feedback d-block text-center">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary w-100 mt-3 py-2">
                <i class="bi bi-check-lg me-1"></i>Valider et accéder au back-office
            </button>
        </form>

        <form action="{{ route('admin.two-factor.start') }}" method="POST" class="text-center mt-4"
              data-bracongo-confirm
              data-bc-title="Générer un nouveau secret ?"
              data-bc-text="Vous devrez scanner le nouveau QR code avec votre application d’authentification."
              data-bc-icon="question"
              data-bc-confirm-text="Générer">
            @csrf
            <p class="small text-muted mb-2">Problème avec le QR ?</p>
            <button type="submit" class="btn btn-link btn-sm text-decoration-none p-0">
                Générer un nouveau secret
            </button>
        </form>
    </div>
</div>
@endsection
