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
        $parameters = array();
        $positions = array();
        $sum = 0;
        $count = 0;
        
        $player->name = $request->name;
        $player->surename = $request->surename;
        $player->nationality = $request->nationality;
        $player->birth_date = $request->birthdate;
        $player->height = $request->height;
        $player->weight = $request->weight;
        $player->foot = $request->foot;
        $player->current_team = $request->cur_team;

        // Photo
        if ($request->hasFile('photo')) {
            $player->photo = $request->file('photo')->store('avatars');
        }

        // Positions
        $main_position = $request->main_position;
        $spec_position = $request->spec_position;
        for ($i = 0; $i < sizeof($main_position); $i++) {
            $position['position'] = $main_position[$i];
            $position['specify'] = $spec_position[$i];
            array_push($positions, $position);
        }

        // Parameters
        if ($request->corners) {
            $parameters['corners'] = $request->corners;
        }

        if ($request->crossing) {
            $parameters['crossing'] = $request->crossing;
        }
        
        if ($request->dribbling) {
            $parameters['dribbling'] = $request->dribbling;
        }
        
        if ($request->finishing) {
            $parameters['finishing'] = $request->finishing;
        }
        
        if ($request->first_touch) {
            $parameters['first_touch'] = $request->first_touch;
        }
        
        if ($request->free_kick) {
            $parameters['free_kick'] = $request->free_kick;
        }
        
        if ($request->heading) {
            $parameters['heading'] = $request->heading;
        }
        
        if ($request->long_shots) {
            $parameters['long_shots'] = $request->long_shots;
        }
        
        if ($request->long_throws) {
            $parameters['long_throws'] = $request->long_throws;
        }
        
        if ($request->marking) {
            $parameters['marking'] = $request->marking;
        }
        
        if ($request->passing) {
            $parameters['passing'] = $request->passing;
        }
        
        if ($request->penalty_taking) {
            $parameters['penalty_taking'] = $request->penalty_taking;
        }
        
        if ($request->tackling) {
            $parameters['tackling'] = $request->tackling;
        }
        
        if ($request->technique) {
            $parameters['technique'] = $request->technique;
        }
        
        if ($request->aggression) {
            $parameters['aggression'] = $request->aggression;
        }
        
        if ($request->articipation) {
            $parameters['articipation'] = $request->articipation;
        }
        
        if ($request->bravery) {
            $parameters['bravery'] = $request->bravery;
        }
        
        if ($request->composure) {
            $parameters['composure'] = $request->composure;
        }
        
        if ($request->concentration) {
            $parameters['concentration'] = $request->concentration;
        }
        
        if ($request->decisions) {
            $parameters['decisions'] = $request->decisions;
        }
        
        if ($request->determination) {
            $parameters['determination'] = $request->determination;
        }
        
        if ($request->flair) {
            $parameters['flair'] = $request->flair;
        }
        
        if ($request->leadership) {
            $parameters['leadership'] = $request->leadership;
        }
        
        if ($request->off_ball) {
            $parameters['off_ball'] = $request->off_ball;
        }
        
        if ($request->positioning) {
            $parameters['positioning'] = $request->positioning;
        }
        
        if ($request->teamwork) {
            $parameters['teamwork'] = $request->teamwork;
        }
        
        if ($request->vision) {
            $parameters['vision'] = $request->vision;
        }
        
        if ($request->work_rate) {
            $parameters['work_rate'] = $request->work_rate;
        }
        
        if ($request->acceleration) {
            $parameters['acceleration'] = $request->acceleration;
        }
        
        if ($request->balance) {
            $parameters['balance'] = $request->balance;
        }
        
        if ($request->jumping_reach) {
            $parameters['jumping_reach'] = $request->jumping_reach;
        }
        
        if ($request->natural_fitness) {
            $parameters['natural_fitness'] = $request->natural_fitness;
        }
        
        if ($request->pace) {
            $parameters['pace'] = $request->pace;
        }
        
        if ($request->stamina) {
            $parameters['stamina'] = $request->stamina;
        }
        
        if ($request->strength) {
            $parameters['strength'] = $request->strength;
        }
        
        if ($request->agility) {
            $parameters['agility'] = $request->agility;
        }

        if ($request->shots) {
            $parameters['shots'] = $request->shots;
        }

        if ($request->offensive) {
            $parameters['offensive'] = $request->offensive;
        }

        if ($request->deffense) {
            $parameters['deffense'] = $request->deffense;
        }

        if ($request->aerial_duels) {
            $parameters['aerial_duels'] = $request->aerial_duels;
        }

        if ($request->reaction) {
            $parameters['reaction'] = $request->reaction;
        }

        if ($request->sprint_speed) {
            $parameters['sprint_speed'] = $request->sprint_speed;
        }

        if ($request->areial_reach) {
            $parameters['areial_reach'] = $request->areial_reach;
        }

        if ($request->command_of_area) {
            $parameters['command_of_area'] = $request->command_of_area;
        }

        if ($request->communication) {
            $parameters['communication'] = $request->communication;
        }

        if ($request->eccentricity) {
            $parameters['eccentricity'] = $request->eccentricity;
        }

        if ($request->first_touch) {
            $parameters['first_touch'] = $request->first_touch;
        }

        if ($request->handling) {
            $parameters['handling'] = $request->handling;
        }

        if ($request->kicking) {
            $parameters['kicking'] = $request->kicking;
        }

        if ($request->one_on_ones) {
            $parameters['one_on_ones'] = $request->one_on_ones;
        }

        if ($request->feet_playing) {
            $parameters['feet_playing'] = $request->feet_playing;
        }

        if ($request->passing) {
            $parameters['passing'] = $request->passing;
        }

        if ($request->punching) {
            $parameters['punching'] = $request->punching;
        }

        if ($request->reflexes) {
            $parameters['reflexes'] = $request->reflexes;
        }

        if ($request->rushing_out) {
            $parameters['rushing_out'] = $request->rushing_out;
        }

        if ($request->throwing) {
            $parameters['throwing'] = $request->throwing;
        }
        
        foreach ($parameters as $parameter) {
            $sum += $parameter;
            $count ++;
        }
        $player->general_average = $sum / $count;

        $player->save();

        $player->storePositions($positions);
        $player->storeParameters($parameters);

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
        $data = Player::orderBy('general_average')->limit(10)->get();

        return view("user.filter")
            ->with('data', $data);
    }
}
