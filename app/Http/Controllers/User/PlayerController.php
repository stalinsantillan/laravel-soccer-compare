<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User\Player;
use App\Models\User\ApiTeam;
use App\Models\User\Team;
use App\Models\User\Paramsetting;
use Illuminate\Http\UploadedFile;

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
     * Get all db and api teams.
     *
     * @return \Illuminate\Http\Response
     */
    public function getteams(Request $request)
    {
        $team_name = $request->name;
        $db_teams = Team::query()->where("name", "like", "%" . $team_name . "%")->with('league')->get();
        $api_teams = ApiTeam::query()->where("team_name", "like", "%" . $team_name . "%")->select("id", "team_link", "team_name", "competition_name", "country_name")->get()->toArray();
        foreach ($db_teams as $team)
        {
            array_push($api_teams, array("id"=>$team->id."_db", "team_name"=>$team->name, "team_link"=>"", "competition_name"=>$team->league->name, "country_name"=>""));
        }
        return json_encode($api_teams);
    }

    public function getTeamByURL_API($team_url){
        $url = "https://int.soccerway.com{$team_url}";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="utf-8" ?>'.$result);

        $xpath = new \DOMXpath($doc);
        $team = $xpath->query("//div[@id='subheading']/h1")[0]->nodeValue;
        $league = $xpath->query("//a[@id='page_team_1_block_team_matches_summary_7_1_2']")[0]->nodeValue;
        return array("team" => $team, "league" => $league);
    }

    public function getTeamByURL($team_url){
        $team = ApiTeam::query()->where("team_link", "https://int.soccerway.com".$team_url)->get();
        return array("team" => $team[0]->team_name, "league" => $team[0]->competition_name, "id" => $team[0]->id);
    }

    /**
     * Show the add player.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_player_api(Request $request)
    {
        $paramsetting = Paramsetting::find(1);
        $link = $request->link;
        $url = "https://int.soccerway.com{$link}";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));
        $result = curl_exec($curl);
        curl_close($curl);

        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($result);

        $xpath = new \DOMXpath($doc);
        $data = array();
        $data['short_name'] = $xpath->query("//div[@id='subheading']/h1")[0]->nodeValue ?? '';
        $data['first_name'] = $xpath->query("//dd[@data-first_name='first_name']")[0]->nodeValue ?? '';
        $data['last_name'] = $xpath->query("//dd[@data-last_name='last_name']")[0]->nodeValue ?? '';
        $data['nationality'] = $xpath->query("//dd[@data-nationality='nationality']")[0]->nodeValue ?? '';
        $data['date_of_birth'] = $xpath->query("//dd[@data-date_of_birth='date_of_birth']")[0]->nodeValue ?? '';
        $data['age'] = $xpath->query("//dd[@data-age='age']")[0]->nodeValue ?? '';
        $data['country_of_birth'] = $xpath->query("//dd[@data-country_of_birth='country_of_birth']")[0]->nodeValue ?? '';
        $data['place_of_birth'] = $xpath->query("//dd[@data-place_of_birth='place_of_birth']")[0]->nodeValue ?? '';
        $data['position'] = $xpath->query("//dd[@data-position='position']")[0]->nodeValue ?? '';
        $data['height'] = $xpath->query("//dd[@data-height='height']")[0]->nodeValue ?? '';
        $data['weight'] = $xpath->query("//dd[@data-weight='weight']")[0]->nodeValue ?? '';
        $data['foot'] = $xpath->query("//dd[@data-foot='foot']")[0]->nodeValue ?? '';
        $data['photo'] = $xpath->query("//div[@class='yui-u']/img")[0]->getAttribute("src") ?? '';
        $details = $xpath->query("//div[@class='yui-b']/div[@class='redesign']");
        $team = '';
        $league = '';
        $team_url = '';
        $team_id = '';
        if (intval($details->length) > 0)
        {
            $team_url = $xpath->query("//table[@class='playerstats career sortable table']/tbody/tr[1]/td[@class='team']/a")[0]->getAttribute('href');
            $team_league = $this->getTeamByURL($team_url);
//            $team_league = $this->getTeamByURL_API($team_url);
            $team = $team_league['team'];
            $league = $team_league['league'];
            $team_id = $team_league['id'];
        }
        $data['team_url'] = "https://int.soccerway.com".$team_url;
        $data['player_url'] = $url;
        $data['team'] = $team;
        $data['league'] = $league;
        $data['team_id'] = $team_id;
        return view('user.add_player_api')
            ->with('data', $data)
            ->with('paramsetting', $paramsetting);
    }

    /**
     * Show the add player.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_player_list_api()
    {
        $paramsetting = Paramsetting::find(1);

        return view("user.add_player_api_show")
            ->with('paramsetting', $paramsetting);
    }

    public function get_player_list_api_data(Request $request)
    {
        $api_result = array();
        if ($request->name)
        {
            $name = $request->name;
            $page = $request->page;
            $previous_page = $request->previous_page;
            $callback_params = json_encode(array("page"=>$previous_page, "per_page"=>20, "full"=>1, "q"=>$name, "qp"=>array()));
            $params = json_encode(array("page"=>$page));
//            dd($callback_params);
            $url = "https://int.soccerway.com/a/block_search_results_players?block_id=page_search_1_block_search_results_players_3&callback_params={$callback_params}&action=changePage&params={$params}";
//            dd($url);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            ));

            $result = json_decode(curl_exec($curl));
            curl_close($curl);

            $has_previous_page  = $result->commands[1]->parameters->attributes->has_previous_page;
            $has_next_page      = $result->commands[1]->parameters->attributes->has_next_page;
            $page               = $result->commands[2]->parameters->params->page;
            $per_page           = $result->commands[2]->parameters->params->per_page;
            $full               = $result->commands[2]->parameters->params->full;
            $q                  = $result->commands[2]->parameters->params->q;
            $qp                 = $result->commands[2]->parameters->params->qp;
            $api_result['has_previous_page'] = $has_previous_page;
            $api_result['has_next_page'] = $has_next_page;
            $api_result['page'] = $page;
            $api_result['per_page'] = $per_page;
            $api_result['full'] = $full;
            $api_result['q'] = $q;
            $api_result['qp'] = $qp;

            $table = $result->commands[0]->parameters->content;
            $table_check = str_replace("\n", "", $table);
            if ($table_check == "No results found.")
            {
                $api_result['html'] = '';
            } else {
                $doc = new \DOMDocument();
                libxml_use_internal_errors(true);
                $doc->loadHTML('<?xml encoding="utf-8" ?>'.$table);

                $xpath = new \DOMXpath($doc);
                $trlist = $xpath->query("//tbody/tr");
                $table_html = "";
                foreach ($trlist as $tr)
                {
                    $table_html .= "<tr>";
                    $tdlist = $tr->childNodes;
                    foreach ($tdlist as $td)
                    {
                        $table_html .= "<td ";
                        if ($td->getAttribute("class") == "player")
                        {
                            $a = $td->firstChild;
                            $player_link = $a->getAttribute("href");
                            $flag = $a->getAttribute("class");
                            $player_rows = Player::query()->where("player_link", "https://int.soccerway.com".$player_link)->get()->toArray();
                            if (sizeof($player_rows) > 0)
                            {
                                $player_link = "";
                            }
                            $table_html .= "><span class='" . $flag . " pr-1'></span><a class='text-white-50' href='javascript:add_player(\"".$player_link."\")'>" . $td->nodeValue . "</a></td>";
                        } else {
                            $table_html .= ">" . $td->nodeValue . "</td>";
                        }
                    }
                    $table_html .= "</tr>";
                }
                $api_result['html'] = $table_html;
            }
        }
        return json_encode($api_result);
    }

    /**
     * Show the add player.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_player_excel()
    {
        $paramsetting = Paramsetting::find(1);
        return view('user.add_player_excel')
            ->with('paramsetting', $paramsetting);
    }

    /**
     * Show the edit player.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_player(Player $player)
    {
        $paramsetting = Paramsetting::find(1);
        return view('user.edit_player')
            ->with('data', $player)
            ->with('paramsetting', $paramsetting);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function createFileObject($url){

        $path_parts = pathinfo($url);

        $newPath = $path_parts['dirname'] . '/tmp-files/';
        if(!is_dir ($newPath)){
            mkdir($newPath, 0777);
        }

        $newUrl = public_path() . "/" . $path_parts['basename'];
        copy($url, $newUrl);
        $imgInfo = getimagesize($newUrl);

        $file = new UploadedFile(
            $newUrl,
            $path_parts['basename'],
            $imgInfo['mime']
        );

        return $file;
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

        $player->user_id = $request->user()->id;
        $player->short_name = $request->short_name ?? '';
        $player->name = $request->name;
        $player->surename = $request->surname;
        $player->nationality = $request->nationality;
        $player->birth_date = $request->birthdate;
        $player->height = $request->height;
        $player->weight = $request->weight;
        $player->foot = $request->foot;
        $player->current_team = $request->team_name ?? '';
        $player->current_team_id = str_replace("_db", "", $request->team_id) ?? '';
        $player->current_team_link = $request->team_link ?? '';
        $player->player_link = $request->player_link ?? '';
        // Photo
        if ($request->hasFile('photo')) {
            $player->photo = $request->file('photo')->store('avatars');
        } else if ($player->player_link != "")
        {
            $photo_url = $request->photo_url ?? "";
            if ($photo_url != "")
            {
                $file = $this->createFileObject($photo_url);
                $player->photo = $file->store('avatars');
            }
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
        $count == 0 ? $player->general_average = 0 : $player->general_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($technicals as $technical) {
            $sum += $technical;
            $count ++;
        }
        $count == 0 ? $player->technical_average = 0 : $player->technical_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($mentals as $mental) {
            $sum += $mental;
            $count ++;
        }
        $count == 0 ? $player->mental_average = 0 : $player->mental_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($physicals as $physical) {
            $sum += $physical;
            $count ++;
        }
        $count == 0 ? $player->physical_average = 0 : $player->physical_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($goalkeepers as $goalkeeper) {
            $sum += $goalkeeper;
            $count ++;
        }
        if (in_array('Goalkeeper', $spec_position)) {
            $count == 0 ? $player->goalkeeper_average = 0 : $player->goalkeeper_average = $sum / $count;
        } else {
            $player->goalkeeper_average = 0;
        }

        $player->save();

        $player->storePositions($positions);
        $player->storeParameters($parameters);

        return redirect('user/filter_show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store__edt_player(Request $request, Player $player)
    {
        $parameters = array(); $technicals = array(); $physicals = array(); $mentals = array(); $goalkeepers = array(); $positions = array();
        $sum = 0; $count = 0;

        $player->user_id = $request->user()->id;
        $player->short_name = $request->short_name ?? '';
        $player->name = $request->name;
        $player->surename = $request->surname;
        $player->nationality = $request->nationality;
        $player->birth_date = $request->birthdate;
        $player->height = $request->height;
        $player->weight = $request->weight;
        $player->foot = $request->foot;
        $player->current_team = $request->team_name ?? '';
        $player->current_team_id = str_replace("_db", "", $request->team_id) ?? '';
        $player->current_team_link = $request->team_link ?? '';
        $player->player_link = $request->player_link ?? '';
        // Photo
        if ($request->hasFile('photo')) {
            $player->photo = $request->file('photo')->store('avatars');
        } else if ($player->player_link != "")
        {
            $photo_url = $request->photo_url ?? "";
            if ($photo_url != "")
            {
                $file = $this->createFileObject($photo_url);
                $player->photo = $file->store('avatars');
            }
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
        $count == 0 ? $player->general_average = 0 : $player->general_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($technicals as $technical) {
            $sum += $technical;
            $count ++;
        }
        $count == 0 ? $player->technical_average = 0 : $player->technical_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($mentals as $mental) {
            $sum += $mental;
            $count ++;
        }
        $count == 0 ? $player->mental_average = 0 : $player->mental_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($physicals as $physical) {
            $sum += $physical;
            $count ++;
        }
        $count == 0 ? $player->physical_average = 0 : $player->physical_average = $sum / $count;

        $sum = 0; $count = 0;
        foreach ($goalkeepers as $goalkeeper) {
            $sum += $goalkeeper;
            $count ++;
        }
        if (in_array('Goalkeeper', $spec_position)) {
            $count == 0 ? $player->goalkeeper_average = 0 : $player->goalkeeper_average = $sum / $count;
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
        $filter_data = array();
        if ($request->s_name) {
            $name = $request->s_name;
            $filter_data['name'] = $name;
        }
        $data = Player::where('name', 'LIKE', "%".$name."%");
        //->orWhere('surename', 'LIKE', "%$name%")
        if ($request->s_nationality && $request->s_nationality != null) {
            $nationality = $request->s_nationality;
            $data = $data->whereIn('nationality', explode(",", $nationality));
            $filter_data['nationality'] = explode(",", $nationality);
        }
        if ($request->s_position && $request->s_position != null) {
            $position = $request->s_position;
            $arr = explode(",", $position);
            $filter_data['position'] = $arr;
//            $data = $data->whereHas('positions', function ( $query) use ($arr) {
//                $query->whereIn('specify', $arr);
//            });
        }
        if ($request->s_age && $request->s_age != null) {
            $age = explode(",", $request->s_age);
            $min_age = $age[0];
            $max_age = $age[1];
            $data = $data->whereRaw("(YEAR(NOW()) - YEAR(birth_date)) >= ".$min_age)->whereRaw("(YEAR(NOW()) - YEAR(birth_date)) <= ".$max_age);
            $filter_data['age'] = $age;
        }
        if ($request->s_height && $request->s_height != null) {
            $height = explode(",", $request->s_height);
            $min_height = $height[0];
            $max_height = $height[1];
            $data = $data->where("height", ">=", $min_height)->where("height", "<=", $max_height);
            $filter_data['height'] = $height;
        }
        $data = $data->get();
        return view('user.filter')
            ->with('filter', $filter_data)
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
