<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            if ($user->status === UserStatus::Disabled) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Ce compte est désactivé.',
                ])->onlyInput('email');
            }

            if ($user->hasTwoFactorEnabled() && ! $user->isTwoFactorExempt()) {
                Auth::logout();
                $request->session()->put('two_factor.login.id', $user->id);
                $request->session()->put('two_factor.login.remember', $remember);

                return redirect()->route('admin.login.two-factor');
            }

            $request->session()->regenerate();

            if (! $user->hasSatisfiedBackOfficeTwoFactorRequirement()) {
                return redirect()->intended(route('admin.onboarding.two-factor'));
            }

            $user->forceFill(['last_login_at' => now()])->save();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Identifiants invalides.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
