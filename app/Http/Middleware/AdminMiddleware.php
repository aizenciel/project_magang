<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && stripos(Auth::user()->email, 'admin') !== false) {
            return $next($request);
        }
        
        return redirect()->route('landing.index')
            ->with('error', 'You do not have permission to access this area.');
    }
} 