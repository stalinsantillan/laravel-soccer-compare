<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Subscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user->trial_end < date('Y-m-d') && $user->trial_end != "0000-00-00" && $user->is_subscribed != 1) {
            return redirect('/user/subscriptions');
        }
        return $next($request);
    }
}
