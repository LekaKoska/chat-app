<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

trait UploadImage
{
    public function avatarUpload($file, $path)
    {
        $name = uniqid(). ".webp";
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->toWebp();
        Storage::disk(name: 'public')->put(path: "/$path/$name", contents: (string)$image);

        return $name;
    }
}
