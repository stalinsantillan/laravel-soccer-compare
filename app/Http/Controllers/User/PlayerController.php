<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User\Player;

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
        return view('user.add_player');
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
        $player->sec_pos = $request->sec_pos;
        if ($request->third_pos)
            $player->third_pos = null;
        if ($request->fourth_pos)
            $player->fourth_pos = null;
        if ($request->fifth_pos)
            $player->fifth_pos = null;

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
        $player->tacking = $request->tacking;
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

        $player->save();
    }

    /**
     * Show the add player.
     *
     * @return \Illuminate\Http\Response
     */
    public function player_profile()
    {
        return view('user.player_profile');
    }
}
