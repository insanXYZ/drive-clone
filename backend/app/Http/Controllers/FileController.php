<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class FileController extends Controller
{
    public function input(Request $request)
{
    try {
        if ($request->hasFile("file")) {
            $path = "uploads/" . JWTAuth::user()->id;
            $pathThumb = "uploads/" . JWTAuth::user()->id . "/thumb";
            $extension = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg','mp4', 'mov', 'avi', 'flv', 'wmv', 'mkv', 'webm'];

            foreach ($request->file("file") as $file) {
                if (in_array(strtolower($file->getClientOriginalExtension()), $extension)) {
                    Image::make($file->getRealPath())->resize(200,200)->save($pathThumb);
                }

                $file->storeAs($path, $file->getClientOriginalName());
            }

            return response()->json([
                "success" => true,
            ]);
        }
    } catch (Exception $e) {
        Log::error($e);
        return response()->json([
            "success" => false,
        ]);
    }
}
}