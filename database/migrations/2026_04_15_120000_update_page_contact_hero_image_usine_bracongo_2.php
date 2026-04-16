<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Migration neutre : pour un environnement en migrate:fresh --seed,
        // la valeur correcte est déjà gérée par la migration de création + seeder.
    }

    public function down(): void
    {
        // No-op.
    }
};
