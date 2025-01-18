<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        $user = Auth::guard('api')->user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized: User not authenticated'], 401);
        }

        if ($user->email !== 'admin@gmail.com') {
            return response()->json(['error' => 'Admin access only'], 403);
        }

        return $next($request);
    }
}
