<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterGallery;
use App\Models\HeroSlide;
use App\Models\MessageContact;
use App\Models\OffreEmploi;
use App\Models\Valeur;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'statsMessages' => MessageContact::count(),
            'statsNonLus' => MessageContact::where('lu', false)->count(),
            'statsOffres' => OffreEmploi::where('is_active', true)->count(),
            'statsSlides' => HeroSlide::where('is_active', true)->count(),
            'statsValeurs' => Valeur::count(),
            'statsGalerie' => FooterGallery::count(),
            'derniersMessages' => MessageContact::latest()->take(5)->get(),
        ]);
    }
}
