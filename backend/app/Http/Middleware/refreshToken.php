<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class refreshToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            if($user = JWTAuth::parseToken()->authenticate()){
                return response()->json([
                    "success" => false,
                    "message" => "authorize"
                ],400);
            }
        }catch(TokenExpiredException $e){
            return $next($request);
        }
    }
}

