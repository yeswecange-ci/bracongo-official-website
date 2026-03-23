<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContact;
use Illuminate\Http\Request;

class PageContactController extends Controller
{
    public function edit()
    {
        $page = PageContact::instance();
        return view('admin.pages-contenu.contact', compact('page'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_image'          => 'nullable|string|max:255',
            'denomination'        => 'required|string',
            'adresse'             => 'required|string',
            'bp'                  => 'nullable|string|max:100',
            'email'               => 'required|email|max:255',
            'tel_consommateurs'   => 'nullable|string|max:50',
            'tel_fetes'           => 'nullable|string|max:50',
            'tel_fournisseurs'    => 'nullable|string|max:50',
            'tel_cle_chateaux'    => 'nullable|string|max:50',
            'devenir_client_lien' => 'nullable|string|max:255',
        ]);

        PageContact::instance()->update($data);

        return redirect()->route('admin.pages.contact.edit')
            ->with('success', 'Page Contact mise à jour.');
    }
}
