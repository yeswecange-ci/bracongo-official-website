<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offres_emploi', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('lieu')->nullable();
            $table->string('type_contrat')->nullable();
            $table->date('date_limite_candidature')->nullable();
            $table->string('image')->nullable();
            $table->string('lien')->default('#');
            $table->boolean('require_lettre_motivation')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offres_emploi');
    }
};
