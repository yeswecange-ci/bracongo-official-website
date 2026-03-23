<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageWelcome;
use Illuminate\Http\Request;

class PageWelcomeController extends Controller
{
    public function edit()
    {
        $page = PageWelcome::instance();
        return view('admin.pages-contenu.welcome', compact('page'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'fond_image'          => 'nullable|string|max:255',
            'titre'               => 'required|string|max:255',
            'texte_avertissement' => 'required|string',
            'btn_majeur_texte'    => 'required|string|max:100',
            'btn_mineur_texte'    => 'required|string|max:100',
            'message_refus'       => 'required|string|max:255',
        ]);

        PageWelcome::instance()->update($data);

        return redirect()->route('admin.pages.welcome.edit')
            ->with('success', 'Page Welcome mise à jour.');
    }
}
