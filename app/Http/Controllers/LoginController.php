<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Menyimpan data ke session
        session(['username' => 'admin']);
        return redirect('/')->with('success', 'Logged in successfully.');
    }
}
