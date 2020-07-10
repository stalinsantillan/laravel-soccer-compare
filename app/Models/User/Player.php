<?php

namespace App\Models\User;

use App\Models\User\Subposition;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function subpositions()
    {
        return $this->hasMany('App\Models\User\Subposition');
    }

    public function storePositions($subpositions)
    {
        $arr_data = array();
        foreach ($subpositions as $subposition) {
            $data = new Subposition();
            $data->position = $subposition;
            array_push($arr_data, $data);
        }
        $this->subpositions()->saveMany($arr_data);
    }
}
