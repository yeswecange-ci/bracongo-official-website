<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boissons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marque_id')->constrained('marques')->cascadeOnDelete();
            $table->string('categorie')->default('bieres');
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->string('hero_image')->nullable();
            $table->string('image')->nullable();
            $table->string('logo')->nullable();

            $table->unsignedSmallInteger('annee_lancement')->nullable();
            $table->string('ingredients')->nullable();
            $table->string('type')->nullable();
            $table->string('taux_alcool')->nullable();
            $table->string('conditionnement')->nullable();
            $table->string('slogan')->nullable();
            $table->string('ddm')->nullable();
            $table->string('type_bouteille')->nullable();
            $table->string('positionnement')->nullable();
            $table->string('coeur_cible')->nullable();

            $table->json('video_urls')->nullable();

            $table->unsignedTinyInteger('ordre')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boissons');
    }
};
