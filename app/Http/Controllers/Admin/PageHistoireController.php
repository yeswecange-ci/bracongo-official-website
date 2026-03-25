<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageHistoire;
use App\Models\Valeur;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class PageHistoireController extends Controller
{
    use HandlesImageUpload;
    public function edit()
    {
        $page   = PageHistoire::instance();
        $valeurs = Valeur::orderBy('ordre')->get();
        return view('admin.pages-contenu.histoire', compact('page', 'valeurs'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_image'      => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'titre'           => 'required|string|max:255',
            'paragraphe_1'    => 'nullable|string',
            'paragraphe_2'    => 'nullable|string',
            'paragraphe_3'    => 'nullable|string',
            'image_brasserie' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'valeurs_titre'   => 'nullable|string|max:255',
            'rse_titre'       => 'nullable|string|max:255',
            'rse_texte'       => 'nullable|string',
            'rse_image'       => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'rse_cta_texte'   => 'nullable|string|max:255',
            'rse_cta_lien'    => 'nullable|string|max:255',
            'presence_titre'     => 'nullable|string|max:255',
            'maps_embed_url'  => 'nullable|string',
            'carte_panel_titre' => 'nullable|string|max:255',
            'presence_note'   => 'nullable|string|max:255',
        ]);
        foreach (['hero_image', 'image_brasserie', 'rse_image'] as $key) {
            if ($request->hasFile($key)) {
                $data[$key] = $this->uploadImage($request->file($key), 'uploads/pages', str_replace('_', '-', $key));
            } else {
                unset($data[$key]);
            }
        }

        PageHistoire::instance()->update($data);

        return redirect()->route('admin.pages.histoire.edit')
            ->with('success', 'Page Histoire mise à jour.');
    }
}
