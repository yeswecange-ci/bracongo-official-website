<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_accueil', function (Blueprint $table) {
            $table->id();
            // Section "Qui sommes-nous ?"
            $table->string('qui_titre')->default('Qui sommes-nous ?');
            $table->text('qui_texte')->nullable();
            $table->string('qui_image_fond')->default('img/brasserie.jpg');
            $table->string('qui_cta_texte')->default('Lire plus');
            $table->string('qui_cta_lien')->default('/histoire');
            // Section "Nos marques"
            $table->string('marques_titre')->default('Nos marques');
            $table->text('marques_description')->nullable();
            $table->string('marques_cartes_cta_texte')->default('Voir plus');
            // Section "Rejoignez nous"
            $table->string('rejoignez_titre')->default('Rejoignez nous');
            $table->text('rejoignez_texte')->nullable();
            $table->string('rejoignez_image')->default('img/rejoignez.png');
            $table->string('rejoignez_cta_texte')->default('Voir nos offres d\'emploi');
            $table->string('rejoignez_cta_lien')->default('/Carriere');
            // Section "Actualités"
            $table->string('actualites_titre')->default('Dernières actualités');
            $table->string('actualites_voir_plus_lien')->default('/Actualités-et-evenements');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_accueil');
    }
};
