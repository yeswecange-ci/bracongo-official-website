<?php

namespace App\Providers;

use App\Models\FooterSettings;
use App\Models\FooterGallery;
use App\Models\NavigationItem;
use App\Models\ReseauSocial;
use App\Models\ParametresSite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer(['layout.app', 'layout.navbar', 'layout.footer', 'accueil', 'histoire', 'contact', 'carriere', 'pro', 'marques.*', 'actualites', 'welcome'], function ($view) {
            try {
                $navItems     = NavigationItem::with('enfants')->parents()->actifs()->get();
                $footerConfig = FooterSettings::instance();
                $footerGallery = FooterGallery::orderBy('ordre')->get();
                $reseaux      = ReseauSocial::actifs()->get();
                $parametres   = ParametresSite::instance();

                $view->with(compact('navItems', 'footerConfig', 'footerGallery', 'reseaux', 'parametres'));
            } catch (\Throwable $e) {
                Log::error('FrontViewServiceProvider: échec chargement nav/footer (base ou schéma).', [
                    'message' => $e->getMessage(),
                ]);
            }
        });
    }
}
