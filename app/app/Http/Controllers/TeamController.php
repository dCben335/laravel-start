<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teams;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|string|url',
            'login' => 'required|string',
            'pwd' => 'required|string'
        ]);

        $userId = Auth::user()->id;

        if ($userId) {
            Password::create([
                'site' => $request->url,
                'login' => $request->login,
                'password' => $request->pwd,
                "user_id" => $userId,
            ]);
        } else return redirect('/login');


        return redirect('/passwords');
    }

}
