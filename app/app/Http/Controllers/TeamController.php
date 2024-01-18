<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TeamNotification;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function create() {
        // GET
        return view('teams/single/create');
    }

    public function show() {
        // GET        
        $user = User::find(Auth::user()->id);
        return view('teams/page', ['datas' => $user->teams]);
    }

    public function invitation(int $id) {
        // GET
        
        $user = User::find(Auth::user()->id);

        if (!$user->teams->contains($id)) return redirect(route('login'));

        $team = Team::find($id);
        
        $allUsers = User::all();
        $usersToInvite = array(); 
        foreach ($allUsers as $key => $value) {
            if (!$team->users->contains($value)) array_push($usersToInvite, $value);
        }
        
        return view('teams/single/invite', [
            'datas' => $team,
            'id' => $team->id,
            "passwords" => $team->passwords,
            'peoples' => $usersToInvite
        ]);
    }


    public function store(Request $request) {
        // POST
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

        } else return redirect('/login');


        return redirect('/teams');
    }



    public function invite(Request $request, int $id) {
        // POST

        $request->validate([
            'person-to-invite' => 'required|int'
        ]); 

        $added = User::find($request['person-to-invite']);
        $added->teams()->syncWithoutDetaching([$id]);
        $team = Team::find($id);

        $notif = new TeamNotification(
            User::find( Auth::user()->id)->name, 
            $added->name, 
            $team->name, 
            'http://localhost:8051/team/'. $id,
            now()->toDateTimeString()
        );

        foreach($team->users as $member) $member->notify($notif);

        return redirect('/teams/'. $id .'/invite');
    }

   
}
