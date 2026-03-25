<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marque;
use App\Traits\HandlesImageUpload;
use App\Models\Boisson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarqueController extends Controller
{
    use HandlesImageUpload;
    public function index(Request $request)
    {
        $categories = Marque::categories();
        $marques = Marque::withCount('boissons')->orderBy('ordre')->get();

        $filter = $request->query('categorie_boisson');
        if ($filter && !array_key_exists($filter, $categories)) {
            $filter = null;
        }
        $boissonsQuery = Boisson::with('marque')->orderBy('marque_id')->orderBy('ordre');
        if ($filter) {
            $boissonsQuery->where('categorie', $filter);
        }
        $boissons = $boissonsQuery->get();
        $totalBoissons = Boisson::count();

        $countsByCategory = [];
        foreach (array_keys($categories) as $key) {
            $countsByCategory[$key] = Boisson::where('categorie', $key)->count();
        }

        return view('admin.marques.index', compact('marques', 'boissons', 'categories', 'countsByCategory', 'filter', 'totalBoissons'));
    }

    public function create()
    {
        return view('admin.marques.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'          => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:marques',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
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
        Marque::create($data);

        return redirect()->route('admin.marques.index')->with('success', 'Marque ajoutée.');
    }

    public function edit(Marque $marque)
    {
        return view('admin.marques.edit', compact('marque'));
    }

    public function update(Request $request, Marque $marque)
    {
        $data = $request->validate([
            'nom'          => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:marques,slug,' . $marque->id,
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
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
        $marque->update($data);

        return redirect()->route('admin.marques.index')->with('success', 'Marque mise à jour.');
    }

    public function destroy(Marque $marque)
    {
        $marque->delete();
        return redirect()->route('admin.marques.index')->with('success', 'Marque supprimée.');
    }
}
