<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSettings;
use App\Models\FooterGallery;
use App\Models\ReseauSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'certification_image'   => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'copyright_debut_annee' => 'required|integer|min:1900|max:2100',
        ]);

        $footer = FooterSettings::instance();

        if ($request->hasFile('certification_image')) {
            $file = $request->file('certification_image');
            $dir = 'uploads/footer';
            if (!is_dir(public_path($dir))) {
                mkdir(public_path($dir), 0755, true);
            }
            $name = 'certification_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($dir), $name);
            $data['certification_image'] = $dir . '/' . $name;
        } else {
            unset($data['certification_image']);
        }

        $footer->update($data);

        return redirect()->route('admin.footer.edit')
            ->with('success', 'Footer mis à jour.');
    }
}
