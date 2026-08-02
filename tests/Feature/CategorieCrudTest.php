<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Boisson;
use App\Models\Categorie;
use App\Models\Marque;
use App\Models\NavigationItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategorieCrudTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create([
            'role' => UserRole::SuperAdmin->value,
            'two_factor_exempt' => true,
        ]);
    }

    /**
     * La migration insère déjà les catégories par défaut : on met à jour la
     * ligne existante (ou on la crée) plutôt que de dupliquer le slug.
     */
    private function categorie(array $attributes = []): Categorie
    {
        $attributes = array_merge([
            'nom' => 'Boissons gazeuses',
            'slug' => 'gazeuses',
            'ordre' => 2,
            'is_active' => true,
        ], $attributes);

        return Categorie::updateOrCreate(['slug' => $attributes['slug']], $attributes);
    }

    public function test_index_liste_les_categories(): void
    {
        $this->categorie();

        $this->actingAs($this->admin())
            ->get(route('admin.categories.index'))
            ->assertOk()
            ->assertSee('Boissons gazeuses')
            ->assertSee('/Nos-marques/gazeuses');
    }

    public function test_creation_d_une_categorie(): void
    {
        $this->actingAs($this->admin())
            ->post(route('admin.categories.store'), [
                'nom' => 'Cocktails',
                'slug' => 'cocktails',
                'ordre' => 9,
                'is_active' => 1,
            ])
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', ['slug' => 'cocktails', 'nom' => 'Cocktails']);

        // La page publique répond aussitôt.
        $this->get('/Nos-marques/cocktails')->assertOk();
    }

    public function test_slug_invalide_refuse(): void
    {
        $this->actingAs($this->admin())
            ->from(route('admin.categories.create'))
            ->post(route('admin.categories.store'), [
                'nom' => 'Test',
                'slug' => 'Slug Invalide!',
            ])
            ->assertSessionHasErrors('slug');
    }

    public function test_renommage_du_slug_cascade_boissons_et_menu(): void
    {
        $categorie = $this->categorie();
        $marque = Marque::create(['nom' => 'World Cola', 'slug' => 'worldcola', 'ordre' => 1, 'is_active' => true]);
        Boisson::create([
            'marque_id' => $marque->id, 'categorie' => 'gazeuses',
            'nom' => 'World Cola', 'slug' => 'world-cola', 'ordre' => 1, 'is_active' => true,
        ]);
        NavigationItem::create(['label' => 'Boissons gazeuses', 'url' => '/Nos-marques/gazeuses', 'ordre' => 1, 'is_active' => true]);

        $this->actingAs($this->admin())
            ->put(route('admin.categories.update', $categorie), [
                'nom' => 'Sodas',
                'slug' => 'sodas',
                'ordre' => 2,
                'is_active' => 1,
            ])
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('boissons', ['slug' => 'world-cola', 'categorie' => 'sodas']);
        $this->assertDatabaseHas('navigation_items', ['url' => '/Nos-marques/sodas']);
        $this->get('/Nos-marques/sodas')->assertOk();
        $this->get('/Nos-marques/gazeuses')->assertNotFound();
    }

    public function test_suppression_bloquee_si_boissons(): void
    {
        $categorie = $this->categorie();
        $marque = Marque::create(['nom' => 'World Cola', 'slug' => 'worldcola', 'ordre' => 1, 'is_active' => true]);
        Boisson::create([
            'marque_id' => $marque->id, 'categorie' => 'gazeuses',
            'nom' => 'World Cola', 'slug' => 'world-cola', 'ordre' => 1, 'is_active' => true,
        ]);

        $this->actingAs($this->admin())
            ->delete(route('admin.categories.destroy', $categorie))
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('categories', ['slug' => 'gazeuses']);
    }

    public function test_suppression_d_une_categorie_vide(): void
    {
        $categorie = $this->categorie(['nom' => 'Cocktails', 'slug' => 'cocktails']);

        $this->actingAs($this->admin())
            ->delete(route('admin.categories.destroy', $categorie))
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('categories', ['slug' => 'cocktails']);
    }

    public function test_categorie_bieres_protegee(): void
    {
        $bieres = $this->categorie(['nom' => 'Bières', 'slug' => 'bieres', 'ordre' => 1]);

        // Suppression refusée.
        $this->actingAs($this->admin())
            ->delete(route('admin.categories.destroy', $bieres))
            ->assertSessionHas('error');
        $this->assertDatabaseHas('categories', ['slug' => 'bieres']);

        // Le slug et l'activation ne peuvent pas changer.
        $this->actingAs($this->admin())
            ->put(route('admin.categories.update', $bieres), [
                'nom' => 'Bières',
                'slug' => 'nouvelles-bieres',
                'is_active' => 0,
            ]);
        $this->assertDatabaseHas('categories', ['slug' => 'bieres', 'is_active' => true]);
    }

    public function test_categorie_inactive_masquee_du_front(): void
    {
        $this->categorie(['is_active' => false]);

        $this->get('/Nos-marques/gazeuses')->assertNotFound();
    }

    public function test_acces_refuse_aux_invites(): void
    {
        $this->get(route('admin.categories.index'))->assertRedirect();
    }
}
