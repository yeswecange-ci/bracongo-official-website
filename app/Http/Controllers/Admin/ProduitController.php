<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    use HandlesImageUpload;
    public function index()
    {
        $produits = Produit::orderBy('ordre')->get();
        return view('admin.produits.index', compact('produits'));
    }

    public function create()
    {
        return view('admin.produits.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'        => 'required|string|max:255',
            'slug'       => 'required|string|max:255|unique:produits',
            'description'=> 'nullable|string',
            'image'      => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'prix'       => 'nullable|numeric|min:0',
            'stock'      => 'nullable|integer|min:0',
            'reference'  => 'nullable|string|max:100',
            'ordre'      => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/produits', 'produit');
        } else {
            unset($data['image']);
        }

        Produit::create($data);

        return redirect()->route('admin.produits.index')->with('success', 'Produit ajouté.');
    }

    public function edit(Produit $produit)
    {
        return view('admin.produits.edit', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        $data = $request->validate([
            'nom'        => 'required|string|max:255',
            'slug'       => 'required|string|max:255|unique:produits,slug,' . $produit->id,
            'description'=> 'nullable|string',
            'image'      => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'prix'       => 'nullable|numeric|min:0',
            'stock'      => 'nullable|integer|min:0',
            'reference'  => 'nullable|string|max:100',
            'ordre'      => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/produits', 'produit');
        } else {
            unset($data['image']);
        }

        $produit->update($data);

        return redirect()->route('admin.produits.index')->with('success', 'Produit mis à jour.');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('admin.produits.index')->with('success', 'Produit supprimé.');
    }
}
