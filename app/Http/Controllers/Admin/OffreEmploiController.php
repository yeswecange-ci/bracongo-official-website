<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OffreEmploi;
use Illuminate\Http\Request;

class OffreEmploiController extends Controller
{
    public function index()
    {
        $offres = OffreEmploi::orderBy('ordre')->get();
        return view('admin.offres-emploi.index', compact('offres'));
    }

    public function create()
    {
        return view('admin.offres-emploi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|string|max:255',
            'lien'        => 'nullable|string|max:255',
            'is_active'   => 'nullable|boolean',
            'ordre'       => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        OffreEmploi::create($data);

        return redirect()->route('admin.offres-emploi.index')
            ->with('success', "Offre d'emploi ajoutée.");
    }

    public function edit(OffreEmploi $offreEmploi)
    {
        return view('admin.offres-emploi.edit', compact('offreEmploi'));
    }

    public function update(Request $request, OffreEmploi $offreEmploi)
    {
        $data = $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|string|max:255',
            'lien'        => 'nullable|string|max:255',
            'is_active'   => 'nullable|boolean',
            'ordre'       => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $offreEmploi->update($data);

        return redirect()->route('admin.offres-emploi.index')
            ->with('success', "Offre d'emploi mise à jour.");
    }

    public function destroy(OffreEmploi $offreEmploi)
    {
        $offreEmploi->delete();
        return redirect()->route('admin.offres-emploi.index')
            ->with('success', "Offre d'emploi supprimée.");
    }
}
