<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class FileController extends Controller
{
    public function getAll()
    {
        //
    }

    public function getDetail()
    {
        //
    }

    public function input(Request $request)
    {
        try{
            if($request->hasFile("file")){

                foreach ($request->file("file") as $file){
                    $file->storeAs("uploads/". JWTAuth::user()->id,$file->getClientOriginalName());
                }

                return response()->json([
                    "success" => true,
                ]);

            }
        }catch(Exception $e){
            return response()->json([
                "success"=>false,
            ]);
        }


    }

    public function remove()
    {
        //
    }

    public function starred()
    {
        //
    }
}