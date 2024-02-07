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
    public function create(): View {
        // GET
        return view('teams/single/create');
    }

    public function show(): View {
        // GET        
        $user = User::find(Auth::user()->id);
        return view('teams/page', ['datas' => $user->teams]);
    }

    public function invitation(int $id): View {
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

        $team = Team::create([
            'name' => $request->name,
        ]);

        $user = User::find(Auth::user()->id); 
        $user->teams()->syncWithoutDetaching([$team->id]);

        return redirect(route('team.show'));
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
            $added->name, 
            User::find( Auth::user()->id)->name, 
            $team->name, 
            route("team.invitation", $id),
            now()->toDateTimeString()
        );

        foreach($team->users as $member) $member->notify($notif);

        return redirect(route('team.invitation', $id));
    }

   
}
