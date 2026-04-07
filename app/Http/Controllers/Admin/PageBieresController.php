<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageBieres;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class PageBieresController extends Controller
{
    use HandlesImageUpload;

    public function edit()
    {
        $page = PageBieres::instance();

        return view('admin.pages-contenu.bieres', compact('page'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'hero_titre' => 'nullable|string|max:255',
            'hero_image_alt' => 'nullable|string|max:255',
            'breadcrumb_libelle' => 'nullable|string|max:100',
            'meta_title' => 'nullable|string|max:255',
            'search_placeholder' => 'nullable|string|max:255',
            'message_liste_vide' => 'nullable|string|max:500',
            'message_recherche_vide' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $this->uploadImage($request->file('hero_image'), 'uploads/pages', 'bieres-hero');
        } else {
            unset($data['hero_image']);
        }

        PageBieres::instance()->update($data);

        return redirect()->route('admin.pages.bieres.edit')
            ->with('success', 'Page « Nos bières » mise à jour.');
    }
}
