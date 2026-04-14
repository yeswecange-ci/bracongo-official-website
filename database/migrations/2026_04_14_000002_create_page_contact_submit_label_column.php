<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('page_contact', 'submit_label')) {
            Schema::table('page_contact', function (Blueprint $table) {
                $table->string('submit_label')->default('Envoyer')->after('form_titre');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('page_contact', 'submit_label')) {
            Schema::table('page_contact', function (Blueprint $table) {
                $table->dropColumn('submit_label');
            });
        }
    }
};
