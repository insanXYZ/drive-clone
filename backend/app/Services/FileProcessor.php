<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class FileProcessor {
  public static function process($files){
    $datas = [];

    $path = "uploads/" . JWTAuth::user()->id;
    $extension = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg','mp4', 'mov', 'avi', 'flv', 'wmv', 'mkv', 'webm'];

    foreach ($files as $file) {
      
        if (in_array(strtolower($file->getClientOriginalExtension()), $extension)) {

            $originalPath = $file->storeAs($path, $file->getClientOriginalName());

            if (!File::isDirectory(storage_path("app\\public\\uploads\\". JWTAuth::user()->id . "\\thumbImage"))) {
                File::makeDirectory(storage_path("app\\public\\uploads\\". JWTAuth::user()->id . "\\thumbImage"), 0777, true, true);
            }

            Image::make(storage_path("app\\public\\".$originalPath))->crop(200,200)->resize(200, 200)->save(storage_path("app\\public\\". $path . "\\thumbImage\\". $file->getClientOriginalName() ),80, $file->getClientOriginalExtension());
          }
    }  
  }
}