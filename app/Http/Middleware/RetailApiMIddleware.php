<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RetailApiMIddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if(!$user){
            return response()->json([
                "error" => "Unauthorized"
            ], 401);
        }
        return $user->role == 'retail' || $user->role == 'admin' ? $next($request) : response()->json([
            "error" => "Unauthorized"
        ], 401);
    }
}
