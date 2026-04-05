<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatures_emploi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offre_emploi_id')->constrained('offres_emploi')->cascadeOnDelete();
            $table->string('prenom');
            $table->string('nom');
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->text('message')->nullable();
            $table->text('lettre_motivation')->nullable();
            $table->string('cv_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidatures_emploi');
    }
};
