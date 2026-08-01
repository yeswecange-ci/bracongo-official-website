<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_eaux_gazeuses', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->default('img/marque.webp');
            $table->string('hero_titre')->default('');
            $table->string('hero_image_alt')->nullable();
            $table->string('breadcrumb_libelle')->default('Eaux gazeuses');
            $table->string('meta_title')->nullable();
            $table->string('search_placeholder')->default('Taper le nom d\'une eau gazeuse');
            $table->string('message_liste_vide')->default('Aucune eau gazeuse disponible pour le moment.');
            $table->string('message_recherche_vide')->default('Aucune boisson ne correspond à votre recherche.');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_eaux_gazeuses');
    }
};
