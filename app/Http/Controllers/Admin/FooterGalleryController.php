<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterGallery;
use Illuminate\Http\Request;

class FooterGalleryController extends Controller
{
    public function index()
    {
        $images = FooterGallery::orderBy('ordre')->get();
        return view('admin.footer-gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.footer-gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|string|max:255',
            'alt'   => 'nullable|string|max:255',
            'ordre' => 'nullable|integer|min:0',
        ]);

        FooterGallery::create($data);

        return redirect()->route('admin.footer-gallery.index')
            ->with('success', 'Image ajoutée à la galerie.');
    }

    public function edit(FooterGallery $footerGallery)
    {
        return view('admin.footer-gallery.edit', compact('footerGallery'));
    }

    public function update(Request $request, FooterGallery $footerGallery)
    {
        $data = $request->validate([
            'image' => 'required|string|max:255',
            'alt'   => 'nullable|string|max:255',
            'ordre' => 'nullable|integer|min:0',
        ]);

        $footerGallery->update($data);

        return redirect()->route('admin.footer-gallery.index')
            ->with('success', 'Image mise à jour.');
    }

    public function destroy(FooterGallery $footerGallery)
    {
        $footerGallery->delete();
        return redirect()->route('admin.footer-gallery.index')
            ->with('success', 'Image supprimée.');
    }
}
