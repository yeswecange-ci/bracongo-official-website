<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageAccueil;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class PageAccueilController extends Controller
{
    use HandlesImageUpload;
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
            'qui_image_fond'             => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'qui_cta_texte'              => 'nullable|string|max:100',
            'qui_cta_lien'               => 'nullable|string|max:255',
            'marques_titre'              => 'nullable|string|max:255',
            'marques_description'        => 'nullable|string',
            'rejoignez_titre'            => 'nullable|string|max:255',
            'rejoignez_texte'            => 'nullable|string',
            'rejoignez_image'            => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'rejoignez_cta_texte'        => 'nullable|string|max:100',
            'rejoignez_cta_lien'         => 'nullable|string|max:255',
            'actualites_titre'           => 'nullable|string|max:255',
            'actualites_voir_plus_lien'  => 'nullable|string|max:255',
        ]);
        foreach (['qui_image_fond', 'rejoignez_image'] as $key) {
            if ($request->hasFile($key)) {
                $data[$key] = $this->uploadImage($request->file($key), 'uploads/pages', str_replace('_', '-', $key));
            } else {
                unset($data[$key]);
            }
        }

        PageAccueil::instance()->update($data);

        return redirect()->route('admin.pages.accueil.edit')
            ->with('success', 'Page Accueil mise à jour.');
    }
}
