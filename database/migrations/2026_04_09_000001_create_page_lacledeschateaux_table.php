<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_lacledeschateaux', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->nullable();
            $table->string('hero_titre')->nullable();
            $table->text('paragraphe_1')->nullable();
            $table->text('paragraphe_2')->nullable();
            $table->string('horaire')->nullable();
            $table->text('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('cta_libelle')->default('En savoir plus');
            $table->string('cta_url', 2048)->nullable();
            $table->string('selection_titre')->nullable();
            $table->text('selection_texte')->nullable();
            $table->string('services_titre')->nullable();
            $table->text('services_html')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_lacledeschateaux');
    }
};
