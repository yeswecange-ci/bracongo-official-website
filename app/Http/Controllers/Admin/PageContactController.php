<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContact;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageContactController extends Controller
{
    use HandlesImageUpload;
    public function edit()
    {
        $page = PageContact::instance();
        return view('admin.pages-contenu.contact', compact('page'));
    }

    public function update(Request $request)
    {
        $rules = [
            'hero_image'          => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'hero_titre'          => 'required|string|max:255',
            'form_titre'          => 'required|string|max:255',
            'denomination'        => 'required|string',
            'adresse'             => 'required|string',
            'bp'                  => 'nullable|string|max:100',
            'email'               => 'required|email|max:255',
            'tel_consommateurs'   => 'nullable|string|max:50',
            'tel_fetes'           => 'nullable|string|max:50',
            'tel_fournisseurs'    => 'nullable|string|max:50',
            'tel_cle_chateaux'    => 'nullable|string|max:50',
        ];
        if (Auth::user()->isAdministration()) {
            $rules['devenir_client_lien'] = 'nullable|string|max:500';
        }
        $data = $request->validate($rules);
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $this->uploadImage($request->file('hero_image'), 'uploads/pages', 'contact');
        } else {
            unset($data['hero_image']);
        }

        PageContact::instance()->update($data);

        return redirect()->route('admin.pages.contact.edit')
            ->with('success', 'Page Contact mise à jour.');
    }
}
