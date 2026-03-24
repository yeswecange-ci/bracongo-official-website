<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageCarriere;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class PageCarriereController extends Controller
{
    use HandlesImageUpload;
    public function edit()
    {
        $page = PageCarriere::instance();
        return view('admin.pages-contenu.carriere', compact('page'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_image'  => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'texte_intro' => 'required|string',
        ]);
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $this->uploadImage($request->file('hero_image'), 'uploads/pages', 'carriere');
        } else {
            unset($data['hero_image']);
        }

        PageCarriere::instance()->update($data);

        return redirect()->route('admin.pages.carriere.edit')
            ->with('success', 'Page Carrière mise à jour.');
    }
}
