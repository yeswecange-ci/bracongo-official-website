<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar', 512)->nullable();
            }
            if (! Schema::hasColumn('users', 'role')) {
                $table->string('role', 32)->default('editor');
            }
            if (! Schema::hasColumn('users', 'status')) {
                $table->string('status', 32)->default('active');
            }
            if (! Schema::hasColumn('users', 'invited_by')) {
                $table->foreignId('invited_by')->nullable()->constrained('users')->nullOnDelete();
            }
            if (! Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable();
            }
            if (! Schema::hasColumn('users', 'two_factor_secret')) {
                $table->text('two_factor_secret')->nullable();
            }
            if (! Schema::hasColumn('users', 'two_factor_recovery_codes')) {
                $table->text('two_factor_recovery_codes')->nullable();
            }
            if (! Schema::hasColumn('users', 'two_factor_confirmed_at')) {
                $table->timestamp('two_factor_confirmed_at')->nullable();
            }
            if (! Schema::hasColumn('users', 'two_factor_exempt')) {
                $table->boolean('two_factor_exempt')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $cols = ['avatar', 'role', 'status', 'invited_by', 'last_login_at',
                     'two_factor_secret', 'two_factor_recovery_codes',
                     'two_factor_confirmed_at', 'two_factor_exempt'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
