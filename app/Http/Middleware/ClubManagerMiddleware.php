<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClubManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if already login
        if(!Auth::check()) {
            return redirect()->route('show.login')->with('error', 'Please login to access this page.');
        }

        $user = Auth::user();

        // check if club manager or clubadmin
        if($user->role !== 'club' && $user->role !== 'clubadmin') {
            return redirect()->route('show.login')->with('error', 'Unauthorized access.');
        }

        // check if user has a club assigned
        if(!$user->club_id) {
            return redirect()->route('show.login')->with('error', 'No club assigned to your account.');
        }

        return $next($request);
    }
}
