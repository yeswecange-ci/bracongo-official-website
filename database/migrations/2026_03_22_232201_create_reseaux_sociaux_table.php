<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reseaux_sociaux', function (Blueprint $table) {
            $table->id();
            $table->string('platform'); // facebook, instagram, twitter
            $table->string('url')->default('#');
            $table->boolean('is_active')->default(true);
            $table->unsignedTinyInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reseaux_sociaux');
    }
};
