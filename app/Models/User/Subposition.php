<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Subposition extends Model
{
    public function player()
    {
        return $this->belongsTo('App\Models\User\Player');
    }
}
