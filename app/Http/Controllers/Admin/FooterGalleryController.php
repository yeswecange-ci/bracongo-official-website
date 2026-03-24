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
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'alt'   => 'nullable|string|max:255',
            'ordre' => 'nullable|integer|min:0',
        ]);

        $file = $request->file('image');
        $dir = 'uploads/footer/gallery';
        if (!is_dir(public_path($dir))) {
            mkdir(public_path($dir), 0755, true);
        }
        $name = 'gallery_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($dir), $name);
        $data['image'] = $dir . '/' . $name;

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
        $rules = [
            'alt'   => 'nullable|string|max:255',
            'ordre' => 'nullable|integer|min:0',
        ];
        $rules['image'] = $request->hasFile('image')
            ? 'required|image|mimes:jpeg,jpg,png,gif,webp|max:2048'
            : 'nullable';

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $dir = 'uploads/footer/gallery';
            if (!is_dir(public_path($dir))) {
                mkdir(public_path($dir), 0755, true);
            }
            $name = 'gallery_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($dir), $name);
            $data['image'] = $dir . '/' . $name;
        } else {
            unset($data['image']);
        }

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
