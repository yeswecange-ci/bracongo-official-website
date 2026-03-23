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

    public function edit(ReseauSocial $reseauSocial)
    {
        return view('admin.reseaux-sociaux.edit', compact('reseauSocial'));
    }

    public function update(Request $request, ReseauSocial $reseauSocial)
    {
        $data = $request->validate([
            'platform'  => 'required|string|in:facebook,instagram,twitter,youtube,linkedin,tiktok',
            'url'       => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
            'ordre'     => 'nullable|integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $reseauSocial->update($data);

        return redirect()->route('admin.reseaux-sociaux.index')
            ->with('success', 'Réseau social mis à jour.');
    }

    public function destroy(ReseauSocial $reseauSocial)
    {
        $reseauSocial->delete();
        return redirect()->route('admin.reseaux-sociaux.index')
            ->with('success', 'Réseau social supprimé.');
    }
}
