<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_welcome', function (Blueprint $table) {
            $table->id();
            $table->string('fond_image')->default('img/fete.png');
            $table->string('titre')->default('BIENVENUE SUR LE SITE BRACONGO SA');
            $table->string('texte_avertissement', 500)->default('Ce site web contient des informations sur nos boissons alcoolisées. En cliquant sur l\'un des boutons ci-dessous, vous confirmez être majeur dans votre pays de résidence.');
            $table->string('btn_majeur_texte')->default('J\'ai plus de 18 ans');
            $table->string('btn_mineur_texte')->default('J\'ai moins de 18 ans');
            $table->string('message_refus')->default('Nous sommes désolés, vous n\'avez pas l\'âge requis pour accéder à ce site.');
            $table->string('mention_legale', 500)->default("L'abus de l'alcool est dangereux pour la santé, à consommer avec modération.");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_welcome');
    }
};
