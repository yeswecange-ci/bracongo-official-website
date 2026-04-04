<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterGallery;
use App\Models\HeroSlide;
use App\Models\MessageContact;
use App\Models\OffreEmploi;
use App\Models\PageAccueil;
use App\Models\Valeur;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $slidesForDashboard = $this->buildDashboardBannerSlides();

        return view('admin.dashboard', [
            'statsMessages' => MessageContact::count(),
            'statsNonLus' => MessageContact::where('lu', false)->count(),
            'statsOffres' => OffreEmploi::where('is_active', true)->count(),
            'statsSlides' => HeroSlide::where('is_active', true)->count(),
            'statsValeurs' => Valeur::count(),
            'statsGalerie' => FooterGallery::count(),
            'derniersMessages' => MessageContact::latest()->take(5)->get(),
            'slidesForDashboard' => $slidesForDashboard,
        ]);
    }

    private function buildDashboardBannerSlides(): Collection
    {
        $slides = collect();
        $accueil = PageAccueil::instance();

        if (filled($accueil->qui_image_fond)) {
            $slides->push([
                'kind' => 'banner',
                'title' => 'Page Accueil — Qui sommes-nous ?',
                'subtitle' => 'Image de fond',
                'image' => $accueil->qui_image_fond,
                'edit_url' => route('admin.pages.accueil.edit'),
                'active' => null,
            ]);
        }

        if (filled($accueil->rejoignez_image)) {
            $slides->push([
                'kind' => 'banner',
                'title' => 'Page Accueil — Rejoignez-nous',
                'subtitle' => 'Image section',
                'image' => $accueil->rejoignez_image,
                'edit_url' => route('admin.pages.accueil.edit'),
                'active' => null,
            ]);
        }

        foreach (HeroSlide::query()->orderBy('ordre')->get() as $hero) {
            if (! filled($hero->image)) {
                continue;
            }
            $slides->push([
                'kind' => 'hero',
                'title' => 'Hero slide (ordre '.$hero->ordre.')',
                'subtitle' => $hero->alt ?: 'Carrousel d’accueil',
                'image' => $hero->image,
                'edit_url' => route('admin.hero-slides.edit', $hero),
                'active' => $hero->is_active,
            ]);
        }

        return $slides;
    }
}
