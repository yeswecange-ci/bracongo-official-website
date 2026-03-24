<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageWelcome;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class PageWelcomeController extends Controller
{
    use HandlesImageUpload;
    public function edit()
    {
        $page = PageWelcome::instance();
        return view('admin.pages-contenu.welcome', compact('page'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'fond_image'          => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'titre'               => 'required|string|max:255',
            'texte_avertissement' => 'required|string',
            'btn_majeur_texte'    => 'required|string|max:100',
            'btn_mineur_texte'    => 'required|string|max:100',
            'message_refus'       => 'required|string|max:255',
        ]);
        if ($request->hasFile('fond_image')) {
            $data['fond_image'] = $this->uploadImage($request->file('fond_image'), 'uploads/pages', 'welcome');
        } else {
            unset($data['fond_image']);
        }

        PageWelcome::instance()->update($data);

        return redirect()->route('admin.pages.welcome.edit')
            ->with('success', 'Page Welcome mise à jour.');
    }
}
