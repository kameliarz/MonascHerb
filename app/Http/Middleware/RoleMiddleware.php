<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!session()->has('role') || session('role') !== $role) {
            return redirect('/')->with('error', 'Akses ditolak');
        }

        return $next($request);
    }
}
