<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Actualités, événements, activations, sponsoring, communiqués, médiathèque.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->string('type'); // actualites, evenements, activations, sponsoring, communiques, mediatheque
            $table->text('extrait')->nullable();
            $table->longText('contenu')->nullable();
            $table->string('image')->nullable();
            $table->string('lien_externe')->nullable();
            $table->date('date_publication')->nullable();
            $table->date('date_evenement')->nullable(); // pour les événements
            $table->string('lieu')->nullable(); // pour les événements
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
