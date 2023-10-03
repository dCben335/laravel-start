<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TeamNotification;

class TeamController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:teams',
        ]);

        $userId = Auth::user()->id;

        if ($userId) {
            $team = Team::create([
                'name' => $request->name,
            ]);

            $user = User::find($userId); 
            $user->teams()->syncWithoutDetaching([$team->id]);

            $notification = new TeamNotification($user->name, "jean-paul", $team->name, now()->toDateTimeString());
            $user->notify($notification);

        } else return redirect('/login');


        return redirect('/teams');
    }

    public function show() {
        $userId = Auth::user()->id;
        
        if ($userId) {
            $user = User::find( $userId );
            $datas = $user->teams;
        
            return view('teams', ['datas' => $datas]);
        } else return redirect('/login');
    }

}
