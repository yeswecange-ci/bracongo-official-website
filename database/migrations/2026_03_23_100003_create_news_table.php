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
            $table->json('gallery_images')->nullable();
            $table->json('youtube_urls')->nullable();
            $table->string('lien_externe')->nullable();
            $table->string('whatsapp_url', 500)->nullable();
            $table->string('whatsapp_label', 200)->nullable();
            $table->date('date_publication')->nullable();
            $table->date('date_evenement')->nullable();
            $table->string('lieu')->nullable();
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'type', 'date_publication'], 'news_active_type_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
