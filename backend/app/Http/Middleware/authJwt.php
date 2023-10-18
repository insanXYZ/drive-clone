<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class authJwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    try {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user) {
            return $next($request); 
        }
        return response()->json([
            "success" => false,
            "message" => "Unauthorized" 
        ], 401);
    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        return response()->json([
            "success" => false,
            "message" => "Token expired"
        ], 401);
    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        return response()->json([
            "success" => false,
            "message" => "Token invalid"
        ], 401);
    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json([
            "success" => false,
            "message" => "An error occurred"
        ], 500); // Status 500 untuk kesalahan server
    }
}

}