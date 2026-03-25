<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('marques') && Schema::hasColumn('marques', 'image_banner')) {
            Schema::table('marques', function (Blueprint $table) {
                $table->dropColumn('image_banner');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('marques') && !Schema::hasColumn('marques', 'image_banner')) {
            Schema::table('marques', function (Blueprint $table) {
                $table->string('image_banner')->nullable()->after('image');
            });
        }
    }
};
