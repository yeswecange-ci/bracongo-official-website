<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterGallery;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class FooterGalleryController extends Controller
{
    use HandlesImageUpload;

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
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'alt'   => 'nullable|string|max:255',
            'ordre' => 'nullable|integer|min:0',
        ]);

        $data['image'] = $this->uploadImage($request->file('image'), 'uploads/footer/gallery', 'gallery');

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
            ? 'required|image|mimes:jpeg,jpg,png,gif,webp|max:10240'
            : 'nullable';

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            $this->deleteImageFile($footerGallery->image);
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/footer/gallery', 'gallery');
        } else {
            unset($data['image']);
        }

        $footerGallery->update($data);

        return redirect()->route('admin.footer-gallery.index')
            ->with('success', 'Image mise à jour.');
    }

    public function destroy(FooterGallery $footerGallery)
    {
        $this->deleteImageFile($footerGallery->image);
        $footerGallery->delete();
        return redirect()->route('admin.footer-gallery.index')
            ->with('success', 'Image supprimée.');
    }
}
