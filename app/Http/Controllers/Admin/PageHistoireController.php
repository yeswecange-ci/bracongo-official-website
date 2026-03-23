<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageHistoire;
use App\Models\Valeur;
use Illuminate\Http\Request;

class PageHistoireController extends Controller
{
    public function edit()
    {
        $page   = PageHistoire::instance();
        $valeurs = Valeur::orderBy('ordre')->get();
        return view('admin.pages-contenu.histoire', compact('page', 'valeurs'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_image'      => 'nullable|string|max:255',
            'titre'           => 'required|string|max:255',
            'paragraphe_1'    => 'nullable|string',
            'paragraphe_2'    => 'nullable|string',
            'paragraphe_3'    => 'nullable|string',
            'image_brasserie' => 'nullable|string|max:255',
            'rse_texte'       => 'nullable|string',
            'rse_image'       => 'nullable|string|max:255',
            'rse_cta_texte'   => 'nullable|string|max:255',
            'rse_cta_lien'    => 'nullable|string|max:255',
            'maps_embed_url'  => 'nullable|string',
            'presence_note'   => 'nullable|string|max:255',
        ]);

        PageHistoire::instance()->update($data);

        return redirect()->route('admin.pages.histoire.edit')
            ->with('success', 'Page Histoire mise à jour.');
    }
}
