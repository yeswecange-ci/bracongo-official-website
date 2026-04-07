<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    use HandlesImageUpload;
    public function index()
    {
        $slides = HeroSlide::orderBy('ordre')->get();
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image'     => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'alt'       => 'nullable|string|max:255',
            'ordre'     => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['image'] = $this->uploadImage($request->file('image'), 'uploads/hero-slides', 'slide');

        HeroSlide::create($data);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Slide ajouté avec succès.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $rules = [
            'alt'       => 'nullable|string|max:255',
            'ordre'     => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ];
        $rules['image'] = $request->hasFile('image') ? 'required|image|mimes:jpeg,jpg,png,gif,webp|max:2048' : 'nullable';
        $data = $request->validate($rules);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/hero-slides', 'slide');
        } else {
            unset($data['image']);
        }

        $heroSlide->update($data);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Slide mis à jour.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        $this->deleteImageFile($heroSlide->image);
        $heroSlide->delete();
        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Slide supprimé.');
    }
}
