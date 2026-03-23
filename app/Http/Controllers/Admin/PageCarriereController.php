<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageCarriere;
use Illuminate\Http\Request;

class PageCarriereController extends Controller
{
    public function edit()
    {
        $page = PageCarriere::instance();
        return view('admin.pages-contenu.carriere', compact('page'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_image'  => 'nullable|string|max:255',
            'texte_intro' => 'required|string',
        ]);

        PageCarriere::instance()->update($data);

        return redirect()->route('admin.pages.carriere.edit')
            ->with('success', 'Page Carrière mise à jour.');
    }
}
