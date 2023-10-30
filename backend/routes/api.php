<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware("guest")->group(function(){
    Route::post("/register",[AuthController::class , "register"]);
    Route::post("/login",[AuthController::class , "login"]);
});

Route::middleware("auth.jwt")->group(function(){
    Route::post("/refresh",[AuthController::class ,"refresh"]);
    Route::post("/file",[FileController::class , "input"]);
    Route::put("/file/{id}",[FileController::class , "update"]);
    Route::get("/file",[FileController::class , "index"]);
    Route::get("/file/{fileName}",[FileController::class , "download"]);
    Route::put("/file/{id}", [FileController::class , "starred"]);
    Route::delete("/file/{id}",[FileController::class , "delete"] );
    Route::get("/trash",[FileController::class , "getTrash"]);
    Route::post("/trash",[FileController::class , "restore"]);
    Route::delete("/trash/{id}",[FileController::class , "forceDelete"]);
    Route::get("/starred",[FileController::class , "getStarred"]);
});

Route::get("/refresh", [AuthController::class, "refresh"])->middleware("refreshToken");
