<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\RecoveryCodes;
use Illuminate\Database\Seeder;

/**
 * Active la 2FA pour le compte super admin interne (sans toucher au reste des données).
 * Utile si la base existe déjà et que BracongoSeeder complet n’a pas été rejoué.
 *
 * php artisan db:seed --class=SuperAdminInternalTwoFactorSeeder
 */
class SuperAdminInternalTwoFactorSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('BRACONGO_SUPER_ADMIN_EMAIL', 'superadmin@bracongo.local');
        $secret = env('BRACONGO_SUPER_ADMIN_2FA_SECRET', 'JBSWY3DPEHPK3PXP');

        $user = User::query()->where('email', $email)->first();
        if ($user === null) {
            if ($this->command !== null) {
                $this->command->error("Aucun utilisateur avec l’e-mail {$email}.");
            }

            return;
        }

        if ($user->two_factor_exempt) {
            if ($this->command !== null) {
                $this->command->warn('Ce compte est un super admin technique (2FA exemptée). Le seeder interne 2FA ne s’applique pas.');
            }

            return;
        }

        $plainRecovery = RecoveryCodes::generatePlain(8);

        $user->forceFill([
            'two_factor_secret' => $secret,
            'two_factor_recovery_codes' => RecoveryCodes::hash($plainRecovery),
            'two_factor_confirmed_at' => now(),
        ])->save();

        if ($this->command !== null) {
            $this->command->info("2FA activée pour {$email}.");
            $this->command->warn('Clé TOTP (Google Authenticator, saisie manuelle) :');
            $this->command->line('  '.$secret);
            $this->command->warn('Codes de récupération :');
            foreach ($plainRecovery as $code) {
                $this->command->line('  '.$code);
            }
        }
    }
}
