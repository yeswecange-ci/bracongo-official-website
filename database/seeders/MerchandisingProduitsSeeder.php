<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

/**
 * Goodies / merchandising (boutique, panier).
 *
 * Les images sont lues dans public/img/ : le premier fichier dont le nom (sans extension)
 * correspond à une entrée de "fichiers" dans definitions() — webp, jpg, jpeg, png, gif.
 *
 * La colonne produits.image stocke le chemin relatif sous public (ex. img/glaciere-bracongo.webp).
 * Pas de copie vers uploads/produits : les fichiers restent dans img/.
 */
class MerchandisingProduitsSeeder extends Seeder
{
    private const EXTENSIONS = ['webp', 'jpg', 'jpeg', 'png', 'gif'];

    private const IMAGE_DIR = 'img';

    public function run(): void
    {
        $imgDir = public_path(self::IMAGE_DIR);
        $dirs = is_dir($imgDir) ? [$imgDir] : [];

        if ($dirs === []) {
            $this->command?->warn('Dossier public/img introuvable : les produits seront créés sans image.');
        }

        foreach ($this->definitions() as $def) {
            $src = $this->findFirstFile($dirs, $def['fichiers']);
            $relative = null;

            if ($src !== null) {
                $relative = self::IMAGE_DIR.'/'.basename($src);
            } else {
                $this->command?->warn('Image introuvable dans public/img pour « '.$def['nom'].' » (noms attendus : '.implode(', ', $def['fichiers']).').');
            }

            Produit::updateOrCreate(
                ['slug' => $def['slug']],
                [
                    'nom' => $def['nom'],
                    'description' => $def['description'],
                    'image' => $relative,
                    'prix' => $def['prix'],
                    'stock' => $def['stock'],
                    'reference' => $def['reference'],
                    'ordre' => $def['ordre'],
                    'is_active' => true,
                ]
            );
        }
    }

    /**
     * @param  list<string>  $dirs
     * @param  list<string>  $baseNames  sans extension
     */
    private function findFirstFile(array $dirs, array $baseNames): ?string
    {
        foreach ($dirs as $dir) {
            foreach ($baseNames as $base) {
                foreach (self::EXTENSIONS as $ext) {
                    $path = $dir.DIRECTORY_SEPARATOR.$base.'.'.$ext;
                    if (is_file($path)) {
                        return $path;
                    }
                }
            }
        }

        return null;
    }

    /**
     * @return list<array{slug: string, nom: string, description: string, fichiers: list<string>, prix: ?float, stock: int, reference: string, ordre: int}>
     */
    private function definitions(): array
    {
        return [
            [
                'slug' => 'set-de-verres-primus-6-pcs',
                'nom' => 'Set de verres Primus (6 pcs)',
                'description' => 'Coffret de 6 verres de dégustation Primus, logo officiel.',
                'fichiers' => ['set-de-verres-primus-6-pcs', 'set-verres-primus', 'verres-primus-6pcs', 'primus-verres'],
                'prix' => null,
                'stock' => 30,
                'reference' => 'MERCH-VER-PRI-6',
                'ordre' => 1,
            ],
            [
                'slug' => 'glaciere-bracongo',
                'nom' => 'Glacière Bracongo',
                'description' => 'Glacière promotionnelle aux couleurs Bracongo, logo buffle.',
                'fichiers' => ['glaciere-bracongo', 'glaciere', 'cooler-bracongo'],
                'prix' => null,
                'stock' => 15,
                'reference' => 'MERCH-GLA-BRC',
                'ordre' => 2,
            ],
            [
                'slug' => 'casquette-bracongo',
                'nom' => 'Casquette Bracongo',
                'description' => 'Casquette noire avec logo circulaire Bracongo.',
                'fichiers' => ['casquette-bracongo', 'casquette', 'cap-bracongo'],
                'prix' => null,
                'stock' => 40,
                'reference' => 'MERCH-CAS-BRC',
                'ordre' => 3,
            ],
            [
                'slug' => 'polo-bracongo-pro-bordeaux',
                'nom' => 'Polo Bracongo Pro (bordeaux)',
                'description' => 'Polo manches courtes bordeaux, logo Bracongo poitrine.',
                'fichiers' => ['polo-bracongo-pro-bordeaux', 'polo-bordeaux', 'polo-bracongo-pro-1'],
                'prix' => null,
                'stock' => 25,
                'reference' => 'MERCH-POL-BRD',
                'ordre' => 4,
            ],
            [
                'slug' => 'polo-bracongo-pro-rouge',
                'nom' => 'Polo Bracongo Pro (rouge)',
                'description' => 'Polo manches courtes rouge, logo Bracongo poitrine.',
                'fichiers' => ['polo-bracongo-pro-rouge', 'polo-rouge', 'polo-bracongo-pro-2'],
                'prix' => null,
                'stock' => 25,
                'reference' => 'MERCH-POL-RGE',
                'ordre' => 5,
            ],
            [
                'slug' => 't-shirt-bracongo',
                'nom' => 'T-shirt Bracongo',
                'description' => 'T-shirt noir avec grand logo Bracongo poitrine et manche.',
                'fichiers' => ['t-shirt-bracongo', 'tshirt-bracongo', 'tee-bracongo'],
                'prix' => null,
                'stock' => 35,
                'reference' => 'MERCH-TSH-BRC',
                'ordre' => 6,
            ],
            [
                'slug' => 'mug-primus',
                'nom' => 'Mug Primus',
                'description' => 'Mug noir / intérieur blanc, branding Bracongo & Primus.',
                'fichiers' => ['mug-primus', 'mug-primus-bracongo', 'tasse-primus'],
                'prix' => null,
                'stock' => 50,
                'reference' => 'MERCH-MUG-PRI',
                'ordre' => 7,
            ],
        ];
    }
}
