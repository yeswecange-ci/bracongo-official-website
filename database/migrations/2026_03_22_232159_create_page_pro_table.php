<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_pro', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->default('img/brcpro.png');
            $table->text('description')->nullable();
            $table->string('pourquoi_titre')->default('Pourquoi choisir Bracongo Pro?');
            $table->text('pourquoi_intro')->nullable();
            $table->longText('pourquoi_items')->nullable()->comment('HTML rich text');
            $table->string('fonctionnalites_titre')->default('Fonctionnalités clés');
            $table->longText('fonctionnalites_items')->nullable()->comment('HTML rich text');
            $table->string('app_image')->default('img/tel.png');
            $table->string('cta_texte')->default('Télécharger Bracongo pro');
            $table->string('cta_lien')->default('#');
            $table->string('pdf_lien')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_pro');
    }
};
