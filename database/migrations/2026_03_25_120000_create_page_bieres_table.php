<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_bieres', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->default('img/marque.jpg');
            $table->string('hero_titre')->default('Nos Bières');
            $table->string('hero_image_alt')->nullable();
            $table->string('breadcrumb_libelle')->default('Bières');
            $table->string('meta_title')->nullable()->comment('Titre onglet navigateur ; si vide : Nos Marques – {breadcrumb}');
            $table->string('search_placeholder')->default('Taper un nom de bière');
            $table->string('message_liste_vide')->default('Aucune bière disponible pour le moment.');
            $table->string('message_recherche_vide')->default('Aucune bière ne correspond à votre recherche.');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_bieres');
    }
};
