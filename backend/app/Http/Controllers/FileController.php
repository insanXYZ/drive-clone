<?php

namespace App\Http\Controllers;

use App\Services\FileProcessor;
use Exception;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function input(Request $request)
    {
        try{
            if($request->hasFile("file")){
                FileProcessor::process($request->file("file"));

                return response()->json([
                    "success" => true
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                "success"=>false,
                "message" => $e
            ]);
        }
    }
}