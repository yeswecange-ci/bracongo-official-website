<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status', 32)->default('active')->after('role');
            $table->foreignId('invited_by')->nullable()->after('status')->constrained('users')->nullOnDelete();
            $table->timestamp('last_login_at')->nullable()->after('invited_by');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['invited_by']);
            $table->dropColumn(['status', 'invited_by', 'last_login_at']);
        });
    }
};
