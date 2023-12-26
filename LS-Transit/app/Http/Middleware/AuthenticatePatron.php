<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatePatron
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( $request->session()->missing('user') )
            return to_route('view_signin');
        $user = $request->session()->get('user');
        if ( !$user->admin )
            return to_route('view_account');
        return $next($request);
    }
}
