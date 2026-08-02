<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->unsignedInteger('ordre')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('hero_image')->default('img/marque.webp');
            $table->string('hero_titre')->default('');
            $table->string('hero_image_alt')->nullable();
            $table->string('breadcrumb_libelle')->default('');
            $table->string('meta_title')->nullable()->comment('Titre onglet ; si vide : Nos Marques – {breadcrumb}');
            $table->string('search_placeholder')->default('Taper le nom d\'une boisson');
            $table->string('message_liste_vide')->default('Aucune boisson disponible pour le moment.');
            $table->string('message_recherche_vide')->default('Aucune boisson ne correspond à votre recherche.');
            $table->timestamps();
        });

        // Reprise des réglages saisis au back-office dans les anciennes tables
        // de pages par catégorie, puis suppression de celles-ci.
        $defauts = [
            ['slug' => 'bieres', 'nom' => 'Bières', 'ordre' => 1, 'table' => null],
            ['slug' => 'gazeuses', 'nom' => 'Boissons gazeuses', 'ordre' => 2, 'table' => 'page_boissons_gazeuses'],
            ['slug' => 'eaux', 'nom' => 'Eaux', 'ordre' => 3, 'table' => 'page_eaux'],
            ['slug' => 'eaux-gazeuses', 'nom' => 'Eaux gazeuses', 'ordre' => 4, 'table' => 'page_eaux_gazeuses'],
            ['slug' => 'energisantes', 'nom' => 'Boissons énergisantes', 'ordre' => 5, 'table' => 'page_boissons_energisantes'],
        ];

        foreach ($defauts as $def) {
            $page = ($def['table'] !== null && Schema::hasTable($def['table']))
                ? DB::table($def['table'])->first()
                : null;

            DB::table('categories')->insert([
                'nom' => $def['nom'],
                'slug' => $def['slug'],
                'ordre' => $def['ordre'],
                'is_active' => true,
                'hero_image' => $page->hero_image ?? 'img/marque.webp',
                'hero_titre' => $page->hero_titre ?? '',
                'hero_image_alt' => $page->hero_image_alt ?? null,
                'breadcrumb_libelle' => ($page->breadcrumb_libelle ?? '') !== '' ? $page->breadcrumb_libelle : $def['nom'],
                'meta_title' => $page->meta_title ?? null,
                'search_placeholder' => $page->search_placeholder ?? 'Taper le nom d\'une boisson',
                'message_liste_vide' => $page->message_liste_vide ?? 'Aucune boisson disponible pour le moment.',
                'message_recherche_vide' => $page->message_recherche_vide ?? 'Aucune boisson ne correspond à votre recherche.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::dropIfExists('page_eaux');
        Schema::dropIfExists('page_boissons_gazeuses');
        Schema::dropIfExists('page_boissons_energisantes');
        Schema::dropIfExists('page_eaux_gazeuses');
    }

    public function down(): void
    {
        // Recrée les anciennes tables (schéma + valeurs par défaut d'origine)
        // sans tenter de restaurer leur contenu.
        foreach ([
            'page_eaux' => ['Eaux', 'Taper le nom d\'une eau', 'Aucune eau disponible pour le moment.'],
            'page_boissons_gazeuses' => ['Boissons gazeuses', 'Taper le nom d\'une boisson', 'Aucune boisson gazeuse disponible pour le moment.'],
            'page_boissons_energisantes' => ['Boissons énergisantes', 'Taper le nom d\'une boisson', 'Aucune boisson énergisante disponible pour le moment.'],
            'page_eaux_gazeuses' => ['Eaux gazeuses', 'Taper le nom d\'une eau gazeuse', 'Aucune eau gazeuse disponible pour le moment.'],
        ] as $tableName => [$breadcrumb, $placeholder, $listeVide]) {
            Schema::create($tableName, function (Blueprint $table) use ($breadcrumb, $placeholder, $listeVide) {
                $table->id();
                $table->string('hero_image')->default('img/marque.webp');
                $table->string('hero_titre')->default('');
                $table->string('hero_image_alt')->nullable();
                $table->string('breadcrumb_libelle')->default($breadcrumb);
                $table->string('meta_title')->nullable();
                $table->string('search_placeholder')->default($placeholder);
                $table->string('message_liste_vide')->default($listeVide);
                $table->string('message_recherche_vide')->default('Aucune boisson ne correspond à votre recherche.');
                $table->timestamps();
            });
        }

        Schema::dropIfExists('categories');
    }
};
