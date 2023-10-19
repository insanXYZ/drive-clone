<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

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
            return $next($request); 
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $token = JWTAuth::refresh();
            JWTAuth::setToken($token);
            return response()->json([
                "token" => $token,
            ],200);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                "success" => false,
                "message" => "Token invalid"
            ], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([
                "success" => false,
                "message" => "An error occurred"
            ], 500);
        }
    }
}