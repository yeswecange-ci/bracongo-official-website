<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CandidatureEmploi;
use App\Models\OffreEmploi;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CandidatureEmploiController extends Controller
{
    public function index(): View
    {
        $offreId = request()->query('offre');
        $offreId = $offreId !== null && $offreId !== '' ? (int) $offreId : null;

        $query = CandidatureEmploi::query()
            ->with('offre:id,titre,slug')
            ->latest();

        if ($offreId) {
            $query->where('offre_emploi_id', $offreId);
        }

        $candidatures = $query->paginate(25)->withQueryString();
        $offres = OffreEmploi::query()->orderBy('ordre')->orderBy('titre')->get(['id', 'titre']);

        return view('admin.candidatures-emploi.index', compact('candidatures', 'offres', 'offreId'));
    }

    public function show(CandidatureEmploi $candidature_emploi): View
    {
        $candidature_emploi->load('offre');

        return view('admin.candidatures-emploi.show', ['candidature' => $candidature_emploi]);
    }

    public function downloadCv(CandidatureEmploi $candidature_emploi): BinaryFileResponse
    {
        $path = $candidature_emploi->cv_path;
        $disk = Storage::disk('local');

        if (! $disk->exists($path)) {
            abort(404, 'Fichier CV introuvable.');
        }

        $filename = basename($path);

        return response()->download($disk->path($path), $filename);
    }
}
