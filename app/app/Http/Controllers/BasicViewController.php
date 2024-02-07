<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class BasicViewController extends Controller {
    public function index() : View {
        return view('landing');
    }

    public function dashboard() : View {
        return view('dashboard');
    }
}
