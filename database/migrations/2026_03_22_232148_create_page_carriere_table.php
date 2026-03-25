<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_carriere', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->default('img/rejoins.png');
            $table->string('hero_titre')->default('Rejoignez-nous');
            $table->string('texte_intro', 500)->default('Employer et former les bonnes personnes pour le poste est la clé de notre succès. Notre aspiration est d\'offrir le meilleur à nos clients et consommateurs et d\'offrir des produits de qualité à des prix abordables. Si vous appréciez l\'action, la qualité et l\'intégrité, notre entreprise est l\'endroit idéal pour vous');
            $table->string('offres_titre')->default('Nos offres d\'emploi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_carriere');
    }
};
