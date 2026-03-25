<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boisson;
use App\Models\Marque;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class BoissonController extends Controller
{
    use HandlesImageUpload;
    public function index()
    {
        $boissons = Boisson::with('marque')->orderBy('marque_id')->orderBy('ordre')->get();
        return view('admin.boissons.index', compact('boissons'));
    }

    public function create()
    {
        $marques = Marque::orderBy('nom')->get();
        return view('admin.boissons.create', compact('marques'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'marque_id'      => 'required|exists:marques,id',
            'categorie'      => 'required|in:bieres,gazeuses,eaux,energisantes',
            'nom'            => 'required|string|max:255',
            'slug'           => 'required|string|max:255|unique:boissons',
            'description'    => 'nullable|string',
            'hero_image'     => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'image'          => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'logo'           => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'annee_lancement'=> 'nullable|integer|min:1800|max:2100',
            'ingredients'    => 'nullable|string|max:500',
            'type'           => 'nullable|string|max:255',
            'taux_alcool'    => 'nullable|string|max:50',
            'conditionnement'=> 'nullable|string|max:255',
            'slogan'         => 'nullable|string|max:255',
            'ddm'            => 'nullable|string|max:100',
            'type_bouteille' => 'nullable|string|max:255',
            'positionnement' => 'nullable|string|max:255',
            'coeur_cible'    => 'nullable|string|max:255',
            'video_urls'     => 'nullable|string',
            'ordre'          => 'nullable|integer|min:0',
            'is_active'      => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['video_urls'] = $this->parseVideoUrls($request->input('video_urls'));
        foreach (['hero_image', 'image', 'logo'] as $key) {
            if ($request->hasFile($key)) {
                $data[$key] = $this->uploadImage($request->file($key), 'uploads/boissons', $key);
            } else {
                unset($data[$key]);
            }
        }

        Boisson::create($data);

        return redirect()->route('admin.boissons.index')->with('success', 'Boisson ajoutée.');
    }

    public function edit(Boisson $boisson)
    {
        $marques = Marque::orderBy('nom')->get();
        return view('admin.boissons.edit', compact('boisson', 'marques'));
    }

    public function update(Request $request, Boisson $boisson)
    {
        $data = $request->validate([
            'marque_id'      => 'required|exists:marques,id',
            'categorie'      => 'required|in:bieres,gazeuses,eaux,energisantes',
            'nom'            => 'required|string|max:255',
            'slug'           => 'required|string|max:255|unique:boissons,slug,' . $boisson->id,
            'description'    => 'nullable|string',
            'hero_image'     => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'image'          => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'logo'           => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'annee_lancement'=> 'nullable|integer|min:1800|max:2100',
            'ingredients'    => 'nullable|string|max:500',
            'type'           => 'nullable|string|max:255',
            'taux_alcool'    => 'nullable|string|max:50',
            'conditionnement'=> 'nullable|string|max:255',
            'slogan'         => 'nullable|string|max:255',
            'ddm'            => 'nullable|string|max:100',
            'type_bouteille' => 'nullable|string|max:255',
            'positionnement' => 'nullable|string|max:255',
            'coeur_cible'    => 'nullable|string|max:255',
            'video_urls'     => 'nullable|string',
            'ordre'          => 'nullable|integer|min:0',
            'is_active'      => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['video_urls'] = $this->parseVideoUrls($request->input('video_urls'));
        foreach (['hero_image', 'image', 'logo'] as $key) {
            if ($request->hasFile($key)) {
                $data[$key] = $this->uploadImage($request->file($key), 'uploads/boissons', $key);
            } else {
                unset($data[$key]);
            }
        }

        $boisson->update($data);

        return redirect()->route('admin.boissons.index')->with('success', 'Boisson mise à jour.');
    }

    public function destroy(Boisson $boisson)
    {
        $boisson->delete();
        return redirect()->route('admin.boissons.index')->with('success', 'Boisson supprimée.');
    }

    private function parseVideoUrls(?string $raw): ?array
    {
        if (!$raw) return null;
        $lines = array_values(array_filter(array_map('trim', explode("\n", $raw))));
        return empty($lines) ? null : $lines;
    }
}
