<?php

namespace App\Http\Controllers;

use App\Models\Boisson;
use App\Models\CandidatureEmploi;
use App\Models\HeroSlide;
use App\Models\Marque;
use App\Models\MessageContact;
use App\Models\NavigationItem;
use App\Models\News;
use App\Models\OffreEmploi;
use App\Models\PageAccueil;
use App\Models\PageBieres;
use App\Models\PageBoissonsEnergisantes;
use App\Models\PageBoissonsGazeuses;
use App\Models\PageCarriere;
use App\Models\PageContact;
use App\Models\PageEaux;
use App\Models\PageHistoire;
use App\Models\PagePro;
use App\Models\PageWelcome;
use App\Models\Valeur;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $slides = HeroSlide::where('is_active', true)->orderBy('ordre')->get();
        $dernieresNews = News::actives()->take(4)->get();

        return view('accueil', compact('accueil', 'slides', 'dernieresNews'));
    }

    public function histoire()
    {
        $histoire = PageHistoire::instance();
        $valeurs = Valeur::orderBy('ordre')->get();

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
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
        $offres = OffreEmploi::where('is_active', true)->orderBy('ordre')->get();

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
        $ordre = ['bieres', 'gazeuses', 'eaux', 'energisantes'];
        $marques = collect();
        foreach ($ordre as $cat) {
            $items = Marque::actives()
                ->whereHas('boissons', fn ($q) => $q->where('categorie', $cat))
                ->with(['boissons' => fn ($q) => $q->where('categorie', $cat)->orderBy('ordre')])
                ->orderBy('ordre')
                ->get();
            if ($items->isNotEmpty()) {
                $marques[$cat] = $items;
            }
        }

        return view('marques.marque', compact('marques', 'categories'));
    }

    public function marqueCategorie(string $categorie)
    {
        $categories = Marque::categories();
        if (! array_key_exists($categorie, $categories)) {
            abort(404);
        }
        if ($categorie === 'bieres') {
            return redirect()->route('bieres');
        }

        $page = match ($categorie) {
            'eaux' => PageEaux::instance(),
            'gazeuses' => PageBoissonsGazeuses::instance(),
            'energisantes' => PageBoissonsEnergisantes::instance(),
            default => abort(404),
        };

        $toutesBoissons = Boisson::actives()
            ->where('categorie', $categorie)
            ->with('marque')
            ->get();

        return view('marques.liste-boissons-categorie', compact('page', 'toutesBoissons'));
    }

    public function bieres()
    {
        $pageBieres = PageBieres::instance();
        $toutesBoissons = Boisson::actives()
            ->where('categorie', 'bieres')
            ->with('marque')
            ->get();

        return view('marques.bieres', compact('pageBieres', 'toutesBoissons'));
    }

    public function boissonBeaufort()
    {
        $boisson = Boisson::where('slug', 'beaufort-lager')->with('marque')->first();
        if (! $boisson) {
            abort(404);
        }
        $autresBoissons = Boisson::actives()
            ->where('categorie', 'bieres')
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
            ->where('categorie', $boisson->categorie)
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

    public function actualiteShow(string $slug)
    {
        $news = News::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $types = News::types();

        $relatedNews = News::actives()
            ->where('id', '!=', $news->id)
            ->orderByRaw('CASE WHEN type = ? THEN 0 ELSE 1 END', [$news->type])
            ->orderBy('date_publication', 'desc')
            ->take(6)
            ->get();

        return view('actualites-show', compact('news', 'types', 'relatedNews'));
    }

    public function offreShow(OffreEmploi $offre)
    {
        if (! $offre->is_active) {
            abort(404);
        }

        $carriere = PageCarriere::instance();
        $autresOffres = OffreEmploi::where('is_active', true)
            ->where('id', '!=', $offre->id)
            ->orderBy('ordre')
            ->take(6)
            ->get();

        return view('carriere-offre-show', compact('offre', 'carriere', 'autresOffres'));
    }

    public function offreCandidatureStore(Request $request, OffreEmploi $offre)
    {
        if (! $offre->is_active) {
            abort(404);
        }

        if (filled($request->input('candidature_website_url'))) {
            abort(403);
        }

        $cv = $request->file('cv');
        if ($cv instanceof UploadedFile && ! $cv->isValid()) {
            return back()
                ->withErrors(['cv' => $this->candidatureCvUploadErrorMessage($cv)])
                ->withInput($request->except(['cv']));
        }

        $rules = [
            'prenom' => 'required|string|max:120',
            'nom' => 'required|string|max:120',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:50',
            'message' => 'nullable|string|max:5000',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ];
        if ($offre->require_lettre_motivation) {
            $rules['lettre_motivation'] = 'required|string|max:15000';
        } else {
            $rules['lettre_motivation'] = 'prohibited';
        }

        $messages = [
            'cv.required' => 'Veuillez joindre votre CV.',
            'cv.file' => 'Le CV doit être un fichier valide.',
            'cv.mimes' => 'Le CV doit être au format PDF ou Word (.pdf, .doc, .docx).',
            'cv.max' => 'Le CV ne doit pas dépasser 10 Mo.',
        ];

        $validated = $request->validate($rules, $messages);

        $path = $this->storeCandidatureCvFile($request->file('cv'), $validated['nom'], $validated['prenom'], $offre);

        CandidatureEmploi::create([
            'offre_emploi_id' => $offre->id,
            'prenom' => $validated['prenom'],
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'] ?? null,
            'message' => $validated['message'] ?? null,
            'lettre_motivation' => $validated['lettre_motivation'] ?? null,
            'cv_path' => $path,
        ]);

        return redirect()
            ->to(route('carriere.offre.show', $offre).'#postuler')
            ->with('success', 'Votre candidature a bien été envoyée. Notre équipe RH pourra la consulter et vous recontacter si votre profil correspond à nos besoins.');
    }

    private function storeCandidatureCvFile(UploadedFile $file, string $nom, string $prenom, OffreEmploi $offre): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: (string) $file->guessExtension() ?: 'pdf');
        if (! in_array($ext, ['pdf', 'doc', 'docx'], true)) {
            $ext = 'pdf';
        }

        $nomSeg = $this->sanitizeCandidatureFilenameSegment($nom);
        $prenomSeg = $this->sanitizeCandidatureFilenameSegment($prenom);
        $offreIni = $this->offreEmploiInitialsFromOffre($offre);
        $base = 'CV_'.$nomSeg.$prenomSeg.'-'.$offreIni;
        $base = Str::limit($base, 180, '');

        $dir = 'candidatures';
        $filename = $base.'.'.$ext;
        $disk = Storage::disk('local');
        $i = 0;
        while ($disk->exists($dir.'/'.$filename)) {
            $i++;
            $filename = $base.'_'.$i.'.'.$ext;
            if ($i > 50) {
                $filename = $base.'_'.Str::lower(Str::random(8)).'.'.$ext;
                break;
            }
        }

        return $file->storeAs($dir, $filename, 'local');
    }

    private function sanitizeCandidatureFilenameSegment(string $value): string
    {
        $clean = preg_replace('/[^a-zA-Z0-9]+/', '', Str::ascii($value)) ?? '';

        return $clean !== '' ? $clean : 'X';
    }

    /**
     * Initiales dérivées du titre de l’offre (mots significatifs), pour suffixe fichier CV.
     */
    private function offreEmploiInitialsFromOffre(OffreEmploi $offre): string
    {
        $titre = trim((string) $offre->titre);
        $stop = ['de', 'la', 'le', 'les', 'du', 'des', 'et', 'à', 'a', 'au', 'aux', 'd', 'l', 'en', 'un', 'une', 'pour', 'sur', 'par', 'the', 'of', 'and'];
        $words = preg_split('/\s+/u', $titre) ?: [];
        $initials = '';
        foreach ($words as $w) {
            $w = trim($w, " \t\n\r\0\x0B.,;:!?\"'()[]");
            if ($w === '') {
                continue;
            }
            if (in_array(mb_strtolower($w), $stop, true)) {
                continue;
            }
            $initials .= mb_strtoupper(mb_substr($w, 0, 1));
        }
        if ($initials === '') {
            foreach (explode('-', Str::slug($titre)) as $p) {
                if ($p !== '') {
                    $initials .= strtoupper(substr($p, 0, 1));
                }
            }
        }
        if ($initials === '') {
            $initials = 'O'.$offre->id;
        }

        return Str::limit($initials, 12, '');
    }

    private function candidatureCvUploadErrorMessage(UploadedFile $file): string
    {
        $uploadMax = ini_get('upload_max_filesize') ?: '?';
        $postMax = ini_get('post_max_size') ?: '?';

        return match ($file->getError()) {
            UPLOAD_ERR_INI_SIZE => "Le fichier dépasse la limite d’upload PHP du serveur (actuellement {$uploadMax}). Augmentez « upload_max_filesize » et « post_max_size » (ex. 12 M) dans php.ini, ou en local : « php -c php-dev.ini artisan serve ».",
            UPLOAD_ERR_FORM_SIZE => 'Le fichier dépasse la limite indiquée par le formulaire.',
            UPLOAD_ERR_PARTIAL => 'Le fichier n’a été que partiellement téléversé. Veuillez réessayer.',
            UPLOAD_ERR_NO_FILE => 'Aucun fichier n’a été reçu. Vérifiez que vous avez bien sélectionné un CV.',
            default => "Le fichier n’a pas pu être téléversé. Limites PHP actuelles : upload {$uploadMax}, post {$postMax}. Réessayez ou contactez l’administrateur du site.",
        };
    }

    public function searchAutocomplete(Request $request): JsonResponse
    {
        $q = trim((string) $request->query('q', ''));

        if (mb_strlen($q) < 2) {
            return response()->json([
                'query' => $q,
                'best_match' => null,
                'results' => [],
            ]);
        }

        $needle = Str::lower($this->normalizeSearchText($q));
        $results = collect();

        $staticPages = [
            ['title' => 'Accueil', 'url' => route('Accueil'), 'type' => 'Page', 'keywords' => 'home bracongo'],
            ['title' => 'Notre Histoire', 'url' => route('histoire'), 'type' => 'Page', 'keywords' => 'histoire valeurs rse'],
            ['title' => 'Nos marques', 'url' => route('marque'), 'type' => 'Page', 'keywords' => 'marques produits boissons'],
            ['title' => 'Nos bières', 'url' => route('bieres'), 'type' => 'Page', 'keywords' => 'bieres bieres'],
            ['title' => 'Eaux', 'url' => route('marque.categorie', ['categorie' => 'eaux']), 'type' => 'Page', 'keywords' => 'eau eaux'],
            ['title' => 'Boissons gazeuses', 'url' => route('marque.categorie', ['categorie' => 'gazeuses']), 'type' => 'Page', 'keywords' => 'gazeuse gazeuses soda'],
            ['title' => 'Boissons énergisantes', 'url' => route('marque.categorie', ['categorie' => 'energisantes']), 'type' => 'Page', 'keywords' => 'energie energy xxl'],
            ['title' => 'Beaufort Lager', 'url' => route('bieres.beaufort'), 'type' => 'Page', 'keywords' => 'beaufort lager'],
            ['title' => 'Actualités et événements', 'url' => route('actualites'), 'type' => 'Page', 'keywords' => 'news actualites evenements'],
            ['title' => 'Carrière', 'url' => route('carriere'), 'type' => 'Page', 'keywords' => 'emploi recrutement offres'],
            ['title' => 'Contact', 'url' => route('contact'), 'type' => 'Page', 'keywords' => 'adresse telephone email'],
            ['title' => 'Bracongo Pro', 'url' => route('pro'), 'type' => 'Page', 'keywords' => 'application pro'],
        ];

        foreach ($staticPages as $page) {
            $score = $this->scoreSearchMatch($needle, $page['title'].' '.$page['keywords']);
            if ($score > 0) {
                $results->push([
                    'title' => $page['title'],
                    'url' => $page['url'],
                    'type' => $page['type'],
                    'description' => null,
                    'score' => $score,
                ]);
            }
        }

        $boissons = Boisson::query()
            ->where('is_active', true)
            ->with(['marque:id,nom'])
            ->get(['id', 'marque_id', 'nom', 'slug', 'categorie']);

        foreach ($boissons as $boisson) {
            $marqueNom = $boisson->marque->nom ?? '';
            $haystack = $boisson->nom.' '.$marqueNom.' '.$boisson->categorie;
            $score = $this->scoreSearchMatch($needle, $haystack);
            if ($score > 0) {
                $results->push([
                    'title' => $boisson->nom,
                    'url' => route('boisson.show', ['slug' => $boisson->slug]),
                    'type' => 'Produit',
                    'description' => $marqueNom !== '' ? $marqueNom : null,
                    'score' => $score + 12,
                ]);
            }
        }

        $newsRows = News::query()
            ->where('is_active', true)
            ->get(['id', 'titre', 'slug', 'type', 'extrait']);

        $typesLabels = News::types();

        foreach ($newsRows as $news) {
            $haystack = $news->titre.' '.($news->extrait ?? '').' '.$news->type;
            $score = $this->scoreSearchMatch($needle, $haystack);
            if ($score > 0) {
                $results->push([
                    'title' => $news->titre,
                    'url' => route('actualites.show', ['slug' => $news->slug]),
                    'type' => 'Actualité',
                    'description' => $typesLabels[$news->type] ?? null,
                    'score' => $score,
                ]);
            }
        }

        $jobs = OffreEmploi::query()
            ->where('is_active', true)
            ->get(['id', 'titre', 'slug', 'description']);

        foreach ($jobs as $job) {
            $plain = strip_tags((string) $job->description);
            $haystack = $job->titre.' '.$plain.' emploi carriere';
            $score = $this->scoreSearchMatch($needle, $haystack);
            if ($score > 0) {
                $results->push([
                    'title' => $job->titre,
                    'url' => route('carriere.offre.show', ['offre' => $job->slug]),
                    'type' => 'Offre',
                    'description' => 'Carrière',
                    'score' => $score,
                ]);
            }
        }

        $navRows = NavigationItem::query()
            ->where('is_active', true)
            ->get(['label', 'url']);

        foreach ($navRows as $row) {
            if (! $this->isPublicClientNavUrl((string) $row->url)) {
                continue;
            }
            $score = $this->scoreSearchMatch($needle, (string) $row->label);
            if ($score > 0) {
                $results->push([
                    'title' => $row->label,
                    'url' => $row->url,
                    'type' => 'Menu',
                    'description' => null,
                    'score' => $score - 5,
                ]);
            }
        }

        $ordered = $results
            ->sortByDesc('score')
            ->unique(fn (array $r) => $r['url'].'|'.$r['title'])
            ->take(10)
            ->values()
            ->map(function (array $r) {
                unset($r['score']);

                return $r;
            });

        return response()->json([
            'query' => $q,
            'best_match' => $ordered->first(),
            'results' => $ordered,
        ]);
    }

    private function scoreSearchMatch(string $needle, string $candidate): int
    {
        $text = Str::lower($this->normalizeSearchText($candidate));
        if ($needle === '' || $text === '') {
            return 0;
        }

        if ($text === $needle) {
            return 140;
        }

        if (Str::startsWith($text, $needle)) {
            return 120;
        }

        if (str_contains($text, ' '.$needle)) {
            return 95;
        }

        if (str_contains($text, $needle)) {
            return 75;
        }

        $parts = preg_split('/\s+/', $needle) ?: [];
        $matches = 0;
        foreach ($parts as $part) {
            if ($part !== '' && str_contains($text, $part)) {
                $matches++;
            }
        }

        return $matches > 0 ? (40 + ($matches * 10)) : 0;
    }

    private function normalizeSearchText(string $value): string
    {
        $decoded = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return Str::of($decoded)
            ->ascii()
            ->lower()
            ->replaceMatches('/[^a-z0-9\s]/', ' ')
            ->replaceMatches('/\s+/', ' ')
            ->trim()
            ->value();
    }

    private function isPublicClientNavUrl(string $url): bool
    {
        $url = trim($url);
        if ($url === '' || $url === '#') {
            return false;
        }

        if (preg_match('#^javascript:#i', $url) || str_starts_with(strtolower($url), 'mailto:')) {
            return false;
        }

        $host = parse_url($url, PHP_URL_HOST);
        if ($host !== null) {
            $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);
            if ($appHost !== null && strcasecmp((string) $host, (string) $appHost) !== 0) {
                return false;
            }
        } elseif (! str_starts_with($url, '/')) {
            return false;
        }

        $path = parse_url($url, PHP_URL_PATH);
        if ($path === null || $path === '') {
            $path = str_starts_with($url, '/') ? (strtok($url, '?') ?: '/') : '/';
        }

        $lower = strtolower((string) $path);
        if (str_contains($lower, 'back-office')) {
            return false;
        }
        if (str_contains($lower, '/invitation/')) {
            return false;
        }

        return true;
    }
}
