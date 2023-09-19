<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

 
class PasswordController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|string|url',
            'email' => 'required|string|email',
            'pwd' => 'required|string'
        ]);

        $userId = Auth::user()->id;

        if ($userId) {
            Password::create([
                'site' => $request->url,
                'login' => $request->email,
                'password' => Hash::make($request->password),
                "user_id" => $userId,
            ]);
        }


        return redirect('/');
    }

    public function show() {
        $userId = Auth::user()->id;

        if ($userId) {
            $passwords = DB::table('passwords')->where('user_id', $userId)->get();
        
            return view('passwords', ['passwords' => $passwords]);

        } else redirect('/add-password');
    }

}


?>