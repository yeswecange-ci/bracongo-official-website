<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_histoire', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->default('img/bracongo.jpg');
            $table->string('titre')->default('Notre histoire');
            $table->text('paragraphe_1')->nullable();
            $table->text('paragraphe_2')->nullable();
            $table->text('paragraphe_3')->nullable();
            $table->string('image_brasserie')->default('img/Frame-115.png');
            $table->string('valeurs_titre')->default('Nos valeurs');
            $table->string('rse_titre')->default('Nos engagements RSE');
            $table->text('rse_texte')->nullable();
            $table->string('rse_image')->default('img/Frame 33.png');
            $table->string('rse_cta_texte')->default('En savoir plus sur nos engagements RSE');
            $table->string('rse_cta_lien')->default('#');
            $table->string('presence_titre')->default('Notre présence nationale');
            $table->string('maps_embed_url', 1000)->default('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.508544403328!2d15.352467376045353!3d-4.332304995641773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a6a33f44498394b%3A0xf6396e9803277785!2sBracongo!5e0!3m2!1sfr!2scd!4v1710680000000!5m2!1sfr!2scd');
            $table->string('carte_panel_titre')->default('Centres de distribution Bracongo');
            $table->string('presence_note')->default('* Cliquez sur la carte pour explorer nos différents centres de distribution à travers le pays.');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_histoire');
    }
};
