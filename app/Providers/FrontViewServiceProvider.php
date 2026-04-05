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
        View::composer(['layout.app', 'layout.navbar', 'layout.footer', 'accueil', 'histoire', 'contact', 'carriere', 'pro', 'marques.*', 'actualites', 'welcome'], function ($view) {
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

                $parametres = Cache::remember('front.parametres', self::CACHE_TTL, function () {
                    return ParametresSite::instance();
                });

                $view->with(compact('navItems', 'footerConfig', 'footerGallery', 'reseaux', 'parametres'));
            } catch (\Throwable $e) {
                Log::error('FrontViewServiceProvider: échec chargement nav/footer (base ou schéma).', [
                    'message' => $e->getMessage(),
                ]);
            }
        });
    }
}
