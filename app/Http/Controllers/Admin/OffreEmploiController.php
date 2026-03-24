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
        return view('admin.offres-emploi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'lien'        => 'nullable|string|max:255',
            'is_active'   => 'nullable|boolean',
            'ordre'       => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/offres-emploi', 'offre');
        } else {
            unset($data['image']);
        }

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
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'lien'        => 'nullable|string|max:255',
            'is_active'   => 'nullable|boolean',
            'ordre'       => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/offres-emploi', 'offre');
        } else {
            unset($data['image']);
        }

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
