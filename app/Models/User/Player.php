<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function subpositions()
    {
        return $this->hasMany('App\Models\User\Subposition');
    }
}
