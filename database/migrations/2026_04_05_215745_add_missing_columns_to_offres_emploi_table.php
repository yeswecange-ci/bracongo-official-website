<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('offres_emploi', function (Blueprint $table) {
            if (! Schema::hasColumn('offres_emploi', 'lieu')) {
                $table->string('lieu')->nullable()->after('description');
            }
            if (! Schema::hasColumn('offres_emploi', 'type_contrat')) {
                $table->string('type_contrat')->nullable()->after('lieu');
            }
            if (! Schema::hasColumn('offres_emploi', 'date_limite_candidature')) {
                $table->date('date_limite_candidature')->nullable()->after('type_contrat');
            }
            if (! Schema::hasColumn('offres_emploi', 'require_lettre_motivation')) {
                $table->boolean('require_lettre_motivation')->default(false)->after('lien');
            }
        });
    }

    public function down(): void
    {
        Schema::table('offres_emploi', function (Blueprint $table) {
            $cols = array_filter([
                Schema::hasColumn('offres_emploi', 'lieu') ? 'lieu' : null,
                Schema::hasColumn('offres_emploi', 'type_contrat') ? 'type_contrat' : null,
                Schema::hasColumn('offres_emploi', 'date_limite_candidature') ? 'date_limite_candidature' : null,
                Schema::hasColumn('offres_emploi', 'require_lettre_motivation') ? 'require_lettre_motivation' : null,
            ]);
            if ($cols) {
                $table->dropColumn(array_values($cols));
            }
        });
    }
};
