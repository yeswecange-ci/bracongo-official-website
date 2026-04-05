<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HandlesImageUpload
{
    /** Extensions autorisées et leurs types MIME correspondants. */
    private const ALLOWED_IMAGE_MIMES = [
        'image/jpeg' => 'jpg',
        'image/jpg'  => 'jpg',
        'image/png'  => 'png',
        'image/gif'  => 'gif',
        'image/webp' => 'webp',
    ];

    protected function uploadImage(UploadedFile $file, string $directory, string $prefix = 'img'): string
    {
        // Vérification du type MIME réel (pas le nom fourni par le client)
        $mime = $file->getMimeType() ?? '';
        $ext = self::ALLOWED_IMAGE_MIMES[$mime] ?? null;

        if ($ext === null) {
            abort(422, 'Format d\'image non autorisé.');
        }

        $path = public_path($directory);
        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $name = $prefix.'_'.time().'_'.bin2hex(random_bytes(6)).'.'.$ext;
        $file->move($path, $name);

        return $directory.'/'.$name;
    }

    /** Supprime un fichier image du dossier public si il existe. */
    protected function deleteImageFile(?string $relativePath): void
    {
        if ($relativePath === null || $relativePath === '') {
            return;
        }
        $fullPath = public_path($relativePath);
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}
