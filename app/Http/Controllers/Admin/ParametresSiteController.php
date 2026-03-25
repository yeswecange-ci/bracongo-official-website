<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParametresSite;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class ParametresSiteController extends Controller
{
    use HandlesImageUpload;
    public function edit()
    {
        $parametres = ParametresSite::instance();
        return view('admin.parametres.edit', compact('parametres'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'logo'               => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'favicon'            => 'nullable|string|max:255',
            'couleur_principale' => 'nullable|string|max:20',
            'search_suggestions' => 'nullable|string',
            'actualites_hero_titre'         => 'nullable|string|max:255',
            'actualites_filtre_tout_label'  => 'nullable|string|max:100',
        ]);
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadImage($request->file('logo'), 'uploads/parametres', 'logo');
        } else {
            unset($data['logo']);
        }

        ParametresSite::instance()->update($data);

        return redirect()->route('admin.parametres.edit')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }
}
