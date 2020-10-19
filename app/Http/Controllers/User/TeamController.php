<?php

namespace App\Http\Controllers\User;

use App\Models\User\League;
use App\Models\User\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teams = Team::query()->where("user_id", Auth::user()->id)->get();

        return view('user.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $leagues = \App\Models\User\League::query()->where("user_id", Auth::user()->id)->get()->pluck("name", "id");
        return view('user.teams.create', compact('leagues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//            'league_id' => 'required',
//        ]);
//
//        if ($validator->fails()) {
//
//        }
        $league_name = $request->league;
        $logo = null;
        if($request->hasFile('logo')){
            $logo = $request->logo->store('logos');
        }
        if($league_name==null){
            $request->validate([
                'name' => 'required',
                'league_id' => 'required',
            ]);
            $request->request->add(['user_id' => Auth::user()->id]);
            $request->request->add(['img_logo' => $logo]);
            Team::create($request->all());
        }
        else{
            //create league first
            $user_id = Auth::user()->id;
            $league = League::create(['name'=>$league_name,'user_id'=>$user_id]);
            Team::create(['name'=>$request->name,'user_id'=>$user_id,'league_id'=>$league->id,'img_logo'=>$logo]);
        }

        return redirect()->route('user.teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
        $leagues = \App\Models\User\League::query()->where("user_id", Auth::user()->id)->get()->pluck("name", "id");
        return view('user.teams.edit', compact('leagues', 'team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required',
            'league_id' => 'required',
        ]);
        $request->request->add(['user_id' => Auth::user()->id]);
        $team->update($request->all());

        return redirect()->route('user.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
        $team->delete();

        return redirect()->route('user.teams.index');
    }
}
