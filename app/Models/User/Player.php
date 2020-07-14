<?php

namespace App\Models\User;

use App\Models\User\Position;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function positions()
    {
        return $this->hasMany('App\Models\User\Position');
    }

    public function storePositions($positions)
    {
        $arr_data = array();
        foreach ($positions as $position) {
            if (!isset($position)) continue;
            $data = new Position();
            $data->position = $position;
            $data->specify = $position;
            array_push($arr_data, $data);
        }
        if (sizeof($arr_data) > 0)
            $this->positions()->saveMany($arr_data);
    }
}
