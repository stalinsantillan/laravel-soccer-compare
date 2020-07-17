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
//        dd($this->getToken());
        $_token = array("user"=>array("token"=>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InN0YWxpbi5zYW50aWxsYW5AaW5zdGF0c3BvcnQuY29tIiwidG9rZW4iOiJlNzFkNGJlNTU4MThmY2E3NWMxNGRlYzg1OGRmYmUwNiIsImlhdCI6MTU5NDk3NzM0M30.se9CGcDhiQE0yHyMwaTRdIzV3c4Za7LjBPaZjF5Tr68")); //json_encode($this->getToken());
        return view('user.add_player')
            ->with('paramsetting', $paramsetting)
            ->with('_token', json_encode($_token));
    }

    public function getToken()
    {
        $url = "https://api-football.instatscout.com/users/login";
        $value = array (
            'accepted_terms' => false,
            'force' => false,
            'user' =>
                array (
                    'email' => 'stalin.santillan@instatsport.com',
                    'password' => '1718750274',
                ),
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($value),
            CURLOPT_HTTPHEADER => array(
//                "Authorization: Bearer $access_token",
                "Content-Type: application/json"
            ),
        ));

        $result = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($result, true);
        return $response;
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
        $parameters = array(); $technicals = array(); $physicals = array(); $mentals = array(); $goalkeepers = array(); $positions = array();
        $sum = 0; $count = 0;
        
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

        // Parameters, technicals
        if ($request->corners) {
            $parameters['corners'] = $request->corners;
            $technicals['corners'] = $request->corners;
        }

        if ($request->crossing) {
            $parameters['crossing'] = $request->crossing;
            $technicals['crossing'] = $request->crossing;
        }
        
        if ($request->dribbling) {
            $parameters['dribbling'] = $request->dribbling;
            $technicals['dribbling'] = $request->dribbling;
        }
        
        if ($request->finishing) {
            $parameters['finishing'] = $request->finishing;
            $technicals['finishing'] = $request->finishing;
        }
        
        if ($request->first_touch) {
            $parameters['first_touch'] = $request->first_touch;
            $technicals['first_touch'] = $request->first_touch;
        }
        
        if ($request->free_kick) {
            $parameters['free_kick'] = $request->free_kick;
            $technicals['free_kick'] = $request->free_kick;
        }
        
        if ($request->heading) {
            $parameters['heading'] = $request->heading;
            $technicals['heading'] = $request->heading;
        }
        
        if ($request->long_shots) {
            $parameters['long_shots'] = $request->long_shots;
            $technicals['long_shots'] = $request->long_shots;
        }
        
        if ($request->long_throws) {
            $parameters['long_throws'] = $request->long_throws;
            $technicals['long_throws'] = $request->long_throws;
        }
        
        if ($request->marking) {
            $parameters['marking'] = $request->marking;
            $technicals['marking'] = $request->marking;
        }
        
        if ($request->passing) {
            $parameters['passing'] = $request->passing;
            $technicals['passing'] = $request->passing;
        }
        
        if ($request->penalty_taking) {
            $parameters['penalty_taking'] = $request->penalty_taking;
            $technicals['penalty_taking'] = $request->penalty_taking;
        }
        
        if ($request->tackling) {
            $parameters['tackling'] = $request->tackling;
            $technicals['tackling'] = $request->tackling;
        }
        
        if ($request->technique) {
            $parameters['technique'] = $request->technique;
            $technicals['technique'] = $request->technique;
        }

        if ($request->shots) {
            $parameters['shots'] = $request->shots;
            $technicals['shots'] = $request->shots;
        }

        if ($request->offensive) {
            $parameters['offensive'] = $request->offensive;
            $technicals['offensive'] = $request->offensive;
        }

        if ($request->deffense) {
            $parameters['deffense'] = $request->deffense;
            $technicals['deffense'] = $request->deffense;
        }

        if ($request->areial_reach) {
            $parameters['areial_reach'] = $request->areial_reach;
            $technicals['areial_reach'] = $request->areial_reach;
            $goalkeepers['areial_reach'] = $request->areial_reach;
        }

        if ($request->command_of_area) {
            $parameters['command_of_area'] = $request->command_of_area;
            $technicals['command_of_area'] = $request->command_of_area;
            $goalkeepers['command_of_area'] = $request->command_of_area;
        }

        if ($request->communication) {
            $parameters['communication'] = $request->communication;
            $technicals['communication'] = $request->communication;
            $goalkeepers['communication'] = $request->communication;
        }

        if ($request->eccentricity) {
            $parameters['eccentricity'] = $request->eccentricity;
            $technicals['eccentricity'] = $request->eccentricity;
            $goalkeepers['eccentricity'] = $request->eccentricity;
        }

        if ($request->first_touch) {
            $parameters['first_touch'] = $request->first_touch;
            $technicals['first_touch'] = $request->first_touch;
            $goalkeepers['first_touch'] = $request->first_touch;
        }

        if ($request->handling) {
            $parameters['handling'] = $request->handling;
            $technicals['handling'] = $request->handling;
            $goalkeepers['handling'] = $request->handling;
        }

        if ($request->kicking) {
            $parameters['kicking'] = $request->kicking;
            $technicals['kicking'] = $request->kicking;
            $goalkeepers['kicking'] = $request->kicking;
        }

        if ($request->one_on_ones) {
            $parameters['one_on_ones'] = $request->one_on_ones;
            $technicals['one_on_ones'] = $request->one_on_ones;
            $goalkeepers['one_on_ones'] = $request->one_on_ones;
        }

        if ($request->feet_playing) {
            $parameters['feet_playing'] = $request->feet_playing;
            $technicals['feet_playing'] = $request->feet_playing;
            $goalkeepers['feet_playing'] = $request->feet_playing;
        }

        if ($request->passing) {
            $parameters['passing'] = $request->passing;
            $technicals['passing'] = $request->passing;
            $goalkeepers['passing'] = $request->passing;
        }

        if ($request->punching) {
            $parameters['punching'] = $request->punching;
            $technicals['punching'] = $request->punching;
            $goalkeepers['punching'] = $request->punching;
        }

        if ($request->reflexes) {
            $parameters['reflexes'] = $request->reflexes;
            $technicals['reflexes'] = $request->reflexes;
            $goalkeepers['reflexes'] = $request->reflexes;
        }

        if ($request->rushing_out) {
            $parameters['rushing_out'] = $request->rushing_out;
            $technicals['rushing_out'] = $request->rushing_out;
            $goalkeepers['rushing_out'] = $request->rushing_out;
        }

        if ($request->throwing) {
            $parameters['throwing'] = $request->throwing;
            $technicals['throwing'] = $request->throwing;
            $goalkeepers['throwing'] = $request->throwing;
        }
        
        // Parameters, mentals
        if ($request->aggression) {
            $parameters['aggression'] = $request->aggression;
            $mentals['aggression'] = $request->aggression;
            $goalkeepers['aggression'] = $request->aggression;
        }
        
        if ($request->articipation) {
            $parameters['articipation'] = $request->articipation;
            $mentals['articipation'] = $request->articipation;
        }
        
        if ($request->bravery) {
            $parameters['bravery'] = $request->bravery;
            $mentals['bravery'] = $request->bravery;
            $goalkeepers['bravery'] = $request->bravery;
        }
        
        if ($request->composure) {
            $parameters['composure'] = $request->composure;
            $mentals['composure'] = $request->composure;
            $goalkeepers['composure'] = $request->composure;
        }
        
        if ($request->concentration) {
            $parameters['concentration'] = $request->concentration;
            $mentals['concentration'] = $request->concentration;
            $goalkeepers['concentration'] = $request->concentration;
        }
        
        if ($request->decisions) {
            $parameters['decisions'] = $request->decisions;
            $mentals['decisions'] = $request->decisions;
            $goalkeepers['decisions'] = $request->decisions;
        }
        
        if ($request->determination) {
            $parameters['determination'] = $request->determination;
            $mentals['determination'] = $request->determination;
            $goalkeepers['determination'] = $request->determination;
        }
        
        if ($request->flair) {
            $parameters['flair'] = $request->flair;
            $mentals['flair'] = $request->flair;
            $goalkeepers['flair'] = $request->flair;
        }
        
        if ($request->leadership) {
            $parameters['leadership'] = $request->leadership;
            $mentals['leadership'] = $request->leadership;
            $goalkeepers['leadership'] = $request->leadership;
        }
        
        if ($request->off_ball) {
            $parameters['off_ball'] = $request->off_ball;
            $mentals['off_ball'] = $request->off_ball;
            $goalkeepers['off_ball'] = $request->off_ball;
        }
        
        if ($request->positioning) {
            $parameters['positioning'] = $request->positioning;
            $mentals['positioning'] = $request->positioning;
            $goalkeepers['positioning'] = $request->positioning;
        }
        
        if ($request->teamwork) {
            $parameters['teamwork'] = $request->teamwork;
            $mentals['teamwork'] = $request->teamwork;
            $goalkeepers['teamwork'] = $request->teamwork;
        }
        
        if ($request->vision) {
            $parameters['vision'] = $request->vision;
            $mentals['vision'] = $request->vision;
            $goalkeepers['vision'] = $request->vision;
        }
        
        if ($request->work_rate) {
            $parameters['work_rate'] = $request->work_rate;
            $mentals['work_rate'] = $request->work_rate;
            $goalkeepers['work_rate'] = $request->work_rate;
        }
        
        // Parameters, physicals
        if ($request->acceleration) {
            $parameters['acceleration'] = $request->acceleration;
            $physicals['acceleration'] = $request->acceleration;
            $goalkeepers['acceleration'] = $request->acceleration;
        }
        
        if ($request->balance) {
            $parameters['balance'] = $request->balance;
            $physicals['balance'] = $request->balance;
            $goalkeepers['balance'] = $request->balance;
        }
        
        if ($request->jumping_reach) {
            $parameters['jumping_reach'] = $request->jumping_reach;
            $physicals['jumping_reach'] = $request->jumping_reach;
            $goalkeepers['jumping_reach'] = $request->jumping_reach;
        }
        
        if ($request->natural_fitness) {
            $parameters['natural_fitness'] = $request->natural_fitness;
            $physicals['natural_fitness'] = $request->natural_fitness;
            $goalkeepers['natural_fitness'] = $request->natural_fitness;
        }
        
        if ($request->pace) {
            $parameters['pace'] = $request->pace;
            $physicals['pace'] = $request->pace;
            $goalkeepers['pace'] = $request->pace;
        }
        
        if ($request->stamina) {
            $parameters['stamina'] = $request->stamina;
            $physicals['stamina'] = $request->stamina;
            $goalkeepers['stamina'] = $request->stamina;
        }
        
        if ($request->strength) {
            $parameters['strength'] = $request->strength;
            $physicals['strength'] = $request->strength;
            $goalkeepers['strength'] = $request->strength;
        }
        
        if ($request->agility) {
            $parameters['agility'] = $request->agility;
            $physicals['agility'] = $request->agility;
            $goalkeepers['agility'] = $request->agility;
        }

        if ($request->aerial_duels) {
            $parameters['aerial_duels'] = $request->aerial_duels;
            $physicals['aerial_duels'] = $request->aerial_duels;
            $goalkeepers['aerial_duels'] = $request->aerial_duels;
        }

        if ($request->reaction) {
            $parameters['reaction'] = $request->reaction;
            $physicals['reaction'] = $request->reaction;
            $goalkeepers['reaction'] = $request->reaction;
        }

        if ($request->sprint_speed) {
            $parameters['sprint_speed'] = $request->sprint_speed;
            $physicals['sprint_speed'] = $request->sprint_speed;
            $goalkeepers['sprint_speed'] = $request->sprint_speed;
        }
        
        foreach ($parameters as $parameter) {
            $sum += $parameter;
            $count ++;
        }
        $player->general_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($technicals as $technical) {
            $sum += $technical;
            $count ++;
        }
        $player->technical_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($mentals as $mental) {
            $sum += $mental;
            $count ++;
        }
        $player->mental_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($physicals as $physical) {
            $sum += $physical;
            $count ++;
        }
        $player->physical_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($goalkeepers as $goalkeeper) {
            $sum += $goalkeeper;
            $count ++;
        }
        if (in_array('Goalkeeper', $spec_position)) {
            $player->goalkeeper_average = $sum / $count;
        } else {
            $player->goalkeeper_average = 0;
        }

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
        $paramsetting = Paramsetting::find(1);
        return view('user.player_profile')
            ->with('data', $player)
            ->with('paramsetting', $paramsetting);
    }

    /**
     * Filter the players
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function filter_player(Request $request)
    {
        $name = ''; $min_age=0; $max_age = 0;
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


        if ($request->min_age) {
            $min_age = $request->min_age;
            $max_age = $request->max_age;
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

    /**
     * Year calc
     * 
     * @param String $birthday
     * @return Int $age
     */
    public function calcAge(String $birthday)
    {
        $birth_year = date('Y', strtotime($birthday));
        $cur_year = date('Y');

        return $cur_year - $birth_year;
    }
}
