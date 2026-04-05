<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->string('type');
            $table->text('extrait')->nullable();
            $table->longText('contenu')->nullable();
            $table->string('image')->nullable();
            $table->string('lien_externe')->nullable();
            $table->date('date_publication')->nullable();
            $table->date('date_evenement')->nullable();
            $table->string('lieu')->nullable();
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
