<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('parametres_site') || ! Schema::hasColumn('parametres_site', 'invitation_expires_hours')) {
            return;
        }

        $driver = Schema::getConnection()->getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            $col = DB::selectOne(
                'SHOW COLUMNS FROM parametres_site WHERE Field = ?',
                ['invitation_expires_hours']
            );
            if ($col && str_contains(strtolower((string) $col->Type), 'enum')) {
                DB::table('parametres_site')
                    ->whereNotIn('invitation_expires_hours', ['12', '24', '48', '72'])
                    ->update(['invitation_expires_hours' => '48']);

                return;
            }
        }

        DB::table('parametres_site')
            ->where(function ($q) {
                $q->whereNull('invitation_expires_hours')
                    ->orWhereNotIn('invitation_expires_hours', [12, 24, 48, 72]);
            })
            ->update(['invitation_expires_hours' => 48]);
    }

    public function down(): void
    {
        //
    }
};
