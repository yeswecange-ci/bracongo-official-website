<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\GoogleTwoFactorService;
use App\Support\RecoveryCodes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TwoFactorChallengeController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('two_factor.login.id')) {
            return redirect()->route('admin.login');
        }

        return view('admin.auth.two-factor-challenge');
    }

    public function store(Request $request, GoogleTwoFactorService $g2fa): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $id = $request->session()->get('two_factor.login.id');
        if (! $id) {
            return redirect()->route('admin.login');
        }

        $user = User::query()->find($id);
        if (! $user || ! $user->hasTwoFactorEnabled() || $user->isTwoFactorExempt()) {
            $request->session()->forget(['two_factor.login.id', 'two_factor.login.remember']);

            return redirect()->route('admin.login')->withErrors(['email' => 'Session expirée. reconnectez-vous.']);
        }

        $code = $request->string('code')->toString();
        $secret = $user->two_factor_secret;

        if ($g2fa->verify((string) $secret, $code)) {
            return $this->loginAndRedirect($request, $user);
        }

        $recovery = $user->two_factor_recovery_codes ?? [];
        [$ok, $remaining] = RecoveryCodes::verifyAndConsume($code, $recovery);
        if ($ok) {
            $user->forceFill(['two_factor_recovery_codes' => $remaining])->save();

            return $this->loginAndRedirect($request, $user);
        }

        throw ValidationException::withMessages([
            'code' => 'Code d’authentification ou code de récupération invalide.',
        ]);
    }

    private function loginAndRedirect(Request $request, User $user): RedirectResponse
    {
        $remember = (bool) $request->session()->pull('two_factor.login.remember', false);
        $request->session()->forget('two_factor.login.id');

        Auth::login($user, $remember);
        $request->session()->regenerate();
        $user->forceFill(['last_login_at' => now()])->save();

        return redirect()->intended(route('admin.dashboard'));
    }
}
