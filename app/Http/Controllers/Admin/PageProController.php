<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PagePro;
use Illuminate\Http\Request;

class PageProController extends Controller
{
    public function edit()
    {
        $page = PagePro::instance();
        return view('admin.pages-contenu.pro', compact('page'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_image'            => 'nullable|string|max:255',
            'description'           => 'nullable|string',
            'pourquoi_titre'        => 'nullable|string|max:255',
            'pourquoi_intro'        => 'nullable|string',
            'pourquoi_items'        => 'nullable|string',
            'fonctionnalites_titre' => 'nullable|string|max:255',
            'fonctionnalites_items' => 'nullable|string',
            'app_image'             => 'nullable|string|max:255',
            'cta_texte'             => 'nullable|string|max:100',
            'cta_lien'              => 'nullable|string|max:255',
            'pdf_lien'              => 'nullable|string|max:255',
        ]);

        PagePro::instance()->update($data);

        return redirect()->route('admin.pages.pro.edit')
            ->with('success', 'Page Bracongo Pro mise à jour.');
    }
}
