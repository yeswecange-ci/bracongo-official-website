<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageBoutique;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class PageBoutiqueController extends Controller
{
    use HandlesImageUpload;

    public function edit()
    {
        $page = PageBoutique::instance();

        return view('admin.pages-contenu.boutique', compact('page'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'hero_badge' => 'nullable|string|max:120',
            'hero_titre' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $this->uploadImage($request->file('hero_image'), 'uploads/pages', 'boutique-hero');
        } else {
            unset($data['hero_image']);
        }

        PageBoutique::instance()->update($data);

        return redirect()->route('admin.pages.boutique.edit')
            ->with('success', 'Page Boutique mise à jour.');
    }
}
