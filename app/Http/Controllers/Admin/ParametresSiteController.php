<?php

namespace App\Http\Controllers\Admin;

use App\Enums\InvitationExpiresHours;
use App\Http\Controllers\Controller;
use App\Models\ParametresSite;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ParametresSiteController extends Controller
{
    use HandlesImageUpload;

    public function edit()
    {
        $parametres = ParametresSite::instance();
        $invitationExpiresOptions = InvitationExpiresHours::cases();

        return view('admin.parametres.edit', compact('parametres', 'invitationExpiresOptions'));
    }

    public function update(Request $request)
    {
        $rules = [
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'favicon' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,ico|max:1024',
            'couleur_principale' => 'nullable|string|max:20',
            'search_suggestions' => 'nullable|string|max:2000',
            'seo_meta_description' => 'nullable|string|max:500',
            'telephone_public' => 'nullable|string|max:80',
            'actualites_hero_titre' => 'nullable|string|max:255',
            'actualites_filtre_tout_label' => 'nullable|string|max:100',
            'invitation_expires_hours' => ['required', Rule::enum(InvitationExpiresHours::class)],
        ];

        $user = $request->user();
        if ($user !== null && ($user->isSuperAdmin() || $user->isAdmin())) {
            $rules['contact_reply_closing'] = 'nullable|string|max:5000';
        }

        $data = $request->validate($rules);
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadImage($request->file('logo'), 'uploads/parametres', 'logo');
        } else {
            unset($data['logo']);
        }

        if ($request->hasFile('favicon')) {
            $data['favicon'] = $this->uploadImage($request->file('favicon'), 'uploads/parametres', 'favicon');
        } else {
            unset($data['favicon']);
        }

        ParametresSite::instance()->update($data);

        return redirect()->route('admin.parametres.edit')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }
}
