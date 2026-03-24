<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FreshWithCleanUploads extends Command
{
    protected $signature = 'fresh:clean
                            {--no-seed : Ne pas exécuter les seeders}';

    protected $description = 'Réinitialise la base (migrate:fresh --seed) puis vide le dossier public/uploads/';

    public function handle(): int
    {
        $this->info('Réinitialisation de la base de données...');
        $this->call('migrate:fresh', [
            '--seed' => !$this->option('no-seed'),
            '--force' => true,
        ]);

        $uploadsPath = public_path('uploads');

        if (!File::isDirectory($uploadsPath)) {
            File::makeDirectory($uploadsPath, 0755, true);
            $this->info('Dossier uploads créé.');
            return self::SUCCESS;
        }

        foreach (File::directories($uploadsPath) as $dir) {
            File::deleteDirectory($dir);
        }
        foreach (File::files($uploadsPath) as $file) {
            File::delete($file);
        }

        $this->info('Dossier uploads nettoyé.');

        return self::SUCCESS;
    }
}
