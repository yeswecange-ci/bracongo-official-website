<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $accented = '/Actualités-et-evenements';
        $plain = '/Actualites-et-evenements';

        if (Schema::hasTable('page_accueil') && Schema::hasColumn('page_accueil', 'actualites_voir_plus_lien')) {
            DB::table('page_accueil')
                ->where('actualites_voir_plus_lien', $accented)
                ->update(['actualites_voir_plus_lien' => $plain]);
        }

        if (Schema::hasTable('navigation_items') && Schema::hasColumn('navigation_items', 'url')) {
            DB::table('navigation_items')
                ->where('url', $accented)
                ->update(['url' => $plain]);
        }
    }

    public function down(): void
    {
        $accented = '/Actualités-et-evenements';
        $plain = '/Actualites-et-evenements';

        if (Schema::hasTable('page_accueil') && Schema::hasColumn('page_accueil', 'actualites_voir_plus_lien')) {
            DB::table('page_accueil')
                ->where('actualites_voir_plus_lien', $plain)
                ->update(['actualites_voir_plus_lien' => $accented]);
        }

        if (Schema::hasTable('navigation_items') && Schema::hasColumn('navigation_items', 'url')) {
            DB::table('navigation_items')
                ->where('url', $plain)
                ->update(['url' => $accented]);
        }
    }
};
