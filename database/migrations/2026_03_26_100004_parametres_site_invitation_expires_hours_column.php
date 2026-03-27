<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Bases déjà créées avant l’ajout de la colonne dans create_parametres_site_table :
 * même contrainte ENUM que le create (alignée sur App\Enums\InvitationExpiresHours).
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('parametres_site', 'invitation_expires_hours')) {
            Schema::table('parametres_site', function (Blueprint $table) {
                $table->enum('invitation_expires_hours', ['12', '24', '48', '72'])->default('48')->after('actualites_filtre_tout_label');
            });
        }
    }
    public function down(): void
    {
        if (Schema::hasColumn('parametres_site', 'invitation_expires_hours')) {
            Schema::table('parametres_site', function (Blueprint $table) {
                $table->dropColumn('invitation_expires_hours');
            });
        }
    }
};
