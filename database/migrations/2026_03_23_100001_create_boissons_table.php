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
            $table->string('categorie')->default('bieres'); // bieres, gazeuses, eaux, energisantes
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->string('hero_image')->nullable();
            $table->string('image')->nullable(); // image produit / bouteille
            $table->string('logo')->nullable();

            // Fiche technique (détails de la boisson)
            $table->unsignedSmallInteger('annee_lancement')->nullable();
            $table->string('ingredients')->nullable();
            $table->string('type')->nullable(); // Bière blonde, brune, etc.
            $table->string('taux_alcool')->nullable(); // 5%, etc.
            $table->string('conditionnement')->nullable(); // 33 cl et 50 cl
            $table->string('slogan')->nullable();
            $table->string('ddm')->nullable(); // Date Durabilité Minimale
            $table->string('type_bouteille')->nullable();
            $table->string('positionnement')->nullable(); // Premium, etc.
            $table->string('coeur_cible')->nullable();

            $table->json('video_urls')->nullable(); // URLs YouTube embed

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
