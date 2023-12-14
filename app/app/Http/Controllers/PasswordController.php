<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Password;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
 
class PasswordController extends Controller
{
    public function store(Request $request) {
        // POST

        if (!Auth::user()) return redirect(route('login'));

        $request->validate([
            'url' => 'required|string|url',
            'login' => 'required|string',
            'pwd' => 'required|string'
        ]);

        $userId = Auth::user()->id;
        Password::create([
            'site' => $request->url,
            'login' => $request->login,
            'password' => $request->pwd,
            "user_id" => $userId,
        ]);

        return redirect(route('password.show'));
    }

    public function show() {
        // GET
        if (!Auth::user()) return redirect(route('login'));

        $userId = Auth::user()->id;
        $datas = Password::where('user_id', $userId)->get();
    
        return view('passwords/page', ['datas' => $datas]);
    }

    public function showOne(int $id) {
        // GET
        if (!Auth::user()) return redirect(route('login'));

        $userId = Auth::user()->id;

        $password = Password::where('id', $id)->where('user_id', $userId)->first();
        $userTeams = User::find($userId)->teams;



        $teamsWithPasswordShared = [];

        foreach ($userTeams as $team) {
            $teamPassword = $team->passwords()->where('id', $id)->first();
            $team->isChecked = !is_null($teamPassword);
            $teamsWithPasswordShared[] = $team;
        }   
        return view('passwords/single/update', [
            'datas' => $password,
            'teams' => $teamsWithPasswordShared
        ]);
    }

    public function updatePwd(Request $request, int $id) {
        // POST
        if (!Auth::user()) return redirect(route('login'));

        $request->validate([
            'newpwd' => 'required|string'
        ]);

        Password::where(['id' => $id])->first()->update(['password' => $request->newpwd]);

        return redirect(route('password.show'));
    }

    public function udpdateTeam(Request $request, int $id) {
        if (!Auth::user()) return redirect(route('login'));

        $request->validate([
            'team' => 'array'
        ]);    

        $user = User::find(Auth::user()->id);
        $password = Password::where(['id' => $id])->first();

        $userTeams = $user->teams;
        $teamsNotToShare = $userTeams->pluck('id')->diff($request->team)->all();

        if ($request->team) {
            foreach($request->team as $team) {
                $teamId = intval($team);
                $password->teams()->syncWithoutDetaching([$teamId]);
            }
        }
        foreach($teamsNotToShare as $teamId) $password->teams()->detach([$teamId]);

        return redirect(route('password.show'));        
    }

}


?>