<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            JWTAuth::parseToken()->authenticate();
        }catch(JWTException $ex) {
            return response()->json([
                'status' => $ex->getCode(),
                'errors' => $ex->getMessage(),
                'mensagem' => 'Token inválido!'
            ]);
        }catch(TokenInvalidException $ex) {
            return response()->json([
                'status' => $ex->getCode(),
                'errors' => $ex->getMessage(),
                'mensagem' => 'Token expirado!'
            ]);
        }
        return $next($request);
    }

}
