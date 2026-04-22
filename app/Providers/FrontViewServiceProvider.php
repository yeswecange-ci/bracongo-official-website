<?php

namespace App\Providers;

use App\Models\FooterSettings;
use App\Models\FooterGallery;
use App\Models\NavigationItem;
use App\Models\ReseauSocial;
use App\Models\ParametresSite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontViewServiceProvider extends ServiceProvider
{
    // Durée de cache : 30 minutes. Les admins invalident le cache à la sauvegarde.
    private const CACHE_TTL = 1800;

    public function boot(): void
    {
        // $parametres (logo, favicon, etc.) est partagé globalement avec TOUTES
        // les vues (public + admin + auth) pour que le logo reste modifiable
        // depuis le back-office quel que soit le contexte d'affichage.
        try {
            $parametres = Cache::remember('front.parametres', self::CACHE_TTL, function () {
                return ParametresSite::instance();
            });
            View::share('parametres', $parametres);
        } catch (\Throwable $e) {
            Log::error('FrontViewServiceProvider: échec chargement parametres.', [
                'message' => $e->getMessage(),
            ]);
        }

        View::composer(['layout.app', 'layout.navbar', 'layout.footer', 'accueil', 'histoire', 'contact', 'carriere', 'pro', 'marques.*', 'actualites', 'welcome', 'lacledeschateaux', 'faq', 'invitation.*'], function ($view) {
            try {
                $navItems = Cache::remember('front.nav_items', self::CACHE_TTL, function () {
                    return NavigationItem::with('enfants')->parents()->actifs()->get();
                });

                $footerConfig = Cache::remember('front.footer_config', self::CACHE_TTL, function () {
                    return FooterSettings::instance();
                });

                $footerGallery = Cache::remember('front.footer_gallery', self::CACHE_TTL, function () {
                    return FooterGallery::orderBy('ordre')->get();
                });

                $reseaux = Cache::remember('front.reseaux', self::CACHE_TTL, function () {
                    return ReseauSocial::actifs()->get();
                });

                $view->with(compact('navItems', 'footerConfig', 'footerGallery', 'reseaux'));
            } catch (\Throwable $e) {
                Log::error('FrontViewServiceProvider: échec chargement nav/footer (base ou schéma).', [
                    'message' => $e->getMessage(),
                ]);
            }
        });
    }
}
