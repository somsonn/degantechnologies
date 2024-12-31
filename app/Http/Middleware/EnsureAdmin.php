<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->email !== 'admin@gmail.com') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}