<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        $isAdmin = false;
        if ($user) {
            $isAdmin = ($user->role ?? null) === 'admin'
                || (isset($user->is_admin) && (int)$user->is_admin === 1);
        }

        if ($isAdmin) {
            return $next($request);
        }

        return redirect()->route('user.dashboard');
    }
}
            