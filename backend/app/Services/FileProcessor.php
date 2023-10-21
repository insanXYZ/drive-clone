<?php

namespace App\Services;

use App\Models\File as ModelsFile;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class FileProcessor
{
  public static function process($files)
  {
    $userId = JWTAuth::user()->id;
    $path = "uploads/" . $userId;
    $extension = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg', 'mp4', 'mov', 'avi', 'flv', 'wmv', 'mkv', 'webm'];

    foreach ($files as $file) {
      $thumb = false;
      $originalPath = $file->storeAs($path, $file->getClientOriginalName());
      if (in_array(strtolower($file->getClientOriginalExtension()), $extension)) {
        $thumbnailPath = storage_path("app\\public\\" . $path . "\\thumbnail\\");

        if (!File::isDirectory($thumbnailPath)) {
          File::makeDirectory($thumbnailPath, 0777, true, true);
        }

        Image::make(storage_path("app\\public\\" . $originalPath))
            ->crop(200, 200)
            ->resize(200, 200)
            ->save($thumbnailPath . $file->getClientOriginalName(), 80, $file->getClientOriginalExtension());

        $thumb = true;
      }

      ModelsFile::create([
        "user_id" => $userId,
        "fileName" => $originalPath,
        "thumbnail" => $thumb ? $path."/thumbnail/". $file->getClientOriginalName() : null,
        "stared" => false
      ]);
    }

  }
}
