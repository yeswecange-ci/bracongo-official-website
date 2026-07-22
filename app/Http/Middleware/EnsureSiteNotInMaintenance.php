<?php

namespace App\Http\Middleware;

use App\Models\ParametresSite;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class EnsureSiteNotInMaintenance
{
    /**
     * Bloque le site public lorsque le mode maintenance est activé depuis le
     * back-office. Le back-office et les utilisateurs connectés y échappent
     * afin de pouvoir désactiver la maintenance et prévisualiser le site.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Le back-office reste toujours accessible (sinon impossible de couper
        // la maintenance), ainsi que le health-check de Laravel.
        if ($request->is('back-office', 'back-office/*', 'up')) {
            return $next($request);
        }

        // Un administrateur connecté peut naviguer sur le site public en maintenance.
        if ($request->user() !== null) {
            return $next($request);
        }

        try {
            $parametres = Cache::get('front.parametres') ?? ParametresSite::instance();
        } catch (\Throwable $e) {
            // En cas d'erreur de lecture, on ne bloque jamais le site.
            Log::error('EnsureSiteNotInMaintenance: échec lecture parametres.', [
                'message' => $e->getMessage(),
            ]);

            return $next($request);
        }

        if ($parametres && $parametres->maintenance_active) {
            return response()
                ->view('maintenance', ['parametres' => $parametres], 503)
                ->header('Retry-After', '3600');
        }

        return $next($request);
    }
}
