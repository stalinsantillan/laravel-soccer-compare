<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $trial_version_msg = "";
        if ($user->trial_start == "0000-00-00" && $user->is_subscribe != 1)
        {
            $trial_version_msg = "Your trial version is started now. it will be expire after 21 days.";
            $user->trial_start = date('Y-m-d');
            $user->trial_end = date('Y-m-d', strtotime(date('Y-m-d'). ' + 21 days'));
            $user->save();
        }
        $users = \App\User::all();
        return view('user.dashboard', compact('users', 'trial_version_msg'));
    }
    public function approval()
    {
        return view('layouts.approval');
    }
}
