<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parametres_site', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->default('img/LOGO BRACONGO copie 1.png');
            $table->string('favicon')->nullable();
            $table->string('couleur_principale')->default('#E30613');
            $table->text('search_suggestions')->nullable()->comment('Suggestions séparées par des virgules');
            $table->string('actualites_hero_titre')->default('Actualités & Événements');
            $table->string('actualites_filtre_tout_label')->default('Tout voir');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parametres_site');
    }
};
