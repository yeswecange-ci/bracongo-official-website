<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_contact', function (Blueprint $table) {
            if (! Schema::hasColumn('page_contact', 'whatsapp_label')) {
                $table->string('whatsapp_label')->default('Discutons sur WhatsApp')->after('submit_label');
            }
            if (! Schema::hasColumn('page_contact', 'whatsapp_url')) {
                $table->string('whatsapp_url', 500)->default('#')->after('whatsapp_label');
            }
        });
    }

    public function down(): void
    {
        Schema::table('page_contact', function (Blueprint $table) {
            if (Schema::hasColumn('page_contact', 'whatsapp_url')) {
                $table->dropColumn('whatsapp_url');
            }
            if (Schema::hasColumn('page_contact', 'whatsapp_label')) {
                $table->dropColumn('whatsapp_label');
            }
        });
    }
};
