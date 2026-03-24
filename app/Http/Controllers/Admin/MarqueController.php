<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marque;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarqueController extends Controller
{
    use HandlesImageUpload;
    public function index()
    {
        $marques = Marque::withCount('boissons')->orderBy('categorie')->orderBy('ordre')->get();
        return view('admin.marques.index', compact('marques'));
    }

    public function create()
    {
        $categories = Marque::categories();
        return view('admin.marques.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'          => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:marques',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'image_banner' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'categorie'    => 'required|in:bieres,gazeuses,eaux,energisantes',
            'lien'         => 'nullable|string|max:255',
            'ordre'        => 'nullable|integer|min:0',
            'is_active'    => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/marques', 'marque');
        } else {
            unset($data['image']);
        }
        if ($request->hasFile('image_banner')) {
            $data['image_banner'] = $this->uploadImage($request->file('image_banner'), 'uploads/marques', 'banner');
        } else {
            unset($data['image_banner']);
        }

        Marque::create($data);

        return redirect()->route('admin.marques.index')->with('success', 'Marque ajoutée.');
    }

    public function edit(Marque $marque)
    {
        $categories = Marque::categories();
        return view('admin.marques.edit', compact('marque', 'categories'));
    }

    public function update(Request $request, Marque $marque)
    {
        $data = $request->validate([
            'nom'          => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:marques,slug,' . $marque->id,
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'image_banner' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'categorie'    => 'required|in:bieres,gazeuses,eaux,energisantes',
            'lien'         => 'nullable|string|max:255',
            'ordre'        => 'nullable|integer|min:0',
            'is_active'    => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/marques', 'marque');
        } else {
            unset($data['image']);
        }
        if ($request->hasFile('image_banner')) {
            $data['image_banner'] = $this->uploadImage($request->file('image_banner'), 'uploads/marques', 'banner');
        } else {
            unset($data['image_banner']);
        }

        $marque->update($data);

        return redirect()->route('admin.marques.index')->with('success', 'Marque mise à jour.');
    }

    public function destroy(Marque $marque)
    {
        $marque->delete();
        return redirect()->route('admin.marques.index')->with('success', 'Marque supprimée.');
    }
}
