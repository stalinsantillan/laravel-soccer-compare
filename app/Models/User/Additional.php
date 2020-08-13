<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Additional extends Model
{
    protected $table = "additional_information";
    protected $fillable = ['player_id', 'languages', 'national_team', 'first_appearance_date', 'first_appearance_team', 'first_appearance_division', 'contact_expires', 'market_value'];
    //
    public function player()
    {
        return $this->belongsTo('App\Models\User\Player');
    }
    public function getFirstAppearanceTeamName(){
        $first_appearance_id_string = $this->first_appearance_team;
        $first_appearance = explode("_", $first_appearance_id_string);
        $first_appearance_id = $first_appearance[0];
        $first_appearance_team_name = '';
        if (sizeof($first_appearance) > 1) {
            $first_appearance_team_name = Team::find($first_appearance_id)->name;
        } else {
            $first_appearance_team_name = ApiTeam::find($first_appearance_id)->team_name;
        }
        return $first_appearance_team_name;
    }
}
