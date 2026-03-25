<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_eaux', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->default('img/marque.jpg');
            $table->string('hero_titre')->default('');
            $table->string('hero_image_alt')->nullable();
            $table->string('breadcrumb_libelle')->default('Eaux');
            $table->string('meta_title')->nullable()->comment('Titre onglet ; si vide : Nos Marques – {breadcrumb}');
            $table->string('search_placeholder')->default('Taper le nom d\'une eau');
            $table->string('message_liste_vide')->default('Aucune eau disponible pour le moment.');
            $table->string('message_recherche_vide')->default('Aucune eau ne correspond à votre recherche.');
            $table->timestamps();
        });

        Schema::create('page_boissons_gazeuses', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->default('img/marque.jpg');
            $table->string('hero_titre')->default('');
            $table->string('hero_image_alt')->nullable();
            $table->string('breadcrumb_libelle')->default('Boissons gazeuses');
            $table->string('meta_title')->nullable();
            $table->string('search_placeholder')->default('Taper le nom d\'une boisson');
            $table->string('message_liste_vide')->default('Aucune boisson gazeuse disponible pour le moment.');
            $table->string('message_recherche_vide')->default('Aucune boisson ne correspond à votre recherche.');
            $table->timestamps();
        });

        Schema::create('page_boissons_energisantes', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->default('img/marque.jpg');
            $table->string('hero_titre')->default('');
            $table->string('hero_image_alt')->nullable();
            $table->string('breadcrumb_libelle')->default('Boissons énergisantes');
            $table->string('meta_title')->nullable();
            $table->string('search_placeholder')->default('Taper le nom d\'une boisson');
            $table->string('message_liste_vide')->default('Aucune boisson énergisante disponible pour le moment.');
            $table->string('message_recherche_vide')->default('Aucune boisson ne correspond à votre recherche.');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_boissons_energisantes');
        Schema::dropIfExists('page_boissons_gazeuses');
        Schema::dropIfExists('page_eaux');
    }
};
