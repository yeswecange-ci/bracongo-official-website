<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('parametres_site')) {
            return;
        }
        if (Schema::hasColumn('parametres_site', 'contact_reply_closing')) {
            return;
        }

        Schema::table('parametres_site', function (Blueprint $table) {
            $table->text('contact_reply_closing')->nullable()->after('invitation_expires_hours');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('parametres_site') || ! Schema::hasColumn('parametres_site', 'contact_reply_closing')) {
            return;
        }

        Schema::table('parametres_site', function (Blueprint $table) {
            $table->dropColumn('contact_reply_closing');
        });
    }
};
