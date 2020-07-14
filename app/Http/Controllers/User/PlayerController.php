<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User\Player;
use App\Models\User\Paramsetting;

class PlayerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the add player.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_player()
    {
        $paramsetting = Paramsetting::find(1);
        return view('user.add_player')
            ->with('paramsetting', $paramsetting);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_player(Request $request)
    {
        $player = new Player();

        $player->name = $request->name;
        $player->surename = $request->surename;
        $player->nationality = $request->nationality;
        $player->birth_date = $request->birthdate;
        $player->height = $request->height;
        $player->weight = $request->weight;
        $player->foot = $request->foot;

        // Photo
        if ($request->hasFile('photo')) {
            $player->photo = $request->file('photo')->store('avatars');
        }

        $player->current_team = $request->cur_team;

        // Position
        $player->main_pos = $request->main_pos;
        
        $subpositions = array();
        if ($request->position)
            $subpositions = $request->position;
        array_unshift($subpositions, $request->position2);

        $player->corners = $request->corners;
        $player->crossing = $request->crossing;
        $player->dribbling = $request->dribbling;
        $player->finishing = $request->finishing;
        $player->first_touch = $request->first_touch;
        $player->free_kick = $request->free_kick;
        $player->heading = $request->heading;
        $player->long_shots = $request->long_shots;
        $player->long_throws = $request->long_throws;
        $player->marking = $request->marking;
        $player->passing = $request->passing;
        $player->penalty_taking = $request->penalty_taking;
        $player->tackling = $request->tackling;
        $player->technique = $request->technique;
        $player->aggression = $request->aggression;
        $player->articipation = $request->articipation;
        $player->bravery = $request->bravery;
        $player->composure = $request->composure;
        $player->concentration = $request->concentration;
        $player->decisions = $request->decisions;
        $player->determination = $request->determination;
        $player->flair = $request->flair;
        $player->leadership = $request->leadership;
        $player->off_ball = $request->off_ball;
        $player->positioning = $request->positioning;
        $player->teamwork = $request->teamwork;
        $player->vision = $request->vision;
        $player->work_rate = $request->work_rate;
        $player->acceleration = $request->acceleration;
        $player->balance = $request->balance;
        $player->jumping_reach = $request->jumping_reach;
        $player->natural_fitness = $request->natural_fitness;
        $player->pace = $request->pace;
        $player->stamina = $request->stamina;
        $player->strength = $request->strength;
        $player->agility = $request->agility;
        
        $player->save();

        $player->storePositions($subpositions);

        return redirect('user/filter_show');
    }

    /**
     * Show the player.
     *
     * @param  \App\Models\User\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function player_profile(Player $player)
    {
        return view('user.player_profile')->with('data', $player);
    }

    /**
     * Filter the players
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function filter_player(Request $request)
    {
        $name = '';
        $nationality = array();
        $position = array();

        if ($request->name)
            $name = $request->name;

        $data = Player::where('name', 'LIKE', "%$name%");

        if ($request->nationality) {
            $nationality = $request->nationality;
            $data = $data->whereIn('nationality', $nationality);
        }

        if ($request->position) {
            $position = $request->position;
        }
        
        $data = $data->orWhere('surename', 'LIKE', "%$name%")
            ->get();


        return view('user.filter')
            ->with('filter', $request->all())
            ->with('data', $data);
    }

    /**
     * Show filter page
     * 
     * @return \Illuminate\Http\Response
     */
    public function filter_show()
    {
        return view("user.filter");
    }
}
