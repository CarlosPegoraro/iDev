<?php

namespace App\Http\Middleware;

use App\Models\SeassionToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateSeassionToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!SeassionToken::where('token' , '=', $request->header('authToken'))) {
            return response()->json(['warning' => 'seassion expired'], 419);
        }
        return $next($request);
    }
}
