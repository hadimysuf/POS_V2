<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Illuminate\Http\Request;

class KasirCheck
{
    public function handle($request, Closure $next)
    {
        $role = session('role');

        if ($role !== 'kasir') {
            return redirect('/login')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
