<?php

namespace App\Http\Controllers;

use App\Http\Resources\filesResource;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\FileProcessor;
use Tymon\JWTAuth\Facades\JWTAuth;

class FileController extends Controller
{
    public function index()
    {
        return filesResource::collection(User::find(JWTAuth::user()->id)->file);
    }

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