<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('user.add_player');
    }

    /**
     * Show the add player.
     *
     * @return \Illuminate\Http\Response
     */
    public function player_profile()
    {
        return view('user.player_profile');
    }
}
