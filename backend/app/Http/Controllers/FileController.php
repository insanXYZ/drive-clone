<?php

namespace App\Http\Controllers;

use App\Http\Resources\filesResource;
use App\Models\File;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\FileProcessor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
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

    public function update($id, Request $request)
    {
        try{
            if($file = File::find($id)){
                $old = explode(".",$request->oldName);
                Storage::disk("public")->move("uploads/". JWTAuth::user()->id."/".$request->oldName , "uploads/". JWTAuth::user()->id."/".$request->newName .".". end($old));
                $file->update([
                    "fileName" => $request->newName .".". end($old)
                ]);
                return response()->json([
                    "success" > true
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                "success"=>false,
                "message" => $e
            ]);
        }
    }

    public function delete($id)
    {
        try{
            if($file = File::find($id)){
                $file->delete();
                return response()->json([
                    "success" > true
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                "success"=>false,
                "message" => $e
            ]);
        }
    }

    public function download($filename){
        if(Storage::disk("public")->exists("uploads/". JWTAuth::user()->id ."/". $filename)){
            return response()->download(storage_path()."/app/public/uploads/".JWTAuth::user()->id."/".$filename);
        }
    }

    // Trash

    public function getTrash()
    {
        $file = User::find(JWTAuth::user()->id)->file()->onlyTrashed()->get();
        return filesResource::collection($file);
    }

    public function restore(Request $request){
        $file = User::find(JWTAuth::user()->id)->file()->where("id",$request->id)->restore();
        return response()->json([
            "success"=>true
        ]);
    }

    public function forceDelete($id)
    {
        Storage::disk("public")->delete("uploads/".JWTAuth::user()->id."/".File::withTrashed()->find($id)->fileName);
        User::find(JWTAuth::user()->id)->file()->where("id",$id)->forceDelete();
        return response()->json([
            "success"=>true
        ]);    
    }
}