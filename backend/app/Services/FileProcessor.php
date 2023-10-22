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
      $fileName = $file->getClientOriginalName();
      $file->storeAs($path, $file->getClientOriginalName());
      if (in_array(strtolower($file->getClientOriginalExtension()), $extension)) {
        $thumb = true;
      }

      ModelsFile::create([
        "user_id" => $userId,
        "fileName" => $fileName,
        "type" => $thumb ? "image" : "doc",
        "stared" => false
      ]);
    }

  }
}
