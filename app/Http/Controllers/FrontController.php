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
use App\Models\Marque;
use App\Models\Boisson;
use App\Models\News;
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
        $dernieresNews = News::actives()->take(4)->get();

        return view('accueil', compact('accueil', 'slides', 'dernieresNews'));
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

    public function marques()
    {
        $categories = Marque::categories();
        $marques = Marque::actives()->get()->groupBy('categorie');
        return view('marques.marque', compact('marques', 'categories'));
    }

    public function marqueCategorie(string $categorie)
    {
        $categories = Marque::categories();
        if (!array_key_exists($categorie, $categories)) {
            abort(404);
        }
        $marqueGroupe = Marque::actives()->byCategorie($categorie)->with('boissons')->get();
        return view('marques.categorie', compact('marqueGroupe', 'categories', 'categorie'));
    }

    public function bieres()
    {
        $marquesBieres = Marque::actives()->byCategorie('bieres')->with(['boissons' => fn($q) => $q->where('is_active', true)->orderBy('ordre')])->get();
        $toutesBoissons = Boisson::actives()->whereHas('marque', fn($q) => $q->where('categorie', 'bieres'))->with('marque')->get();
        return view('marques.bieres', compact('marquesBieres', 'toutesBoissons'));
    }

    public function boissonBeaufort()
    {
        $boisson = Boisson::where('slug', 'beaufort-lager')->with('marque')->first();
        if (!$boisson) abort(404);
        $autresBoissons = Boisson::actives()
            ->whereHas('marque', fn($q) => $q->where('categorie', 'bieres'))
            ->where('slug', '!=', 'beaufort-lager')
            ->with('marque')
            ->get();
        return view('marques.beaufort', compact('boisson', 'autresBoissons'));
    }

    public function boisson(string $slug)
    {
        $boisson = Boisson::where('slug', $slug)->where('is_active', true)->with('marque')->firstOrFail();
        $autresBoissons = Boisson::actives()
            ->where('id', '!=', $boisson->id)
            ->whereHas('marque', fn($q) => $q->where('categorie', $boisson->marque->categorie))
            ->with('marque')
            ->get();
        return view('marques.boisson', compact('boisson', 'autresBoissons'));
    }

    public function actualites()
    {
        $types = News::types();
        $type = request('type');
        $newsQuery = News::actives();
        if ($type && array_key_exists($type, $types)) {
            $newsQuery->byType($type);
        }
        $news = $newsQuery->get();
        return view('actualites', compact('news', 'types', 'type'));
    }
}
