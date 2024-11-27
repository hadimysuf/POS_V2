<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        if (!session('username')) {
            return redirect('/login')->with('error', 'Please login first.');
        }
        $username = session('username');
        return view('index', compact('username'));
    }
}
