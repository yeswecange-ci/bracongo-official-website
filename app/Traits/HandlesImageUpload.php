<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HandlesImageUpload
{
    protected function uploadImage(UploadedFile $file, string $directory, string $prefix = 'img'): string
    {
        $path = public_path($directory);
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        $name = $prefix . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $name);
        return $directory . '/' . $name;
    }
}
