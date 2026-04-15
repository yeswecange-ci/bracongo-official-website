<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageLacledeschateaux;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class PageLacledeschateauxController extends Controller
{
    use HandlesImageUpload;

    public function edit()
    {
        $page = PageLacledeschateaux::instance();

        return view('admin.pages-contenu.lacledeschateaux', compact('page'));
    }

    public function update(Request $request)
    {
        $rules = [
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'hero_titre' => 'nullable|string|max:255',
            'paragraphe_1' => 'nullable|string',
            'paragraphe_2' => 'nullable|string',
            'horaire' => 'nullable|string|max:500',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string|max:200',
            'email' => 'nullable|email|max:255',
            'cta_libelle' => 'nullable|string|max:120',
            'selection_titre' => 'nullable|string|max:255',
            'selection_texte' => 'nullable|string',
            'services_titre' => 'nullable|string|max:255',
            'services_html' => 'nullable|string',
            'cta_url' => 'nullable|string|max:2048',
        ];

        $data = $request->validate($rules);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $this->uploadImage($request->file('hero_image'), 'uploads/pages', 'lacledeschateaux-hero');
        } else {
            unset($data['hero_image']);
        }

        PageLacledeschateaux::instance()->update($data);

        return redirect()->route('admin.pages.lacledeschateaux.edit')
            ->with('success', 'Page Clé des Châteaux mise à jour.');
    }
}
