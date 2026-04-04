<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorSetupComplete
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user === null || $user->hasSatisfiedBackOfficeTwoFactorRequirement()) {
            return $next($request);
        }

        $allowed = $request->routeIs([
            'admin.onboarding.two-factor',
            'admin.two-factor.start',
            'admin.two-factor.confirm',
            'admin.logout',
        ]);

        if ($allowed) {
            return $next($request);
        }

        return redirect()
            ->route('admin.onboarding.two-factor')
            ->with('warning', 'Vous devez configurer la double authentification (2FA) avant d’accéder au back-office.');
    }
}
