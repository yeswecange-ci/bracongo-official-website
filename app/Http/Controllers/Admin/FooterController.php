<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSettings;
use App\Models\FooterGallery;
use App\Models\ReseauSocial;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    use HandlesImageUpload;

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
            'certification_image'   => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'copyright_debut_annee' => 'required|integer|min:1900|max:2100',
        ]);

        $footer = FooterSettings::instance();

        if ($request->hasFile('certification_image')) {
            $this->deleteImageFile($footer->certification_image);
            $data['certification_image'] = $this->uploadImage(
                $request->file('certification_image'),
                'uploads/footer',
                'certification'
            );
        } else {
            unset($data['certification_image']);
        }

        $footer->update($data);

        return redirect()->route('admin.footer.edit')
            ->with('success', 'Footer mis à jour.');
    }
}
