<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offres_emploi', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('titre');
        });

        // Backfill slugs for existing records
        $offres = DB::table('offres_emploi')->orderBy('id')->get(['id', 'titre']);
        foreach ($offres as $offre) {
            $base = Str::slug($offre->titre) ?: 'offre';
            $slug = $base;
            $n = 1;
            while (DB::table('offres_emploi')->where('slug', $slug)->exists()) {
                $slug = $base.'-'.(++$n);
            }
            DB::table('offres_emploi')->where('id', $offre->id)->update(['slug' => $slug]);
        }

        Schema::table('offres_emploi', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('offres_emploi', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
