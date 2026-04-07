<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    /**
     * Réservé aux rôles admin et super_admin.
     * Les éditeurs n'ont accès qu'aux actions de lecture (index, show, edit).
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user === null || ! $user->isAdministration()) {
            abort(403, 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}
