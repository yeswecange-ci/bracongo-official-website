<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->text('mission_texte')->default('« Assurer une qualité et une disponibilité constantes de nos produits au meilleur prix avec un réseau de distribution complet, rapide et performant »');
            $table->text('adresse')->default('Les Boissons Rafraîchissantes du Congo, BRACONGO SA Avenue des Brasseries, N° 7666, Kingabwa, Limete, Kinshasa, RDC');
            $table->string('telephone')->default('+243 815 586 874');
            $table->string('email')->default('bracongo.contact@castel-afrique.com');
            $table->string('certification_image')->default('img/image 12.png');
            $table->unsignedSmallInteger('copyright_debut_annee')->default(1996);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
