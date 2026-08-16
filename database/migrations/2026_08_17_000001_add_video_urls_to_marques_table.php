<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * La colonne `video_urls` avait été ajoutée directement dans la migration
 * `create_marques_table`, déjà exécutée en production : la table n'a donc
 * jamais reçu la colonne. On la rattrape ici, sans casser les bases
 * (locales / neuves) où elle existe déjà.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('marques', 'video_urls')) {
            return;
        }

        Schema::table('marques', function (Blueprint $table) {
            $table->json('video_urls')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        // Pas de rollback : la colonne fait partie du schéma de `create_marques_table`.
    }
};
