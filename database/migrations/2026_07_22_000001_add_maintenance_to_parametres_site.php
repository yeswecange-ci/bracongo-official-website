<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('parametres_site', function (Blueprint $table) {
            $table->boolean('maintenance_active')->default(false)->after('telephone_public');
            $table->string('maintenance_titre')->nullable()->after('maintenance_active');
            $table->text('maintenance_message')->nullable()->after('maintenance_titre');
        });
    }

    public function down(): void
    {
        Schema::table('parametres_site', function (Blueprint $table) {
            $table->dropColumn(['maintenance_active', 'maintenance_titre', 'maintenance_message']);
        });
    }
};
