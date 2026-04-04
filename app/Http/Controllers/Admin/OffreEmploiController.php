<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OffreEmploi;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class OffreEmploiController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        $offres = OffreEmploi::orderBy('ordre')->get();

        return view('admin.offres-emploi.index', compact('offres'));
    }

    public function create()
    {
        return view('admin.offres-emploi.create', ['offres_emploi' => new OffreEmploi]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:offres_emploi,slug',
            'description' => 'required|string',
            'lieu' => 'nullable|string|max:255',
            'type_contrat' => 'nullable|string|max:120',
            'date_limite_candidature' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'is_active' => 'nullable|boolean',
            'require_lettre_motivation' => 'nullable|boolean',
            'ordre' => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['require_lettre_motivation'] = $request->boolean('require_lettre_motivation');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/offres-emploi', 'offre');
        } else {
            unset($data['image']);
        }
        if (empty($data['slug'])) {
            unset($data['slug']);
        }
        $data['lien'] = '#';

        OffreEmploi::create($data);

        return redirect()->route('admin.offres-emploi.index')
            ->with('success', "Offre d'emploi ajoutée.");
    }

    public function edit(OffreEmploi $offres_emploi)
    {
        return view('admin.offres-emploi.edit', compact('offres_emploi'));
    }

    public function update(Request $request, OffreEmploi $offres_emploi)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:offres_emploi,slug,'.$offres_emploi->id,
            'description' => 'required|string',
            'lieu' => 'nullable|string|max:255',
            'type_contrat' => 'nullable|string|max:120',
            'date_limite_candidature' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'is_active' => 'nullable|boolean',
            'require_lettre_motivation' => 'nullable|boolean',
            'ordre' => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['require_lettre_motivation'] = $request->boolean('require_lettre_motivation');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/offres-emploi', 'offre');
        } else {
            unset($data['image']);
        }
        if (empty($data['slug'])) {
            unset($data['slug']);
        }

        $offres_emploi->update($data);

        return redirect()->route('admin.offres-emploi.index')
            ->with('success', "Offre d'emploi mise à jour.");
    }

    public function destroy(OffreEmploi $offres_emploi)
    {
        $offres_emploi->delete();

        return redirect()->route('admin.offres-emploi.index')
            ->with('success', "Offre d'emploi supprimée.");
    }
}
