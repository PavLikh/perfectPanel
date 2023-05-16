<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // B_qKHfkpiQMjA9CZ7GMqHMEGKJydfZifl4PpqujIyCePr_MVO5kzMamHGCnHczZa
        if(!preg_match('/^[a-zA-Z0-9_-]{64}$/', request()->bearerToken())) {
            return response([
                "status" =>  "error",
                "code" =>  403,
                "message" => "Invalid token"
            ], 403);
        }
        return $next($request);
    }
}
