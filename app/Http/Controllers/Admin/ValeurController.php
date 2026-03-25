<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Valeur;
use Illuminate\Http\Request;

class ValeurController extends Controller
{
    public function index()
    {
        $valeurs = Valeur::orderBy('ordre')->get();
        return view('admin.valeurs.index', compact('valeurs'));
    }

    public function create()
    {
        return view('admin.valeurs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'lettre'      => 'required|string|max:1',
            'description' => 'required|string|max:255',
            'ordre'       => 'nullable|integer|min:0',
        ]);

        Valeur::create($data);

        return redirect()->route('admin.valeurs.index')
            ->with('success', 'Valeur ajoutée.');
    }

    public function edit(Valeur $valeur)
    {
        return view('admin.valeurs.edit', compact('valeur'));
    }

    public function update(Request $request, Valeur $valeur)
    {
        $data = $request->validate([
            'lettre'      => 'required|string|max:1',
            'description' => 'required|string|max:255',
            'ordre'       => 'nullable|integer|min:0',
        ]);

        $valeur->update($data);

        return redirect()->route('admin.valeurs.index')
            ->with('success', 'Valeur mise à jour.');
    }

    public function destroy(Valeur $valeur)
    {
        $valeur->delete();
        return redirect()->route('admin.valeurs.index')
            ->with('success', 'Valeur supprimée.');
    }
}
