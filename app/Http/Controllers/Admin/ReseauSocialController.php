<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReseauSocial;
use Illuminate\Http\Request;

class ReseauSocialController extends Controller
{
    public function index()
    {
        $reseaux = ReseauSocial::orderBy('ordre')->get();

        return view('admin.reseaux-sociaux.index', compact('reseaux'));
    }

    public function create()
    {
        return view('admin.reseaux-sociaux.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform'  => 'required|string|in:facebook,instagram,twitter,youtube,linkedin,tiktok',
            'url'       => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
            'ordre'     => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        ReseauSocial::create($data);

        return redirect()->route('admin.reseaux-sociaux.index')
            ->with('success', 'Réseau social ajouté.');
    }

    /**
     * Nom du paramètre = {reseaux_sociaux} (Laravel 12 + resource kebab-case).
     */
    public function edit(ReseauSocial $reseaux_sociaux)
    {
        return view('admin.reseaux-sociaux.edit', ['reseauSocial' => $reseaux_sociaux]);
    }

    public function update(Request $request, ReseauSocial $reseaux_sociaux)
    {
        $data = $request->validate([
            'platform'  => 'required|string|in:facebook,instagram,twitter,youtube,linkedin,tiktok',
            'url'       => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
            'ordre'     => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $reseaux_sociaux->update($data);

        return redirect()->route('admin.reseaux-sociaux.index')
            ->with('success', 'Réseau social mis à jour.');
    }

    public function destroy(ReseauSocial $reseaux_sociaux)
    {
        $reseaux_sociaux->delete();

        return redirect()->route('admin.reseaux-sociaux.index')
            ->with('success', 'Réseau social supprimé.');
    }
}
