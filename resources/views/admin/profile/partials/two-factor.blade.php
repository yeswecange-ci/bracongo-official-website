@php
    /** @var \App\Models\User $user */
@endphp

<div class="border rounded-3 p-3 mb-4" style="border-color: var(--border) !important; background: var(--content-bg);">
    <h6 class="fw-bold mb-2"><i class="bi bi-shield-lock me-2"></i>Double authentification (Google Authenticator)</h6>

    @if($user->isTwoFactorExempt())
        <p class="small text-muted mb-0">
            <i class="bi bi-shield-check me-1"></i>Ce compte technique est protégé par mot de passe uniquement (pas d’application d’authentification). Il n’apparaît pas dans la liste des utilisateurs.
        </p>
    @elseif($user->hasTwoFactorEnabled())
        @if(session('two_factor_recovery_plain'))
            <div class="alert alert-warning small mb-3">
                <strong>Codes de récupération</strong> (à copier une fois, ils ne seront plus affichés) :
                <ul class="mb-0 mt-2 font-monospace">
                    @foreach(session('two_factor_recovery_plain') as $c)
                        <li>{{ $c }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p class="small text-muted mb-3">
            @if($user->isSuperAdmin())
                Obligatoire pour les super administrateurs.
            @else
                Recommandée pour sécuriser votre compte.
            @endif
        </p>
        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
            <span class="badge bg-success"><i class="bi bi-check-lg me-1"></i>Activée depuis le {{ $user->two_factor_confirmed_at?->format('d/m/Y H:i') }}</span>
        </div>
        @if(! $user->isSuperAdmin())
            <form action="{{ route('admin.two-factor.disable') }}" method="POST" class="mb-3"
                  data-bracongo-confirm
                  data-bc-title="Désactiver la 2FA pour ce compte ?"
                  data-bc-text="Vous devrez la reconfigurer à la prochaine connexion."
                  data-bc-icon="warning"
                  data-bc-confirm-text="Désactiver">
                @csrf
                <p class="small fw-semibold mb-2">Désactiver la 2FA</p>
                <p class="small text-muted">Après désactivation, vous devrez à nouveau configurer la 2FA à la prochaine connexion.</p>
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small mb-0" for="disable_password">Mot de passe actuel</label>
                        <input type="password" name="current_password" id="disable_password" class="form-control form-control-sm" required autocomplete="current-password">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small mb-0" for="disable_code">Code TOTP ou récupération</label>
                        <input type="text" name="code" id="disable_code" class="form-control form-control-sm" required autocomplete="one-time-code">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            Désactiver
                        </button>
                    </div>
                </div>
            </form>
        @else
            <p class="small text-muted mb-0"><i class="bi bi-info-circle me-1"></i>La 2FA ne peut pas être désactivée pour un super administrateur.</p>
        @endif

        <form action="{{ route('admin.two-factor.recovery.regenerate') }}" method="POST" class="border-top pt-3 mt-2"
              data-bracongo-confirm
              data-bc-title="Regénérer les codes de récupération ?"
              data-bc-text="Les anciens codes ne fonctionneront plus."
              data-bc-icon="question"
              data-bc-confirm-text="Regénérer">
            @csrf
            <p class="small fw-semibold mb-2">Regénérer les codes de récupération</p>
            <div class="row g-2 align-items-end">
                <div class="col-md-6">
                    <label class="form-label small mb-0" for="recovery_password">Mot de passe actuel</label>
                    <input type="password" name="current_password" id="recovery_password" class="form-control form-control-sm" required autocomplete="current-password">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                        Nouveaux codes
                    </button>
                </div>
            </div>
        </form>
    @else
        <p class="small text-muted mb-0">
            La configuration initiale de la 2FA se fait à la <strong>première connexion</strong>. Si vous voyez ce message alors que la 2FA est déjà exigée, déconnectez-vous et reconnectez-vous, ou contactez un administrateur.
        </p>
    @endif
</div>
