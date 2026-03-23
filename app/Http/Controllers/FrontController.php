<?php

namespace App\Http\Controllers;

use App\Models\PageWelcome;
use App\Models\PageAccueil;
use App\Models\HeroSlide;
use App\Models\PageHistoire;
use App\Models\Valeur;
use App\Models\PageContact;
use App\Models\MessageContact;
use App\Models\PageCarriere;
use App\Models\OffreEmploi;
use App\Models\PagePro;
use App\Models\NavigationItem;
use App\Models\FooterSettings;
use App\Models\FooterGallery;
use App\Models\ReseauSocial;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function welcome()
    {
        $welcome = PageWelcome::instance();
        return view('welcome', compact('welcome'));
    }

    public function accueil()
    {
        $accueil = PageAccueil::instance();
        $slides  = HeroSlide::where('is_active', true)->orderBy('ordre')->get();
        return view('accueil', compact('accueil', 'slides'));
    }

    public function histoire()
    {
        $histoire = PageHistoire::instance();
        $valeurs  = Valeur::orderBy('ordre')->get();
        return view('histoire', compact('histoire', 'valeurs'));
    }

    public function contact()
    {
        $contact = PageContact::instance();
        return view('contact', compact('contact'));
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        MessageContact::create($data);

        return redirect()->route('contact')
            ->with('success', 'Votre message a été envoyé avec succès !');
    }

    public function carriere()
    {
        $carriere = PageCarriere::instance();
        $offres   = OffreEmploi::where('is_active', true)->orderBy('ordre')->get();
        return view('carriere', compact('carriere', 'offres'));
    }

    public function pro()
    {
        $pro = PagePro::instance();
        return view('pro', compact('pro'));
    }
}
