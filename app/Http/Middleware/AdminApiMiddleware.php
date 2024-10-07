<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminApiMiddleware
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
        // dd($user->role);
        return $user->role == 'admin' ? $next($request) : response()->json([
            "error" => "Unauthorized"
        ], 401);
    }
}
