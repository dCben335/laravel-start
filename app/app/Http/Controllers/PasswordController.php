<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Password;
use Illuminate\Support\Facades\Auth;
 
class PasswordController extends Controller
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

    public function show() {
        $userId = Auth::user()->id;

        if ($userId) {
            $datas = Password::where('user_id', $userId)->get();
        
            return view('passwords', ['datas' => $datas]);

        } else return redirect('/login');
    }

    public function showOne(int $id) {
        $userId = Auth::user()->id;

        if ($userId) {
            $datas = Password::where('id', $id)->where('user_id', $userId)->first();
        
            return view('change-password', ['datas' => $datas]);

        } else return redirect('/login');
    }

    public function update(Request $request, int $id) {
        $request->validate([
            'newpwd' => 'required|string'
        ]);

        Password::where(['id' => $id])->first()->update(['password' => $request->newpwd]);

        return redirect('/passwords');

    }

}


?>