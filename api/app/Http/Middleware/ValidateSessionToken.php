<?php

namespace App\Http\Middleware;

use App\Models\SessionToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateSessionToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!SessionToken::where('token' , '=', $request->header('authToken'))->first()) {
            return response()->json(['warning' => 'seassion expired'], 419);
        }
        return $next($request);
    }
}
