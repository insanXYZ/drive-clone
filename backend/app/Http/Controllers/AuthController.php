<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{    
    public function register(Request $request)
    {
        $credentials = $request->only(["name","email","password"]);

        $validate = Validator::make($credentials ,[
            "name" => ["required"],
            "email" => ["required","email","unique:users,email"],
            "password" => ["required","min:8"]
        ]);

        if($validate->fails()){
            return response()->json([
                "success" => false,
                "message" => $validate->getMessageBag()
            ]);
        }

        $credentials["password"] = bcrypt($credentials["password"]);

        $user = User::create($credentials);

        return response()->json([
            "success" => true,
            "user" => $user
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(["email","password"]);

        $validate = Validator::make($credentials ,[
            "email" => ["required","email"],
            "password" => ["required","min:8"]
        ]);

        if($validate->fails()){
            return response()->json([
                "success" => false,
                "message" => $validate->getMessageBag()
            ]);
        }

        if(! $token = JWTAuth::attempt($credentials) ) 
        {
            return response()->json([
                "success" => false,
                "message" => "Unauthorized"
            ],401);
        }

        return response()->json([
            "success" => true,
            "token" => $token,
            "expires_in" => config("jwt.ttl")
        ]);
    }

    public function refresh()
    {
        $token = JWTAuth::refresh();
        JWTAuth::setToken($token);
        return response()->json([
            "token" => $token
        ]);
    }
}