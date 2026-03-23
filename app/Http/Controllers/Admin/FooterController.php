<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSettings;
use App\Models\FooterGallery;
use App\Models\ReseauSocial;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function edit()
    {
        $footer  = FooterSettings::instance();
        $gallery = FooterGallery::orderBy('ordre')->get();
        $reseaux = ReseauSocial::orderBy('ordre')->get();
        return view('admin.footer.edit', compact('footer', 'gallery', 'reseaux'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'mission_texte'         => 'required|string',
            'adresse'               => 'required|string',
            'telephone'             => 'nullable|string|max:50',
            'email'                 => 'required|email|max:255',
            'certification_image'   => 'nullable|string|max:255',
            'copyright_debut_annee' => 'required|integer|min:1900|max:2100',
        ]);

        FooterSettings::instance()->update($data);

        return redirect()->route('admin.footer.edit')
            ->with('success', 'Footer mis à jour.');
    }
}
