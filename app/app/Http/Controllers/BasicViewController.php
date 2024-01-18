<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicViewController extends Controller
{
    public function index() {
        return view('landing');
    }

    public function dashboard() {
        return view('dashboard');
    }

    
}
