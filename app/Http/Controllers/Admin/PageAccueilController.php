<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageAccueil;
use Illuminate\Http\Request;

class PageAccueilController extends Controller
{
    public function edit()
    {
        $page = PageAccueil::instance();
        return view('admin.pages-contenu.accueil', compact('page'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'qui_titre'                  => 'required|string|max:255',
            'qui_texte'                  => 'nullable|string',
            'qui_image_fond'             => 'nullable|string|max:255',
            'qui_cta_texte'              => 'nullable|string|max:100',
            'qui_cta_lien'               => 'nullable|string|max:255',
            'marques_titre'              => 'nullable|string|max:255',
            'marques_description'        => 'nullable|string',
            'rejoignez_titre'            => 'nullable|string|max:255',
            'rejoignez_texte'            => 'nullable|string',
            'rejoignez_image'            => 'nullable|string|max:255',
            'rejoignez_cta_texte'        => 'nullable|string|max:100',
            'rejoignez_cta_lien'         => 'nullable|string|max:255',
            'actualites_titre'           => 'nullable|string|max:255',
            'actualites_voir_plus_lien'  => 'nullable|string|max:255',
        ]);

        PageAccueil::instance()->update($data);

        return redirect()->route('admin.pages.accueil.edit')
            ->with('success', 'Page Accueil mise à jour.');
    }
}
