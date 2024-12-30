<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GudangCheck
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil role dari session
        $role = session('role');

        // Periksa apakah user memiliki role_id = 4 untuk gudang
        if (!$role || $role !== 4) {
            return redirect('/login')->with('error', 'Unauthorized Access!');
        }

        return $next($request);
    }
}
