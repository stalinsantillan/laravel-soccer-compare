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
}
