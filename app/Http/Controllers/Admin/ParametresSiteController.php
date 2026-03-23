<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParametresSite;
use Illuminate\Http\Request;

class ParametresSiteController extends Controller
{
    public function edit()
    {
        $parametres = ParametresSite::instance();
        return view('admin.parametres.edit', compact('parametres'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'logo'               => 'nullable|string|max:255',
            'favicon'            => 'nullable|string|max:255',
            'couleur_principale' => 'nullable|string|max:20',
            'search_suggestions' => 'nullable|string',
        ]);

        ParametresSite::instance()->update($data);

        return redirect()->route('admin.parametres.edit')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }
}
