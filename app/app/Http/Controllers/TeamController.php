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
        } else return redirect('/login');


        return redirect('/teams');
    }

    public function show() {
        if (!Auth::user()) return redirect(route('login'));
        
        $userId = Auth::user()->id;
        $user = User::find( $userId );
        
        return view('teams', ['datas' => $user->teams]);
    }

    public function showOne(int $id) { 
        $team = Team::where('id', $id)->first();

        if (Auth::user()) {
            $userId = Auth::user()->id;
            if ($team->users->contains($userId)) return redirect('/team/'. $id .'/invite');
        }

        return view('single-team', ['datas' => $team]);
    }

    public function invitation(int $id) {
        if (!Auth::user()) return redirect(route('login'));
        
        $user = User::find( Auth::user()->id);
        
        if (!$user->teams->contains($id)) return redirect(route('login'));

        $team = Team::find($id);
        
        $allUsers = User::all();
        $usersToInvite = array(); 
        foreach ($allUsers as $key => $value) {
            if (!$team->users->contains($value)) array_push($usersToInvite, $value);
        }
        
        return view('invite-team', [
            'datas' => $team,
            'id' => $team->id,
            'name' => $team->name,
            'peoples' => $usersToInvite
        ]);
    }

    public function invite(Request $request, int $id) {
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
        return redirect('/team/'. $id .'/invite');
    }

   
}
