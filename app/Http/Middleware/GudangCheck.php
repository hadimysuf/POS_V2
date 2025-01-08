<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GudangCheck
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') != 'pergudangan') {
            return redirect('/login')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
