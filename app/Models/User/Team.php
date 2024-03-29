<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'league_id', 'user_id','img_logo'];
    //
    public function league()
    {
        return $this->belongsTo('App\Models\User\League');
    }
}
