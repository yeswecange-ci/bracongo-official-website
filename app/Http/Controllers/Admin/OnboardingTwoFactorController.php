<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\GoogleTwoFactorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OnboardingTwoFactorController extends Controller
{
    /**
     * Première connexion : page unique pour scanner le QR et confirmer la 2FA (secret généré au chargement si besoin).
     */
    public function show(Request $request, GoogleTwoFactorService $g2fa): View|RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        if ($user->isTwoFactorExempt()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasTwoFactorEnabled()) {
            return redirect()->route('admin.dashboard');
        }

        if (! $user->two_factor_secret) {
            $user->forceFill([
                'two_factor_secret' => $g2fa->generateSecret(),
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
            ])->save();
            $user->refresh();
        }

        $qrSvg = $g2fa->qrCodeSvg($user->email, (string) $user->two_factor_secret);

        return view('admin.onboarding.two-factor', [
            'user' => $user,
            'qrSvg' => $qrSvg,
        ]);
    }
}
