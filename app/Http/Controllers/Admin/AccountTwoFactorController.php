<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\GoogleTwoFactorService;
use App\Support\RecoveryCodes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AccountTwoFactorController extends Controller
{
    public function start(Request $request, GoogleTwoFactorService $g2fa): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        if ($user->isTwoFactorExempt()) {
            return redirect()->route('admin.profile.edit')->with('error', 'Ce compte technique ne peut pas utiliser la double authentification par application.');
        }

        if ($user->hasTwoFactorEnabled()) {
            return redirect()->route('admin.profile.edit')->with('error', 'La double authentification est déjà active.');
        }

        $user->forceFill([
            'two_factor_secret' => $g2fa->generateSecret(),
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        return redirect()
            ->route('admin.onboarding.two-factor')
            ->with('success', 'Nouveau secret généré. Scannez le QR code à jour.');
    }

    public function confirm(Request $request, GoogleTwoFactorService $g2fa): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        /** @var User $user */
        $user = $request->user();

        if ($user->isTwoFactorExempt()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasTwoFactorEnabled()) {
            return redirect()->route('admin.dashboard');
        }

        if (! $user->two_factor_secret) {
            return redirect()->route('admin.onboarding.two-factor')->with('error', 'Secret manquant. Rechargez la page d’onboarding.');
        }

        $secret = $user->two_factor_secret;
        $code = $request->string('code')->toString();

        if (! $g2fa->verify($secret, $code)) {
            throw ValidationException::withMessages([
                'code' => 'Code invalide ou expiré.',
            ]);
        }

        $plain = RecoveryCodes::generatePlain(8);
        $user->forceFill([
            'two_factor_recovery_codes' => RecoveryCodes::hash($plain),
            'two_factor_confirmed_at' => now(),
            'last_login_at' => now(),
        ])->save();

        $request->session()->flash('two_factor_recovery_plain', $plain);

        return redirect()
            ->intended(route('admin.dashboard'))
            ->with('success', 'Double authentification activée. Conservez vos codes de récupération dans un endroit sûr.');
    }

    public function disable(Request $request, GoogleTwoFactorService $g2fa): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'code' => ['required', 'string'],
        ]);

        /** @var User $user */
        $user = $request->user();

        if ($user->isTwoFactorExempt()) {
            return redirect()->route('admin.profile.edit')->with('error', 'Ce compte technique ne gère pas la 2FA par application.');
        }

        if (! $user->hasTwoFactorEnabled()) {
            return redirect()->route('admin.profile.edit');
        }

        if ($user->isSuperAdmin()) {
            return redirect()->route('admin.profile.edit')->with('error', 'Le super administrateur ne peut pas désactiver la 2FA (obligation de sécurité).');
        }

        $code = $request->string('code')->toString();
        if ($g2fa->verify((string) $user->two_factor_secret, $code)) {
            $this->clearTwoFactor($user);

            return redirect()->route('admin.profile.edit')->with('success', 'Double authentification désactivée.');
        }

        [$ok] = RecoveryCodes::verifyAndConsume($code, $user->two_factor_recovery_codes ?? []);
        if ($ok) {
            $this->clearTwoFactor($user);

            return redirect()->route('admin.profile.edit')->with('success', 'Double authentification désactivée (code de récupération utilisé).');
        }

        throw ValidationException::withMessages([
            'code' => 'Code TOTP ou code de récupération invalide.',
        ]);
    }

    public function regenerateRecovery(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
        ]);

        /** @var User $user */
        $user = $request->user();

        if ($user->isTwoFactorExempt()) {
            return redirect()->route('admin.profile.edit')->with('error', 'Ce compte technique ne gère pas la 2FA par application.');
        }

        if (! $user->hasTwoFactorEnabled()) {
            return redirect()->route('admin.profile.edit')->with('error', 'Activez d’abord la 2FA.');
        }

        $plain = RecoveryCodes::generatePlain(8);
        $user->forceFill([
            'two_factor_recovery_codes' => RecoveryCodes::hash($plain),
        ])->save();

        $request->session()->flash('two_factor_recovery_plain', $plain);

        return redirect()->route('admin.profile.edit')->with('success', 'Nouveaux codes de récupération générés. Les anciens ne sont plus valides.');
    }

    private function clearTwoFactor(User $user): void
    {
        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();
    }
}
