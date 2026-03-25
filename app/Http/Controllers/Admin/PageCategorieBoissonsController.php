<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageBoissonsEnergisantes;
use App\Models\PageBoissonsGazeuses;
use App\Models\PageEaux;
use App\Traits\HandlesImageUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PageCategorieBoissonsController extends Controller
{
    use HandlesImageUpload;

    private const CLES = ['eaux', 'gazeuses', 'energisantes'];

    private function pageModel(string $categorie): string
    {
        return match ($categorie) {
            'eaux' => PageEaux::class,
            'gazeuses' => PageBoissonsGazeuses::class,
            'energisantes' => PageBoissonsEnergisantes::class,
        };
    }

    private function pageInstance(string $categorie): Model
    {
        $class = $this->pageModel($categorie);

        return $class::instance();
    }

    public function edit(string $categorie)
    {
        if (!in_array($categorie, self::CLES, true)) {
            abort(404);
        }
        $page = $this->pageInstance($categorie);
        $labels = [
            'eaux' => 'Page Eaux',
            'gazeuses' => 'Page Boissons gazeuses',
            'energisantes' => 'Page Boissons énergisantes',
        ];

        return view('admin.pages-contenu.categorie-boissons', [
            'page' => $page,
            'categorie' => $categorie,
            'label' => $labels[$categorie],
        ]);
    }

    public function update(Request $request, string $categorie)
    {
        if (!in_array($categorie, self::CLES, true)) {
            abort(404);
        }
        $data = $request->validate([
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'hero_titre' => 'nullable|string|max:255',
            'hero_image_alt' => 'nullable|string|max:255',
            'breadcrumb_libelle' => 'nullable|string|max:100',
            'meta_title' => 'nullable|string|max:255',
            'search_placeholder' => 'nullable|string|max:255',
            'message_liste_vide' => 'nullable|string|max:500',
            'message_recherche_vide' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $this->uploadImage($request->file('hero_image'), 'uploads/pages', $categorie.'-hero');
        } else {
            unset($data['hero_image']);
        }

        $this->pageInstance($categorie)->update($data);

        return redirect()->route('admin.pages.categorie-boissons.edit', $categorie)
            ->with('success', 'Page « '.$this->labelSucces($categorie).' » mise à jour.');
    }

    private function labelSucces(string $categorie): string
    {
        return match ($categorie) {
            'eaux' => 'Eaux',
            'gazeuses' => 'Boissons gazeuses',
            'energisantes' => 'Boissons énergisantes',
            default => $categorie,
        };
    }
}
