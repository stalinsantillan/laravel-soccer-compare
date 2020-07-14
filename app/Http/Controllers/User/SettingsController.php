<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\Paramsetting;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paramsetting_show()
    {
        return view('user.paramsetting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paramsetting_store(Request $request)
    {
        $paramsetting = Paramsetting::first();

        $paramsetting->corners = $request->corners;
        $paramsetting->crossing = $request->crossing;
        $paramsetting->dribbling = $request->dribbling;
        $paramsetting->finishing = $request->finishing;
        $paramsetting->first_touch = $request->first_touch;
        $paramsetting->free_kick = $request->free_kick;
        $paramsetting->heading = $request->heading;
        $paramsetting->long_shots = $request->long_shots;
        $paramsetting->long_throws = $request->long_throws;
        $paramsetting->marking = $request->marking;
        $paramsetting->passing = $request->passing;
        $paramsetting->penalty_taking = $request->penalty_taking;
        $paramsetting->tackling = $request->tackling;
        $paramsetting->technique = $request->technique;
        $paramsetting->aggression = $request->aggression;
        $paramsetting->articipation = $request->articipation;
        $paramsetting->bravery = $request->bravery;
        $paramsetting->composure = $request->composure;
        $paramsetting->concentration = $request->concentration;
        $paramsetting->decisions = $request->decisions;
        $paramsetting->determination = $request->determination;
        $paramsetting->flair = $request->flair;
        $paramsetting->leadership = $request->leadership;
        $paramsetting->off_ball = $request->off_ball;
        $paramsetting->positioning = $request->positioning;
        $paramsetting->teamwork = $request->teamwork;
        $paramsetting->vision = $request->vision;
        $paramsetting->work_rate = $request->work_rate;
        $paramsetting->acceleration = $request->acceleration;
        $paramsetting->balance = $request->balance;
        $paramsetting->jumping_reach = $request->jumping_reach;
        $paramsetting->natural_fitness = $request->natural_fitness;
        $paramsetting->pace = $request->pace;
        $paramsetting->stamina = $request->stamina;
        $paramsetting->strength = $request->strength;
        $paramsetting->agility = $request->agility;

        $paramsetting->save();
    }
}
