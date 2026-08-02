<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boisson;
use App\Models\Categorie;
use App\Models\NavigationItem;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        $categories = Categorie::withCount('boissons')->orderBy('ordre')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $this->uploadImage($request->file('hero_image'), 'uploads/pages', 'categorie-hero');
        } else {
            $data['hero_image'] = 'img/marque.webp';
        }

        Categorie::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie ajoutée.');
    }

    public function edit(Categorie $category)
    {
        return view('admin.categories.edit', ['categorie' => $category]);
    }

    public function update(Request $request, Categorie $category)
    {
        $data = $this->validated($request, $category);

        // La catégorie « bieres » est structurelle : sa page front est une vue
        // dédiée et plusieurs redirections reposent sur ce slug.
        if ($category->estBieres()) {
            $data['slug'] = Categorie::SLUG_BIERES;
            $data['is_active'] = true;
        }

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $this->uploadImage($request->file('hero_image'), 'uploads/pages', 'categorie-hero');
        } else {
            unset($data['hero_image']);
        }

        $ancienSlug = $category->slug;

        DB::transaction(function () use ($category, $data, $ancienSlug) {
            $category->update($data);

            if ($category->slug !== $ancienSlug) {
                Boisson::where('categorie', $ancienSlug)->update(['categorie' => $category->slug]);
                NavigationItem::where('url', '/Nos-marques/'.$ancienSlug)
                    ->update(['url' => '/Nos-marques/'.$category->slug]);
            }
        });

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour.');
    }

    public function destroy(Categorie $category)
    {
        if ($category->estBieres()) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'La catégorie « Bières » est liée à la page dédiée du site et ne peut pas être supprimée.');
        }

        $nbBoissons = Boisson::where('categorie', $category->slug)->count();
        if ($nbBoissons > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', "Impossible de supprimer : {$nbBoissons} boisson(s) utilisent encore cette catégorie. Réaffectez-les d'abord.");
        }

        $this->deleteImageFile($category->hero_image);
        NavigationItem::where('url', '/Nos-marques/'.$category->slug)->delete();
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Categorie $categorie = null): array
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'slug' => 'required|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:categories,slug'.($categorie ? ','.$categorie->id : ''),
            'ordre' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'hero_titre' => 'nullable|string|max:255',
            'hero_image_alt' => 'nullable|string|max:255',
            'breadcrumb_libelle' => 'nullable|string|max:100',
            'meta_title' => 'nullable|string|max:255',
            'search_placeholder' => 'nullable|string|max:255',
            'message_liste_vide' => 'nullable|string|max:500',
            'message_recherche_vide' => 'nullable|string|max:500',
        ], [
            'slug.regex' => 'Le slug ne doit contenir que des minuscules, chiffres et tirets (ex. : eaux-gazeuses).',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['hero_titre'] = $data['hero_titre'] ?? '';
        if (blank($data['breadcrumb_libelle'] ?? null)) {
            $data['breadcrumb_libelle'] = $data['nom'];
        }
        if (blank($data['search_placeholder'] ?? null)) {
            $data['search_placeholder'] = 'Taper le nom d\'une boisson';
        }
        if (blank($data['message_liste_vide'] ?? null)) {
            $data['message_liste_vide'] = 'Aucune boisson disponible pour le moment.';
        }
        if (blank($data['message_recherche_vide'] ?? null)) {
            $data['message_recherche_vide'] = 'Aucune boisson ne correspond à votre recherche.';
        }

        return $data;
    }
}
